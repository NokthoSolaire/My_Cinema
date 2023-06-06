<?php

$user = '?';
$password = '?';



try { 
    $db = new PDO('mysql:host=localhost;dbname=cinema',$user,$password);
} catch (PDOException $e) 
{
    echo "error:".$e->getMessage()."\n";
}
?>