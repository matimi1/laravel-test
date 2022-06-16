<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $movie->name ?> (<?= $movie->year ?>)</title>
</head>
<body>
    @include('common/messages')

    <h1><?= $movie->name ?></h1>

    <?php if ($movie->movieType) : ?>
        <div class="type">
            <?= $movie->movieType->name ?>
        </div>
    <?php endif; ?>

    <div class="year">
        <?= $movie->year ?>
    </div>

    <h2>Genres</h2>

    <ul>
        <?php foreach ($movie->genres as $genre) : ?>
            <li>
                <?= $genre->name ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>Cast & crew</h2>

    <?php foreach ($people as $position_name => $position_people) : ?>

        <h3><?= $position_name ?></h3>

        <ul>
            <?php foreach ($position_people as $person) : ?>
                <li>
                    <a href="/people/detail?id=<?= $person->id ?>">
                        <?= $person->fullname ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

    <?php endforeach; ?>

    <a href="{{ action('MovieController@edit', [$movie->id]) }}">edit</a>
</body>
</html>
