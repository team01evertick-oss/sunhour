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

    <div class="min-h-screen bg-whitephp pt-24 pb-16 md:pt-28">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            @php
                $articleTitle = app()->getLocale() === 'en'
                    ? $article->title
                    : (app()->getLocale() === 'km'
                        ? $article->title_kh
                        : $article->title_cn);

                $articleSubtitle = app()->getLocale() === 'en'
                    ? $article->subtitle
                    : (app()->getLocale() === 'km'
                        ? $article->subtitle_kh
                        : $article->subtitle_cn);

                $categoryName = app()->getLocale() === 'en'
                    ? $article->category
                    : (app()->getLocale() === 'km'
                        ? ($article->category_kh ?: $article->category)
                        : ($article->category_cn ?: $article->category));

                $subcategoryName = app()->getLocale() === 'en'
                    ? ($article->subcategory ?: $article->title)
                    : (app()->getLocale() === 'km'
                        ? ($article->subcategory_kh ?: $article->subcategory ?: $article->title_kh ?: $article->title)
                        : ($article->subcategory_cn ?: $article->subcategory ?: $article->title_cn ?: $article->title));

                $articleContent = app()->getLocale() === 'en'
                    ? $article->content
                    : (app()->getLocale() === 'km'
                        ? $article->content_kh
                        : $article->content_cn);
            @endphp

            <div class="mb-6 flex flex-wrap justify-end gap-2">
                <button type="button" onclick="window.history.back()"
                    class="inline-flex items-center justify-center rounded-full border border-gray-300 px-5 py-1.5 text-xs font-semibold text-gray-600 transition hover:bg-gray-50">
                    {{ __('Back') }}
                </button>
                <a href="{{ route('articles.index', ['locale' => app()->getLocale()]) }}"
                    class="inline-flex items-center justify-center rounded-full bg-[#4748a8] px-5 py-1.5 text-xs font-semibold text-white transition hover:bg-[#37388c]">
                    {{ __('View List') }}
                </a>
                <a href="{{ route('articles.show', ['locale' => app()->getLocale(), 'categorySlug' => $article->category_slug]) }}"
                    class="inline-flex items-center justify-center rounded-full border border-gray-300 px-5 py-1.5 text-xs font-semibold text-gray-600 transition hover:bg-gray-50">
                    {{ __('Back To Subcategories') }}
                </a>
            </div>

            <div class="mx-auto mb-8 max-w-2xl overflow-hidden rounded-[24px] sm:rounded-[36px]">
                <img src="{{ asset('uploads/articles/' . $article->photo) }}" alt="{{ $article->title }}"
                    class="block h-[180px] w-full object-cover md:h-[240px]">
            </div>

            <header class="mb-6 text-left">
                <div class="mb-3 flex flex-wrap gap-2">
                    <span class="rounded-full bg-[#e6ebff] px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-[#4048a8]">
                        {{ $categoryName }}
                    </span>
                    <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-gray-600">
                        {{ $subcategoryName }}
                    </span>
                </div>

                <h1 class="text-3xl font-bold tracking-tight text-[#251fa3] md:text-4xl">
                    {{ $articleTitle }}
                </h1>

                @if (!empty($articleSubtitle))
                    <p class="mt-3 text-sm font-medium uppercase tracking-wide text-gray-400">
                        {{ $articleSubtitle }}
                    </p>
                @endif
            </header>

            <div class="mb-6 border-b border-gray-100"></div>

            @if (!empty($articleContent))
                <div class="mb-8 rounded-[20px] bg-[#f8f9fc] p-5 text-left">
                    <h2 class="mb-3 text-lg font-semibold text-[#251fa3]">
                        {{ __('Article Content') }}
                    </h2>
                    <div class="text-[14px] leading-relaxed text-gray-700">
                        {!! nl2br(e($articleContent)) !!}
                    </div>
                </div>
            @endif

            <div
                class="prose max-w-none text-left
                        prose-p:mb-5 prose-p:text-[14px] prose-p:leading-relaxed prose-p:text-gray-700
                        prose-headings:mb-2 prose-headings:mt-6 prose-headings:text-[15px] prose-headings:font-bold prose-headings:text-gray-900
                        prose-ul:mb-5 prose-ul:list-disc prose-ul:pl-5 prose-ul:text-[14px] prose-ul:text-gray-700
                        prose-li:my-1">
                {!! app()->getLocale() === 'en'
                    ? $article->description
                    : (app()->getLocale() === 'km'
                        ? $article->description_kh
                        : $article->description_cn) !!}
            </div>
        </div>
    </div>
@endsection
