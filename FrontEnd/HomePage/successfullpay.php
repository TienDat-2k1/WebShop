<?php

require_once ('../../Database/db.php');
require_once ('./asssets/function/convertmoney.php');
require_once ('./asssets/function/displayname.php');

$flag=true;
if(!empty($_POST))
{
    if(isset($_COOKIE['id']))
    {
        if(isset($_POST['firstname'])&&isset($_POST['lastname'])&&isset($_POST['email'])&&
        isset($_POST['phone'])&&isset($_POST['address']))
        {
            $sqlguest="update guest set firstname ='".$_POST['firstname']."' , lastname= '".$_POST['lastname']."' , 
            email = '".$_POST['email']."' , phone = '".$_POST['phone']."' , address = '".$_POST['address']."' where id_acc =".$_COOKIE['id'];
            execute($sqlguest);
            $sqllistcart= 'SELECT product.id, product.title, product.price, product.linkImg, cart.numprod FROM cart, product WHERE cart.id_acc = '.$_COOKIE['id'].' and product.id=cart.id_pro';
            $getlistcart= executeResult($sqllistcart);
            $dateorder=date('Y-m-d H:s:i');
            $sqlsetidbill='select MAX(id) as idbill from bill where idguest ='.$_COOKIE['id'];
            $getidbill=executeSingleResult($sqlsetidbill);
            $idbill=$getidbill['idbill'];
            if($idbill==null)
            {
                $idbill=0;
            }
            foreach($getlistcart as $item)
            {
                $sqlorder='insert into bill(id,idproduct,count,idguest,dateorder,status)
                    value("'.($idbill+1).'","'.$item['id'].'","'.$item['numprod']
                    .'","'.$_COOKIE['id'].'","'.$dateorder.'","Tiếp nhận đơn hàng thành công")';
                execute($sqlorder);
            }
            $sqldeletecart='delete from cart where id_acc ='.$_COOKIE['id'];
            execute($sqldeletecart);

            $flag=false;
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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./asssets/css/responsive.css">
    <link rel="stylesheet" href="./asssets/css/base.css">
    <link rel="stylesheet" href="./asssets/css/main.css">
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
        <div class="headder">
            <div class="grid wide nav">
                <ul class="nav-list">
                    <li class="nav-list_item">
                        <a href="" class="nav-list_itemlink">
                            <i class="fas fa-phone-volume"></i>
                            <span>CSKH:18008198</span>
                        </a>
                    </li>
                    <li class="nav-list_item">
                        <a href="" class="nav-list_itemlink">
                            <i class="far fa-bell"></i>
                            <span>Thông báo</span>
                        </a>
                        <div class="header-notify">

                        </div>
                    </li>
                    <?php
                        if(!isset($_COOKIE['id']))
                        {
                            echo '<li class="nav-list_item">
                            <span>Đăng kí</span>
                        </li>
                        <li class="nav-list_item">
                            <span><a href="login.php">Đăng nhập</a></span>
                        </li>';
                        }
                        else {
                            $idc=$_COOKIE['id'];
                            $sqlcheckadmin='select *from account where id='.$idc;
                            $acc=executeSingleResult($sqlcheckadmin);
                            echo '<li class="nav-list_item nav-list_item-user">
                            <i class="far fa-user-circle"></i>
                            <span>'.displayname().'</span>
                            <ul class="nav_user-menu">
                                <li class="nav_user-item">
                                    <a href="">Thông tin tài khoản</a>
                                </li>
                                <li class="nav_user-item">
                                    <a href="">Đơn mua</a>
                                </li>
                                <li class="nav_user-item">
                                    <a href="process.php?idcook='.$idc.'">Đăng xuất</a>
                                </li>';
                                if($acc['admin'] == '1')
                                {
                                    echo'<li class="nav_user-item">
                                    <a href="../../Admin">Admin</a>
                                </li>';
                                }
                                echo '
                            </ul>
                        </li>';
                        }
                    ?>
                    
                </ul>
            </div>
            <div class="grid wide content_header">
                <a href="index.php" class="header-logoSection">
                    <img src="asssets/img/pngaaa.com-5751053.png" alt="" class="headerlogo">
                    <span>ReRollAcc.Vn</span>
                </a>
                <div class="header-searchSection">
                    <div class="header-searchSectionWrap">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <form action="searching.php" method="get" style="width:100%">
                            <input type="text" class="header-searchInput" placeholder="Nhập để tìm kiếm" name="s">
                        </form>
                    </div>
                </div>
                <div class="headerBill">
                    <a href="bill.php" style="text-decoration:none; color:white; display:block; width:100%;height:100%">
                        <div class="headerBill_WrapIcon">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <span>Đơn Hàng</span>

                    </a>
                </div>
                <div class="headerNofi">
                    <div class="headerNofiIcon" onclick="toggleNotifi()">
                        <div class="headerNofiIcon-Cart">
                            <span>3</span>
                        </div>
                        <i class="far fa-bell"></i>
                    </div>
                    <span>Thông báo</span>
                    <!-- header Notification -->
                   
                </div>
                <div class="headerCart">
                    <?php
                    $itemp=0;
                    if(isset($_COOKIE['id']))
                    {
                        $idcoki=$_COOKIE['id'];
                        $sql='select *from cart where id_acc ='.$idcoki;
                        $list=executeResult($sql);
                        foreach($list as $item)
                        {
                            $itemp++;
                        }
                    }
                    ?>
                    <a href="cart.php" style ="text-decoration: none; color:white">
                        <div class="headerCartIcon">
                            <div class="headerCart-Product">
                                <span style="font-weight:600;"><?=$itemp?></span>
                            </div>
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <span>Giỏ hàng</span>
                        
                    </a>
                </div>
            </div>
        </div>
        <div class="main-body" style="padding-top:40px">
            <div>
                <nav class="navbar navbar-expand-sm" style="background: linear-gradient(45deg, #d6d6d6, #fff);height:40px;position: fixed; top:140px;left:0; right:0;">
                <!-- Links -->
                <ul class="navbar-nav grid wide" style="display:flex" >
                    <li class="nav-item" >
                        <a class="nav-link" href="index.php" style="color: #000; font-weight:700; font-size:12px">Trang chủ</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#" style="color: #000; font-weight:400 ;font-size:12px;">>> Xác nhận thông tin</a>
                    </li>
                </ul>
                </nav>
            </div>
            <div class="grid wide">
                
                <?php
                    if(!$flag)
                    {
                        echo '<div style="background-color: blue,">
                        <img src="https://shopta.vn/images/2015/11/dat-hang-thanh-cong.jpg" style="max-width:100%; display:block; margin:auto; " alt="img">
                        <div style="font-size: 20px ; text-align:center ">
                            <a href="index.php" style="text-decoration:none;">Đi tới trang chủ</a>
                        </div>
                    </div>';
                    }
                    else
                    {
                        echo '<div style="background-color: blue,">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f0/Error.svg/1200px-Error.svg.png" style="max-width:100%; display:block; margin:auto; " alt="img">
                        <div style="font-size: 20px ; text-align:center ">
                            <span>Đặt hàng không thành công vui lòng kiểm tra lại !!!</span>
                            <a href="cart.php" style="text-decoration:none;">Đi tới giỏ hàng</a>
                        </div>
                    </div>';
                    }

                ?>
            </div>
        </div>
        <div class="footer"></div>
    </div>
    <script type="text/javascript">
    <script src="./asssets/js/scrip.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>