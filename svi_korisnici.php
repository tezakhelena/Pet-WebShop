<?php $title = "Svi korisnici - Pet Shop"; 
    require_once("head.php"); 
    require_once("baza.php");
 
    if(Admin()){ ?>
        <head>
            <meta charset="UTF-8" />
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
            <script data-require="jquery@*" data-semver="3.0.0" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.js"></script>
            <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" />
            <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>
        </head>
                
        <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "lengthMenu": [ 5,10, 25, 50, 75, 100 ],
                "pagingType": "full_numbers",
                "language": {
                    "emptyTable": "Nema registriranih korisnika",
                    "zeroRecords": "Nema pronađenih korisnika",
                    "info": "Prikazuje se _START_ do _END_ od _TOTAL_ korisnika",
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

        <div class='animate__animated animate__bounceInLeft bar2'>
            <h2><a href='index.php' class='bar'>Početna</a> <span> / <i class='icon-user'></i> Korisnici</span></h2>
            <br></br>
            <a class='btn btn-danger px-3 me-2' href='index.php' ><i class='icon-arrow-left'></i> Povratak </a>
            <br></br>
        <?php
    

        if(isset($_GET['obrisi'])){
            $obrisi_id = $_GET['obrisi'];

            $query1 = $konekcija -> prepare('DELETE FROM upiti WHERE korisnik_id=?');
            $query1 -> bind_param('s', $obrisi_id);

            $query2 = $konekcija -> prepare('DELETE FROM kosarica WHERE korisnik_id=?');
            $query2 -> bind_param('s', $obrisi_id);

            $query3 = $konekcija -> prepare('DELETE FROM narudzba WHERE korisnik_id=?');
            $query3 -> bind_param('s', $obrisi_id);

            $query4 = $konekcija -> prepare('DELETE FROM wishlist WHERE korisnik_id=?');
            $query4 -> bind_param('s', $obrisi_id);

            $query5 = $konekcija -> prepare('DELETE FROM poruke WHERE korisnik_id=?');
            $query5 -> bind_param('s', $obrisi_id);

            $query = $konekcija -> prepare('DELETE FROM korisnici WHERE korisnik_id=?');
            $query -> bind_param('s', $obrisi_id);


        
            if($query1->execute()){
                if($query2->execute()){
                    if($query3->execute()){
                        if($query4->execute()){
                            if($query5->execute()){
                                if($query->execute()){
                                    echo '<div class="alert alert-success">Korisnik uspješno izbrisan!</div>';
                                }
                            }
                        }
                    }
                }
            } else{
                echo '<div class="alert alert-danger">Korisnik neuspješno izbrisan!</div>';
            }
        };

        $query='SELECT * FROM korisnici';
        $redci = mysqli_query($konekcija, $query);

        echo "
                <a type='button' class='btn btn-secondary block ' href='blokirani_korisnici.php'><i class='icon-ban-circle'></i> <b> Blokirani korisnici</b></a>
                <a class=' btn pdf ' href='pdf_korisnici.php'><i class='icon-print'></i>  <b> Kreiraj PDF</b></a>
            <br></br>";

            if($redci){
                ?>
    
                <form action="" method="post">
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <td><b>Korisničko ime</b></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><b> Status </b></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row=$redci->fetch_assoc()){ ?>
                                <tr>
                                    <td><?php echo $row['korisnik']  ?></td>
                                    <td>
                                        <?php echo "<a href='uredi_korisnika.php?edit=$row[korisnik_id]' class='btn-edit'><i class='icon-edit'></i></a></br>"; ?>
                                    </td>
                                    <td>
                                        <?php echo"<a href='svi_korisnici.php?obrisi=$row[korisnik_id]' onclick=\"javascript: return confirm('Jeste li sigurni da želite obrisati korisnika i sve njegove radnje na stranici?');\" class='btn-delete'><i class='icon-trash'></i> </a>"; ?>
                                    </td>
                                    <td>
                                    <?php echo" <a href='detalji_korisnik.php?detalji=$row[korisnik_id]' class='btn-edit'>Više</a>"; ?>
                                    </td><td> <?php
                                        if($row['user_status'] == 1){
                                            echo '<p><a href="status.php?korisnik_id='.$row['korisnik_id'].'&user_status=0" onclick=\'javascript: return confirm("Jeste li sigurni da želite odblokirati ovaj račun?");\' class="btn btn-danger"><i class="icon-unlock"></i> Odblokiraj</a></p>';
                                        } else{
                                            echo '<p><a href="status.php?korisnik_id='.$row['korisnik_id'].'&user_status=1" onclick=\'javascript: return confirm("Jeste li sigurni da želite blokirati ovaj račun?");\' class="btn btn-success"><i class="icon-minus-sign"></i> Blokiraj</a></p>';
                                        }
                                        if($row['odobrenje'] == 1){
                                            echo '<p><a href="odobrenje_korisnik.php?korisnik_id='.$row['korisnik_id'].'&odobrenje=0" class="btn btn-primary"><i class="icon-spinner icon-spin icon-large"></i> Odobri</a></p>';
                                        } ?>
                                    </td></tr>
                                
                            <?php } ?> 
                        </tbody>
                    </table>
                    <?php
                    echo "</form></br></br></br>";
                }else{
                    echo '<div class="alert alert-danger">Nema registriranih korisnika!</div>';
                }
        $konekcija->close();

    }else{
        echo '<div class="alert alert-danger">Nemate pristup ovoj stranici!</div>';
    }

    echo"</div>";
    
    include ("footer2.php");
?>
