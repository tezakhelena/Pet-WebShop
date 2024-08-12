<?php 
    $title="Novi upit - Pet Shop"; 
    require_once("head.php"); 
    require_once("baza.php");  
    
    echo "<script>
    document.getElementById('upiti').classList.add('active');
    document.getElementById('dodajUpite').classList.add('active');
    </script>";
    echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>";

    echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
    <div class='animate__animated animate__bounceInLeft bar2'>
        <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a><span> / <i class='icon-search'></i> Novi upit</span></h2>
        <br>
        <a class='btn btn-danger px-3 me-2' href='index.php' ><i class='icon-arrow-left'></i> Povratak </a><br></br>
    ";

    if(isset($_SESSION['korisnik_id'])){
        $korisnik = $_SESSION['korisnik'];
        if(isset($_POST['dodajUpit'])){
            
            $pitanje = $_POST['pitanje'];
            $odgovor = $_POST['odgovor'];
            $odobrenje = 1;
            $procitano = 1;
            $korisnik_id = $_SESSION['korisnik_id'];

            if(empty($pitanje)){
                echo '<div class="alert alert-danger">Pitanje je obavezno!</div>';
            }elseif (strlen($pitanje) > 255) {  
                echo '<div class="alert alert-danger">Pitanje smije imati samo 255 znakova!</div>';
            }
            else{
                $odgovor = "Još nema odgovora";
                $query = $konekcija->prepare('INSERT INTO upiti(pitanje, korisnik, korisnik_id, odobrenje, procitano, odgovor) VALUES (?,?,?,?,?,?)');
                $query->bind_param('ssssss', $pitanje, $korisnik, $korisnik_id, $odobrenje, $procitano, $odgovor);
                if($query->execute()){
                    echo '<div class="alert alert-success animate__animated animate__backInLeft">Upit uspješno poslan!</div>';
                } else {
                    echo '<div class="alert alert-danger animate__animated animate__backInLeft">Neuspješno slanje, pokušajte opet!</div>';
                }
            }
        } 
    


?>

<div class="container">
    <div class="upit">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h3>Pošalji nam upit</h3>
                <input type="hidden" value="<?php echo $row['korisnik_id'];?> " name="korisnik_id" class="box">
                <input type="hidden" value="<?php echo $row['odgovor'];?> " name="odgovor" class="box">
                <textarea type="comment" placeholder="Unesi pitanje" name="pitanje" class="box" rows="5" cols="40"></textarea>
                </br>
                <button type="submit" class="btn btn-success" name="dodajUpit"><i class="icon-save"></i> Pošalji</button>
                <a href="svi_upiti.php" class="btn btn-danger"><i class="icon-arrow-left"></i> Natrag</a>
        </form>
    </div>

    <div>
        <img src='sve_slike/question1.png' class='slika_noviUpit'  />
    </div>
</div>


<?php 
    }else{
        echo '<div class="alert alert-danger animate__animated animate__backInLeft">Nemate pristup ovoj stranici!</div>';
    }
    echo"</div>";
require_once("footer2.php"); ?>