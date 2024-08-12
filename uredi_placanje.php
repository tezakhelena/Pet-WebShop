<?php 
    $title="Uredi podatke o plaćanju - Pet Shop"; 
    require_once("head.php"); 
    require_once("baza.php");
            
    echo "<script>
    document.getElementById('oprema').classList.add('active');
    document.getElementById('dodajOpremu').classList.add('active');
    </script><link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>";

    echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
    <div class='animate__animated animate__bounceInLeft bar2'>
        <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / </span> <a href='placanje.php' class='bar'> Plaćanje</a><span> / Uređivanje podataka o plaćanju</span></h2>
        <br>
        <a class='btn btn-danger px-3 me-2' href='placanje.php' ><i class='icon-arrow-left'></i> Povratak </a>
        <br></br>
    ";


    $placanje_id = $_GET['edit'];

    if(Admin()){
        if(isset($_POST['urediPodatak'])){
            $vrsta = trim($_POST['vrsta']);
            $opis = trim($_POST['opis']);

            if(empty($vrsta) || empty($opis)){
                echo '<div class="alert alert-danger">Molimo ispunite sva polja</div>';
            } else{
                $update = $konekcija->prepare('UPDATE placanje_podaci SET vrsta=?, opis=? WHERE placanje_id=?');
                $update -> bind_param('ssd', $vrsta, $opis, $placanje_id);
                if($update->execute()){
                    echo '<div class="alert alert-success animate__animated animate__backInLeft">Podatak je uspješno uređen!</div>';
                    echo'<a type="button" href="placanje.php" class="btn btn-warning px-3 me-2">
                    <i class="icon-arrow-left"></i>
                    Natrag
                    </a>';
                } else {
                    echo '<div class="alert alert-danger animate__animated animate__backInLeft">Neuspješno uređivanje!</div>';
                }
            }
        }
?>

<div class="form_uredi">
    <div class="admin-product-form-container centered">

    <?php
        $query="SELECT*FROM placanje_podaci WHERE placanje_id = $placanje_id";
        $redci = $konekcija->query($query);
        while ($row=$redci->fetch_assoc()){
    ?></br></br></br></br>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h3><i class="icon-edit"></i> Uredi podatak</h3>
                <input type="text" value="<?php echo $row['vrsta'];?> "  name="vrsta" class="box">
                <input type="text" value="<?php echo $row['opis']; ?>" name="opis" class="box" >
                </br>
                <input type="submit" class="btn btn-success uredi" name="urediPodatak" value="Uredi">
                <a href="placanje.php" class="btn btn-danger"><i class="icon-arrow-left"></i> Natrag</a>
        </form>
                <?php }; ?>
    </div>
</div>

<?php
echo"</div>";
    }else{
        echo '<div class="alert alert-danger animate__animated animate__backInLeft">Nemate ovlasti za pristup!</div>';
    }
?>

<?php require_once("footer2.php"); ?>