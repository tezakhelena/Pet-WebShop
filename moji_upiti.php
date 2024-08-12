<?php $title = "Moji upiti - Pet Shop"; 
    require_once("head.php"); 
    require_once("baza.php");
 

    if(isset($_SESSION['korisnik_id'])){
        $korisnik = $_SESSION['korisnik'];
        $korisnik_id = $_SESSION['korisnik_id'];
        echo "
        <script type='text/javascript'>
        document.getElementById('upiti').classList.add('active');
        document.getElementById('sviUpiti').classList.add('active');
        document.getElementById('sve').classList.add('active');
        </script>
        
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
        <div class='animate__animated animate__bounceInLeft bar2'>
            <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / <i class='icon-question'></i> Moji upiti</span></h2>
            <br>
            <a class='btn btn-danger px-3 me-2' href='index.php' ><i class='icon-arrow-left'></i> Povratak </a>
            <br></br>
        ";


        //ispisujemo sve sto je u bazi u tablici oprema

        //PAGINACIJA
        $brojRezultataPoStranici = 3;
        $query="SELECT * FROM upiti WHERE korisnik_id='$korisnik_id'";
        $rezultat = mysqli_query($konekcija, $query);
        $BrojRezultata = mysqli_num_rows($rezultat);

        $brojStranica = ceil($BrojRezultata/$brojRezultataPoStranici);

        if (!isset($_GET['stranica'])) {
            $stranica = 1;
        } else {
            $stranica = $_GET['stranica'];
        }
        
        $ova_stranica_rezultati = ($stranica-1)*$brojRezultataPoStranici;

        if(isset($_GET['obrisi'])){
            $obrisi_id = $_GET['obrisi'];
    
            $query = $konekcija -> prepare('DELETE FROM upiti WHERE id=?');
            $query -> bind_param('s', $obrisi_id);
        
            if($query->execute()){
                echo '<div class="alert alert-success animate__animated animate__backInLeft">Upit uspješno izbrisan!</div></br>';
            } else{
                echo '<div class="alert alert-danger animate__animated animate__backInLeft">Upit neuspješno izbrisan!</div></br>';
            }
        };

        $query="SELECT*FROM upiti WHERE korisnik_id='$korisnik_id' ORDER BY id ASC LIMIT " . $ova_stranica_rezultati . " , " . $brojRezultataPoStranici;
        $redci = $konekcija->query($query);
        $korisnik_id = $_SESSION['korisnik_id'];
        $korisnik = $_SESSION['korisnik'];


        if(mysqli_num_rows($redci) > 0){

            
            //pomocu if stavljamo da admin moze vidjeti i dijelove tablice sa akcijama poput uredi i brisi
                //s enctype smo slozili da se prikazuju slike
                echo "<form action='' method='POST' enctype='multipart/form-data'>
                <table enctype='multipart/form-data'> 
                </thead>";
            

                //dohvacamo redke rezultata kao niz
                while ($row=$redci->fetch_assoc()){
                    $korisnik = strval($row['korisnik']);
                    $korisnik_id = strval($row['korisnik_id']);
                        //kod deleta smo slozili potvrdu za brisanje
                        echo"
                        <a class='link' href='detalji_upit.php?detalji=$row[id]'>
                            <div class='card' style='width: 100%;'>
                                <div class='upiti_box'>
                                    <h4><b>" . $korisnik . "</b></h4> 
                                    <p class='pitanje'>" . $row['pitanje'] . "</p>
                                    <h4 class='odgovor'> Odgovor: " . $row['odgovor'] . "</b></h4></br>
                                    <a href='uredi_upit.php?edit=$row[id]' class='btn-edit'><i class='icon-edit'></i> Uredi pitanje</a></br></th></br>
                                    <a href='moji_upiti.php?obrisi=$row[id]' onclick=\"javascript: return confirm('Jeste li sigurni da želite izbrisati svoje pitanje?');\" class='btn-delete'><i class='icon-trash'></i> </a></br></br>
                                </div>
                            </div></br>
                        </a>";

                
            }
            echo "</table></form></br></br></br>
            ";
        } else{
            echo "<div style='padding: 10px'>
            <div class='alert alert-warning animate__animated animate__backInLeft'>Nemate svoje upite! Dodajte novi upit da bi se ovdje prikazali!</div>
            </div>";
        }
        $konekcija->close();
        //paginacija
        if ($brojStranica>1) {
            echo "<div style='clear: left; margin-top:50px;'>";
            echo "<ul class='pagination pagination-sm'>";
            
            if($stranica>1) {
                echo "<li class='page-item'><a class='page-link' href='moji_upiti.php?stranica=" . ($stranica-1) . "'>
                &laquo Prethodna </a></li>";
            }
            for($i=1;$i<=$brojStranica; $i++){
                if ($i==$stranica) echo "<li class='page-item active'><span class='page-link'> $i </span></li>";
                else echo "<li class='page-item class='page-link'><a class='page-link' href='moji_upiti.php?stranica=$i'> $i </a></li>";
            }
            if ($stranica<$brojStranica){
                echo "<li class='page-item'><a class='page-link' href='moji_upiti.php?stranica=" . ($stranica+1) . "'>
                Sljedeća &raquo </a></li>";
            }
                echo"</ul></div>";
        }

    }else{
        echo '<div class="alert alert-danger animate__animated animate__backInLeft">Nemate pristup ovoj stranici!</div>';  
    }
    echo"</div>";
    require_once ("footer2.php");
?>
