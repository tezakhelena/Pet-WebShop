<?php
    //KREIRANJE KONEKCIJE SA BAZOM
    $konekcija = mysqli_connect ('localhost', 'root', '', 'zavrsni_aplikacija');
    
    //PROVJERAVAMO KONEKCIJU
    if(mysqli_connect_errno())
    {
        echo "Greška s povezivanjem na bazu " . mysqli_connect_errno();
        die();
    }
?>