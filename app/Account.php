<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public function email()
    {
        return $this->hasOne(MailAccount::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function project()
    {
        return $this->hasOne(Project::class);
    }
}
