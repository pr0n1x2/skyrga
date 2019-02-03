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

    public static function getSiteId($url, $city_id, $type_id)
    {
        $domainParts = parse_url(strtolower($url));
        $domain = Domain::getDomainInfo($domainParts);

        $site = self::where('domain', $domain)->first();

        if (!$site) {
            $site = new self();
            $site->domain = $domain;
            $site->url = strtolower($url);
            $site->sites_city_id = $city_id;
            $site->sites_type_id = $type_id;
            $site->save();
        }

        return $site->id;
    }
}
