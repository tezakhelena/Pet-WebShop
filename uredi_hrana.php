<?php
    $title = "Hrana - Pet Shop"; 
    require_once("head.php"); 
    require_once("baza.php"); 
    
    echo "<script>
    document.getElementById('hrana').classList.add('active');
    document.getElementById('dodajHranu').classList.add('active');
    </script>    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>";

    echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
    <div class='animate__animated animate__bounceInLeft bar2'>
        <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / </span> <a href='hrana.php' class='bar'> Hrana</a><span> / Uređivanje podataka</span></h2>
        <br>
        <a class='btn btn-danger px-3 me-2' href='hrana.php' ><i class='icon-arrow-left'></i> Povratak </a>
        <br></br>
    ";

    $id = $_GET['edit'];

    if(Admin()){
        if(isset($_POST['urediHranu'])){
            $naziv = trim($_POST['naziv']);
            $okus = trim($_POST['okus']);
            $cijena = trim($_POST['cijena']);
            $opis = trim($_POST['opis']);

            if(empty($naziv) || empty($okus) || empty($cijena) || empty($opis)){
                echo '<div class="alert alert-danger">Molimo ispunite sva polja</div>';
            } else{
                if (strlen($naziv)>2){
                    if (strlen($okus)>2) {
                        if($opis > 2){
                            $update = $konekcija->prepare('UPDATE hrana SET naziv=?, okus=?, cijena=?, opis=? WHERE id=?');
                            $update -> bind_param('sssss', $naziv, $okus, $cijena, $opis, $id);

                            if($update->execute()){
                                echo '<div class="alert alert-success animate__animated animate__backInLeft">Proizvod je uspješno preuređen!</div>';
                            } else{
                                echo '<div class="alert alert-danger">Neuspješno preuređivanje!</div>';
                            }
                        }else{
                            echo '<div class="alert alert-danger">Polje opis mora imati više od 2 znaka!</div>';
                        }
                    }else{
                        echo '<div class="alert alert-danger">Polje okus mora imati više od 2 slova!</div>';
                    }
                }else{
                    echo '<div class="alert alert-danger">Polje naziv mora imati više od 2 slova!</div>';
                }
            }
        }

        if(isset($_POST['urediKategoriju'])){
            $kategorija_id = $_POST['kategorija_id'];
            if($kategorija_id == 9){
                echo '<div class="alert alert-danger">Molimo odaberite kategoriju</div>';
            } else{
                $update_kategorija = $konekcija->prepare('UPDATE hrana SET kategorija_id=? WHERE id=?');
                $update_kategorija -> bind_param('sd', $kategorija_id, $id);
                if($update_kategorija->execute()){
                    echo '<div class="alert alert-success animate__animated animate__backInLeft">Kategorija je preuređena!</div>';
                } else{
                    echo '<div class="alert alert-danger">Neuspješno preuređivanje!</div>';
                }
            }
        };

        if(isset($_POST['urediDostupnost'])){
            $dostupnost = $_POST['dostupnost'];
            if($dostupnost == 'Neodabrano'){
                echo '<div class="alert alert-danger">Molimo odaberite dostupnost</div>';
            } else{
                $update_dostupnost = $konekcija->prepare('UPDATE hrana SET dostupnost=? WHERE id=?');
                $update_dostupnost -> bind_param('sd', $dostupnost, $id);
                if($update_dostupnost->execute()){
                    echo '<div class="alert alert-success animate__animated animate__backInLeft">Dostupnost je preuređena!</div>';
                } else{
                    echo '<div class="alert alert-danger">Neuspješno preuređivanje!</div>';
                }
            }
        };
        echo"</div>";
?>

<div class="form_uredi_hrana">
    <div class="animate__animated animate__pulse">
        
        <?php
        $query="SELECT hrana.*, kategorija.naziv_kategorija FROM hrana INNER JOIN kategorija ON hrana.kategorija_id = kategorija.kategorija_id WHERE hrana.id = $id";
        $redci = $konekcija->query($query);
        while ($row=$redci->fetch_assoc()){
        ?></br></br></br></br></br>
        <section class="uredivanje_bla">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method = "post" class="podaci_uredi" enctype = "multipart/form-data">
                <h4><i class="icon-edit"></i> UREDI PODATAK</h4>
                <input type="text" value="<?php echo $row['naziv']; ?>" name="naziv" class="box">
                <input type="text" value="<?php echo $row['okus']; ?>" name="okus" class="box">
                <input type="number" step="any" value="<?php echo $row['cijena']; ?>" name="cijena" class="box">
                <input type="text" value="<?php echo $row['opis']; ?>" name="opis" class="box">
                </br>
                <input type="submit" class="btn btn-success uredi" name="urediHranu" value="Uredi">
            </form><br></br>

            <form action="<?php $_SERVER['PHP_SELF'] ?>" method = "post" class="podaci_uredi" enctype = "multipart/form-data">
                <h4><i class="icon-edit"></i> DOSTUPNOST PROIZVODA</h4>
                <input type="text" disabled value="<?php echo $row['dostupnost']; ?>" name="dostupnost" class="box">
                </br>
                <select name="dostupnost">
                    <option value="Neodabrano">Odaberi drugo</option>
                    <option value="Samo u poslovnici">Samo u poslovnici</option>
                    <option value="Online i poslovnica">Online i poslovnica</option>
                </select>
                <input type="submit" class="btn btn-success uredi" name="urediDostupnost" value="Uredi">
            </form>
            
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method = "post" class="podaci_uredi2"  enctype = "multipart/form-data">
                <h4> Kategorija: <?php echo $row['naziv_kategorija'] ?></h4>
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
                </br>
                <input type="submit" class="btn btn-success uredi" name="urediKategoriju" value="Uredi">
            </form>
            <?php
            }; ?>
            </div>
        </section>
    </div>
</div><br></br>

<?php
    }else{
        echo '<div class="alert alert-danger animate__animated animate__backInLeft">Nemate ovlasti za pristup!</div>';
    }
    require_once("footer2.php");
?>


