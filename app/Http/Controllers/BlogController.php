<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    /**
     * Display a listing of the blog posts.
     */
    public function index()
    {
        $recentPosts = [
            [
                'id' => 1,
                'title' => 'Latest Trends in 2023',
                'slug' => 'latest-trends-2023',
                'excerpt' => 'Discover the latest fashion and technology trends for 2023. Stay ahead of the curve with our expert insights and recommendations.',
                'category' => 'fashion',
                'created_at' => now()->subDays(2),
                'image' => 'blog-1.jpg',
                'content' => '<p>Full content of the blog post would go here...</p>'
            ],
            [
                'id' => 2,
                'title' => 'Top 10 Must-Have Items',
                'slug' => 'top-10-must-have-items',
                'excerpt' => 'Check out our curated list of essential items for this season that you should definitely have in your collection.',
                'category' => 'lifestyle',
                'created_at' => now()->subDays(5),
                'image' => 'blog-1.jpg',
                'content' => '<p>Full content of the blog post would go here...</p>'
            ],
            [
                'id' => 3,
                'title' => 'Tech Innovations This Year',
                'slug' => 'tech-innovations-this-year',
                'excerpt' => 'Explore the most exciting technological advancements and innovations that are shaping our future.',
                'category' => 'technology',
                'created_at' => now()->subWeek(),
                'image' => 'blog-1.jpg',
                'content' => '<p>Full content of the blog post would go here...</p>'
            ]
        ];

        $categories = [
            ['name' => 'Technology', 'slug' => 'technology', 'count' => 5],
            ['name' => 'Fashion', 'slug' => 'fashion', 'count' => 3],
            ['name' => 'Lifestyle', 'slug' => 'lifestyle', 'count' => 7],
        ];

        return view('home.blog.index', [
            'recentPosts' => array_slice($recentPosts, 0, 3), // Show only 3 most recent
            'allPosts' => $recentPosts,
            'categories' => $categories,
            'pageTitle' => 'Our Blog',
            'pageDescription' => 'Latest news, trends, and updates from our blog.'
        ]);
    }

    /**
     * Display posts by category.
     */
    public function category($category)
    {
        $allPosts = [
            [
                'id' => 1,
                'title' => 'Latest Trends in 2023',
                'slug' => 'latest-trends-2023',
                'excerpt' => 'Discover the latest fashion and technology trends for 2023.',
                'category' => 'fashion',
                'created_at' => now()->subDays(2),
                'image' => 'blog-1.jpg',
                'content' => '<p>Full content of the blog post would go here...</p>'
            ],
            [
                'id' => 2,
                'title' => 'Top 10 Must-Have Items',
                'slug' => 'top-10-must-have-items',
                'excerpt' => 'Check out our curated list of essential items for this season.',
                'category' => 'lifestyle',
                'created_at' => now()->subDays(5),
                'image' => 'blog-1.jpg',
                'content' => '<p>Full content of the blog post would go here...</p>'
            ],
            [
                'id' => 3,
                'title' => 'Tech Innovations This Year',
                'slug' => 'tech-innovations-this-year',
                'excerpt' => 'Explore the most exciting technological advancements.',
                'category' => 'technology',
                'created_at' => now()->subWeek(),
                'image' => 'blog-1.jpg',
                'content' => '<p>Full content of the blog post would go here...</p>'
            ]
        ];

        $categories = [
            'technology' => 'Technology',
            'fashion' => 'Fashion',
            'lifestyle' => 'Lifestyle'
        ];

        if (!array_key_exists($category, $categories)) {
            abort(404);
        }

        $filteredPosts = array_filter($allPosts, function($post) use ($category) {
            return $post['category'] === $category;
        });

        $allCategories = [
            ['name' => 'Technology', 'slug' => 'technology', 'count' => 5],
            ['name' => 'Fashion', 'slug' => 'fashion', 'count' => 3],
            ['name' => 'Lifestyle', 'slug' => 'lifestyle', 'count' => 7],
        ];

        return view('home.blog.category', [
            'posts' => $filteredPosts,
            'category' => $categories[$category],
            'categories' => $allCategories,
            'recentPosts' => array_slice($allPosts, 0, 3),
            'pageTitle' => $categories[$category] . ' - Blog',
            'pageDescription' => 'Browse all ' . strtolower($categories[$category]) . ' articles on our blog.'
        ]);
    }

    /**
     * Display the specified blog post.
     */
    public function show($slug)
    {
        $posts = [
            'latest-trends-2023' => [
                'id' => 1,
                'title' => 'Latest Trends in 2023',
                'slug' => 'latest-trends-2023',
                'excerpt' => 'Discover the latest fashion and technology trends for 2023.',
                'category' => 'fashion',
                'created_at' => now()->subDays(2),
                'image' => 'blog-1.jpg',
                'content' => '<p>This is a detailed blog post about the latest trends in 2023. You can add as much content as you like here, including images, videos, and other media.</p>'
            ],
            'top-10-must-have-items' => [
                'id' => 2,
                'title' => 'Top 10 Must-Have Items',
                'slug' => 'top-10-must-have-items',
                'excerpt' => 'Check out our curated list of essential items for this season.',
                'category' => 'lifestyle',
                'created_at' => now()->subDays(5),
                'image' => 'blog-1.jpg',
                'content' => '<p>This is a detailed blog post about must-have items. You can add as much content as you like here, including images, videos, and other media.</p>'
            ],
            'tech-innovations-this-year' => [
                'id' => 3,
                'title' => 'Tech Innovations This Year',
                'slug' => 'tech-innovations-this-year',
                'excerpt' => 'Explore the most exciting technological advancements.',
                'category' => 'technology',
                'created_at' => now()->subWeek(),
                'image' => 'blog-1.jpg',
                'content' => '<p>This is a detailed blog post about tech innovations. You can add as much content as you like here, including images, videos, and other media.</p>'
            ]
        ];

        if (!isset($posts[$slug])) {
            abort(404);
        }

        $post = $posts[$slug];
        
        // Get recent posts (excluding current post)
        $recentPosts = array_filter($posts, function($key) use ($slug) {
            return $key !== $slug;
        }, ARRAY_FILTER_USE_KEY);
        
        $recentPosts = array_slice($recentPosts, 0, 3);
        
        $categories = [
            ['name' => 'Technology', 'slug' => 'technology', 'count' => 5],
            ['name' => 'Fashion', 'slug' => 'fashion', 'count' => 3],
            ['name' => 'Lifestyle', 'slug' => 'lifestyle', 'count' => 7],
        ];

        return view('home.blog.show', [
            'post' => $post,
            'recentPosts' => $recentPosts,
            'categories' => $categories,
            'pageTitle' => $post['title'],
            'pageDescription' => $post['excerpt']
        ]);
    }
}
