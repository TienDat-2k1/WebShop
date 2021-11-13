<?php
require_once ('../../Database/db.php');
require_once ('../../common/utility.php');
require_once ('../../FrontEnd/HomePage/asssets/function/convertmoney.php');

$number=0;
$id='';
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
    <ul class="nav nav-tabs">
	  <li class="nav-item">
	  <li class="nav-item">
	    <a class="nav-link " href="../../FrontEnd/">HomePage</a>
	  </li>
	    <a class="nav-link" href="../Category">Quản Lý Danh Mục</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link active" href="#">Quản Lý Sản Phẩm</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="../Order">Quản Lý Đơn Hàng</a>
	  </li>
	</ul>

	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Quản Lý Sản Phẩm</h2>
			</div>
			<div class="panel-body">
				<form action="" method="get" style="margin-bottom:15px;">
				<div class="row select-category" style="position:relative;">
					<div class="col-xl-11">
						<option>Chọn Danh Mục Của Sản Phẩm</option>
						<select name= "cate" class="form-select" aria-label="Default select example">
						<option selected value="-1" ></option>
						<?php
							$sql          = 'select * from category';
							$categoryList = executeResult($sql);
							foreach ($categoryList as $item) {
							echo '<option value="'.$item['id'].'">'.$item['name'].'</option>';
							}
						?>
						</select>
					</div>
					<button type="submit" class="col-xl-1 btn btn-primary"style="height:40px; position:absolute;bottom:0;right:0" >Xem</button>
				</div>
				</form>
				<div class="row">
					<div class="col-xl-6">
						<a href="add.php">
						<button class="btn btn-success" >Thêm Sản Phẩm</button>
						</a>
					</div>
					<div class="col-xl-6">
						<form action="" method="get">
							<div class="input-group mb-3">
								<input type="text" class="form-control" id="s" name="s" placeholder="Search">
							</div>
						</form>
					</div>
				</div>
				
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="50px">STT</th>
							<th>Hình ảnh</th>
							<th width="650px">Tên Sản Phẩm</th>
							<th width="140px">Giá bán</th>
							<th width="100px">Số lượng</th>
							<th width="180px">Ngày cập nhật</th>
							<th width="50px"></th>
							<th width="50px"></th>
						</tr>
					</thead>
					<tbody>
<?php
$limit=10;
$page=1;
$s='';
$additional='';
if(isset($_GET['s']))
{
	$s=$_GET['s'];
}
if(!empty($_GET))
{
	if(isset($_GET['page']))
	{
		$page=$_GET['page'];
	}
	if($page <0)
	{
		$page=1;
	}
	$firtindex=($page -1)*$limit;
	if(isset($_GET['cate']))
	{
		$id=$_GET['cate'];
		if(!empty($s))
		{
			$additional=' and name like "%'.$s.'%"';
		}
//Lay danh sach danh muc tu database
$sql          = 'select * from product where id_category='.$id.' limit '.$firtindex.' , '.$limit;
$categoryList = executeResult($sql);
$sql= 'select count(id) as total from product where id_category='.$id;
$countResult=executeSingleResult($sql);
$count=$countResult['total'];
$number= ceil($count/$limit);
$index = 1;
foreach ($categoryList as $item) {
	echo '<tr>
				<td>'.($index++).'</td>
				<td><img src= "'.$item['linkImg'].'"style="max-width:100px"/></td>
				<td>'.$item['title'].'</td>
				<td>'.convertmoney($item['price']).'</td>
				<td>'.$item['amount'].'</td>
				<td>'.$item['update_at'].'</td>

				<td>
					<a href="add.php?id='.$item['id'].'"><button class="btn btn-warning">Sửa</button></a>
				</td>
				<td>
					<button class="btn btn-danger" onclick="deleteProduct('.$item['id'].')">Xoá</button>
				</td>
			</tr>';
		}
	}
}
?>
					</tbody>
				</table>
				<!-- page -->
				<?=paginarion($number,$page,'&cate='.$id,'')?>
			</div>
		</div>
	</div>
  <script type="text/javascript">
    function deleteProduct(id) {
      console.log(id);
		var option=confirm('Bạn có chắc chắn muốn xóa không?');
		if(!option)
		{
			return;
		}
		// $.ajax({
        //     type : "POST",  //type of method
        //     url  : "process.php",  //your page
        //     data : { id : id, action : 'delete'},// passing the values
        //     success: function(res){  
		// 		location.reload();
        //                             //do what you want here...
        //             }
        // });
	  $.post('process.php',{
		  'id': id,
		  'action': 'delete'
	  }, function(data)
	  {
		location.reload()
	  })
    } 
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