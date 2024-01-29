<?php

namespace VenderaTradingCompany\LaravelBlog\Actions\BlogPost;

use VenderaTradingCompany\LaravelBlog\Models\BlogPost;
use VenderaTradingCompany\PHPActions\Action;
use Illuminate\Support\Str;
use VenderaTradingCompany\LaravelAssets\Actions\Image\ImageStore;
use VenderaTradingCompany\LaravelAssets\Actions\Image\ImageUpdate;
use VenderaTradingCompany\LaravelAssets\Actions\Markdown\MarkdownUpdate;

class BlogPostUpdate extends Action
{
    protected $validator = [
        'id' => 'required',
        'title' => 'required',
    ];

    public function handle()
    {
        $content_raw =  $this->getData('content_raw');
        $content_formatted =  $this->getData('content_formatted');
        $banner = $this->getData('banner');
        $description = $this->getData('description');
        $title = $this->getData('title');
        $id = $this->getData('id');

        $blog_post = BlogPost::where('id', $id)->first();

        if (empty($blog_post)) {
            return;
        }

        $title = trim($title);

        if (!empty($description)) {
            $description = trim($description);
        }

        $slug = strtolower(Str::slug($title));

        if (empty($slug)) {
            return;
        }

        $blog_post_with_same_slug = Action::run(BlogPostFindBySlug::class, [
            'slug' => $slug
        ])->getData('blog_post');

        if (!empty($blog_post_with_same_slug)) {
            if ($blog_post_with_same_slug->id != $blog_post->id) {
                return;
            }
        }

        if (empty($content_raw) || empty($content_formatted)) {
            return;
        }

        $content = Action::run(MarkdownUpdate::class, [
            'id' => $blog_post->content_id,
            'raw' => $content_raw,
            'formatted' => $content_formatted,
            'database' => true,
        ])->getData('markdown');

        if (empty($content)) {
            return;
        }

        $blog_post_data = [
            'content_id' => $content->id,
            'description' => $description,
            'title' => $title,
            'slug' => $slug
        ];

        if (!empty($banner)) {
            if (! empty($blog_post->banner_id)) {
                $banner = Action::run(ImageUpdate::class, [
                    'id' => $blog_post->banner_id,
                    'base64' => true,
                    'file' => $banner
                ])->getData('image');
    
                $blog_post_data['banner_id'] = $banner?->id;
            } else {
                $banner = Action::run(ImageStore::class, [
                    'base64' => true,
                    'file' => $banner
                ])->getData('image');
    
                $blog_post_data['banner_id'] = $banner?->id;
            }
        }

        $blog_post->update($blog_post_data);

        return [
            'blog_post' => $blog_post
        ];
    }
}
