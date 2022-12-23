<!DOCTYPE html>
<html>
<head>
  <title>Lớp học</title>

</head>
<body>

 <form method="post" >
  <input type="text" name="keyword" width="300px" ><input type="submit" name="search">
<table  width="600px" border="1">
<tr bgcolor="blue" style="color: white" > 
      <th>STT</th>
      <th>Ten lop</th>
      <th>Tên khoa</th>
     

      </tr>
      <?php 
if(isset($_POST['search'])){
    if($_POST['keyword'] == ""){
      echo "Vui lòng nhập từ cần tìm!";
    }
    else{
      $keyword= $_POST['keyword'];
    
    include('connect.php');


    $sql= "SELECT * FROM lop inner join khoa on lop.khoaid = khoa.khoaid 
     WHERE (tenkhoa LIKE '%$keyword%') OR (tenlop LIKE '%$keyword%') ";
    $query= mysqli_query($conn, $sql);

    if(mysqli_num_rows($query) != ""){
              $id=0;
              while($row= mysqli_fetch_array($query)){
                $id++;
                echo "<tr>";
      
   echo "<td>".$id."</td>";
   echo "<td>".$row['tenlop']."</td>";
   echo "<td>".$row['tenkhoa']."</td>";

      
           }
  
  }
}
} 
?>
</table>
</form>


 
<form method="post">
  <table border="1" align="center" style="margin-top: 50px" width="800px"> 
    <tr>
    

   
    </tr>
    <tr><td colspan="10" align="center" style="font-size: 20px; color: white; background-color: navy">Danh sách lớp học</td></tr>
    <tr><td colspan="10"><a href="themlop.php">Thêm mới</a></td></tr>
    <tr style="background-color: blue; color:white;">
    <th>STT</th>
    <th> Tên lớp</th>
   
    <th>Tên khoa</th>
    
    <th>Khác</th>
    </tr>

<?php 
  include('connect.php');
  $sql= "SELECT *FROM lop INNER JOIN khoa on lop.khoaid= khoa.khoaid ";
  $kq = mysqli_query($conn, $sql);  
  if(mysqli_num_rows($kq)>0){
    $lopid=0;
    while($r = mysqli_fetch_assoc($kq)){
     $lopid++;

     $tenlop= $r['tenlop'];
     $tenkhoa = $r['tenkhoa'];
   
     echo "<tr>";
     echo "<td>$lopid</td>";
     echo "<td><a href='alllop.php?tenlop=".$tenlop."'</a>$tenlop</td>";
     echo "<td>$tenkhoa</td>";
    
       
        echo"<td><a href='xoalop.php?lopid= ".$r['lopid']."'>Xoa</a> <a href='sualop.php?lopid=".$r['lopid'].

        "'>Sửa</a> </td></tr>";
  }
   }  

 ?>
  </table>
</form>

</body>
</html>