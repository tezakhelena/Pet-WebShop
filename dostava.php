<?php
    $title = "O dostavi - Pet Shop";
    require_once('head.php');
    require_once('baza.php');

    echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
    <div class='animate__animated animate__bounceInLeft bar2'>
        <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a><span> / Dostava</span></h2>
        <br></br>
        <a class='btn btn-danger px-3 me-2' href='index.php' ><i class='icon-arrow-left'></i> Povratak </a>
        <br></br>";

    $query='SELECT * FROM dostava_podaci ORDER BY id_podaci';
    $redci = mysqli_query($konekcija, $query);

    if(isset($_GET['obrisi'])){
        $obrisi_id = $_GET['obrisi'];

        $query = $konekcija -> prepare('DELETE FROM dostava_podaci WHERE id_podaci=?');
        $query -> bind_param('s', $obrisi_id);
    
        if($query->execute()){
            echo '<div class="alert alert-success animate__animated animate__backInLeft">Podatak uspješno izbrisan!</div>';
        } else{
            echo '<div class="alert alert-danger animate__animated animate__backInLeft">Podatak neuspješno izbrisan!</div>';
        }
    };

    if(Admin()){
        ?>
            <a href='dodaj_podatke_o_dostavi.php' class='btn btn-primary'>Dodaj novo</a><br></br>
        <?php
    }

    ?>
        <h1><b>Dostava</b></h1><br></br>
    <?php

    if($redci){
        while ($row=$redci->fetch_assoc()){
            ?>
            <div class="podaci">
                <div>
                <h2><b> <?php echo $row['naslov'] ?> </b></h2>
                    <?php
                        if(Admin()){
                            echo"
                            <a href='uredi_podatke.php?edit=$row[id_podaci]' class='btn-edit-dostava'><i class='icon-edit'></i> </a>";
                        }
                    ?>
                </div>
                

                <p> <?php echo $row['opis'] ?> </p>
            </div>

            
            <?php
        }
    }

    ?>
    <br></br>
    <p>Raspored dostave na otoke možete vidjeti <a href='raspored_dostave_na_otoke.php'>ovdje</a> </p>
<div>
    <hr>
    <img src='sve_slike/dostava2.jpg' style="width: 400px;"  />
</div>

<?php
    echo"</div>";
    require_once('footer2.php');
?>