<?php

declare(strict_types=1);

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Input;
use App\Models\Artist;

class AllTrackListLayout extends Table
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
            TD::make('artist_id', '')
                ->width('100')
                ->render(function ($track) {
                    return '<img class="mw-100 rounded img-fluid" src="' .
                        Artist::where('id', $track->artist_id)->get()->first()->image .
                        '">';
                }),

            TD::make('artist_name', 'Artist')
                ->sort()
                ->width('450')
                ->render(function ($track) {
                    return Artist::where('id', $track->artist_id)->get()->first()->name;
                }),

            TD::make('track_name', 'Track name')
                ->sort()
                ->width('450')
                ->render(function ($track) {
                    return $track->track_name;
                }),

            TD::make('genres', 'Genres')
                ->width('450')
                ->filter(Input::make())
                ->render(function ($track) {
                    return implode(",", json_decode(Artist::where('id', $track->artist_id)->get()->first()->genres));
                }),

            TD::make('count', 'Count')
                ->sort()
                ->width('450')
                ->render(function ($track) {
                    return $track->count;
                }),
        ];
    }
}
