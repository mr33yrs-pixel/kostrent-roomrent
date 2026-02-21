<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'label', 'value'];

    protected $casts = [
        'value' => 'json',
    ];

    /**
     * Clear the settings cache when a setting is saved or deleted.
     */
    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('settings'));
        static::deleted(fn () => Cache::forget('settings'));
    }

    /**
     * Get a setting value by key with caching.
     * Cache is automatically invalidated when settings are updated.
     */
    public static function getByKey(string $key, mixed $default = null): mixed
    {
        $settings = Cache::rememberForever('settings', function () {
            return self::pluck('value', 'key')->toArray();
        });

        return $settings[$key] ?? $default;
    }

    /**
     * Clear all settings cache manually if needed.
     */
    public static function clearCache(): void
    {
        Cache::forget('settings');
    }
}
