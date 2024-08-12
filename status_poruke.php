<?php

include('baza.php');

$poruke_id = $_GET['poruke_id'];
$status_poruke = $_GET['status_poruke'];

$query = "UPDATE poruke SET status_poruke=$status_poruke WHERE poruke_id=$poruke_id";

mysqli_query($konekcija, $query);

header('location:moje_poruke.php');

?>