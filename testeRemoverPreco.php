<?php

include('./connection/connection.php');

$id = $_POST['id'];

$scriptSQL = "DELETE FROM `price` WHERE `id_price` = " . $id . ";";
mysqli_query($conn, $scriptSQL);
$index = mysqli_insert_id($conn);
?>

