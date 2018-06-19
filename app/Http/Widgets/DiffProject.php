<?php

namespace App\Http\Widgets;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Orchid\Widget\Widget;

class DiffProject extends Widget {

    /**
     * @param null $arguments
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed|void
     */
    public function handler($arguments = null){

      try {
        $projects = Auth::user()->teams()->get();
        $statics = [];

        $days = [6, 5, 4, 3, 2, 1, 0];

        foreach ($days as $day) {
          foreach ($projects as $key => $project) {
            $statics[$project->name][$day] = $project->log()
              ->whereDate('created_at', Carbon::now()->subDay($day)->toDateString())
              ->count();
          }
        }

        foreach ($days as $key => $day) {
          $days[$key] = Carbon::now()->subDay($day)->toDateString();
        }


        return view('welcome', [
          'days'    => $days,
          'statics' => $statics,
        ]);
      }catch (\Exception $exception){
        return;
      }
    }

}
