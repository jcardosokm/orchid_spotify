<?php

namespace App\Orchid\Screens;

use App\Models\Track;
use App\Orchid\Layouts\AllTrackListLayout;
use Orchid\Screen\Screen;


class MostPopularTracks extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Most popular tracks among all users';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {

        return [
            'tracks' => Track::popular()->where('visible', true)->filters()->defaultSort('id')->paginate(),
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            AllTrackListLayout::class,
        ];
    }
}
