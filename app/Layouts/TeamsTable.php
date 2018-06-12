<?php

namespace App\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Fields\TD;

class TeamsTable extends Table
{

    /**
     * @var string
     */
    public $data = 'teams';

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            TD::set('id','ID')
                ->width(100)
                ->align('center')
                ->sort()
                ->link('platform.screens.teams.edit','slug'),
            TD::set('name','Название')
                ->sort()
                ->width(300),
            TD::set('status','Статус')
                ->setRender(function ($team){
                if(auth()->user()->isOwnerOfTeam($team)) {
                   return '<span class="text-success"> Владелец</span>';
                }
                return '<span class="text-primary">Участник</span>';
            }),
        ];
    }
}
