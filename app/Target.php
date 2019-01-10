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

    public function getEmail()
    {
        if (!is_null($this->profile->reserveEmail)) {
            return $this->profile->reserveEmail->email;
        }

        return $this->profile->email->email;
    }
}
