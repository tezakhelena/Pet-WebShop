<?php
    session_start();
    //ponistavanje svih varijabli
    $_SESSION = array();
    //unistavanje cookia
    if(isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-36000, '/');
    }
    //unistavanje sesije
    session_destroy();
    //redirekcija
    header("Location: login.php");
?>
