<?php

namespace App;

use App\Events\PostDeleting;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $dispatchesEvents = [
        'deleting' => PostDeleting::class,
    ];

    protected $fillable = [
        'name', 'title', 'text', 'anchor1', 'anchor2', 'anchor3', 'anchor4'
    ];

    public function profiles()
    {
        return $this->belongsToMany(
            Profile::class,
            'profile_posts',
            'post_id',
            'profile_id'
        );
    }
}
