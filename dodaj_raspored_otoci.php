<?php 
    $title="Dodavanje novog rasporeda na otoke - Pet Shop"; 
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
        <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / </span> <a href='raspored_dostave_na_otoke.php' class='bar'> Dostava na otoke</a><span> / Dodaj raspored dostave na otoke</span></h2>
        <br>
        <a class='btn btn-danger px-3 me-2' href='raspored_dostave_na_otoke.php' ><i class='icon-arrow-left'></i> Povratak </a>
        <br></br>";

    if(Admin()){
        
        if(isset($_POST['dodajRaspored'])){
            $dan = $_POST['dan'];
            $otoci = $_POST['otoci'];
            
            $input_error = array();

            
            if (empty($otoci)) {
                $input_error['otoci'] = "Upišite otoke";
            }else{
                $otoci = trim($_POST['otoci']);
            }

            if ($_REQUEST['dan'] == "Neodređeno")
            {
              $input_error['dan'] = 'Dan je obavezan';
            }

            if(count($input_error)==0){
                if(strlen($otoci)>2 && preg_match("/^[a-zčćšžđA-ZČĆŽĐŠ.;,\.\- ]*$/",$otoci)){
                    if($dan != "Neodređeno"){
                        $query = $konekcija->prepare('INSERT INTO raspored_otoci(dan, otoci) VALUES (?,?)');
                        $query->bind_param('ss', $dan, $otoci);
                        if ($query->execute()) {
                            echo '<div class="alert alert-success">Uspješno ste dodali podatak u raspored dostavljanja na otoke!</div>';
                        }else{
                            echo '<div class="alert alert-danger">Neuspješno dodavanje!</div>';
                        }
                    }else{
                        echo '<div class="alert alert-danger">Molimo Vas da odaberete dan u tjednu!</div>';
                    }
                }else{
                    echo '<div class="alert alert-danger">Molimo Vas da napišete otoke!</div>';
                }
            }
        }
        echo"</div>";
?>

<div class="container">
    <div class="dodavanje animate__animated animate__pulse">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h3>Dodaj nove podatke u raspored dostavljanja na otoke</h3>
                <select name="dan">
                    <option value="Neodređeno">Odaberite dan u tjednu</option>
                    <option value="Ponedjeljak" <?php if(isset($_POST['dan']) && $_POST['dan']=="Ponedjeljak"){ echo 'selected';} ?>>Ponedjeljak</option>
                    <option value="Utorak" <?php if(isset($_POST['dan']) && $_POST['dan']=="Utorak"){ echo 'selected';} ?>>Utorak</option>
                    <option value="Srijeda" <?php if(isset($_POST['dan']) && $_POST['dan']=="Srijeda"){ echo 'selected';} ?>>Srijeda</option>
                    <option value="Četvrtak" <?php if(isset($_POST['dan']) && $_POST['dan']=="Četvrtak"){ echo 'selected';} ?>>Četvrtak</option>
                    <option value="Petak" <?php if(isset($_POST['dan']) && $_POST['dan']=="Petak"){ echo 'selected';} ?>>Petak</option>
                    <option value="Svaki radni dan" <?php if(isset($_POST['dan']) && $_POST['dan']=="Ponedjeljak"){ echo 'selected';} ?>>Svaki radni dan</option>
                </select>
                <?= isset($input_error['dan'])? '<label class="text-danger">'.$input_error['dan'].'</label><br>':'';  ?>
                <input type="text" value="<?= isset($otoci)? $otoci:'' ?>" placeholder="Unesite otoke..." name="otoci" class="box">
                <?= isset($input_error['otoci'])? '<label class="text-danger">'.$input_error['otoci'].'</label><br>':'';  ?>
                </br>
                <button type="submit" class="btn btn-success" name="dodajRaspored"><i class="icon-save"></i> Spremi</button>
                <a href="raspored_dostave_na_otoke.php" class="btn btn-danger"><i class="icon-arrow-left"></i> Natrag</a>
        </form>
    </div>
</div>

<?php
    } else{
        echo '<div class="alert alert-danger animate__animated animate__backInLeft">Nemate ovlasti za pristup!</div>';
    }

    require_once('footer2.php');
?>
