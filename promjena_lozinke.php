<?php 
    $title="Promjena lozinke - Pet Shop"; 
    require_once("head.php"); 
    require_once("baza.php");
            
    echo "<script>
    document.getElementById('oprema').classList.add('active');
    document.getElementById('dodajOpremu').classList.add('active');
    </script><link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>";

    echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
    <div class='animate__animated animate__bounceInLeft bar2'>
        <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <a href='postavke.php' class='bar'> / <i class='icon-edit-sign'></i> Postavke</a><span> / <i class='icon-key'></i> Promjena lozinke</span></h2><br></br>
        <a class='btn btn-danger px-3 me-2' href='postavke.php' ><i class='icon-arrow-left'></i> Povratak </a>
        <br></br><br>
    ";


    if(isset($_SESSION['korisnik_id'])){
        if(isset($_POST['urediProfil'])){
            $korisnik_id = $_SESSION['korisnik_id'];
            $lozinka = $_POST['lozinka'];

            if(empty($lozinka)){
                echo '<div class="alert alert-danger">Molimo napišite novu lozinku</div>';
            } else{
                $update = $konekcija->prepare('UPDATE korisnici SET lozinka=? WHERE korisnik_id=?');
                $hash = password_hash($lozinka, PASSWORD_DEFAULT);
                $update -> bind_param('sd', $hash, $korisnik_id);
                if($update->execute()){
                    echo '<div class="alert alert-success animate__animated animate__backInLeft">Lozinka je uspješno promjenjena! Ponovno se prijavite s novim podacima</div>';
                } else {
                    echo '<div class="alert alert-danger animate__animated animate__backInLeft">Neuspješno uređivanje!</div>';
                }
            }
        }
?>

<div class="form_uredi">
    <div class="admin-product-form-container centered">

    <?php
        $query="SELECT*FROM korisnici WHERE korisnik_id = $korisnik_id";
        $redci = $konekcija->query($query);
        while ($row=$redci->fetch_assoc()){
    ?>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                <h4>Promjeni lozinku:</h4>
                <input type="password" value="<?php echo $row['lozinka'];?> "  name="lozinka" class="box">
                </br>
                <input type="submit" class="btn btn-success uredi" name="urediProfil" value="Uredi">
        </form>
        <?php }; ?>
    </div>
</div>

<?php
    }else{
        echo '<div class="alert alert-danger animate__animated animate__backInLeft">Nemate ovlasti za pristup!</div>';
    }
?>

<?php echo"</div>"; require_once("footer2.php"); ?>