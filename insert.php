<?php

$conn = mysqli_connect('localhost', 'root', 'root', 'movies_website');
$query = "SELECT * FROM directors";
$result = mysqli_query($conn, $query);
$directors = mysqli_fetch_all($result, MYSQLI_ASSOC);

$title ="";
$poster ='';
$description='';
$release_date='';

?>
 <?php 
    if (isset($_GET['submitBtn'])) {
        
        $title = strip_tags(trim($_GET['title']));
        $description = strip_tags(trim($_GET['description']));
        $poster = $_GET['poster'];
        $release_date = $_GET['release_date'];
        $directorId = $_GET['directors'] ;

      
        $errors = false;

        if (empty($title)) {
            echo "Title is mandatory!<br>";
            $errors = true;
        }

        if (empty($description)) {
            echo "Description is mandatory<br>";
            $errors = true;
        } 

        if (empty($poster)) {
            echo "Poster is mandatory<br>";
            $errors = true;
        } 
        if (empty($release_date)) {
            echo "Release Date is mandatory<br>";
            $errors = true;
        } 
        if (empty($directorId)) {
            echo "Director is mandatory<br>";
            $errors = true;
        } 

        // Only if no errors 
        if (!$errors) {
            
                $title = $_GET['title'];
                $description = $_GET['description'];
                $poster = $_GET['poster'];
                $release_date = $_GET['release_date'];
                $directorId = $_GET['directors'] ;
        
                $conn = mysqli_connect('localhost', 'root', 'root', 'movies_website');
                $query = "INSERT INTO movies(title,description,poster,release_date,director_id)
                VALUES('$title','$description','$poster','$release_date','$directorId')";
                $result = mysqli_query($conn, $query);
                mysqli_close($conn);
        
                if($result){
                    echo "good";
                }else{
                    echo"not good";
                }
        
            }
    }?>

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
    <input type="text" id="title" name="title" placeholder="Title" value="<?php echo $title?>"><br>
    <input type="text" id="poster" name="poster" placeholder="Put poster URL" value="<?php echo $poster?>"><br>
    <input type="date" name="release_date" id="release_date" placeholder="YYYY-MM-DD" value="<?php echo $release_date?>"><br>
    
    <textarea id="description" name="description" placeholder="Write down the description!" value="<?php echo $description?>"></textarea><br>

    <select name="directors" id="directors">
    <?php foreach($directors as $director): ?>
        <option value="<?= $director['id'];?>"><?=$director['first_name'];?> <?=$director['last_name'];?></option>
         
    <?php endforeach?>
    
    </select>
    <br>
    <input type="submit" id="submit" name="submitBtn">
    </form>
   
    

</body>

</html>