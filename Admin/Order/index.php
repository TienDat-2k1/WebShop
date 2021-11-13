<?php
require_once ('../../Database/db.php');
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
	    <a class="nav-link " href="../category/">Quản Lý Danh Mục</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="../product/">Quản Lý Sản Phẩm</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link active" href="#">Quản Lý Đơn Hàng</a>
	  </li>
	</ul>

	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Quản Lý Đơn Hàng</h2>
			</div>
			<div class="panel-body">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="50px">STT</th>
							<th>Mã đơn hàng</th>
                            <th>Tình trạng đơn hàng</th>
                            <th>Ngày đặt hàng</th>
                            <th width="50px"></th>
							<th width="110px"></th>
							<th width="50px"></th>
						</tr>
					</thead>
					<tbody>
<?php
//Lay danh sach danh muc tu database
$sql          = 'select * from bill';
$categoryList = executeResult($sql);

$index = 1;
$idtemp=-1;
foreach ($categoryList as $item) {
    if($idtemp !=$item['id'])
    {
        echo '<tr>
                    <td>'.($index++).'</td>
                    <td>'.$item['id'].'</td>
                    <td>'.$item['status'].'</td>
                    <td>'.$item['dateorder'].'</td>
                    <td>
                        <a href="infobill.php?id='.$item['id'].'"><button class="btn btn-success">Xem</button></a>
                    </td>
                    <td>
                        <a href="updatebill.php?id='.$item['id'].'"><button class="btn btn-warning">Cập nhật</button></a>
                    </td>
                    <td>
                        <button class="btn btn-danger" onclick="deleteCategory('.$item['id'].')">Xoá</button>
                    </td>
                </tr>';

                $idtemp=$item['id'];
    }
}
?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
  <script type="text/javascript">
    // function deleteCategory(id) {
    //   console.log(id);
	// 	var option=confirm('Bạn có chắc chắn muốn xóa không?');
	// 	if(!option)
	// 	{
	// 		return;
	// 	}
	//   $.post('process.php',{
	// 	  'id': id,
	// 	  'action': 'delete'
	//   }, function(data)
	//   {
	// 	location.reload()
	//   })
    // } 
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