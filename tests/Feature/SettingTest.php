<?php

namespace Tests\Feature;

use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class SettingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Ensure cache is clean before each test
        Cache::flush();
    }

    public function test_settings_are_cached(): void
    {
        // Create a setting
        Setting::create(['key' => 'foo', 'label' => 'Foo', 'value' => 'bar']);

        // First retrieval (should query DB and populate cache)
        $this->assertEquals('bar', Setting::getByKey('foo'));

        // Assert cache was populated
        $this->assertTrue(Cache::has('settings'));
        $cached = Cache::get('settings');
        $this->assertEquals('bar', $cached['foo']);

        // Manually update DB WITHOUT triggering model events (bypass cache invalidation)
        // Must JSON-encode the value because the column uses a JSON cast and pluck() applies it
        Setting::where('key', 'foo')->toBase()->update(['value' => json_encode('baz')]);

        // Should still return 'bar' from stale cache
        $this->assertEquals('bar', Setting::getByKey('foo'));

        // Clear cache, now it should hit DB again
        Setting::clearCache();
        $this->assertEquals('baz', Setting::getByKey('foo'));
    }

    public function test_default_value_is_returned(): void
    {
        $this->assertEquals('default', Setting::getByKey('non_existent', 'default'));
    }

    public function test_cache_is_invalidated_on_save(): void
    {
        // Populate cache
        Setting::create(['key' => 'test_key', 'label' => 'Test Key', 'value' => 'original']);
        Setting::getByKey('test_key'); // warm cache

        $this->assertTrue(Cache::has('settings'));

        // Update via Eloquent (triggers saved event → cache invalidation)
        Setting::where('key', 'test_key')->first()->update(['value' => 'updated']);

        // Cache should be invalidated by the model's saved event
        $this->assertFalse(Cache::has('settings'));

        // Next retrieval should return updated value
        $this->assertEquals('updated', Setting::getByKey('test_key'));
    }
}
