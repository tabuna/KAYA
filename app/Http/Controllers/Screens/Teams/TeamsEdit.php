<?php

namespace App\Http\Controllers\Screens\Teams;

use Illuminate\Http\Request;
use Orchid\Platform\Screen\Screen;

class TeamsEdit extends Screen
{
    /**
     * Display header name
     *
     * @var string
     */
    public $name = 'TeamsEdit';

    /**
     * Display header description
     *
     * @var string
     */
    public $description = 'TeamsEdit';

    /**
     * Query data
     *
     * @return array
     */
    public function query() : array
    {
        return [];
    }

    /**
     * Button commands
     *
     * @return array
     */
    public function commandBar() : array
    {
        return [];
    }

    /**
     * Views
     *
     * @return array
     * @throws \Orchid\Press\TypeException
     */
    public function layout() : array
    {
        return [];
    }
}
