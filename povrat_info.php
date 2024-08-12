<?php
    $title = "Reklamacije, povrat i zamjena robe - Pet Shop";
    require_once('head.php');

    echo"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'/>
    <div class='animate__animated animate__bounceInLeft bar2'>
        <h2><a href='index.php' class='bar'><i class='icon-home'></i> Početna</a><span> / Reklamacija, povrat i zamjena robe</span></h2>
        <br>
        <a class='btn btn-danger px-3 me-2' href='index.php' ><i class='icon-arrow-left'></i> Povratak </a>
    <br></br>";
?>

<div class="podaci">

    <h2><b>Ispravnost pošiljke, zamjena i povrat robe</b></h2><br>

    <p>
        Prodavatelj ove trgovine se obvezuje isporučiti proizvode koji su tehnički ispravni, zapakirani u originalnu ambalažu, koji imaju ispravan rok trajanja i koji odgovaraju vrsti, opisu i cijeni proizvoda.
    </p><br>

    <p>
        Naručeni proizvodi pakiraju se na način da prilikom dostave ne budu oštećeni, polomljeni i slično.
    </p><br>

    <p>
        Prilikom dostave pošiljke, preporučuje se da se roba pregleda ima li kakvih oštećenja te u slučaju ako postoje vidljiva oštećenja, to kažete osobi koja Vam je dostavila robu
        te tada imate pravo odbiti preuzimanje pošiljke. Ukoliko nešto nedostaje ili Vam je dostavljen pogrešan proizvod, također o tome obavjestite dostavljača. 
    </p><br>

    <p>
        Dostavljač tada to zapisuje i svojim potpisom potvrđuje nedostatke, što kasnije dolazi do nas i u tom slučaju ćemo se potruditi da Vam na naš račun dostavimo ispravan proizvod u što kraćem mogućem roku.
        Naknadne reklamacije u smislu količine, vrste proizvoda i oštećenja proizvoda nismo obvezni uvažavati, stoga Vas molimo da robu odmah pregledate prilikom dostave.
    </p><br>

    <p>
        Ukoliko kao kupac želite vratiti ili zamijeniti ispravan i nekorišten proizvod koji Vam ne odgovara, molimo Vas da za to obavjestite administratora <a href='poruke.php'>ovdje</a> kako biste dogovorili povrat novca ili zamjenu robe.
    </p><br>
</div>

<?php
    echo"</div>";
    require_once('footer2.php');
?>