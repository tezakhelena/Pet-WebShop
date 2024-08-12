<?php

    $title = "Hrana - Pet Shop"; 
    require_once("head.php"); 
    require_once("baza.php"); 
    require_once("tipovi_korisnika.php");

    echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css'>
        
        <div class='animate__animated animate__bounceInLeft bar2'>
            <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / Hrana</span></h2>
            <br></br>
            <a class='btn btn-danger px-3 me-2' href='index.php' ><i class='icon-arrow-left'></i> Povratak </a>
            <br></br>
    ";

    ?>

    <?php

    if(isset($_POST['add_to_cart'])){
        $naziv = $_POST['naziv'];
        $cijena = $_POST['cijena'];
        $slika = $_POST['slika'];
        $korisnik = $_SESSION['korisnik'];
        $korisnik_id = $_SESSION['korisnik_id'];
        $kolicina = 1;

        $select_cart = mysqli_query($konekcija, "SELECT * FROM `kosarica` WHERE naziv='$naziv' AND korisnik_id='$korisnik_id'");

        if(mysqli_num_rows($select_cart) > 0){
                echo '<div class="alert alert-warning  animate__animated animate__backInLeft">Proizvod je već u košarici!</div>';
        }else{
            $insert_product = mysqli_query($konekcija, "INSERT INTO `kosarica`(naziv, cijena, slika, kolicina, korisnik, korisnik_id) VALUES('$naziv', '$cijena', '$slika', '$kolicina', '$korisnik', '$korisnik_id')");
            echo '<div class="alert alert-success  animate__animated animate__backInLeft">Dodano u košaricu!</div>';
        }
    }

    if(isset($_GET['obrisi'])){
        $obrisi_id = $_GET['obrisi'];
        $query = $konekcija -> prepare('DELETE FROM hrana WHERE id=?');
        $query -> bind_param('s', $obrisi_id);

        if($query->execute()){
            echo '<div id="demo" class="alert alert-success">Proizvod je uspješno izbrisan!</div>';
        } else{
            echo '<div class="alert alert-danger">Proizvod neuspješno izbrisan!</div>';
        }
    };

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

    echo"</div>";

    
    //PAGINACIJA
    $brojRezultataPoStranici = 6;
    $query='SELECT * FROM hrana';
    $rezultat = mysqli_query($konekcija, $query);
    $BrojRezultata = mysqli_num_rows($rezultat);

    $brojStranica = ceil($BrojRezultata/$brojRezultataPoStranici);

    if (!isset($_GET['stranica'])) {
        $stranica = 1;
    } else {
        $stranica = $_GET['stranica'];
    }

    $ova_stranica_rezultati = ($stranica-1)*$brojRezultataPoStranici;
?>
<div class="container">
        <ul class="navbar-nav">
        <li class="nav-item dropdown">
        <a class="button filtriraj dropdown-toggle btn btn-light animate__animated animate__bounceInLeft" style="color:black; border: 1px solid grey" role="button" data-bs-toggle="dropdown">Filtriraj po ljubimcu</a>
        <ul class="dropdown-menu filter">
            <form action="" method="GET" class="filter">
                <?php

                    $filter_query = "SELECT*FROM kategorija";
                    $filter_query_run = mysqli_query($konekcija, $filter_query);

                    if($filter_query_run)
                    {
                        foreach($filter_query_run as $zivotinjaList)
                        {
                            $checked = [];
                            if(isset($_GET['zivotinje'])){
                                $checked = $_GET['zivotinje'];
                            }
                            ?>
                                <div class="filter2">
                                    <input class="filterinput" type="checkbox" name="zivotinje[]" value="<?= $zivotinjaList['kategorija_id']; ?>">
                                </div>
                                <div class="filter3">
                                    <?php if(in_array($zivotinjaList['kategorija_id'], $checked)){echo "<i class='icon-check'></i>"; } ?>
                                    <?= $zivotinjaList['naziv_kategorija']; ?>
                                </div>
                            <?php
                        }
                        ?>
                    <button type="submit" class="btn btn-success filter_button">Search</button>
                    <a href='hrana.php' class="btn btn-primary refresh_btn">Refresh</a>
                        <?php
                    }
                    else
                    {
                        echo "Nije pronađena ni jedna kategorija!";
                    }
                ?>
            </form>
            
            </ul>
            </li>
        </ul><br></br>
    <?php

