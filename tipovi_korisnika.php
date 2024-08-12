<?php
function Admin()
{
    if(isset($_SESSION['korisnik']) && $_SESSION['tip_korisnika'] == 'admin')
    {
        return true;
    } else 
    {
        return false;
    }
}

function User()
{
    if(isset($_SESSION['korisnik']) && $_SESSION['tip_korisnika'] == 'korisnik')
    {
        return true;
    } else 
    {
        return false;
    }
}
?>