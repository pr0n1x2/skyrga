<?php

namespace App;

use App\Events\ArticleMessageSaving;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ArticleMessage extends Model
{
    public $timestamps = false;

    protected $dispatchesEvents = [
        'saving' => ArticleMessageSaving::class
    ];

    protected $fillable = ['message'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getMessage()
    {
        return nl2br($this->message);
    }

    public function getDateAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d F Y \\a\t H:i');
    }
}
