<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
   use HasFactory;

    // Add all fields you are saving in the controller here
    protected $table = 'articles';
    protected $fillable = [
        'photo',
        'category',
        'category_kh',
        'category_cn',
        'category_slug',
        'slug',
        'subcategory',
        'subcategory_kh',
        'subcategory_cn',

        // English fields
        'title',
        'subtitle',
        'content',
        'description', // CKEditor field

        // Khmer fields
        'title_kh',
        'subtitle_kh',
        'content_kh',
        'description_kh', // CKEditor field

        // Chinese fields
        'title_cn',
        'subtitle_cn',
        'content_cn',
        'description_cn', // CKEditor field
    ];
}
