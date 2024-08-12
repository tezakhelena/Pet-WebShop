<?php
$title="Dokumenti - Pet Shop";
require_once('baza.php');
require_once('head.php');

echo"
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css'>

    <div class='animate__animated animate__bounceInLeft bar2'>
        <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a> <span> / <i class='icon-file-text'></i> Dokumenti</span></h2>
        <br></br>
        <a class='btn btn-danger px-3 me-2' href='index.php' ><i class='icon-arrow-left'></i> Povratak </a>
        <br></br>
";
?>

<table class="table table-bordered tablica-dokumenti">
    <tr>
        <th>DOKUMENTI</th>
    </tr>
    <tr>
        <td><a type='link' href='pdf_ljubimci.php'><b> Popis ljubimaca <i class="icon-download-alt"></i></b></a></td>
    </tr>
    <tr>
        <td><a type='link' href='pdf_hrana.php'><b> Popis hrane za ljubimce <i class="icon-download-alt"></i></b></a></td>
    </tr>
    <tr>
        <td><a type='link' href='pdf_korisnici.php'><b> Popis registriranih korisnika <i class="icon-download-alt"></i></b></a></td>
    </tr>
    <tr>
        <td><a type='link' href='pdf_oprema.php'><b> Popis opreme za ljubimce <i class="icon-download-alt"></i></b></a></td>
    </tr>
</table>

<?php
    echo"</div>";
    require_once ("footer2.php");
?>



