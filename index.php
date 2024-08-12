<?php 
    $title = "Početna stranica";
    require_once("head.php"); 
    require_once("baza.php"); 
    require_once("tipovi_korisnika.php");

    echo '  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    <script>
        document.getElementById("pocetna").classList.add("active");
    </script></br>';

    if(isset($_SESSION['korisnik_id'])){
        $korisnik = $_SESSION['korisnik'];
        $korisnik_id = $_SESSION['korisnik_id'];

        $query = "SELECT*FROM poruke WHERE korisnik_id='$korisnik_id' AND status_poruke=1";
        $redci = $konekcija->query($query);
        while ($row=$redci->fetch_assoc()){
            echo '<div class="alert alert-warning obavjest_admin animate__animated animate__fadeInLeft"><a class="moje_poruke" href="moje_poruke.php">Administrator je odgovorio na Vaše pitanje!</a></div>';
        }
    }

    if(Admin()){

        $query3="SELECT COUNT(*) AS count FROM korisnici";
        $redci = $konekcija->query($query3);
        while ($row=$redci->fetch_assoc()){
            $output = $row['count'];
        }

        $query4="SELECT COUNT(*) AS count FROM narudzba";
        $redci = $konekcija->query($query4);
        while ($row=$redci->fetch_assoc()){
            $output1 = $row['count'];
        }

        $query5="SELECT COUNT(*) AS count FROM narudzba WHERE status=2";
        $redci = $konekcija->query($query5);
        while ($row=$redci->fetch_assoc()){
            $output2 = $row['count'];
        }

        $query6="SELECT SUM(totalna_cijena) AS sum FROM narudzba;";
        $redci = $konekcija->query($query6);
        while ($row=$redci->fetch_assoc()){
            $output3 = $row['sum'];
        }

        $query9="SELECT COUNT(*) AS count FROM korisnici WHERE user_status=1;";
        $redci = $konekcija->query($query9);
        while ($row=$redci->fetch_assoc()){
            $output6 = $row['count'];
        }

        $query10="SELECT COUNT(*) AS count FROM kategorija;";
        $redci = $konekcija->query($query10);
        while ($row=$redci->fetch_assoc()){
            $output7 = $row['count'];
        }
    }

    if(Admin()){
?>

<h4 style="margin-left: 15%;" class="animate__animated animate__backInDown"><b>Aktivnosti: </b></h4>

<div class="card2 animate__animated animate__backInDown" style="text-align: center; font-size: 60px;">
    <?php
        echo "<i class='icon-group'></i> ";
        echo $output;
        echo"
            <a href='svi_korisnici.php' class='idi_na'><br><b>
                Registriranih korisnika <i class='icon-arrow-right'></i></b>
            </a>
        ";
    ?>
</div>

<div class="card3 animate__animated animate__backInDown" style="text-align: center; font-size: 60px;">
    <?php
        echo"<i class='icon-shopping-cart'></i> ";
        echo $output1;
        echo"
            <a href='sve_narudzbe.php' class='idi_na'><br><b>
                Primljenih narudžba <i class='icon-arrow-right'></i></b>
            </a>
        ";
    ?>
</div>

<div class="card4 animate__animated animate__backInDown" style="text-align: center; font-size: 60px;">
    <?php
        echo "<i class='icon-check'></i> ";
        echo $output2;
        echo"
            <a href='sve_narudzbe.php' class='idi_na'><br><b>
                Isporučenih narudžba <i class='icon-arrow-right'></i></b>
            </a>
        ";
    ?>
</div>

<div class="card5 animate__animated animate__backInDown" style="text-align: center; font-size: 60px;">
    <?php
        echo $output3;
        echo"
            <a href='index.php' class='idi_na'><br><b>
                Kuna dosad zarađeno</b>
            </a>
        ";
    ?>
</div>

<div class="card8 animate__animated animate__backInDown" style="text-align: center; font-size: 60px;">
    <?php
        echo "<i class='icon-lock'></i> ";
        echo $output6;
        echo"
            <a href='blokirani_korisnici.php' class='idi_na'><br><b>
            Blokiranih korisnika <i class='icon-arrow-right'></i></b>
            </a>
        ";
    ?>
</div>

<div class="card9 animate__animated animate__backInDown" style="text-align: center; font-size: 60px;">
    <?php
        echo "<i class='icon-bug'></i> ";
        echo $output7;
        echo"
            <a href='kategorija.php' class='idi_na'><br><b>
            Kategorija <i class='icon-arrow-right'></i></b>
            </a>
        ";
    ?>
</div><br></br><br></br>
<?php
    }
?>

<div style="text-align: center; font-size: 200px;">
    <h1 style="color: orange; font-size: 150px;" class="animate__animated animate__backInDown"><b>PET</b></h1> <h1 style="color: black; font-size: 150px;" class="animate__animated animate__backInUp"><b>SHOP</b></h1>
</div>

<section class="section">
    <div class="content">
        <div class="tekst">
            <span class="animate__animated animate__fadeIn"><b>Bez dolaska u poslovnicu - naruči online</b></span><br>
        </div>
        <div class="image">
            <img src="sve_slike/oprema4.png" alt="">
        </div>

      </div>
   </div>
</section>

<section class="kategorija">
    <h1 class="title_kategorija"><b>Kategorije</b></h1>
    <div class="box-container">
        <a href="hrana.php" class="box">
            <img src="sve_slike/hrana.png" alt="">
            <h3 class="h3">Hrana</h3>
        </a>

        <a href="oprema.php" class="box">
            <img src="sve_slike/oprema3.png" alt="">
            <h3 class="h3">Oprema</h3>
        </a>

        <a href="ljubimci.php" class="box">
            <img src="sve_slike/ljubimci1.png" alt="">
            <h3 class="h3">Ljubimci</h3>
        </a>

        <a href="higijena.php" class="box">
            <img src="sve_slike/higijena1.jpg" alt="">
            <h3 class="h3">Higijena</h3>
        </a>
    </div>
</section>

<?php
    require_once("footer2.php");
?>

