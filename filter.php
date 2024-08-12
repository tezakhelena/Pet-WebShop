<?php
	require('baza.php');
	if(ISSET($_POST['filter'])){
		$kategorija_id=$_POST['kategorija_id'];
		
		$query=mysqli_query($konekcija, "SELECT oprema.*, kategorija.naziv_kategorija FROM oprema INNER JOIN kategorija ON oprema.kategorija_id = kategorija.kategorija_id WHERE kategorija.kategorija_id='$kategorija_id'") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
			echo"<tr><td>".$fetch['naziv']."</td><td>".$fetch['naziv_kategorija']."</td></tr>";
		}
	}else if(ISSET($_POST['reset'])){
		$query=mysqli_query($konekcija, "SELECT oprema.*, kategorija.naziv_kategorija FROM oprema INNER JOIN kategorija ON oprema.kategorija_id = kategorija.kategorija_id") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
			echo"<tr><td>".$fetch['naziv']."</td><td>".$fetch['naziv_kategorija']."</td></tr>";
		}
	}else{
		$query=mysqli_query($konekcija, "SELECT oprema.*, kategorija.naziv_kategorija FROM oprema INNER JOIN kategorija ON oprema.kategorija_id = kategorija.kategorija_id") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
			echo"<tr><td>".$fetch['naziv']."</td><td>".$fetch['naziv_kategorija']."</td></tr>";
		}
	}
?>