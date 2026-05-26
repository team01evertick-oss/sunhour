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

    <div class="min-h-screen overflow-x-hidden bg-[#f3f3f3]">

        <section class="pt-28 pb-20 md:pt-36">

            <div class="mx-auto max-w-[1400px] px-5 sm:px-8 lg:px-10">

                {{-- Title --}}
                <div class="mb-20 text-center">
                    <h2 class="text-4xl font-bold tracking-wide text-[#5c85ff] md:text-5xl">
                        EVENTS
                    </h2>
                </div>

                {{-- Events --}}
                <div class="space-y-24">

                    @forelse ($events as $index => $event)
                        <article class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2">

                            {{-- LEFT IMAGE --}}
                            <div class="{{ $index % 2 != 0 ? 'lg:order-2' : '' }}">

                                <a href="{{ route('eventPage.show', ['slug' => $event['slug']]) }}"
                                    class="block overflow-hidden rounded-[24px] bg-[#e5e5e5]">

                                    @if ($event['image'])
                                        <img src="{{ asset('storage/' . $event['image']) }}" alt="{{ $event['title'] }}"
                                            class="h-[260px] w-full object-cover transition duration-500 hover:scale-105 md:h-[360px] lg:h-[420px]">
                                    @else
                                        <div
                                            class="flex h-[260px] items-center justify-center bg-[#e5e5e5] text-sm text-gray-400 md:h-[360px] lg:h-[420px]">
                                            No Image
                                        </div>
                                    @endif

                                </a>

                            </div>

                            {{-- RIGHT CONTENT --}}
                            <div class="{{ $index % 2 != 0 ? 'lg:order-1' : '' }}">

                                <h2 class="text-[28px] font-bold leading-tight text-[#5c85ff] md:text-[42px]">

                                    <a href="{{ route('eventPage.show', ['slug' => $event['slug']]) }}">

                                        {{ $event['title'] }}

                                    </a>

                                </h2>

                                <p class="mt-6 max-w-[650px] text-[18px] leading-10 text-[#161616]/90">

                                    {{ \Illuminate\Support\Str::limit(strip_tags($event['desc'] ?: $event['description']), 220) }}

                                </p>

                                <a href="{{ route('eventPage.show', ['slug' => $event['slug']]) }}"
                                    class="group mt-8 inline-flex items-center gap-3 text-[22px] font-medium text-black transition hover:text-[#5c85ff]">

                                    <span class="text-[28px] transition group-hover:translate-x-1">
                                        →
                                    </span>

                                    <span>Detail</span>

                                </a>

                            </div>

                        </article>

                    @empty

                        <div
                            class="rounded-[24px] border border-dashed border-gray-300 bg-white px-6 py-20 text-center text-gray-500">
                            No events available yet.
                        </div>
                    @endforelse

                </div>

            </div>

        </section>

        {{-- Footer --}}
        <footer class="bg-black py-5">
            <p class="text-center text-[12px] tracking-[0.2em] text-white">
                Copyright 2024 SUNHOUR GROUP, All Rights Reserved
            </p>
        </footer>

    </div>
@endsection
