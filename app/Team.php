<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Teamwork\Traits\TeamworkTeamTrait;

class Team extends Model
{
    use TeamworkTeamTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'owner_id',
        'slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getLog()
    {
        return $this->hasMany(Log::class);
    }

}
