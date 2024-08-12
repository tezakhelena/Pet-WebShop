<?php
    $title = "Detalji proizvoda - Pet Shop";
    require_once("head.php");
    require_once("baza.php");

    
    echo"
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
        <link href='//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css' rel='stylesheet'>
        <div class='animate__animated animate__bounceInLeft bar2'>
            <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / </span> <a href='oprema.php' class='bar'> Oprema</a><span> / Detalji</span></h2>
    ";

    $id = $_GET['detalji'];

    if(isset($_POST['detaljiLjubimca'])){
        $naziv = $_POST['naziv'];
        $cijena = $_POST['cijena'];
        $opis = $_POST['opis'];
        $slika = $_FILES['slika']['name'];
        $slika_tmp_name = $_FILES['slika']['tmp_name'];
        $slika_folder = 'sve_slike/'.$slika;

        $select = "SELECT * FROM oprema WHERE id = $_id";
        $prikazi = mysqli_query($konekcija, $select);
    }

    if(isset($_POST['add_to_wishlist'])){
        $naziv = $_POST['naziv'];
        $cijena = $_POST['cijena'];
        $slika = $_POST['slika'];
        $korisnik = $_SESSION['korisnik'];
        $korisnik_id = $_SESSION['korisnik_id'];

        $select_wishlist = mysqli_query($konekcija, "SELECT * FROM `wishlist` WHERE naziv='$naziv' AND korisnik_id='$korisnik_id'");

        if(mysqli_num_rows($select_wishlist) > 0){
            echo '<div class="alert alert-warning  animate__animated animate__backInLeft">Proizvod je već u listi želja!</div>';
        }else{
            $insert_product = mysqli_query($konekcija, "INSERT INTO `wishlist`(naziv, cijena, slika, korisnik, korisnik_id) VALUES('$naziv', '$cijena', '$slika', '$korisnik', '$korisnik_id')");
            echo '<div class="alert alert-success">Dodano u Vašu listu želja!</div>'; 
        }
    }

    $query = "SELECT oprema.*, kategorija.naziv_kategorija FROM oprema INNER JOIN kategorija ON oprema.kategorija_id = kategorija.kategorija_id WHERE oprema.id=$id";
    $redci = $konekcija->query($query);

    if(mysqli_num_rows($redci) > 0){
        while($row=$redci->fetch_assoc()){
            echo "</br>
            <div class='detalji'>
                <img src='sve_slike/" . $row['slika'] . "' class='slika_detalji' style='width: 400px;'/></br>";?>

                <div class="form">
                    <h5 style="color: green"><b>DOSTUPNO</b></h5>
                    <hr>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method = "post" enctype = "multipart/form-data">
                        <?php echo "</br><h1 style='color: blue'><b>" . $row['naziv'] ."</b></h1>"?>
                        <?php echo "<h4 class='sifra'> Šifra proizvoda: " . $id . "</h4>"; ?>
                        <?php echo "<h5><b> Dostupnost:</b> " . $row['dostupnost'] . "</h5>"; ?>
                        <?php echo "<h5><b> Kategorija:</b> " . $row['naziv_kategorija'] . "</h5>"; ?>
                        <?php
                            echo"
                                    <input type='hidden' name='naziv' value=" . $row['naziv'] . ">
                                    <input type='hidden' name='cijena' value=" . $row['cijena'] . ">
                                    <input type='hidden' name='slika' value=" . $row['slika'] . ">
                            ";
                        ?>
                        <?php echo "<h5><b>Cijena: </b>" . $row['cijena'] . " kn</h5>"?>
                        <hr>
                        <?php echo "<p><b> Opis / upute za korištenje:</b> " . $row['opis'] . "</p>"; ?>
                        </br>
                        <hr>
                        <?php
                            if($row['dostupnost'] != 'Samo u poslovnici')
                            {
                                echo"<input type='submit' class='btn btn-primary' value='Dodaj u listu želja' name='add_to_wishlist'><br></br>";
                            }
                        ?>
                    </form>
                    
                </div>
                
            <?php echo"
            </div>
            <a class='btn btn-danger px-3 me-2' href='oprema.php' ><i class='icon-arrow-left'></i> Povratak </a>";
        }
    }else{
        echo '<div class="alert alert-danger animate__animated animate__backInLeft">Ne postoji oprema sa tim ID-em!</div>';
    }

    echo"</div>";

    require_once ("footer2.php");

?>