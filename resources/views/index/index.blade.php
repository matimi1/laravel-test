<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Laravel Test Project</title>
</head>
<body>

    <h1>Welcome to my Laravel test project</h1>

    <h1><?= $my_variable ?></h1>

    <h1>Hello, <?= $user['name'] ?></h1>

    <h2>Here are some things you can do:</h2>

    <ul>
        <li>
            <a href="#">Stay here</a>
        </li>
        <li>
            <a href="#">Go somewhere else</a>
        </li>

        <?php foreach ($things_to_do as $thing) : ?>
            <li>
                <?= $thing ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php foreach ($top_10_movies as $movie) : ?>
        <div class="movie">
            <?= $movie->name ?>
        </div>

    <?php endforeach ?>

</body>
</html>