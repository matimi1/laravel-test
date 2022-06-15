<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    public function popular()
    {
        return '<h1>Most popular actors NOW!</h1>';
    }

    public function detail($actor_id)
    {
        $actor = DB::selectOne('
            SELECT *
            FROM `people`
            WHERE `id` = ?
        ', [
            $actor_id
        ]);

        $all_movies = DB::select("
            SELECT `positions`.`name` AS position_name, `movies`.*
            FROM `movie_person`
            LEFT JOIN `positions`
                ON `movie_person`.`position_id` = `positions`.`id`
            LEFT JOIN `movies`
                ON `movie_person`.`movie_id` = `movies`.`id`
            WHERE `movie_person`.`person_id` = ?
        ", [
            $actor->id
        ]);

        $movies_sorted_by_position = [];
        foreach ($all_movies as $movie) {
            $movies_sorted_by_position[$movie->position_name][] = $movie;
        }

        return view('actors.detail', [
            'actor' => $actor,
            'movies' => $movies_sorted_by_position
        ]);
    }
}
