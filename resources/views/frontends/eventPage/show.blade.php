@extends('layouts.guest')

@php
    use Artesaos\SEOTools\Facades\SEOTools;
@endphp

@section('meta_tag')
    {!! SEOTools::generate() !!}
@endsection

<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
@section('content')

    {{-- Navbar --}}
    @component('components.navbar')
    @endcomponent
    <div class="m-0 p-0 h-screen overflow-x-hidden scroll-smooth">

        {{-- PAGE WRAPPER (FIXED SCROLL) --}}
        <div class="min-h-screen flex flex-col overflow-x-hidden scroll-smooth">

            {{-- MAIN CONTENT --}}
            <div class="relative mt-16 flex-1 pb-20">

                {{-- HERO --}}
                <div class="w-full bg-gradient-to-b py-16 sm:py-24 px-6 relative overflow-hidden">

                    <div class="absolute -top-20 -right-20 w-72 h-72 bg-blue-300/10 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 left-10 w-60 h-60 bg-cyan-300/10 rounded-full blur-3xl"></div>

                    <div class="container mx-auto relative z-10">

                        {{-- Breadcrumb --}}
                        <div class="flex items-center gap-2 text-xs text-gray-700 uppercase tracking-widest mb-8">
                            <a href="{{ url('/en/events') }}" class="hover:text-blue-600 transition">Events</a>
                            <span>/</span>
                            <span class="text-gray-500">{{ $slug }}</span>
                        </div>

                        {{-- Badge --}}
                        <span class="inline-block px-4 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold uppercase tracking-[3px] mb-5">
                            Purepro Collection
                        </span>

                        {{-- Title --}}
                        <h1 class="text-xl sm:text-2xl lg:text-3xl font-black text-gray-900 tracking-tight leading-tight w-full">
                            Complete Guide to Water Purification Systems in Cambodia
                        </h1>

                        {{-- Description --}}
                        <p class="text-slate-500 text-sm sm:text-base mt-5 max-w-xl leading-relaxed">
                            The Water Purification Authority Hub is a comprehensive resource center providing expert insights, guides, and solutions about water purification systems in Cambodia.       
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
                <div id="details" class="container mx-auto px-4 sm:px-4 lg:px-4 py-4 lg:py-">

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                        {{-- LEFT --}}
                        <div class="lg:col-span-2 space-y-10">

                            <div class="w-full h-64 sm:h-80 lg:h-96 rounded-3xl bg-slate-200 flex items-center justify-center">
                                <span class="text-xs uppercase tracking-[4px] text-slate-400">
                                    Product Image
                                </span>
                            </div>

                            {{-- About This Product --}}
                            <div>
                                <h2 class="text-2xl sm:text-3xl font-black text-gray-900 mb-4">
                                    Why Water Purification Matters
                                </h2>

                                <div class="w-12 h-0.5 bg-blue-600 mb-6"></div>

                                <br class="text-slate-600 leading-relaxed">
                                    Access to clean water is essential for homes, offices, restaurants, hospitals, and commercial buildings. In Cambodia, water quality can vary depending on the source, making water purification systems increasingly important for protecting health and improving daily water usage.
                                    </br></br>
                                    Water purification removes contaminants such as sediment, bacteria, chlorine, chemicals, and impurities to provide cleaner water for drinking and daily consumption.
                                    </br></br>
                                    If you are looking for a reliable solution, explore our <b>Water Purifier Products</b> and <b> Water Filter Cambodia Solutions.</b>                              
                                </p>
                            </div>

                            {{-- FEATURES --}}
                            <div>

                                <h3 class="text-lg font-bold text-gray-900 mb-5">Features Product</h3>

                                {{-- this use CKEdit --}}
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    Types of Water Purification Systems
                                    Reverse Osmosis (RO)
                                    <br><br>

                                    RO systems remove:<br>
                                    - Heavy metals <br>
                                    - Dissolved solids <br>
                                    - Harmful contaminants <br>
                                    - Bacteria and viruses <br>

                                    Ideal for:
                                    Homes
                                    Offices
                                    Restaurants
                                    Activated Carbon Filtration
                                    Carbon filters improve:
                                    Water taste
                                    Chlorine removal
                                    Odor reduction
                                    UV Sterilization
                                    UV purification helps eliminate microorganisms without chemicals.
                                    Whole House Filtration Systems
                                    Whole-property filtration protects:
                                    Kitchen water
                                    Bathroom water
                                    Appliances
                                    Plumbing systems

                                    Benefits of Water Purification
                                    Benefits include:
                                    ✓ Better drinking water quality
                                    ✓ Improved health protection
                                    ✓ Reduced contaminants
                                    ✓ Better appliance lifespan
                                    ✓ Improved water taste

                                    How to Choose the Right Water Purifier
                                    Consider:
                                    Household size
                                    Water quality source
                                    Maintenance requirements
                                    Installation space
                                    Filtration technology
                                    Need expert advice?
                                    Visit:
                                    → Water Purifier Products
                                    → PurePro Systems
                                    → Contact Us
                                    CTA
                                    Need cleaner drinking water for your home or office?
                                    👉 Explore Water Purifier Solutions Today

                                </div>

                                <div class="mt-3">

                                    CTA
                                    Need help selecting the right system? <br>
                                    👉 Contact Sunhour Specialists Today

                                </div>
                            </div>

                        </div>

                        {{-- RIGHT --}}
                        <div class="space-y-6">

                            <div class="rounded-3xl bg-white border border-slate-100 shadow-sm p-6 space-y-5">

                                <h3 class="text-base font-bold text-gray-900">
                                    Product Info
                                </h3>

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
                                <p class="text-blue-100 text-sm mt-2">
                                    Contact our team anytime.
                                </p>

                                <a href="tel:012818189" class="block mt-4 font-semibold">
                                    📞 012 818 189
                                </a>

                                <a href="mailto:ssl@sunhour.com" class="block mt-2 font-semibold">
                                    ✉️ ssl@sunhour.com
                                </a>
                            </div>

                            <a href="{{ url('/en/events') }}"
                            class="block text-center border border-slate-200 hover:border-slate-400 text-slate-600 py-3 rounded-2xl">
                                ← Back to Events
                            </a>

                        </div>

                    </div>
                </div>

            </div>

            {{-- FOOTER (FIXED - NOT ABSOLUTE) --}}
            <footer class="bg-black py-3 text-center">
                <p class="text-white text-xs">
                    © Copyright 2024 SUNHOUR GROUP
                </p>
            </footer>

        </div>
    </div>
@endsection
