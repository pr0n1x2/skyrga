<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    public function hrefs()
    {
        return $this->hasMany(Href::class);
    }

    public function rootDomain()
    {
        return $this->hasOne(Domain::class, 'id', 'root_domain_id');
    }

    public static function getDomainId($url)
    {
        dd(parse_url($url));
    }
}
