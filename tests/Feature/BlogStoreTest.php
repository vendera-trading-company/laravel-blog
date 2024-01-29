<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use VenderaTradingCompany\LaravelBlog\Actions\Blog\BlogStore;
use VenderaTradingCompany\PHPActions\Action;

class BlogStoreTest extends TestCase
{
    public function testBlogCanBeStored()
    {
        Storage::fake('local');

        $this->assertDatabaseCount('blogs', 0);

        $blog = Action::run(BlogStore::class)->getData('blog');

        $this->assertNotEmpty($blog);

        $this->assertDatabaseCount('blogs', 1);
    }
}
