@extends('site-layout')

@section('meta-title', 'Blog')

@section('meta-description', 'Here you will find the latest news and updates about us.')

@section('bodyEndScripts')
    @vite('resources-site/js/blog-app.js')
@endsection

@section('content')
    <blog-toolbar :archive-options="{{ json_encode($archiveOptions) }}" :tags="{{ json_encode($tags) }}"></blog-toolbar>

    <div class="py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <!-- Section Title -->
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-skin-neutral-11 text-3xl font-bold tracking-tight sm:text-4xl">
                    Blog
                </h2>

                <p class="text-skin-neutral-12 mt-2 text-lg leading-8">
                    @if (isset($fromArchive))
                        Posts from archive:
                        <span class="font-semibold">{{ $fromArchive }}</span>
                    @elseif (isset($fromTag))
                        Posts tagged with:
                        <span class="font-semibold">{{ $fromTag }}</span>
                    @elseif (isset($fromSearch))
                        Posts matching:
                        <span class="font-semibold">{{ $fromSearch }}</span>
                    @else
                        <span>
                            Here you will find the latest news and updates about
                            us.
                        </span>
                    @endif
                </p>
            </div>

            @if ($posts->count())
                <!-- Posts -->
                <div
                    class="mx-auto mt-16 grid max-w-sm grid-cols-1 gap-x-8 gap-y-16 md:max-w-2xl md:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                    @foreach ($posts as $post)
                        <article class="bg-skin-neutral-11 rounded">
                            <a href="/blog/{{ $post->slug }}"
                                class="text-skin-neutral-2 hover:bg-skin-neutral-12 hover:text-skin-neutral-1 flex flex-col items-start justify-between px-6 py-6 transition-all duration-300 ease-out">
                                <header class="relative w-full">
                                    @if ($post->image_url)
                                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}"
                                            class="aspect-[16/9] w-full rounded-2xl object-cover sm:aspect-[2/1] lg:aspect-[3/2]" />
                                    @else
                                        <div
                                            class="from-skin-neutral-1 to-skin-neutral-6 flex aspect-[16/9] w-full items-center justify-center rounded-2xl bg-gradient-to-bl sm:aspect-[2/1] lg:aspect-[3/2]">
                                            <span class="text-skin-neutral-9 text-lg">
                                                N/A
                                            </span>
                                        </div>
                                    @endif
                                    <div class="ring-skin-neutral-10/10 absolute inset-0 rounded-2xl ring-1 ring-inset">
                                    </div>
                                </header>
                                <div class="max-w-xl">
                                    <div class="mt-8 flex items-center gap-2 text-xs">
                                        <div class="flex items-center gap-1 italic">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                class="h-3 w-3">
                                                <path
                                                    d="M17 3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2 3 3 3H7V1H9V3H15V1H17V3ZM4 9V19H20V9H4ZM6 11H8V13H6V11ZM11 11H13V13H11V11ZM16 11H18V13H16V11Z">
                                                </path>
                                            </svg>
                                            {{ $post->published_at->format('F d, Y') }}
                                        </div>
                                        <div class="flex items-center gap-1 italic">
                                            @if ($post->author)
                                                @if ($post->author->image_url)
                                                    <img src="{{ $post->author->image_url }}"
                                                        alt="{{ $post->author->name }}"
                                                        class="bg-skin-neutral-2 h-4 w-4 rounded-md object-cover" />
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="h-4 w-4">
                                                        <path
                                                            d="M4 22C4 17.5817 7.58172 14 12 14C16.4183 14 20 17.5817 20 22H4ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13Z">
                                                        </path>
                                                    </svg>
                                                @endif
                                                {{ $post->author->name }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="group relative mb-2">
                                        <h3 class="mt-3 mb-2 min-h-12 text-lg leading-6 font-semibold">
                                            <span class="absolute inset-0"></span>
                                            {{ $post->title }}
                                        </h3>
                                        <div class="line-clamp-3 min-h-20 text-sm leading-6">
                                            {!! $post->summary !!}
                                        </div>
                                    </div>
                                    @if ($post->tags->count())
                                        <footer class="mt-4 min-h-[44px]">
                                            @foreach ($post->tags as $tag)
                                                <a href="/blog/tag/{{ $tag->slug }}"
                                                    class="bg-skin-neutral-1 mr-2 inline-block rounded px-3 py-1.5 text-sm">
                                                    {{ $tag->name }}
                                                </a>
                                            @endforeach
                                        </footer>
                                    @endif
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            @else
                <p class="bg-skin-neutral-3 text-skin-neutral-9 mt-2 rounded px-4 py-2">
                    No posts found.
                </p>
            @endif

            <div class="mt-12">
                {{ $posts->links('pagination.tailwind') }}
            </div>
        </div>
    </div>
@endsection
