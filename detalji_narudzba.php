<?php
    $title = "Detalji narudžbe - Pet Shop";
    require_once("head.php");
    require_once("baza.php");

    echo"
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
        <div class='animate__animated animate__bounceInLeft bar2'>
            <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / </span> <a href='sve_narudzbe.php' class='bar'><i class='icon-shopping-cart'></i> Narudžbe</a><span> / Detalji</span></h2>
    ";

    $narudzba_id = $_GET['detalji'];

    if(isset($_POST['detaljiNarudzbe'])){
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $telefon = $_POST['telefon'];
        $email = $_POST['email'];
        $ulica = $_POST['ulica'];
        $grad = $_POST['grad'];
        $postanski_broj = $_POST['postanski_broj'];
        $proizvod = $_POST['proizvod'];
        $totalna_cijena = $_POST['totalna_cijena'];
        $placanje_id = $_POST['placanje_id'];
        $status = $_POST['status'];

        $select="SELECT narudzba.*, placanje_podaci.vrsta FROM narudzba INNER JOIN placanje_podaci ON narudzba.placanje_id = placanje_podaci.placanje_id WHERE narudzba.narudzba_id = $narudzba_id";
        $prikazi = mysqli_query($konekcija, $select);
    }

    $query="SELECT narudzba.*, placanje_podaci.vrsta FROM narudzba INNER JOIN placanje_podaci ON narudzba.placanje_id = placanje_podaci.placanje_id WHERE narudzba.narudzba_id = $narudzba_id";
    $redci = $konekcija->query($query);

    if(mysqli_num_rows($redci) > 0){
        if(Admin()){
            while($row=$redci->fetch_assoc()){
                echo "</br>
                <div class='container'>"
                    ?>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method = "post" enctype = "multipart/form-data">
                        <?php echo "</br><h1><b>" . $row['proizvod'] . "</b></h1>"?>
                        <?php echo "<h4 class='sifra_narudzbe'> Šifra narudžbe: " . $narudzba_id . "</h4></br>"; ?>
                        <?php
                            if($row['status'] == 0){
                                echo '<div class="alert alert-warning">Pošiljka zaprimljena!</div>';
                            }elseif($row['status'] == 1){
                                echo '<div class="alert alert-primary">Pošiljka u pripremi!</div>';
                            }elseif($row['status'] == 2){
                                echo '<div class="alert alert-success">Pošiljka isporučena!</div>';
                            }elseif($row['status'] == 5){
                                echo '<div class="alert alert-info">Pošiljka pogledana!</div>';
                            }else{
                                echo '<div class="alert alert-danger">Pošiljka otkazana!</div>';
                            }
                        ?>
                        <?php echo "<h4 class='cijena'></br><b>" . $row['totalna_cijena'] . " kn</b></h3>"?>
                        </br>
                    </form>
                    <?php echo'
                        <table class="table table-bordered">
                            <tr>
                                <td><b><i class="icon-user"></i></b></td>
                                <td>' .$row['korisnik'] .  '</td>
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
                                <td>'. $row['primatelj'] . '</td>
                            </tr>
                            <tr>
                                <td><b><i class="icon-truck"></i></b></td>
                                <td>'. $row['ulica'] . ", " . $row['grad'] . ", " . $row['postanski_broj'] . '</td>
                            </tr>
                            <tr>
                                <td><b><i class="icon-credit-card"></i></b></td>
                                <td>'. $row['vrsta'] . '</td>
                            </tr>
                        </table>';
                        ?>

                <?php 
                echo"<a type='button' class='btn btn-primary' href='promjena_statusa.php?edit=$row[narudzba_id]'><i class='icon-key'></i> Promjeni status</a>
                ";
                echo '
                    </div>
                    <button class="btn btn-back px-3 me-2" onclick="history.go(-1);"><i class="icon-arrow-left"></i> Natrag </button>
                ';
            }
        }elseif(isset($_SESSION['korisnik_id'])){
            $korisnik = $_SESSION['korisnik'];
            $korisnik_id = $_SESSION['korisnik_id'];

            while($row=$redci->fetch_assoc()){
                echo "</br>
                    <div class='container'>"
                        ?>
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method = "post" enctype = "multipart/form-data">
                            <?php echo "</br><h1><b>" . $row['proizvod'] . "</b></h1>"?>
                            <?php echo "<h4 class='sifra_narudzbe'> Šifra narudžbe: " . $narudzba_id . "</h4></br>"; ?>
                            <?php echo "<h4> Ime: " . $row['korisnik'] . "</h4>"; ?>
                            <?php echo "<h4> Prezime:  " . $row['prezime'] . "</h4>"; ?>
                            <?php echo "<h4> Telefon: " . $row['telefon'] . "</h4>"; ?>
                            <?php echo "<h4> Email: " . $row['email'] .  "</h4>"; ?>
                            <?php echo "<h4> Adresa: " . $row['ulica'] . ", " . $row['grad'] . ", " . $row['postanski_broj'] ."</h4>"; ?>
                            <?php echo "<h4> Način plaćanja: " . $row['placanje_id'] . "</h4>";
                            if($row['status'] == 4){
                                echo '<div class="alert alert-info">Pošiljka pogledana!</div>';
                            }elseif($row['status'] == 1){
                                echo '<div class="alert alert-primary">Pošiljka u pripremi!</div>';
                            }elseif($row['status'] == 2){
                                echo '<div class="alert alert-success">Pošiljka isporučena!</div>';
                            }elseif($row['status'] == 0){
                                echo '<div class="alert alert-info">Pošiljka zaprimljena!</div>';
                            }else{
                                echo '<div class="alert alert-danger">Pošiljka otkazana!</div>';
                            }?>
                            <?php echo "<h4 class='cijena'></br><b>" . $row['totalna_cijena'] . " kn</b></h4>
                            "?>
                            </br>
                        </form>
                    <?php 
                    echo "
                    </div>
                    <a class='btn btn-danger px-3 me-2' href='sve_narudzbe.php' ><i class='icon-arrow-left'></i> Povratak </a>";
            }
        }else{
            echo '<div class="alert alert-danger animate__animated animate__backInLeft">Nemate pristup ovoj stranici!</div>';
        }
    }else{
        echo '<div class="alert alert-danger animate__animated animate__backInLeft">Ne postoji narudžba sa tim ID-em</div>';
    }

    echo"</div>";

    require_once ("footer2.php");

?>