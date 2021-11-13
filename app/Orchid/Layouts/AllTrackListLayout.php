<?php

declare(strict_types=1);

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Button;
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
            TD::make('artist_id', 'Artist')
                ->width('100')
                ->render(function ($track) {
                    return '<img class="mw-100 rounded img-fluid" src="' .
                        Artist::where('id', $track->artist_id)->get()->first()->image .
                        '">';
                }),

            TD::make('artist_id', 'Artist')
                ->width('450')
                ->render(function ($track) {
                    return Artist::where('id', $track->artist_id)->get()->first()->name;
                }),

            TD::make('name', 'Track name')
                ->width('450')
                ->render(function ($track) {
                    return $track->name;
                }),

            TD::make('genres', 'Genres')
                ->width('450')
                ->render(function ($track) {
                    return Artist::where('id', $track->artist_id)->get()->first()->genres;
                }),

            TD::make('count', 'Count')
                ->width('450')
                ->render(function ($track) {
                    return $track->count;
                }),
        ];
    }
}
