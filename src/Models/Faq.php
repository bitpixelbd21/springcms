<?php

namespace BitPixel\SpringCms\Models;

use BitPixel\SpringCms\Traits\Publishable;
use BitPixel\SpringCms\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory, Publishable, Sortable;

    public $table = 'river_faq';

    protected $guarded = ['id',];

}
