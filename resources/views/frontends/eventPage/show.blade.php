@extends('layouts.guest')

@php
    use Artesaos\SEOTools\Facades\SEOTools;

    $tagColors = [
        'blue'   => 'bg-blue-100 text-blue-800',
        'teal'   => 'bg-teal-100 text-teal-800',
        'amber'  => 'bg-amber-100 text-amber-800',
        'purple' => 'bg-purple-100 text-purple-800',
        'orange' => 'bg-orange-100 text-orange-800',
    ];

    $badgeColors = [
        'blue'   => 'bg-blue-50 text-blue-700',
        'teal'   => 'bg-teal-50 text-teal-700',
        'amber'  => 'bg-amber-50 text-amber-700',
        'purple' => 'bg-purple-50 text-purple-700',
        'orange' => 'bg-orange-50 text-orange-700',
    ];
@endphp

@section('meta_tag')
    {!! SEOTools::generate() !!}
@endsection

@section('content')

    @component('components.navbar')
    @endcomponent
    <div class="my-6 p-0 h-screen overflow-x-hidden scroll-smooth">

    <div class="pt-[80px] min-h-screen flex flex-col overflow-x-hidden scroll-smooth">

        {{-- ARTICLE CARDS --}}
        <div class="container mx-auto px-4 pt-10 pb-4">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach ($articles as $article)
                <div data-slug="{{ $article['slug'] }}"
                     class="article-card group flex flex-col gap-3 bg-white border rounded-2xl p-6 cursor-pointer transition-all duration-300
                            {{ $article['slug'] === $slug ? 'border-blue-400 shadow-md -translate-y-1' : 'border-gray-200 hover:-translate-y-1 hover:border-gray-300' }}">

                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-400 font-medium tracking-wide">{{ $article['num'] }}</span>
                        <span class="text-xs font-semibold uppercase tracking-wide px-3 py-1 rounded-full {{ $tagColors[$article['color']] }}">
                            {{ $article['tag'] }}
                        </span>
                    </div>

                    <p class="text-gray-900 font-semibold text-base leading-snug">
                        {{ $article['title'] }}
                    </p>

                    <span class="explore-label text-sm mt-auto inline-flex items-center gap-1 transition-colors
                                 {{ $article['slug'] === $slug ? 'text-blue-600' : 'text-gray-500 group-hover:text-gray-800' }}">
                        Explore →
                    </span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- MAIN CONTENT --}}
        <div id="main_contain" class="relative mt-4 flex-1 pb-20 transition-opacity duration-200">

            {{-- HERO --}}
            <div class="w-full bg-gradient-to-b from-slate-50 to-white py-16 sm:py-20 px-6 relative overflow-hidden">
                <div class="absolute -top-20 -right-20 w-72 h-72 bg-blue-300/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute bottom-0 left-10 w-60 h-60 bg-cyan-300/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="container mx-auto relative z-10">

                    {{-- Breadcrumb --}}
                    <div class="flex items-center gap-2 text-xs text-gray-500 uppercase tracking-widest mb-8">
                        <a href="{{ url('/en/events') }}" class="hover:text-blue-600 transition">Events</a>
                        <span>/</span>
                        <span class="text-gray-400">{{ $current['title'] }}</span>
                    </div>

                    {{-- Badge (dynamic) --}}
                    <span class="inline-block px-4 py-1 rounded-full text-xs font-semibold uppercase tracking-[3px] mb-5 {{ $badgeColors[$current['color']] }}">
                        {{ $current['badge'] }}
                    </span>

                    {{-- Title (dynamic) --}}
                    <h1 class="text-xl sm:text-2xl lg:text-3xl font-black text-gray-900 tracking-tight leading-tight max-w-3xl">
                        {{ $current['title'] }}
                    </h1>

                    {{-- Description (dynamic) --}}
                    <p class="text-slate-500 text-sm sm:text-base mt-5 max-w-xl leading-relaxed">
                        {{ $current['desc'] }}
                    </p>

                    {{-- Buttons --}}
                    <div class="flex flex-wrap items-center gap-4 mt-8">
                        <a href="#details"
                           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-500 text-white text-sm font-semibold px-6 py-3 rounded-full transition">
                            View Details ↓
                        </a>
                        <a href="{{ url('/en/events') }}"
                           class="inline-flex items-center gap-2 border border-slate-300 hover:border-slate-500 text-slate-700 text-sm font-semibold px-6 py-3 rounded-full transition">
                            ← Back to Events
                        </a>
                    </div>

                </div>
            </div>

            {{-- DETAILS --}}
            <div id="details" class="container mx-auto px-4 py-10">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                    {{-- LEFT --}}
                    <div class="lg:col-span-2 space-y-10">

                        <div class="w-full h-64 sm:h-80 lg:h-96 rounded-3xl bg-slate-100 flex items-center justify-center border border-slate-200">
                            <span class="text-xs uppercase tracking-[4px] text-slate-400">Product Image</span>
                        </div>

                        <div>
                            <h2 class="text-2xl sm:text-3xl font-black text-gray-900 mb-4">
                                Why Water Purification Matters
                            </h2>
                            <div class="w-12 h-0.5 bg-blue-600 mb-6"></div>
                            <p class="text-slate-600 leading-relaxed">
                                Access to clean water is essential for homes, offices, restaurants, hospitals, and commercial buildings. In Cambodia, water quality can vary depending on the source, making water purification systems increasingly important.
                            </p>
                            <p class="text-slate-600 leading-relaxed mt-4">
                                Water purification removes contaminants such as sediment, bacteria, chlorine, chemicals, and impurities to provide cleaner water for drinking and daily use.
                            </p>
                            <p class="text-slate-600 leading-relaxed mt-4">
                                If you are looking for a reliable solution, explore our
                                <a href="#" class="text-blue-600 font-semibold hover:underline">Water Purifier Products</a> and
                                <a href="#" class="text-blue-600 font-semibold hover:underline">Water Filter Cambodia Solutions</a>.
                            </p>
                        </div>

                        {{-- Feature Cards --}}
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-6">Types of Water Purification Systems</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-5 space-y-2">
                                    <h4 class="font-bold text-gray-800 text-sm">🔵 Reverse Osmosis (RO)</h4>
                                    <ul class="text-sm text-slate-600 space-y-1 list-disc list-inside">
                                        <li>Heavy metals & dissolved solids</li>
                                        <li>Harmful contaminants</li>
                                        <li>Bacteria and viruses</li>
                                    </ul>
                                    <p class="text-xs text-slate-400 mt-2">Ideal for: Homes, Offices, Restaurants</p>
                                </div>
                                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-5 space-y-2">
                                    <h4 class="font-bold text-gray-800 text-sm">⚫ Activated Carbon</h4>
                                    <ul class="text-sm text-slate-600 space-y-1 list-disc list-inside">
                                        <li>Improves water taste</li>
                                        <li>Chlorine removal</li>
                                        <li>Odor reduction</li>
                                    </ul>
                                </div>
                                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-5 space-y-2">
                                    <h4 class="font-bold text-gray-800 text-sm">🟣 UV Sterilization</h4>
                                    <p class="text-sm text-slate-600">Eliminates microorganisms without chemicals.</p>
                                </div>
                                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-5 space-y-2">
                                    <h4 class="font-bold text-gray-800 text-sm">🟢 Whole House Filtration</h4>
                                    <ul class="text-sm text-slate-600 space-y-1 list-disc list-inside">
                                        <li>Kitchen & bathroom water</li>
                                        <li>Appliances & plumbing</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {{-- Benefits --}}
                        <div class="rounded-2xl bg-blue-50 border border-blue-100 p-6">
                            <h3 class="text-base font-bold text-blue-900 mb-4">Benefits of Water Purification</h3>
                            <ul class="space-y-2 text-sm text-blue-800">
                                <li>✓ Better drinking water quality</li>
                                <li>✓ Improved health protection</li>
                                <li>✓ Reduced contaminants</li>
                                <li>✓ Better appliance lifespan</li>
                                <li>✓ Improved water taste</li>
                            </ul>
                        </div>

                        {{-- CTA --}}
                        <div class="rounded-2xl bg-blue-600 p-6 text-white flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <p class="font-semibold text-sm">Need cleaner drinking water for your home or office?</p>
                            <a href="#" class="shrink-0 bg-white text-blue-600 font-semibold text-sm px-5 py-2.5 rounded-full hover:bg-blue-50 transition">
                                Explore Solutions →
                            </a>
                        </div>

                    </div>

                    {{-- RIGHT SIDEBAR --}}
                    <div class="space-y-6">

                        <div class="rounded-3xl bg-white border border-slate-100 shadow-sm p-6 space-y-5">
                            <h3 class="text-base font-bold text-gray-900">Product Info</h3>
                            <div class="divide-y divide-slate-100 text-sm">
                                <div class="flex justify-between py-3">
                                    <span class="text-slate-500">Brand</span>
                                    <span class="font-semibold">TOTO</span>
                                </div>
                                <div class="flex justify-between py-3">
                                    <span class="text-slate-500">Category</span>
                                    <span class="font-semibold">Bathroom</span>
                                </div>
                                <div class="flex justify-between py-3">
                                    <span class="text-slate-500">Availability</span>
                                    <span class="text-emerald-600 font-semibold">In Stock</span>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-3xl bg-blue-600 p-6 text-white">
                            <h3 class="font-bold">Need Help?</h3>
                            <p class="text-blue-100 text-sm mt-2">Contact our team anytime.</p>
                            <a href="tel:012818189" class="block mt-4 font-semibold text-sm">📞 012 818 189</a>
                            <a href="mailto:ssl@sunhour.com" class="block mt-2 font-semibold text-sm">✉️ ssl@sunhour.com</a>
                        </div>

                        {{-- More Articles --}}
                        <div class="rounded-3xl bg-white border border-slate-100 shadow-sm p-6">
                            <h3 class="text-base font-bold text-gray-900 mb-4">More Articles</h3>
                            <div class="space-y-3">
                                @foreach ($articles as $article)
                                    @if ($article['slug'] !== $slug)
                                        <div data-slug="{{ $article['slug'] }}"
                                             class="article-card-sidebar flex items-start gap-3 group cursor-pointer">
                                            <span class="text-xs text-slate-400 mt-0.5 shrink-0">{{ $article['num'] }}</span>
                                            <span class="text-sm text-slate-600 group-hover:text-blue-600 transition leading-snug">
                                                {{ $article['title'] }}
                                            </span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <a href="{{ url('/en/events') }}"
                           class="block text-center border border-slate-200 hover:border-slate-400 text-slate-600 py-3 rounded-2xl text-sm transition">
                            ← Back to Events
                        </a>

                    </div>

                </div>
            </div>

        </div>

    </div>

        {{-- FOOTER --}}
        <footer class=" inset-x-0 bottom-0 bg-black py-1 z-[50]">
            <p class="text-white text-[12px] text-center"> © Copyright 2024 SUNHOUR GROUP, All Rights Reserved</p>
        </footer>

    </div>

