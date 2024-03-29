<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Top rated movies</title>
</head>
<body>
    @include('common/messages')

    <a href="<?= route('search') ?>">Search</a>

    <h1>Top rated movies</h1>

    <ul>
        <?php foreach ($movies as $movie) : ?>
            <li>
                <a href="<?= route('movie.detail', $movie->id) ?>">
                    <?= $movie->name ?>
                    (<?= $movie->year ?>)

                </a>
            </li>
        <?php endforeach; ?>
    </ul>

</body>
</html>
