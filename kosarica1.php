<?php $title = "Košarica - Pet Shop"; 
    require_once("head.php"); 
    require_once("baza.php");
    echo "
    <script type='text/javascript'>
    document.getElementById('kosarica').classList.add('active');
    </script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
    <div class='animate__animated animate__bounceInLeft bar2'>
      <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / <i class='icon-shopping-cart'></i> Košarica</span></h2>
      <br>
      <a class='btn btn-danger px-3 me-2' href='index.php' ><i class='icon-arrow-left'></i> Povratak </a>
   <br></br>";
    //ispisujemo sve sto je u bazi u tablici kosarica


    if(isset($_POST['uredi_btn'])){
        $update_value = $_POST['update_kolicina'];
        $update_id = $_POST['update_kolicina_id'];
        $update_kolicina_query = mysqli_query($konekcija, "UPDATE `kosarica` SET kolicina = '$update_value' WHERE id = '$update_id'");
    };
     
    if(isset($_GET['obrisi'])){
        $obrisi_id = $_GET['obrisi'];

        $query = $konekcija -> prepare('DELETE FROM kosarica WHERE id=?');
        $query -> bind_param('s', $obrisi_id);
    
        if($query->execute()){
         echo"<h4>Proizvod maknut iz košarice!</h4>";
        } else{
            echo '<div class="alert alert-danger">Proizvod neuspješno izbrisan!</div>';
        }
    };
     
    if(isset($_GET['obrisi_sve'])){
      $korisnik = $_SESSION['korisnik'];
      $korisnik_id = $_SESSION['korisnik_id'];
      $query = $konekcija -> prepare('DELETE FROM kosarica WHERE korisnik_id=?');
      $query -> bind_param('s', $korisnik_id);
      if($query->execute()){
         echo"<h4>Uspješno ste ispraznili košaricu!</h4>";
      }
    }

    if(isset($_SESSION['korisnik_id'])){
      $korisnik_id = $_SESSION['korisnik_id'];

     
     ?>
    
     
     
     <div class="container">
     
     <section class="shopping-cart">
        <table style="width: 90%;">
           <thead>
              <th> </th>
              <th> </th>
              <th> </th>
              <th> </th>
              <th> </th>
              <th> </th>
           </thead>
     
           <tbody>
     
              <?php 
              
              $kosarica = mysqli_query($konekcija, "SELECT * FROM `kosarica` WHERE korisnik_id='$korisnik_id'");
              $ukupno = 0;
              if(mysqli_num_rows($kosarica) > 0){?>
                  <a href="kosarica1.php?obrisi_sve" onclick="return confirm('Jeste li sigurni da želite isprazniti košaricu?');" class="btn-delete"> <i class="icon-trash"></i> Isprazni</a>
<?php
                 while($fetch_cart = mysqli_fetch_assoc($kosarica)){
              ?>
     
                     <tr>
                        <td><img src="sve_slike/<?php echo $fetch_cart['slika']; ?>" width="200" alt=""></td>
                        <td><?php echo $fetch_cart['naziv']; ?></td>
                        <td><?php echo $fetch_cart['cijena']; ?> kn</td>
                        <td>
                           <form action="" method="post">
                              <input type="hidden" name="update_kolicina_id"  value="<?php echo $fetch_cart['id']; ?>" >
                              <input type="number" name="update_kolicina" min="1"  value="<?php echo $fetch_cart['kolicina']; ?>" >
                              <input type="submit" value="Update" class='update_narudzba_btn' name="uredi_btn">
                           </form>   
                        </td>
                        <td><?php echo $total = $fetch_cart['cijena'] * $fetch_cart['kolicina']; ?> kn</td>
                        <td><a href="kosarica1.php?obrisi=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('Jeste li sigurni da želite maknuti proizvod iz košarice?')" class="btn-delete"> <i class="icon-trash"></i> Obriši</a></td>

                     </tr>
              <?php
                $ukupno += $total;  
                 };
                 ?>
                  <tr class="table-bottom">
                     <td colspan="4"><b>Totalni iznos:</b></td>
                     <td><b><?php echo $ukupno; ?> kn / <?=  round($ukupno  / 7.5, 2) ?> €</b></td>
                  </tr>
                 <?php
              }else{
               echo '<div class="alert alert-warning animate__animated animate__backInLeft">Nemate ni jedan proizvod u košarici!</div>';

              }
              ?>
              
              <td><a href="index.php" class="btn btn-primary nastavi_kupovati"><i class="icon-arrow-left"></i> Nastavi kupovati</a></td>
           </tbody>
     
        </table>
     
        <div class="checkout-btn">
           <a href="narudzba.php" class="btn <?= ($ukupno > 1)?'':'disabled'; ?>">Narudžba <i class="icon-arrow-right"></i></a>
        </div>
     
     </section>
     
     </div>
        
     <!-- custom js file link  -->
     <script src="js/script.js"></script>
     
     </body>
     </html>
     <?php
    }else{
      echo '<div class="alert alert-warning animate__animated animate__backInLeft">Prijavite se da bi mogli u košaricu!</div>';
    }
    $konekcija->close();
    //paginacija

    echo"</div>";
    
    require_once ("footer2.php");
?>