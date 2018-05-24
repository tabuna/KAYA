<?php

namespace App\Http\Controllers\Screens\Teams;

use App\Layouts\MembersTable;
use App\Layouts\TeamEdit;
use App\Layouts\TeamsInvite;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Mpociot\Teamwork\Facades\Teamwork;
use Orchid\Platform\Screen\Layouts;
use Orchid\Platform\Screen\Link;
use Orchid\Platform\Screen\Screen;
use Orchid\Support\Facades\Alert;

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
        $commandBar = [
            Link::name('Пригласить пользователя')
                ->modal('invite')
                ->title('Приглашение в команду')
                ->icon('icon-friends m-r-xs')
                ->method('invite'),

            Link::name('Сохранить')
                ->icon('icon-check m-r-xs')
                ->method('update'),
        ];


        if(auth()->user()->isOwnerOfTeam($this->arguments[0])){
            $commandBar[] = Link::name('Удалить')
                ->slug('project')
                ->icon('icon-check m-r-xs')
                ->method('update');
        }


        return $commandBar;
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
            ]),
            Layouts::modals([
                'invite' =>[
                     TeamsInvite::class
                 ]
            ]),
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Team    $team
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Team $team, Request $request)
    {
        $team->fill($request->get('team'))->save();

        Alert::success('Вы успешно обновили описание');

        return back();
    }

    /**
     * @param Team    $team
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function invite(Team $team, Request $request)
    {

        if( !Teamwork::hasPendingInvite( $request->email, $team) )
        {
            Teamwork::inviteToTeam( $request->email, $team, function( $invite )
            {
                Mail::send('teamwork.emails.invite', ['team' => $invite->team, 'invite' => $invite], function ($m) use ($invite) {
                    $m->to($invite->email)->subject('Invitation to join team '.$invite->team->name);
                });
                // Send email to user
            });

            Alert::success('Пользователь был приглашён');
            return back();
        }

        return redirect()->back()->withErrors([
            'email' => 'Пользователь с такой электронной почты уже приглашен в команду.'
        ]);
    }

}
