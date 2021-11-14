<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Artist extends Model
{
    use AsSource, Filterable;

    protected $fillable = [
        'name',
        'image',
        'genres',
        'uri',
    ];

    public function tracks()
    {
        return $this->hasMany(Track::class);
    }

    public function scopePopular($query)
    {
        $query->selectRaw('artists.name, artists.image, artists.genres, COUNT(tracks.artist_id) as count')
        ->leftJoin('tracks', 'artists.id', '=', 'tracks.artist_id')
        ->groupBy('artists.name', 'artists.image', 'artists.genres')
        //->orderBy('count', 'desc')
        ->get();

        return $query;
        
    }

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'name',
        'genres',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'name',
        'genres',
        'count',
    ];
}
