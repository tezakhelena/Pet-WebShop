<?php

include('baza.php');

$korisnik_id = $_GET['korisnik_id'];
$user_status = $_GET['user_status'];

$query = "UPDATE korisnici SET user_status=$user_status WHERE korisnik_id=$korisnik_id";

mysqli_query($konekcija, $query);

header('location:svi_korisnici.php');

?>