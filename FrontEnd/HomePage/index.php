<?php
require_once ('../../Database/db.php');
require_once ('./asssets/function/displayname.php');
require_once ('./asssets/function/convertmoney.php');

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
    <title>Document</title>
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
                            <span><a href="signup.php">Đăng kí</a></span>
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
                                    <a href="getinfo.php">Thông tin tài khoản</a>
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
                <a href="#" class="header-logoSection">
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
        <div class="main-body">
            <div class=" grid wide">
                <div class="row" style="">
                    <div class="col-xl-3">
                        <div>
                            <ul class="flex-column" style="list-style:none; padding:0">
                            <?php
                                $sql='select *from category';
                                $listcate=executeResult($sql);
                                foreach ($listcate as $item)
                                {
                                    echo '<li class="nav-item nav-cate" style="font-size:20px;background-color:#dee6e9; margin-bottom:2px; padding-left:8px;">
                                    <a class="nav-link" href="category.php?id='.$item['id'].'">'.$item['name'].'</a>
                                     </li>';
                                }
                            ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-9" style="display:flex;position: relative; margin-bottom:15px">
                        <div class="slider">
                            <div class="sliders">
                                <input type="radio" name="radio-btn" id="radio1">
                                <input type="radio" name="radio-btn" id="radio2">
                                <input type="radio" name="radio-btn" id="radio3">
                                <input type="radio" name="radio-btn" id="radio4">

                                <!-- slide imgstart -->
                                <div class="slide first">
                                    <img src="https://cdn.tgdd.vn/Files/2020/08/07/1277804/scar_800x450.jpg" alt="">
                                </div>
                                <div class="slide">
                                    <img src="https://s3.cloud.cmctelecom.vn/tinhte1/2016/05/3704044_image001.jpg" alt="">
                                </div>
                                <div class="slide">
                                    <img src="https://channel.mediacdn.vn/2019/1/10/photo-1-15470930389662024470690.jpg" alt="">
                                </div>
                                <div class="slide">
                                    <img src="https://cdn.tgdd.vn/Files/2019/10/26/1212545/chon-mua-laptop-choi-game-nen-mua-hang-nao-cau-hinh-bao-nhieu-la-du.jpg" alt="">
                                </div>
                                <!-- slide imgend -->
                                <!-- automatic navigation -->
                                <div class="navigation-auto">
                                    <div class="auto-btn1"></div>
                                    <div class="auto-btn2"></div>
                                    <div class="auto-btn3"></div>
                                    <div class="auto-btn4"></div>
                                </div>
                                <!-- automatic navigation -->
                            </div>
                            <!-- manual navigation -->
                            <div class="navigation-manualss">
                                <label for="radio1" class="manual-btn"></label>
                                <label for="radio2" class="manual-btn"></label>
                                <label for="radio3" class="manual-btn"></label>
                                <label for="radio4" class="manual-btn"></label>
                            </div>
                            <!-- manual navigation -->
                        </div>
                        
                    </div>
                </div>
                <div class="featured">
                    <?php
                        $sqlgetlistcate='select * from category';
                        $listcate=executeResult($sqlgetlistcate);
                        foreach($listcate as $cate)
                        {
                            echo '<div class="row featured-products" style="margin-top:15px; margin-bottom:15px">
                            <div style="padding: 5px 5px 15px 8px; border-bottom:2px solid #ccc; display:flex;font-size:18px;justify-content: space-between;">
                                <p style =" font-weight:bold; color:white;">Sản phẩm nổi bậc <span style="padding-left:18px; border-left:3px solid #ccc; margin-left:5px">'.$cate['name'].'</span> </p>
                                <a href="category.php?id='.$cate['id'].'" style="color:white; font-size:16px; text-decoration:none; padding-right:15px" >Xem chi tiết >></a>
                            </div>
                            <div class="col-xl-12" style="padding:15px">
                                 <div class="row" style:padding>';
                                    $sql='select *from product where id_category= '.$cate['id'].' limit 0 ,5 ';
                                    $list5product=executeResult($sql);
                                    foreach($list5product as $item)
                                    {
                                        echo '<div class ="l-2-4" style="font-size:16px; margin-bottom:14px">
                                        <div style="background-color:#ececec; padding:2px; border: 1px solid #eee; border-radius:6px; height:100% ">
                                        <a href="detail.php?id='.$item['id'].'"><img src="../../Admin/Product/'.$item['linkImg'].'" alt="img" style ="width: 100%"> </a>
                                        <a href="detail.php?id='.$item['id'].'" style="text-decoration: none; color: black; font-weight:500;">'.$item['title'].'</a>
                                        <p style="color:red; font-weight:bold">'.convertmoney($item['price']).' đ</p>
                                        </div>
                                        </div>';
                                    } echo'
                                 </div>
                            </div>
                        </div>';
                        }
                        
                    ?>
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
    <script type="text/javascript">
        var counter=1;
        setInterval(() => {
            document.getElementById('radio'+counter).checked=true;
            counter++;
            if(counter>4)
            {
                counter=1;
            }
        }, 3000);
    </script>
    <script src="./asssets/js/scrip.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>