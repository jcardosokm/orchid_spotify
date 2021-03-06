<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Orchid\Metrics\Chartable;

class Track extends Model
{
    use AsSource, Filterable, Chartable;
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
        'genres',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'name',
        'artist_name',
        'track_name',
        'genres',
        'visible',
        'count'
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
        $query->selectRaw('artists.name as artist_name, tracks.name as track_name, tracks.artist_id, tracks.visible, COUNT(tracks.name) as count')
            ->join('artists', 'artists.id', '=', 'tracks.artist_id')
            ->groupBy('artist_name', 'tracks.name', 'tracks.artist_id','tracks.visible')
            //->orderBy('count', 'desc')
            ->get();
        return $query;
    }

    public function scopeActive($query)
    {
        $query->selectRaw('tracks.*, artists.*')
            ->join('artists', 'artists.id', '=', 'tracks.artist_id')
            ->get();

        return $query;
    }
}
