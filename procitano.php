<?php

include('baza.php');

$id = $_GET['id'];
$procitano = $_GET['procitano'];

$query = "UPDATE upiti SET procitano=$procitano WHERE id=$id";

mysqli_query($konekcija, $query);

header('location:svi_upiti.php');

?>