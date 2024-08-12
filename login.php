<?php       
    $title = "Prijava - Pet Shop";  require_once ("baza.php"); require_once ("head.php"); require_once ("PFBC/Form.php");
    echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>";

    echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <div class='animate__animated animate__bounceInLeft bar2'>
        <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a><span> / Logiranje</span></h2>
    </div>";

    if (isset($_POST['loginKorisnika'])){
        if(isset($_POST['korisnik'])) {
            $korisnik = stripslashes($_REQUEST['korisnik']);
            $korisnik = mysqli_real_escape_string($konekcija, $korisnik);
            $lozinka=$_POST["lozinka"];
        }

            $korisnik_id = session_id();

            $query = "SELECT * FROM korisnici WHERE BINARY korisnik=? LIMIT 1";
            $query = $konekcija -> prepare($query);
            $query -> bind_param('s', $korisnik);
            if ($query -> execute())
            {
                $procitano = $query->get_result();
                $rezultat = $procitano->fetch_assoc();
                if(empty($korisnik) && empty($lozinka)){
                    echo '<div class="alert alert-primary animate__animated animate__backInLeft">Ime i lozinka su obavezni!</div>';
                }elseif(empty($lozinka)){
                    echo '<div class="alert alert-danger animate__animated animate__backInLeft">Lozinka je obavezna!</div>';
                }elseif(empty($korisnik) ){
                    echo '<div class="alert alert-danger animate__animated animate__backInLeft">Ime je obavezno!</div>';
                }
                elseif(!$rezultat){
                    echo '<div class="alert alert-danger">Korisnik nije pronađen!</div>';
                }         
                else {
                    if(password_verify($lozinka, $rezultat['lozinka']))
                    {
                        if($rezultat['user_status'] == 0){
                            if($rezultat['odobrenje'] == 0){
                                $_SESSION['korisnik']=$korisnik;
                                $_SESSION['korisnik_id'] = $rezultat['korisnik_id'];
                                $_SESSION['telefon'] = $rezultat['telefon'];
                                $_SESSION['email'] = $rezultat['email'];
                                $_SESSION['tip_korisnika'] = $rezultat['tip_korisnika'];
                                $_SESSION['odobrenje'] = $rezultat['odobrenje'];
                                header ('Location: index.php');
                            } else{
                                echo '<div class="alert alert-warning animate__animated animate__backInLeft">Administrator još nije odobrio Vaš račun! Molimo Vas pričekajte još malo!</div>';
                            }
                        } else{
                            echo '<div class="alert alert-primary animate__animated animate__backInLeft"><i class="icon-lock"></i> Račun Vam je blokiran, ne možete se logirati!</div>';
                        }
                    }
                    else {
                        echo '<div class="alert alert-danger animate__animated animate__backInLeft">Pogrešna lozinka, pokušajte ponovno!</div>';
                    }
                }
            } else {
                echo '<div class="alert alert-danger animate__animated animate__backInLeft">Nemoguće učitavanje baze!</div>';
            }
            $konekcija->close();
        }

        if(!(isset($_SESSION['korisnik_id']))){
            echo'</br></br>   
            <link rel="stylesheet" href="../css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
                <div class="form_login animate__animated animate__pulse col-sm-8">';?>

                    <form action="" method="POST">
                        <div class="login_icon_user"><i class="icon-user"></i></div>
                        <input type="text" value="<?= isset($korisnik)? $korisnik:'' ?>" class="form-control" name="korisnik" placeholder="Korisničko ime...">
                        <div class="login_icon_user"><i class="icon-lock"></i></div>
                        <input type="password" value="<?= isset($lozinka)? $lozinka:'' ?>" class="form-control" name="lozinka" placeholder="Lozinka...">
                        <div>
                            <input type="submit" name="loginKorisnika" class="btn btn-success prijava_btn" value="Prijava"> 
                        </div>
                    </form>
                    <img src="sve_slike/login.png" style= "width: 500px;" class="animate__animated animate__pulse slika_login"  />
                <?php
                echo '</div>
            ';
    }else{
        echo '<div class="alert alert-warning">Već ste prijavljeni!</div>';
    }

    require_once ("footer2.php");

?> 