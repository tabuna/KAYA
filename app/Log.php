<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Platform\Traits\FilterTrait;
use Orchid\Platform\Traits\MultiLanguage;

class Log extends Model
{
    use MultiLanguage, FilterTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message',
        'remote_address',
        'team_id',
        'created_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'message' => 'array',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var
     */
    protected $allowedFilters = [
        'message',
        'remote_address',
        'created_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function team()
    {
        return $this->hasOne(Team::class);
    }

}
