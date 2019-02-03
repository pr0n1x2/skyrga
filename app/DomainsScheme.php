<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DomainsScheme extends Model
{
    public function domains()
    {
        return $this->hasMany(Domain::class);
    }
}
