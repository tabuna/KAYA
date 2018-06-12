<?php

namespace App\Http\Controllers\Screens\Teams;

use App\Layouts\TeamsCreate;
use App\Layouts\TeamsTable;
use App\Team;
use Illuminate\Http\Request;
use Orchid\Screen\Layouts;
use Orchid\Screen\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class TeamsList extends Screen
{
    /**
     * Display header name
     *
     * @var string
     */
    public $name = 'Проекты';

    /**
     * Display header description
     *
     * @var string
     */
    public $description = 'Ваши проекты/команды';

    /**
     * Query data
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'teams' => auth()->user()->teams()->paginate()
        ];
    }

    /**
     * Button commands
     *
     * @return array
     */
    public function commandBar(): array
    {
        return [
            Link::name('Создать проект')
                ->modal('createTeam')
                ->method('createTeam'),
        ];
    }

    /**
     * Views
     *
     * @return array
     */
    public function layout(): array
    {
        return [
            TeamsTable::class,
            Layouts::modals([
                'createTeam' => [
                    TeamsCreate::class,
                ],
            ]),
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createTeam(Request $request)
    {
        $team = Team::create([
            'name'     => $request->get('name'),
            'owner_id' => $request->user()->getKey(),
            'token'    => bcrypt($request->get('name') . $request->user()->getKey())
        ]);
        $request->user()->attachTeam($team);

        Alert::success('Message');

        return redirect()->back();
    }
}
