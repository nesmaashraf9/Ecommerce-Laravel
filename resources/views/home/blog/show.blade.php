@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <!-- Blog Post -->
                <article class="blog-post">
                    <header class="mb-8">
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $post['title'] }}</h1>
                        <div class="text-gray-500 text-sm mb-4">
                            <span class="mr-4"><i class="far fa-calendar-alt mr-1"></i> {{ $post['created_at']->format('F j, Y') }}</span>
                            <span><i class="far fa-folder mr-1"></i> 
                                <a href="{{ route('blog.category', $post['category']) }}" class="hover:text-blue-600">
                                    {{ ucfirst($post['category']) }}
                                </a>
                            </span>
                        </div>
                        <div class="post-thumbnail mb-6">
                            <img src="{{ asset('images/blog/' . $post['image']) }}" alt="{{ $post['title'] }}" class="w-full h-auto rounded-lg">
                        </div>
                    </header>

                    <div class="prose max-w-none">
                        {!! $post['content'] !!}
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Admin&background=4f46e5&color=fff" alt="">
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Admin</p>
                                <div class="flex space-x-1 text-sm text-gray-500">
                                    <p>Published on {{ $post['created_at']->format('F j, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Related Posts -->
                <div class="mt-12">
                    <h3 class="text-xl font-semibold mb-6 pb-2 border-b">You Might Also Like</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($recentPosts as $related)
                            @if($related['id'] !== $post['id'])
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                <div class="h-48 overflow-hidden">
                                    <img src="{{ asset('images/blog/' . $related['image']) }}" alt="{{ $related['title'] }}" class="w-full h-full object-cover">
                                </div>
                                <div class="p-4">
                                    <h4 class="font-medium text-gray-900 hover:text-blue-600 mb-2">
                                        <a href="{{ route('blog.show', $related['slug']) }}">{{ $related['title'] }}</a>
                                    </h4>
                                    <p class="text-sm text-gray-600 line-clamp-2">{{ $related['excerpt'] }}</p>
                                    <a href="{{ route('blog.show', $related['slug']) }}" class="mt-3 inline-block text-sm text-blue-600 hover:text-blue-800 font-medium">
                                        Read more <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.prose {
    color: #374151;
    line-height: 1.75;
}

.prose p {
    margin-top: 1.25em;
    margin-bottom: 1.25em;
}

.prose img {
    margin-top: 2em;
    margin-bottom: 2em;
    border-radius: 0.5rem;
    width: 100%;
    height: auto;
}

.prose h2 {
    color: #111827;
    font-weight: 600;
    font-size: 1.5em;
    margin-top: 2em;
    margin-bottom: 1em;
    line-height: 1.3;
}

.prose h3 {
    color: #111827;
    font-weight: 600;
    font-size: 1.25em;
    margin-top: 1.6em;
    margin-bottom: 0.6em;
    line-height: 1.6;
}

.prose a {
    color: #2563eb;
    text-decoration: none;
    font-weight: 500;
}

.prose a:hover {
    text-decoration: underline;
}

.prose ul, .prose ol {
    margin-top: 1.25em;
    margin-bottom: 1.25em;
    padding-left: 1.625em;
}

.prose li {
    margin-top: 0.5em;
    margin-bottom: 0.5em;
}

.prose blockquote {
    font-weight: 500;
    font-style: italic;
    color: #111827;
    border-left-width: 0.25rem;
    border-left-color: #e5e7eb;
    quotes: "\201C""\201D""\2018""\2019";
    margin-top: 1.6em;
    margin-bottom: 1.6em;
    padding-left: 1em;
}

.prose code {
    color: #111827;
    font-weight: 600;
    font-size: 0.875em;
}

.prose pre {
    color: #e5e7eb;
    background-color: #1f2937;
    overflow-x: auto;
    font-size: 0.875em;
    line-height: 1.7142857;
    margin-top: 1.7142857em;
    margin-bottom: 1.7142857em;
    border-radius: 0.375rem;
    padding: 0.8571429em 1.1428571em;
}

.prose pre code {
    background-color: transparent;
    border-width: 0;
    border-radius: 0;
    padding: 0;
    font-weight: 400;
    color: inherit;
    font-size: inherit;
    font-family: inherit;
    line-height: inherit;
}

.prose pre code::before {
    content: none;
}

.prose pre code::after {
    content: none;
}

.prose table {
    width: 100%;
    table-layout: auto;
    text-align: left;
    margin-top: 2em;
    margin-bottom: 2em;
    font-size: 0.875em;
    line-height: 1.7142857;
}

.prose thead {
    color: #111827;
    font-weight: 600;
    border-bottom-width: 1px;
    border-bottom-color: #d1d5db;
}

.prose thead th {
    vertical-align: bottom;
    padding-right: 0.5714286em;
    padding-bottom: 0.5714286em;
    padding-left: 0.5714286em;
}

.prose tbody tr {
    border-bottom-width: 1px;
    border-bottom-color: #e5e7eb;
}

.prose tbody tr:last-child {
    border-bottom-width: 0;
}

.prose tbody td {
    vertical-align: top;
    padding: 0.5714286em;
}
</style>
@endpush
