<?php
    $title="Registracija - Pet Shop"; 
    require_once 'baza.php';  
    require_once 'navbar.php'; 
    require_once 'head.php';
    $user = "korisnik";
    $korisnik = "";
	$poruka = "";

	echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
    <div class='animate__animated animate__bounceInLeft bar2'>
        <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / </span> Registracija</h2>
    </div>";

	if (isset($_POST['register'])) {
		$korisnik = trim($_POST['korisnik']);
        $email = trim($_POST['email']);
        $telefon = trim($_POST['telefon']);
		$lozinka = trim($_POST['lozinka']);
		$c_lozinka = trim($_POST['c_lozinka']);

		$input_error = array();

		if (empty($korisnik)) {
			$input_error['korisnik'] = "Korisničko ime je obavezno";
		}else{
			$korisnik = trim($_POST['korisnik']);
		}

		if (empty($lozinka)) {
			$input_error['lozinka'] = "Lozinka je obavezna";
		}

        if (empty($email)) {
			$input_error['email'] = "Email je obavezan";
		}
		else{
			$email = trim($_POST['email']);
		}

        if (empty($telefon)) {
			$input_error['telefon'] = "Broj mobitela je obavezan";
		}else{
			$telefon= trim($_POST['telefon']);
		}

        if (empty($lozinka)) {
			$input_error['c_lozinka'] = "Molimo Vas da ponovno unesete lozinku";
		}

		if (!empty($lozinka)) {
			if ($c_lozinka!==$lozinka) {
				$input_error['notmatch']="Lozinke se ne podudaraju!";
			}
		}

		if (count($input_error)==0) {
			$check_email= mysqli_query($konekcija,"SELECT * FROM `korisnici` WHERE `email`='$email';");
			$check_mobitel= mysqli_query($konekcija,"SELECT * FROM `korisnici` WHERE `telefon`='$telefon';");
			if (mysqli_num_rows($check_email)==0) {
				$check_username= mysqli_query($konekcija,"SELECT * FROM `korisnici` WHERE `korisnik`='$korisnik';");
				if (mysqli_num_rows($check_username)==0) {
					if (mysqli_num_rows($check_mobitel)==0) {
						if (strlen($korisnik)>2){
							if (strlen($lozinka)>4) {
								if(strlen($telefon)==10 && preg_match ("/^[0-9.]*$/", $telefon)){
									$hash = password_hash($lozinka, PASSWORD_DEFAULT);
									$user_status = 0;
									$odobrenje = 1;
									$query = $konekcija->prepare('INSERT INTO korisnici(korisnik, email, telefon, lozinka, tip_korisnika, user_status, odobrenje) VALUES (?,?,?,?,?,?,?)');
									$query->bind_param('sssssss', $korisnik, $email, $telefon, $hash, $user, $user_status, $odobrenje);
									if ($query->execute()) {
										echo '<div class="alert alert-success">Uspješno ste se registrirali! Administrator će uskoro odobriti Vaš račun te ćete se moći prijaviti u sustav!</div>';
									}else{
										echo '<div class="alert alert-danger">Neuspješna registracija!</div>';
									}
								}else{
									echo '<div class="alert alert-danger">Unesite važeći broj mobitela!</div>';
								}
							}else{
								echo '<div class="alert alert-danger">Lozinka mora imati više od 4 slova!</div>';
							}
						}else{
							echo '<div class="alert alert-danger">Korisničko ime mora imati više od 4 slova!</div>';
						}
					}else{
						echo '<div class="alert alert-danger">Korisnik sa ovim brojem već postoji!</div>';
					}
				}else{
					echo '<div class="alert alert-danger">Korisnik već postoji u bazi podataka!</div>';
				}
			}else{
				echo '<div class="alert alert-danger">Email već postoji!</div>';
			}
			
		}
		
	}
	if(!(isset($_SESSION['korisnik_id']))){
?>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
  <body>
    <div class="form_registracija"><br>
        <div class="row animate__animated animate__pulse card1">
            <div class="col-md-8 offset-md-1 forma_registracije">
             	<form method="POST" enctype="multipart/form-data">
				    <input type="text" class="form-control2" value="<?= isset($korisnik)? $korisnik:''?>" name="korisnik" placeholder="Korisničko ime" />
                    <?= isset($input_error['korisnik'])? '<label class="text-danger">'.$input_error['korisnik'].'</label><br>':'';  ?>
				    <input type="email" class="form-control2" value="<?= isset($email)? $email:''?>" name="email" placeholder="Email"/>
                    <?= isset($input_error['email'])? '<label class="text-danger">'.$input_error['email'].'</label>':'';?>
                    <input type="number" class="form-control2" value="<?= isset($telefon)? $telefon:''?>" name="telefon" placeholder="Broj mobitela"/>
                    <?= isset($input_error['telefon'])? '<label class="text-danger">'.$input_error['telefon'].'</label>':'';?>
				    <input type="password" name="lozinka" class="form-control2" id="inputPassword3" placeholder="Lozinka">
                    <?= isset($input_error['lozinka'])? '<label class="text-danger">'.$input_error['lozinka'].'</label>':'';?> 
				    <input type="password" name="c_lozinka" class="form-control2" id="inputPassword3" placeholder="Potvrdite lozinku">
                    <?= isset($input_error['notmatch'])? '<label class="text-danger">'.$input_error['notmatch'].'</label>':'';?> 
					<div class="text-center">
				      <br><button type="submit" name="register" class="btn btn-primary registracija">Registrirajte se!</button>
				    </div>
					<br>
                    <p>Ako već imate račun, možete se <a href="login.php">prijaviti!</a></p>
					<img src="sve_slike/user_registration.png" style= "width: 500px;" class="animate__animated animate__pulse slika_register"  />
				</form>                
            
            </div>
        </div><br>
    </div>
  </body>

  <?php
	}else{
		echo '<div class="alert alert-warning">Već ste registrirani!</div>';
	}
	require_once ("footer2.php");
  ?>
</html>
