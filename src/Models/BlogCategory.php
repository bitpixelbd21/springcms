<?php

namespace BitPixel\SpringCms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    public $table = 'river_blog_category';

    protected $guarded = ['id',];


    public function scopeSlug($q, $slug)
    {
        return $q->where('slug', $slug);
    }

    // public function menuitem(){
    //     return $this->HasMany(MenuItem::class, 'menu_id');
    // }

    public function blog(){
        return $this->HasMany(Blog::class, 'category_id');
    }
}
