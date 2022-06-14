<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create a movie</title>
</head>
<body>

    <h1>Create a new movie</h1>

    <form action="/movies" method="post">
        @csrf

        <input
            type="text"
            name="name"
            value="<?= htmlspecialchars($movie->name) ?>"
        >

        <button>Create a movie!</button>

    </form>

</body>
</html>