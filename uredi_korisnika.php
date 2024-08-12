<?php 
$title="Uredi račun - Pet Shop"; 
require_once("head.php"); 
require_once("baza.php");

if(Admin()){
            echo "<script>
            document.getElementById('korisnici').classList.add('active');
            document.getElementById('urediKorisnika').classList.add('active');
            </script><link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>";

            echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
            <div class='animate__animated animate__bounceInLeft bar2'>
                <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / </span> <a href='svi_korisnici.php' class='bar'> <i class='icon-user'></i> Svi korisnici</a><span> / Uređivanje korisnika</span></h2>
                <br>
                <a class='btn btn-danger px-3 me-2' href='svi_korisnici.php' ><i class='icon-arrow-left'></i> Povratak </a>
                <br></br>
            ";


    $id = $_GET['edit'];

    if(isset($_POST['urediKorisnika'])){
        $korisnik = trim($_POST['korisnik']);

        if(empty($korisnik)){
            echo '<div class="alert alert-danger">Molimo ispunite sva polja</div>';
        } else{
            if (strlen($korisnik)>2){
                $update = $konekcija->prepare('UPDATE korisnici SET korisnik=? WHERE korisnik_id=?');
                $update -> bind_param('ss', $korisnik, $id);

                if($update->execute()){
                    echo '<div class="alert alert-success animate__animated animate__backInLeft">Račun je uspješno uređen!</div>';
                } else {
                    echo '<div class="alert alert-danger animate__animated animate__backInLeft">Neuspješno uređivanje!</div>';
                }
            }else{
                echo '<div class="alert alert-danger animate__animated animate__backInLeft">Polje korisnik mora imati više od 4 znaka!</div>';
            }
        }
    }
    echo"</div>";
?>

<div class="form_uredi">
    <div class="animate__animated animate__pulse">

    <?php
        $query="SELECT*FROM korisnici WHERE korisnik_id = $id";
        $redci = $konekcija->query($query);
        while ($row=$redci->fetch_assoc()){

    ?></br></br></br></br>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h3><i class="icon-edit"></i> Uredi podatak</h3>
                <h5>Korisničko ime:</h5>
                <input type="text" placeholder="korisnik" value="<?php echo $row['korisnik'];?>"  name="korisnik" class="box">
                <input type="text" disabled value="<?php echo $row['tip_korisnika']; ?>"  name="tip_korisnika" class="box">
                <input type="text" disabled value="<?php echo $row['email']; ?>"  name="email" class="box">
                <input type="text" disabled value="<?php echo $row['telefon']; ?>"  name="telefon" class="box">
                </br>
                <input type="submit" class="btn btn-success uredi" name="urediKorisnika" value="Uredi">
        </form>

        <?php };  ?>
    </div>
</div>

<?php 

}else{
    echo '<div class="alert alert-danger animate__animated animate__backInLeft">Nemate pristup ovoj stranici!</div>';
}
require_once("footer2.php"); ?>