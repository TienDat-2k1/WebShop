<?php
   require_once ('../../Database/db.php');
   require_once ('./asssets/function/isHaveInfor.php');
    $id='';
    if(!empty($_POST))
    {
    $usernameAccount = $_POST["usernameAccount"];
    $passwordAccount = $_POST["passwordAccount"];

    $loginQuery = "SELECT * FROM account WHERE account.username = '$usernameAccount' AND account.password = '$passwordAccount'";
    $acc = executeSingleResult($loginQuery);
    if (  $acc!= null) {
           $id = $acc["id"];
           $cookie_name = "id";
           $cookie_value = $id;
           setcookie($cookie_name, $cookie_value, time() + (60*30), '/');
           if(isset($_GET['id']))
           {
                $idproduct=$_GET['id'];
                $sql='select * from cart';
                $listcart=executeResult($sql);
                $flag=false;
                if($listcart!=null)
                {
                    foreach($listcart as $item)
                    {
                        if($item['id_pro']==$idproduct && $item['id_acc']==$id)
                        {
                            $numproduct=$item['numprod'];
                            $sqlc='update cart set numprod ='.++$numproduct.' where id_acc ='.$item['id_acc'].' and id_pro ='.$item['id_pro'];
                            $sqlc= execute($sqlc);
                            $flag=true;
                            header('Location: cart.php');
                            break;
                        }
                    }
                    if(!$flag)
                    {
                        $sqlc='insert into cart(id_acc,id_pro,numprod)
                                        value("'.$id.'","'.$idproduct.'","1")';
                            execute($sqlc);
                            header('Location: cart.php');

                    }
                }
                else
                {
                    $sqlc='insert into cart(id_acc,id_pro,numprod)
                    value("'.$id.'","'.$idproduct.'","1")';
                    execute($sqlc);
                    header('Location: cart.php');
                }
                
           }
           else
           {
               header('Location: index.php');
           }
        }
                
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up UT-Lap</title>
    <style>
        body{
    margin: 0;
    padding: 0;
    background: linear-gradient(120deg, #2980b9, #8e44ad);
    height: 100vh;
    overflow: hidden;
}
.center{
     position: absolute;
     top: 50%;
     left: 50%;
     transform: translate(-50%, -50%);
     width: 400px;
     background: white;
     border-radius: 10px;
}
.center h1{
    text-align: center;
    padding: 0 0 20px 0;
    border-bottom: 1px solid silver;
}
.center form{
    padding: 0 40px;
    box-sizing: border-box;
}
form .txt_field{
    position: relative;
    border-bottom: 2px solid #adadad;
    margin: 30px 0;
}
.txt_field input{
    width: 100%;
    padding: 0 5px;
    height: 40px;
    font-size: 16px;
    border: none;
    background: none;
    outline: none;
}
.txt_field label{
    position: absolute;
    top: 50%;
    left: 5px;
    color: #adadad;
    transform: translateY(-50%);
    font-size: 16px;
    pointer-events: none;
}
.txt_field span::before{
    content: '';
    position: absolute;
    top: 40px;
    left: 0;
    width: 100%;
    height: 2px;
    background: #2691d9;
    transform: .5s;
}
.txt_field input:focus ~ label,
.txt_field input:valid ~ label{
    top: -5px;
    color: #2691d9;
}
.txt_field input:focus ~ span::before,
.txt_field input:valid ~ span::before{
    width: 100%;
}
.pass{
    margin: -5px 0 20px 5px;
    color: #a6a6a6;
    cursor: pointer;
}
.pass:hover{
    text-decoration: underline;
}
input[type='submit']{
    width: 100%;
    height: 50px;
    border: 1px solid;
    background: #2691d9;
    border-radius: 25px;
    font-size: 18px;
    color: #e9f4fb;
    font-weight: 700;
    cursor: pointer;
    outline: none;
}
input[type='submit']:hover{
    border-color: #2691d9;
    transition: .5s;
}
.signup_link{
    margin: 30px 0;
    text-align: center;
    font-size: 16px;
    color: #666666;
}
.signup_link a{
    color: #2691d9;
    text-decoration: none;
}
.signup_link a:hover{
    text-decoration: underline;
}
.is_admin{
    text-align: center;
    margin-bottom: 30px;
    size: 16px;
    color: #2691d9;
    font-weight: 400;
}
.is_admin input{
    margin: 5px;
}
    </style>
</head>
<body>
<div class="center">
        <h1>Đăng nhập</h1>
        <form action="" method="post">
            <div class="txt_field">
                <input type="text" name="usernameAccount" required>
                <span></span>
                <label>Tên tài khoản</label>
            </div>
            <div class="txt_field">
                <input type="password" name="passwordAccount" required>
                <span></span>
                <label>Mật khẩu</label>
            </div>
            <input type="submit" value="Đăng nhập">
            <div class="signup_link">
                Bạn chưa có tài khoản? <a href="signup.php">Đăng kí</a>
            </div>
        </form>
    </div>
</body>
</html>