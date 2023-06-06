<?php
include("connect.php");


$keywords=$_GET["keywords"];
$search=$_GET["search"];
$genre=$_GET["genre"];

$keywordsInReq = "%$keywords%";
$genreInReq = "%$genre%";

if(isset($search) && !empty(trim($keywords))){
    $req = $db->prepare('SELECT movie.title AS "Title", genre.name AS "Genre", distributor.name AS "Distributor" 
    FROM movie 
    JOIN movie_genre ON movie.id = movie_genre.id_movie
    JOIN genre ON movie_genre.id_genre = genre.id
    JOIN distributor ON movie.id_distributor = distributor.id 
    WHERE movie.title LIKE :keywords AND genre.name LIKE :genre OR distributor.name LIKE :keywords'); //preparation de la requette de recherche
    $req->bindParam(':keywords', $keywordsInReq, PDO::PARAM_STR);
    $req->bindParam(':genre', $genreInReq, PDO::PARAM_STR);
    $req->execute();
    $tab = $req->fetchAll();
    //var_dump($tab);

}
$Fnames=$_GET["Fnames"];
$Lnames=$_GET["Lnames"];
$search=$_GET["search"];


$FnamesInReq = "%$Fnames%";
$LnamesInReq = "%$Lnames%";

if(isset($search) && (!empty(trim($Fnames))||!empty(trim($Lnames)))){
    $req2 = $db->prepare('SELECT firstname AS "Firstname", lastname AS "Lastname", user.id AS "User ID", membership.id AS "UsersID"
    FROM user
    LEFT JOIN membership ON user.id=membership.id_user
    WHERE firstname LIKE :Fnames AND lastname LIKE :Lnames');
    $req2->bindParam(':Fnames', $FnamesInReq, PDO::PARAM_STR);
    $req2->bindParam(':Lnames', $LnamesInReq, PDO::PARAM_STR);
    $req2->execute();
    $user = $req2->fetchAll();
    // var_dump($user);
}

$Fnames=$_GET["Fnames"];
$Lnames=$_GET["Lnames"];
$Subs=$_GET["Subs"];
$search=$_GET["search"];

$FnamesInReq = "%$Fnames%";
$LnamesInReq = "%$Lnames%";
$SubsInReq = "%$Subs%";

if(isset($search) && (!empty(trim($Fnames))||!empty(trim($Lnames)) || !empty(trim($Subs)))){
    $req3 = $db->prepare('SELECT user.firstname AS "Firstname", user.lastname AS "Lastname", subscription.name AS "Subscribers" 
    FROM subscription 
    JOIN membership ON subscription.id = membership.id_subscription 
    JOIN user ON membership.id_user = user.id 
    WHERE user.firstname LIKE :Fnames AND user.lastname LIKE :Lnames AND subscription.name LIKE :Subs');
     $req3->bindParam(':Subs', $SubsInReq, PDO::PARAM_STR);
     $req3->bindParam(':Fnames', $FnamesInReq, PDO::PARAM_STR);
     $req3->bindParam(':Lnames', $LnamesInReq, PDO::PARAM_STR);
     $req3->execute();
     $sub = $req3->fetchAll();
        // var_dump($sub);
}

$keywords=$_GET["keywords"];
$search=$_GET["search"];

$keywordsInReq = "%$keywords%";


if(isset($search) && !empty(trim($keywords))){
    $req4 = $db->prepare('SELECT id_user AS "User Number", movie.title AS "Viewed film", movie_schedule.date_begin AS "Date" 
    FROM membership
    JOIN membership_log ON membership_log.id_membership = membership.id
    JOIN movie_schedule ON membership_log.id_session = movie_schedule.id
    JOIN movie ON movie_schedule.id_movie = movie.id
    WHERE id_user LIKE :keywords');
    $req4->bindParam(':keywords', $keywordsInReq, PDO::PARAM_STR);
    $req4->execute();
    $viewed = $req4->fetchAll();
}


$keywords=$_GET["keywords"];
$subing=$_GET["subing"];
$validate=$_GET["validate"]; //just for subscription.php



    if (isset($validate) && (!empty(trim($keywords)) || !empty(trim($subing)))) {
        $req5 = $db->prepare('INSERT INTO membership (id_user, id_subscription) 
        VALUES (:keywords,:subing)');
        $req5->bindParam('keywords', $keywords, PDO::PARAM_STR);
        $req5->bindParam('subing', $subing, PDO::PARAM_STR);
        $req5->execute();
        // var_dump($req5);
        $insertSub = $req5->fetchAll();
    }


    $newSub=$_GET["newSub"];
    $userID = $_GET["userID"];
    $updating=$_GET["updating"];//just for update.php

    $newSubInReq = "%newSub%";
    $userIDInReq = "%userID%";


    if (isset($updating) && (!empty(trim($userID))|| !empty(trim($newSub)))) { 

        $req6 = $db->prepare('UPDATE membership
        SET id_subscription = :newSub
        WHERE id = :userID');
        $req6->bindParam('userID', $userID, PDO::PARAM_STR);
        $req6->bindParam('newSub', $newSub , PDO::PARAM_STR);
        $req6->execute();
        $updateSub = $req6->fetchAll();

}

    $deleteID=$_GET['deleteID'];
    $deleting=$_GET['deleting'];


    if(isset ($deleting) && !empty(trim($deleteID))){
    $req7 = $db->prepare('DELETE FROM membership
        WHERE membership.id = :deleteID');
        $req7->bindParam('deleteID', $deleteID, PDO::PARAM_STR);
        $req7->execute();
        $deletingSub = $req7->fetchAll();
    }

    $movieID=$_GET['movieID'];
    $roomID=$_GET['roomID'];
    $dates=$_GET['dates'];
    $confirming=$_GET['confirming'];


    if(isset ($confirming) && (!empty(trim($movieID) || !empty(trim($roomID))))){
    $req8 = $db->prepare ('INSERT INTO movie_schedule (id_movie, id_room, date_begin) 
    VALUES (:movieID, :roomID, :dates)');
    $req8->bindParam('movieID', $movieID, PDO::PARAM_STR);
    $req8->bindParam('roomID', $roomID, PDO::PARAM_STR);
    $req8->bindParam('dates', $dates, PDO::PARAM_STR);
    $req8->execute();
    $addviewSched = $req8->fetchAll();
    }


    // $keywords=$_GET["keywords"];
    $dated=$_GET['dated'];
    $search=$_GET['search'];
    // $datedInReq = '%$dated%';



    if(isset($search)){
    $req9 = $db->prepare('SELECT movie.title AS Movies, date_begin AS Dated 
    FROM movie_schedule
    JOIN movie ON movie_schedule.id_movie = movie.id  
    WHERE date_begin LIKE :dated');
    $req9->bindParam('dated', (new DateTime($dated))->format('Y-m-d h:i:s'), PDO::PARAM_STR);
    $req9->execute();
    $datedview = $req9->fetchAll();
    // var_dump((new DateTime($dated))->format('Y-m-d h:i:s'),$datedview);
    // die();

    }
?>

<!-- SELECT title AS Movies, date_begin AS Dated 
FROM `movie_schedule`
JOIN movie ON movie_schedule.id_movie = movie.id  
WHERE date_begin LIKE '2023-01-01 00:00:00' pour historysearch -->

<!-- INSERT INTO movie_schedule (id_movie, id_room, date_begin) 
VALUES (1985, 11, '2023-01-01 00:00:00')  (D’ajouter une séance pour un film (séance qui sera ajouté à la table movie_schedule).)-->

<!-- UPDATE membership
SET id_subscription = 3
WHERE id_user = 1; -->

<!-- INSERT INTO `membership`(`id_user`, `id_subscription`, `date_begin`) VALUES (1,1,CURRENT_DATE) -->

<!-- DELETE FROM membership
WHERE membership.id = :keywords;

INSERT INTO membership_log (id_membership, id_session)
VALUES ('$VALUE', '$VALUE'); -->