<?php
    $title = "Uređivanje statusa - Pet Shop"; require_once("head.php"); require_once("baza.php"); require_once("PFBC/Form.php");

    echo "<script>
    document.getElementById('narudzbe').classList.add('active');
    </script><link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>";

    $id = $_GET['edit'];

    if(Admin()){

        echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
        <div class='animate__animated animate__bounceInLeft bar2'>
            <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / </span> <a href='sve_narudzbe.php' class='bar'>Narudžbe</a><span> / Uređivanje statusa narudžbe</span></h2>
            <br>
            <a class='btn btn-danger px-3 me-2' href='sve_narudzbe.php' ><i class='icon-arrow-left'></i> Povratak </a>
        ";
        
        if(isset($_POST['urediStatus'])){
            $status = $_POST['status'];

            if($status == 6){
                echo '<div class="alert alert-danger">Molimo odaberite status</div>';
            } else{
                $update = $konekcija->prepare('UPDATE narudzba SET status=? WHERE narudzba_id=?');
                $update -> bind_param('sd', $status, $id);

                if($update->execute()){
                    echo '<div class="alert alert-success animate__animated animate__backInLeft">Podaci o dostavi su uspješno uređeni!</div>';
                } else{
                    echo '<div class="alert alert-danger animate__animated animate__backInLeft">Neuspješno dodavanje u bazu!</div>';
                }
            }
        }
        echo"</div>";
    
?>


<div class="container">
        <div class="form_uredi">

        <?php
        $query="SELECT*FROM narudzba WHERE narudzba_id = $id";
        $redci = $konekcija->query($query);
        while ($row=$redci->fetch_assoc()){
        ?></br></br></br></br>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method = "post" enctype = "multipart/form-data">
                <p>Promijeni status narudžbe: </p>
                </br>
                <select name="status">
                    <option value="<?php echo $row['status'] ?>">
                    <?php
                    if($row['status'] == 0){
                        echo '<p>Narudžba primljena</p>';
                    }elseif($row['status'] == 1){
                        echo '<p>Narudžba u pripremi</p>';                    
                    }elseif($row['status'] == 2){
                        echo '<p>Narudžba isporučena</p>';                    
                    }elseif($row['status'] == 5){
                        echo '<p>Narudžba pogledana</p>';                    
                    }else{
                        echo '<p>Narudžba otkazana</p>';                    
                    }
                    ?>
                    </option>
                    <option value="6">Odaberi status</option>
                    <option value="5">Pošiljka pogledana</option>
                    <option value="0">Pošiljka zaprimljena</option>
                    <option value="1">Pošiljka u pripremi</option>
                    <option value="2">Pošiljka isporučena</option>
                    <option value="3">Pošiljka otkazana</option>
                </select><br></br>
                <input type="submit" class="btn btn-success uredi" name="urediStatus" value="Uredi">
                <?php
                echo"<a href='detalji_narudzba.php?detalji=$row[narudzba_id]' class='btn btn-danger'><i class='icon-arrow-left'></i>Natrag</a>" ?>
            </form>
            
            <?php };?>
        </div>
</div>

<?php

        }
        ?>