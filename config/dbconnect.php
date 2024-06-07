<?php

$server = "localhost";
$user = "kenkarlo_test";
$password = "yV8PKw#lt@Ya";
$db = "kenkarlo_swiss_collection";

$conn = mysqli_connect($server,$user,$password,$db);

if(!$conn) {
    die("Connection Failed:".mysqli_connect_error());
}

?>