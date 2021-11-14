<?php

require_once ('../../Database/db.php');
require_once ('./asssets/function/convertmoney.php');
require_once ('./asssets/function/displayname.php');

$id='';
$idacc='';
$title='';
$pricie='';
$img='';
$listcart='';
if(isset($_COOKIE['id']))
{
    $idacc=$_COOKIE['id'];
    $sqllistcart= 'SELECT product.id, product.title, product.price, product.linkImg, cart.numprod FROM cart, product WHERE cart.id_acc = '.$idacc.' and product.id=cart.id_pro';
    $listcart= executeResult($sqllistcart);
}
                                    
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $sql= 'select * from product where id = '.$id;
    $product= executeSingleResult($sql);
    if($product !=null)
    {
        $title= $product['title'];
        $pricie= $product['price'];
        $img= $product['linkImg'];
    }
}
if (!empty($_POST)) {
	if (isset($_POST['action'])) {
		$action = $_POST['action'];
		switch ($action) {
			case 'delete':
				if (isset($_POST['id']) && isset($_POST['idacc'])) {
					$id = $_POST['id'];
                    $idacc=$_POST['idacc'];
					$sql = 'delete from cart where id_acc = '.$idacc.' and id_pro ='.$id;
					execute($sql);
				}
				break;
            case 'incre':
                if (isset($_POST['id']) && isset($_POST['idacc'])&& isset($_POST['num'])) {
                    $id = $_POST['id'];
                    $idacc=$_POST['idacc'];
                    $num = $_POST['num'];
                    $sql = 'update cart set numprod ='.($num+1).' where id_acc = '.$idacc.' and id_pro ='.$id;
                    execute($sql);
                }
                break;
            case 'decre':
                if (isset($_POST['id']) && isset($_POST['idacc'])&& isset($_POST['num'])) {
                    $id = $_POST['id'];
                    $idacc=$_POST['idacc'];
                    $num = $_POST['num'];
                    if(($num-1)<1)
                    {
                        $num=2;
                    }
                    $sql = 'update cart set numprod ='.($num-1).' where id_acc = '.$idacc.' and id_pro ='.$id;
                    execute($sql);
                }
                break;
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
                        <a class="nav-link" href="#" style="color: #000; font-weight:400 ;font-size:12px;">>> Giỏ hàng</a>
                    </li>
                </ul>
                </nav>
            </div>
            <div class="grid wide">
                <div class="row">
                    <div class="col-xl-8">
                        <?php
                        $total=0;
                        if($listcart !=null)
                        {
                            foreach($listcart as $item)
                            {
                                $total += $item['price']*$item['numprod'];
                                echo'<div class="row" style ="background-color: #d5d5d5; padding:10px 2px; margin-bottom:15px" >
                                <div class="col-xl-2">
                                    <img src="../../Admin/Product/'.$item['linkImg'].'" alt="img" style="max-width:100%; display:block;height:100%;border-radius: 2px;">
                                </div>
                                <div class="col-xl-7">
                                     <span style="display:inline-block; white-space: nowrap; width:100%; height:28px;text-overflow: ellipsis;overflow: hidden; font-size:18px">
                                         '.$item['title'].'
                                    </span>
                                    
                                    <form method="POST" action="" style="display: flex">
                                        <div style ="width:120px; display:flex; height:30px;font-size:18px;">
                                            <button id="decre"onclick="decreP('.$item['id'].','.$idacc.','.$item['numprod'].')" style="border-right: 0px;">-</button>
                                            <input type="text" name="num" value="'.$item['numprod'].'" id="num">
                                            <button id="incre" onclick="increP('.$item['id'].','.$idacc.','.$item['numprod'].')" style="border-left: 0px;">+</button>
                                        </div>
                                        <button onclick="deletePcart('.$item['id'].','.$idacc.')" style="margin-left:20px; width:40px; border-radius:10px; font-weight:600; font-size:14px">Xóa</button>
                                    </form>
                                </div>
                                <div class="col-xl-3">
                                    <span style="font-size:20px; font-weight:bold; color:black; float:right; padding-right:10px">'.convertmoney($item['price']).'</span>
                                </div>
                            </div>';
                            }
                        }
                        ?>
                             
                    </div>
                    <div class="col col-xl-4 col-md-0">
                        <div class="">
                            <div style="width:100%">
                                <p class="Price_cart"><?=convertmoney($total) ?></p>
                            </div>
                            <div style="margin-top:140px; height:72px">
                                <button onclick="direct()" class="btn btn-primary" style="width:100%; height:100%; border-radius:10px; font-size:32px; font-weight:600">Thanh toán</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer"></div>
    </div>
    <script type="text/javascript">
    // let btnDecre=document.querySelector("#decre"); 
    // let input=document.querySelector("#num");
    // let btnIncre=document.querySelector("#incre"); 
    // btnDecre.addEventListener('click',()=>
    // {
    //     input.value=parseInt(input.value)-1;
    // });  
    // btnIncre.addEventListener('click',()=>
    // {
    //     input.value=parseInt(input.value)+1;
    // });  
    function deletePcart(id, idacc) {
      console.log(id);
      console.log(idacc);
		var option=confirm('Bạn có chắc chắn muốn xóa không?');
		if(!option)
		{
			return;
		}
	  $.post('',{
		  'id': id,
          'idacc': idacc,
		  'action': 'delete'
	  }, function(data)
	  {
		location.reload();
	  })
    }   
    function increP(id, idacc, num) {
      console.log(id);
      console.log(idacc);
      console.log(num);
	  $.post('',{
		  'id': id,
          'idacc': idacc,
          'num':num,
		  'action': 'incre'
	  }, function(data)
	  {
		location.reload();
	  })
    }   
    function decreP(id, idacc, num) {
      console.log(id);
      console.log(idacc);
      console.log(num);
	  $.post('',{
		  'id': id,
          'idacc': idacc,
          'num':num,
		  'action': 'decre'
	  }, function(data)
	  {
		location.reload();
	  })
    } 
    function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
    }
    function direct(){
        var username=getCookie("id");
       if(username!="")
       {
           location.replace("pay.php");
       }
       else
            location.replace("login.php");
     }     
    </script>
    <script src="./asssets/js/scrip.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>