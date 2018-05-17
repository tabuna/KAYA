<?php

namespace App\Http\Composers;

use Illuminate\Support\Facades\Auth;
use Orchid\Platform\Dashboard;

class MenuDashboardComposer
{
    /**
     * @var Dashboard
     */
    private $dashboard;

    /**
     * MenuComposer constructor.
     *
     * @param Dashboard $dashboard
     */
    public function __construct(Dashboard $dashboard)
    {
        $this->dashboard = $dashboard;
    }

    /**
     * Registering the main menu items.
     */
    public function compose()
    {
        $this->dashboard->menu
            ->add('Main', [
                'slug'   => 'Project',
                'icon'   => 'icon-list',
                'route'  => '#',
                'label'  => 'Журнал',
                'sort'   => 2,
                'active' => 'dashboard.screens.logs.*',
                'childs' => true
            ])->add('Main', [
                'slug'   => 'Teams',
                'icon'   => 'icon-people',
                'route'  => route('dashboard.screens.teams.list'),
                'label'  => 'Проекты',
                'sort'   => 2,
                'active' => 'dashboard.screens.teams.*',
            ]);

        foreach (Auth::user()->teams as $key => $team) {

            $teamMenu = [
                'slug'  => $team->slug,
                'icon'  => 'icon-layers',
                'route' => route('dashboard.screens.logs.show',$team->slug),
                'label' => $team->name,
                'sort'  => $key,
            ];

            if ($key === 0) {
                $teamMenu['groupname'] = 'Управление проектами';
            }

            $this->dashboard->menu
                ->add('Project', $teamMenu);
        }

    }
}