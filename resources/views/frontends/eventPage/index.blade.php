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

    {{-- PAGE --}}
    <div class="min-h-screen bg-[#f5f5f5] py-20 overflow-hidden">

        <div class="max-w-[1300px] mx-auto px-6 lg:px-10">

            {{-- TITLE --}}
            <div class="text-center my-24">
                <h1 class="text-4xl md:text-5xl font-bold text-[#4f6ef7] tracking-wide">
                    EVENTS
                </h1>
            </div>

            {{-- EVENTS --}}
            <div class="space-y-28">

               @forelse ($events as $event)
    @if ($loop->odd)
        {{-- IMAGE LEFT / TEXT RIGHT --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

            {{-- IMAGE --}}
            <div class="lg:col-span-7 overflow-hidden rounded-[24px]">
                <img src="{{ asset('storage/' . $event['image']) }}" alt="{{ $event['title'] }}"
                     class="w-full h-[400px] object-cover">
            </div>

            {{-- TEXT --}}
            <div class="lg:col-span-5">
                <h2 class="text-2xl md:text-3xl font-semibold text-[#4f6ef7] mb-4">
                    {{ $event['title'] }}
                </h2>

                <p class="text-base md:text-lg leading-relaxed text-[#444] mb-6">
                    {{ \Illuminate\Support\Str::limit(strip_tags($event['desc'] ?: $event['description'] ?? ''), 250) }}
                </p>

                <a href="{{ route('eventPage.show', ['slug' => $event['slug']]) }}"
                   class="inline-flex items-center gap-2 text-base md:text-lg font-medium text-gray-700 hover:text-[#4f6ef7] transition-colors">
                    <span class="text-xl">→</span>
                    <span>Detail</span>
                </a>
            </div>

        </div>
    @else
        {{-- TEXT LEFT / IMAGE RIGHT --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

            {{-- TEXT --}}
            <div class="lg:col-span-5 order-2 lg:order-1">
                <h2 class="text-2xl md:text-3xl font-semibold text-[#4f6ef7] mb-4">
                    {{ $event['title'] }}
                </h2>

                <p class="text-base md:text-lg leading-relaxed text-[#444] mb-6">
                    {{ \Illuminate\Support\Str::limit(strip_tags($event['desc'] ?: $event['description'] ?? ''), 250) }}
                </p>

                <a href="{{ route('eventPage.show', ['slug' => $event['slug']]) }}"
                   class="inline-flex items-center gap-2 text-base md:text-lg font-medium text-gray-700 hover:text-[#4f6ef7] transition-colors">
                    <span class="text-xl">→</span>
                    <span>Detail</span>
                </a>
            </div>

            {{-- IMAGE --}}
            <div class="lg:col-span-7 order-1 lg:order-2 overflow-hidden rounded-[24px]">
                <img src="{{ asset('storage/' . $event['image']) }}" alt="{{ $event['title'] }}"
                     class="w-full h-[400px] object-cover">
            </div>

        </div>
    @endif

@empty
    <div class="text-center py-20">
        No events available yet.
    </div>
@endforelse

            </div>

        </div>

    </div>

    {{-- FOOTER --}}
    <footer class="bg-black py-8">

        <p class="text-center text-white text-sm tracking-wide">
            Copyright © {{ date('Y') }} SUNHOUR GROUP. All Rights Reserved
        </p>

    </footer>
@endsection
