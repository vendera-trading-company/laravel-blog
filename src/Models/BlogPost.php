<?php

namespace VenderaTradingCompany\LaravelBlog\Models;

use Illuminate\Database\Eloquent\Model;
use VenderaTradingCompany\LaravelAssets\Models\Markdown;
use VenderaTradingCompany\LaravelAssets\Models\Image;

class BlogPost extends Model
{
    protected $guarded = [];

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $table = 'blog_posts';

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }

    public function content()
    {
        return $this->belongsTo(Markdown::class, 'content_id');
    }

    public function banner()
    {
        return $this->belongsTo(Image::class, 'banner_id');
    }
}
