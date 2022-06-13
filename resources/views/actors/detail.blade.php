<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $actor->fullname ?></title>
</head>
<body>

    <h1><?= $actor->fullname ?></h1>

    <h2>Movies and other projects</h2>

    <?php foreach ($movies as $position_name => $position_movies) : ?>

        <h3><?= $position_name ?></h3>

        <ul>
            <?php foreach ($position_movies as $movie) : ?>
                <li>
                    <a href="/movies/detail?id=<?= $movie->id ?>">
                        <?= $movie->name ?>
                        (<?= $movie->year ?>)
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

    <?php endforeach; ?>

</body>
</html>