<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class EventController extends Controller
{
    private function getArticles(): array
    {
        return [
            [
                'num'   => '01',
                'tag'   => 'Water Purifier Product',
                'title' => 'Complete Guide to Water Purification Systems in Cambodia',
                'slug'  => 'water-purification-systems-cambodia',
                'color' => 'blue',
                'badge' => 'Purepro Collection',
                'desc'  => 'A comprehensive resource center providing expert insights about water purification systems in Cambodia.',
            ],
            [
                'num'   => '02',
                'tag'   => 'Water Filter Cambodia',
                'title' => 'Water Purifier vs Water Filter: What\'s the Difference?',
                'slug'  => 'water-purifier-vs-water-filter',
                'color' => 'teal',
                'badge' => 'PurePro Series',
                'desc'  => 'Understand the key differences between water purifiers and filters to make the best choice for your home.',
            ],
            [
                'num'   => '03',
                'tag'   => 'Water Purifier',
                'title' => 'Signs Your Home Needs a Water Filtration System',
                'slug'  => 'signs-home-needs-filtration',
                'color' => 'amber',
                'badge' => 'Home Solutions',
                'desc'  => 'Learn the warning signs that indicate your home may need a water filtration system installed.',
            ],
            [
                'num'   => '04',
                'tag'   => 'PurePro',
                'title' => 'Best Water Purifier for Homes in Cambodia',
                'slug'  => 'best-water-purifier-cambodia',
                'color' => 'purple',
                'badge' => 'PurePro',
                'desc'  => 'Top-rated water purifiers reviewed and recommended for Cambodian households.',
            ],
            [
                'num'   => '05',
                'tag'   => 'Commercial Solutions',
                'title' => 'Commercial Water Filtration Systems for Offices and Restaurants',
                'slug'  => 'commercial-water-filtration',
                'color' => 'orange',
                'badge' => 'Commercial',
                'desc'  => 'Industrial-grade filtration systems built for high-demand commercial environments.',
            ],
        ];
    }

    public function index()
    {
        return view('frontends.eventPage.index');
    }

    public function show($slug)
    {
        $articles = $this->getArticles();
        $current  = collect($articles)->firstWhere('slug', $slug);

        if (!$current) {
            abort(404);
        }

        return view('frontends.eventPage.show', compact('slug', 'articles', 'current'));
    }
}