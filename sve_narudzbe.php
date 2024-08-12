<?php $title = "Narudžbe - Pet Shop"; 
    require_once("head.php"); 
    require_once("baza.php");

    if(Admin()){
        ?>
        <head>
            <meta charset="UTF-8" />
            <link href='//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css' rel='stylesheet'>
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
            <script data-require="jquery@*" data-semver="3.0.0" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.js"></script>
            <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" />
            <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
            <div class='animate__animated animate__bounceInLeft bar2'>
                <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / <i class='icon-shopping-cart'></i> Narudžbe</span></h2>
                <br></br>
                <a class='btn btn-danger px-3 me-2' href='index.php' ><i class='icon-arrow-left'></i> Povratak </a>
                <br></br>
            
                <a class=' btn btn-info' href='pdf_narudzbe3.php'><i class='icon-print'></i> <b> Kreiraj PDF</b></a><br></br>
        </head>

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
        <?php
    

    $query='SELECT * FROM narudzba ORDER BY datum_narudzbe DESC';
    $redci = mysqli_query($konekcija, $query);

    if(isset($_GET['obrisi'])){
        $obrisi_id = $_GET['obrisi'];

        $query = $konekcija -> prepare('DELETE FROM narudzba WHERE narudzba_id=?');
        $query -> bind_param('s', $obrisi_id);
    
        if($query->execute()){
            echo '<div class="alert alert-success">Narudžba uspješno obrisana!</div>';
        }else{
            echo '<div class="alert alert-danger">Narudžba neuspješno obrisana!</div>';
        }
    };

    $korisnik_id = $_SESSION['korisnik_id'];
    $korisnik = $_SESSION['korisnik'];

    if($redci){ ?>
        <form action="" method="post">
            <table id="example" class='tablica_narudzbe table-bordered'> 
                <thead class='thead_narudzbe'>
                    <tr>
                        <th>Proizvod</th>
                        <th>Primatelj</th>
                        <th>Telefon</th>
                        <th>Adresa za dostavu</th>   
                        <th>Datum narudžbe</th>           
                        <th>Cijena</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    <th>Status pošiljke</th>
                    </tr>
                </thead>
                <tbody>
        <?php
        while ($row=$redci->fetch_assoc()){ ?>
                    <tr>
                        <?php echo "<input type='hidden' name='narudzba_id' value=".$row['narudzba_id']." />" ?>
                        <th><?php echo $row['proizvod'] ?></th>
                        <th><?php echo $row['primatelj'] ?></th>
                        <th><?php echo $row['telefon'] ?></th>
                        <th><?php echo  $row['ulica'] . ", "  . $row['grad'] . ", " . $row['postanski_broj'] ?></th>
                        <th><?php echo $row['datum_narudzbe'] ?></th>
                        <th><?php echo $row['totalna_cijena'] . " kn" ?></th>
                        <th><?php echo"<a href='uredi_narudzba.php?edit=$row[narudzba_id]' class='btn-edit'><i class='icon-edit'></i> </a>" ?></br></th>
                        <th><?php echo"<a href='sve_narudzbe.php?obrisi=$row[narudzba_id]' onclick=\"javascript: return confirm('Jeste li sigurni da želite obrisati narudžbu?');\" class='btn-delete'><i class='icon-trash'></i></a>" ?></th>
                        <th><?php echo"<a href='detalji_narudzba.php?detalji=$row[narudzba_id]' class='btn-edit'><i class='icon-plus-sign'></i></a>" ?></th>
                         <?php
                        if($row['status'] == 0){
                            echo '<th><p><a href="status_narudzbe.php?narudzba_id='.$row['narudzba_id'].'&status=1" onclick=\'javascript: return confirm("Promjeni status u pripremu?");\' class="btn btn-warning"> Primljena</a></p></th>';
                        }elseif($row['status'] == 1){
                            echo '<th><p><a href="status_narudzbe.php?narudzba_id='.$row['narudzba_id'].'&status=2" onclick=\'javascript: return confirm("Promjeni status u isporučena?");\' class="btn btn-success"> U pripremi</a></p></th>';
                        }elseif($row['status'] == 2){
                            echo '<th><p><a href="status_narudzbe.php?narudzba_id='.$row['narudzba_id'].'&status=3" onclick=\'javascript: return confirm("Promjeni status u otkazano?");\' class="btn btn-primary"><i class="icon-check"></i> Isporučeno</a></p></th>';
                        }elseif($row['status'] == 5){
                            echo '<th><p><a href="status_narudzbe.php?narudzba_id='.$row['narudzba_id'].'&status=0" onclick=\'javascript: return confirm("Promjeni status narudžbe u priprema?");\' class="btn btn-info"><i class="icon-check"></i> Pogledano</a></p></th>';
                        }else{
                            echo '<th><p><a href="status_narudzbe.php?narudzba_id='.$row['narudzba_id'].'&status=4" class="btn btn-danger"><i class="icon-check"></i> Otkazano</a></p></th>';
                        } ?>
                        </th>
                    </tr>
                <?php } ?>
                </table>
                <?php
        echo "</form></br></br></br>
        ";
    } else{
        echo "<div style='padding: 10px'>
        <div class='alert alert-warning'>Na popisu nema ni jedne narudžbe!</div>
        </div>";
    }
    
    $konekcija->close();
}else{
    echo '<div class="alert alert-danger">Nemate pristup ovoj stranici!</div>';
}
echo"</div>";
    require_once ("footer2.php");
?>
