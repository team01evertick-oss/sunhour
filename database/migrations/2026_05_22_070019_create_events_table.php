<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | ENGLISH
            |--------------------------------------------------------------------------
            */
            $table->string('title')->nullable();
            $table->string('badge')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->longText('features')->nullable();

            /*
            |--------------------------------------------------------------------------
            | KHMER
            |--------------------------------------------------------------------------
            */
            $table->string('title_kh')->nullable();
            $table->string('badge_kh')->nullable();
            $table->text('short_description_kh')->nullable();
            $table->longText('description_kh')->nullable();
            $table->longText('features_kh')->nullable();

            /*
            |--------------------------------------------------------------------------
            | CHINESE
            |--------------------------------------------------------------------------
            */
            $table->string('title_cn')->nullable();
            $table->string('badge_cn')->nullable();
            $table->text('short_description_cn')->nullable();
            $table->longText('description_cn')->nullable();
            $table->longText('features_cn')->nullable();

            /*
            |--------------------------------------------------------------------------
            | IMAGE
            |--------------------------------------------------------------------------
            */
            $table->string('image')->nullable();

            /*
            |--------------------------------------------------------------------------
            | PRODUCT INFO
            |--------------------------------------------------------------------------
            */
            $table->string('brand')->nullable();
            $table->string('category')->nullable();
            $table->string('availability')->nullable();

            /*
            |--------------------------------------------------------------------------
            | CTA
            |--------------------------------------------------------------------------
            */
            $table->string('cta_question')->nullable();
            $table->string('cta_title')->nullable();
            $table->string('cta_url')->nullable();

            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */
            $table->tinyInteger('status')->default(1);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};