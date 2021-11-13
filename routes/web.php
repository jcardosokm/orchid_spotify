<?php

use App\Http\Controllers\TrackController;
use Illuminate\Support\Facades\Route;
use App\Orchid\Screens\MostPopularArtists;
use App\Orchid\Screens\MostPopularTracks;
use App\Orchid\Screens\MyPopularArtists;
use App\Orchid\Screens\MyPopularTracks;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login/spotify', 'App\Http\Controllers\SpotifyLoginController@redirect');
Route::get('login/spotify/callback', 'App\Http\Controllers\SpotifyLoginController@callback');

Route::screen('all/popular/artists', MostPopularArtists::class);
Route::screen('all/popular/tracks', MostPopularTracks::class);

Route::screen('me/popular/artists', MyPopularArtists::class)->middleware('auth');;
Route::screen('me/popular/tracks', MyPopularTracks::class)->middleware('auth');;

Route::get('tracks/edit/visibility/{id}', [TrackController::class, 'visibility']);

Route::get('login', array('as' => 'login', function () {
    return redirect('all/popular/artists');
}));

Route::get('/', function () {
    return redirect('all/popular/artists');
});
