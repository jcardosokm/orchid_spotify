<?php

namespace App\Orchid\Screens;

use App\Models\Track;
use App\Orchid\Layouts\TrackListLayout;
use Orchid\Screen\Screen;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Symfony\Component\HttpFoundation\Request;

class MyPopularTracks extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */

    public $name = 'Your personal popular tracks';

    /**
     * Query data.
     *
     * @return array
     */

    public function query(): array
    {

        return [
            'tracks' => Track::popular()->where('user_id', Auth::user()->id)->get(),
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */

    public function commandBar(): array
    {
        return [
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */

    public function layout(): array
    {
        return [
            TrackListLayout::class
            ,
        ];
    }
}
