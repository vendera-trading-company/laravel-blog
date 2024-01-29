<?php

namespace Tests\Helpers;

use VenderaTradingCompany\LaravelBlog\Actions\Blog\BlogStore;
use VenderaTradingCompany\LaravelBlog\Models\Blog;
use VenderaTradingCompany\PHPActions\Action;

trait BlogTestHelperTrait
{
    public function blogCreate(): Blog
    {
        $blog = Action::run(BlogStore::class)->getData('blog');

        return $blog;
    }
}
