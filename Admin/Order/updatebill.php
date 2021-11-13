<?php
require_once ('../../Database/db.php');
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
if(!empty($_POST))
{  
   $created=$update_at=date('Y-m-d H:s:i');
   if(isset($_POST['firstname']))
    {
        $firstname=$_POST['firstname'];
        $firstname=str_replace('"','//"',$firstname);
    }
    if(isset($_POST['lastname']))
    {
        $lastname=$_POST['lastname'];
        $lastname=str_replace('"','//"',$lastname);

    }
    if(isset($_POST['email']))
    {
        $email=$_POST['email'];
        $email=str_replace('"','//"',$email);

    }
    if(isset($_POST['phone']))
    {
        $phone=$_POST['phone'];
        $phone=str_replace('"','//"',$phone);

    }
    if(isset($_POST['address']))
    {
        $address=$_POST['address'];
        $address=str_replace('"','//"',$address);

    }
    if(isset($_POST['status']))
    {
        $status=$_POST['status'];
        $status=str_replace('"','//"',$status);

    }
    if(isset($_POST['idbill']))
    {
        $id=$_POST['idbill'];

    }
    $sqlguest="update guest set firstname ='".$firstname."' , lastname= '".$lastname."' , 
            email = '".$email."' , phone = '".$phone."' , address = '".$address."' where id_acc =".$idguest;
            execute($sqlguest);
    $sqlbill='update bill set status ="'.$status.'" where id='.$id;
    execute($sqlbill);
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Form Example</title>
      <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <!-- jQuery library -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

   <!-- Popper JS -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

   <!-- Latest compiled JavaScript -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
   <!-- sumernote -->
   <!-- include summernote css/js -->
   <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
   </head>
   <body>
   <ul class="nav nav-tabs">
	  <li class="nav-item">
	    <a class="nav-link" href="index.php">Quản Lý Danh Mục</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="../product/">Quản Lý Sản Phẩm</a>
	  </li>
	</ul>

	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Thêm Danh Mục</h2>
			</div>
	    </div>
    </div>
    <div class="container-fluid mt-3">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-row">
               <div class="form-group col-sm-3">
                  <label for="myCity">Tên khách hàng:</label>
                  <input type="text" class="form-control" id="myCity" name ="firstname" value= "<?=$firstname?>">
                  <input type="text" class="form-control" id="myCity" name ="idbill" value= "<?=$id?>" hidden="true">

               </div>
               
               <div class="form-group col-sm-2">
                  <label for="myZip">Họ</label>
                  <input type="text" class="form-control" id="myZip" name="lastname" value="<?=$lastname?>">
               </div>
               <div class="form-group col-sm-3">
                  <label for="myZip">Email</label>
                  <input type="text" class="form-control" id="myZip" name="email" value="<?=$email?>">
               </div>
               <div class="form-group col-sm-3">
                  <label for="myZip">Sdt</label>
                  <input type="text" class="form-control" id="myZip" name="phone" value="<?=$phone?>">
               </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-3">
                  <label for="myZip">Địa chỉ giao hàng</label>
                  <input type="text" class="form-control" id="myZip" name="address" value="<?=$address?>">
                </div>
                <div class="form-group col-sm-4">
                    <label for="myState">Trạng thái đơn hàng</label>
                    <select id="myState" class="form-control" required aria-label="select example" name ="status">
                        <option selected value ="<?=$status?>"><?=$status?></option>
                        <option value ="Đóng gói sản phẩm">Đóng gói sản phẩm</option>
                        <option value ="Đang vận chuyển">Đang vận chuyển</option>
                        <option value ="Giao hàng không thành công">Giao hàng không thành công</option>
                        <option value ="Giao hàng thành công">Giao hàng thành công</option>
                        <option value ="Hủy đơn">Hủy đơn</option>

                        
                        ?>
                    </select>
                </div>
                
            </div>
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
                                    $index = 1;
                                    $sql          = 'select * from bill where id ='.$id;
                                    $listbill = executeResult($sql);
                                    if($listbill !=null)
                                    {
                                        foreach ($listbill as $item) {
                                            $sqlgetprod='select * from product where id ='.$item['idproduct'];
                                            $product=executeSingleResult($sqlgetprod);
                                            $total += $item['count']*$product['price'];
                                            $dateorder=$item['dateorder'];
                                            echo '<tr>
                                                        <td>'.($index++).'</td>
                                                        <td>'.$product['title'].'</td>
                                                        <td>'.$item['count'].'</td>
                                                        <td>'.$product['price'].'</td>
                                                        
                                                    </tr>';
                                        }
                                    }
                                    
                                    ?>
                                </tbody>
                            </table>
                            <!-- <div style="font-size:18px; text-align:right; padding-right:15px">Ngày đặt hàng: <?=$dateorder?></div> -->
                            <div style="display:flex;font-size:16px; justify-content: space-between;">
                                <p style=" font-weight:600">Tổng tiền:  <span style=" color:red; font-weight:bold"><?=$total?></span></p>
                            </div>
                        </div>
                    </div>
            <button type="submit" name="submit" class="btn btn-primary" >Lưu</button>
         </form>
      </div>
      <script type="text/javascript">
      </script>
   </body>
</html>