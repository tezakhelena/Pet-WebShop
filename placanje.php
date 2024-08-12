<?php
    $title = "O plaćanju - Pet Shop";
    require_once('head.php');
    require_once('baza.php');

    echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
    <div class='animate__animated animate__bounceInLeft bar2'>
        <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a><span> / Plaćanje</span></h2>
        <br>
        <a class='btn btn-danger px-3 me-2' href='index.php' ><i class='icon-arrow-left'></i> Povratak </a>
    <br></br>";

    $query='SELECT * FROM placanje_podaci ORDER BY placanje_id';
    $redci = mysqli_query($konekcija, $query);

    if(isset($_GET['obrisi'])){
        $obrisi_id = $_GET['obrisi'];

        $query = $konekcija -> prepare('DELETE FROM placanje_podaci WHERE placanje_id=?');
        $query -> bind_param('s', $obrisi_id);
    
        if($query->execute()){
            echo '<div class="alert alert-success animate__animated animate__backInLeft">Podatak uspješno izbrisan!</div>';
        } else{
            echo '<div class="alert alert-danger animate__animated animate__backInLeft">Podatak neuspješno izbrisan!</div>';
        }
    };

    ?>
        <h2><b>Plaćanje</b></h2><br></br>
    <?php

    ?>
        <h4><b>Uz odabranu uslugu dostave na kućna vrata, naručeni proizvodi se mogu platiti:</b></h4><br>
    <?php
    
    if(Admin()){
        ?>
            <a href='dodaj_podatke_o_placanju.php' class='btn btn-primary'>Dodaj novo</a><br></br>
        <?php
    }

    if($redci){
        while ($row=$redci->fetch_assoc()){
            ?>
            <div class="podaci">
                <div>
                <li class='placanje'><b> <?php echo $row['vrsta'] . ": " ?> </b> <?php echo $row['opis'] ?></li><br>
                    <?php
                        if(Admin()){
                            echo"
                            <a href='uredi_placanje.php?edit=$row[placanje_id]' class='btn-edit-dostava'><i class='icon-edit'></i> </a>";
                        }
                    ?>
                </div><br>
            </div>

            
            <?php
        }
    }

    ?>

<div>
    <img src='sve_slike/visamastercardamerican.jpg' style="width: 400px;"  />
</div>

<?php
echo"</div>";
    require_once('footer2.php');
?>