<?php 
    $title="Nova poruka - Pet Shop"; 
    require_once("head.php"); 
    require_once("baza.php");  
    
    echo "<script>
    document.getElementById('upiti').classList.add('active');
    document.getElementById('dodajUpite').classList.add('active');
    </script>";
    echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>";

    echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
    <div class='animate__animated animate__bounceInLeft bar2'>
        <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a><span> / <i class='icon-message'></i> Poruke</span></h2>
        <br>
        <a class='btn btn-danger px-3 me-2' href='index.php' ><i class='icon-arrow-left'></i> Povratak </a> <br> </br>
    ";

    if(isset($_SESSION['korisnik_id'])){
        $korisnik = $_SESSION['korisnik'];
        if(isset($_POST['dodajUpit'])){
            
            $pitanje = $_POST['pitanje'];
            $korisnik_id = $_SESSION['korisnik_id'];
            $odgovor = $_POST["odgovor"];
            $vrsta = $_POST["vrsta"];
            $status_poruke = $_POST['status_poruke'];

            $input_error = array();

            if(trim($_POST['pitanje']) == "") {
                $input_error['pitanje'] = "Pitanje je obavezno";
            }else{
                $opis = trim($_POST['pitanje']);
            }

            if ($_REQUEST['vrsta'] == "Neodređeno")
            {
              $input_error['vrsta'] = 'Vrsta je obavezna';
            }
            
            if(count($input_error)==0){
                if(strlen($pitanje) < 500) {  
                    $odgovor = "Poštovanje, hvala Vam na poruci! Ovo je automatski odgovor, potrudit ćemo se odgovoriti Vam u što kraćem roku, točnije u sklopu radnog vremena koji piše na stranici. Lijep pozdrav!";
                    $status_poruke = 0;
                    $query = $konekcija->prepare('INSERT INTO poruke(pitanje, korisnik, korisnik_id, odgovor, vrsta, status_poruke) VALUES (?,?,?,?,?,?)');
                    $query->bind_param('ssdssd', $pitanje, $korisnik, $korisnik_id, $odgovor, $vrsta, $status_poruke);
                    if($query->execute()){
                        echo '<div class="alert alert-success animate__animated animate__backInLeft">Pitanje uspješno poslano!</div>';
                    } else {
                        echo '<div class="alert alert-danger animate__animated animate__backInLeft">Neuspješno slanje, pokušajte opet!</div>';
                    }
                }else{
                    echo '<div class="alert alert-danger animate__animated animate__backInLeft">Pitanje smije imati samo 500 znakova!</div>';
                }
            }
        } 
    


?>

<div class="container">
    <div class="upit">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <p><b>Pošalji nam poruku i javit ćemo se u najkraćem mogućem roku</b></p>
                <select name="vrsta">
                    <option value="Neodređeno">Zašto Vam treba pomoć?</option>
                    <option value="Neispravna pošiljka" <?php if(isset($_POST['vrsta']) && $_POST['vrsta']=="Neispravna pošiljka"){ echo 'selected';} ?>>Neispravna pošiljka</option>
                    <option value="Otkazivanje narudžbe" <?php if(isset($_POST['vrsta']) && $_POST['vrsta']=="Otkazivanje narudžbe"){ echo 'selected';} ?>>Otkazivanje narudžbe</option>
                    <option value="Stanje narudžbe" <?php if(isset($_POST['vrsta']) && $_POST['vrsta']=="Stanje narudžbe"){ echo 'selected';} ?>>Stanje narudžbe</option>
                    <option value="Dostava" <?php if(isset($_POST['vrsta']) && $_POST['vrsta']=="Dostava"){ echo 'selected';} ?>>Dostava</option>
                    <option value="Prigovor" <?php if(isset($_POST['vrsta']) && $_POST['vrsta']=="Prigovor"){ echo 'selected';} ?>>Prigovor</option>
                    <option value="Izdavanje R1 računa" <?php if(isset($_POST['vrsta']) && $_POST['vrsta']=="Izdavanje R1 računa"){ echo 'selected';} ?>>Izdavanje R1 računa</option>
                    <option value="Ostalo" <?php if(isset($_POST['vrsta']) && $_POST['vrsta']=="Ostalo"){ echo 'selected';} ?>>Ostalo</option>
                </select>
                <?= isset($input_error['vrsta'])? '<label class="text-danger">'.$input_error['vrsta'].'</label><br>':'';  ?>
                <input type="hidden" value="<?php echo $row['status_poruke'];?> " name="status_poruke" class="box">
                <input type="hidden" value="<?php echo $row['korisnik_id'];?> " name="korisnik_id" class="box">
                <input type="hidden" value="<?php echo $row['odgovor'];?> " name="odgovor" class="box">
                <label>Što ti je na umu?</label>
                <textarea type="comment" placeholder="Unesi pitanje" name="pitanje" class="box" rows="5" cols="40">
                    <?php if(isset($_POST['pitanje'])){
                        echo($_POST['pitanje']);
                    } ?>
                </textarea>  
                <?= isset($input_error['pitanje'])? '<label class="text-danger">'.$input_error['pitanje'].'</label><br>':'';  ?>                    </br>
                <button type="submit" class="btn btn-success" name="dodajUpit"><i class="icon-save"></i> Pošalji</button>
        </form>
    </div>
</div>


<?php 
    }else{
        echo '<div class="alert alert-danger animate__animated animate__backInLeft">Molimo Vas da se prijavite!</div>';
    }

    echo"</div>";
require_once("footer2.php"); ?>