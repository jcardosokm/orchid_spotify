<?php

namespace App\Orchid\Screens;

use App\Models\Artist;
use App\Orchid\Layouts\AllArtistListLayout;
use Orchid\Screen\Screen;


class MostPopularArtists extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Most popular artists among all users';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'artists' => Artist::popular()->filters()->defaultSort('name')->paginate(),
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
            AllArtistListLayout::class,
        ];
    }
}
