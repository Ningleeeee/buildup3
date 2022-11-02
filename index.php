<?php

$conn = mysqli_connect('localhost', 'root', 'root', 'movies_website');
$query = "SELECT *
FROM movies";
$result = mysqli_query($conn, $query);
$movies = mysqli_fetch_all($result, MYSQLI_ASSOC);


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

    <h1>Movies</h1>

    
    <form method="GET">
    <input type="text" id="search" name="search" placeholder="Search here!">
    <input type="submit" id="submit" name="submitBtn">
    <input type="submit" name="asc" value="Ascending" class="btn btn-primary"></Input>
    <input type="submit" name="desc" value="Descending" class="btn btn-primary"></Input>
    </form>
   
    <div class="container">
    <?php
    if(isset($_GET["submitBtn"])){
        $inputValue = $_GET['search'];
        $query .=" WHERE title LIKE '%$inputValue%' ";
        $result = mysqli_query($conn, $query);
        $movies = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    if(isset($_GET["asc"])){
        $query .= " ORDER BY title";
        $result = mysqli_query($conn, $query);
        $movies = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        }

    if(isset($_GET["desc"])){
        $query .= " ORDER BY title DESC";
        $result = mysqli_query($conn, $query);
        $movies = mysqli_fetch_all($result, MYSQLI_ASSOC);
        

    }

    mysqli_close($conn);
    ?>
    <?php foreach ($movies as $movie) : ?>

        <div class="card">
        <p>   
            <img src="<?= $movie['poster']; ?>" width="300">
        </p>

        <h3>
            <?= $movie['title']; ?>
        </h3>

        <p> 
            <?= $shortdes = substr($movie['description'],0,30); ?>...
       
            <a class="detail" href="./detail.php?id=<?= $movie['id']; ?>">more detail</a>
        </p>

        
        </div>
    

    <?php endforeach; ?>
    
    </div>
   


</body>

</html>