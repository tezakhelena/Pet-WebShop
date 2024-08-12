<?php

include('baza.php');

$korisnik_id = $_GET['korisnik_id'];
$odobrenje = $_GET['odobrenje'];

$odobriti = $konekcija->prepare('UPDATE korisnici SET odobrenje=? WHERE korisnik_id=?');
$odobriti -> bind_param('sd', $odobrenje, $korisnik_id);
if($odobriti->execute()){
    echo '<div class="alert alert-success">Korisnik uspješno odobren!</div>';
}

header('location:svi_korisnici.php');

?>