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
}
