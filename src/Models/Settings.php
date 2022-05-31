<?php

namespace Rashidul\River\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    public $table = 'river_settings';

    protected $fillable = [
        'key',
        'value'
    ];
    public $timestamps = false;
}
