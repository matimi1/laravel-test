<?php

namespace App\Http\Controllers;

use DB;
use App\Models\MovieType;
use Illuminate\Http\Request;

class VideogameController extends Controller
{
    public function topRated()
    {
        $game_type = MovieType::where('name', 'game')->first();

        // starts a query builder:
        $game_type->movies(); // FROM `movies` WHERE `movie_type_id` = ?

        $games = $game_type->movies()
            ->where('votes_nr', '>=', 5000)
            ->orderBy('rating', 'desc')
            ->limit(50)
            ->get();

        // $query = "
        //     SELECT *
        //     FROM `movies`
        //     WHERE `votes_nr` >= ?
        //         AND `movie_type_id` = ?
        //     ORDER BY `rating` DESC
        //     LIMIT 50
        // ";

        // $games = DB::select($query, [5000, 7]);

        return view('games.top-rated', [
            'games' => $games
        ]);
    }
}
