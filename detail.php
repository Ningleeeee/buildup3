<?php

$id = $_GET['id'];
$conn = mysqli_connect('localhost', 'root', 'root', 'movies_website');
$query = "SELECT *
FROM movies m
INNER JOIN directors d ON m.director_id = d.id
WHERE m.id = $id";

$result = mysqli_query($conn, $query);
$movies = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php require_once 'nav.html'; ?> 
    <h1>Details</h1>
    <div class="container">
    <?php foreach ($movies as $movie) : ?>
       
        <div class="card detail_card">
             
        <h3 class="title_big">
            <?= $movie['title']; ?>
        </h3>
        <p>     
            <img src="<?= $movie['poster']; ?>" width="300px">
        </p>
     
        <h3>
            Description: <br>
            <?= $movie['description']; ?>
           
        </h3>
        <h3>
            Director:<br>
            <?= $movie['first_name']; ?>
            <?= $movie['last_name']; ?>
        </h3>
        <h3>
            Release Date:<br>
            <?= $movie['release_date']; ?>
           
        </h3>

        </div>
    <?php endforeach; ?>
    </div>
</body>

</html>