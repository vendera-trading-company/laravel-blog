<?php

namespace Tests\Helpers;

use VenderaTradingCompany\LaravelBlog\Actions\BlogPost\BlogPostStore;
use VenderaTradingCompany\LaravelBlog\Models\Blog;
use VenderaTradingCompany\LaravelBlog\Models\BlogPost;
use VenderaTradingCompany\PHPActions\Action;

trait BlogPostTestHelperTrait
{
    public function blogPostCreate(Blog | string $blog, array $data = []): BlogPost | null
    {
        $blog_id = $blog;

        if ($blog instanceof Blog) {
            $blog_id = $blog->id;
        }

        $blog_post = Action::run(BlogPostStore::class, array_merge([
            'blog_id' => $blog_id,
            'content_raw' => 'test',
            'content_formatted' => 'Test',
            'title' => 'Test'
        ], $data))->getData('blog_post');

        return $blog_post;
    }
}
