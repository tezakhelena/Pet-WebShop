<?php 
    $title="Higijena - Pet Shop"; 
    require_once("head.php"); 
    require_once("baza.php"); 
    
    echo "
        <script>
            document.getElementById('higijena').classList.add('active');
            document.getElementById('dodajHigijena').classList.add('active');
        </script>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
    ";

    echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
    <div class='animate__animated animate__bounceInLeft bar2'>
        <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / </span> <a href='higijena.php' class='bar'> Higijena</a><span> / Dodaj novu higijenu</span></h2>
        <br>
        <a class='btn btn-danger px-3 me-2' href='higijena.php' ><i class='icon-arrow-left'></i> Povratak </a>
        <br></br>
    ";

    if(Admin()){
        
        if(isset($_POST['dodajHigijena'])){
            $naziv = $_POST['naziv'];
            $cijena = $_POST['cijena'];
            $slika = $_FILES['slika']['name'];
            $slika_tmp_name = $_FILES['slika']['tmp_name'];
            $slika_folder = 'sve_slike/'.$slika;
            $kategorija_id = $_POST['kategorija_id'];
            $dostupnost = $_POST['dostupnost'];
            $opis = $_POST['opis'];
            
            $dozvoljeni_MIME = array("image/png", "image/jpeg", "image/jpg", "image/bmp", "image/gif");

            $input_error = array();

            if (empty($naziv)) {
                $input_error['naziv'] = "Naziv je obavezan";
            }else{
                $naziv = trim($_POST['naziv']);
            }
            if(trim($_POST['opis']) == "") {
                $input_error['opis'] = "Opis je obavezan";
            }else{
                $opis = trim($_POST['opis']);
            }

            if ($_REQUEST['kategorija_id'] == 9)
            {
              $input_error['kategorija_id'] = 'Kategorija je obavezna';
            }
            
            if ($_REQUEST['dostupnost'] == "Neodabrano")
            {
              $input_error['dostupnost'] = 'Dostupnost je obavezna';
            }

            if (empty($cijena)) {
                $input_error['cijena'] = "Cijena je obavezna";
            }else{
                $cijena = trim($_POST['cijena']);
            }
            if (empty($slika)) {
                $input_error['slika'] = "Slika je obavezna";
            }
            if(!empty($_FILES['slika']['type'])&&!in_array($_FILES['slika']['type'], $dozvoljeni_MIME)){
                $slika_error = '<b>Niste odabrali ispravan tip datoteke!</b>';
            }
            if (empty($kategorija_id)) {
                $input_error['kategorija_id'] = "Kategorija je obavezna";
            }

            if(count($input_error)==0){
                if (strlen($naziv)>2){
                    if (strlen($cijena)>=1) {
                        if(in_array($_FILES['slika']['type'], $dozvoljeni_MIME)){
                            if($kategorija_id != 9){
                                if($dostupnost != "Neodabrano"){
                                    if($opis > 2){
                                        $query = $konekcija->prepare('INSERT INTO higijena(naziv, cijena, slika, kategorija_id, dostupnost, opis) VALUES (?,?,?,?,?,?)');
                                        $query->bind_param('sssdss', $naziv, $cijena, $slika, $kategorija_id, $dostupnost, $opis);
                                        if ($query->execute()) {
                                            move_uploaded_file($slika_tmp_name, $slika_folder);
                                            echo '<div class="alert alert-success">Uspješno ste dodali higijenski proizvod!</div>';
                                        }else{
                                            echo '<div class="alert alert-danger">Neuspješna dodavanje!</div>';
                                        }
                                    }else{
                                        echo '<div class="alert alert-danger">Polje opis mora imati više od 2 znaka!</div>';
                                    }
                                }else{
                                    echo '<div class="alert alert-danger">Odaberite dostupnost!</div>';
                                }
                            }else{
                                echo '<div class="alert alert-danger">Odaberite kategoriju!</div>';
                            }
                        }else{
                            echo '<div class="alert alert-danger">Niste odabrali ispravan tip datoteke!</div>';
                        }
                    }else{
                        echo '<div class="alert alert-danger">Unesite cijenu!</div>';
                    }
                }else{
                    echo '<div class="alert alert-danger">Polje naziv mora imati više od 2 slova!</div>';
                }
            }
        }
        echo"</div>";
?>

<div class="container">
    <div class="dodavanje animate__animated animate__pulse">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h3>Dodaj novi higijenski proizvod u bazu</h3>
                <select name="kategorija_id">
                    <option value="9">Odaberi kategoriju</option>
                    <?php
                        $query='SELECT * FROM kategorija';
                        $redci = mysqli_query($konekcija, $query);
                        while ($row=$redci->fetch_assoc()){
                            echo"<option value=" . $row['kategorija_id'] . ">" . $row['naziv_kategorija'] . "</option>";
                        }
                    ?>
                </select>
                <?= isset($input_error['kategorija_id'])? '<label class="text-danger">'.$input_error['kategorija_id'].'</label><br>':'';  ?>
                <select name="dostupnost">
                        <option value="Neodabrano">Gdje je dostupan proizvod?</option>
                        <option value="Samo u poslovnici" <?php if(isset($_POST['dostupnost']) && $_POST['dostupnost']=="Samo u poslovnici"){ echo 'selected';} ?>>Samo u poslovnici</option>
                        <option value="Online i poslovnica" <?php if(isset($_POST['dostupnost']) && $_POST['dostupnost']=="Online i poslovnica"){ echo 'selected';} ?>>Online i poslovnica</option>
                </select>
                <?= isset($input_error['dostupnost'])? '<label class="text-danger">'.$input_error['dostupnost'].'</label><br>':'';  ?>
                <input type="text" value="<?= isset($naziv)? $naziv:'' ?>" placeholder="Unesi naziv proizvoda" name="naziv" class="box">
                <?= isset($input_error['naziv'])? '<label class="text-danger">'.$input_error['naziv'].'</label><br>':'';  ?>
                <input type="number" value="<?= isset($cijena)? $cijena:'' ?>" step="any" placeholder="Unesi cijenu proizvoda"  name="cijena" class="box">
                <?= isset($input_error['cijena'])? '<label class="text-danger">'.$input_error['cijena'].'</label><br>':'';  ?>
                <input type="file" accept="image/png, image/jpeg, image/jpg, image/bmp, image/gif" name="slika" class="box">
                <?= isset($input_error['slika'])? '<label class="text-danger">'.$input_error['slika'].'</label><br>':'';  ?>
                <textarea type="comment" placeholder="Unesi opis proizvoda" name="opis" class="box" rows="5" cols="40">
                    <?php if(isset($_POST['opis'])){
                        echo($_POST['opis']);
                    } ?>
                </textarea>    
                <?= isset($input_error['opis'])? '<label class="text-danger">'.$input_error['opis'].'</label><br>':'';  ?>
                </br>
                <button type="submit" class="btn btn-success" name="dodajHigijena"><i class="icon-save"></i> Spremi</button>
        </form>
    </div>

    <div>
        <img src='sve_slike/higijena.png' class='slika1 animate__animated animate__pulse'  />
    </div>
    
</div>

<?php
    } else{
        echo '<div class="alert alert-danger animate__animated animate__backInLeft">Nemate ovlasti za pristup!</div>';
    }
    require_once("footer2.php");
?>
