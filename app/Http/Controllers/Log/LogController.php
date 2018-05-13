<?php

namespace App\Http\Controllers\Log;

use App\Http\Controllers\Controller;
use App\Log;
use App\Team;
use Illuminate\Http\Request;

class LogController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Team $team, Request $request)
    {
        $logs = Log::filters()
            ->where('team_id', $team->id)
            ->simplePaginate();

        $groupRemoteAddress = $logs->groupBy('remote_address');

        return view('log.index', [
            'team'               => $team,
            'groupRemoteAddress' => $groupRemoteAddress
        ]);
    }
}
