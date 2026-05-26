<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Article;
use App\Models\Admin\Brand;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     */
    protected $description = 'Generate sitemap.xml for SEO (EN & KM)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating sitemap...');

        $sitemap = Sitemap::create();
        $locales = ['en', 'km'];

        /**
         * ✅ Static pages
         */
        foreach ($locales as $locale) {
            $sitemap->add(
                Url::create(route('about-us', ['locale' => $locale]))
                    ->setPriority(0.8)
            );

            $sitemap->add(
                Url::create(route('articles.index', ['locale' => $locale]))
                    ->setPriority(0.9)
            );

            $sitemap->add(
                Url::create(route('contact.index', ['locale' => $locale]))
                    ->setPriority(0.7)
            );
        }

        /**
         * ✅ Articles
         */
        foreach ($locales as $locale) {
            foreach (Article::whereNotNull('category_slug')->select('category_slug')->distinct()->get() as $category) {
                $sitemap->add(
                    Url::create(route('articles.show', [
                        'locale' => $locale,
                        'categorySlug' => $category->category_slug,
                    ]))
                        ->setPriority(0.8)
                );
            }

            foreach (Article::where('status', 1)->get() as $article) {
                $sitemap->add(
                    Url::create(route('articles.details', [
                        'locale' => $locale,
                        'categorySlug' => $article->category_slug,
                        'slug'   => $article->slug,
                    ]))
                        ->setPriority(0.7)
                );
            }
        }

        /**
         * ✅ Brands & Products
         */
        foreach ($locales as $locale) {
            foreach (Brand::all() as $brand) {
                $sitemap->add(
                    Url::create(route('brands-client.show', [
                        'locale' => $locale,
                        'skug'   => $brand->skug,
                    ]))
                        ->setPriority(0.8)
                );
            }
        }

        /**
         * ✅ Save sitemap
         */
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('✅ Sitemap generated: public/sitemap.xml');
    }
}
