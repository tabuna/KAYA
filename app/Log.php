<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Platform\Traits\FilterTrait;
use Orchid\Platform\Traits\MultiLanguage;
use Illuminate\Support\Facades\DB;

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


  /**
   * @param $year
   *
   * @return \Illuminate\Database\Query\Expression
   */
    public static function getStaticsForYear($year)
    {
      return DB::select("
                  select
              month_number,
              count(*) as count
            from (
                   select 1 as month_number
                   union all select 2
                   union all select 3
                   union all select 4
                   union all select 5
                   union all select 6
                   union all select 7
                   union all select 8
                   union all select 9
                   union all select 10
                   union all select 11
                   union all select 12
                 ) as month_number
              left outer
              join logs
               on month_number = month(created_at)
            where year(created_at) = $year
            group
            by month_number
            order
            by month_number
      ");

    }

}
