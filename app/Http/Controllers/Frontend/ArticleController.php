<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;

class ArticleController extends Controller
{
    public function article()
    {
        $articles = Article::orderBy('category', 'asc')
            ->orderBy('subcategory', 'asc')
            ->get();

        $categories = $articles
            ->groupBy(function ($article) {
                return $article->category_slug ?: 'general';
            })
            ->map(function ($group) {
                return $group->first();
            })
            ->values();

        SEOTools::setTitle("Articles" . ' | ');
        SEOTools::setDescription(
            "Discover Water Purifier, Bath Tub Cambodia, Water Purified ,Water Pump, Faucet Cambodia, Water Filter Cambodia,Tiles Cambodia, Building Material, Accessories Cambodia,Toto bathroom, Water Filter Cambodia, Heat Pump, Toto faucet, Water Dispenser Cambodia, Water Machine Cambodia,Toto faucet,Heat Pump,Water Dispenser Cambodia,Water Filter Cambodia, Water Heating System, Bathroom Equipment in Cambodia’s high-quality water heating systems. From energy-saving heat pumps and solar water solutions to home shower units and storage water heaters, we have the perfect hot water solution for every home."
        );

        $locale = app()->getLocale();
        SEOTools::opengraph()->setUrl(route('brands.all', ['locale' => $locale]));
        SEOTools::metatags()->setKeywords(config('seotools.meta.defaults.keywords'));
        SEOTools::setCanonical(route('brands.all',['locale' => $locale]));
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::twitter()->setSite('@SunHourGroup');

        return view('frontends.article.index', compact('categories'));
    }

    public function articleShow($locale, $categorySlug)
    {
        $articles = Article::where('category_slug', $categorySlug)
            ->orderBy('subcategory', 'asc')
            ->get();

        abort_if($articles->isEmpty(), 404);

        $article = $articles->first();

        $title = app()->getLocale() === 'en'
            ? $article->category
            : (app()->getLocale() === 'km'
                ? ($article->category_kh ?: $article->category)
                : ($article->category_cn ?: $article->category));
        SEOTools::setTitle($title);
        SEOTools::setDescription(strip_tags($article->description ?: $article->content ?: ''));

        return view('frontends.article.show', compact('article', 'articles'));
    }

    public function articleDetail($locale, $categorySlug, $slug)
    {
        $article = Article::where('category_slug', $categorySlug)
            ->where('slug', $slug)
            ->firstOrFail();

        $title = app()->getLocale() === 'en'
            ? $article->title
            : (app()->getLocale() === 'km' ? $article->title_kh : $article->title_cn);
        SEOTools::setTitle($title);
        SEOTools::setDescription(strip_tags($article->description ?: $article->content ?: ''));

        return view('frontends.article.detail', compact('article'));
    }
}
