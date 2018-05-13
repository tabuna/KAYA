<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateLogRequest;
use App\Log;
use App\Team;
use App\Http\Controllers\Controller;

class LoggerController extends Controller
{
    /**
     * @param CreateLogRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function write(CreateLogRequest $request)
    {
        $team = Team::where('slug', $request->get('name'))
            ->where('token', $request->get('token'))
            ->firstOrFail();

        Log::create([
            'team_id' => $team->id,
            'message' => $request->get('message'),
            'remote_address' => $request->getClientIp(),
        ]);

        return response(200);
    }
}
