<?php
require_once ('../../Database/db.php');
require_once ('./asssets/function/convertmoney.php');
require_once ('./asssets/function/displayname.php');

$s='';
if(isset($_GET['s']))
{
    $s=$_GET['s'];
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
                    $i=0;
                    if(isset($_COOKIE['id']))
                    {
                        $id=$_COOKIE['id'];
                        $sql='select *from cart where id_acc ='.$id;
                        $list=executeResult($sql);
                        foreach($list as $item)
                        {
                            $i++;
                        }
                    }
                    ?>
                    <a href="cart.php" style ="text-decoration: none; color:white">
                        <div class="headerCartIcon">
                            <div class="headerCart-Product">
                                <span style="font-weight:600;"><?=$i?></span>
                            </div>
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <span>Giỏ hàng</span>
                        
                    </a>
                </div>
            </div>
        </div>
        <div class="main-body" style="padding-top:40px; min-height:500px">
            <div>
                <nav class="navbar navbar-expand-sm" style="background: linear-gradient(45deg, #d6d6d6, #fff);height:40px;position: fixed; top:140px;left:0; right:0">
                <!-- Links -->
                <ul class="navbar-nav grid wide" style="display:flex" >
                    <li class="nav-item" >
                        <a class="nav-link" href="index.php" style="color: #000; font-weight:700; font-size:12px">Trang chủ</a>
                    </li>
                    <span  style="font-size:16px;">>> Kết quả tìm kiếm...</span>
                </ul>
                </nav>
            </div>
            <div class="grid wide" >
                <div class="row">
                    <?php
                    $limit =20;
                    $page=1;
                    if(isset($_GET['page']))
                    {
                        $page=$_GET['page'];
                    }
                    if($page<=0)
                    {
                        $page=1;
                    }
                    $firstindex=($page-1)*$limit;
                        $sql='select *from product where title like "%'.$s.'%" limit '.$firstindex.' ,'.$limit;
                        $listproduct=executeResult($sql);
                        $sqlcount='select count(id) as total from product where title like "%'.$s.'%"';
                        $countResult= executeSingleResult($sqlcount);
                        $num=ceil($countResult['total']/$limit);
                        foreach($listproduct as $item)
                        {
                            echo '<div class ="l-2-4" style="font-size:16px; margin-bottom:14px">
                            <div style="background-color:#ececec; padding:2px; border: 1px solid #eee; border-radius:6px; height:100% ">
                            <a href="detail.php?id='.$item['id'].'"><img src="../../Admin/Product/'.$item['linkImg'].'" alt="img" style ="width: 100%"> </a>
                            <a href="detail.php?id='.$item['id'].'" style="text-decoration: none; color: black; font-weight:500;">'.$item['title'].'</a>
                            <p style="color:red; font-weight:bold">'.convertmoney($item['price']).' đ</p>
                            </div>
                            </div>';
                        }
                    ?>
                </div>
                <div style= "height:42px; margin:20px 0;font-size:24px; display:flex; justify-content:center">
                    <nav aria-label="Page navigation" style="height:100%">
                    <ul class="pagination">
                        <?php
                        if($num >1)
                        {
                            $availablepage=[1,$page-1, $page,$page+1,$num];
                            $isfirst=$islast=false;
                        
                            if($page >1)
                            {
                                echo '<li class="page-item">
                                <a class="page-link" href="?id='.$id.'&page='.($page-1).'" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                                </a>
                            </li>';
                            }
                            else
                            {
                                echo '<li class="page-item disabled">
                                <a class="page-link" href="?id='.$id.'&page='.($page-1).'" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                                </a>
                            </li>';
                            }
                            for ($i=0; $i < $num; $i++) { 
                                if(!in_array($i+1,$availablepage))
                                {
                                    if(!$isfirst && $page >3)
                                    {
                                        echo '<li class="page-item disabled">
                                        <a class="page-link" href="#">...</a>
                                    </li>';  
                                        $isfirst=true;
                                    }
                                    if(!$islast && $i>$page)
                                    {
                                        echo '<li class="page-item disabled">
                                        <a class="page-link" href="#">...</a>
                                    </li>'; 
                                         $islast=true; 
                                    }
                                    continue;
                                }
                                if($page ==($i+1))
                                {
                                    echo '<li class="page-item active">
                                <a class="page-link" href="#">'.($i+1).'</a>
                            </li>';
                                }
                                else
                                    echo '<li class="page-item">
                                    <a class="page-link" href="?id='.$id.'&page='.($i+1).'">'.($i+1).'</a>
                                </li>';
                            }
                            if($page <$num)
                            {
                                echo '<li class="page-item">
                                <a class="page-link" href="?id='.$id.'&page='.($page+1).'" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                                </a>
                            </li>';
                            }
                            else
                            {
                                echo '<li class="page-item disabled">
                                <a class="page-link" href="?id='.$id.'&page='.($page+1).'" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                                </a>
                            </li>';
                            }
                        }
                        ?>
                        
                    </ul>
                    </nav>
                </div>
            </div>
        </div>
        <footer class="bg-primary text-white text-center text-lg-start" >
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