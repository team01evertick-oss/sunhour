<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('category')->nullable()->after('photo');
            $table->string('category_kh')->nullable()->after('category');
            $table->string('category_cn')->nullable()->after('category_kh');
            $table->string('category_slug')->nullable()->after('category_cn');
            $table->string('subcategory')->nullable()->after('subtitle_cn');
            $table->string('subcategory_kh')->nullable()->after('subcategory');
            $table->string('subcategory_cn')->nullable()->after('subcategory_kh');
        });

        DB::table('articles')->orderBy('id')->get()->each(function ($article) {
            $category = 'General';

            DB::table('articles')
                ->where('id', $article->id)
                ->update([
                    'category' => $category,
                    'category_slug' => Str::slug($category),
                    'subcategory' => $article->title,
                    'subcategory_kh' => $article->title_kh,
                    'subcategory_cn' => $article->title_cn,
                ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn([
                'category',
                'category_kh',
                'category_cn',
                'category_slug',
                'subcategory',
                'subcategory_kh',
                'subcategory_cn',
            ]);
        });
    }
};
