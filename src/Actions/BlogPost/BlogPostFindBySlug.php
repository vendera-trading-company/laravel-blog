<?php

namespace VenderaTradingCompany\LaravelBlog\Actions\BlogPost;

use VenderaTradingCompany\LaravelBlog\Models\BlogPost;
use VenderaTradingCompany\PHPActions\Action;

class BlogPostFindBySlug extends Action
{
    public function handle()
    {
        $slug = $this->getData('slug');

        if (empty($slug)) {
            return;
        }

        $blog_post = BlogPost::where('slug', $slug)->first();

        if (empty($blog_post)) {
            return;
        }

        return [
            'blog_post' => $blog_post
        ];
    }
}
