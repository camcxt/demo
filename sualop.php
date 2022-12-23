<?php 
include('connect.php');
  

  if (isset($_POST['sualop'])) {
    $lopid = $_GET['lopid'];
     $tenlop= $_POST['tenlop'];
    $khoaid = $_POST['khoaid'];
   
   
    
/*$target_dir = "image/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file); ///anh='$target_file'*/
  
$sql="UPDATE lop SET tenlop='$tenlop',khoaid='$khoaid'
 Where lopid= '$lopid' ";
   // $sql= "UPDATE nhanvien SET TenNV='$TenNV',NgaySinh='$NgaySinh',DiaChi='$DiaChi',ChucVu='$ChucVu',
   //        Email='$Email',password='$password',Anh='$target_file'
   // WHERE MaNV='$MaNV'";
   $kq = mysqli_query($conn, $sql) or die ('Không thành công, yêu cầu làm lại ');
    if ($kq) {
      # code...
      } 
    header('location:htlophoc.php');
  
}else{

    $lopid = $_GET['lopid'];
    $sql = "SELECT * FROM lop inner join khoa on lop.khoaid=khoa.khoaid 
    WHERE lopid ='$lopid'";
    $kq =mysqli_query($conn, $sql) or die ('sửa dữ liệu thất bại');
  //kiểm tra dl truy vấn là gì ,kiểm tra biens sql, vì là môi lần là một bản ghi nên không cần vòng lặp gì cả
    $rs = mysqli_fetch_array($kq);
  }

// kiểm tra dl trả ra ntn

 ?>
 <h1>Cập nhật lớp học</h1>
 <form method="post">
 	<table>
 		<tr><td>Tên lớp</td>
 		<td><input type="text" name="tenlop"
 		value="<?php echo $rs['tenlop']; ?>"></td></tr>
    <tr><td>Tên khoa</td>
    <td> <select name="khoaid" style="width: 100%">
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

                          
                           
                        </select></td></tr>
 	
 		<tr><td colspan="2"><input type="submit" name="sualop"
 		value="Sửa"></td></tr>
 	</table>
 </form>
 <?php 
  include('connect.php');
  
  
  ?>