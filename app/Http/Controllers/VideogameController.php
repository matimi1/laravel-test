<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class VideogameController extends Controller
{
    public function topRated()
    {
        $query = "
            SELECT *
            FROM `movies`
            WHERE `votes_nr` >= ?
                AND `movie_type_id` = ?
            ORDER BY `rating` DESC
            LIMIT 50
        ";

        $games = DB::select($query, [5000, 7]);

        return view('games.top-rated', [
            'games' => $games
        ]);
    }
}
