@extends('layouts.app')

@section('content')
<!-- Blog Category Section Start -->
<section class="blog-category-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-header">
                    <h1 class="page-title">{{ $pageTitle }}</h1>
                    <p class="page-description">{{ $pageDescription }}</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="category-posts">
                    @foreach($recentPosts as $post)
                    <article class="blog-post">
                        <div class="post-thumbnail">
                            <a href="#">
                                <img src="{{ asset('images/blog/category-' . strtolower($category) . '.jpg') }}" alt="{{ $post['title'] }}" class="img-fluid">
                            </a>
                        </div>
                        <div class="post-content">
                            <div class="post-meta">
                                <span class="post-date">
                                    <i class="fa fa-calendar"></i> November 4, 2023
                                </span>
                                <span class="post-category">
                                    <i class="fa fa-folder"></i> {{ $category }}
                                </span>
                            </div>
                            <h2 class="post-title">
                                <a href="#">{{ $post['title'] }}</a>
                            </h2>
                            <div class="post-excerpt">
                                <p>{{ $post['excerpt'] }}</p>
                            </div>
                            <a href="#" class="read-more">Continue Reading <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-4">
                <div class="sidebar">
                    <!-- Search Widget -->
                    <div class="widget search-widget">
                        <h3 class="widget-title">Search</h3>
                        <form action="#" method="get" class="search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>

                    <!-- Popular Tags Widget -->
                    <div class="widget tags-widget">
                        <h3 class="widget-title">Popular Tags</h3>
                        <div class="tags">
                            <a href="#">{{ $category }}</a>
                            <a href="#">trending</a>
                            <a href="#">fashion</a>
                            <a href="#">lifestyle</a>
                            <a href="#">technology</a>
                            <a href="#">design</a>
                        </div>
                    </div>

                    <!-- Recent Posts Widget -->
                    <div class="widget recent-posts">
                        <h3 class="widget-title">Recent Posts</h3>
                        <ul class="recent-posts-list">
                            @foreach($recentPosts as $post)
                            <li>
                                <div class="post-thumb">
                                    <a href="#">
                                        <img src="{{ asset('images/blog/thumb-1.jpg') }}" alt="{{ $post['title'] }}">
                                    </a>
                                </div>
                                <div class="post-info">
                                    <h4><a href="#">{{ $post['title'] }}</a></h4>
                                    <span>Nov 4, 2023</span>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Category Section End -->
@endsection

@push('styles')
<style>
.blog-category-section {
    padding: 80px 0;
}

.page-header {
    text-align: center;
    margin-bottom: 50px;
}

.page-title {
    font-size: 36px;
    margin-bottom: 15px;
    color: #333;
}

.page-description {
    color: #777;
    font-size: 18px;
}

.blog-post {
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

.blog-post:hover .post-thumbnail img {
    transform: scale(1.05);
}

.post-content {
    padding: 30px;
}

.post-meta {
    margin-bottom: 15px;
    color: #777;
    font-size: 14px;
}

.post-meta span {
    margin-right: 20px;
}

.post-meta i {
    margin-right: 5px;
    color: #f7444e;
}

.post-title {
    margin-bottom: 15px;
    font-size: 24px;
}

.post-title a {
    color: #333;
    transition: color 0.3s ease;
}

.post-title a:hover {
    color: #f7444e;
    text-decoration: none;
}

.post-excerpt {
    margin-bottom: 20px;
    color: #555;
    line-height: 1.7;
}

.read-more {
    color: #f7444e;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 14px;
    letter-spacing: 1px;
    display: inline-block;
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

/* Search Widget */
.search-form {
    position: relative;
}

.search-form .form-control {
    width: 100%;
    padding: 12px 50px 12px 15px;
    border: 1px solid #eee;
    border-radius: 4px;
    box-shadow: none;
}

.search-form button {
    position: absolute;
    right: 0;
    top: 0;
    width: 45px;
    height: 100%;
    background: none;
    border: none;
    color: #f7444e;
    font-size: 16px;
}

/* Tags Widget */
.tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.tags a {
    display: inline-block;
    padding: 6px 15px;
    background: #f8f9fa;
    color: #555;
    font-size: 13px;
    border-radius: 30px;
    transition: all 0.3s ease;
}

.tags a:hover {
    background: #f7444e;
    color: #fff;
    text-decoration: none;
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
    .blog-category-section {
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
    .blog-category-section {
        padding: 40px 0;
    }
    
    .page-title {
        font-size: 28px;
    }
    
    .post-title {
        font-size: 20px;
    }
}
</style>
@endpush
