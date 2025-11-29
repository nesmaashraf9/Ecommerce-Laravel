<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DownloadBlogImages extends Seeder
{
    private $images = [
        'blog-1.jpg' => 'https://placehold.co/800x500/4f46e5/ffffff?text=Blog+Post+1',
        'thumb-1.jpg' => 'https://placehold.co/100x100/4f46e5/ffffff?text=Thumb',
        'category-technology.jpg' => 'https://placehold.co/800x500/10b981/ffffff?text=Technology',
        'category-fashion.jpg' => 'https://placehold.co/800x500/8b5cf6/ffffff?text=Fashion',
        'category-lifestyle.jpg' => 'https://placehold.co/800x500/ec4899/ffffff?text=Lifestyle',
    ];

    public function run()
    {
        $directory = public_path('images/blog');
        
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        foreach ($this->images as $filename => $url) {
            $path = $directory . '/' . $filename;
            
            if (!file_exists($path)) {
                $imageData = @file_get_contents($url);
                if ($imageData !== false) {
                    file_put_contents($path, $imageData);
                    $this->command->info("Downloaded: {$filename}");
                } else {
                    $this->command->error("Failed to download: {$filename}");
                }
            } else {
                $this->command->line("Skipped: {$filename} (already exists)");
            }
        }
    }
}
