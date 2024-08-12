<?php
$title = "Lista želja - Pet Shop";
require_once("head.php"); 
require_once("baza.php");

echo "
<script type='text/javascript'>
document.getElementById('wishlist').classList.add('active');
</script>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
<div class='animate__animated animate__bounceInLeft bar2'>
  <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / <i class='icon-heart'></i> Popis želja</span></h2>
  <br>
  <a class='btn btn-danger px-3 me-2' href='index.php' ><i class='icon-arrow-left'></i> Povratak </a>
</div><br></br>";

if(isset($_GET['obrisi'])){
    $obrisi_id = $_GET['obrisi'];
    mysqli_query($konekcija, "DELETE FROM `wishlist` WHERE id = '$obrisi_id'");
};
 
if(isset($_GET['obrisi_sve'])){
   $korisnik = $_SESSION['korisnik'];
   $korisnik_id = $_SESSION['korisnik_id'];
   $query = $konekcija -> prepare('DELETE FROM wishlist WHERE korisnik_id=?');
   $query -> bind_param('s', $korisnik_id);
   if($query->execute()){
      echo"<h4 class='animate__animated animate__backInLeft'></h4>";
   }
}

if(isset($_SESSION['korisnik_id'])){
  $korisnik_id = $_SESSION['korisnik_id'];

 
 ?>

 
 <?php

$wishlist = mysqli_query($konekcija, "SELECT * FROM `wishlist` WHERE korisnik_id='$korisnik_id'");
if(mysqli_num_rows($wishlist) > 0){?>
      <a href="wishlist.php?obrisi_sve" onclick="return confirm('Jeste li sigurni da želite isprazniti košaricu?');" class="btn-delete"> <i class="icon-trash"></i> Isprazni popis želja</a><br></br>

 <div class="container">
 
 <section class="shopping-cart">
    <table class="table table-bordered" id="example">
       <thead>
         <tr>
            <th>Slika proizvoda </th>
            <th> Naziv proizvoda </th>
            <th>Cijena proizvoda </th>
            <th>Akcija </th>
         </tr>
       </thead>
 
      <tbody>
 
          <?php 
          
             while($fetch_cart = mysqli_fetch_assoc($wishlist)){
          ?>
 
                 <tr>
                    <th><img src="sve_slike/<?php echo $fetch_cart['slika']; ?>" width="200" alt=""></th>
                    <th><?php echo $fetch_cart['naziv']; ?></th>
                    <th><?php echo $fetch_cart['cijena']; ?> kn</th>
                    <th><a href="wishlist.php?obrisi=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('Jeste li sigurni da želite maknuti proizvod iz Vašeg popisa želja?')"> <i class="icon-trash"></i> </a></th>
                 </tr>
                
          <?php
             };
             ?>

             </tbody>
             </table>
          </section>
          
          </div> 
          <?php
          }else{
           echo '<div class="alert alert-warning animate__animated animate__backInLeft">Nemate ni jedan proizvod u popisu želja!</div>';

          }
          ?>

 </body>
 </html>
 <?php
}else{
  echo '<div class="alert alert-warning animate__animated animate__backInLeft">Prijavite se da bi mogli koristiti Vaš popis želja!</div>';
}
$konekcija->close();
//paginacija

require_once ("footer2.php");
?>

<script>
            $(document).ready(function () {
                $('#example').DataTable({
                    "lengthMenu": [ 5,10, 25, 50, 75, 100 ],
                    "pagingType": "full_numbers",
                    "language": {
                        "emptyTable": "Nema narudžba u tablici",
                        "zeroRecords": "Nema pronađenih narudžba",
                        "info": "Prikazuje se _START_ do _END_ od _TOTAL_ narudžba",
                        "infoEmpty": "Prikazuje se 0 do 0 od 0 zapisa",
                        "lengthMenu": "Prikaži: _MENU_ zapisa po stranici",
                        "infoFiltered":   "(Filtrirano od _MAX_ totalnih zapisa)",
                        "search": "Pretražuj:",
                        "paginate": {
                            "next":       "Sljedeća",
                            "previous":   "Prethodna"
                        },
                    }
                });
            });
        </script>