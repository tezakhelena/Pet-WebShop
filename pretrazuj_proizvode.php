<?php $title = "Pretražuj svih proizvoda - Pet Shop"; 
    require_once("head.php"); 
    require_once("baza.php");
 
?>        <head>
            <meta charset="UTF-8" />
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
            <script data-require="jquery@*" data-semver="3.0.0" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.js"></script>
            <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" />
            <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>
        </head>
                
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
                },
            },
            );
            
        });
        $('#example').ddTableFilter();
        </script>

        <div class='animate__animated animate__bounceInLeft bar2'>
            <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / <i class='icon-search'></i> Pretraživanje svih proizvoda</span></h2>
            <br></br>
            <a class='btn btn-danger px-3 me-2' href='index.php' ><i class='icon-arrow-left'></i> Povratak </a>
            <br></br>
        <?php

        $query='SELECT hrana.naziv, hrana.cijena, hrana.slika, kategorija.naziv_kategorija FROM hrana INNER JOIN kategorija ON hrana.kategorija_id = kategorija.kategorija_id UNION SELECT oprema.naziv, oprema.cijena, oprema.slika, kategorija.naziv_kategorija FROM oprema INNER JOIN kategorija ON oprema.kategorija_id = kategorija.kategorija_id UNION SELECT ljubimci.naziv, ljubimci.cijena, ljubimci.slika, kategorija.naziv_kategorija FROM ljubimci INNER JOIN kategorija ON ljubimci.kategorija_id = kategorija.kategorija_id ORDER BY naziv';
        $redci = mysqli_query($konekcija, $query);

            if($redci){
                ?>
    
                <form action="" method="post">
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <td><b>Slika</b></td>
                                <td><b>Naziv</b></td>
                                <td><b>Kategorija</b></td>
                                <td><b>Cijena</b></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row=$redci->fetch_assoc()){ ?>
                                <tr>
                                    <td><?php echo"<img class='slika' src='sve_slike/" . $row['slika'] . "' style='width: 150px; border-radius: 10px;'/>"; ?></td>
                                    <td><?= $row['naziv']; ?></td>
                                    <td><?= $row['naziv_kategorija']; ?></td>
                                    <td><?= $row['cijena']; ?></td> 
                                </tr>
                                
                            <?php } ?> 
                        </tbody>
                    </table>
                    <?php
                    echo "</form></br></br></br>";
                }else{
                    echo '<div class="alert alert-danger">Nema proizvoda!</div>';
                }
        $konekcija->close();


    echo"</div>";
    
    include ("footer2.php");
?>
