<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use VenderaTradingCompany\LaravelBlog\Actions\BlogPost\BlogPostUpdate;
use VenderaTradingCompany\PHPActions\Action;

class BlogPostUpdateTest extends TestCase
{
    public function testBlogPostCanBeUpdated()
    {
        Storage::fake('local');

        $this->assertDatabaseCount('blog_posts', 0);

        $blog = $this->blogCreate();

        $blog_post = $this->blogPostCreate($blog, [
            'title' =>  'Title Test Pre'
        ]);

        $this->assertEquals('Title Test Pre', $blog_post->title);

        $blog_post = Action::run(BlogPostUpdate::class, [
            'id' => $blog_post->id,
            'content_raw' => 'test',
            'content_formatted' => 'Test',
            'title' => 'Title Test After'
        ])->getData('blog_post');

        $this->assertNotEmpty($blog_post);

        $this->assertEquals('Title Test After', $blog_post->title);

        $this->assertDatabaseCount('blog_posts', 1);
    }

    public function testBlogPostCanBeUpdatedWithMeta()
    {
        Storage::fake('local');

        $this->assertDatabaseCount('blog_posts', 0);

        $blog = $this->blogCreate();

        $blog_post = $this->blogPostCreate($blog, [
            'title' =>  'Title Test Pre',
            'meta' => [
                'user_id' => 'test_user'
            ]
        ]);

        $this->assertEquals('test_user', $blog_post->meta['user_id']);

        $this->assertEquals('Title Test Pre', $blog_post->title);

        $blog_post = Action::run(BlogPostUpdate::class, [
            'id' => $blog_post->id,
            'content_raw' => 'test',
            'content_formatted' => 'Test',
            'title' => 'Title Test After',
            'meta' => [
                'user_id' => 'test_user_new'
            ]
        ])->getData('blog_post');

        $this->assertNotEmpty($blog_post);

        $this->assertEquals('test_user_new', $blog_post->meta['user_id']);

        $this->assertEquals('Title Test After', $blog_post->title);

        $this->assertDatabaseCount('blog_posts', 1);
    }
}
