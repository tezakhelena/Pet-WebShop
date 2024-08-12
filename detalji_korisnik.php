<?php
    $title = "Detalji korisnika - Pet Shop";
    require_once("head.php");
    require_once("baza.php");

    echo"
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
        <div class='animate__animated animate__bounceInLeft bar2'>
            <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / </span> <a href='svi_korisnici.php' class='bar'><i class='icon-user'></i> Korisnici</a><span> / Detalji</span></h2> 
            <a class='btn btn-danger px-3 me-2' href='svi_korisnici.php' ><i class='icon-arrow-left'></i> Povratak </a>
            ";

    $id = $_GET['detalji'];

    if(Admin()){
        if(isset($_POST['detaljiKorisnika'])){
            $korisnik = $_POST['korisnik'];
            $tip_korisnika = $_POST['tip_korisnika'];
            $user_status = $_POST['user_status'];
            $telefon = $_POST['telefon'];
            $email = $_POST['email'];
            $datum_registracije = $_POST['datum_registracije'];

            $select = "SELECT * FROM korisnici WHERE korisnik_id = $_id";
            $prikazi = mysqli_query($konekcija, $select);
        }
        $query = "SELECT*FROM korisnici WHERE korisnik_id = $id";
        $redci = $konekcija->query($query);

        if(mysqli_num_rows($redci) > 0){
            while($row=$redci->fetch_assoc()){
                echo '
                <table class="table table-bordered tablica_detalji_korisnik">
                    <tr>
                        <td><b><i class="icon-user"></i></b></td>
                        <td>' .$row['korisnik']. '</td>
                    </tr>
                    <tr>
                        <td><b><i class="icon-envelope"></i></b></td>
                        <td>'. $row['email'] .'</td>
                    </tr>
                    <tr>
                        <td><b><i class="icon-phone"></i></b></td>
                        <td>'. $row['telefon'] .'</td>
                    </tr>
                    <tr>
                        <td><b><i class="icon-group"></i></b></td>
                        <td>'. $row['tip_korisnika'] .'</td>
                    </tr>
                    <tr>
                        <td><b><i class="icon-calendar"></i></b></td>
                        <td>'. $row['datum_registracije'] .'</td>
                    </tr>
                </table>
            ';
            }

            $query2 = "SELECT*FROM narudzba WHERE korisnik_id = $id";
            $redci2 = $konekcija->query($query2);

            echo"</br></br><h4>Narudžbe korisnika: </h4>";

            if(mysqli_num_rows($redci2) > 0){
                echo"<form action='' method='POST' enctype='multipart/form-data'>
                        <table enctype='multipart/form-data' class='tablica_narudzbe table-bordered'>
                            <tr>
                                <th>Broj narudžbe</th>
                                <th>Naručeni proizvodi</th>
                                <th>Ukupna cijena</th>
                            </tr>";
                while($row2=$redci2->fetch_assoc()){
                    echo"
                        <tr>
                            <td>" . $row2['narudzba_id'] . "</td>
                            <td>" . $row2['proizvod'] . "</td>
                            <td>" . $row2['totalna_cijena'] . " kn</td>
                        </tr>                        
                    ";
                }
                echo"</table>";
            }else{
                echo '<div class="alert alert-danger animate__animated animate__backInLeft">Ovaj korisnik još nema ni jednu narudžbu!</div>';
            }
        }else{
            echo '<div class="alert alert-danger animate__animated animate__backInLeft">Ne postoji korisnik sa tim ID-em</div>';
        }
    }else{
        echo '<div class="alert alert-danger animate__animated animate__backInLeft">Nemate pristup ovoj stranici!</div>';
    }

    echo"</div>";
    require_once ("footer2.php");

?>