<?php

namespace App\Http\Controllers\Teamwork;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Mpociot\Teamwork\Facades\Teamwork;
use Mpociot\Teamwork\TeamInvite;
use Orchid\Support\Facades\Alert;

class AuthController extends Controller
{

    /**
     * Accept the given invite
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function acceptInvite($token)
    {
        $invite = Teamwork::getInviteFromAcceptToken($token);
        if (!$invite) {
            Alert::success('Вы уже приняли приглашение или его не существует');
            return back();
        }

        if (auth()->check()) {
            Teamwork::acceptInvite($invite);
            return redirect()->route('platform.screens.teams.list');
        } else {
            session(['invite_token' => $token]);
            return redirect()->to('login');
        }
    }

}