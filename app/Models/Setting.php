<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Config;
class Setting extends Model
{
    use HasFactory;
    protected $table = 'settings';
    protected $fillable = ['key', 'value'];

    public static function getSetting($key)
    {
        return config($key);
    }
    public static function setSetting($key, $value = null)
    {
        $setting = new self();
        $setting = self::where('key', $key)->first();
        $setting->update(['value' => $value]);
        Config::set($key, $value);

    }
}
