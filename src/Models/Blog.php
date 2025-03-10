<?php

namespace BitPixel\SpringCms\Models;

use BitPixel\SpringCms\Traits\Publishable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory, Publishable;

    public $table = 'river_blog';

    protected $guarded = ['id',];


    public function scopeSlug($q, $slug)
    {
        return $q->where('slug', $slug);
    }

    public function scopePublished($q)
    {
        return $q->where('is_published', 1);
    }

    // public function menuitem(){
    //     return $this->HasMany(MenuItem::class, 'menu_id');
    // }

    public function tag(){
        return $this->belongsToMany(Tag::class, 'river_blog_tag', 'blog_id', 'tag_id');
    }

    public function author(){
        return $this->belongsTo(Admin::class, 'author_id');
    }

    public function blogcategory(){
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }
}
