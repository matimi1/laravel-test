<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\MoviePerson;
use App\Models\Person;
use Illuminate\Http\Request;
use App\Http\Requests\MovieRequest;

class MovieController extends Controller
{
    public function index($sorting = null)
    {
        $starting_letter = 'b';

        $query_builder = Movie::query();

        if ($sorting == 'rating') {
            $query_builder->orderBy('rating');
        } elseif ($sorting == 'alpha') {
            $query_builder->orderBy('name'); // ORDER BY `name`
        }

        $movies = $query_builder
            ->where('name', '!=', '')     // WHERE `name` != ''
            ->limit(20)                   // LIMIT 20
            ->where('name', 'like', $starting_letter.'%') //   AND `name` LIKE 'a%'
            ->get();

        return view('movies/index', compact('movies', 'starting_letter'));

        // compact('movies', 'starting_letter');

        // [
        //     'movies' => $movies,
        //     'starting_letter' => $starting_letter
        // ]
    }

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

        $movies = DB::select($query, [5000, 1]);

        return view('movies.top-rated', [
            'movies' => $movies
        ]);
    }


    public function shawshank()
    {
        $movie = DB::selectOne('
            SELECT *
            FROM `movies`
            WHERE `id` = ?
        ', [
            111161
        ]);

        $all_people = DB::select("
            SELECT `positions`.`name` AS position_name, `people`.*
            FROM `movie_person`
            LEFT JOIN `positions`
                ON `movie_person`.`position_id` = `positions`.`id`
            LEFT JOIN `people`
                ON `movie_person`.`person_id` = `people`.`id`
            WHERE `movie_person`.`movie_id` = ?
        ", [
            $movie->id
        ]);

        $people_sorted_by_position = [];
        foreach ($all_people as $person) {
            $people_sorted_by_position[$person->position_name][] = $person;
        }

        return view('movies.detail', [
            'movie' => $movie,
            'people' => $people_sorted_by_position
        ]);
    }

    public function search(Request $request)
    {
        if ($request->has('search')) {

            $search_term = $request->input('search');

            $results = Movie::where('name', 'like', '%' . $search_term . '%')
                ->orderBy('name', 'asc')
                ->get();

        } else {

            // no searching
            $search_term = '';
            $results = collect();
        }

        return view('movies.search', [
            'search_term' => $search_term,
            'results' => $results
        ]);
    }

    public function detail($movie_id)
    {
        // $movie = Movie::where('id', $movie_id)->first();

        // $movie = Movie::find($movie_id);

        $movie = Movie::findOrFail($movie_id);

        $all_people = MoviePerson::query()
            ->leftJoin('positions', 'movie_person.position_id', 'positions.id')
            ->leftJoin('people', 'movie_person.person_id', 'people.id')
            ->where('movie_person.movie_id', $movie->id)
            ->selectRaw('`positions`.`name` AS position_name, `people`.*')
            ->get();

        $all_people = Person::query()
            ->rightJoin('movie_person', 'people.id', 'movie_person.person_id')
            ->leftJoin('positions', 'movie_person.position_id', 'positions.id')
            ->where('movie_person.movie_id', $movie->id)
            ->selectRaw('`positions`.`name` AS position_name, `people`.*')
            ->get();

        // $all_people = DB::select("
        //     SELECT `positions`.`name` AS position_name, `people`.*
        //     FROM `people`
        //     RIGHT JOIN `movie_person`
        //         ON `people`.`id` = `movie_person`.`person_id`
        //     LEFT JOIN `positions`
        //         ON `movie_person`.`position_id` = `positions`.`id`
        //     WHERE `movie_person`.`movie_id` = ?
        // ", [
        //     $movie->id
        // ]);

        // $all_people = DB::select("
        //     SELECT `positions`.`name` AS position_name, `people`.*
        //     FROM `movie_person`
        //     LEFT JOIN `positions`
        //         ON `movie_person`.`position_id` = `positions`.`id`
        //     LEFT JOIN `people`
        //         ON `movie_person`.`person_id` = `people`.`id`
        //     WHERE `movie_person`.`movie_id` = ?
        // ", [
        //     $movie->id
        // ]);

        $people_sorted_by_position = [];
        foreach ($all_people as $person) {
            $people_sorted_by_position[$person->position_name][] = $person;
        }

        return view('movies.detail', [
            'movie' => $movie,
            'people' => $people_sorted_by_position
        ]);
    }

    public function moviesOfGenre($genre_slug)
    {
        $genre = Genre::where('slug', $genre_slug)
            ->firstOrFail();

        $movies = $genre->movies()
            ->where('votes_nr', '>=', 5000)
            ->where('movie_type_id', 1)
            ->orderBy('rating', 'desc')
            ->limit(50)
            ->get();

        // dd( $movies );

        // $query = "
        //     SELECT `movies`.*
        //     FROM `genre_movie`
        //     LEFT JOIN `movies`
        //         ON `genre_movie`.`movie_id` = `movies`.`id`
        //     WHERE `genre_movie`.`genre_id` = ?
        //         AND `votes_nr` >= ?
        //         AND `movie_type_id` = ?
        //     ORDER BY `rating` DESC
        //     LIMIT 50
        // ";

        // $movies = DB::select($query, [31, 5000, 1]);

        return view('movies.top-rated-genre', [
            'genre' => $genre,
            'movies' => $movies
        ]);
    }


    public function create()
    {
        // prepare empty object
        $movie = new Movie;

        // display the form view, passing in the movie
        return view('movies/create', compact('movie'));
    }

    public function store(MovieRequest $request)
    {
//        $this->validateMovie($request);
        $movie = new Movie;

        $movie->name = $request->input('name');
        $movie->year = $request->input('year');

        $movie->save();

        session()->flash('success_message', 'New movie registered.');

        return redirect( url('/movies/detail/'.$movie->id) );
    }

    public function edit($id)
    {
        $movie = Movie::findOrFail($id);

        return view('movies/create', compact('movie'));
    }

    public function update($id, MovieRequest $request)
    {
//        $this->validateMovie($request);
        $movie = Movie::findOrFail($id);

        $movie->name = $request->input('name');
        $movie->year = $request->input('year');

        $movie->save();

        session()->flash('success_message', 'Movie was edited.');

        return redirect( url('/movies/detail/'.$movie->id) );
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);

        $movie->delete();

        session()->flash('success_message', 'Movie was deleted.');

        return redirect( url('/top-rated-movies') );
    }
//    private function validateMovie($request)
//    {
//        $this->validate($request, [
//            'name' => 'required|min:5',
//            'year' => 'nullable|numeric',
//        ], [
//            'name.min' => '5!!!',
//            'name.required' => 'What????'
//        ]);
//    }
}
