<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Orchid\Platform\Models\Role;
use App\Models\Artist;
use App\Models\Track;

class SpotifyLoginController extends Controller
{
    public function redirect()
    {
        $url = "https://accounts.spotify.com/authorize?" .
            "client_id=" . env('SPOTIFY_CLIENT_ID') .
            "&response_type=" . "code" .
            "&redirect_uri=" . env('SPOTIFY_URL') .
            "&scope=" . "user-read-private user-read-email user-top-read" .
            "&show_dialog=true";

        return redirect()->away($url);
    }

    public function callback(Request $request)
    {

        $response = Http::asForm()->post('https://accounts.spotify.com/api/token', [
            'grant_type' => 'authorization_code',
            'code' => $request->input('code'),
            'redirect_uri' => env('SPOTIFY_URL'),
            'client_id' => env('SPOTIFY_CLIENT_ID'),
            'client_secret' => env('SPOTIFY_CLIENT_SECRET'),
        ]);

        $profile = Http::withToken(json_decode($response)->access_token)->get('https://api.spotify.com/v1/me');

        if ($user = User::where('uri', json_decode($profile)->uri)->first()) {
            $user->access_token = json_decode($response)->access_token;
            $user->refresh_token = json_decode($response)->refresh_token;
            $user->save();
            Auth::login($user);
        } else {
            $user = new User;
            $user->name = json_decode($profile)->display_name;
            $user->email = json_decode($profile)->email;
            $user->access_token = json_decode($response)->access_token;
            $user->refresh_token = json_decode($response)->refresh_token;
            $user->uri = json_decode($profile)->uri;
            $user->save();
            $user->addRole(Role::where('slug', 'user')->first());
            Auth::login($user);

            $tracks = Http::withToken($user->access_token)
                ->get('https://api.spotify.com/v1/me/top/tracks?time_range=long_term');


            foreach (json_decode($tracks)->items as $track) {

                if ($artist = Artist::where('uri', $track->artists[0]->uri)->first()) {
                    $track = new Track(['name' => $track->name, 'artist_id' => $artist->id, 'user_id' => auth()->user()->id, 'uri' => $track->uri]);
                    $track->save();
                } else {
                    $artistinfo = Http::withToken($user->access_token)
                        ->get('https://api.spotify.com/v1/artists/' . $track->artists[0]->id);
                    
                    
                    $artist = new Artist(['name' => $track->artists[0]->name, 'image' => json_decode($artistinfo)->images[0]->url, 'genres' => json_decode($artistinfo)->genres[0], 'uri' => $track->artists[0]->uri]);
                    $artist->save();
                    $track = new Track(['name' => $track->name, 'artist_id' => $artist->id, 'user_id' => auth()->user()->id, 'uri' => $track->uri]);
                    $track->save();
                }
            }

            Auth::login($user);
        }

        return redirect('/me/popular/tracks');
    }
}
