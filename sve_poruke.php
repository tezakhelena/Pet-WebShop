<?php $title = "Inbox - Pet Shop"; 
    require_once("head.php"); 
    require_once("baza.php");
 

    if(Admin()){
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
            <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / <i class='icon-inbox'></i> Sve poruke</span></h2><br>
            <br>
            <a class='btn btn-danger px-3 me-2' href='index.php' ><i class='icon-arrow-left'></i> Povratak </a>
            <br></br><br></br>
        ";        


        //ispisujemo sve sto je u bazi u tablici oprema

        //PAGINACIJA
        $brojRezultataPoStranici = 3;
        $query='SELECT * FROM poruke';
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
    
            $query = $konekcija -> prepare('DELETE FROM poruke WHERE poruke_id=?');
            $query -> bind_param('s', $obrisi_id);
        
            if($query->execute()){
                echo '<div class="alert alert-success animate__animated animate__backInLeft">Razgovor uspješno izbrisan!</div>';
            } else{
                echo '<div class="alert alert-danger animate__animated animate__backInLeft">Razgovor neuspješno izbrisan!</div>';
            }
        };

        $query='SELECT*FROM poruke ORDER BY status_poruke ASC LIMIT '. $ova_stranica_rezultati . ' , '. $brojRezultataPoStranici;
        $redci = $konekcija->query($query);
        $korisnik_id = $_SESSION['korisnik_id'];
        $korisnik = $_SESSION['korisnik'];


        if(mysqli_num_rows($redci) > 0){
            
            //pomocu if stavljamo da admin moze vidjeti i dijelove tablice sa akcijama poput uredi i brisi
                echo "<form action='' method='POST'>
                <table enctype='multipart/form-data'> 
                </thead>";
            

                //dohvacamo redke rezultata kao niz
                while ($row=$redci->fetch_assoc()){
                    $korisnik = strval($row['korisnik']);
                    $korisnik_id = strval($row['korisnik_id']);
                        //kod deleta smo slozili potvrdu za brisanje
                        echo"
                        <a class='link' href='detalji_poruka.php?detalji=$row[poruke_id]'>
                            <div class='card10' style='width: 100%;'>
                                <div class='upiti_box'>
                                    <p><b style='color: blue'>" . $korisnik . "</b> - " . $row['datum_poruke'] . "</p> 
                                    <h5>" . $row['vrsta'] . "</h5>
                                    <p style='color: black;'>" . $row['pitanje'] . "</p>";
                                    if($row['status_poruke'] == 0){
                                        echo '<p>Odgovori <i class="icon-reply"></i></p>';
                                    }
                                    echo"
                                    <a href='sve_poruke.php?obrisi=$row[poruke_id]' onclick=\"javascript: return confirm('Jeste li sigurni da želite izbrisati ovaj razgovor?');\" class='btn-delete-poruka2'><i class='icon-trash'></i> </a></br></br>
                                </div>
                            </div></br>
                        </a><hr>";

                
            }
            echo "</table></form></br></br></br>
            ";
        } else{
            echo "<div style='padding: 10px'>
            <div class='alert alert-warning animate__animated animate__backInLeft'>Nemate niti jednu poruku!</div>
            </div>";
        }
        $konekcija->close();
        //paginacija
        if ($brojStranica>1) {
            echo "<div style='clear: left; margin-top:50px;'>";
            echo "<ul class='pagination pagination-sm'>";
            
            if($stranica>1) {
                echo "<li class='page-item'><a class='page-link' href='sve_poruke.php?stranica=" . ($stranica-1) . "'>
                &laquo Prethodna </a></li>";
            }
            for($i=1;$i<=$brojStranica; $i++){
                if ($i==$stranica) echo "<li class='page-item active'><span class='page-link'> $i </span></li>";
                else echo "<li class='page-item class='page-link'><a class='page-link' href='sve_poruke.php?stranica=$i'> $i </a></li>";
            }
            if ($stranica<$brojStranica){
                echo "<li class='page-item'><a class='page-link' href='sve_poruke.php?stranica=" . ($stranica+1) . "'>
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
