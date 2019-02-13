<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    private static $secondLevelDomains = ['com', 'edu', 'gov', 'net', 'org', 'co', 'me', 'in', 'ne'];
    private static $domainsList;
    private static $domainsSchemes;
    private static $updatedRating = [];

    public function hrefs()
    {
        return $this->hasMany(Href::class);
    }

    public function rootDomain()
    {
        return $this->hasOne(Domain::class, 'id', 'root_domain_id');
    }

    public function subDomains()
    {
        return $this->hasMany(Domain::class, 'root_domain_id', 'id');
    }

    public function scheme()
    {
        return $this->belongsTo(DomainsScheme::class, 'domains_scheme_id', 'id');
    }

    public function project()
    {
        return $this->hasOne(Project::class);
    }

    public static function getDomainInfo(&$domainParts, $onlyDomain = true)
    {
        $hostParts = explode('.', $domainParts['host']);
        $hostPartsCount = count($hostParts);

        if (!is_numeric($hostParts[$hostPartsCount - 1])) {
            if (in_array($hostParts[$hostPartsCount - 2], self::$secondLevelDomains)) {
                $firstLevelDomain = $hostParts[$hostPartsCount - 2] . '.' . $hostParts[$hostPartsCount - 1];
                $secondLevelDomain = $hostParts[$hostPartsCount - 3];
                $subDomainsCount = $hostPartsCount - 3;
            } else {
                $firstLevelDomain = $hostParts[$hostPartsCount - 1];
                $secondLevelDomain = $hostParts[$hostPartsCount - 2];
                $subDomainsCount = $hostPartsCount - 2;
            }

            $rootDomain = $secondLevelDomain . '.' . $firstLevelDomain;

            if ($subDomainsCount) {
                for ($i = 0; $i < $subDomainsCount; $i++) {
                    $subDomains[] = $hostParts[$i];
                }

                if (count($subDomains) == 1 && $subDomains[0] == 'www') {
                    $domain = $rootDomain;
                    $rootDomain = null;
                } else {
                    if ($subDomains[0] != 'www') {
                        $domain = implode('.', $subDomains) . '.' . $rootDomain;
                    } else {
                        for ($i = 1; $i < count($subDomains); $i++) {
                            $subDomainsWithoutWww[] = $subDomains[$i];
                        }

                        $domain = implode('.', $subDomainsWithoutWww) . '.' . $rootDomain;
                    }
                }
            } else {
                $domain = $rootDomain;
                $rootDomain = null;
            }
        } else {
            $domain = $domainParts['host'];
            $rootDomain = null;
        }

        if ($onlyDomain) {
            return $domain;
        }

        return [
            'domain' => $domain,
            'rootDomain' => $rootDomain
        ];
    }

    public static function getDomainId($url, $domainRating)
    {
        $domainParts = parse_url(strtolower($url));
        $domainInfo = self::getDomainInfo($domainParts, false);

        if (is_null(self::$domainsList)) {
            self::buildDomainList();
        }

        $rootDomainId = null;

        if (!is_null($domainInfo['rootDomain'])) {
            $rootDomainId = self::findDomainId(
                $domainInfo['rootDomain'],
                $domainParts['scheme']  . "://" .  $domainInfo['rootDomain'],
                $domainRating
            );
        }

        $domainId = self::findDomainId(
            $domainInfo['domain'],
            $domainParts['scheme'] . "://" . $domainParts['host'],
            $domainRating,
            $rootDomainId
        );

        return $domainId;
    }

    public static function updateDomainRating()
    {
        foreach (self::$updatedRating as $id => $rating) {
            self::where('id', $id)->update(['rating' => $rating]);
        }
    }

    private static function findDomainId($domain, $url, $rating, $root_domain_id = null)
    {
        $domainId = self::findDomainInCache($domain, $rating);

        if (!$domainId) {
            $domainFromBase = self::findDomainInBase($domain);

            if ($domainFromBase) {
                $domainId = $domainFromBase->id;

                if ($domainFromBase->rating != $rating) {
                    self::storeDomainRating($domainId, $rating);
                }
            } else {
                $schemeId = self::getDomainSchemeId($url);
                $domainId = self::createDomain($domain, $schemeId, $rating, $root_domain_id);
            }
        }

        return $domainId;
    }

    private static function buildDomainList()
    {
        $ignoredDomains = IgnoredDomain::select('root_domain_id')->get()->pluck('root_domain_id')->toArray();

        if (!$ignoredDomains) {
            $domains = self::select('id', 'domain', 'rating')->orderBy('rating', 'desc')->limit(60000)->get();
        } else {
            $domains = self::select('id', 'domain', 'rating')->whereNotIn('root_domain_id', $ignoredDomains)
                ->orWhereNull('root_domain_id')->orderBy('rating', 'desc')->limit(60000)->get();
        }

        for ($i = 0; $i < count($domains); $i++) {
            self::$domainsList[$domains[$i]->domain{0}][] = [
                $domains[$i]->id,
                $domains[$i]->domain,
                $domains[$i]->rating
            ];
        }
    }

    private static function findDomainInCache($domain, $rating)
    {
        $domainFirstLetter = $domain{0};

        if (isset(self::$domainsList[$domainFirstLetter])) {
            for ($i = 0; $i < count(self::$domainsList[$domainFirstLetter]); $i++) {
                if ($domain == self::$domainsList[$domainFirstLetter][$i][1]) {
                    if ($rating != self::$domainsList[$domainFirstLetter][$i][2]) {
                        self::storeDomainRating(self::$domainsList[$domainFirstLetter][$i][0], $rating);
                        self::$domainsList[$domainFirstLetter][$i][2] = $rating;
                    }

                    return self::$domainsList[$domainFirstLetter][$i][0];
                }
            }
        }

        return false;
    }

    private static function createDomain($domain, $schemeId, $rating, $root_domain_id = null)
    {
        $newDomain = new self();
        $newDomain->domain = $domain;
        $newDomain->root_domain_id = $root_domain_id;
        $newDomain->domains_scheme_id = $schemeId;
        $newDomain->rating = $rating;
        $newDomain->save();

        self::$domainsList[$domain{0}][] = [$newDomain->id, $domain, $rating];

        return $newDomain->id;
    }

    private static function storeDomainRating($id, $rating)
    {
        if (key_exists($id, self::$updatedRating)) {
            if ($rating > self::$updatedRating[$id]) {
                self::$updatedRating[$id] = $rating;
            }
        } else {
            self::$updatedRating[$id] = $rating;
        }
    }

    private static function findDomainInBase($domain)
    {
        return self::select('id', 'domain', 'rating')->where('domain', $domain)->first();
    }

    private static function loadDomainsSchemes()
    {
        self::$domainsSchemes = DomainsScheme::select('id', 'name')
            ->orderBy('id', 'asc')
            ->get()
            ->pluck('name', 'id')
            ->toArray();
    }

    private static function getDomainSchemeId($url)
    {
        if (is_null(self::$domainsSchemes)) {
            self::loadDomainsSchemes();
        }

        foreach (self::$domainsSchemes as $id => $scheme) {
            if (strpos($url, $scheme) !== false) {
                return $id;
            }
        }

        return 2;
    }
}
