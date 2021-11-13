<?php
function displayname()
{
    $idacc="";
    if(isset($_COOKIE['id']))
    {   
        $idacc=$_COOKIE['id'];
        $sql='select *from guest where id_acc ='.$idacc;
        $guest=executeSingleResult($sql);
        if($guest != null)
        {
            $displayname=$guest["firstname"].'_'.$guest["lastname"];
            return $displayname;
        }
        else{
            return 'user_name';
        }
    }
    else {
        return 'username';
    }
}

?> 