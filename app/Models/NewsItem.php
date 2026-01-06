<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsItem extends Model
{
    protected $fillable = ['image_path', 'badge_text', 'badge_color', 'title', 'content'];
}
