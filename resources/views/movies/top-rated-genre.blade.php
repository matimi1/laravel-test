<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $genre->name ?>: top rated movies</title>
</head>
<body>

    <a href="<?= action(['App\Http\Controllers\MovieController', 'search']) ?>">Search</a>

    <h1>{{ $genre->name }}: top rated movies</h1>

    <ul>
        @foreach ($movies as $movie)
            <li>
                <a href="<?= action('MovieController@detail', $movie->id) ?>">
                    <?= $movie->name ?>
                    (<?= $movie->year ?>)
                </a>
                - <?= $movie->rating ?>/10
            </li>
        @endforeach
    </ul>

    @php
        $my_value = 'abc';
    @endphp

    @dump($my_value)

    @dd($my_value)

</body>
</html>