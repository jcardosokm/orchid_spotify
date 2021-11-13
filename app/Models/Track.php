<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;
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
        $query->selectRaw('tracks.id, tracks.name, tracks.artist_id, tracks.visible, COUNT(tracks.artist_id) as count')
        ->join('artists', 'artists.id', '=', 'tracks.artist_id')
        ->groupBy('tracks.id','tracks.name','tracks.artist_id', 'tracks.visible')
        ->orderBy('count', 'desc')
        ->get();

        return $query;
        
    }

}
