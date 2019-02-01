<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SitesCity extends Model
{
    public function sites()
    {
        return $this->hasMany(Site::class);
    }
}
