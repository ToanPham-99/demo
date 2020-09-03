<?php
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once ('dbhelp.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/test.css">
<script type="text/javascript" src="javascript/func_test.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
</head>
<!-- <body onload="Loading()" style="opacity: 0.2;">
    <div id="loader"></div> -->
<body>
<div class="animate-bottom">

<div class="header" style="background-image: url(picture/nendong.gif); background-attachment: fixed;background-repeat: no-repeat;background-size: 100% 100%;">
    <h1 style="font-size: 3em;margin: 0px;">Students's information</h1>

</div>

<div id="navbar">
    <a class="active" href="index.php"><i class="fa fa-fw fa-home"></i> Home</a> 
    
    <!--<a href="#"><i class="fa fa-fw fa-envelope"></i> Contact</a>--> 

    
    <!-- <a href="#", style="float: right"><i class="fa fa-fw fa-user"></i> Hi, Toan</a> -->
    <div class="dropdown">
        <button onclick="drop()" class="dropbtn">Hi, user</button>
        <div id="myDropdown" class="dropdown-content">
            <a href="logout.php" style="width: 100%;text-align: left;">Sign Out</a>
            <a href="reset-password.php" style="width: 100%;text-align: left;">Reset Password</a>
    </div>
</div>
    <a href="#Searching" style="float: right"><i class="fa fa-fw fa-search"></i> Search</a>
    <a href="#New" style="float: right"><i class="fa fa-users"></i> Create New</a> 
</div>

<div class="content">
    <div class="scrolltab2">
    <div id="Searching" class="row" style="background-color: #f2f2f2;border-radius: 5px;">
        <h2  style="text-align: center;margin-top: 0px;">Search information</h2>
        <form id="submit-form" method="get">
        <div class="column left">
                    <div class="row1">
                        <div class="col-25">
                            <label for="Name">Name</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="Name" name="Name" pattern="^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+" title="Vui lòng chỉ nhập chữ cái Tiếng Việt" maxlength="30" placeholder="Your name..">
                        </div>
                    </div>
                    <div class="row1">
                        <div class="col-25">
                            <label for="Number">Number</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="Number" name="Number" placeholder="10 số" title="Vui lòng đúng 10 chữ số"  pattern="[0-9]{10}">
                        </div>
                    </div>
        </div>
        <div class="column right">
                    <div class="row1">
                        <div class="col-25">
                            <label for="Faculty">Faculty</label>
                        </div>
                        <div class="col-75">
                            <select type="text" id="Faculty" name="Faculty">
                                <option></option>
                                <option value="electrical">Electrical</option>
                                <option value="IT">IT</option>
                                <option value="chermistry">Chermistry</option>
                            </select>
                        </div>
                    </div>
                    <div class="row1">
                        <div class="col-25">
                            <label for="Class">Class</label>
                        </div>
                        <div class="col-75">
                            <select type="text" id="Class" name="Class">
                                <option></option>
                                <option value="K17">K17</option>
                                <option value="K18">K18</option>
                                <option value="K19">K19</option>
                            </select>
                        </div>
                    </div>
        </div>
        <button type="submit" class="btn" style="float: right; margin-right: 2%;margin-bottom: 2%;margin-top: 1%;"><i class="fa fa-fw fa-search"></i>  Search !!</button>
    </form>
    </div>
    </div>
    <div class="scrolltab">
    <table id="t01" style="width: 100%;">
        <tr>
            <th>STT</th>
            <th>Họ Tên</th> 
            <th>Năm sinh</th>
            <th>Khoa</th>
            <th>Lớp</th>
            <th>Số ĐT</th>
            <th>Address</th>
            <th>Edit/Delete </th>
        </tr>
        <tbody>
<?php
$sql;
if ((isset($_GET['Name']) && $_GET['Name'] != '') || (isset($_GET['Number']) && $_GET['Number'] != '') || (isset($_GET['Faculty']) && $_GET['Faculty'] != '') || (isset($_GET['Class']) && $_GET['Class'] != '')) {
    $sql = 'select * from students where TEN LIKE "%'.$_GET['Name'].'%" AND DT LIKE "%'.$_GET['Number'].'%" AND KHOA LIKE "%'.$_GET['Faculty'].'%" AND LOP LIKE "%'.$_GET['Class'].'%"';
} 
else {

	$sql = 'select * from students';
}

$studentList = executeResult($sql);

$index = 1;

foreach ($studentList as $std) {
    echo '<tr>
            <td>'.($index++).'</td>
            <td>'.$std['TEN'].'</td>
            <td>'.$std['NAMSINH'].'</td>
            <td>'.$std['KHOA'].'</td>
            <td>'.$std['LOP'].'</td>
            <td>'.$std['DT'].'</td>
            <td>'.$std['DIACHI'].'</td>
            <td class="hid">
                <button class="btn" style="margin-left: 10%;width: 30%;" onclick=\'window.open("infor1.php?id='.$std['ID'].'","_self")\' ><i class="fa fa-edit"></i> Edit</button></a>
                <button onclick="delete_sv('.$std['ID'].')" class="btn" style="margin-left: 10%;width: 30%;"><i class="fa fa-user-times"></i> Delete</button>
            </td>
        </tr>';
}
?>
        
</tbody>
    </table>
</div>
</div>

<a href="infor1.php"><button id="New" class="btn" style="float: right; margin-right: 2%;margin-bottom: 20px; margin-top: 15px;"><i class="	fa fa-users"></i>  Create New !!</button></a>
</div>
</body>
<script>
    /**
     * value intial based on my computer
     */
    var init_contentHeight = 541
    var init_windowHeight =757
    /*
    ****resize border based on window 
     */
    func_resize();

    
    
    window.onresize = function() {func_resize()};

    function func_resize() {
        var Height_window = window.innerHeight;
        if (Height_window >= init_windowHeight) {
            $(".content").height(init_contentHeight + (Height_window - init_windowHeight));
            $(".scrolltab").height($(".content").height() - $(".scrolltab2").height() - 3);
        } else {
            $(".content").height(700);
            $(".scrolltab").height($(".content").height() - $(".scrolltab2").height() - 3);
        }
    }




    window.onscroll = function() {myFunction()};
    
    var navbar = document.getElementById("navbar");
    var sticky = navbar.offsetTop;
    
    function myFunction() {
        if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
        } else {
        navbar.classList.remove("sticky");
        }
    }
$('#t01 tr').hover(function() {
    $(this).find('td:last').removeClass('hid');
}, function() {
    $(this).find('td:last').addClass('hid');
});





var lastHeight = $(".scrolltab2").height();
function checkHeightChange() { 
    var Height_border = $(".content").height();
    newHeight = $(".scrolltab2").height(); 
    /*check when height .scrolltab2 change     */
    if (lastHeight != newHeight) { 
        var delta = Height_border - newHeight;
        $(".scrolltab").height(delta-3);
        /* alert($(".scrolltab").height()); */
        // assign the new dimensions 
        lastHeight = newHeight; 
    } 
} 
/* loop */
setInterval(checkHeightChange, 1); 


/* confirm delete students */
function delete_sv(ID) {

  var r = confirm("Do you delete this?\nEither OK or Cancel.");
  if (r == false) {
    return;
  } else {
    $.post('delete_sv.php', {
        'ID': ID
    }, function(data) {
        location.reload()
        alert("xóa sinh viên thành công");
    })
  }
}

/* $(document).ready(function($) {
  $(document).on('submit', '#submit-form', function(event) {
    event.preventDefault();
  
    alert('page did not reload');
  });
}); */



function drop() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

    </script>
</html>
