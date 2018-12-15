<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailAccount extends Model
{
    protected $fillable = [
        'email', 'domain', 'login_page', 'account_name', 'password'
    ];

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
