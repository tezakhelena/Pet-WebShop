<?php $title = "Upiti - Pet Shop"; 
    require_once("head.php"); 
    require_once("baza.php");

    echo "
    <script type='text/javascript'>
    document.getElementById('upiti').classList.add('active');
    document.getElementById('sviUpiti').classList.add('active');
    document.getElementById('sve').classList.add('active');
    </script>
    
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
    <div class='animate__animated animate__bounceInLeft bar2'>
        <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / <i class='icon-question'></i>  Česta pitanja i odgovori</span></h2>
        <br></br>
        <a class='btn btn-danger px-3 me-2' href='index.php' ><i class='icon-arrow-left'></i> Povratak </a>
        <br></br>
    ";

    $brojRezultataPoStranici = 4;
    $query='SELECT * FROM upiti';
    $rezultat = mysqli_query($konekcija, $query);
    $BrojRezultata = mysqli_num_rows($rezultat);

    $brojStranica = ceil($BrojRezultata/$brojRezultataPoStranici);

    if (!isset($_GET['stranica'])) {
        $stranica = 1;
    } else {
        $stranica = $_GET['stranica'];
    }
    
    $ova_stranica_rezultati = ($stranica-1)*$brojRezultataPoStranici;

    $query='SELECT * FROM upiti ORDER BY procitano DESC LIMIT ' . $ova_stranica_rezultati . ',' .  $brojRezultataPoStranici;
    $redci = mysqli_query($konekcija, $query);

    if(isset($_GET['obrisi'])){
        $obrisi_id = $_GET['obrisi'];

        $query = $konekcija -> prepare('DELETE FROM upiti WHERE id=?');
        $query -> bind_param('s', $obrisi_id);
    
        if($query->execute()){
            echo '<div class="alert alert-success animate__animated animate__backInLeft">Upit uspješno izbrisan!</div>';
        } else{
            echo '<div class="alert alert-danger animate__animated animate__backInLeft">Upit neuspješno izbrisan!</div>';
        }
    };

    if($redci){
        while ($row=$redci->fetch_assoc()){
            $korisnik = strval($row['korisnik']);
            $korisnik_id = strval($row['korisnik_id']);
            if(Admin()){
            echo "<form action='' method='POST' enctype='multipart/form-data' class='animate__animated animate__pulse'>";
            } else{
                echo "<form action='' method='POST' enctype='multipart/form-data' class='animate__animated animate__pulse'>";
            }
        
            if(Admin()){
                echo"
                <a class='link' href='detalji_upit.php?detalji=$row[id]'>
                    <div class='card' style='width: 100%;'>
                        <div class='upiti_box'>
                            <div class='podaci_upit'>
                                <h4 style='color: blue'><b>" . $korisnik . "</b></h4> 
                                <h5 class='odgovor'> " . $row['pitanje'] . "</b></h5>";
                                if($row['odobrenje'] == 1){
                                    echo"<h4><i class='icon-eye-close'></i></h5>";
                                }else{
                                    echo"<h4><i class='icon-eye-open'></i></h4>";
                                }
                                echo" <p class='pitanje'> Odgovor administratora: " . $row['odgovor'] . "</p></br>";
                                if($row['procitano'] == 1){
                                    echo '<a href="procitano.php?id='.$row['id'].'&procitano=0" class="btn btn-primary procitano"> Označi kao pogledano </a>';
                                }
                                echo"
                            </div>
                            <hr>
                            <a href='uredi_upit.php?edit=$row[id]' class='btn-edit-upit'><i class='icon-reply'></i> Odgovori</a>
                            <a href='svi_upiti.php?obrisi=$row[id]' onclick=\"javascript: return confirm('Jeste li sigurni da želite izbrisati ovo pitanje?');\" class='btn-delete-upit'><i class='icon-trash'></i> </a></br></br>";
                            if($row['odobrenje'] == 1){
                                echo '<a href="odobrenje_upit.php?id='.$row['id'].'&odobrenje=0" class="btn btn-primary odobri"> Postavi kao često pitanje</a>';
                            }else{
                                echo '<a href="odobrenje_upit.php?id='.$row['id'].'&odobrenje=1" class="btn btn-primary odobri"> Sakrij</a>';
                            }
                        echo "</div>
                    </div></br>
                </a>";
            } else{
                if($row['odobrenje']==0){
                    echo"
                    <div class='card' style='width: 100%;'>
                    <div class='upiti_box'>
                        <h4 class='odgovor'> " . $row['pitanje'] . "</h4>
                        <p class='pitanje'> Odgovor: " . $row['odgovor'] . "</b></p></br>
                    </div>
                </div></br>";
                }   
            }
        }
        echo "</table></form></br></br></br>";
    } else{
        echo "<div style='padding: 10px'>
        <div class='alert alert-warning'>Popis upita je prazan!</div>
        </div>";
        echo"</div>";
    }
    
    $konekcija->close();

    if ($brojStranica>1) {
        echo "<div style='clear: left; margin-top:50px;'>";
        echo "<ul class='pagination pagination-sm'>";
        
        if($stranica>1) {
            echo "<li class='page-item'><a class='page-link' href='svi_upiti.php?stranica=" . ($stranica-1) . "'>
            &laquo Prethodna </a></li>";
        }
        for($i=1;$i<=$brojStranica; $i++){
            if ($i==$stranica) echo "<li class='page-item active'><span class='page-link'> $i </span></li>";
            else echo "<li class='page-item class='page-link'><a class='page-link' href='svi_upiti.php?stranica=$i'> $i </a></li>";
        }
        if ($stranica<$brojStranica){
            echo "<li class='page-item'><a class='page-link' href='svi_upiti.php?stranica=" . ($stranica+1) . "'>
            Sljedeća &raquo </a></li>";
        }
            echo"</ul></div>";
    }elseif($brojStranica==0){
        echo '<div class="alert alert-warning animate__animated animate__backInLeft" style="margin-top: 10%;">Nema upita za prikazati!</div>';
    }
    
    require_once ("footer2.php");
?>
