<?php
   require_once ('../../Database/db.php');
   if(!empty($_POST))
   {
        $usernameAccount = $_POST["usernameAccount"];
        $passwordAccount = $_POST["passwordAccount"];
        $adminAccount=0;
        if(isset($_POST['adminAccount']))
        {
            if(strcmp($_POST["adminAccount"], 'true') == 0) {
                $adminAccount = 1;
            } else {
                $adminAccount = 0;
            }
        }
        $insertAccountQuery = "INSERT INTO `account`(`username`, `password`, `admin`) VALUES ('$usernameAccount','$passwordAccount',$adminAccount)";
        function isExistAccount($username) {
            $getAllQuery = "SELECT * FROM account";
            $getAllData = executeResult($getAllQuery);
            foreach($getAllData as $acc)
            {
                if(strcmp($acc["username"], $username) == 0) {
                    return true;
                }
            }
            return false;
        }
        function getIdAccount($username) {
            $getIdQuery = "SELECT id FROM account WHERE account.username = '$username'";
            $getIdData = executeSingleResult($getIdQuery);
            if($getIdData !=null)
            {
                return $getIdData['id'];
            }
            return -1;
        }
        if(strcmp($_POST["passwordAccount"], $_POST["confirmPasswordAccount"]) == 0) {
            if (!isExistAccount($_POST["usernameAccount"])) {
                $insertAccountData = execute($insertAccountQuery);
                $cookie_name = "id";
                $cookie_value = getIdAccount($_POST["usernameAccount"]);
                setcookie($cookie_name, $cookie_value, time() + (60*30), "/");
                header( "Location: getinfo.php" );
            } else {
                echo '<script language="javascript">';
                echo 'alert("Đăng kí thất bại, tên tài khoản đã tồn tại");';
                echo 'window.location = "signup.php"';
                echo '</script>';
            }
        } else {
            echo '<script language="javascript">';
            echo 'alert("Đăng kí thất bại, hãy chắc chắn xác nhận đúng mật khẩu");';
            echo 'window.location = "signup.php"';
            echo '</script>';
        }
    
        //KT tồn tại tài khoản
        
 
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
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
        <h1>Đăng kí</h1>
        <form action="signup.php" method="post">
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
            <div class="txt_field">
                <input type="password" name="confirmPasswordAccount" required>
                <span></span>
                <label>Xác nhận mật khẩu</label>
            </div>
            <?php
                if(isset($_COOKIE['id']))
                {
                    $sql='select *from account';
                    $listacc=executeResult($sql);
                    $flag=false;
                    foreach($listacc as $acc)
                    {
                        if($acc['admin']==1)
                        {
                            $flag=true;
                            break;
                        }
                    }
                    if($flag)
                    {
                        echo '<div class="is_admin">
                        Xác nhận đăng kí quyền admin? 
                        <input type="hidden" name="adminAccount" value="false">
                        <input type="checkbox" name="adminAccount" value="true">
                    </div>';
                    }
                }
            ?>
            
            <input type="submit" value="Hoàn thành đăng kí">
            <div class="signup_link">
                Bạn đã có tài khoản <a href="login.php">Đăng nhập</a>
            </div>
        </form>
    </div>
</body>
</html>