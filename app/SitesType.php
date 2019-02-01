<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SitesType extends Model
{
    public function sites()
    {
        return $this->hasMany(Site::class);
    }
}
