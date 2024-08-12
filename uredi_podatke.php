<?php 
    $title="Uredi podatke o dostavi - Pet Shop"; 
    require_once("head.php"); 
    require_once("baza.php");
            
    echo "<script>
    document.getElementById('oprema').classList.add('active');
    document.getElementById('dodajOpremu').classList.add('active');
    </script><link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>";

    echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
    <div class='animate__animated animate__bounceInLeft bar2'>
        <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / </span> <a href='dostava.php' class='bar'> Dostava</a><span> / Uređivanje podataka o dostavi</span></h2>
        <br>
        <a class='btn btn-danger px-3 me-2' href='dostava.php' ><i class='icon-arrow-left'></i> Povratak </a>
        <br></br>
    ";


    $id_podaci = $_GET['edit'];

    if(Admin()){
        if(isset($_POST['urediPodatak'])){
            $naslov = trim($_POST['naslov']);
            $opis = trim($_POST['opis']);

            if(empty($naslov) || empty($opis)){
                echo '<div class="alert alert-danger">Molimo ispunite sva polja</div>';
            } else{
                $update = $konekcija->prepare('UPDATE dostava_podaci SET naslov=?, opis=? WHERE id_podaci=?');
                $update -> bind_param('ssd', $naslov, $opis, $id_podaci);
                if($update->execute()){
                    echo '<div class="alert alert-success animate__animated animate__backInLeft">Podatak je uspješno uređen!</div>';
                } else {
                    echo '<div class="alert alert-danger animate__animated animate__backInLeft">Neuspješno uređivanje!</div>';
                }
            }
        }
?>

<div class="form_uredi">
    <div class="admin-product-form-container centered">

    <?php
        $query="SELECT*FROM dostava_podaci WHERE id_podaci = $id_podaci";
        $redci = $konekcija->query($query);
        while ($row=$redci->fetch_assoc()){
    ?></br></br></br></br>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h3><i class="icon-edit"></i> Uredi podatak</h3>
                <input type="text" value="<?php echo $row['naslov'];?> "  name="naslov" class="box">
                <input type="text" value="<?php echo $row['opis']; ?>" name="opis" class="box" >
                </br>
                <input type="submit" class="btn btn-success uredi" name="urediPodatak" value="Uredi">
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