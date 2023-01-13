<?php

function isConnect()
{
    if(!isset($_SESSION['membre']))
    {
        return false;
    }
    else 
    {
        return true;
    }
}
?>



<?php
function isAdminConnect() 
{

    if(isConnect() && $_SESSION['membre']['statut'] == 1)
    {
        return true;
    }
    else 
    {
        return false;
    }
}
?>
