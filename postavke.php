<?php 
    $title="Uredi profil - Pet Shop"; 
    require_once("head.php"); 
    require_once("baza.php");
            
    echo "<script>
    document.getElementById('oprema').classList.add('active');
    document.getElementById('dodajOpremu').classList.add('active');
    </script><link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>";

    echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
    <div class='animate__animated animate__bounceInLeft bar2'>
        <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a><span> / <i class='icon-edit-sign'></i> Postavke</span></h2>
        <br>
        <a class='btn btn-danger px-3 me-2' href='index.php' ><i class='icon-arrow-left'></i> Povratak </a>
        <br></br>
    ";


    if(isset($_SESSION['korisnik_id'])){
        if(isset($_POST['urediProfil'])){
            $korisnik_id = $_SESSION['korisnik_id'];
            $korisnik = trim($_POST['korisnik']);
            $email = trim($_POST['email']);
            $telefon = trim($_POST['telefon']);

            $input_error = array();

            if (empty($korisnik)) {
                $input_error['korisnik'] = "Korisničko ime je obavezno";
            }else{
                $korisnik = trim($_POST['korisnik']);
            }
            if (empty($email)) {
                $input_error['email'] = "Email je obavezan";
            }else{
                $korisnik = trim($_POST['korisnik']);
            }
            if (empty($telefon)) {
                $input_error['telefon'] = "Telefon je obavezan";
            }else{
                $telefon = trim($_POST['telefon']);
            }

            if (count($input_error)==0) {
                if (strlen($korisnik)>2){
                    if(strlen($telefon)==10 && preg_match ("/^[0-9.]*$/", $telefon)){
                        $update = $konekcija->prepare('UPDATE korisnici SET korisnik=?, email=?, telefon=? WHERE korisnik_id=?');
                        $update -> bind_param('sssd', $korisnik, $email, $telefon, $korisnik_id);
                        if($update->execute()){
                            echo '<div class="alert alert-success animate__animated animate__backInLeft">Profil je uspješno uređen! Ponovno se prijavite s novim podacima</div>';
                        } else {
                            echo '<div class="alert alert-danger animate__animated animate__backInLeft">Neuspješno uređivanje!</div>';
                        }
                    }else{
                        echo '<div class="alert alert-danger">Unesite važeći broj mobitela!</div>';
                    }
                }else{
                    echo '<div class="alert alert-danger">Polje korisnik mora imati više od 2 slova!</div>';
                }
            }
        }
        echo"</div>";
?>

<div class="form_uredi">
    <div class="animate__animated animate__pulse">

    <?php
        $query="SELECT*FROM korisnici WHERE korisnik_id = $korisnik_id";
        $redci = $konekcija->query($query);
        while ($row=$redci->fetch_assoc()){
            echo '
                <table class="table table-bordered tablica_profil">
                    <tr>
                        <td><b><i class="icon-user"></i></b></td>
                        <td>' .$row['korisnik']. '</td>
                    </tr>
                    <tr>
                        <td><b><i class="icon-envelope"></i></b></td>
                        <td>'. $row['email'] .'</td>
                    </tr>
                    <tr>
                        <td><b><i class="icon-phone"></i></b></td>
                        <td>'. $row['telefon'] .'</td>
                    </tr>
                    <tr>
                        <td><b><i class="icon-group"></i></b></td>
                        <td>'. $row['tip_korisnika'] .'</td>
                    </tr>
                </table>
            ';
    ?>
    <a type='button' class='btn btn-primary lozinka' href='promjena_lozinke.php'><i class="icon-key"></i> Promjeni lozinku</a></br></br></br></br>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" class="uredi_profil">
                <h4>Uredi svoje podatke:</h4>
                <input type="text" value="<?php echo $row['korisnik'];?>"  name="korisnik" class="box">
                <input type="text" value="<?php echo $row['email']; ?>" name="email" class="box">
                <input type="number" value="<?php echo $row['telefon'];?>" name="telefon" class="box">
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

<?php require_once("footer2.php"); ?>