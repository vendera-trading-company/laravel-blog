<?php

namespace VenderaTradingCompany\LaravelBlog\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded = [];

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $table = 'blogs';

    public function posts()
    {
        return $this->hasMany(BlogPost::class, 'blog_id');
    }
}
