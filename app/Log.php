<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'instance',
        'channel',
        'level',
        'level_name',
        'message',
        'context',
        'remote_address',
        'user_agent',
        'team_id',
        'created_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getTeam()
    {
        return $this->hasOne(Team::class);
    }
}
