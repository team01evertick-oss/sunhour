@extends('layouts.guest')

@php
    use Artesaos\SEOTools\Facades\SEOTools;
@endphp

@section('meta_tag')
    {!! SEOTools::generate() !!}
@endsection

@section('content')

    {{-- Navbar --}}
    @component('components.navbar')
    @endcomponent

    <div class="my-2 p-0 h-screen overflow-x-hidden scroll-smooth">
        <div class="relative mt-16 min-h-screen bg-gradient-to-b from-slate-50 via-white to-slate-100">

            <section class="relative py-20 lg:py-30">

                {{-- Heading --}}
                <div class="text-center mb-20">
                    <p class="text-sm uppercase tracking-[6px] text-blue-600 font-semibold">
                        Featured at the Event
                    </p>

                    <h2 class="text-4xl lg:text-4xl font-black tracking-tight text-gray-900 mt-4 leading-tight">
                        Products on Display
                    </h2>
                </div>

                {{-- Cards --}}
                <div class="container mx-auto px-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-10">

                        {{-- CARD 1 --}}
                        <div class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 to-slate-800 p-8 text-white shadow-xl border border-white/10 hover:-translate-y-4 hover:scale-[1.02] transition-all duration-500 ease-out">

                            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-700">
                                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                            </div>

                            <div class="relative z-10">
                                {{-- <div class="w-16 h-16 rounded-2xl bg-white/10 flex items-center justify-center text-2xl font-bold mb-6">
                                    P
                                </div> --}}

                                <span class="text-sm uppercase tracking-[3px] text-blue-300">
                                    Purepro Collection
                                </span>

                                <h3 class="text-2xl font-bold mt-8 mb-4">
                                    Water Purification Authority Hub
                                </h3>

                                <p class="text-gray-300 leading-relaxed mb-8">
                                    The Water Purification Authority Hub is a comprehensive resource center providing expert insights, guides, and solutions about water purification systems in Cambodia.       
                                </p>

                                    <a href="">
                                        Explore →
                                    </a>                                   
                                </a>
                            
                            </div>
                        </div>

                        {{-- CARD 2 --}}
                        <div class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-cyan-700 to-sky-900 p-8 text-white shadow-xl border border-white/10 hover:-translate-y-4 hover:scale-[1.02] transition-all duration-500 ease-out">

                            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-700">
                                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                            </div>

                            <div class="relative z-10">
                                <div class="w-16 h-16 rounded-2xl bg-white/10 flex items-center justify-center text-2xl font-bold mb-6">
                                    P
                                </div>

                                <span class="text-sm uppercase tracking-[3px] text-cyan-200">
                                    PurePro Series
                                </span>

                                <h3 class="text-2xl font-bold mt-3 mb-4">
                                    RO Water Purifier
                                </h3>

                                <p class="text-gray-100 leading-relaxed mb-8">
                                    Multi-stage reverse osmosis filtration for the cleanest drinking water.
                                </p>

                                <a href="#" class="inline-flex items-center gap-2 text-white font-semibold group-hover:gap-4 transition-all duration-300">
                                    Explore →
                                </a>
                            </div>
                        </div>

                        {{-- CARD 3 --}}
                        <div class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-orange-500 to-red-600 p-8 text-white shadow-xl border border-white/10 hover:-translate-y-4 hover:scale-[1.02] transition-all duration-500 ease-out">

                            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-700">
                                <div class="absolute top-0 left-0 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                            </div>

                            <div class="relative z-10">
                                <span class="inline-block px-4 py-1 rounded-full bg-white/20 text-xs font-semibold uppercase tracking-[2px] mb-5">
                                    Featured
                                </span>

                                <div class="w-16 h-16 rounded-2xl bg-white/10 flex items-center justify-center text-2xl font-bold mb-6">
                                    H
                                </div>

                                <span class="text-sm uppercase tracking-[3px] text-orange-100">
                                    Energy Solutions
                                </span>

                                <h3 class="text-2xl font-bold mt-3 mb-4">
                                    Heat Pump Heater
                                </h3>

                                <p class="text-orange-50 leading-relaxed mb-8">
                                    Save up to 70% on heating costs with advanced heat pump technology.
                                </p>

                                <a href="#" class="inline-flex items-center gap-2 text-white font-semibold group-hover:gap-4 transition-all duration-300">
                                    Explore →
                                </a>
                            </div>
                        </div>

                        {{-- CARD 4 --}}
                        <div class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-zinc-900 to-black p-8 text-white shadow-xl border border-white/10 hover:-translate-y-4 hover:scale-[1.02] transition-all duration-500 ease-out">

                            <div class="relative z-10">
                                <div class="w-16 h-16 rounded-2xl bg-white/10 flex items-center justify-center text-2xl font-bold mb-6">
                                    S
                                </div>

                                <span class="text-sm uppercase tracking-[3px] text-gray-300">
                                    Home Shower
                                </span>

                                <h3 class="text-2xl font-bold mt-3 mb-4">
                                    Rain Shower System
                                </h3>

                                <p class="text-gray-300 leading-relaxed mb-8">
                                    Thermostatic precision control with luxury rain shower for the ultimate experience.
                                </p>

                                <a href="#" class="inline-flex items-center gap-2 text-gray-100 font-semibold group-hover:gap-4 transition-all duration-300">
                                    Explore →
                                </a>
                            </div>
                        </div>

                        {{-- CARD 5 --}}
                        <div class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-blue-700 to-indigo-900 p-8 text-white shadow-xl border border-white/10 hover:-translate-y-4 hover:scale-[1.02] transition-all duration-500 ease-out">

                            <div class="relative z-10">
                                <div class="w-16 h-16 rounded-2xl bg-white/10 flex items-center justify-center text-2xl font-bold mb-6">
                                    W
                                </div>

                                <span class="text-sm uppercase tracking-[3px] text-blue-200">
                                    Water System
                                </span>

                                <h3 class="text-2xl font-bold mt-3 mb-4">
                                    Booster Pump
                                </h3>

                                <p class="text-gray-200 leading-relaxed mb-8">
                                    Professional water pressure solutions for multi-story buildings and hotels.
                                </p>

                                <a href="#" class="inline-flex items-center gap-2 text-white font-semibold group-hover:gap-4 transition-all duration-300">
                                    Explore →
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

            </section>
            

        </div>

        <footer class="absolute inset-x-0 bottom-0 bg-black py-1 z-[50]">
            <p class="text-white text-[12px] text-center"> © Copyright 2024 SUNHOUR GROUP, All Rights Reserved</p>
        </footer>
    </div>

@endsection