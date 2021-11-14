<?php

declare(strict_types=1);

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Input;
use App\Models\Artist;

class TrackListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'tracks';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('', '')
                ->width('100')
                ->render(function ($track) {
                    return '<img class="mw-100 rounded img-fluid" src="' .
                        Artist::where('id', $track->artist_id)->get()->first()->image .
                        '">';
                }),

            TD::make('artists_name', 'Artist')
                ->sort()
                ->width('450')
                ->render(function ($track) {
                    return $track->artist_name;
                }),

            TD::make('name', 'Track name')
                ->sort()
                ->filter(Input::make())
                ->width('450')
                ->render(function ($track) {
                    return $track->track_name;
                }),

            TD::make('genres', 'Genres')
                ->sort()
                ->filter(Input::make())
                ->width('450')
                ->render(function ($track) {
                    return implode(",",json_decode(Artist::where('id', $track->artist_id)->get()->first()->genres));
                }),

            TD::make('visible', 'Visibility')
                ->sort()
                ->width('200')
                ->render(function ($track) {
                    //dd($track->id);
                    if ($track->visible == 0) {
                        return '<a href="/tracks/edit/visibility/' . $track->id . '">
                    <button type="button" class="btn btn-danger btn-sm">
                    Hidden - Click to Show</button></a>';
                    } else {
                        return '<a href="/tracks/edit/visibility/' . $track->id . '">
                    <button type="button" class="btn btn-success btn-sm">
                    Displayed - Click to Hide</button></a>';
                    }

                    /*return CheckBox::make('visible')
                ->value($track->visible)
                ->route('/track/edit', $track);*/
                }),
        ];
    }
}
