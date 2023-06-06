<?php include("reqSQL.php"); ?>
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
        <form action="./users.php" methode="GET" name="form">
            <input class="bar" type="text" name="Fnames" placeholder="First Name" />
            <input class="bar" type="text" name="Lnames" placeholder="Last name" />
            <input class="button" type="submit" name="search" value="Search" />
        </form>
        <div class="autoscroll">
            <?php
            // echo $_GET["Fnames"];
            // echo $_GET["Lnames"];
            foreach ($user as $value) {
                if ($value["UsersID"] == NULL) {
                    echo "<p class='users'>" . "First name: " . $value['Firstname'] . "<br>" . "Last name: " . $value['Lastname'] . "<br>" . "User's ID: " . $value['User ID']. "<br>". "Subs's ID: "  .$value['UsersID'] . '<form class="subs action="./users.php" methode="GET" name="form"><a href="subscription.php">Subscribe</a></form>' . "<br>" . "</p>" . "<br>";
                } elseif ($value["Firstname"] == $_GET["Fnames"]) {
                    echo "<p class='users'>" . "First name: " . $value['Firstname'] . "<br>" . "Last name: " . $value['Lastname'] . "<br>" . "User's ID: " . $value['User ID']. "<br>". "Subs's ID: "  .$value['UsersID']. "<br>" . "</p>" . "<br>";
                } elseif ($value["Lastname"] == $_GET["Lnames"]) {
                    echo "<p class='users'>" . "First name: " . $value['Firstname'] . "<br>" . "Last name: " . $value['Lastname'] . "<br>" . "User's ID: " . $value['User ID']. "<br>". "Subs's ID: "  .$value['UsersID']. "<br>" . "</p>" . "<br>";
                } elseif ($value["Firstname"] == $_GET["Fnames"] && $value["Lastname"] == $_GET["Lnames"]) {
                    echo "<p class='users'>" . "First name: " . $value['Firstname'] . "<br>" . "Last name: " . $value['Lastname'] . "<br>" . "User's ID: " . $value['User ID']. "<br>". "Subs's ID: "  .$value['UsersID']. "<br>" . "</p>" . "<br>";
                }
            }
            ?>
        </div>
    </div>

</body>

</html>