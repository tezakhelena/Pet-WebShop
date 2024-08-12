<?php session_start(); error_reporting(E_ALL);
    require_once("tipovi_korisnika.php");
    require_once('baza.php');
    

    echo"<link href='//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css' rel='stylesheet'>";
    if(Admin()){

        $korisnik_id = $_SESSION['korisnik_id'];

        $query="SELECT COUNT(*) AS count FROM kosarica WHERE korisnik_id='$korisnik_id';";
        $redci = $konekcija->query($query);
        while ($row=$redci->fetch_assoc()){
            $output = $row['count'];
        }

        $query1="SELECT COUNT(*) AS count FROM wishlist WHERE korisnik_id='$korisnik_id';";
        $redci = $konekcija->query($query1);
        while ($row=$redci->fetch_assoc()){
            $output1 = $row['count'];
        }

        $query2 = "SELECT COUNT(*) AS count FROM korisnici WHERE odobrenje=1";
        $redci2 = $konekcija->query($query2);
        while ($row=$redci2->fetch_assoc()){
            $output2 = $row['count'];
        }

        $query3 = "SELECT COUNT(*) AS count1 FROM poruke WHERE status_poruke=0";
        $redci3 = $konekcija->query($query3);
        while ($row=$redci3->fetch_assoc()){
            $output3 = $row['count1'];
        }

        $query4 = "SELECT COUNT(*) AS count2 FROM upiti WHERE procitano=1";
        $redci4 = $konekcija->query($query4);
        while ($row=$redci4->fetch_assoc()){
            $output4 = $row['count2'];
        }
        
        $query5 = "SELECT COUNT(*) AS count3 FROM narudzba WHERE status=5";
        $redci5 = $konekcija->query($query5);
        while ($row=$redci5->fetch_assoc()){
            $output5 = $row['count3'];
        }

        echo '
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container">
                    <nav class="navbar navbar-expand-sm navbar-dark">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="index.php">
                            <img src="sve_slike/logo2.png" alt="Avatar Logo" style="width:80px;" class="rounded-pill"> 
                            </a>
                        </div>
                    </ul>

                    <div class="dropdown">
                        <a id="korisnik" class="nav-link dropdown-toggle" style="color:black" role="button" data-bs-toggle="dropdown">Proizvodi</a>
                        <div class="dropdown-content">
                            <div class="row">
                                <div class="column">
                                    <h4><b>Oprema</b></h4>
                                    <a href="oprema.php">Sva oprema</a>
                                    <a href="dodaj_opremu.php">Dodaj opremu</a>
                                </div>
                                <div class="column">
                                    <h4><b>Ljubimci</b></h4>
                                    <a href="ljubimci.php">Svi ljubimci</a>
                                    <a href="dodaj_ljubimca.php">Dodaj ljubimca</a>
                                </div>
                                <div class="column">
                                    <h4><b>Hrana</b></h4>
                                    <a href="hrana.php">Sva hrana</a>
                                    <a href="dodaj_hranu.php">Dodaj hranu</a>
                                </div>
                                <div class="column">
                                    <h4><b>Higijena</b></h4>
                                    <a href="higijena.php">Sva higijena</a>
                                    <a href="dodaj_higijenu.php">Dodaj higijenu</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown2">
                        <a id="korisnik" class="nav-link dropdown-toggle" style="color:black" role="button" data-bs-toggle="dropdown">Korisnici</a>
                        <div class="dropdown-content2">
                            <div class="row">
                                <div class="column2">
                                    <a id= "sviKorisnici" href="svi_korisnici.php">Svi korisnici</a><br></br>
                                    <a id= "blokiraniKorisnici" href="blokirani_korisnici.php">Blokirani korisnici</a><br></br>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown3">
                        <a id="upit" class="nav-link dropdown-toggle" style="color:black" role="button" data-bs-toggle="dropdown">Upiti</a>
                        <div class="dropdown-content3">
                            <div class="row">
                                <div class="column3">
                                    <a id= "sviUpiti" href="svi_upiti.php">Svi upiti</a><br></br>
                                    <a id= "dodajUpit" href="novi_upit.php"> Dodaj upit</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown4">
                        <a id="ostalo" class="nav-link dropdown-toggle" style="color:black" role="button" data-bs-toggle="dropdown">Ostalo</a>
                        <div class="dropdown-content4">
                            <div class="row">
                                <div class="column4">
                                    <a id= "dokumenti" href="dokumenti.php"><i class="icon-file-text"></i> Dokumenti</a><br></br>
                                    <a id= "narudzbe" href="sve_narudzbe.php"> Narudžbe</a><br></br>
                                    <a id= "kategorije" href="kategorija.php"> Kategorije</a>
                                </div>
                            </div>
                        </div>
                    </div>

                        <ul class="navbar-nav">
                            <li><a href="pretrazuj_proizvode.php" class="dropdown-item"><i class="icon-search"></i></a></li>
                        </ul>
                    </nav>
                    

                    <div class="d-flex align-items-right">
                        <div class="d-flex align-items-center">
                            <ul class="navbar-nav">
                                <!-- Dropdown -->
                                <li class="nav-item dropdown">
                                    <a href="wishlist.php" class="nav-link" role="button" style="color: black"><i class="icon-heart"></i> (' . $output1 . ')</a>
                                </li>
                                    <div class="dropdown6">
                                    <a id="kosarica" class="nav-link dropdown-toggle" style="color:black" role="button" data-bs-toggle="dropdown"><i class="icon-shopping-cart"></i></a>                        
                                    <div class="dropdown-content6">
                                            <div class="row">
                                                <div class="column6">
                                                    <a id= "narudzba" href="moje_narudzbe.php">Moje narudžbe</a><br></br>
                                                    <a id= "narudzbe" href="kosarica1.php"> <i class="icon-shopping-cart"></i> Moja košarica (' . $output . ')</a><br></br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="dropdown7">
                                    <a id="" class="nav-link dropdown-toggle" role="button" style="color: black" data-bs-toggle="dropdown"><b>' . $_SESSION['korisnik'] . ' </b></a>
                                        <div class="dropdown-content7">
                                            <div class="row">
                                                <div class="column7">
                                                    <a id= "sviKorisnici" href="obavjesti.php"><i class="icon-info"></i> Obavjesti</a><br></br>
                                                    <a id= "blokiraniKorisnici" href="sve_poruke.php"><i class="icon-inbox"></i> Poruke</a><br></br>
                                                    <a id= "traziKorisnici" href="postavke.php"><i class="icon-cog"></i> Postavke</a><br></br>
                                                    <a href="logout.php"><i class="icon-signout"></i> Odjava</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </ul>
                        </div>
                    </div>
                    </div>
                </div>
            </nav>';
    } else if(User()){
  
        $korisnik_id = $_SESSION['korisnik_id'];

        $query2="SELECT COUNT(*) AS count FROM kosarica WHERE korisnik_id='$korisnik_id';";
        $redci = $konekcija->query($query2);
        while ($row=$redci->fetch_assoc()){
            $output2 = $row['count'];
        }

        $query3="SELECT COUNT(*) AS count FROM wishlist WHERE korisnik_id='$korisnik_id';";
        $redci = $konekcija->query($query3);
        while ($row=$redci->fetch_assoc()){
            $output3 = $row['count'];
        }

        echo '
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <nav class="navbar navbar-expand-sm navbar-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="index.php">
                        <img src="sve_slike/logo2.png" alt="Avatar Logo" style="width:80px;" class="rounded-pill"> 
                        </a>
                    </div>
                    <ul class="navbar-nav">
                    <!-- Dropdown -->
                
                </ul>

                <div class="dropdown5">
                    <a id="kategorije" class="nav-link dropdown-toggle" style="color:black" role="button" data-bs-toggle="dropdown">Kategorije</a>
                    <div class="dropdown-content5">
                        <div class="row">
                            <div class="column5">
                                <a id= "ljubimci" href="ljubimci.php">Ljubimci</a><br></br>
                                <a id= "hrana" href="hrana.php">Hrana</a><br></br>
                                <a id= "oprema" href="oprema.php"> Oprema</a><br></br>
                                <a id= "higijena" href="higijena.php"> Higijena</a><br></br>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dropdown5">
                    <a id="upiti" class="nav-link dropdown-toggle" style="color:black" role="button" data-bs-toggle="dropdown">Upiti</a>
                    <div class="dropdown-content5">
                        <div class="row">
                            <div class="column5">
                                <a id= "dodajUpit" href="novi_upit.php">Dodaj upit</a><br></br>
                                <a id= "upiti" href="moji_upiti.php">Moji upiti</a><br></br>
                                <a id= "upiti" href="svi_upiti.php"> Pogledaj sve upite</a><br></br>
                            </div>
                        </div>
                    </div>
                </div>

                <ul class="navbar-nav">
                    <li><a href="pretrazuj_proizvode.php" class="dropdown-item"><i class="icon-search"></i></a></li>
                </ul>

                </nav>
                
                <div class="d-flex align-items-right">
                    <div class="d-flex align-items-center">

                    <div class="dropdown6">
                    <a id="kosarica" class="nav-link dropdown-toggle" style="color:black" role="button" data-bs-toggle="dropdown"><i class="icon-shopping-cart"></i></a>                        
                    <div class="dropdown-content6">
                            <div class="row">
                                <div class="column6">
                                    <a id= "dodajUpit" href="moje_narudzbe.php">Moje narudžbe</a><br></br>
                                    <a id= "upiti" href="kosarica1.php"> <i class="icon-shopping-cart"></i> Moja košarica (' . $output2 . ')</a><br></br>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <ul class="navbar-nav" style="text-decoration: none">
                    <!-- Dropdown -->
                    <li class="nav-item dropdown">
                    <a href="wishlist.php" class="nav-link" role="button" style="color: black"><i class="icon-heart"></i> (' . $output3 . ')</a>
                    </li>                     
                    </ul>
                    </li>

                    <div class="dropdown8">
                        <a id="" class="nav-link dropdown-toggle" role="button" style="color: black" data-bs-toggle="dropdown"><b>' . $_SESSION['korisnik'] . ' </b></a>
                            <div class="dropdown-content8">
                                <div class="row">
                                    <div class="column7">
                                        <a id= "poruke" href="moje_poruke.php"><i class="icon-inbox"></i> Poruke</a><br></br>
                                        <a id= "postavke" href="postavke.php"><i class="icon-cog"></i> Postavke</a><br></br>
                                        <a href="logout.php"><i class="icon-signout"></i> Odjava</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </nav>
    ';
    } else{
        echo '
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <nav class="navbar navbar-expand-sm navbar-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="index.php">
                        <img src="sve_slike/logo2.png" alt="Avatar Logo" style="width:80px;" class="rounded-pill"> 
                        </a>
                    </div>
                    <div class="dropdown5">
                        <a id="kategorije" class="nav-link dropdown-toggle" style="color:black" role="button" data-bs-toggle="dropdown">Kategorije</a>
                        <div class="dropdown-content5">
                            <div class="row">
                                <div class="column5">
                                    <a id= "ljubimci" href="ljubimci.php">Ljubimci</a><br></br>
                                    <a id= "hrana" href="hrana.php">Hrana</a><br></br>
                                    <a id= "oprema" href="oprema.php"> Oprema</a><br></br>
                                    <a id= "higijena" href="higijena.php"> Higijena</a><br></br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="navbar-nav">
                        <li><a href="pretrazuj_proizvode.php" class="dropdown-item"><i class="icon-search"></i></a></li>
                    </ul>

                </nav>
                
                <div class="d-flex align-items-right">
                    <a type="button" href="registracija.php" class=btn btn-warning px-3 me-2><i class="icon-user"></i> Registracija</a>
                    <a type="button" href="login.php" class="btn px-3 me-2">
                    <i class="icon-signin" style="font-size: 20px;"></i>
                    Prijava 
                    </a>
                </div>
                </div>
            </div>
        </nav>
    ';
    }
?>