<?php

namespace App\Http\Controllers\Log;

use App\Http\Controllers\Controller;
use App\Log;
use App\Team;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public  function index(Team $team, Request $request)
    {
        $logs = Log::filters()
            ->where('team_id', $team->id)
            ->where('created_at','<',date('Y-m-d'))
            ->simplePaginate();


        $groupRemoteAddress = Log::filters()
            ->select('remote_address',DB::raw('count(remote_address) as count'))
            ->where('team_id', $team->id)
            ->where('created_at','<',date('Y-m-d'))
            ->groupBy('remote_address')
            ->orderByDesc('count')
            ->get();

        return view('log.index', [
            'team'               => $team,
            'logs' => $logs,
            'groupRemoteAddress' => $groupRemoteAddress
        ]);
    }
}
