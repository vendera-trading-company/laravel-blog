<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use VenderaTradingCompany\LaravelBlog\Models\BlogPost;

class BlogPostSearchTest extends TestCase
{
    public function testBlogPostSearch()
    {
        Storage::fake('local');

        $blog = $this->blogCreate();

        $this->blogPostCreate($blog, [
            'title' =>  'Test'
        ]);

        $this->blogPostCreate($blog, [
            'title' =>  'Test 1'
        ]);

        $blog_posts = BlogPost::query()->search('Test')->get();

        $this->assertCount(2, $blog_posts);
    }

    public function testBlogPostSearchByDescription()
    {
        Storage::fake('local');

        $blog = $this->blogCreate();

        $this->blogPostCreate($blog, [
            'title' =>  'Test',
            'description' =>  'Description Search Test valid'
        ]);

        $this->blogPostCreate($blog, [
            'title' =>  'Test 1',
            'description' =>  'Description Search Test invalid'
        ]);

        $blog_posts = BlogPost::query()->search('Description Search Test valid')->get();

        $this->assertCount(1, $blog_posts);
    }

    public function testBlogPostSearchByDescriptionMultiple()
    {
        Storage::fake('local');

        $blog = $this->blogCreate();

        $this->blogPostCreate($blog, [
            'title' =>  'Test',
            'description' =>  'Description Search Test valid'
        ]);

        $this->blogPostCreate($blog, [
            'title' =>  'Test 1',
            'description' =>  'Description Search Test valid'
        ]);

        $this->blogPostCreate($blog, [
            'title' =>  'Test 2',
            'description' =>  'Description Search Test invalid'
        ]);

        $blog_posts = BlogPost::query()->search('Description Search Test valid')->get();

        $this->assertCount(2, $blog_posts);
    }

    public function testBlogPostSearchByBlog()
    {
        Storage::fake('local');

        $blog = $this->blogCreate();
        $blog1 = $this->blogCreate();

        $this->blogPostCreate($blog, [
            'title' =>  'Test'
        ]);

        $this->blogPostCreate($blog1, [
            'title' =>  'Test 1'
        ]);

        $blog_posts = BlogPost::query()->search('Test', $blog)->get();

        $this->assertCount(1, $blog_posts);
    }
}
