<?php
    $title = "Obavjesti - Pet Shop";
    require_once('head.php');
    require_once('baza.php');

    echo"
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
        <div class='animate__animated animate__bounceInLeft bar2'>
            <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> /  Obavjesti</span></h2>
            <br>
            <a class='btn btn-danger px-3 me-2' href='index.php' ><i class='icon-arrow-left'></i> Povratak </a>
        </div><br></br>
    ";

    $query="SELECT*FROM korisnici WHERE odobrenje=1";
    $redci = $konekcija->query($query);
    if(mysqli_num_rows($redci)>0){
        while ($row=$redci->fetch_assoc()){
            $korisnik = strval($row['korisnik']);
            echo '<div class="alert alert-warning obavjest_admin animate__animated animate__fadeInLeft"><i class="icon-user"></i><a href="svi_korisnici.php" class="moje_poruke"> Registrirao se novi korisnik pod korisničkim imenom "' . $korisnik . '" i čeka da ga odobrite!</a></div>';
        }
    }else{
        echo"<li>Nema novo registriranih korisnika!</li>";
    }

    $query1="SELECT*FROM poruke WHERE status_poruke=0";
    $redci1 = $konekcija->query($query1);
    if(mysqli_num_rows($redci1)>0){
        while ($row=$redci1->fetch_assoc()){
            $korisnik = strval($row['korisnik']);
            echo '<div class="alert alert-warning obavjest_admin animate__animated animate__fadeInLeft"><a href="sve_poruke.php" class="moje_poruke"> Imate nove poruke od korisnika ' . $korisnik . '!</a></div>';
        }
    }else{
        echo"<li>Nemate novih poruka!</li>";
    }

    $query2="SELECT*FROM narudzba WHERE status=5";
    $redci2 = $konekcija->query($query2);
    if(mysqli_num_rows($redci2)>0){
        while ($row=$redci2->fetch_assoc()){
            echo '<div class="alert alert-warning obavjest_admin animate__animated animate__fadeInLeft"><a href="sve_narudzbe.php" class="moje_poruke"> Imate nove narudžbe! </a></div>';
        }
    }else{
        echo"<li>Nemate novih poruka!</li>";
    }

    $query2="SELECT*FROM upiti WHERE procitano=1";
    $redci = $konekcija->query($query2);
    if(mysqli_num_rows($redci)>0){
        while ($row=$redci->fetch_assoc()){
            $korisnik = strval($row['korisnik']);
            echo '<div class="alert alert-warning obavjest_admin animate__animated animate__fadeInRight"><i class="icon-info-sign"></i><a href="svi_upiti.php" class="moje_poruke"> Imate novi upit od korisnika ' . $korisnik . '! </a>
            </div><br>';
            
        }
    }else{
        echo"<li>Nemate novih upita!</li>";
    }

?>