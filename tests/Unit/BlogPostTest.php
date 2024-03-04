<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class BlogPostTest extends TestCase
{
    public function testDatabaseHasExpectedColumns()
    {
        $this->assertTrue(
            Schema::hasColumns('blog_posts', [
                'id',
                'blog_id',
                'banner_id',
                'content_id',
                'description',
                'title',
                'slug',
                'meta'
            ])
        );
    }
}
