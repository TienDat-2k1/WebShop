<?php
require_once ('../../Database/db.php');
require_once ('../../FrontEnd/HomePage/asssets/function/convertmoney.php');
$firstname= '';
$lastname= '';
$email= '';
$phone= '';
$address='';
$status='';
$total=0;
$idguest='';
$id='';
if(isset($_GET['id']))
{
   $id=$_GET['id'];
   $sql='select * from bill where id = '.$id;
   $bill=executeSingleResult($sql);
   if($bill != null)
   {
      $idguest=$bill['idguest'];
      $status=$bill['status'];
   }
   if(!empty($idguest))
   {
       $sql='select *from guest where id_acc='.$idguest;
       $guest=executeSingleResult($sql);
       if($guest!=null)
       {
            $firstname=$guest['firstname'];
            $lastname=$guest['lastname'];
            $phone=$guest['phone'];
            $email=$guest['email'];
            $address=$guest['address'];

       }
   }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <title>Hello, world!</title>
  </head>
  <body>
	<div class="container">
		<div class="panel panel-primary">
			<div class="grid wide" style="display:flex; justify-content: center;">
                <div style="text-align:center; padding:15px; display:inline-block;border-radius:5px">
                    <p class="headerShop">CỬA HÀNG REROLLACC CHUYÊN CUNG CẤP CÁC SẢN PHẨM LAPTOP</p>
                    <h1 style="font-size:35px">HÓA ĐƠN MUA HÀNG</h1>
                    <h2 style="font-size:20px">KHÁCH HÀNG: <?=($guest['lastname'].' '.$guest['firstname'])?></h2>
                    <h2 style="font-size:20px">Số Điện Thoại: <?=$guest['phone']?></h2>

                    <h3 class="address">Địa chỉ: Số 10-Dường 231A-Phường Tân Phú-Quận 9</h3>
                    <h3 class="address">Địa chỉ giao hàng: <?=$guest['address']?> </h3>

                    <div class="row justify-content-center">
                        <div class="col-xl-8">
                            <table class="table table-bordered table-hover" style="font-size:16px; margin-top:24px">
                                <thead>
                                    <tr>
                                        <th width="50px">STT</th>
                                        <th>Tên Sản phẩm</th>
                                        <th width="80px">Số lượng</th>
                                        <th >Giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //Lay danh sach danh muc tu database
                                    $sql          = 'select * from bill where id ='.$id;
                                    $lbill = executeResult($sql);

                                    $index = 1;
                                    foreach ($lbill as $item) {
                                        $status=$item['status'];
                                        $sqlgetprod='select *from product where id ='.$item['idproduct'];
                                        $product=executeSingleResult($sqlgetprod);
                                        $total += $item['count']*$product['price'];
                                        $dateorder=$item['dateorder'];
                                        echo '<tr>
                                                    <td>'.($index++).'</td>
                                                    <td>'.$product['title'].'</td>
                                                    <td>'.$item['count'].'</td>
                                                    <td>'.convertmoney($product['price']).'</td>
                                                    
                                                </tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div style="font-size:18px; text-align:right; padding-right:15px">Ngày đặt hàng: <?=$dateorder?></div>
                            <div style="display:flex;font-size:16px; flex-direction:row-reverse; margin-top:20px; font-size:24px">
                                <p style=" font-weight:600;">Tổng tiền:  <span style=" color:red; font-weight:bold"><?=convertmoney($total)?></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
  <script type="text/javascript">
  </script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>