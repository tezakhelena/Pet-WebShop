<?php $title = "Moje narudžbe - Pet Shop"; 
    require_once("head.php"); 
    require_once("baza.php");
    

    if(isset($_SESSION['korisnik_id'])){
        $korisnik = $_SESSION['korisnik'];
        $korisnik_id = $_SESSION['korisnik_id'];
?>
        <link href='//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css' rel='stylesheet'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
        <script data-require="jquery@*" data-semver="3.0.0" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.js"></script>
        <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" />
        <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
        <div class='animate__animated animate__bounceInLeft bar2'>
            <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / <i class='icon-shopping-cart'></i> Moje narudžbe</span></h2>
            <br>
            <a class='btn btn-danger px-3 me-2' href='index.php' ><i class='icon-arrow-left'></i> Povratak </a>

            <script>
            $(document).ready(function () {
                $('#example').DataTable({
                    "lengthMenu": [ 3, 5,10, 25, 50, 75, 100 ],
                    "pagingType": "full_numbers",
                    "language": {
                        "emptyTable": "Nema podataka u tablici",
                        "zeroRecords": "Nema pronađenih proizvoda",
                        "info": "Prikazuje se _START_ do _END_ od _TOTAL_ proizvoda",
                        "infoEmpty": "Prikazuje se 0 do 0 od 0 zapisa",
                        "lengthMenu": "Prikaži: _MENU_ zapisa po stranici",
                        "infoFiltered":   "(Filtrirano od _MAX_ totalnih zapisa)",
                        "search": "Pretražuj:",
                        "paginate": {
                            "first":      "Prva",
                            "last":       "Zadnja",
                            "next":       "Sljedeća",
                            "previous":   "Posljednja"
                        },
                    }
                });
            });
        </script>
        
<?php

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

        $query="SELECT*FROM narudzba WHERE korisnik_id='$korisnik_id' ORDER BY datum_narudzbe ASC";
        $redci = $konekcija->query($query);
        $korisnik_id = $_SESSION['korisnik_id'];
        $korisnik = $_SESSION['korisnik'];

        if($redci){

                echo "<form action='' method='POST' enctype='multipart/form-data'>
                <table id='example' enctype='multipart/form-data' class='tablica_narudzbe table-bordered'> 
                <thead class='thead'>
                    <tr>
                        <th>Proizvod</th>
                        <th>Naručitelj</th>
                        <th>Primatelj</th>
                        <th>Telefon</th>
                        <th>Adresa za dostavu</th>            
                        <th>Cijena</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>";

            while ($row=$redci->fetch_assoc()){
                $korisnik_id = strval($row['korisnik_id']);
                echo"
                <tr>
                    <input type='hidden' name='narudzba_id' value=".$row['narudzba_id']." />
                    <th>" . $row['proizvod'] . "</th>
                    <th>" . $row['korisnik'] . "</th>
                    <th>" . $row['primatelj'] . "</th>
                    <th>" . $row['telefon'] . "</th>
                    <th>" . $row['ulica'] . ","  . $row['grad'] . "," . $row['postanski_broj'] . "</th>
                    <th>" . $row['totalna_cijena'] . " kn</th>
                    <th>
                    <a href='uredi_narudzba.php?edit=$row[narudzba_id]' class='btn-edit'>Uredi</a></br></th>
                    <th>
                    <a href='detalji_narudzba.php?detalji=$row[narudzba_id]' class='btn-edit'>Više</a>
                    </th>
                    <th><a href='pdf_racun_narudzba.php?narudzba_id=$row[narudzba_id]' class='btn btn-danger'>PDF</a></th>
                    </th>
                </tr>";       
            }
            echo "</tbody></table></form></br></br></br>
            ";
        } else{
            echo "<div style='padding: 10px'>
            <div class='alert alert-warning animate__animated animate__backInLeft'>Nemate ni jednu narudžbu!</div>
            </div>";
        }
        
        $konekcija->close();
    }else{
        echo '<div class="alert alert-danger animate__animated animate__backInLeft">Nemate pristup ovoj stranici!</div>';
    }

    echo"</div>";
    require_once ("footer2.php");
?>
