<?php

namespace App\Layouts;

use Orchid\Platform\Layouts\Table;
use Orchid\Platform\Fields\TD;

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
                ->link('dashboard.index',''),
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
