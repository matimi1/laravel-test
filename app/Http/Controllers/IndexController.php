<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

// FQN: App\Http\Controllers\IndexController
class IndexController extends Controller
{
    /**
     * the index action of the IndexController
     *
     *
     */
    public function index()
    {
        // return 'Hello, world! (from the index action of the IndexController)';
        $user = [
            'name' => 'Jan',
            'role' => 'admin'
        ];

        // dd($user);

        $top_movies = DB::select('
            SELECT *
            FROM `movies`
            ORDER BY `rating` DESC
            LIMIT 10
        ');

        // dd($top_movies);

        // resources/views/index/index.blade.php
        return       view('index/index', [
            'my_variable' => 'Hello, world!', // creates variable $my_variable in the view
            'things_to_do' => [               // creates variable $things_to_do in the view
                'one thing',
                'another thing'
            ],
            'user' => $user,                   // creates variable $user in the view
            'top_10_movies' => $top_movies
        ]);
    }


    public function top20movies()
    {
        return '<h1>These are the top 20 movies of this year</h1>';
    }
}
