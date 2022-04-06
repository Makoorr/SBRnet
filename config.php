<?php
try{
$db_user = "root"; //your database username
$db_pass = ""; //your database password
$db_name = "bd"; //your database name

$db = new PDO('mysql:host=localhost;dbname=' . $db_name . ';charset=utf8', $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){
    echo("Couldn't connect to database");
}
?>