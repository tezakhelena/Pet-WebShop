<?php 
    $title="Podaci o plaćanju - Pet Shop"; 
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
        <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / </span> <a href='placanje.php' class='bar'> Plaćanje</a><span> / Dodaj nove podatke o plaćanju</span></h2>
        <br>
        <a class='btn btn-danger px-3 me-2' href='placanje.php' ><i class='icon-arrow-left'></i> Povratak </a>
        <br></br>";

    if(Admin()){
        
        if(isset($_POST['dodajPodatke'])){
            $vrsta = $_POST['vrsta'];
            $opis = $_POST['opis'];
            

            $input_error = array();

            if (empty($vrsta)) {
                $input_error['vrsta'] = "Vrsta je obavezan";
            }else{
                $vrsta = trim($_POST['vrsta']);
            }
            if(trim($_POST['opis']) == "") {
                $input_error['opis'] = "Opis je obavezan";
            }else{
                $opis = trim($_POST['opis']);
            }

            if(count($input_error)==0){
                if (strlen($vrsta)>2){
                    if (strlen($opis)>3) {
                        $query = $konekcija->prepare('INSERT INTO placanje_podaci(vrsta, opis) VALUES (?,?)');
                        $query->bind_param('ss', $vrsta, $opis);
                        if ($query->execute()) {
                            echo '<div class="alert alert-success">Uspješno ste dodali novi podatak o plaćanju!</div>';
                        }else{
                            echo '<div class="alert alert-danger">Neuspješno dodavanje!</div>';
                        }
                    }else{
                        echo '<div class="alert alert-danger">Unesite opis!</div>';
                    }
                }else{
                    echo '<div class="alert alert-danger">Polje vrsta mora imati više od 2 slova!</div>';
                }
            }
        }
        echo"</div>";
?>

<div class="container">
    <div class="dodavanje animate__animated animate__pulse">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h3>Dodaj nove podatke o plaćanju</h3>
                <input type="text" value="<?= isset($vrsta)? $vrsta:'' ?>" placeholder="Vrsta plaćanja..." name="vrsta" class="box">
                <?= isset($input_error['vrsta'])? '<label class="text-danger">'.$input_error['vrsta'].'</label><br>':'';  ?>
                <textarea type="comment" placeholder="Unesi opis proizvoda" name="opis" class="box" rows="5" cols="40">
                    <?php if(isset($_POST['opis'])){
                        echo($_POST['opis']);
                    } ?>
                </textarea>   
                <?= isset($input_error['opis'])? '<label class="text-danger">'.$input_error['opis'].'</label><br>':'';  ?>
                </br>
                <button type="submit" class="btn btn-success" name="dodajPodatke"><i class="icon-save"></i> Spremi</button>
                <a href="placanje.php" class="btn btn-danger"><i class="icon-arrow-left"></i> Natrag</a>
        </form>
    </div>
</div>

<?php
    } else{
        echo '<div class="alert alert-danger animate__animated animate__backInLeft">Nemate ovlasti za pristup!</div>';
    }

    require_once('footer2.php');
?>
