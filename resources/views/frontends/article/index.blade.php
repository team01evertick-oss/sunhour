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

    <div class="min-h-screen bg-[#f5f6fb] pt-28 pb-16 md:pt-32">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center">
                <span class="inline-flex rounded-full bg-[#e6ebff] px-4 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-[#4048a8]">
                    {{ __('Article Categories') }}
                </span>
                <h1 class="mt-4 text-3xl font-bold text-[#343ca3] md:text-5xl">
                    {{ __('Choose a Category') }}
                </h1>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($categories as $category)
                    @php
                        $categoryName = app()->getLocale() === 'en'
                            ? $category->category
                            : (app()->getLocale() === 'km'
                                ? ($category->category_kh ?: $category->category)
                                : ($category->category_cn ?: $category->category));
                    @endphp

                    <article class="overflow-hidden rounded-[28px] bg-white shadow-[0_20px_40px_rgba(15,23,42,0.08)]">
                        <div class="h-52 overflow-hidden bg-gray-100">
                            <img src="{{ asset('uploads/articles/' . $category->photo) }}"
                                alt="{{ $categoryName }}"
                                class="h-full w-full object-cover">
                        </div>

                        <div class="p-6">
                            <h2 class="text-2xl font-bold text-[#251fa3]">
                                {{ $categoryName }}
                            </h2>

                            <a href="{{ route('articles.show', ['locale' => app()->getLocale(), 'categorySlug' => $category->category_slug]) }}"
                                class="mt-5 inline-flex items-center justify-center rounded-full bg-[#4748a8] px-5 py-2 text-sm font-semibold text-black border-1 border transition hover:bg-[#37388c]">
                                {{ __('View List') }}
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
@endsection
