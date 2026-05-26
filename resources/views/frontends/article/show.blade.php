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

    @php
        $categoryName = app()->getLocale() === 'en'
            ? $article->category
            : (app()->getLocale() === 'km'
                ? ($article->category_kh ?: $article->category)
                : ($article->category_cn ?: $article->category));
    @endphp

    <div class="min-h-screen bg-[#f6f7fb] pt-28 pb-16 md:pt-32">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-10 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                <div>
                    <span class="inline-flex rounded-full bg-[#e6ebff] px-4 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-[#4048a8]">
                        {{ __('Category Name') }}
                    </span>
                    <h1 class="mt-4 text-3xl font-bold text-[#343ca3] md:text-5xl">
                        {{ $categoryName }}
                    </h1>
                </div>

                <a href="{{ route('articles.index', ['locale' => app()->getLocale()]) }}"
                    class="inline-flex items-center justify-center rounded-full border border-[#4b55b6] px-5 py-2 text-sm font-semibold text-[#4b55b6] transition hover:bg-[#4b55b6] hover:text-white">
                    {{ __('Back To Categories') }}
                </a>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($articles as $item)
                    @php
                        $subcategoryName = app()->getLocale() === 'en'
                            ? ($item->subcategory ?: $item->title)
                            : (app()->getLocale() === 'km'
                                ? ($item->subcategory_kh ?: $item->subcategory ?: $item->title_kh ?: $item->title)
                                : ($item->subcategory_cn ?: $item->subcategory ?: $item->title_cn ?: $item->title));
                    @endphp

                    <article class="overflow-hidden rounded-[28px] bg-white shadow-[0_20px_40px_rgba(15,23,42,0.08)]">
                        <div class="h-56 overflow-hidden bg-gray-100">
                            <img src="{{ asset('uploads/articles/' . $item->photo) }}"
                                alt="{{ $subcategoryName }}"
                                class="h-full w-full object-cover">
                        </div>

                        <div class="p-6">
                            <h2 class="text-xl font-bold text-[#251fa3]">
                                {{ $subcategoryName }}
                            </h2>

                            <a href="{{ route('articles.details', ['locale' => app()->getLocale(), 'categorySlug' => $item->category_slug, 'slug' => $item->slug]) }}"
                                class="mt-5 inline-flex items-center justify-center rounded-full bg-[#4748a8] px-5 py-2 text-sm font-semibold text-white border-1 border transition hover:bg-[#37388c]">
                                {{ __('View Details') }}
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
@endsection
