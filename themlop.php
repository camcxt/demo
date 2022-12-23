<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   <!--  <meta http-equiv="refresh" content="0.5 url=http://localhost/LOPPHP/buoi9_btcu/baitapmoi/htsinhvien.php"> -->
   <!-- để thêm cái thẻ header khi muốn quay lại trang hiển thị -->
    <title></title>
</head>
<body>
    <div class="all" align="center">
        <form   method="post" >
            <table border="1">
           <tr><td colspan="2" align="center" style="color:white; background-color: blue;">Thêm lớp</td></tr>
            <tr>
                <td >Lớp:</td>
                   <td><input type="text" name="tenlop"></td>
            </tr>
            <tr>
                <td >Khoa:</td>
                    <td >
                        <select name="khoaid" style="width: 100%">
                        <?php
                        include('connect.php');
                      $sql="SELECT * FROM khoa";
                                $kq=mysqli_query($conn,$sql);
                                while ($row=mysqli_fetch_array($kq)) {
                                    echo "<option value=".$row['khoaid'].">".$row['tenkhoa']."</option>";
                                }
                            ?>

                          ?>

                           
                        </select>
                    </td>
            </tr>
             
            <tr>
                <td colspan="2" align="center"><input type="reset">
                <input type="submit" name="them" id="" value="Thêm"></td>
            </tr>
            </table>
        </form>

        <?php
        include('connect.php');
        if (isset($_POST['them'])) {
            $tenlop =$_POST['tenlop'];
            $khoaid =$_POST['khoaid'];

           
             if (!$tenlop ||!$khoaid )
    {
        echo " <a href='javascript: history.go(-1)'>Có lỗi, quay lại</a>";
        exit;
    }
    $sql ="INSERT INTO `lop` (`khoaid`, `tenlop` ) VALUES ( '$khoaid','$tenlop')";
  
       $kq = mysqli_query($conn, $sql);

        if ($kq) {
        	echo  "thêm thành công,<a href='htlophoc.php'>về trang hiển thị</a> ";}
/*header("http://localhost/LOPPHP/buoi9_btcu/baitapmoi/htsinhvien.php");    }
*/   }
   else{
    echo "có lỗi, thử lại";
   }
         ?>
    </div>
</body>
</html>