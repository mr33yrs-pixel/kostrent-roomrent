<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\HtmlString;

class Room extends Model
{
    use HasFactory;

    /**
     * Clear only room-related cache keys when a room is saved or deleted.
     * Avoids nuclear cache:clear that destroys all cached data.
     */
    protected static function booted(): void
    {
        $clearRoomCache = function () {
            // Clear only room pagination cache keys instead of entire application cache
            $prefixes = ['rooms.premium.page.', 'rooms.standard.page.'];
            foreach ($prefixes as $prefix) {
                // Clear pages 1-10 (reasonable upper bound)
                for ($i = 1; $i <= 10; $i++) {
                    Cache::forget("{$prefix}{$i}");
                }
            }
        };

        static::saved($clearRoomCache);
        static::deleted($clearRoomCache);
    }

    protected $fillable = [
        'name',
        'slug',
        'type',
        'price',
        'price_6_months',
        'price_yearly',
        'description',
        'facilities',
        'images',
        'is_available',
    ];

    protected $casts = [
        'facilities' => 'array',
        'images' => 'array',
        'is_available' => 'boolean',
        'price' => 'decimal:2',
        'price_6_months' => 'decimal:2',
        'price_yearly' => 'decimal:2',
    ];

    /**
     * Get the route key for the model (for route model binding).
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // =========================================================================
    // Pricing Accessors
    // =========================================================================

    /**
     * Calculate savings for 6-month package compared to monthly rate.
     * Returns 0 if no real savings (prevents negative display).
     */
    public function getSixMonthSavingsAttribute(): float
    {
        if (!$this->price_6_months || !$this->price) {
            return 0;
        }

        $savings = ($this->price * 6) - $this->price_6_months;
        return max(0, $savings);
    }

    /**
     * Calculate savings for yearly package compared to monthly rate.
     * Returns 0 if no real savings (prevents negative display).
     */
    public function getYearlySavingsAttribute(): float
    {
        if (!$this->price_yearly || !$this->price) {
            return 0;
        }

        $savings = ($this->price * 12) - $this->price_yearly;
        return max(0, $savings);
    }

    /**
     * Check if 6-month package offers real savings.
     */
    public function hasSixMonthDiscount(): bool
    {
        return $this->price_6_months && $this->six_month_savings > 0;
    }

    /**
     * Check if yearly package offers real savings.
     */
    public function hasYearlyDiscount(): bool
    {
        return $this->price_yearly && $this->yearly_savings > 0;
    }

    // =========================================================================
    // Formatting Accessors
    // =========================================================================

    /**
     * Get formatted monthly price.
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'IDR ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Get formatted 6-month price.
     */
    public function getFormattedPrice6MonthsAttribute(): ?string
    {
        if (!$this->price_6_months) {
            return null;
        }
        return 'IDR ' . number_format($this->price_6_months, 0, ',', '.');
    }

    /**
     * Get formatted yearly price.
     */
    public function getFormattedPriceYearlyAttribute(): ?string
    {
        if (!$this->price_yearly) {
            return null;
        }
        return 'IDR ' . number_format($this->price_yearly, 0, ',', '.');
    }

    /**
     * Get formatted 6-month savings.
     */
    public function getFormattedSixMonthSavingsAttribute(): string
    {
        return number_format($this->six_month_savings, 0, ',', '.');
    }

    /**
     * Get formatted yearly savings.
     */
    public function getFormattedYearlySavingsAttribute(): string
    {
        return number_format($this->yearly_savings, 0, ',', '.');
    }

    /**
     * Get sanitized description HTML.
     * Only allows safe HTML tags to prevent XSS.
     */
    public function getSafeDescriptionAttribute(): HtmlString
    {
        $allowedTags = '<p><br><strong><em><b><i><ul><ol><li><h2><h3><h4><blockquote>';
        return new HtmlString(strip_tags($this->description ?? '', $allowedTags));
    }
}
