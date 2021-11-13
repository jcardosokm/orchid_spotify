<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Track;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TrackController extends Controller
{
    public function visibility($id, Request $request)
    {
        $track = Track::where([
            ['id', '=', $id],
            ['user_id', '=', Auth::user()->id],
        ])->first();

        if ($track) {
            if ($track['visible'] == 0) {
                DB::update('update tracks set visible = 1 where id = ?', [$id]);
            } else {
                DB::update('update tracks set visible = 0 where id = ?', [$id]);
            }
        }

        return redirect('/me/popular/tracks');
    }
}
