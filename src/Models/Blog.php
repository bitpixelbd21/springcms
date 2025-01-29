<?php

namespace BitPixel\SpringCms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    public $table = 'river_blog';

    protected $guarded = ['id',];


    public function scopeSlug($q, $slug)
    {
        return $q->where('slug', $slug);
    }

    // public function menuitem(){
    //     return $this->HasMany(MenuItem::class, 'menu_id');
    // }

    public function tag(){
        return $this->belongsToMany(Tag::class, 'river_blog_tag', 'blog_id', 'tag_id');
    }

    public function admin(){
        return $this->belongsTo(Admin::class, 'author_id');
    }

    public function blogcategory(){
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }
}
