<?php

namespace BitPixel\SpringCms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'content'];

    protected $table = 'river_comments';

    // Relationship with Post
    public function river_customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    // Relationship with Parent Comment (For Replies)
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Relationship with Child Comments (Replies)
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
