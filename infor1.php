<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$s_name = $s_birth = $s_faculty = $s_class = $s_number = $s_mail = $s_diachi = $s_anh = '';
require_once ('dbhelp.php');
if(!empty($_POST)) {
    $s_id = '';

    if(isset($_POST['Name'])) {
        $s_name = $_POST['Name'];
    }
    if(isset($_POST['Birth'])) {
        $s_birth = $_POST['Birth'];
    }
    if(isset($_POST['Faculty'])) {
        $s_faculty = $_POST['Faculty'];
    }
    if(isset($_POST['Class'])) {
        $s_class = $_POST['Class'];
    }
    if(isset($_POST['Number'])) {
        $s_number = $_POST['Number'];
    }
    if(isset($_POST['Mail'])) {
        $s_mail = $_POST['Mail'];
    }
    if(isset($_POST['Address'])) {
        $s_diachi = $_POST['Address'];
	}
	if(isset($_POST['Image'])) {
        $s_anh = $_POST['Image'];
	}
    if(isset($_POST['id'])) {
        $s_id = $_POST['id'];
    }

    $s_name = str_replace('\'', '\\\'', $s_name);
	$s_birth = str_replace('\'', '\\\'', $s_birth);
	$s_faculty = str_replace('\'', '\\\'', $s_faculty);
    $s_class = str_replace('\'', '\\\'', $s_class);
    $s_number = str_replace('\'', '\\\'', $s_number);
    $s_mail = str_replace('\'', '\\\'', $s_mail);
    $s_diachi = str_replace('\'', '\\\'', $s_diachi);
	$s_id = str_replace('\'', '\\\'', $s_id);
	$s_anh = str_replace('\'', '\\\'', $s_anh);

    if($s_id != '') {
        //update
        $set = 'a';
        $sql = "update students set TEN = '$s_name', NAMSINH = '$s_birth', KHOA = '$s_faculty', LOP = '$s_class', DT = '$s_number', EMAIL = '$s_mail', DIACHI = '$s_diachi', ANH = '$s_anh' where ID = ".$s_id;
    } else {
        $set = 'b';
        //insert
        $sql = "insert into students(TEN, NAMSINH, KHOA, LOP, DT, EMAIL, DIACHI, ANH) value ('$s_name', '$s_birth', '$s_faculty', '$s_class', '$s_number', '$s_mail', '$s_diachi', '$s_anh')";
    }



    execute($sql);

    header('Location: index.php');
	die();
}