<script>
function loadArticle(slug) {
    // Update active card styles in the top grid
    document.querySelectorAll('.article-card').forEach(c => {
        const isActive = c.dataset.slug === slug;
        c.classList.toggle('border-blue-400', isActive);
        c.classList.toggle('shadow-md', isActive);
        c.classList.toggle('-translate-y-1', isActive);
        c.classList.toggle('border-gray-200', !isActive);
        const label = c.querySelector('.explore-label');
        if (label) {
            label.classList.toggle('text-blue-600', isActive);
            label.classList.toggle('text-gray-500', !isActive);
        }
    });

    // Loading state
    const container = document.getElementById('main_contain');
    container.style.opacity = '0.4';
    container.style.pointerEvents = 'none';

    fetch(`/en/events/${slug}`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(res => res.text())
    .then(html => {
        const doc = new DOMParser().parseFromString(html, 'text/html');
        const newContent = doc.getElementById('main_contain');
        if (newContent) {
            container.innerHTML = newContent.innerHTML;
            // Re-attach sidebar click events after content swap
            attachSidebarEvents();
        }
        container.style.opacity = '1';
        container.style.pointerEvents = 'auto';
        window.history.pushState({slug}, '', `/en/events/${slug}`);
        container.scrollIntoView({ behavior: 'smooth' });
    })
    .catch(() => {
        window.location.href = `/en/events/${slug}`;
    });
}

function attachSidebarEvents() {
    document.querySelectorAll('.article-card-sidebar').forEach(el => {
        el.addEventListener('click', function () {
            loadArticle(this.dataset.slug);
        });
    });
}

// Top grid cards
document.querySelectorAll('.article-card').forEach(card => {
    card.addEventListener('click', function () {
        loadArticle(this.dataset.slug);
    });
});

// Sidebar cards (initial attach)
attachSidebarEvents();

// Browser back/forward
window.addEventListener('popstate', (e) => {
    if (e.state?.slug) {
        loadArticle(e.state.slug);
    } else {
        window.location.reload();
    }
});
</script>

@endsection