<?php
    $title = "Raspored dostave na otoke - Pet Shop";
    require_once('head.php');

    echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
    <div class='animate__animated animate__bounceInLeft bar2'>
        <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / </span> <a href='dostava.php' class='bar'> Dostava</a><span> / Dostava na otoke</span></h2>
        <br>
        <a class='btn btn-danger px-3 me-2' href='dostava.php' ><i class='icon-arrow-left'></i> Povratak </a>
        <br></br>
    ";
?>

<h2><b>Raspored dostave na otoke</b></h2><br>

<?php
    if(Admin()){
        ?>
            <a href='dodaj_raspored_otoci.php' class='btn btn-primary'>Dodaj novo</a><br></br></br>
        <?php
    }

    echo"<h4><b>Tjedno:</b></h4><br>";

    $query='SELECT * FROM raspored_otoci ORDER BY raspored_id';
    $redci = mysqli_query($konekcija, $query);

    if(mysqli_num_rows($redci)>0){
        while ($row=$redci->fetch_assoc()){
            ?>
            <div class="podaci">
                <div>
                    <li class='placanje'><b> <?php echo $row['dan'] . ": " ?> </b> <?php echo $row['otoci'] ?></li>
                    <?php
                        if(Admin()){
                            echo"
                            <a href='uredi_podatke_raspored.php?edit=$row[raspored_id]' class='btn-edit-dostava'><i class='icon-edit'></i> </a>";
                        }
                    ?>
                </div>
            </div><br>

            
            <?php
        }
    }else{
        echo '<p> Nema dostavljanja na dan Ponedjeljak!</p>';
    }
?>
<br>
<div class="podaci">
    <p>
        Ako naručitelj prilikom dostave pošiljke nije kod kuće, dostavljač će u sandučiću ostaviti "obavijest o dospijeću pošiljke" sa potrebnim kontaktom pomoću kojeg će se naručitelj moći sa dostavljačem ponovno dogovoriti za dostavu pošiljke.
        Rok za dogovor termina ponovne dostave je tjedan dana te se nakon tog roka pošiljka šalje natrag pošiljatelju.
    </p>

    <p>
        Napomena: za otoke koji nisu navedeni u rasporedu dostave na otoke, nemamo mogućnost dostave.
    </p>
</div>

<div>
    <hr>
    <img src='sve_slike/otok.png' style="width: 300px;"  />
</div>

<?php
echo"</div>";
    require_once('footer2.php');
?>