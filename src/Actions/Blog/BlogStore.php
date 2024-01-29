<?php

namespace VenderaTradingCompany\LaravelBlog\Actions\Blog;

use VenderaTradingCompany\LaravelBlog\Models\Blog;
use VenderaTradingCompany\PHPActions\Action;
use Illuminate\Support\Str;

class BlogStore extends Action
{
    public function handle()
    {
        $id = now()->timestamp . '_' . strtolower(Str::random(32)) . '_blog';

        $blog = Blog::create([
            'id' => $id,
        ]);

        return [
            'blog' => $blog
        ];
    }
}
