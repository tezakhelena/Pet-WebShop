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
        <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / </span> <a href=kategorija.php class='bar'> Kategorije</a><span> / Uređivanje podataka</span></h2>
        <br>
        <a class='btn btn-danger px-3 me-2' href='kategorija.php' ><i class='icon-arrow-left'></i> Povratak </a>
        <br></br>
    ";

    $kategorija_id = $_GET['edit'];

    if(Admin()){
        if(isset($_POST['urediHranu'])){
            $naziv_kategorija = trim($_POST['naziv_kategorija']);

            if(empty($naziv_kategorija)){
                echo '<div class="alert alert-danger">Molimo da unesete drugi naziv kategorije</div>';
            } else{
                if(strlen($naziv_kategorija)>1){
                    $update = $konekcija->prepare('UPDATE kategorija SET naziv_kategorija=? WHERE kategorija_id=?');
                    $update -> bind_param('sd', $naziv_kategorija, $kategorija_id);

                    if($update->execute()){
                        echo '<div class="alert alert-success animate__animated animate__backInLeft">Proizvod je uspješno preuređen!</div>';
                    } else{
                        echo '<div class="alert alert-danger">Neuspješno preuređivanje!</div>';
                    }
                }else{
                    echo '<div class="alert alert-danger">Polje naziv mora imati više od 1 slova!</div>';   
                }
            }
        }
        echo"</div>";
?>

<div class="form_uredi">
        <div class="animate__animated animate__pulse">
        
        <?php
        $query = "SELECT * FROM kategorija WHERE kategorija_id=$kategorija_id";
        $redci = $konekcija->query($query);
        while ($row=$redci->fetch_assoc()){
        ?></br></br></br></br></br>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method = "post" enctype = "multipart/form-data">
                <h3><i class="icon-edit"></i> Uredi kategoriju</h3>
                <input type="text" value="<?php echo $row['naziv_kategorija']; ?>" name="naziv_kategorija" class="box">
                </br>
                <input type="submit" class="btn btn-success uredi" name="urediHranu" value="Uredi">
            </form><br></br>
            <?php
            }; ?>
            </div>
        </div>
</div><br></br>

<?php
    }else{
        echo '<div class="alert alert-danger animate__animated animate__backInLeft">Nemate ovlasti za pristup!</div>';
    }
    require_once("footer2.php");
?>


