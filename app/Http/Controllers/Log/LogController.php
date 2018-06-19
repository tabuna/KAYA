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
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function index(Team $team, Request $request)
  {

    $staticsForYear = collect([
      1  => 'Январь',
      2  => 'Февраль',
      3  => 'Март',
      4  => 'Апрель',
      5  => 'Май',
      6  => 'Июнь',
      7  => 'Июль',
      8  => 'Август',
      9  => 'Сентябрь',
      10 => 'Октябрь',
      11 => 'Ноябрь',
      12 => 'Декабрь',
    ]);


    collect(Log::getStaticsForYear(date('Y', time())))->map(function ($item) use ($staticsForYear) {
      $staticsForYear[$item->month_number] = [
        'name'  => $staticsForYear[$item->month_number],
        'count' => $item->count,
      ];
    });

    foreach ($staticsForYear as $key => $value) {
      if (!is_array($value)) {
        $staticsForYear[$key] = [
          'name'  => $staticsForYear[$key],
          'count' => 0,
        ];
      }

    }

    $logs = $team->log()->filters()->where('team_id', $team->id);

    $groupRemoteAddress = $team->log()->filters()
      ->select('remote_address', DB::raw('count(remote_address) as count'))
      ->where('team_id', $team->id)
      ->groupBy('remote_address')
      ->orderByDesc('count')
      ->limit(30);

    if ($request->has('search')) {
      $logs->where('message', 'like', '%' . $request->get('search') . '%');
      $groupRemoteAddress->where('message', 'like', '%' . $request->get('search') . '%');
    }

    if ($request->has('start_created_at')) {
      $logs->where('created_at', '>', $request->get('start_created_at'));
    }

    if ($request->has('remote_address')) {
      $logs->where('remote_address', $request->get('remote_address'));
    }

    if ($request->has('end_created_at')) {
      $logs->where('created_at', '<', $request->get('end_created_at'));
    }

    $tags = $request->session()->get($team->slug . '-tags', []);
    foreach ($tags as $key => $tag) {
      $tag = strval($tag);

      $logs->where('message' . $key, $tag);
      $groupRemoteAddress->where('message' . $key, $tag);
    }


    $statictics = clone $logs;

    $statictics
      ->select(
        DB::raw('DATE(`created_at`) as date'),
        DB::raw('count(*) as count')
      )
      ->groupBy('date')
      ->orderBy('date');


    return view('log.index', [
      'team'               => $team,
      'logs'               => $logs->orderBy('created_at', 'desc')->simplePaginate(),
      'groupRemoteAddress' => $groupRemoteAddress->get(),
      'tags'               => $tags,
      'statictics'         => $statictics->get(),
      'staticsForYear'     => $staticsForYear,
    ]);
  }

  /**
   * @param Team    $team
   * @param Request $request
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function addTag(Team $team, Request $request)
  {
    $tags = $request->session()->get($team->slug . '-tags', []);
    $tags[$request->get('key')] = $request->get('value');
    $request->session()->put($team->slug . '-tags', $tags);

    return response()->json($tags);
  }

  /**
   * @param Team    $team
   * @param Request $request
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function removeTag(Team $team, Request $request)
  {
    $tags = $request->session()->get($team->slug . '-tags', []);
    unset($tags[$request->get('key')]);
    $request->session()->put($team->slug . '-tags', $tags);

    return response()->json($tags);
  }
}
