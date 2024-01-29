<?php

namespace VenderaTradingCompany\LaravelBlog\Actions\BlogPost;

use VenderaTradingCompany\LaravelBlog\Models\BlogPost;
use VenderaTradingCompany\PHPActions\Action;
use Illuminate\Support\Str;
use VenderaTradingCompany\LaravelAssets\Actions\Image\ImageStore;
use VenderaTradingCompany\LaravelAssets\Actions\Markdown\MarkdownStore;

class BlogPostStore extends Action
{
    protected $validator = [
        'blog_id' => 'required',
        'title' => 'required',
    ];

    public function handle()
    {
        $content_raw =  $this->getData('content_raw');
        $content_formatted =  $this->getData('content_formatted');
        $banner = $this->getData('banner');
        $blog_id = $this->getData('blog_id');
        $description = $this->getData('description');
        $title = $this->getData('title');

        $title = trim($title);

        if (!empty($description)) {
            $description = trim($description);
        }

        $slug = strtolower(Str::slug($title));

        if (empty($slug)) {
            return;
        }

        if (!empty(Action::run(BlogPostFindBySlug::class, [
            'slug' => $slug
        ])->getData('blog_post'))) {
            return;
        }

        if (empty($content_raw) || empty($content_formatted)) {
            return;
        }

        $content = Action::run(MarkdownStore::class, [
            'raw' => $content_raw,
            'formatted' => $content_formatted,
            'database' => true,
        ])->getData('markdown');

        if (empty($content)) {
            return;
        }

        $banner = Action::run(ImageStore::class, [
            'base64' => true,
            'file' => $banner
        ])->getData('image');

        $id = now()->timestamp . '_' . strtolower(Str::random(32)) . '_blog_post';

        $blog_post = BlogPost::create([
            'blog_id' => $blog_id,
            'id' => $id,
            'content_id' => $content->id,
            'banner_id' => $banner?->id,
            'description' => $description,
            'title' => $title,
            'slug' => $slug
        ]);

        return [
            'blog_post' => $blog_post
        ];
    }
}
