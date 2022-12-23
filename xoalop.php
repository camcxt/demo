<?php 
include('connect.php');
$lopid = $_GET['lopid'];
$sql ="DELETE  FROM lop where lopid ='$lopid'";
mysqli_query ($conn,$sql) or die ('xóa dữ liệu thất bại');
header('location:htlophoc.php');
 ?>
 