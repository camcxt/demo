<?php 
include('connect.php');
  

  if (isset($_POST['suasv'])) {
    $id = $_GET['id'];
    $lopid= $_POST['lopid'];
    $khoaid = $_POST['khoaid'];
   
    $ten = $_POST['ten'];
        $wardid = $_POST['wardid']; 
   // $dc = $_POST['dc'];
    $ns = $_POST['ns'];

    $gt = $_POST['gt'];
    $anhcu = $_POST['anhcu'];
    
    $target_dir = "image/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    // if(isset($_POST["suasv"])) {
    //   $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    //   if($check !== false) {
    //     echo "File is an image - " . $check["mime"] . ".";
    //     $uploadOk = 1;
    //   } else {
    //     echo "File is not an image.";
    //     $uploadOk = 0;
    //   }
    // }
    
    // Check if file already exists
    // if (file_exists($target_file)) {
    //   echo "Sorry, file already exists.";
    //   $uploadOk = 0;
    // }
    
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
    $imagePath="";
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
      $imagePath = $anhcu;
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    
      $imagePath = $target_dir.basename( $_FILES["fileToUpload"]["name"]);
    }

   
  /*lấy đường dẫn ảnh*/

$sql="UPDATE sinhvien SET lopid='$lopid',khoaid='$khoaid',ten ='$ten',wardid ='$wardid',ns='$ns',gt='$gt',anh='$imagePath'
 Where id= '$id' ";
   // $sql= "UPDATE nhanvien SET TenNV='$TenNV',NgaySinh='$NgaySinh',DiaChi='$DiaChi',ChucVu='$ChucVu',
   //        Email='$Email',password='$password',Anh='$target_file'
   // WHERE MaNV='$MaNV'";
   $kq = mysqli_query($conn, $sql) or die ('Không thành công, yêu cầu làm lại ');
    if ($kq) {
      # code...
      } 
    header('location:htsinhvien.php');
  
}else{

    $id = $_GET['id'];
    $sql = "SELECT * FROM sinhvien inner join khoa on sinhvien.khoaid=khoa.khoaid inner join lop on sinhvien.lopid = lop.lopid 
    WHERE id ='$id'";
    $kq =mysqli_query($conn, $sql) or die ('sửa dữ liệu thất bại');
  //kiểm tra dl truy vấn là gì ,kiểm tra biens sql, vì là môi lần là một bản ghi nên không cần vòng lặp gì cả
    $rs = mysqli_fetch_array($kq);
  }

// kiểm tra dl trả ra ntn

 ?>
 <h1>Cập nhật dữ liệu sinh viên</h1>
 <form method="post" enctype="multipart/form-data" >
  <table>
  <tr><td colspan="2"><input type="submit" name="suasv"
    value="Sửa"></td></tr>
    <tr><td>Tên lớp</td> 
     <td >
                        <select name="lopid" style="width: 100%">
                        <?php
                        include('connect.php');
                      $sql="SELECT * FROM lop";
                                $kq=mysqli_query($conn,$sql);
                                while ($row=mysqli_fetch_array($kq)) {
                                  if ($row['tenlop'] == $rs['tenlop']) {
                                    # code...
                                    echo "<option value=".$row['lopid']." selected >".$row['tenlop']."</option>";
                                  } else {
                                    # code...
                                    echo "<option value=".$row['lopid'].">".$row['tenlop']."</option>";
                                  }
                                  
                                }
                            ?>
                    </select>
                    </td>
   <!--  <td><input type="text" name="tenlop"
    value="<?php echo $rs['tenlop']; ?>"></td> --></tr>
    <tr><td>Tên khoa</td>
    <td >
                        <select name="khoaid" style="width: 100%">
                        <?php
                        include('connect.php');
                      $sql="SELECT * FROM khoa";
                                $kq=mysqli_query($conn,$sql);
                                while ($row=mysqli_fetch_array($kq)) {
                                  if ($row['tenkhoa'] == $rs['tenkhoa']) {
                                    echo "<option value=".$row['khoaid']." selected >".$row['tenkhoa']."</option>";
                                  } else {
                                   echo "<option value=".$row['khoaid'].">".$row['tenkhoa']."</option>";
                                  } 
                                }
                            ?>

                          
                           
                        </select>
                    </td>
    <!-- <td><input type="text" name="tenkhoa"
    value="<?php echo $rs['tenkhoa']; ?>"></td> -->
    <tr><td>Họ tên</td>
    <td><input type="text" name="ten"
    value="<?php echo $rs['ten']; ?>"></td></tr>
    <tr><td>Ngày sinh</td>
    <td><input type="date" name="ns"
    value="<?php echo $rs['ns']; ?>"></td></tr>
    <tr><td>Giới tính</td>
    <td>
    <?php 
      $checkedNam = "";
      $checkedNu = "";
      if ($rs['gt'] == 'Nam') {
        # code...
        $checkedNam = "checked";
        $checkedNu = "";
      } else {
        # code...
        $checkedNu = "checked";
        $checkedNam = "";
      }
      
     ?>
    <input type="radio" name="gt" value="Nam" <?php echo $checkedNam ?>>Nam
    <input type="radio" name="gt" value="Nu" <?php echo $checkedNu ?>>Nu</td></tr>
    <tr>
                <td class="a1">Ảnh:</td>
                <td class="a2">
                  <input  type="file" name="fileToUpload" >
                  <input type="hidden" name="anhcu" value="<?= $rs['anh'] ?>">
                  <br>
                <img src="<?= $rs['anh'] ?>" alt="" width="100px"></td>
            </tr>
    <tr><td>Địa chỉ</td>
    <td>    <select name="wardid">
                        <?php
                        include('connect.php');
                      $sql="SELECT * FROM xa";
                                $kq=mysqli_query($conn,$sql);
                                while ($row=mysqli_fetch_array($kq)) {
                                  if ($row['name'] == $rs['name']) {
                                    echo "<option value=".$row['wardid']." selected >".$row['name']."</option>";
                                  } else {
                                   echo "<option value=".$row['wardid'].">".$row['name']."</option>";
                                  } 
                                }
                            ?> 
                            </select></td></tr>
    
  
    
  </table>
 </form>
 