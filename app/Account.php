<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public function email()
    {
        return $this->belongsTo(MailAccount::class, 'mail_account_id');
    }
}
