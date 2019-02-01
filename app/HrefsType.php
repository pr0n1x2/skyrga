<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HrefsType extends Model
{
    public function hrefs()
    {
        return $this->hasMany(Href::class);
    }
}
