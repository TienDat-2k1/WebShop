<?php
if(isset($_GET['idcook']))
{   
    if(isset($_COOKIE["id"]))
    {
        setcookie('id', '', time()-3600, '/');
        header('Location: index.php');
        die() ;
    }
}


?>