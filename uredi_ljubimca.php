<?php
    $title = "Ljubimac - Pet Shop"; require_once("head.php"); require_once("baza.php"); require_once("PFBC/Form.php");

    echo "<script>
    document.getElementById('ljubimci').classList.add('active');
    document.getElementById('dodajLjubimca').classList.add('active');
    </script>";

    echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
    <div class='animate__animated animate__bounceInLeft bar2'>
        <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / </span> <a href='ljubimci.php' class='bar'> Ljubimci</a><span> / Uređivanje podataka</span></h2>
        <br>
        <a class='btn btn-danger px-3 me-2' href='ljubimci.php' ><i class='icon-arrow-left'></i> Povratak </a>
        <br></br>
    ";

    $id = $_GET['edit'];

    if(Admin()){
        if(isset($_POST['urediLjubimca'])){
            $naziv = trim($_POST['naziv']);
            $ime = trim($_POST['ime']);
            $starost = trim($_POST['starost']);
            $cijena = trim($_POST['cijena']);
            $opis = trim($_POST['opis']);

            if(empty($naziv) || empty($ime) || empty($starost) || empty($cijena) || empty($opis)){
                echo '<div class="alert alert-danger">Molimo ispunite sva polja</div>';
            } else{
                if (strlen($naziv)>2){
                    if (strlen($ime)>2) {
                        if (strlen($opis)>2) {
                            $update = $konekcija->prepare('UPDATE ljubimci SET naziv=?, ime=?, starost=?, cijena=?, opis=? WHERE id=?');
                            $update -> bind_param('ssssss', $naziv, $ime, $starost, $cijena, $opis, $id);

                            if($update->execute()){
                                echo '<div class="alert alert-success">Proizvod je uspješno uređen!</div>';
                            } else{
                                echo '<div class="alert alert-danger">Neuspješno dodavanje u bazu!</div>';
                            }
                        }else{
                            echo '<div class="alert alert-danger">Polje opis mora imati više od 2 slova!</div>';
                        }
                    }else{
                        echo '<div class="alert alert-danger">Polje ime mora imati više od 2 slova!</div>';
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
                $update_kategorija = $konekcija->prepare('UPDATE ljubimci SET kategorija_id=? WHERE id=?');
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
                $update_dostupnost = $konekcija->prepare('UPDATE ljubimci SET dostupnost=? WHERE id=?');
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
        $query="SELECT ljubimci.*, kategorija.naziv_kategorija FROM ljubimci INNER JOIN kategorija ON ljubimci.kategorija_id = kategorija.kategorija_id WHERE ljubimci.id = $id";
        $redci = $konekcija->query($query);
        while ($row=$redci->fetch_assoc()){
        ?></br></br></br></br>
        <section class="uredivanje_bla">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method = "post" class="podaci_uredi" enctype = "multipart/form-data">
                <h4><i class="icon-edit"></i> UREDI PODATKE</h4>
                <input type="text" value="<?php echo $row['naziv'];?>" name="naziv" class="box">
                <input type="text" value="<?php echo $row['ime'];?>" name="ime" class="box">
                <input type="number" step="any" value="<?php echo $row['starost'];?>" name="starost" class="box">
                <input type="text" value="<?php echo $row['opis'];?>" name="opis" class="box">
                <input type="number" step="any" value="<?php echo $row['cijena'];?>" name="cijena" class="box">
                </br>
                <input type="submit" class="btn btn-success uredi" name="urediLjubimca" value="Uredi">
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

            <form action="<?php $_SERVER['PHP_SELF'] ?>" class="podaci_uredi" method = "post"  enctype = "multipart/form-data">
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
            
            <?php }; ?>
            </div>
        </section>
    </div>
</div><br></br><br></br><br></br>

<?php

    }else{
    echo '<div class="alert alert-danger">Nemate ovlasti za pristup!</div>';
    }
?>
<?php require_once("footer2.php"); ?>



