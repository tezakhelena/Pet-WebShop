<?php $title = "Kategorije - Pet Shop"; 
    require_once("head.php"); 
    require_once("baza.php");
 
    if(Admin()){ ?>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
    <link href='//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css' rel='stylesheet'>
    <script data-require="jquery@*" data-semver="3.0.0" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" />
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
        
    <div class='animate__animated animate__bounceInLeft bar2'>
        <h2><a href='index.php' class='bar'>Početna</a> <span> / <i class='icon-bug'></i> Kategorije</span></h2>
        <br></br>
        <a class='btn btn-danger px-3 me-2' href='index.php' ><i class='icon-arrow-left'></i> Povratak </a>
        <br></br>

        <script>
            $(document).ready(function () {
                $('#example').DataTable({
                    "lengthMenu": [ 5,10, 25, 50, 75, 100 ],
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
    if(isset($_POST['dodajKategoriju'])){
        $naziv_kategorija = $_POST['naziv_kategorija'];

        $input_error = array();

        if (empty($naziv_kategorija)) {
            $input_error['naziv_kategorija'] = "Naziv kategorije je obavezan";
        }

        if(count($input_error)==0){
            if (strlen($naziv_kategorija)>2){
                $query = $konekcija->prepare('INSERT INTO kategorija(naziv_kategorija) VALUES (?)');
                $query->bind_param('s', $naziv_kategorija);
                if ($query->execute()) {
                    echo '<div class="alert alert-success">Uspješno ste dodali kategoriju!</div>';
                }else{
                    echo '<div class="alert alert-danger">Neuspješna dodavanje!</div>';
                }
            }else{
                echo '<div class="alert alert-danger">Polje naziv mora imati više od 2 slova!</div>';
            }
        }
    }?>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method = "post" enctype = "multipart/form-data">
            <input type="text" placeholder="Dodaj novo..." name="naziv_kategorija" class="nova_kategorija">
            <button type="submit" class="btn btn-success" name="dodajKategoriju"><i class="icon-save"></i> Spremi</button><br>
            <?= isset($input_error['naziv_kategorija'])? '<label class="text-danger">'.$input_error['naziv_kategorija'].'</label><br>':'';  ?>
            </br></br></br>
        </form>

<?php

    $query='SELECT * FROM kategorija ORDER BY kategorija_id';
    $redci = mysqli_query($konekcija, $query);

    if(isset($_GET['obrisi'])){
        $obrisi_id = $_GET['obrisi'];

        $query1 = $konekcija -> prepare('DELETE FROM hrana WHERE kategorija_id=?');
        $query1 -> bind_param('s', $obrisi_id);

        $query2 = $konekcija -> prepare('DELETE FROM ljubimci WHERE kategorija_id=?');
        $query2 -> bind_param('s', $obrisi_id);

        $query3 = $konekcija -> prepare('DELETE FROM oprema WHERE kategorija_id=?');
        $query3 -> bind_param('s', $obrisi_id);

        $query4 = $konekcija -> prepare('DELETE FROM higijena WHERE kategorija_id=?');
        $query4 -> bind_param('s', $obrisi_id);

        $query = $konekcija -> prepare('DELETE FROM kategorija WHERE kategorija_id=?');
        $query -> bind_param('s', $obrisi_id);
    
        if($query1->execute()){
            if($query2->execute()){
                if($query3->execute()){
                    if($query4->execute()){
                        if($query->execute()){
                            echo '<div class="alert alert-success">Kategorija uspješno izbrisana!</div>';
                        }
                    }
                }
            }
        } else{
            echo '<div class="alert alert-danger">Kategorija neuspješno izbrisana!</div>';
        }
    };
    ?>
    
    <form action='' method='post' enctype='multipart/form-data'>
        <table id="example" style="width: 100%">
            <thead>
                <tr>
                    <td><b>ID kategorije</b></td>
                    <td><b>Naziv kategorije</b></td>
                    <td>Uredi</td>
                    <td>Briši</td>
                </tr>
            </thead>
            <tbody>
            <?php
        while ($row=$redci->fetch_assoc()){
            echo"
                <tr>
                    <td>" . $row['kategorija_id'] . "</td>
                    <td>" . $row['naziv_kategorija'] . "</td>
                    <td>
                        <a href='uredi_kategorija.php?edit=$row[kategorija_id]' style='color: green'><i class='icon-edit'></i></a></br>
                    </td>
                    <td>
                        <a href='kategorija.php?obrisi=$row[kategorija_id]' style='color: red' onclick=\"javascript: return confirm('Jeste li sigurni da želite obrisati kategoriju?');\"><i class='icon-trash'></i> </a>
                    </td>
                </tr>";
                ?>
            
            <?php
        }
        
        echo "</table></form></br></br></br>";
        $konekcija->close();

    }else{
        echo '<div class="alert alert-danger">Nemate pristup ovoj stranici!</div>';
    }

    echo"</div>";

    include ("footer2.php");
?>
