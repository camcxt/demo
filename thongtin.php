 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
      <link rel="stylesheet"  href="http://localhost/LOPPHP/buoi9_btcu/baitapmoi/css/bootstrap.css">

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
  <div class="" align="center">
<?php include('connect.php');
  $ten = $_GET['id'] ;
  $sql="SELECT * FROM sinhvien  WHERE ten='$ten'";
          $kq=mysqli_query($conn,$sql);
          if (mysqli_num_rows($kq) > 0) {
            {while ($row= mysqli_fetch_assoc($kq)) {
                  echo "<img align='center' class='rounded-circle' height='150px' width='150px' style='border-radius: 50%;'' src='".$row['anh']."'>";

                }
                }
          } ?>
  <div class="tb">
  <table border="1"  class="table-success"  align="center">
    <tr>
      <td>Họ Tên:</td>
      <td><?php echo $ten;  ?></td>
    </tr>
    <tr>
      <td>Lớp:</td>
      <td><?php
      $sql="SELECT * FROM sinhvien INNER JOIN lop on sinhvien.lopid=lop.lopid WHERE ten='$ten'";
          $kq=mysqli_query($conn,$sql);
          if (mysqli_num_rows($kq) > 0) {
            {while ($row= mysqli_fetch_assoc($kq)) {
                 echo $row['tenlop']; 
                }}}
         ?></td>
    </tr>
     <tr>
      <td>Địa Chỉ:</td>
      <td><?php
      $sql="SELECT * FROM sinhvien inner join xa on sinhvien.wardid=xa.wardid WHERE ten='$ten'";
          $kq=mysqli_query($conn,$sql);
          if (mysqli_num_rows($kq) > 0) {
            {while ($row= mysqli_fetch_assoc($kq)) {
                 echo $row['name']; 
                }}}
         ?></td>
    </tr>
    <tr>
      <td>Ngày sinh:</td>
      <td><?php
      $sql="SELECT * FROM sinhvien  WHERE ten='$ten'";
          $kq=mysqli_query($conn,$sql);
          if (mysqli_num_rows($kq) > 0) {
            {while ($row= mysqli_fetch_assoc($kq)) {
                 echo $row['ns']; 
                }}}
         ?></td>
    </tr>
    <tr>
      <td>Gioi tinh:</td>
      <td><?php
      $sql="SELECT * FROM sinhvien  WHERE ten='$ten'";
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