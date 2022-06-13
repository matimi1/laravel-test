<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $movie->name ?> (<?= $movie->year ?>)</title>
</head>
<body>

    <h1><?= $movie->name ?></h1>

    <div class="year">
        <?= $movie->year ?>
    </div>

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

</body>
</html>