<!DOCTYPE html>
<html>
<head>
	<title>Sinh viên</title>
    <link rel="stylesheet"  href="http://localhost/LOPPHP/buoi9_btcu/baitapmoi/css/bootstrap.css">


</head>
<body>

 <form method="post" >
  <input type="text" name="keyword" width="300px" ><input type="submit" name="search">
<table  width="600px" border="1" class="table-danger">
<tr bgcolor="blue" style="color: white" > 
      <th>STT</th>
      <th>Ten lop</th>
      <th>Khoa</th>
      <th>Tên nhân viên</th>
      <th>Địa chỉ</th>
      <th>Date</th>
      <th>GT</th>
      </tr>
      <?php 
if(isset($_POST['search'])){
    if($_POST['keyword'] == ""){
      echo "Vui lòng nhập từ cần tìm!";
    }
    else{
      $keyword= $_POST['keyword'];
    
    include('connect.php');


     $sql= "SELECT *FROM ((((sinhvien INNER JOIN lop on sinhvien.lopid= lop.lopid ) 
  inner join khoa on sinhvien.khoaid = khoa.khoaid )
  inner join xa on sinhvien.wardid= xa.wardid)
   inner join huyen on xa.districtid= huyen.districtid) inner join tinh on huyen.provinceid = tinh.provinceid
   where  (ten like '%$keyword%') /*or (tenlop like '%keyword%') or (tenkhoa like '%keyword%'*/ ";
   $query= mysqli_query($conn, $sql);

    if(mysqli_num_rows($query) != ""){
              $id=0;
              while($row= mysqli_fetch_array($query)){
                $id++;
                echo "<tr>";
      
   echo "<td>".$id."</td>";
   echo "<td>".$row['tenlop']."</td>";
   echo "<td>".$row['tenkhoa']."</td>";
    echo "<td>".$row['ten']."</td>";
echo "<td>".$row['name']."," .$row['tenhuyen']."," .$row['tentinh']."</td>";    echo "<td>".$row['ns']."</td>";
    echo "<td>".$row['gt']."</td>";

      
           }
  
  }
}
} 
?>
</table>
</form>


 
<form method="post" action="xoanhieu.php">
	<table border="1" align="center" style="margin-top: 50px" width="800px"> 
		<tr>
    

   
    </tr>
		<tr><td colspan="10" align="center" style="font-size: 20px; color: white; background-color: navy">Tổng số sinh viên</td></tr>
		<tr><td colspan="10"><a href="themsv.php">Thêm mới</a><input type="submit" name="xoanhieu" value="Xoá theo lựa chọn"> </td></tr>
		<tr style="background-color: blue; color:white;">
		<th>STT</th>
		<th>Lớp</th>
    <th>Khoa</th>
		<th>Họ tên</th>
		<th>Địa chỉ</th>
		<th>Ngày sinh</th>
		<th>Giới tính</th>
    <th>Anh</th>
		<th>Xóa</th>
    <th>Sửa</th></tr>

<?php 
  include('connect.php');
  $sql= "SELECT *FROM ((((sinhvien INNER JOIN lop on sinhvien.lopid= lop.lopid ) 
  inner join khoa on sinhvien.khoaid = khoa.khoaid )
  inner join xa on sinhvien.wardid= xa.wardid)
   inner join huyen on xa.districtid= huyen.districtid) inner join tinh on huyen.provinceid = tinh.provinceid ";
  $kq = mysqli_query($conn, $sql);	
  if(mysqli_num_rows($kq)>0){
  	$id=0;
  	while($row = mysqli_fetch_assoc($kq)){
      ?>
<tr>
  <td><?=++$id;?></td>
  <td><?=$row['tenlop']?></td>
   <td><?=$row['tenkhoa']?></td>
   <td><a href="thongtin.php?id=<?=$row['ten']?>"><?=$row['ten']?></a></td>  <!-- để ý cái id ở dòng này -->
   <td><?=$row['name']?>,<?=$row['tenhuyen']?>,<?=$row['tentinh']?></td>
   <td><?=$row['ns']?></td>
   <td><?=$row['gt']?></td>
   <td><img width="100px"  src="<?=$row['anh']?>"></td>
 <td><a href="xoanhieu.php?id=<?=$row['id']?>"><input type="checkbox" name="del[]" value="<?=$row['id']?>"><img src="image/delete.jpg" width="15px"></a></td>
 <td><a href="suasv.php?id=<?=$row['id']?>"><img src="image/edit.jpg" width="20px"></a></td>

   

</tr>

<?php 
}
}
else { }

 ?>
	</table>
</form>



<a href="http://localhost/LOPPHP/buoi9_btcu/baitapmoi/htlophoc.php"><input type="submit" name="chuyentrang" value="lophoc"></a>



<div class="container">
  <div class="row">
    <div class="col-sm-4"></div>
  </div>
</div>

</body>
</html>
<!-- 
  11.1 import export database, lấy mã nguồn
  11.2 thử upload ảnh
  11.3 sửa ảnh
  11.4 sửa lỗi ko cập nhật giới tính
-->