@extends('layouts.guest')

@php
    use Artesaos\SEOTools\Facades\SEOTools;
@endphp

@section('meta_tag')
    {!! SEOTools::generate() !!}
@endsection

@section('content')
    @component('components.navbar')
    @endcomponent

    <div class="min-h-screen overflow-x-hidden bg-white">
        <section class="pt-28 pb-20 md:pt-36">
            <div class="mx-auto max-w-[1100px] px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="overflow-hidden rounded-[10px] bg-[#eef2f7]">
                        @if ($current['image'])
                            <img src="{{ asset('storage/' . $current['image']) }}"
                                alt="{{ $current['title'] }}"
                                class="h-[220px] w-full object-cover md:h-[320px] lg:h-[360px]">
                        @else
                            <div class="flex h-[220px] items-center justify-center text-xs uppercase tracking-[0.28em] text-[#94a3b8] md:h-[320px] lg:h-[360px]">
                                No Image
                            </div>
                        @endif
                    </div>

                    <div class="overflow-hidden rounded-[10px] bg-[#eef2f7]">
                        @if ($current['image'])
                            <img src="{{ asset('storage/' . $current['image']) }}"
                                alt="{{ $current['title'] }}"
                                class="h-[220px] w-full object-cover object-top md:h-[320px] lg:h-[360px]">
                        @else
                            <div class="flex h-[220px] items-center justify-center text-xs uppercase tracking-[0.28em] text-[#94a3b8] md:h-[320px] lg:h-[360px]">
                                No Image
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-4 max-w-[980px]">
                    <h1 class="text-[24px] font-semibold leading-tight text-[#161616] md:text-[34px]">
                        {{ $current['title'] }}
                    </h1>

                    <div class="event-content mt-5 text-[15px] leading-8 text-[#20242c] md:text-[16px]">
                        {!! $current['description'] ?: nl2br(e($current['desc'])) !!}
                    </div>

                    <div class="mt-10">
                        <a href="{{ route('eventPage.index') }}"
                            class="inline-flex items-center gap-2 text-[15px] font-medium text-[#161616] transition hover:text-[#5c85ff]">
                            <span class="text-[18px] leading-none">&larr;</span>
                            <span>Back to Event</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <footer class="bg-black py-2">
            <p class="text-center text-[12px] text-white">Copyright 2024 SUNHOUR GROUP, All Rights Reserved</p>
        </footer>
    </div>

    <style>
        .event-content a {
            color: #2563eb;
            text-decoration: underline;
            text-underline-offset: 3px;
            pointer-events: auto;
            position: relative;
            z-index: 10;
        }

        .event-content a:hover {
            color: #1d4ed8;
        }
    </style>
@endsection
