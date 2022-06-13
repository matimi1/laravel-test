<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Top rated videogames</title>
</head>
<body>

    <h1>Top rated videogames</h1>

    <ul>
        <?php foreach ($games as $game) : ?>
            <li>
                <a href="/movies/detail?id=<?= $game->id ?>">
                    <?= $game->name ?>
                    (<?= $game->year ?>)
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

</body>
</html>