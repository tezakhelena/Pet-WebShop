<?php
    $title = "Uređivanje narudžbe - Pet Shop"; require_once("head.php"); require_once("baza.php"); require_once("PFBC/Form.php");

    echo "<script>
    document.getElementById('narudzbe').classList.add('active');
    </script><link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>";

    $id = $_GET['edit'];

    if(Admin()){

        echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
        <div class='animate__animated animate__bounceInLeft bar2'>
            <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / </span> <a href='sve_narudzbe.php' class='bar'>Narudžbe</a><span> / Uređivanje podataka o dostavi narudžbe</span></h2>
            <br>
            <a class='btn btn-danger px-3 me-2' href='sve_narudzbe.php' ><i class='icon-arrow-left'></i> Povratak </a>
            <br></br>
        ";
        
        if(isset($_POST['urediNarudzba'])){
            $korisnik = $_SESSION['korisnik'];
            $korisnik_id = $_SESSION['korisnik_id'];
            $telefon = $_SESSION['telefon'];
            $email = $_SESSION['email'];
            $ulica = $_POST['ulica'];
            $grad = $_POST['grad'];
            $postanski_broj = $_POST['postanski_broj'];

            if(empty($telefon) || empty($email) || empty($ulica) || empty($grad) || empty($postanski_broj) ){
                echo '<div class="alert alert-danger">Molimo ispunite sva polja</div>';
            } else{
                $update = $konekcija->prepare('UPDATE narudzba SET korisnik=?, telefon=?, email=?, ulica=?, grad=?, postanski_broj=? WHERE narudzba_id=?');
                $update -> bind_param('sssssss', $korisnik, $telefon, $email, $ulica, $grad, $postanski_broj, $id);

                if($update->execute()){
                    echo '<div class="alert alert-success animate__animated animate__backInLeft">Podaci o dostavi su uspješno uređeni!</div>';
                } else{
                    echo '<div class="alert alert-danger animate__animated animate__backInLeft">Neuspješno dodavanje u bazu!</div>';
                }
            }
        }
        echo"</div>";
?>

<div class="container">
        <div class="form_uredi">

        <?php
        $query="SELECT*FROM narudzba WHERE narudzba_id = $id";
        $redci = $konekcija->query($query);
        while ($row=$redci->fetch_assoc()){
        ?></br></br></br></br>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method = "post" class="animate__animated animate__pulse" enctype = "multipart/form-data">
                <h3><i class="icon-edit"></i> Uredi podatke dostave</h3>
                <p><?php echo $row['proizvod'];?> </p>
                <p><?php echo $row['korisnik'] . $row['prezime'];?> </p>
                <p><?php echo $row['telefon'];?> </p>
                <p><?php echo $row['email'];?> </p>
                <p><?php echo $row['totalna_cijena'] . " kn";?> </p>
                <input type="text" value="<?php echo $row['ulica'];?> " name="ulica" class="box">
                <input type="text" value="<?php echo $row['grad'];?> " name="grad" class="box">
                <input type="text" value="<?php echo $row['postanski_broj'];?> " name="postanski_broj" class="box">
                </br>
                <input type="submit" class="btn btn-success uredi" name="urediNarudzba" value="Uredi">
            </form>
            <?php };?>
        </div>
</div>

<?php
    }elseif(isset($_SESSION['korisnik_id'])){

        echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
        <div class='animate__animated animate__bounceInLeft bar2'>
            <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / </span> <a href='moje_narudzbe.php' class='bar'> Moje narudžbe</a><span> / Uređivanje podataka o dostavi narudžbe</span></h2>
            <button class='btn btn-danger px-3 me-2' onclick='history.go(-1);'><i class='icon-arrow-left'></i> Natrag </button>
            <br></br>
            ";
        $korisnik = $_SESSION['korisnik'];
        $korisnik_id = $_SESSION['korisnik_id'];?>

        <div class="container">
        <div class="form_uredi animate__animated animate__pulse">

        <?php

        $query="SELECT*FROM narudzba WHERE narudzba_id = $id AND korisnik_id='$korisnik_id'";
        $redci = $konekcija->query($query);
        while ($row=$redci->fetch_assoc()){
        ?></br></br></br></br>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method = "post" enctype = "multipart/form-data">
                <h3><i class="icon-edit"></i> Uredi podatke dostave</h3>
                <input type="number" value="<?php echo $row['telefon'];?>" name="telefon" class="box">
                <input type="text" value="<?php echo $row['email'];?>" name="email" class="box">
                <input type="text" value="<?php echo $row['ulica'];?> " name="ulica" class="box">
                <input type="text" value="<?php echo $row['grad'];?> " name="grad" class="box">
                <input type="text" value="<?php echo $row['postanski_broj'];?> " name="postanski_broj" class="box">
                </br>
                <input type="submit" class="btn btn-success uredi" name="urediNarudzba" value="Uredi">
            </form>
            <?php };?>
        </div>
</div>
<?php } require_once("footer2.php"); ?>



