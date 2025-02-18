<?php

namespace BitPixel\SpringCms\Models;

use BitPixel\SpringCms\Traits\Publishable;
use BitPixel\SpringCms\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Service extends Model
{
    use HasFactory, Publishable, Sortable;

    public $table = 'river_service';

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


    public function servicecategory(){
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }
}
