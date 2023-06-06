<?php include("reqSQL.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css/">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="./assets/script/audio.js"></script>
    <title>Search bar</title>
</head>

<body>
    <div class="header">
        <i class="fa-solid fa-play"></i>
        <h1>MIAMI NIGHT</h1>
    </div>
    <div class="navbar">
        <a href="index.php">Movies</a>
        <a href="users.php">Users</a>
        <a href="sub.php">Subscribers</a>
        <a href="viewed.php">History</a>
        <a href="inserthistory.php">Add View</a>
        <a href="historysearch.php">What's On Menu</a>
    </div>

    <div class="searchbar">
        <form action="./index.php" methode="GET" name="form">
            <input class="bar" type="text" name="keywords" placeholder="Keywords" />
            <label for="pass"></label>

            <select name="genre" id="pass">
                <option value="">Genre</option>
                <option value="Action">Action</option>
                <option value="Animation">Animation</option>
                <option value="Adventure">Adventure</option>
                <option value="Drama">Drama</option>
                <option value="Comedy">Comedy</option>
                <option value="Mystery">Mystery</option>
                <option value="Biography">Biography</option>
                <option value="Crime">Crime</option>
                <option value="Fantasy">Fantasy</option>
                <option value="Horror">Horror</option>
                <option value="Sci-Fi">Sci-Fi</option>
                <option value="Romance">Romance</option>
                <option value="Family">Family</option>
                <option value="Thriller">Thriller</option>
            </select>
            <input class="button" type="submit" name="search" value="Search" />
        </form>
        <div class="autoscroll">
            <?php

            foreach ($tab as $value) {
                echo "<p class='title__film'>" . "Title: " . $value['Title'] . "<br>" . "Genre: " . $value['Genre'] . "<br>" . "Distributor: " . $value['Distributor'] . "<br>" . "</p>" . "<br>";
            }
            ?>
        </div>
    </div>

</body>

</html>