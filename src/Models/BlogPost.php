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

    protected $casts = [
        'meta' => 'array'
    ];

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

    public function scopeSearch($query, mixed $search, Blog | string $blog = null)
    {
        if (empty($search)) {
            return $query;
        }

        $blog_id = $blog;

        if ($blog instanceof Blog) {
            $blog_id = $blog->id;
        }

        if (!empty($blog_id)) {
            $query->where('blog_id', $blog_id);
        }

        $query->where(function ($query) use ($search) {
            if (is_array($search)) {
                foreach ($search as $s) {
                    $query->orWhere('title', 'like', '%' . $s . '%');
                    $query->orWhere('description', 'like', '%' . $s . '%');
                }
            } else {
                $query->orWhere('title', 'like', '%' . $search . '%');
                $query->orWhere('description', 'like', '%' . $search . '%');
            }
        });

        return $query;
    }
}
