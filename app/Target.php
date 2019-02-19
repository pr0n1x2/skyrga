<?php

namespace App;

use Carbon\Carbon;
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

    /*public static function getTargetsCounts($targets)
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

    public static function getNextTarget($targets)
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

            return $first;
        }

        return null;
    }*/

    public static function getMatrix($startDate)
    {
        $date = Carbon::createFromFormat('Y-m-d', $startDate);
        $profiles = Profile::select('id')->orderBy('id')->get();
        $profilesCount = $profiles->count();

        $tagrets = self::select('register_date', 'profile_id')->where('register_date', '>=', $startDate)
            ->orderBy('register_date', 'asc')
            ->orderBy('profile_id')
            ->get()
            ->groupBy('register_date')
            ->map(function ($item) {
                return $item->pluck('profile_id');
            })
            ->toArray();

        $matrix = [];

        for ($i = 0; $i < 730; $i++) {
            $dateStr = $date->format('Y-m-d');
            $profs = [];

            for ($j = 0; $j < $profilesCount; $j++) {
                if (isset($tagrets[$dateStr]) && in_array($profiles[$j]->id, $tagrets[$dateStr])) {
                    $profs[] = $profiles[$j]->id;
                } else {
                    $profs[] = 0;
                }
            }

            $matrix[$dateStr] = $profs;
            $date->addDay(1);
        }

        self::printMatrix($matrix);

        return $matrix;
    }

    public static function printMatrix($matrix)
    {
        echo '<table border="1" width="100%">';

        foreach ($matrix as $date => $values) {
            echo '<tr><td><strong>' . $date . '</strong></td>';

            for ($i = 0; $i < count($values); $i++) {
                echo '<td>' . $values[$i] . '</td>';
            }

            echo '</tr>';
        }

        echo '</table>';

        exit;
    }
}
