<?php

include('baza.php');

$narudzba_id = $_GET['narudzba_id'];
$status = $_GET['status'];

$query = "UPDATE narudzba SET status=$status WHERE narudzba_id=$narudzba_id";

mysqli_query($konekcija, $query);

header('location:sve_narudzbe.php');

?>