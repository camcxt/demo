<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php 
$del = (isset($_POST['del']))?$_POST['del']:'';
//var_dump($del); //biến mảng này thành 1 xâu dạng(,,,)
$strIn  = "";
$count  =1;
foreach ($del as $key => $value) {
	if ($count < sizeof($del)) {
		$strIn = $strIn.$value.',';

	} else {
		$strIn  =$strIn.$value;
	}
	$count++;
}
include('connect.php');
$sql_del = "delete from sinhvien where id in(".$strIn.")";
$kq = mysqli_query($conn, $sql_del);
 header('Location:htsinhvien.php');

 ?>
</body>
</html>