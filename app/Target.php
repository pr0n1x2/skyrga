<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function getEmail()
    {
        if (!is_null($this->account)) {
            return $this->account->email->email;
        } elseif (!is_null($this->profile->reserveEmail)) {
            return $this->profile->reserveEmail->email;
        }

        return $this->profile->email->email;
    }

    public function getEmailID()
    {
        if (!is_null($this->account)) {
            return $this->account->email->id;
        } elseif (!is_null($this->profile->reserveEmail)) {
            return $this->profile->reserveEmail->id;
        }

        return $this->profile->email->id;
    }

    public static function getTargetsCounts($targets)
    {
        $counts = [];

        foreach ($targets as $key => $collection) {
            $counts[$key] = $collection->filter(function ($target) {
                if ($target->is_register == 1) {
                    return true;
                }
            })->count();
        }

        return $counts;
    }

    public static function getNextTargetID($targets)
    {
        $counts = Target::getTargetsCounts($targets);
        $index = false;
        $previous = 100;

        foreach ($counts as $project_id => $count) {
            if ($count != $targets[$project_id]->count()) {
                if ($count < $previous) {
                    $previous = $count;
                    $index = $project_id;
                }
            }
        }

        if ($index != false) {
            $first = $targets[$index]->first(function ($target) {
                return $target->is_register == 0;
            });

            return $first->id;
        }

        return 0;
    }
}
