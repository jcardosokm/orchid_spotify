<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ArtistController extends Controller
{
    public function getPopularArtistFromUser($token)
    {
        $artists = Http::withToken($token)
        ->get('https://api.spotify.com/v1/me/top/artists?time_range=long_term');
        dd($artists);
    }
}
