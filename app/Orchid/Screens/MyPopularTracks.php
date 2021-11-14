<?php

namespace App\Orchid\Screens;

use App\Models\Track;
use App\Orchid\Layouts\TrackListLayout;
use Illuminate\Support\Env;
use Orchid\Screen\Screen;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Link;

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
            'tracks' => Track::popular()->where('user_id', Auth::user()->id)->filters()->paginate(),
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
            //to be changed
            Link::make('Back')->href(Env('APP_URL')),
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

    public function backbtn(){
        return redirect()->back();
    }
}
