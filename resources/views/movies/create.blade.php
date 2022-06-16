<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $movie->id ? 'Edit': 'Create' }} a movie</title>
</head>
<body>

    <h1>{{ $movie->id ? 'Edit': 'Create' }} a movie</h1>

    @if ($movie->id)
        <form action="/movies/{{ $movie->id }}" method="post">
            @method('put')
    @else
        <form action="{{ action('MovieController@store') }}" method="post">
    @endif
        @csrf

            <label>Name:</label>
            <input
                type="text"
                name="name"
                value="{{ $movie->name }}"
            >

            <label>Year:</label>
            <input
                type="text"
                name="year"
                value="{{ $movie->year }}"
            >

        <button>Send</button>

    </form>
</body>
</html>
