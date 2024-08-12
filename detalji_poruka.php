<?php
    $title = "Detalji razgovora - Pet Shop";
    require_once("head.php");
    require_once("baza.php");

    if(User()){
        echo"
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
            <link href='//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css' rel='stylesheet'>

            <div class='animate__animated animate__bounceInLeft bar2'>
                <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / </span> <a href='moje_poruke.php' class='bar'><i class='icon-inbox'></i> Moje poruke</a><span> / <i class='icon-comments'></i> Inbox</span></h2>
            <p>Napomena: ovaj razgovor se sastoji od jednog pitanja i jednog odgovora.</p>
        ";

    }elseif(Admin()){
        echo"
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
            <link href='//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css' rel='stylesheet'>

            <div class='animate__animated animate__bounceInLeft bar2'>
                <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / </span> <a href='sve_poruke.php' class='bar'><i class='icon-inbox'></i> Sve poruke</a><span> / <i class='icon-comments'></i> Inbox</span></h2>
            </div>

            <p>Napomena: ovaj razgovor se sastoji od jednog pitanja i jednog odgovora.</p>
        ";
    }

    $poruke_id = $_GET['detalji'];

    if(isset($_POST['uredi_btn'])){
        $odgovor = $_POST['odgovor'];
        $status_poruke = $_POST['status_poruke'];
        $odgovor_query = mysqli_query($konekcija, "UPDATE `poruke` SET odgovor = '$odgovor', status_poruke=1 WHERE poruke_id = '$poruke_id'");
    };


    if(isset($_GET['korisnik_id'])){
        $korisnik_id = $_POST['korisnik_id'];
        $korisnik = $_POST['korisnik'];
        $pitanje = $_POST['pitanje'];
        $vrsta = $_POST['vrsta'];
        $odgovor = $_POST['odgovor'];

        $select = "SELECT * FROM poruke WHERE poruke_id = $poruke_id";
        $prikazi = mysqli_query($konekcija, $select);
    }

    $query = "SELECT*FROM poruke WHERE poruke_id = $poruke_id";
    $redci = $konekcija->query($query);

    if(mysqli_num_rows($redci) > 0){
        if(Admin()){
            while($row=$redci->fetch_assoc()){
                $korisnik = strval($row['korisnik']);

                echo "
                    </br><div class='container'>
                ";
                    echo "<p class='korisnik_poruke'>" . $korisnik . "</p>";
                    echo"<div class='poruka_korisnik'>"
                            .$row['pitanje'].
                        "</div>";   
                    echo "<p class='admin_poruke'>Administrator</p>";  
                    echo"<div class='poruka_admin'>"
                            .$row['odgovor'].
                        "</div>";
                    if($row['status_poruke'] == 2){
                        echo '<p style="margin-left: 50%;"><i class="icon-ok"></i> Pročitano</p>';
                    };
                    ?>

                    <br></br>

                <form action="<?php $_SERVER['PHP_SELF'] ?>" method = "post" enctype = "multipart/form-data">
                    <input type="text" hidden name="status_poruke">
                    <input type="text" placeholder="Odgovori ili promijeni odgovor..." name="odgovor" class="odgovor">
                    <button type="submit" class="btn" name="uredi_btn"><i class="icon-location-arrow"></i></button>
                    </br></br></br>
                </form>

                <?php 
                    echo "
                        </div>
                        <a class='btn btn-danger px-3 me-2' href='sve_poruke.php' ><i class='icon-arrow-left'></i> Povratak </a>
                    ";
            }
        }elseif(isset($_SESSION['korisnik_id'])){
            $korisnik = $_SESSION['korisnik'];
            $korisnik_id = $_SESSION['korisnik_id'];

            while($row=$redci->fetch_assoc()){
                $korisnik = strval($row['korisnik']);

                echo "
                    </br><div class='container'>
                ";
                        echo "<p class='korisnik_poruke2'>" . $korisnik . "</p>";
                        echo "<div class='poruka_korisnik2'>"
                                .$row['pitanje'].
                            "</div>";   
                        echo "<p class='admin_poruke2'>Administrator</p>"; 
                        echo"<div class='poruka_admin2'>"
                                .$row['odgovor'].
                            "</div>";
                        if($row['status_poruke'] == 2){
                            echo '<p style="margin-left: 10%;"><i class="icon-ok"></i> Pročitali ste</p>';
                        }
                        ?>
                        
                <?php 
                    echo "
                        </div>
                        <a class='btn btn-danger px-3 me-2' href='moje_poruke.php' ><i class='icon-arrow-left'></i> Povratak </a>
                    ";
            }
        }else{
            echo '<div class="alert alert-danger animate__animated animate__backInLeft">Nemate pristup ovoj stranici!</div>';
        }
    }else{
        echo '<div class="alert alert-danger animate__animated animate__backInLeft">Ne postoji upit sa tim ID-em!</div>';
    }

    echo"</div>";
    require_once ("footer2.php");

?>