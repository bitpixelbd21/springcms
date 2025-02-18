<?php

namespace BitPixel\SpringCms\Models;

use BitPixel\SpringCms\Traits\Publishable;
use BitPixel\SpringCms\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Portfolio extends Model
{
    use HasFactory, Publishable, Sortable;

    public $table = 'river_portfolios';

    protected $guarded = ['id',];


    public function scopeSlug($q, $slug)
    {
        return $q->where('slug', $slug);
    }
}
