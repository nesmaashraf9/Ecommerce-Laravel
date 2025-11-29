@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <!-- Blog Section Start -->
                <section class="blog-section py-8 px-4">
                    <div class="container mx-auto">
                        <div class="flex flex-col md:flex-row gap-8">
                            <div class="w-full md:w-2/3">
                                <div class="blog-posts">
                                    <div class="section-title mb-8">
                                        <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ $pageTitle ?? 'Our Blog' }}</h2>
                                        <p class="text-gray-600">{{ $pageDescription ?? 'Latest news and updates' }}</p>
                                    </div>

                                    <!-- Blog Post Item -->
                                    <div class="blog-post-item bg-white rounded-lg shadow-md overflow-hidden mb-8">
                                        <div class="post-thumbnail">
                                            <img src="{{ asset('images/blog/blog-1.jpg') }}" alt="Blog Post" class="w-full h-64 object-cover">
                                        </div>
                                        <div class="p-6">
                                            <h3 class="text-xl font-semibold mb-2"><a href="#" class="hover:text-blue-600 transition">Latest Trends in 2023</a></h3>
                                            <div class="post-meta text-sm text-gray-500 mb-3">
                                                <span class="mr-4"><i class="far fa-calendar-alt mr-1"></i> November 4, 2023</span>
                                                <span><i class="far fa-folder mr-1"></i> <a href="#" class="hover:text-blue-600">Fashion</a></span>
                                            </div>
                                            <p class="text-gray-700 mb-4">Discover the latest fashion and technology trends for 2023. Stay ahead of the curve with our expert insights and recommendations.</p>
                                            <a href="#" class="text-blue-600 font-medium hover:text-blue-800 inline-flex items-center">
                                                Read More <i class="fas fa-arrow-right ml-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sidebar -->
                            <div class="w-full md:w-1/3">
                                <div class="space-y-6">
                                    <!-- Categories Widget -->
                                    <div class="bg-white p-6 rounded-lg shadow-md">
                                        <h3 class="text-lg font-semibold mb-4 pb-2 border-b">Categories</h3>
                                        <ul class="space-y-2">
                                            @foreach($categories ?? [] as $category)
                                            <li>
                                                <a href="{{ route('blog.category', $category['slug'] ?? '#') }}" class="flex justify-between items-center py-2 px-3 rounded hover:bg-gray-50">
                                                    <span>{{ $category['name'] ?? 'Category' }}</span>
                                                    <span class="bg-gray-100 text-xs px-2 py-1 rounded-full">{{ $category['count'] ?? 0 }}</span>
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <!-- Recent Posts Widget -->
                                    <div class="bg-white p-6 rounded-lg shadow-md">
                                        <h3 class="text-lg font-semibold mb-4 pb-2 border-b">Recent Posts</h3>
                                        <div class="space-y-4">
                                            @foreach($recentPosts ?? [] as $post)
                                            <div class="flex items-start space-x-3">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ asset('images/blog/thumb-1.jpg') }}" alt="{{ $post['title'] ?? 'Post' }}" class="w-16 h-16 object-cover rounded">
                                                </div>
                                                <div>
                                                    <h4 class="font-medium text-gray-900 hover:text-blue-600">
                                                        <a href="#">{{ $post['title'] ?? 'Post Title' }}</a>
                                                    </h4>
                                                    <span class="text-xs text-gray-500">Nov 4, 2023</span>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Blog Section End -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.blog-section {
    padding: 80px 0;
}

.blog-post-item {
    margin-bottom: 50px;
    background: #fff;
    border-radius: 5px;
    overflow: hidden;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
}

.post-thumbnail img {
    width: 100%;
    height: auto;
    transition: transform 0.3s ease;
}

.blog-post-item:hover .post-thumbnail img {
    transform: scale(1.05);
}

.post-content {
    padding: 30px;
}

.post-content h3 {
    margin-bottom: 15px;
    font-size: 24px;
}

.post-content h3 a {
    color: #333;
    transition: color 0.3s ease;
}

.post-content h3 a:hover {
    color: #f7444e;
    text-decoration: none;
}

.post-meta {
    margin-bottom: 15px;
    color: #777;
    font-size: 14px;
}

.post-meta span {
    margin-right: 15px;
}

.post-meta i {
    margin-right: 5px;
    color: #f7444e;
}

.read-more {
    color: #f7444e;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 14px;
    letter-spacing: 1px;
}

.read-more i {
    margin-left: 5px;
    transition: transform 0.3s ease;
}

.read-more:hover i {
    transform: translateX(5px);
}

/* Widget Styles */
.widget {
    margin-bottom: 40px;
    padding: 30px;
    background: #fff;
    border-radius: 5px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
}

.widget-title {
    position: relative;
    margin-bottom: 25px;
    padding-bottom: 15px;
    font-size: 20px;
    font-weight: 700;
}

.widget-title:after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 50px;
    height: 2px;
    background: #f7444e;
}

/* Categories Widget */
.categories-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.categories-list li {
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.categories-list li:last-child {
    border-bottom: none;
}

.categories-list a {
    color: #555;
    display: flex;
    justify-content: space-between;
    transition: color 0.3s ease, padding-left 0.3s ease;
}

.categories-list a:hover {
    color: #f7444e;
    padding-left: 5px;
    text-decoration: none;
}

.categories-list span {
    color: #999;
}

/* Recent Posts Widget */
.recent-posts-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.recent-posts-list li {
    display: flex;
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}

.recent-posts-list li:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}

.post-thumb {
    width: 80px;
    margin-right: 15px;
    flex-shrink: 0;
}

.post-thumb img {
    width: 100%;
    border-radius: 4px;
}

.post-info h4 {
    margin-bottom: 5px;
    font-size: 15px;
    line-height: 1.4;
}

.post-info h4 a {
    color: #333;
    transition: color 0.3s ease;
}

.post-info h4 a:hover {
    color: #f7444e;
    text-decoration: none;
}

.post-info span {
    font-size: 13px;
    color: #999;
}

/* Responsive */
@media (max-width: 991px) {
    .blog-section {
        padding: 60px 0;
    }
    
    .post-content {
        padding: 20px;
    }
    
    .widget {
        padding: 20px;
    }
}

@media (max-width: 767px) {
    .blog-section {
        padding: 40px 0;
    }
    
    .blog-post-item {
        margin-bottom: 30px;
    }
    
    .post-content h3 {
        font-size: 20px;
    }
}
</style>
@endpush
