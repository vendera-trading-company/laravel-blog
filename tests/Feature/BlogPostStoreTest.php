<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use VenderaTradingCompany\LaravelBlog\Actions\BlogPost\BlogPostStore;
use VenderaTradingCompany\PHPActions\Action;

class BlogPostStoreTest extends TestCase
{
    public function testBlogPostCanBeStored()
    {
        Storage::fake('local');

        $this->assertDatabaseCount('blog_posts', 0);

        $blog = $this->blogCreate();

        $blog_post = Action::run(BlogPostStore::class, [
            'blog_id' => $blog->id,
            'content_raw' => 'test',
            'content_formatted' => 'Test',
            'title' => 'Test'
        ])->getData('blog_post');

        $this->assertNotEmpty($blog_post);

        $this->assertDatabaseCount('blog_posts', 1);
    }

    public function testBlogPostCanBeStoredWithBanner()
    {
        Storage::fake('local');

        $this->assertDatabaseCount('blog_posts', 0);

        $blog = $this->blogCreate();

        $blog_post = Action::run(BlogPostStore::class, [
            'blog_id' => $blog->id,
            'content_raw' => 'test',
            'content_formatted' => 'Test',
            'title' => 'Test',
            'banner' => 'test',
        ])->getData('blog_post');

        $this->assertNotEmpty($blog_post);

        $this->assertNotEmpty($blog_post->banner);

        $this->assertDatabaseCount('blog_posts', 1);
    }

    public function testBlogPostCanBeStoredWithDescription()
    {
        Storage::fake('local');

        $this->assertDatabaseCount('blog_posts', 0);

        $blog = $this->blogCreate();

        $blog_post = Action::run(BlogPostStore::class, [
            'blog_id' => $blog->id,
            'content_raw' => 'test',
            'content_formatted' => 'Test',
            'title' => 'Test',
            'description' => 'ABC'
        ])->getData('blog_post');

        $this->assertNotEmpty($blog_post);

        $this->assertEquals('ABC', $blog_post->description);

        $this->assertDatabaseCount('blog_posts', 1);
    }
}
