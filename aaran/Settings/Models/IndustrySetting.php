<?php

namespace Aaran\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class IndustrySetting extends Model
{
    protected $fillable = ['industry', 'key', 'value'];
    public $timestamps = false;

    public static function get($industry, $key, $default = null)
    {
        return Cache::remember("industry_settings.{$industry}.{$key}", 60, function () use ($industry, $key, $default) {
            return self::where('industry', $industry)->where('key', $key)->value('value') ?? $default;
        });
    }

    public static function set($industry, $key, $value)
    {
        self::updateOrCreate(['industry' => $industry, 'key' => $key], ['value' => $value]);
        Cache::forget("industry_settings.{$industry}.{$key}");
    }
}

