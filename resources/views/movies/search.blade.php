<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie search</title>
</head>
<body>

    <h1>Search for a movie</h1>

    <form action="{{ route('search') }}" method="get">

        <input
            type="text"
            name="search"
            value="{{ $search_term }}"
        >

        <button>Search</button>

        {{-- this is really hidden from the outside --}}

    </form>

    <ul>
        @foreach ($results as $movie)
            <li>
                <a href="{{ route('movie.detail', $movie->id) }}">
                    {{ $movie->name }}
                    ({{ $movie->year }})
                </a>
            </li>
        @endforeach
    </ul>

</body>
</html>