$id ='';
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $set = 'a';
    $sql = "select * from students where id= ".$id;
    $studentList = executeResult($sql);
    if ($studentList != null && count($studentList) > 0) {
        $std = $studentList[0];
        $s_name =$std['TEN'];
        $s_birth =$std['NAMSINH'];
        $s_faculty =$std['KHOA'];
        $s_class =$std['LOP'];
        $s_number =$std['DT'];
        $s_mail =$std['EMAIL'];
		$s_diachi =$std['DIACHI'];
        $s_anh = $std['ANH'];
        
    }
    else {
        $id = '';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/style_form2.css">
<script type="text/javascript" src="javascript/func_form2.js"></script>
</head>
<body>
<div style="border-radius: 5px;box-shadow:5px 10px 18px black; margin-left:10% ; margin-right: 10%;margin-bottom: 2%; background-color: navajowhite;">

<h2 style="text-align: center;font-size: 3em;padding-top: 20px;">Thông tin chi tiết</h2>

<form method="post">

<div class="row" >
    <div class="column left">
        <div class="container">
            
                <div class="row1">
                    <div class="col-25">
                        <label for="Name">Name</label>
                    </div>
                    <div class="col-75">
                        <input type="number" name="id" value="<?=$id?>" style ="display:none;">
                        <input required="true" type="text" id="Name" name="Name" pattern="^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+" title="Vui lòng chỉ nhập chữ cái Tiếng Việt" style="height: 40px; width: 100%;" placeholder="Your name.." maxlength="30" value="<?=$s_name?>">
                    </div>
                </div>
                <div class="row1">
                    <div class="col-25">
                        <label for="Birth">Birth of year</label>
                    </div>
                    <div class="col-75">
                        <input required="true" type="date" id="Birth" name="Birth" pattern="^(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$" max="9999-12-31" title="Nhập ngày tháng năm theo lịch" style="height: 40px; width: 100%;"  placeholder="Birth of year.." value="<?=$s_birth?>" >
                    </div>
                </div>
                <div class="row1">
                    <div class="col-25">
                        <label for="Faculty">Faculty</label>
                    </div>
                    <div class="col-75">
                        <select required="true" id="Falculty" name="Faculty" style="height: 40px; width: 100%;" value="<?=$s_faculty?>">
                            <option value="<?=$s_faculty?>" hidden><?=$s_faculty?></option>
                            <option value="electrical">Electrical</option>
                            <option value="IT">IT</option>
                            <option value="chermistry">Chermistry</option>
                        </select>
                        <!-- <input type="text" id="Faculty" name="Faculty" placeholder="Birth of year.."> -->
                    </div>
                </div>
                <div class="row1">
                    <div class="col-25">
                        <label for="Class">Class</label>
                    </div>
                    <div class="col-75">
                        <select required="true" id="Class" name="Class" style="height: 40px; width: 100%;" value="<?=$s_class?>">
                            <option value="<?=$s_class?>" hidden><?=$s_class?></option>
                            <option value="K17">K17</option>
                            <option value="K18">K18</option>
                            <option value="K19">K19</option>
                        </select>
                        <!-- <input type="text" id="Class" name="Class" placeholder="Birth of year.."> -->
                    </div>
                </div>
                <div class="row1">
                    <div class="col-25">
                        <label for="Number">Number</label>
                    </div>
                    <div class="col-75">
                        <input required="true" type="tel" id="Number" name="Number" style="height: 40px; width: 100%;" placeholder="10 số" title="Vui lòng đúng 10 chữ số"  pattern="[0-9]{10}" value="<?=$s_number?>">
                    </div>
                </div>
                <div class="row1">
                    <div class="col-25">
                        <label for="Mail">Mail</label>
                    </div>
                    <div class="col-75">
                        <input required="true" type="email" id="Mail" name="Mail" style="height: 40px; width: 100%;" placeholder="@gmail.com " pattern="[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}"  value="<?=$s_mail?>">
                    </div>
                </div>
                <div class="row1">
                    <div class="col-25">
                        <label for="Address">Address</label>
                    </div>
                    <div class="col-75">
                        <input required="true" type="text" id="Address" name="Address" style="height: 40px; width: 100%;" placeholder="Your address.." maxlength="100" value="<?=$s_diachi?>">
                    </div>
                </div>
                <!-- <div class="row1">
                    <div class="col-25">
                        <label for="subject">Subject</label>
                    </div>
                    <div class="col-75">
                        <textarea id="subject" name="subject" placeholder="Write something.."></textarea>
                    </div>
                </div> -->
                
            
        </div>
    </div>
    <div class="column right">
        <input id="inp" type='file'>
        <br>
		<input type="text" id="b64" name="Image" style="display: none;" value="<?=$s_anh?>"> 
		<!-- <img id="img" height="150"> -->
		<!-- echo '<img src="data:image/gif;base64,' . $s_image . '" />'; -->
		<img id="img" src="<?=$s_anh?>" height="300" width="300">
    </div>
    <button class="button" style="float: right;margin-right: 10%;margin-top: 5%;margin-bottom: 3%;">Lưu</button>
    <div id="new">
    <button onClick="javascript:history.go(-1)" type="reset" class="button" style="float: right;margin-right: 1em;margin-top: 5%;margin-bottom: 3%;">Hủy</button></a>
    </div>
</div>
</form>

</div>

<!-- <button onclick="con_save()" class="button" style="float: right;margin-right: 10%;margin-top: 5%;margin-bottom: 3%;">Lưu</button>
<a href="Form1.html"><button class="button" style="float: right;margin-right: 1em;margin-top: 5%;margin-bottom: 3%;">Hủy</button></a> -->

</body>
<script>


/* document.getElementById("new").style.display = "none"; */

function readFile() {
  
  if (this.files && this.files[0]) {
    
    var FR= new FileReader();
    
    FR.addEventListener("load", function(e) {
      document.getElementById("img").src       = e.target.result;
      document.getElementById("b64").value = e.target.result;
    }); 
    
    FR.readAsDataURL( this.files[0] );
  }
  
}

document.getElementById("inp").addEventListener("change", readFile);
</script>
</html>

