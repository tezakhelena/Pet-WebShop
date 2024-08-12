<?php 
    $title="Uredi podatke o dostavi - Pet Shop"; 
    require_once("head.php"); 
    require_once("baza.php");
            
    echo "<script>
    document.getElementById('oprema').classList.add('active');
    document.getElementById('dodajOpremu').classList.add('active');
    </script><link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>";

    echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
    <div class='animate__animated animate__bounceInLeft bar2'>
        <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / </span> <a href='dostava.php' class='bar'> Dostava</a> <span> / </span> <a href='raspored_dostave_na_otoke.php' class='bar'> Dostava na otoke</a><span> / Uređivanje podataka o dostavi na otoke</span></h2>
        <br>
        <a class='btn btn-danger px-3 me-2' href='raspored_dostave_na_otoke.php' ><i class='icon-arrow-left'></i> Povratak </a>
        <br></br>
    ";


    $raspored_id = $_GET['edit'];

    if(Admin()){
        if(isset($_POST['urediPodatak'])){
            $otoci = trim($_POST['otoci']);

            if(empty($otoci)){
                echo '<div class="alert alert-danger">Molimo ispunite sva polja</div>';
            } else{
                $update = $konekcija->prepare('UPDATE raspored_otoci SET otoci=? WHERE raspored_id=?');
                $update -> bind_param('sd', $otoci, $raspored_id);
                if($update->execute()){
                    echo '<div class="alert alert-success animate__animated animate__backInLeft">Podatak je uspješno uređen!</div>';
                } else {
                    echo '<div class="alert alert-danger animate__animated animate__backInLeft">Neuspješno uređivanje!</div>';
                }
            }
        }
?>

<div class="form_uredi">
    <div class="admin-product-form-container centered">

    <?php
        $query="SELECT*FROM raspored_otoci WHERE raspored_id = $raspored_id";
        $redci = $konekcija->query($query);
        while ($row=$redci->fetch_assoc()){
    ?></br></br></br></br>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h3><i class="icon-edit"></i> Promjeni otoke</h3>
                <input type="text" disabled value="<?php echo $row['dan'];?> "  name="dan" class="box">
                <input type="text" value="<?php echo $row['otoci']; ?>" name="otoci" class="box" >
                </br>
                <input type="submit" class="btn btn-success uredi" name="urediPodatak" value="Uredi">
        </form>
                <?php }; ?>
    </div>
</div>

<?php
echo"</div>";
    }else{
        echo '<div class="alert alert-danger animate__animated animate__backInLeft">Nemate ovlasti za pristup!</div>';
    }
?>

<?php require_once("footer2.php"); ?>