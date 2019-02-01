<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    public function city()
    {
        return $this->belongsTo(SitesCity::class);
    }

    public function type()
    {
        return $this->belongsTo(SitesType::class);
    }

    public function hrefs()
    {
        return $this->hasMany(Href::class);
    }
}
