<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BlogPostSlugTest extends TestCase
{
    public function testBlogPostHaveUniqueSlugs()
    {
        Storage::fake('local');

        $this->assertDatabaseCount('blog_posts', 0);

        $blog = $this->blogCreate();

        $this->blogPostCreate($blog, [
            'title' =>  'Test'
        ]);

        $this->assertDatabaseCount('blog_posts', 1);

        $this->blogPostCreate($blog, [
            'title' =>  'Test 1'
        ]);

        $this->assertDatabaseCount('blog_posts', 2);

        $this->blogPostCreate($blog, [
            'title' =>  'Test 1'
        ]);

        $this->assertDatabaseCount('blog_posts', 2);
    }
}
