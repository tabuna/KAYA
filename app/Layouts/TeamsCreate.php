<?php

namespace App\Layouts;

use Orchid\Platform\Fields\Field;
use Orchid\Platform\Layouts\Rows;

class TeamsCreate extends Rows
{

    /**
     * @return array
     *
     * @throws \Orchid\Platform\Exceptions\TypeException
     */
    public function fields(): array
    {
        return [
            Field::tag('input')
                ->type('text')
                ->name('name')
                ->required()
                ->title('Название проекта')
                ->help('Как называется команда?'),
        ];
    }
}
