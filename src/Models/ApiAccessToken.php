<?php

namespace BitPixel\SpringCms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiAccessToken extends Model
{
    use HasFactory;

    public $table = 'river_api_access_tokens';

    protected $guarded = ['id',];

    

}
