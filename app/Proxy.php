<?php

namespace App;

use App\Events\ProxyDeleting;
use Illuminate\Database\Eloquent\Model;

class Proxy extends Model
{
    protected $fillable = [
        'ip', 'port', 'login', 'password'
    ];

    protected $dispatchesEvents = [
        'deleting' => ProxyDeleting::class,
    ];

    public function projects()
    {
        return $this->belongsToMany(
            Project::class,
            'project_proxies',
            'proxy_id',
            'project_id'
        );
    }
}
