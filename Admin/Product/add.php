<?php
require_once ('../../Database/db.php');
$title= '';
$idcatg= '';
$price= '';
$content= '';
$idproduct='';
$linkImg='';
$amount='';
$flag=true;
$flag_temp='';
if(!empty($_POST))
{  
   $created=$update_at=date('Y-m-d H:s:i');
   if(isset($_POST['title']))
    {
        $title=$_POST['title'];
        $title=str_replace('"','//"',$title);
    }
    if(isset($_POST['price']))
    {
        $price=$_POST['price'];
        $price=str_replace('"','//"',$price);

    }
    if(isset($_POST['content']))
    {
        $content=$_POST['content'];
        $title=str_replace('"','//"',$title);

    }
    if(isset($_POST['idproduct']))
    {
        $idproduct=$_POST['idproduct'];
        $idproduct=str_replace('"','//"',$idproduct);

    }
    if(isset($_POST['linkImg']))
    {
        $linkImg=$_POST['linkImg'];
        $linkImg=str_replace('"','//"',$linkImg);

    }
    if(isset($_POST['idcatg']))
    {
        $idcatg=$_POST['idcatg'];
        $idcatg=str_replace('"','//"',$idcatg);

    }
    if(isset($_POST['amount']))
    {
        $amount=$_POST['amount'];
        $amount=str_replace('"','//"',$amount);

    }
   if(isset($_FILES["fileToUpload"]))
   {
      if($_FILES['fileToUpload']['error']>0) {
			if($idproduct=='')
         {
            $sql='insert into product(title,price,content,amount,id_category,created_at,update_at)
                  value ("'.$title.'","'.$price.'","'.$content.'","'.$amount.'","'.$idcatg.'","'.$created.'","'.$update_at.'")';
            execute($sql);
            header('location: index.php');
            die();
         }
         elseif($idcatg != -1 && $title !='' && $price !='' && $amount>=0)
         {
            $sql ='update product set title ="'.$title.'",price ="'.$price.'",content ="'.$content.'",amount ="'.$amount.'",id_category ="'.$idcatg.'", update_at="'.$update_at.'" where id ='.$idproduct;
            execute($sql);
            header('location: index.php');
            die();
         }
         else {
            echo '<script language="javascript">';
            echo 'alert("Có lỗi về thông tin !! Vui lòng kiểm tra lại!!")';
            echo '</script>';
         }
		}
      else{
         $target_dir = "Img_Product/";
         $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
         $uploadOk = 1;
         $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

         // Check if image file is a actual image or fake image
         if(isset($_POST["submit"])) {
         $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
         if($check !== false) {
         // echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
         } else {
          $uploadOk = 0;
            }
         }
         // Check if file already exists
         if (file_exists($target_file)) {
         //echo "Sorry, file already exists.";
         $uploadOk = 0;
         }
         // Check file size
         if ($_FILES["fileToUpload"]["size"] > 500000) {
         //echo "Sorry, your file is too large.";
         $uploadOk = 0;
         }
         // Allow certain file formats
         if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
         && $imageFileType != "gif" ) {
         //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
         $uploadOk = 0;
         }
         //echo $target_file;
         // Check if $uploadOk is set to 0 by an error
         if ($uploadOk == 0) {
            echo '<script language="javascript">';
            echo 'alert("Lỗi: File không đúng định dạng hoặc kích thước quá lớn!! Vui lòng kiểm tra lại")';
            echo '</script>';
         //echo "Sorry, your file was not uploaded.";
         // if everything is ok, try to upload file
         } else {
            if($idproduct=='')
            {
               if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                  
                  //  echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                  $sql='insert into product(title,linkImg,price,content,amount,id_category,created_at,update_at)
                  value ("'.$title.'","'.$target_file.'","'.$price.'","'.$content.'","'.$amount.'","'.$idcatg.'","'.$created.'","'.$update_at.'")';
                  execute($sql);
                  header('location: index.php');
                  die();
               }
            }
            elseif($idcatg != -1 && $title !='' && $price !='' && $amount >=0)
            {
               if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                  unlink($linkImg);
                  //  echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                  $sql ='update product set title ="'.$title.'",linkImg ="'.$target_file.'",price ="'.$price.'",content ="'.$content.'",amount ="'.$amount.'",id_category ="'.$idcatg.'", update_at="'.$update_at.'" where id ='.$idproduct;
                  execute($sql);
                  header('location: index.php');
                  die();
               }
            }
            else {
               echo '<script language="javascript">';
               echo 'alert("Có lỗi về thông tin !! Vui lòng kiểm tra lại!!")';
               echo '</script>';
            }
         }
      }
      
   }
}
if(isset($_GET['id']))
{
   $idproduct=$_GET['id'];
   $sql='select * from product where id = '.$idproduct;
   $product=executeSingleResult($sql);
   if($product != null)
   {
      $title= $product['title'];
      $price=$product['price'];
      $linkImg=$product['linkImg'];
      $content=$product['content'];
      $idcatg=$product['id_category'];
      $amount=$product['amount'];
   }
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
        <h4 class="mb-2">Complex Form</h4>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-row">
               <div class="form-group col-sm-6">
                  <label for="myCity">Tiêu Đề</label>
                  <input type="text" class="form-control" id="myCity" name ="title" value= "<?=$title?>">
                  <input type="text" class="form-control" id="myCity" name ="idproduct" value= "<?=$idproduct?>" hidden="true">
                  <input type="text" class="form-control" id="myCity" name ="linkImg" value= "<?=$linkImg?>" hidden="true" >

               </div>
               <div class="form-group col-sm-2">
                  <label for="myState">Danh Mục</label>
                  <select id="myState" class="form-control" required aria-label="select example" name ="idcatg">
                    <option selected value ="-1"></option>
                    <?php
                       $sql          = 'select * from category';
                       $categoryList = executeResult($sql);
                       foreach ($categoryList as $item) {
                          if($idcatg==$item['id'])
                          {
                           echo '<option value="'.$item['id'].'" selected="selected">'.$item['name'].'</option>';
                          }
                          else{
                             echo '<option value="'.$item['id'].'">'.$item['name'].'</option>';

                          }
                       }
                    ?>
                  </select>
               </div>
               <div class="form-group col-sm-2">
                  <label for="myZip">Giá</label>
                  <input type="text" class="form-control" id="myZip" name="price" value="<?=$price?>">
               </div>
               <div class="form-group col-sm-2">
                  <label for="myZip">Số lượng</label>
                  <input type="number" class="form-control" id="myZip" name="amount" value="<?=$amount?>">
               </div>
            </div>
            <div class="input-group mb-3">
                 <div class="input-group-prepend">
                    <span class="input-group-text">Upload</span>
                </div>
                 <div class="custom-file">
                     <input type="file" class="custom-file-input" id="inputGroupFile01" name="fileToUpload">
                     <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
            </div>
            <?php
               if($flag)
               {
                  echo '<img src="'.$linkImg.'" alt="" style="max-width:200px;padding-bottom:20px;">';
               }
            ?>
            
            <div class="form-group" style= "display:flex; flex-direction:column">
                <label for="exampleFormControlTextarea1">Nội dung</label>
                <textarea  rows="5" name="content" ><?php echo htmlspecialchars($content);?></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary" >Lưu</button>
         </form>
      </div>
      <script type="text/javascript">
      </script>
   </body>
</html>