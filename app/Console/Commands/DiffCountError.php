<?php

namespace App\Console\Commands;

use App\Team;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Platform\Notifications\DashboardNotification;

class DiffCountError extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'diff:error';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comparing errors with the previous day';

    /**
     * @var string
     */
    protected $yesterday;

    /**
     * @var string
     */
    protected $today;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->yesterday = Carbon::today()->toDateString();
        $this->today = Carbon::yesterday()->toDateString();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Team::chunk(200, function ($teams) {
            foreach ($teams as $team) {
                $log = $team->log();

                $yesterday = $this->getCountDate($log, $this->yesterday);
                $today = $this->getCountDate($log, $this->today);

                $diff = abs((($yesterday / $today) - 1) * 100);

                if ($diff > 10) {
                    $this->noticeTeam($team, $diff);
                }
            }
        });
    }


    /**
     * @param \Illuminate\Database\Eloquent\Relations\HasMany $log
     * @param                                                 $date
     *
     * @return int
     */
    public function getCountDate(HasMany $log, $date)
    {
        $date = $log->whereDate('created_at', $date)
            ->count();

        return ($date !== 0) ? $date : 1;
    }

    /**
     * @param \App\Team $team
     * @param float     $diff
     */
    public function noticeTeam(Team $team, float $diff)
    {
        $team->users()->each(function ($user) use ($team, $diff) {
            $user->notify(new DashboardNotification([
                'title'   => 'Изменение ошибок',
                'message' => 'Тут я должен написать воодушевляющую речь',
                'action'  => route('platform.screens.logs.show', [
                    'project'          => $team,
                    'start_created_at' => $this->today,
                ]),
                'type'    => ($diff > 0) ? 'info' : 'danger',
            ]));
        });
    }
}
