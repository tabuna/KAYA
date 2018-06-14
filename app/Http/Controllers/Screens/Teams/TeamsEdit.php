<?php

namespace App\Http\Controllers\Screens\Teams;

use App\Layouts\MembersTable;
use App\Layouts\TeamEdit;
use App\Layouts\TeamsInvite;
use App\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Mpociot\Teamwork\Facades\Teamwork;
use Orchid\Platform\Notifications\DashboardNotification;
use Orchid\Screen\Layouts;
use Orchid\Screen\Link;
use Orchid\Screen\Screen;
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
     *
     * @return array
     */
    public function query(Team $team = null): array
    {
        return [
            'team'  => $team,
            'users' => $team->users()->paginate(),
        ];
    }

    /**
     * Button commands
     *
     * @return array
     */
    public function commandBar(): array
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


        if (auth()->user()->isOwnerOfTeam($this->arguments[0])) {
            $commandBar[] = Link::name('Удалить')
                ->slug('project')
                ->icon('icon-check m-r-xs')
                ->method('delete');
        }


        return $commandBar;
    }

    /**
     * Views
     *
     * @return array
     * @throws \Orchid\Press\TypeException
     */
    public function layout(): array
    {
        return [
            Layouts::columns([
                [
                    MembersTable::class,
                ],
                [
                    TeamEdit::class,
                ],
            ]),
            Layouts::modals([
                'invite' => [
                    TeamsInvite::class,
                ],
            ]),
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Team    $team
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Team $team, Request $request)
    {
        $team->fill($request->get('team'))->save();

        Alert::success('Вы успешно обновили описание');

        return back();
    }

    /**
     * @param Team $team
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function delete(Team $team)
    {
        if (!auth()->user()->isOwnerOfTeam($team)) {
            abort(403);
        }

        $team->delete();

        User::where('current_team_id', $team->id)
            ->update(['current_team_id' => null]);


        Alert::success('Проект был удалён');

        return redirect('/');
    }

    /**
     * @param Team    $team
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function invite(Team $team, Request $request)
    {
        if (Teamwork::hasPendingInvite($request->email, $team)) {
            return redirect()->back()->withErrors([
                'email' => 'Пользователь с такой электронной почты уже приглашен в команду.',
            ]);
        }

        Teamwork::inviteToTeam($request->email, $team, function ($invite) use ($request) {
            $user = User::where('email', $request->email)->first();

            if (!is_null($user)) {
                $user->notify(new DashboardNotification([
                    'title'   => "Приглашение в группу '{$invite->team->name}'",
                    'message' => 'Перейдите по ссылке',
                    'action'  => route('teams.accept_invite', $invite->accept_token),
                    'type'    => 'info',
                ]));
            }

            Mail::send('teamwork.emails.invite', ['team' => $invite->team, 'invite' => $invite], function ($m) use ($invite) {
                $m->to($invite->email)->subject('Invitation to join team ' . $invite->team->name);
            });
            // Send email to user
        });

        Alert::success('Пользователь был приглашён');
        return back();
    }


}
