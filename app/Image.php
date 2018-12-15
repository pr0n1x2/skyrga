<?php

namespace App;

use App\Events\ImageDeleting;
use Illuminate\Database\Eloquent\Model;
use Spinner;

class Image extends Model
{
    protected $dispatchesEvents = [
        'deleting' => ImageDeleting::class,
    ];

    protected $fillable = [
        'name', 'url', 'alt'
    ];

    public function profiles()
    {
        return $this->belongsToMany(
            Profile::class,
            'profile_images',
            'image_id',
            'profile_id'
        );
    }

    public function getAlternativeText()
    {
        return ucfirst(Spinner::process($this->alt));
    }
}
