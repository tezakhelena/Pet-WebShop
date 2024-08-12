<?php
    $title = "Detalji upit - Pet Shop";
    require_once("head.php");
    require_once("baza.php");

    echo"
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
        <link href='//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css' rel='stylesheet'>
        <div class='animate__animated animate__bounceInLeft bar2'>
            <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / </span> <a href='svi_upiti.php' class='bar'><i class='icon-user'></i> Upiti</a><span> / Detalji</span></h2>  
    ";

    $id = $_GET['detalji'];


    if(isset($_GET['korisnik_id'])){
        $korisnik_id = $_POST['korisnik_id'];
        $korisnik = $_POST['korisnik'];
        $pitanje = $_POST['pitanje'];
        $odgovor = $_POST['odgovor'];

        $select = "SELECT * FROM upiti WHERE id = $id";
        $prikazi = mysqli_query($konekcija, $select);    
    }

    $query = "SELECT*FROM upiti WHERE id = $id";
    $redci = $konekcija->query($query);

    if(mysqli_num_rows($redci) > 0){
        if(Admin()){
            while($row=$redci->fetch_assoc()){
                $korisnik = strval($row['korisnik']);

                echo "</br><div class='container'>
                    <table class='table table-bordered'>
                        <tr>
                            <td><b>Korisnik:</b></td>
                            <td>" .$korisnik. "</td>
                        </tr>
                        <tr>
                            <td><b>Pitanje:</b></td>
                            <td>" .$row['pitanje']. "</td>
                        </tr>
                        <tr>
                            <td><b>Odgovor:</b></td>
                            <td>" .$row['odgovor']. "<a href='uredi_upit.php?edit=$row[id]' class='btn-edit-upiti'><i class='icon-edit'></i></a></td>
                        </tr>
                    </table>";?>
                <?php 
                    echo "
                        </div>
                        <a class='btn btn-danger px-3 me-2' href='svi_upiti.php' ><i class='icon-arrow-left'></i> Povratak </a>
                    ";
            }
        }else{
            echo '<div class="alert alert-danger animate__animated animate__backInLeft">Nemate pristup ovoj stranici!</div>
            <a class="btn btn-danger px-3 me-2" href="svi_upiti.php" ><i class="icon-arrow-left"></i> Povratak </a>
            ';
        }
    }else{
        echo '<div class="alert alert-danger animate__animated animate__backInLeft">Ne postoji upit sa tim ID-em!</div>';
    }

    echo"</div>";
    require_once ("footer2.php");

?>