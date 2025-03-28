@extends('site-layout')

@section('meta-title', $post->meta_tag_title)

@section('meta-description', $post->meta_tag_description)

@section('bodyEndScripts')
    @vite('resources-site/js/blog-app.js')
@endsection

@section('content')
    <div class="bg-skin-neutral-2 py-24 sm:py-32">
        <div class="mx-auto max-w-3xl px-6 lg:px-8">
            <article>
                <h2 class="mb-2 mt-4 text-3xl font-bold leading-relaxed tracking-tight text-skin-neutral-11 sm:text-4xl">
                    {{ $post->title }}
                </h2>

                <div class="mb-4 flex items-center gap-2 text-sm">
                    <div class="flex items-center gap-1 italic text-skin-neutral-11">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                            <path
                                d="M17 3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H7V1H9V3H15V1H17V3ZM4 9V19H20V9H4ZM6 11H8V13H6V11ZM11 11H13V13H11V11ZM16 11H18V13H16V11Z">
                            </path>
                        </svg>
                        {{ $post->published_at->format('F d, Y') }}
                    </div>

                    <div class="flex items-center gap-1 italic text-skin-neutral-11">
                        @if ($post->author)
                            @if ($post->author->image_url)
                                <img src="{{ $post->author->image_url }}" alt="{{ $post->author->name }}"
                                    class="h-4 w-4 rounded-md bg-skin-neutral-1 object-cover" />
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="h-4 w-4">
                                    <path
                                        d="M4 22C4 17.5817 7.58172 14 12 14C16.4183 14 20 17.5817 20 22H4ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13Z">
                                    </path>
                                </svg>
                            @endif
                            {{ $post->author->name }}
                        @endif
                    </div>
                </div>

                <div class="relative mb-4 w-full">
                    @if ($post->image_url)
                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}"
                            class="aspect-[16/9] w-full rounded-2xl bg-skin-neutral-1 object-cover sm:aspect-[2/1] lg:aspect-[3/2]" />
                    @endif
                </div>

                <article class="blog-post-content pt-3">
                    {!! $post->content !!}
                </article>
            </article>
        </div>
    </div>
@endsection
