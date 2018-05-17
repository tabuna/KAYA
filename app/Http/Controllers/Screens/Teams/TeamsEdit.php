<?php

namespace App\Http\Controllers\Screens\Teams;

use App\Layouts\MembersTable;
use App\Layouts\TeamEdit;
use App\Team;
use Illuminate\Http\Request;
use Orchid\Platform\Screen\Layouts;
use Orchid\Platform\Screen\Link;
use Orchid\Platform\Screen\Screen;

class TeamsEdit extends Screen
{
    /**
     * Display header name
     *
     * @var string
     */
    public $name = 'Проект';

    /**
     * Display header description
     *
     * @var string
     */
    public $description = 'Редактирование проекта';

    /**
     * Query data
     *
     * @param Team|null $team
     * @return array
     */
    public function query(Team $team = null) : array
    {
        return [
            'team' => $team,
            'users' => $team->users()->paginate(),
        ];
    }

    /**
     * Button commands
     *
     * @return array
     */
    public function commandBar() : array
    {
        return [
            Link::name('Назад')
                ->icon('icon-left m-r-xs')
                ->link(redirect()->back()->getTargetUrl()),

            Link::name('Пригласить пользователя')
                ->modal('')
                ->title('Приглашение в команду')
                ->icon('icon-friends m-r-xs')
                ->method('update'),

            Link::name('Сохранить')
                ->slug('project')
                ->icon('icon-check m-r-xs')
                ->method('update')
        ];
    }

    /**
     * Views
     *
     * @return array
     * @throws \Orchid\Press\TypeException
     */
    public function layout() : array
    {
        return [
            Layouts::columns([
                [
                    MembersTable::class,
                ],
                [
                    TeamEdit::class,
                ]
            ])
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        return back();
    }

}
