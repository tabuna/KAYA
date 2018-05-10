<?php

namespace App\Http\Controllers\Api;

use App\Log;
use App\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoggerController extends Controller
{
    /**
     * @param Team    $team
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function write(Team $team, Request $request)
    {
        Log::create([
            'message' => $request->get('message'),
            'team_id' => $team->id
        ]);

        return response(200);
    }
}
