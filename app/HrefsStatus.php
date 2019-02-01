<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HrefsStatus extends Model
{
    public function hrefs()
    {
        return $this->hasMany(Href::class);
    }
}
