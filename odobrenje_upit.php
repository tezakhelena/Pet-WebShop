<?php

include('baza.php');

$id = $_GET['id'];
$odobrenje = $_GET['odobrenje'];

$odobriti = $konekcija->prepare('UPDATE upiti SET odobrenje=? WHERE id=?');
$odobriti -> bind_param('sd', $odobrenje, $id);
if($odobriti->execute()){
    echo '<div class="alert alert-success">Upit uspješno odobren!</div>';
}

header('location:svi_upiti.php');

?>