if(Admin()){
echo"<a class='btn novododaj animate__animated animate__bounceInLeft' href='dodaj_hranu.php'><i class='icon-plus'></i><b> Dodaj proizvod</b></a>";
}
echo"<a class='btn osvjezi animate__animated animate__bounceInLeft' href='hrana.php'><i class='icon-refresh'></i><b> Osvježi</b></a>";

            if(isset($_GET['zivotinje'])){

                $zivotinjachecked = [];
                $zivotinjachecked = $_GET['zivotinje'];

                foreach($zivotinjachecked as $rowzivotinja){

                    $proizvodi = "SELECT*FROM hrana WHERE kategorija_id IN ($rowzivotinja)";
                    $proizvodi_run = mysqli_query($konekcija, $proizvodi);
                    
                    ?>
                        <br></br><div class="proizvod slideshow-container">
                            <div class="box-container-filter">
                                <?php
                                    if(mysqli_num_rows($proizvodi_run)>0){
                                        while($row = mysqli_fetch_array($proizvodi_run)){         
                                ?>
                                            <form action="" method="post">
                                                <div class="box_proizvod mySlides animate__animated animate__pulse">
                                                    <?php
                                                        if(User()){
                                                            echo"<button type='submit' class='btn btn-warning wish' name='add_to_wishlist'><i class='icon-heart'></i></button>";
                                                        }elseif(Admin()){
                                                            echo"<button type='submit' class='btn btn-warning wish' name='add_to_wishlist'><i class='icon-heart'></i></button>";
                                                        }
                                                        echo"
                                                            <a href='detalji_hrana.php?detalji=$row[id]' class='za_detalje'>
                                                                <img class='slika' src='sve_slike/" . $row['slika'] . "' style='width: 200px;'/>
                                                                <h4 class='naziv'>" . $row['naziv'] ."</h4>
                                                                <input type='hidden' name='naziv' value=" . $row['naziv'] . ">
                                                                <input type='hidden' name='cijena' value=" . $row['cijena'] . ">
                                                                <input type='hidden' name='slika' value=" . $row['slika'] . ">
                                                            </a>
                                                            <div class='cijena_proizvod'>" . $row['cijena'] . " kn" . "</div>";
                                                            if(Admin()){
                                                                if($row['dostupnost'] != 'Samo u poslovnici'){
                                                                    echo"<input type='submit' class='btn btn-primary cart' value='U košaricu' name='add_to_cart'><br></br>";
                                                                }else{
                                                                    echo"<h6>Samo u poslovnici</h6><br></br>";
                                                                }
                                                                echo"
                                                                    <a href='uredi_hrana.php?edit=$row[id]' class='btn-edit'><i class='icon-edit'></i></a>
                                                                    <a href='urediSlikuHrane.php?edit=$row[id]' class='btn-edit2'><i class='icon-picture'></i></a>
                                                                    <a href='hrana.php?obrisi=$row[id]' onclick=\"javascript: return confirm('Jeste li sigurni da želite izbrisati proizvod?');\" class='btn-delete'><i class='icon-trash'></i> </a>
                                                                ";
                                                            }elseif(User()){
                                                                if($row['dostupnost'] != 'Samo u poslovnici'){
                                                                    echo"<input type='submit' class='btn btn-primary cart' value='U košaricu' name='add_to_cart'><br></br>";
                                                                }else{
                                                                    echo"<h6>Samo u poslovnici</h6><br></br>";
                                                                }
                                                            }else{
                                                                echo"<br></br><h5 style='color: blue'>*Registrirajte se ako želite kupiti ovaj proizvod*</h5>";
                                                            }
                                                    ?>
                                                </div>
                                            </form>
                                    <?php
                                        };
                                        ?>
                                            <a class="prev" onclick="plusSlides(-1)">❮</a>
                                            <a class="next_slide" onclick="plusSlides(1)">❯</a>
                                        <?php
                                    }
                                                        
                                    ?>
                            </div>
                                </div>
                <?php
                }
            }else{
                $query='SELECT * FROM hrana LIMIT ' . $ova_stranica_rezultati . ',' .  $brojRezultataPoStranici;
                $rezultat = mysqli_query($konekcija, $query);
                ?>
                    <section class="proizvod">
                        <?php if(Admin()){
                            echo"<a class=' btn pdf2 animate__animated animate__bounceInLeft' href='pdf_hrana.php'><i class='icon-print'></i><b> Kreiraj PDF</b></a><br></br>";
                        } ?>
                        <div class="box-container">
                            <?php
                                if($rezultat){
                                    while($row = mysqli_fetch_array($rezultat)){         
                            ?>
                                        <form action="" method="post">
                                            <div class="box_proizvod animate__animated animate__pulse">
                                                <?php
                                                    if(User()){
                                                        echo"<button type='submit' class='btn btn-warning wish' name='add_to_wishlist'><i class='icon-heart'></i></button>";
                                                    }elseif(Admin()){
                                                        echo"<button type='submit' class='btn btn-warning wish' name='add_to_wishlist'><i class='icon-heart'></i></button>";
                                                    }
                                                    echo"
                                                        <a href='detalji_hrana.php?detalji=$row[id]' class='za_detalje'>
                                                            <img class='slika' src='sve_slike/" . $row['slika'] . "' style='width: 200px;'/>
                                                            <h4 class='naziv'>" . $row['naziv'] ."</h4>
                                                            <input type='hidden' name='naziv' value=" . $row['naziv'] . ">
                                                            <input type='hidden' name='cijena' value=" . $row['cijena'] . ">
                                                            <input type='hidden' name='slika' value=" . $row['slika'] . ">
                                                        </a>
                                                        <div class='cijena_proizvod'>" . $row['cijena'] . " kn" . "</div>";
                                                        if(Admin()){
                                                            if($row['dostupnost'] != 'Samo u poslovnici'){
                                                                echo"<input type='submit' class='btn btn-primary cart' value='U košaricu' name='add_to_cart'><br></br>";
                                                            }else{
                                                                echo"<h6>Samo u poslovnici</h6><br></br>";
                                                            }
                                                            echo"
                                                                <a href='uredi_hrana.php?edit=$row[id]' class='btn-edit'><i class='icon-edit'></i></a>
                                                                <a href='urediSlikuHrane.php?edit=$row[id]' class='btn-edit2'><i class='icon-picture'></i></a>
                                                                <a href='hrana.php?obrisi=$row[id]' onclick=\"javascript: return confirm('Jeste li sigurni da želite obrisati hranu?');\"  class='btn-delete'><i class='icon-trash'></i> </a>
                                                            ";
                                                        }elseif(User()){
                                                            if($row['dostupnost'] != 'Samo u poslovnici'){
                                                                echo"<input type='submit' class='btn btn-primary cart' value='U košaricu' name='add_to_cart'><br></br>";
                                                            }else{
                                                                echo"<h6>Samo u poslovnici</h6><br></br>";
                                                            }
                                                        }else{
                                                            echo"<br></br><h5 style='color: blue'>*Registrirajte se ako želite kupiti ovaj proizvod*</h5>";
                                                        }
                                                ?>
                                            </div>
                                        </form>
                                    <?php
                                    };
                                }else{
                                    echo '<div class="alert alert-warning animate__animated animate__backInLeft">Nema proizvoda za prikazati!</div>';
                                }
                                $konekcija->close();           
                                ?>
                        </div>
                    </section>

                <?php
                    //PAGINACIJA

                    if ($brojStranica>1) {
                        echo "<div class='pagination' style='clear: left; margin-top:50px;'>";
                        echo "<ul class='pagination pagination-sm'>";
                        
                        if($stranica>1) {
                            echo "<li class='page-item'><a class='page-link' href='hrana.php?stranica=" . ($stranica-1) . "'>
                            &laquo Prethodna </a></li>";
                        }
                        for($i=1;$i<=$brojStranica; $i++){
                            if ($i==$stranica) echo "<li class='page-item active'><span class='page-link'> $i </span></li>";
                            else echo "<li class='page-item class='page-link'><a class='page-link' href='hrana.php?stranica=$i'> $i </a></li>";
                        }
                        if ($stranica<$brojStranica){
                            echo "<li class='page-item'><a class='page-link' href='hrana.php?stranica=" . ($stranica+1) . "'>
                            Sljedeća &raquo </a></li>";
                        }
                        echo"</ul></div>";
                    }elseif($brojStranica==0){
                        echo '<div class="alert alert-warning animate__animated animate__backInLeft" style="margin-top: 10%;">Nema proizvoda za prikazati!</div>';
                    }
                    }
                ?>
            </div>
        </div>
    </div>
    <script>
            let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
        showSlides(slideIndex += n);
        }

        function currentSlide(n) {
        showSlides(slideIndex = n);
        }

        function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        if (n > slides.length) {slideIndex = 1}    
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";  
        dots[slideIndex-1].className += " active";
        }
        </script>

<?php
    require_once ("footer2.php");
?>


