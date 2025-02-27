<?php

namespace BitPixel\SpringCms\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    public $table = 'river_admins';
    protected $hidden = [
        'password',
        'is_developer',
        'role_id'
    ];

    protected $fillable = [
        'key',
        'value'
    ];

    public function blog(){
        return $this->hasMany(Blog::class, 'author_id');
    }
//    public $timestamps = false;
}
