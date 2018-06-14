<?php

namespace App\Layouts;

use Orchid\Screen\Fields\Field;
use Orchid\Screen\Layouts\Rows;

class TeamEdit extends Rows
{

    /**
     * @return array
     * @throws \Throwable
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
                ->name('team.slug')
                ->readonly()
                ->title('Системное имя проекта'),

            Field::tag('input')
                ->type('text')
                ->name('team.token')
                ->readonly()
                ->title('API ключ для проекта'),
        ];
    }
}
