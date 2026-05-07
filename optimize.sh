#!/bin/bash
# ============================================================
# Jai's House — Production Optimization Script
# Run this after every deployment on shared hosting.
# ============================================================

echo "🚀 Optimizing Jai's House for production..."

# Optimize composer autoloader
composer dump-autoload -o
echo "✅ Composer autoloader optimized"

# Cache configuration (biggest win: ~100-150ms per request)
php artisan config:cache
echo "✅ Config cached"

# Cache routes (~50-80ms per request)
php artisan route:cache
echo "✅ Routes cached"

# Cache views (~20-40ms per request)
php artisan view:cache
echo "✅ Views cached"

# Cache events
php artisan event:cache
echo "✅ Events cached"

# Cache Filament components & icons
php artisan filament:optimize
echo "✅ Filament optimized"

php artisan icons:cache
echo "✅ Icons cached"

# Clear expired password reset tokens
php artisan auth:clear-resets 2>/dev/null

echo ""
echo "🎉 Optimization complete!"
echo "   Total estimated savings: ~250-400ms per cold request"
echo ""
echo "⚠️  Remember: After changing .env or config files, re-run this script."
echo "   To clear all caches: php artisan optimize:clear"
