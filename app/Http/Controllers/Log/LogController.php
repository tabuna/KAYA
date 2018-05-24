<?php

namespace App\Http\Controllers\Log;

use App\Http\Controllers\Controller;
use App\Log;
use App\Team;
use Illuminate\Http\Request;
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
            ->orderBy('created_at','desc');

        $groupRemoteAddress = Log::filters()
            ->select('remote_address',DB::raw('count(remote_address) as count'))
            ->where('team_id', $team->id)
            ->groupBy('remote_address')
            ->orderByDesc('count')
            ->limit(30);

        if($request->has('search')){
            $logs->where('message','like','%'.$request->get('search').'%');
            $groupRemoteAddress->where('message','like','%'.$request->get('search').'%');
        }

        $tags = $request->session()->get($team->slug.'-tags', []);
        foreach ($tags as $key => $tag){
            $tag = strval($tag);

            $logs->where('message'.$key, $tag);
            $groupRemoteAddress->where('message'.$key, $tag);
        }

        return view('log.index', [
            'team'               => $team,
            'logs'               => $logs->simplePaginate(),
            'groupRemoteAddress' => $groupRemoteAddress->get(),
            'tags'               => $tags,
        ]);
    }

    /**
     * @param Team    $team
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addTag(Team $team,Request $request)
    {
        $tags = $request->session()->get($team->slug.'-tags', []);
        $tags[$request->get('key')]= $request->get('value');
        $request->session()->put($team->slug.'-tags',$tags);

        return response()->json($tags);
    }

    /**
     * @param Team    $team
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeTag(Team $team,Request $request)
    {
        $tags = $request->session()->get($team->slug.'-tags', []);
        unset($tags[$request->get('key')]);
        $request->session()->put($team->slug.'-tags',$tags);

        return response()->json($tags);
    }
}
