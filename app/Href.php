<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Href extends Model
{
    public function status()
    {
        return $this->belongsTo(HrefsStatus::class);
    }

    public function type()
    {
        return $this->belongsTo(HrefsType::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
