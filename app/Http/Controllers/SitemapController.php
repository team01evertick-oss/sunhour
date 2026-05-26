<?php

namespace App\Http\Controllers;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Article;
use App\Models\Brand;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = Sitemap::create();

        $locales = ['en', 'km'];

        // Static pages
        $pages = [
            'about-us',
            'partnerships.index',
            'career.index',
            'contact.index',
            'faqs',
            'articles.index',
        ];

        foreach ($locales as $locale) {
            foreach ($pages as $page) {
                $sitemap->add(
                    Url::create(route($page, ['locale' => $locale]))
                        ->setPriority(0.8)
                );
            }
        }

        // Articles
        foreach ($locales as $locale) {
            foreach (Article::whereNotNull('category_slug')->select('category_slug')->distinct()->get() as $category) {
                $sitemap->add(
                    Url::create(route('articles.show', [
                        'locale' => $locale,
                        'categorySlug' => $category->category_slug
                    ]))
                    ->setPriority(0.8)
                );
            }

            foreach (Article::where('status', 1)->get() as $article) {
                $sitemap->add(
                    Url::create(route('articles.details', [
                        'locale' => $locale,
                        'categorySlug' => $article->category_slug,
                        'slug' => $article->slug
                    ]))
                    ->setPriority(0.7)
                );
            }
        }

        return $sitemap->toResponse(request());
    }
}
