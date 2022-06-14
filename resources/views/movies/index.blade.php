<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All movies</title>
</head>
<body>

    <h1>All movies starting with <?= $starting_letter ?></h1>

    <ul>
        @foreach ($movies as $movie)
            <li>{{ $movie->name }}
                - <?= $movie->movieType->name ?>

                (<?= $movie->genres->pluck('name')->join(', ') ?>)
            </li>
        @endforeach
    </ul>

</body>
</html>