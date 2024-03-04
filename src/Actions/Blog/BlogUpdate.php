<?php

namespace VenderaTradingCompany\LaravelBlog\Actions\Blog;

use VenderaTradingCompany\LaravelBlog\Models\Blog;
use VenderaTradingCompany\PHPActions\Action;

class BlogUpdate extends Action
{
    protected $validator = [
        'id' => 'required'
    ];

    public function handle()
    {
        $id = $this->getData('id');
        $meta = $this->getData('meta');

        $blog = Blog::where('id', $id)->first();

        if (empty($blog)) {
            return;
        }

        $blog->update([
            'meta' => $meta,
        ]);

        return [
            'blog' => $blog,
        ];
    }
}
