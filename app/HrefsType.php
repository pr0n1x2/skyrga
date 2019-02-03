<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HrefsType extends Model
{
    private static $types;

    public function hrefs()
    {
        return $this->hasMany(Href::class);
    }

    public static function getTypeId($type)
    {
        if (is_null(self::$types)) {
            self::buildTypeList();
        }

        $lowType = trim(strtolower($type));

        foreach (self::$types as $id => $value) {
            if ($lowType == $value) {
                return $id;
            }
        }

        $hrefType = new self();
        $hrefType->name = trim($type);
        $hrefType->save();

        self::$types[$hrefType->id] = $lowType;

        return $hrefType->id;
    }

    private static function buildTypeList()
    {
        self::$types = self::select('id', 'name')->orderBy('id')->get()->pluck('name', 'id')->map(function ($item) {
            return strtolower($item);
        })->toArray();
    }
}
