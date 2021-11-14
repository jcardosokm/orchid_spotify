<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class Track extends Model
{
    use AsSource, Filterable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'artist_id',
        'user_id',
        'uri',
        'visible',
    ];

    protected $allowedFilters = [
        'name',
        'artist_name',
        'artist_id',
        'genres'
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'name',
        'artist_name',
        'genres',
        'visible',
    ];

    public function artists()
    {
        return $this->belongsTo(Artist::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePopular($query)
    {
        $query->selectRaw('artists.name as artist_name, tracks.id, tracks.name as track_name, tracks.artist_id, tracks.visible, COUNT(tracks.artist_id) as count')
            ->join('artists', 'artists.id', '=', 'tracks.artist_id')
            ->groupBy('tracks.id', 'tracks.name', 'tracks.artist_id', 'tracks.visible')
            ->orderBy('count', 'desc')
            ->get();

        return $query;
    }
}
