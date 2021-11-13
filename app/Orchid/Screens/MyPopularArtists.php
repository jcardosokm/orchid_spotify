<?php

namespace App\Orchid\Screens;

use App\Models\Artist;
use App\Orchid\Layouts\ArtistListLayout;
use Orchid\Screen\Screen;
use Illuminate\Support\Facades\Auth;

class MyPopularArtists extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Your personal popular artists';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'artists' => Artist::popular()->where('user_id', Auth::user()->id)->get(),
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
            ArtistListLayout::class,
        ];
    }
}
