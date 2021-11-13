<?php

declare(strict_types=1);

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use App\Models\Artist;

class ArtistListLayout extends Table
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
                    return '<img src="'.$artist->image.'" alt="sample" class="mw-100 rounded img-fluid">';
                }),
            
            TD::make('name', 'Name')
                ->width('450'),
                /*
                ->render(function (Artist $artist) {
                    return $artist->get('name');
                }), 
                */

            TD::make('genres', 'Genres')
                ->width('450')
                /*
                ->render(function (Artist $artist) {
                    return $artist->get('genres');
                })
                */
                ,
                TD::make('count', 'Count')
                ->width('450'),
        ];
    }
}
