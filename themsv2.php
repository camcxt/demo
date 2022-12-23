<!DOCTYPE html>
                      <html lang="en">
                      <head>
                      <meta charset="UTF-8">
                      <!--  <meta http-equiv="refresh" content="0.5 url=http://localhost/LOPPHP/buoi9_btcu/baitapmoi/htsinhvien.php"> -->
                      <!-- để thêm cái thẻ header khi muốn quay lại trang hiển thị -->
                      <title></title>
                      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                      </head>
                      <?php
                          include('connect.php');
                          if (isset($_POST['them'])) {
                              $lopid =$_POST['lopid'];
                              $khoaid =$_POST['khoaid'];
                            
                              $ten = $_POST['ten'];
                              $ns = $_POST['ns'];
                              $gt = $_POST['gt'];
                              $wardid = $_POST['wardid'];
                              /*$districtid = $_POST['districtid'];
                              $provinceid = $_POST['provinceid'];
*/
                         
$target_dir = "image/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["them"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
// if (file_exists($target_file)) {
//   echo "Sorry, file already exists.";
//   $uploadOk = 0;
// }

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
 $imagePath = $target_dir.basename( $_FILES["fileToUpload"]["name"]);

}
                             if (!$lopid ||!$khoaid ||!$ten|| !$ns || !$gt )
                    {
                        echo " <a href='javascript: history.go(-1)'>Có lỗi, quay lại</a>";
                        exit;
                    }
                    $sql ="INSERT INTO `sinhvien` (`id`,`lopid`,`khoaid`, `ten`,`wardid`, `ns`, `gt`, `anh`) VALUES (NULL, '$lopid', '$khoaid', '$ten', '$wardid', '$ns', '$gt','$imagePath')";

                       $kq = mysqli_query($conn, $sql);

                        if ($kq) {
                        	echo  "thêm thành công,<a href='htsinhvien.php'>về trang hiển thị</a> ";}
                    /*header("http://localhost/LOPPHP/buoi9_btcu/baitapmoi/htsinhvien.php");    }
                    */   }
                    else{
                    echo "có lỗi, thử lại";
                    }
                         ?>
                    <body>
                      <div class="container">
                        <div class="row">
                          <div class="col-sm-12">
                          <div class="jumbotron">
                            <h1 class="display-4">Thêm mới sinh viên</h1>
                           
                          </div>
                          </div>
                        </div>
                      </div>
                      <div class="container">
                        <div class="row">

                          <div class="col-sm-6 offset-sm-3">
                          <form>
                              <div class="form-group">
                                <label for="exampleFormControlInput1">Họ tên: </label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nhập họ tên">
                              </div>
                              <div class="form-group">
                                <label for="exampleFormControlInput1">Ngày sinh: </label>
                                <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="Nhập ngày sinh">
                              </div>
                              <label for="exampleFormControlInput1">Giới tính: </label>
                              <div class="radio">
                                <label><input type="radio" name="gt" value="Nam" checked> Nam</label>
                              </div>
                              
                              <div class="radio">
                                <label><input type="radio" name="gt" value="Nữ" checked> Nữ</label>
                              </div>
                              <div class="form-group">
                                <label for="exampleFormControlSelect1">Khoa</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                  <option>CNTT</option>
                                  <option>DTVT</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="exampleFormControlSelect1">Lớp</label>
                                <select  class="form-control" id="exampleFormControlSelect1">
                                  <option>70DCTT22</option>
                                  <option>70DCTT23</option>
                                </select>
                              </div>
                              <div class="form-row">
                              <div class="form-group col-md-4">
                                <label for="inputCity">Tỉnh</label>
                                <select id="inputState" class="form-control">
                                  <option selected>Choose...</option>
                                  <option>...</option>
                                </select>
                              </div>
                              <div class="form-group col-md-4">
                                <label for="inputState">Huyện</label>
                                <select id="inputState" class="form-control">
                                  <option selected>Choose...</option>
                                  <option>...</option>
                                </select>
                              </div>
                              <div class="form-group col-md-4">
                                <label for="inputZip">Xã</label>
                                <select id="inputState" class="form-control">
                                  <option selected>Choose...</option>
                                  <option>...</option>
                                </select>
                              </div>
                              </div>
                              <div class="form-group">
                              <label for="exampleFormControlFile1">Chọn ảnh</label>
                              <input type="file" class="form-control-file" id="exampleFormControlFile1">
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Submit</button>
                           
                            </form>
                          </div>
                          <!-- het col -->
                        </div>
                        <!-- het row -->
                      </div> 
                      <!-- het container -->
                    <div class="all" align="center">
                        <form   method="post" enctype="multipart/form-data" >
                            <table border="1">
                           <tr><td colspan="2" align="center" style="color:white; background-color: blue;">Thêm sinh viên</td></tr>
                            <tr>
                                <td >Lớp:</td>
                                    <td >
                                        <select name="lopid" style="width: 100%">
                                        <?php
                                        include('connect.php');
                                      $sql="SELECT * FROM lop";
                                                $kq=mysqli_query($conn,$sql);
                                                while ($row=mysqli_fetch_array($kq)) {
                                                    echo "<option value=".$row['lopid'].">".$row['tenlop']."</option>";
                                                }
                                            ?>

                                          ?>

                                           
                                        </select>
                                    </td>
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
                                <td>Họ tên:</td>
                                <td><input type="text" name="ten" id="" style="width: 100%"></td>
                            </tr>
                            <tr>
                                <td>Ngày sinh:</td>
                                <td><input type="date" name="ns" id="" style="width: 100%"></td>
                            </tr>
                            <tr>
                                <td>Giới tính</td>
                                <td><input type="radio" name="gt" id="" value="Nam" checked=""> Nam
                                    <input type="radio" name="gt" id="" value="Nu"> Nữ</td>
                            </tr>
                            <tr><td>Địa chỉ</td>
                            <td >
                                        <select name="wardid">
                                        <?php
                                        include('connect.php');
                                      $sql="SELECT * FROM xa";
                                                $kq=mysqli_query($conn,$sql);
                                                while ($row=mysqli_fetch_array($kq)) {
                                                    echo "<option value=".$row['wardid'].">".$row['name']."</option>";
                                                }
                                          ?>          
                                        </select>
                                        <!--  <select name="districtid">
                                        <?php
                                        include('connect.php');
                                      $sql="SELECT * FROM huyen";
                                                $kq=mysqli_query($conn,$sql);
                                                while ($row=mysqli_fetch_array($kq)) {
                                                    echo "<option value=".$row['districtid'].">".$row['tenhuyen']."</option>";
                                                }
                                          ?>          
                                        </select>
                                        <select name="districtid">
                                        <?php
                                        include('connect.php');
                                      $sql="SELECT * FROM tinh";
                                                $kq=mysqli_query($conn,$sql);
                                                while ($row=mysqli_fetch_array($kq)) {
                                                    echo "<option value=".$row['provinceid'].">".$row['tentinh']."</option>";
                                                }
                                          ?>          
                                        </select> -->
                                    </td></tr>
                            <tr>
                                <td class="a1">Ảnh:</td>
                                <td class="a2"><input class="input" type="file" name="fileToUpload" width="100px"></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><input type="reset">
                                <input type="submit" name="them" id="" value="Thêm"></td>
                            </tr>
                            
                            </table>
                        </form>

                       
                    </div>
                    </body>
                  <!--   //lấy đường dẫn ảnh
  $imagePath = $target_dir.basename($_FILES["fileToUpload"]["name"]);
   echo '<br>string:' .$imagePath;
   -->
                    </html>



