<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Orchid\Platform\Models\User as Authenticatable;
use Mpociot\Teamwork\Traits\UserHasTeams;

class User extends Authenticatable
{
    use Notifiable, UserHasTeams;

}
