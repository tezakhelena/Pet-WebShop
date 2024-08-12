<?php
   $title = "Izvršavanje narudžbe - Pet Shop"; 
   require_once("head.php"); 
   require_once("baza.php"); 

   echo"
      <link rel='stylesheet' href='css/style.css'>
      <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
      <div class='animate__animated animate__bounceInLeft bar2'>
         <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a><span> / <a href='kosarica1.php' class='bar'><i class='icon-shopping-cart'></i> Košarica</a> <span> / </span> Postupak naručivanja</span></h2>
         <br>
         <a class='btn btn-danger px-3 me-2' href='kosarica1.php' ><i class='icon-arrow-left'></i> Povratak </a>
         <br></br>
   ";

   if(isset($_SESSION['korisnik_id'])){
      $korisnik = $_SESSION['korisnik'];
      $korisnik_id = $_SESSION['korisnik_id'];
      $telefon = $_SESSION['telefon'];
      $email = $_SESSION['email'];

      if(isset($_POST['naruci_btn'])){
         $primatelj = $_POST['primatelj'];
         $ulica = trim($_POST['ulica']);
         $grad = trim($_POST['grad']);
         $postanski_broj = trim($_POST['postanski_broj']);
         $placanje_id = $_POST['placanje_id'];
         

         $input_error = array();

         if (empty($primatelj)) {
            $input_error['primatelj'] = "Unesite primatelja!";
         }else{
            $primatelj = $_POST['primatelj'];
         }
         if (empty($ulica)) {
            $input_error['ulica'] = "Ulica je obavezna";
         }else{
            $ulica = $_POST['ulica'];
         }
         if (empty($grad)) {
            $input_error['grad'] = "Grad je obavezan";
         }else{
            $grad = $_POST['grad'];
         }
         if (empty($postanski_broj)) {
            $input_error['postanski_broj'] = "Poštanski broj je obavezan";
         }else{
            $postanski_broj = $_POST['postanski_broj'];
         }

         if ($_REQUEST['placanje_id'] == 9)
         {
           $input_error['placanje_id'] = 'Odabir plaćanja je obavezan';
         }

         $kosarica_query = mysqli_query($konekcija, "SELECT * FROM `kosarica` WHERE korisnik_id='$korisnik_id'");
         $totalna_cijena = 0;

         if(mysqli_num_rows($kosarica_query) > 0){
            while($product_item = mysqli_fetch_assoc($kosarica_query)){
               $naziv[] = $product_item['naziv'] .' ('. $product_item['kolicina'] .') ';
               $cijena = $product_item['cijena'] * $product_item['kolicina'];
               $totalna_cijena += $cijena;
            };

            $proizvod = implode(', ',$naziv);

            if(count($input_error)==0){
               if($placanje_id != 9){
                  if(strlen($postanski_broj) == 5){
                     $status = 5;
                     $ukupna_cijena = $totalna_cijena;
                     $query = $konekcija->prepare('INSERT INTO narudzba(korisnik, primatelj, telefon, email, ulica, grad, postanski_broj, proizvod,totalna_cijena, korisnik_id, status, placanje_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)');
                     $query->bind_param('ssssssssssss', $korisnik, $primatelj, $telefon, $email, $ulica, $grad, $postanski_broj, $proizvod, $ukupna_cijena, $korisnik_id, $status, $placanje_id);
                     if ($query->execute()) {
                        $delete_cart = $konekcija->prepare("DELETE FROM `kosarica` WHERE korisnik_id = ?");
                        $delete_cart->execute([$korisnik_id]);
                           echo"
                              <div class='card-body'>
                              <div class='message-container'>
                                 <div class='alert alert-success animate__animated animate__backInLeft'>Zahvaljujemo na kupnji!</div>
                                    <div class='order-detail'>
                                       <h4><b>".$proizvod."</b></h4>
                                       <span style='color: green'> <b>Ukupno: </b>". $totalna_cijena ." kn  </span>
                                    </div>
                                    
                                    <div class='customer-details'>
                                       <p><b> Naručitelj : </b><span>".$korisnik."</span> </p>
                                       <p><b> Primatelj: : </b><span>".$primatelj."</span> </p>
                                       <p><b> Adresa primatelja: </b><span>".$ulica.", ".$grad.", ".$postanski_broj."</span> </p>
                                       <p><b> Telefon : </b><span>".$telefon."</span> </p>
                                       <p><b> Email : </b><span>".$email."</span> </p>
                                       <p><b> Način plaćanja : </b><span>".$placanje_id."</span> </p>
                                       <p>Račun možete preuzeti pod <a href='moje_narudzbe.php'>'Moje narudžbe'</a></p>
                                       <p><b>(*Plaća se kada pošiljka stigne*)</b></p>
                                    </div>

                                    <a href='index.php' class='btn btn-edit'><i class='icon-arrow-left'></i> Na početak</a>
                                 </div>
                              </div>
                           "; 
                     }else{
                        echo '<div class="alert alert-danger">Neuspješna kupnja!</div>';
                     }
                  }else{
                     echo '<div class="alert alert-danger">Poštanski broj mora imati 5 brojeva!</div>';
                  }
               }else{
                  echo '<div class="alert alert-danger">Odaberite vrstu plaćanja!</div>';
               }
            }
         }else{
            echo '<div class="alert alert-danger animate__animated animate__backInLeft">Nemate ništa za naručiti!</div>';  
         }
         

      }

   ?>


         <?php
            $select_kosarica = mysqli_query($konekcija, "SELECT * FROM `kosarica` WHERE korisnik_id='$korisnik_id' AND korisnik='$korisnik'");
            $total = 0;
            $totalni_iznos = 0;
            if(mysqli_num_rows($select_kosarica) > 0){?>
               <div class="container_narudzba">

               <div class="display-order">
               <table class="table tablica-narudzba">
                  <th>Vaša narudžba:</th>
                  <?php
                     while($fetch_cart = mysqli_fetch_assoc($select_kosarica)){
                        $total_price = $fetch_cart['cijena'] * $fetch_cart['kolicina'];
                        $totalni_iznos = $total += $total_price;
                  ?>
                  <tr>
                     <td style="text-align: left"><b>
                        <img src="sve_slike/<?php echo $fetch_cart['slika']; ?>" width="70">
                        <?= $fetch_cart['naziv']; ?> (<?= $fetch_cart['kolicina']; ?>) </b> - <?= $fetch_cart['cijena']; ?> kn
                     </td>
                  </tr>
               <?php
                     }
               ?>
                  <tr style="text-align: left">
                     <td>
                        Totalni iznos : <b><?= $totalni_iznos ; ?> kn / <?=  round($totalni_iznos / 7.5, 2) ?> €</b>
                     </td>
                  </tr>
               <?php
            }
            ?>
         </table>
      </div>

   <section class="checkout-form">
      <?php
      if(mysqli_num_rows($select_kosarica) > 0){?>

         <form action="" method="post">
            <div class="flex">
               <div class="inputBox">
                  <input type="text" value="<?= isset($primatelj)? $primatelj:'' ?>" placeholder="Unesite primatelja" name="primatelj">
                  <?= isset($input_error['primatelj'])? '<label class="text-danger">'.$input_error['primatelj'].'</label><br>':'';  ?>
               </div>

               <div class="inputBox">
                  <select name="placanje_id">
                     <option value="9">Način plaćanja</option>
                     <?php
                        $query='SELECT * FROM placanje_podaci';
                        $redci = mysqli_query($konekcija, $query);
                        while ($row=$redci->fetch_assoc()){
                           echo"<option value=" . $row['placanje_id'] . ">" . $row['vrsta'] . "</option>";
                        }
                     ?>
                  </select>
                  <?= isset($input_error['placanje_id'])? '<label class="text-danger">'.$input_error['placanje_id'].'</label><br>':'';  ?>
               </div>

               <div class="inputBox">
                  <input type="text" value="<?= isset($ulica)? $ulica:'' ?>" placeholder="Unesite ulicu primatelja" name="ulica">
                  <?= isset($input_error['ulica'])? '<label class="text-danger">'.$input_error['ulica'].'</label><br>':'';  ?>
               </div>
               <div class="inputBox">
                  <input type="text" value="<?= isset($grad)? $grad:'' ?>" placeholder="Unesite grad primatelja" name="grad">
                  <?= isset($input_error['grad'])? '<label class="text-danger">'.$input_error['grad'].'</label><br>':'';  ?>
               </div>
               <div class="inputBox">
                  <input type="number" value="<?= isset($postanski_broj)? $postanski_broj:'' ?>" placeholder="Unesite poštanski broj" name="postanski broj">
                  <?= isset($input_error['postanski_broj'])? '<label class="text-danger">'.$input_error['postanski_broj'].'</label><br>':'';  ?>
               </div>
            </div>
            <input type="submit" value="Naruči" name="naruci_btn" class="btn btn-narudzba"></input>
         </form>

      <?php
      }
      ?>
   </section>

   </div>
      <?php }else{
      echo '<div class="alert alert-danger animate__animated animate__backInLeft">Nemate pristup ovoj stranici!</div>';  
   }

   echo"</div>";

require_once ("footer2.php");
   ?>