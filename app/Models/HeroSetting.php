<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSetting extends Model
{
    protected $fillable = ['hero_image', 'slogan_title', 'slogan_text'];
}
