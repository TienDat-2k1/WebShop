<?php
require_once ('../../Database/db.php');

$id=$name='';

if(!empty($_POST))
{
    if(isset($_POST['name']))
    {
        $name=$_POST['name'];
        $name=str_replace('"','//"',$name);

    }
    if(isset($_POST['id']))
    {
      $id =$_POST['id'];
      $id=str_replace('"','//"',$id);
    }
    if(!empty($name))
    {
      $create_at=$update_at=date('Y-m-d H:s:i');
      if($id == '')
      {
        $sql='insert into category(name,created_at,update_at)
        values("'.$name.'","'.@$create_at.'","'.$update_at.'")';
      }
      else{
        $sql ='update category set name ="'.$name.'", update_at="'.$update_at.'" where id ='.$id;
      }
      execute($sql);
      header('location: index.php');
      die();
    }
}
if (isset($_GET['id'])) {
	$id       = $_GET['id'];
	$sql      = 'select * from category where id = '.$id;
	$category = executeSingleResult($sql);
	if ($category != null) {
		$name = $category['name'];
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

    <title>Hello, world!</title>
  </head>
  <body>
    <ul class="nav nav-tabs">
    <li class="nav-item">
	    <a class="nav-link " href="../../FrontEnd/">HomePage</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="index.php">Quản Lý Danh Mục</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="../product/">Quản Lý Sản Phẩm</a>
	  </li>
    <li class="nav-item">
	    <a class="nav-link " href="../order/">Quản lý đơn hàng</a>
	  </li>
	</ul>

	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Thêm Danh Mục</h2>
			</div>
           <form method="post">
                <div class="form-floating mb-3">
                    <input type="text" name="id" value="<?=$id?>" hidden="true">
                    <input type="text" Required="true" class="form-control" id="name1" placeholder="Tên danh mục" name="name" value="<?=$name?>">
                    <label for="name1">Tên Danh Mục</label>
                </div>
                    <button class="btn btn-primary">Lưu</button>
           </form>
	    </div>
    </div>
    
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