<?php

namespace App;

use App\Events\ProxyDeleting;
use Illuminate\Database\Eloquent\Model;

class Proxy extends Model
{
    const PING_URL = 'https://dentalhealthexpert.com/ping.php';

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

    public function generateProxyString()
    {
        $ipAndPort = $this->ip . ':' . $this->port;
        $auth = null;

        if (!is_null($this->login)) {
            $auth = $this->login . ':' . $this->password;
        }

        return $ipAndPort . (!is_null($auth) ? ',' . $auth : '');
    }
}
