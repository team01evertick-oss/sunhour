<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [

        // EN
        'title',
        'badge',
        'short_description',
        'description',
        'features',

        // KH
        'title_kh',
        'badge_kh',
        'short_description_kh',
        'description_kh',
        'features_kh',

        // CN
        'title_cn',
        'badge_cn',
        'short_description_cn',
        'description_cn',
        'features_cn',

        // IMAGE
        'image',

        // PRODUCT
        'brand',
        'category',
        'availability',

        // CTA
        'cta_question',
        'cta_title',
        'cta_url',

        // STATUS
        'status',
    ];
}