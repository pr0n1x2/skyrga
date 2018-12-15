<?php

namespace App;

use App\Events\VideoDeleting;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $dispatchesEvents = [
        'deleting' => VideoDeleting::class,
    ];

    protected $fillable = [
        'name', 'url'
    ];

    public function profiles()
    {
        return $this->belongsToMany(
            Profile::class,
            'profile_videos',
            'video_id',
            'profile_id'
        );
    }
}
