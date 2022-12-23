<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  
  <style>
    .tt{
      width: 200px;
      padding-left: 100px;
    }
    .tb{
      padding-top: 50px;
    }
    .tb td{
      padding-left: 20px;
      padding-top: 20px;
    }
  </style>
 
  <div class="tb">
  <table border="1" >
  <tr>Danh sách sinh viên</tr>
  <tr>
    <td>Họ tên</td>
    <td>Ngày sinh</td>
    <td>Địa chỉ</td>
    <td>Giới tính</td>

  </tr>
    <tr>
     
      <td><?php
      include('connect.php');
      $tenlop= $_GET['tenlop'];
      $sql="SELECT * FROM lop INNER JOIN sinhvien on lop.lopid=sinhvien.lopid WHERE tenlop='$tenlop'";
          $kq=mysqli_query($conn,$sql);
          if (mysqli_num_rows($kq) > 0) {
            {while ($row= mysqli_fetch_assoc($kq)) {
                 echo $row['ten']; 
                }}}
         ?></td>
    
      
      <td><?php
       include('connect.php');
      $sql="SELECT * FROM lop INNER JOIN sinhvien on lop.lopid=sinhvien.lopid WHERE tenlop='$tenlop'";
          $kq=mysqli_query($conn,$sql);
          if (mysqli_num_rows($kq) > 0) {
            {while ($row= mysqli_fetch_assoc($kq)) {
                 echo $row['ns']; 
                }}}
         ?></td>
  
      
      <td><?php
       include('connect.php');
      $sql="SELECT * FROM ((lop INNER JOIN sinhvien on lop.lopid=sinhvien.lopid) inner join xa on sinhvien.wardid=xa.wardid )WHERE tenlop='$tenlop'";
          $kq=mysqli_query($conn,$sql);
          if (mysqli_num_rows($kq) > 0) {
            {while ($row= mysqli_fetch_assoc($kq)) {
                 echo $row['name']; 
                }}}
         ?></td>
   
      
      <td><?php
       include('connect.php');
      $sql="SELECT * FROM lop INNER JOIN sinhvien on lop.lopid=sinhvien.lopid WHERE tenlop='$tenlop'";
          $kq=mysqli_query($conn,$sql);
          if (mysqli_num_rows($kq) > 0) {
            {while ($row= mysqli_fetch_assoc($kq)) {
                 echo $row['gt']; 
                }}}
         ?></td>
    </tr>
   
  </table>
  </div>
  </div>
</body>
</html>