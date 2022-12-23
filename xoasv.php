<!-- <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="refresh" content="3 url=http://localhost/LOPPHP/buoi9_btcu/baitapmoi/htsinhvien.php" >
	<title></title>
</head>
<body>
	<?php 
	include_once('connect.php');
	$id = $_GET['id'];
	$sql="Delete From sinhvien where id = '$id'";
				$kq=mysqli_query($conn,$sql);
				if ($kq) {
					header("http://localhost/LOPPHP/buoi9_btcu/baitapmoi/htsinhvien.php");
				}
	 ?>
</body>
</html> -->