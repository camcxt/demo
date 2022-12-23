<?php 
if(isset($_POST['search'])){
    if($_POST['keyword'] == ""){
      echo "Vui lòng nhập từ cần tìm!";
    }
    else{
      $keyword= $_POST['keyword'];
    
    include('connect.php');


    $sql= "SELECT * FROM sinhvien inner join lop on sinhvien.lopid = lop.lopid 
    inner join khoa on sinhvien.khoaid= khoa.khoaid  WHERE (dc LIKE '%$keyword%') OR (ten LIKE '%$keyword%') ";
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
    echo "<td>".$row['dc']."</td>";
    echo "<td>".$row['ns']."</td>";
    echo "<td>".$row['gt']."</td>";

      
           }
  
  }
}
} 
?>