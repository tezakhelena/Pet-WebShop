<?php 
    $title="Uredi upit - Pet Shop"; 
    require_once("head.php"); 
    require_once("baza.php");
        
    echo "<script>
    document.getElementById('upit').classList.add('active');
    document.getElementById('dodajUpit').classList.add('active');
    </script><link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>";

    $id = $_GET['edit'];

    if(isset($_POST['urediUpit'])){
        $odgovor = trim($_POST['odgovor']);
        $update = $konekcija->prepare('UPDATE upiti SET odgovor=? WHERE id=?');
        $update -> bind_param('ss', $odgovor, $id);
        if($update->execute()){
            echo '<div class="alert alert-success animate__animated animate__backInLeft">Uspješno ste odgovorili na postavljeno pitanje!</div>';
        } else {
            echo '<div class="alert alert-danger animate__animated animate__backInLeft">Pokušajte ponovno!</div>';
        }
    }

    if(isset($_POST['urediUpit2'])){
        $pitanje = trim($_POST['pitanje']);
        
        $update = $konekcija->prepare('UPDATE upiti SET pitanje=? WHERE id=?');
        $update -> bind_param('ss', $pitanje, $id);
        if($update->execute()){
            echo '<div class="alert alert-success animate__animated animate__backInLeft">Uspješno ste uredili pitanje!</div>';
        } else {
            echo '<div class="alert alert-danger animate__animated animate__backInLeft">Pokušajte ponovno!</div>';
        }
    }


    if(Admin()){
        
    echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
    <div class='animate__animated animate__bounceInLeft bar2'>
        <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / </span> <a href='svi_upiti.php' class='bar'> Upiti</a><span> /  Odgovaranje na upit</span></h2>
        <br>
        <a class='btn btn-danger px-3 me-2' href='svi_upiti.php' ><i class='icon-arrow-left'></i> Povratak </a>
        <br></br>
    ";
?>

<div class="container">
    <div class="form_upit">

    <?php
        $query="SELECT*FROM upiti WHERE id = $id";
        $redci = $konekcija->query($query);
        while ($row=$redci->fetch_assoc()){
        $korisnik = strval($row['korisnik']);
    ?> 

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h3><i class="icon-edit"></i> Odgovori na upit</h3>
                <input type="text" disabled value="<?php echo $row['korisnik']; ?> "  name="korisnik" class="box">
                <input type="text" disabled value="<?php echo $row['pitanje']; ?>" name="pitanje" class="box">
                <input type="text" placeholder="odgovor" value = "<?php echo $row['odgovor']; ?>" name="odgovor" class="box">
                </br>
                <input type="submit" class="btn btn-success uredi" name="urediUpit" value="Odgovori">
        </form>

        <?php }; ?>
    </div>
</div>

<?php
echo"</div>";
    }elseif(isset($_SESSION['korisnik_id'])){
        
    echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
    <div class='animate__animated animate__bounceInLeft bar2'>
        <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / </span> <a href='moji_upiti.php' class='bar'> Upiti</a><span> /  Uređivanje pitanja</span></h2>
        <br>
        <a class='btn btn-danger px-3 me-2' href='moji_upiti.php' ><i class='icon-arrow-left'></i> Povratak </a>
        <br></br>
    ";
        $korisnik = $_SESSION['korisnik'];
        $korisnik_id = $_SESSION['korisnik_id'];
        ?>
            <div class="container">
    <div class="form_upit">

    <?php
    $korisnik_id = $_SESSION['korisnik_id'];
        $query="SELECT*FROM upiti WHERE id = $id AND korisnik_id='$korisnik_id'";
        $redci = $konekcija->query($query);
        while ($row=$redci->fetch_assoc()){
        $korisnik = strval($row['korisnik']);
        
    ?> 

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h3><i class="icon-edit"></i> Uredi upit</h3>
                <input type="text" disabled value="<?php echo $row['korisnik']; ?> "  name="korisnik" class="box">
                <input type="text" value="<?php echo $row['pitanje']; ?>" name="pitanje" class="box">
                <p><?php echo $row['odgovor'] ?></p>
                </br>
                <input type="submit" class="btn btn-success uredi" name="urediUpit2" value="Uredi">
        </form>

        <?php }; ?>
    </div>
</div>
    <?php
    echo"</div>";
    }
require_once("footer2.php"); ?>