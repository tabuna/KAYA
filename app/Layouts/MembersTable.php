<?php

namespace App\Layouts;

use App\User;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Fields\TD;

class MembersTable extends Table
{

    /**
     * @var string
     */
    public $data = 'users';

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            TD::set('name','Пользователи'),
            /*
            TD::set('name','Action')
                ->width(100)
                ->setRender(function (User $user){
                return view('particals.action-team',[
                    'user' => $user
                ]);
            }),
            */
        ];
    }
}
