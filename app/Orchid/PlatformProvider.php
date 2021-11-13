<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;
use Illuminate\Support\Facades\Auth;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [

            Menu::make('Log in with your Spotify Account')
                ->icon('login')
                ->canSee(Auth::guest())
                ->url('/login/spotify'),

            Menu::make('Artists')
                ->icon('people')
                ->title('All users most popular')
                ->url('/all/popular/artists'),

            Menu::make('Tracks')
                ->icon('music-tone-alt')
                ->url('/all/popular/tracks'),

            Menu::make('Artists')
                ->icon('people')
                ->title('Your personal most popular')
                ->canSee(Auth::check())
                ->url('/me/popular/artists'),

            Menu::make('Tracks')
                ->icon('music-tone-alt')
                ->canSee(Auth::check())
                ->url('/me/popular/tracks'),

            Menu::make(__('Users'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access rights')),

            Menu::make(__('Roles'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),
        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make('Profile')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
