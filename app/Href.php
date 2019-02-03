<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Href extends Model
{
    private static $domains;

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

    public static function isUseDomain($domainId)
    {
        if (is_null(self::$domains)) {
            self::buildDomainsList();
        }

        $isUse = self::findDomainIdInCache($domainId, 0, count(self::$domains) - 1);

        if (!$isUse) {
            $href = self::where('domain_id', $domainId)->first();

            if ($href) {
                $isUse = true;
            }
        }

        return $isUse;
    }

    private static function buildDomainsList()
    {
        self::$domains = self::select('domain_id')
            ->orderBy('domain_id')
            ->limit(1000000)
            ->distinct()
            ->get()
            ->pluck('domain_id')
            ->toArray();
    }

    private static function findDomainIdInCache($domainId, $startIndex, $endIndex)
    {
        $elCount = $endIndex - $startIndex;

        if ($elCount <= 10) {
            for ($i = $startIndex; $i <= $endIndex; $i++) {
                if (self::$domains[$i] == $domainId) {
                    return true;
                }
            }

            return false;
        }

        $half = (int)ceil($elCount / 2) + $startIndex;

        if ($domainId <= self::$domains[$half]) {
            $endIndex = $half;
        } else {
            $startIndex = $half;
        }

        return self::findDomainIdInCache($domainId, $startIndex, $endIndex);
    }
}
