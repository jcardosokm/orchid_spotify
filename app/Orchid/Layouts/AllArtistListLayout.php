<?php

declare(strict_types=1);

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Input;

class AllArtistListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'artists';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('image', '')
                ->width('100')
                ->render(function ($artist) {
                    return '<img src="' . $artist->image . '" alt="sample" class="mw-100 rounded img-fluid">';
                }),

            TD::make('name', 'Name')
                ->sort()
                ->width('450'),
            /*
                ->render(function (Artist $artist) {
                    return $artist->get('name');
                }), 
                */

            TD::make('genres', 'Genres')
                ->sort()
                ->filter(Input::make())
                ->width('450')
            /*
                ->render(function (Artist $artist) {
                    return $artist->get('genres');
                })
                */,
            TD::make('count', 'Count')
                ->sort()
                ->width('450'),
        ];
    }
}
