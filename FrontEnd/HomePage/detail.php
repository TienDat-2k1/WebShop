<?php
require_once ('../../Database/db.php');
require_once ('./asssets/function/convertmoney.php');
require_once ('./asssets/function/displayname.php');

$id='';
$title='';
$idcatg='';
$linkimg='';
$price='';
$content='';

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $sql= 'select * from product where id = '.$id;
    $product= executeSingleResult($sql);
    if($product !=null)
    {
        $title= $product['title'];
        $idcatg= $product['id_category'];
        $linkimg= $product['linkImg'];
        $price = $product['price'];
        $content = $product['content'];
    }
    $moneyprod=convertmoney($price);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./asssets/css/responsive.css">
    <link rel="stylesheet" href="./asssets/css/base.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./asssets/css/main.css">
    <title>Homa.Vn</title>
</head>
<body>
    <div class="wrapper" >
        <div class="headder" style=" display: inline-block;">
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
                                    <a href="getinfo.php?id='.$_COOKIE['id'].'">Thông tin tài khoản</a>
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
                                     echo'<li class="nav_user-item">
                                        <a href="signup.php">Thêm Admin</a>
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
                    <span>Homa.Vn</span>
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
                    <div class="headerNotify" id="notifyBox">
                        <div class="headerNotify-heading">
                            <h3>Thông báo mới nhận <span>17</span></h3>
                        </div>
                        <div class="notifi-item">
                            <img src="./asssets/img/avatar1.png" alt="">
                            <div class="notifi-text">
                                <h4>Elias</h4>
                                <p>@i wil give you</p>
                            </div>
                        </div>
                        <div class="notifi-item">
                            <img src="./asssets/img/avatar2.png" alt="">
                            <div class="notifi-text">
                                <h4>Elias</h4>
                                <p>@i wil give you</p>
                            </div>
                        </div>
                        <div class="notifi-item">
                            <img src="./asssets/img/avatar3.png" alt="">
                            <div class="notifi-text">
                                <h4>Elias</h4>
                                <p>@i wil give you</p>
                            </div>
                        </div>
                        <div class="notifi-item">
                            <img src="./asssets/img/avatar4.png" alt="">
                            <div class="notifi-text">
                                <h4>Elias</h4>
                                <p>@i wil give you</p>
                            </div>
                        </div>
                        <div class="notifi-item">
                            <img src="./asssets/img/avatar5.png" alt="">
                            <div class="notifi-text">
                                <h4>Elias</h4>
                                <p>@i wil give you</p>
                            </div>
                        </div>
                    </div>
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
        <div class="main-body" style ="margin-top:0; padding-top:40px">
            <div>
                <nav class="navbar navbar-expand-sm" style="background: linear-gradient(45deg, #d6d6d6, #fff);height:40px;position: fixed; top:140px;left:0; right:0">
                <!-- Links -->
                <ul class="navbar-nav grid wide" >
                    <li class="nav-item" >
                        <a class="nav-link" href="index.php" style="color: #000; font-weight:700; font-size:12px">Trang chủ</a>
                    </li>
                    <?php
                        $sql= 'select *from category where id='.$idcatg;
                        $catg=executeSingleResult($sql);
                        echo '<li class="nav-item">
                        <a class="nav-link" href="category.php?id='.$catg['id'].'" style="color: #000; font-weight:400 ;font-size:12px;">>> '.$catg['name'].'</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#" style="color: #000; font-weight:400 ;font-size:12px; display: inline-block; max-width: 400px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">>> '.$title.'</a>
                    </li>';
                    ?>
                </ul>
                </nav>
            </div>
            <div class="titleproduct ">
                <div class="grid wide">
                    <?php
                        echo '<h1 style="max-width:100%; white-space: nowrap;   overflow: hidden;text-overflow: ellipsis; ">'.$title.'</h1>';
                    ?>
                </div>
            </div>
            <div class="navproduct grid wide">
                <div class="row">
                    <div class="col-xl-4">
                        <?php
                            echo '<img src="../../Admin/Product/'.$linkimg.'" alt="img" style="width:100%";>';
                        ?>
                    </div>
                    <div class="col-xl-4" style ="display: flex;flex-direction:column;justify-content: space-between;">
                        <div>
                            <span style="font-size:32px;color:red; padding:0 40px;"><?=$moneyprod?> đ</span>
                        </div>
                        <div style="margin-bottom:20px; padding:0 40px; height:72px">
                        <?php $hrefff ='#'; 
                        if(isset($_COOKIE['id']))
                         {
                             $idacc=$_COOKIE['id'];
                             
                             $sql ='select * from cart';
                             $list= executeResult($sql);
                             $flag=true;
                             foreach($list as $item)
                             {
                                 if($idacc==$item['id_acc'] && $id==$item['id_pro'])
                                 {
                                     $numpro= $item['numprod'];
                                     $sqlc='update cart set numprod ='.++$numpro.' where id_acc ='.$item['id_acc'].' and id_pro ='.$item['id_pro'];
                                     $sqlc= execute($sqlc);
                                     $hrefff= 'cart.php';
                                     $flag=false;
                                     break;
                                 }
                             }
                             if($flag)
                             {
                                    $sqlc='insert into cart(id_acc,id_pro,numprod)
                                       value("'.$idacc.'","'.$id.'","1")';
                                       $hrefff= 'cart.php';
                                    execute($sqlc);
                             }
                        }
                         else{
                            $hrefff='login.php?id='.$id.'';
                            }
                        ?>
                            <a href="<?=$hrefff?>" style="width:100%; height:100%;"><button type="button" class="btn btn-primary" style="width:100%;height:100%; font-size:32px; border-radius:10px">Mua Ngay</button></a>
                        </div>
                    </div>
                    <div class="col-xl-4" style="background-color:#f3f3f3; border-radius:6px">
                        <h4 class="alert-heading" style="font-size:28px; padding:0 15px; margin-top: 3px; border-bottom:2px solid #a7d2fd">Thông tin cấu hình</h4>
                    </div>
                </div>
                <div style="border-style: dashed; border-color: #6495ED; border-radius:10px; margin-top: 40px; background-color: #F0F8FF;">
                    <?php
                        echo 
                        '<h4 class="alert-heading" style="font-size:28px; padding:0 15px; margin-top: 3px">MÔ TẢ SẢN PHẨM</h4>
                        <p style="font-size:20px; padding:0 15px; text-align: justify;">'.$content.'</p>';
                    ?>
                </div>
            </div>
        </div>
        <footer class="bg-primary text-white text-center text-lg-start" style="margin-top:100px" >
        <!-- Grid container -->
        <div class="container p-4">
            <!--Grid row-->
            <div class="row">
            <!--Grid column-->
            <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase">Footer Content</h5>

                <p>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste atque ea quis
                molestias. Fugiat pariatur maxime quis culpa corporis vitae repudiandae aliquam
                voluptatem veniam, est atque cumque eum delectus sint!
                </p>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">Links</h5>

                <ul class="list-unstyled mb-0">
                <li>
                    <a href="#!" class="text-white">Link 1</a>
                </li>
                <li>
                    <a href="#!" class="text-white">Link 2</a>
                </li>
                <li>
                    <a href="#!" class="text-white">Link 3</a>
                </li>
                <li>
                    <a href="#!" class="text-white">Link 4</a>
                </li>
                </ul>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase mb-0">Links</h5>

                <ul class="list-unstyled">
                <li>
                    <a href="#!" class="text-white">Link 1</a>
                </li>
                <li>
                    <a href="#!" class="text-white">Link 2</a>
                </li>
                <li>
                    <a href="#!" class="text-white">Link 3</a>
                </li>
                <li>
                    <a href="#!" class="text-white">Link 4</a>
                </li>
                </ul>
            </div>
            <!--Grid column-->
            </div>
            <!--Grid row-->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2020 Copyright:
            <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
        </div>
        <!-- Copyright -->
        </footer>
    </div>
    <script src="./asssets/js/scrip.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>