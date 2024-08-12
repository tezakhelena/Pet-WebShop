<?php
    $title = "Uređivanje fotografije opreme - Pet Shop"; 
    require_once("head.php"); 
    require_once("baza.php");

    echo "<script>
    document.getElementById('hrana').classList.add('active');
    document.getElementById('dodajHranu').classList.add('active');
    </script>";

    echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
    <div class='animate__animated animate__bounceInLeft bar2'>
        <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / </span> <a href='oprema.php' class='bar'> Oprema</a><span> / <i class='icon-picture'></i> Mjenjanje fotografije</span></h2>
        <br>
        <a class='btn btn-danger px-3 me-2' href='oprema.php' ><i class='icon-arrow-left'></i> Povratak </a>
        <br></br>
    ";

    $id = $_GET['edit'];
    
    if(isset($_POST['urediOpremu'])){
        $slika = $_FILES['slika']['name'];
        $slika_tmp_name = $_FILES['slika']['tmp_name'];
        $slika_folder = 'sve_slike/'.$slika;

        $dozvoljeni_MIME = array("image/png", "image/jpeg", "image/jpg", "image/bmp", "image/gif");

        if(empty($slika)){
            echo '<div class="alert alert-danger animate__animated animate__backInLeft">Molimo odaberite novu sliku proizvoda</div>';
        }elseif(!empty($_FILES['slika']['type'])&&!in_array($_FILES['slika']['type'], $dozvoljeni_MIME)){
            echo '<div class="alert alert-danger animate__animated animate__backInLeft">
                Neispravan tip datoteke!
                Prihvaća se:
                <li>PNG</li>
                <li>JPEG</li>
                <li>JPG</li>
                <li>BMP</li>
                <li>GIF</li>
            </div>';
        } else{
            $update = "UPDATE oprema SET slika='$slika' WHERE id = $id";
            $upload = mysqli_query($konekcija, $update);
            if($upload){
                move_uploaded_file($slika_tmp_name, $slika_folder);
                echo '<div class="alert alert-success animate__animated animate__backInLeft">Proizvod je uspješno uređen!</div>';
            } else{
                echo '<div class="alert alert-danger animate__animated animate__backInLeft">Neuspješno dodavanje u bazu!</div>';
            }
        }
    }

?>

<div class="container">
        <div class="proizvod_uredi">

        <?php
        $query="SELECT*FROM oprema WHERE id = $id";
        $redci = $konekcija->query($query);
        while ($row=$redci->fetch_assoc()){
        ?>
        <h2 class="trenutna_foto">Trenutna fotografija: </h2></br>
        
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method = "post" enctype = "multipart/form-data" class="form_uredi">
                <input type="file" value="<?php echo $row['slika'];?>" accept="image/png, image/jpeg, image/jpg, image/bmp, image/gif" name="slika" class="box">
                </br>
                <input type="submit" class="btn btn-success uredi_slikugumb" name="urediOpremu" value="Spremi promjene">
                <?php
            echo "<img class='uredi_sliku' src='sve_slike/" . $row['slika'] . "' style='width: 500px;'/></br></br></br>"
            ?>
            </form>
            <?php }; ?>
        </div>
</div>
</div>

<?php require_once("footer2.php"); ?>



