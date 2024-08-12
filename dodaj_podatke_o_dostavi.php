<?php 
    $title="Podaci o dostavi - Pet Shop"; 
    require_once("head.php"); 
    require_once("baza.php"); 
    
    echo "
        <script>
            document.getElementById('oprema').classList.add('active');
            document.getElementById('dodajOpremu').classList.add('active');
        </script>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
    ";

    echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
    <div class='animate__animated animate__bounceInLeft bar2'>
        <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / </span> <a href='dostava.php' class='bar'> Dostava</a><span> / Dodaj nove podatke o dostavi</span></h2>
        <br>
        <a class='btn btn-danger px-3 me-2' href='dostava.php' ><i class='icon-arrow-left'></i> Povratak </a>
        <br></br>";

    if(Admin()){
        
        if(isset($_POST['dodajPodatke'])){
            $naslov = $_POST['naslov'];
            $opis = $_POST['opis'];
            

            $input_error = array();

            if (empty($naslov)) {
                $input_error['naslov'] = "Naslov je obavezan";
            }else{
                $naslov = trim($_POST['naslov']);
            }
            if(trim($_POST['opis']) == "") {
                $input_error['opis'] = "Opis je obavezan";
            }else{
                $opis = trim($_POST['opis']);
            }

            if(count($input_error)==0){
                if (strlen($naslov)>2){
                    if (strlen($opis)>3) {
                        $query = $konekcija->prepare('INSERT INTO dostava_podaci(naslov, opis) VALUES (?,?)');
                        $query->bind_param('ss', $naslov, $opis);
                        if ($query->execute()) {
                            echo '<div class="alert alert-success">Uspješno ste dodali novi podatak o dostavi!</div>';
                        }else{
                            echo '<div class="alert alert-danger">Neuspješno dodavanje!</div>';
                        }
                    }else{
                        echo '<div class="alert alert-danger">Unesite opis!</div>';
                    }
                }else{
                    echo '<div class="alert alert-danger">Polje naslov mora imati više od 2 slova!</div>';
                }
            }
        }
        echo"</div>";
?>

<div class="container">
    <div class="dodavanje animate__animated animate__pulse">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h3>Dodaj nove podatke o dostavi</h3>
                <input type="text" value="<?= isset($naslov)? $naslov:'' ?>" placeholder="Naslov..." name="naslov" class="box">
                <?= isset($input_error['naslov'])? '<label class="text-danger">'.$input_error['naslov'].'</label><br>':'';  ?>
                <textarea type="comment" placeholder="Unesi opis proizvoda" name="opis" class="box" rows="5" cols="40">
                    <?php if(isset($_POST['opis'])){
                        echo($_POST['opis']);
                    } ?>
                </textarea>    
                <?= isset($input_error['opis'])? '<label class="text-danger">'.$input_error['opis'].'</label><br>':'';  ?>
                </br>
                <button type="submit" class="btn btn-success" name="dodajPodatke"><i class="icon-save"></i> Spremi</button>
                <a href="dostava.php" class="btn btn-danger"><i class="icon-arrow-left"></i> Natrag</a>
        </form>
    </div>
</div>

<?php
    } else{
        echo '<div class="alert alert-danger animate__animated animate__backInLeft">Nemate ovlasti za pristup!</div>';
    }

    require_once("footer2.php");
?>
