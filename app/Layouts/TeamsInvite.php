<?php

namespace App\Layouts;

use Orchid\Platform\Fields\Field;
use Orchid\Platform\Layouts\Rows;

class TeamsInvite extends Rows
{
    /**
     * @return array
     * @throws \Orchid\Platform\Exceptions\TypeException
     */
    public function fields(): array
    {
        return [
            Field::tag('input')
                ->type('text')
                ->name('email')
                ->required()
                ->title('Электронная почта пользователя')
                ->help('Пользователь получит email сообщение для активации'),
        ];
    }
}
