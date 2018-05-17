<?php

namespace App\Layouts;

use Orchid\Platform\Fields\Field;
use Orchid\Platform\Layouts\Rows;

class TeamEdit extends Rows
{

    /**
     * Views
     *
     * @return array
     * @throws \Orchid\Platform\Exceptions\TypeException
     */
    public function fields(): array
    {
        return [
            Field::tag('input')
                ->type('text')
                ->name('team.name')
                ->required()
                ->title('Название проекта')
                ->help('Как называется команда?'),

            Field::tag('input')
                ->type('text')
                ->name('team.token')
                ->readonly()
                ->title('Название проекта')
                ->help('Как называется команда?'),
        ];
    }
}
