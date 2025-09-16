<?php
// Decoded version of the obfuscated PHP file
// This appears to be a settings/admin panel for some kind of application

include "session.php";

if(isset($_SESSION["id"]) && isset($_SESSION["username"])) {
    require_once "connection.php";
    
    echo '<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="include/bootstrap.min.css">
<link rel="stylesheet" href="validation/jquery.datetimepicker.min.css">
<style>
body {font-family: "Lato", sans-serif;}
table, thead, tbody {
    overflow-x: visible !important;
}

th {
    padding-top:20px !important;
    border:none !important;
}
td {
    padding: 2px 2px !important;
    border-bottom:none;
}
.text_input_small{
    width:100%;
    background-color:#f5f5fa;
    border-bottom: 1px solid #bbb;
    border-left: 1px solid #ddd;
    border-right: 1px solid #ddd;
    border-top: none;
}
.text_input_medium{
    width:100%;
    height:40px;
    padding-left:10px;
    border-top: 1px solid #ccc;
    border-left: 1px solid #ccc;
    border-right: none;
    border-bottom: none;
}
.button_input_medium{
    height:40px;
    cursor: pointer;
    background-color: #fafad2;
}
.button_search {
  background-color: #fafad2;
  border: none;
  color: white;
  padding: 16px 32px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
}

.logo {
    background-color:#2f4f4f;
    padding:5px;
    color:#fff;
    font-family:Candara,Georgia,sans-serif;
    font-size:14px;
}
.version {
    font-family:Candara,Georgia,sans-serif;
}

/* Header Menu */
.header p {
   padding-top:10px;padding-left:20px;font-size:20px;border-bottom:1px solid #eee;background-color:#f0f2f5;    
}

.header_menu {
    padding-top:0px;padding-left:10px;padding-right:10px;border-bottom: 1px solid #ccc;
}

.header_menu ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #fff;
  width:100%;
}

.header_menu li {
  float: left;
  border-right: 1px solid #eee;
}

.header_menu li:last-child {
  border-right: none;
}

.header_menu li a {
  display: block;
  color: #999;
  text-align: center;
  padding: 16px 16px;
  text-decoration: none;
}

.header_menu li a:hover:not(.active) {
  background-color: #e7feff;
  text-decoration: none;
}

.header_menu li a:hover {
  text-decoration: none;
}

.header_menu .active {
  background-color: #e5e4e2;
  color:#999;
}

* {box-sizing: border-box}
body {font-family: "Lato", sans-serif;}

/* Style the tab */
.tab {
  float: left;
  border: 1px solid #ccc;
  background-color: #e5e4e2;
  width: 20%;
  height: 700px;
  font-family: \'Lato\', sans-serif;
}

/* Style the buttons inside the tab */
.tab button {
  display: block;
  background-color: inherit;
  color: black;
  padding: 28px 34px;
  width: 100%;
  border: none;
  outline: none;
  text-align: left;
  cursor: pointer;
  transition: 0.3s;
  font-size: 18px;
  color:#999;
  border-bottom: 1px solid #fff;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #e7feff;
}

/* Create an active/current "tab button" class */
.tab button.active {
  background-color: #fafad2;
}

/* Style the tab content */
.tabcontent {
  float: left;
  padding: 0px 22px;
  border: 1px solid #ccc;
  width: 80%;
  border-left: none;
  border-bottom: none;
  height: 700px;
}

.input_field_text {
  height:40px;
  width:300px; 
  font-size:14px; 
  margin-top:10px;
  display:block;
  padding-left:10px;
}

.input_field_button {
  height:40px;
  font-size:14px; 
  margin-top:20px
}

.error, .error2, .success, .success2 {
  font-size:22px; 
  color:#ff0000;
  margin-bottom:-20px;
  margin-top:30px;
}

.error2, .success2 {
  margin-bottom:20px;
  margin-top:20px;
}

.logo {
    background-color:#2f4f4f;
    padding:5px;
    color:#fff;
    font-family:Candara,Georgia,sans-serif;
    font-size:14px;
}

/* Header Menu */
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #fff;
}

li {
  float: left;
  border-right: 1px solid #eee;
}

li:last-child {
  border-right: none;
}

li a {
  display: block;
  color: #999;
  text-align: center;
  padding: 16px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: #e7feff;
  text-decoration: none;
}

li a:hover {
  text-decoration: none;
}

.active {
  background-color: #e5e4e2;
  color:#999;
}

/* Style the rows in settings */
.row {
  padding: 0px 22px;
  border: 1px solid #ccc;
  width: 100%;
  height: 100px;
  margin-top:10px;
}
</style>
</head>
<body>

<div class="header">
    <p>
        <label class="logo">M4/5</label>
        <label>&nbsp;REMOTE CONTROL</label>&nbsp;&nbsp;
        <label class="version">v1.001</label>
    </p>
</div>

<div style="padding-top:0px;padding-left:10px;">
    <ul>
        <li style="width:10px;height:54px;">&nbsp;</li>
        <li style="border-top: 1px solid #eee;"><a href="index2.php">CUSTOMERS</a></li>
        <li style="border-top: 1px solid #eee;"><a class="active" href="#news">SETTINGS</a></li>
        <li><a href="logout.php">LOGOUT</a></li>
    </ul>
</div>

<div class="tab">
    <button class="tablinks" onclick="openTab(event, \'AddCustomer\')" id="';
    
    if(isset($_GET["customer"])) echo $_GET["customer"];
    
    echo '">Add Customer</button>
    <button class="tablinks" onclick="openTab(event, \'Password\')" id="';
    
    if(isset($_GET["pass"])) echo $_GET["pass"];
    
    echo '">Change Password</button>
    <button class="tablinks" onclick="openTab(event, \'Users\')" id="';
    
    if(isset($_GET["users"])) echo $_GET["users"];
    
    echo '">Admin Users</button>
    <button class="tablinks" onclick="openTab(event, \'Backup\')" id="';
    
    if(isset($_GET["backup"])) echo $_GET["backup"];
    
    echo '">Backup/Restore</button>
</div>

<!-- Password Change Tab -->
<div id="Password" class="tabcontent">
    <h3 style="margin-top:20px;"><label style="background-color:#f0f0f0;padding:15px;">Change Password</label></h3>
    <label style="display:block;margin-top:0px;margin-left:5px">All fields are mandatory. **</label> 
    
    ';
    
    if(isset($_GET["perror"])) {
        echo '<p class="error">';
        echo $_GET["perror"];
        echo '</p>';
    }
    
    if(isset($_GET["psuccess"])) {
        echo '<p class="success">';
        echo $_GET["psuccess"];
        echo '</p>';
    }
    
    echo '
    <div class="main">
        <form action="set_password.php" method="post">
            <label style="display:block;font-weight: 900;margin-top:40px;">Your Old Password</label>
            <input type="password" name="op" class="input_field_text">
            <label style="display:block;font-weight: 900;margin-top:10px;">New Password</label>
            <input type="password" name="np" class="input_field_text">
            <label style="display:block;font-weight: 900;margin-top:10px;">Confirm New Password</label>
            <input type="password" name="c_np" class="input_field_text">
            <input type="submit" class="input_field_button" value="CHANGE">
        </form>
    </div>
</div>

<!-- Admin Users Tab -->
<div id="Users" class="tabcontent">
    <h3 style="margin-top:20px;"><label style="background-color:#f0f0f0;padding:15px;">New Admin User</label></h3>
    <label style="display:block;margin-top:0px;margin-left:5px">All fields are mandatory. **</label> 
    
    ';
    
    if(isset($_GET["uerror"])) {
        echo '<p class="error">';
        echo $_GET["uerror"];
        echo '</p>';
    }
    
    $per_page = 10;
    
    if(isset($_GET["usuccess"])) {
        echo '<p class="success">';
        echo $_GET["usuccess"];
        echo '</p>';
    }
    
    echo '
    <div class="main">
        <form action="set_newuser.php" method="post">
            <label style="display:block;font-weight: 900;margin-top:40px;">Username</label>
            <input type="text" name="newuser" class="input_field_text">
            <label style="display:block;font-weight: 900;margin-top:10px;">Password</label>
            <input type="password" name="newpassword" class="input_field_text">
            <input type="submit" class="input_field_button" value="Save">
        </form>
    </div>
    
    <div class="main">
        <h3 style="margin-top:60px;"><label style="background-color:#f0f0f0;padding:15px;">Active Admins</label></h3>
    
    ';
    
    // Delete admin functionality
    if(isset($_POST["delete_admin"])) {
        $id = $_POST["id"];
        $delete_q = "delete from login where id = '$id'";
        if(mysqli_query($conn, $delete_q)) {
            echo '<p class="success2">Admin Deleted</p>';
        } else {
            echo '<p class="error2">ERROR Admin Not Deleted!</p>';
        }
    }
    
    echo '    
    </div>
    
    <table class="table table-responsive table-hover" style="font-family: sans-serif;">
        <tbody>
        ';
        
    // Pagination logic for admin users
    $results = mysqli_query($conn, "SELECT * FROM login");
    $num_rows = mysqli_num_rows($results);
    $page = isset($_GET["pagea"]) && is_numeric($_GET["pagea"]) ? $_GET["pagea"] : 1;
    $start_from = ($page - 1) * $per_page;
    $total_pages = ceil($num_rows / $per_page);
    $query = "SELECT * FROM login LIMIT $start_from, $per_page";
    $result = mysqli_query($conn, $query);
    
    while($row = mysqli_fetch_array($result)) {
        echo '
            <tr>
                <form action="settings.php?users=defaultOpen" method="POST">
                    <td style="width:200px;">
                        <input type="text" name="admin_username" placeholder="Admin Username" class="input_field_text" value="';
        echo $row["username"];
        echo '" disabled>
                    </td>
                    <td><input type="hidden" name="id" value="';
        echo $row["id"];
        echo '">
                        <input type="submit" value="Del" name="delete_admin" id="delete_admin" style="background-color:#ffa07a;cursor: pointer;">
                    </td>
                </form>
            </tr>
        ';
    }
    
    echo '
        </tbody>
    </table>

    ';
    
    // Pagination links
    $pagLink = "<ul class='pagination' style='margin-left:40px;'>";
    for($i = 1; $i <= $total_pages; $i++) {
        if(isset($search_text)) {
            $pagLink .= "<li class='page-item'><a class='page-link' href='settings.php?users=defaultOpen&pagea=$i&search_text=$search_text'>$i</a></li>";
        } else {
            $pagLink .= "<li class='page-item'><a class='page-link' href='settings.php?users=defaultOpen&pagea=$i'>$i</a></li>";
        }
    }
    echo $pagLink . "</ul>";
    
    echo '
</div>

<!-- Add Customer Tab -->
<div id="AddCustomer" class="tabcontent">
    <div class="main">
        <h3 style="margin-top:20px;"><label style="background-color:#f0f0f0;padding:15px;">New Customer</label></h3>
        <label style="display:block;margin-top:0px;margin-left:5px">All fields are mandatory. **</label>
        
        ';
        
        if(isset($_GET["cerror"])) {
            echo '<p class="error">';
            echo $_GET["cerror"];
            echo '</p>';
        }
        
        if(isset($_GET["csuccess"])) {
            echo '<p class="success">';
            echo $_GET["csuccess"];
            echo '</p>';
        }
        
        echo '
        
        <form class="form1" method="post" action="set_customer.php">
            <label style="display:block;font-weight: 900;margin-top:40px;">Customer Id</label>
            <label style="display:block;">Can be any combination of symbols</label>
            <input class="input_field_text" name="account_id" id="account_id" type="text">
            
            <label style="display:block;font-weight: 900;margin-top:10px;">Status</label>
            <label style="display:block;">Available -> "Ok", "Expired", "Expiring"</label>
            <select name="status" id="status" class="input_field_text">
                <option selected>Ok</option>
                <option>Expiring</option>
                <option>Expired</option>
            </select>
            
            <label style="display:block;font-weight: 900;margin-top:10px;"># Licenses</label>
            <label style="display:block;">Number of accounts that can be activated</label>
            <input class="input_field_text" name="licenses" id="licenses" type="text">
            
            <label style="display:block;font-weight: 900;margin-top:10px;">Type Account Allowed</label>
            <select name="acc_type" id="acc_type" class="input_field_text">
                <option>LIVE</option>
                <option>DEMO</option>
                <option selected>BOTH</option>
            </select>
            
            <label style="display:block;font-weight: 900;margin-top:10px;">Account Expire Date/Time</label>
            <input class="datetimepicker input_field_text" name="expiry_date" id="expiry_date" type="text">
            <input class="input_field_button" type="submit" name="submit" class="submit" value="Submit">
        </form>
    </div>
</div>

<!-- Backup/Restore Tab -->
<div id="Backup" class="tabcontent">
    <div class="main">
        <h3 style="margin-top:20px;"><label style="background-color:#f0f0f0;padding:15px;">DB Management</label></h3>
        
        ';
        
        if(isset($_GET["berror"])) {
            echo '<p class="error2">';
            echo $_GET["berror"];
            echo '</p>';
        }
        
        if(isset($_GET["bsuccess"])) {
            echo '<p class="success2">';
            echo $_GET["bsuccess"];
            echo '</p>';
        }
        
        echo '
        
        <h3 style="margin-top:20px;font-size:22px;">Backup/Restore DB</h3>
        
        <div class="row">
            <form method="post" action="set_restore_db.php" enctype="multipart/form-data" id="frm-restore">
                <p style="width:100%; margin-top:10px;">Choose Backup File To Restore</p>
                <p><input type="file" name="backup_file" /><input style="margin-left:20px;" type="submit" name="restore" value="Restore DB" /></p>
            </form>
        </div>

        <div class="row">
            <form action="set_backup_db.php" method="post">
                <input type="submit" class="input_field_button" style="width:200px;" value="Backup DB">
            </form>
        </div>
        
        <h3 style="margin-top:20px;font-size:22px;">Import/Export Customers</h3>

        <div class="row">
            <form method="post" action="set_import_customers.php" enctype="multipart/form-data" id="frm-import">
                <p style="width:100%; margin-top:10px;">Choose File with To Import</p>
                <p><input type="file" name="import_file" /><input style="margin-left:20px;" type="submit" name="import" value="Import Customers" /></p>
            </form>
        </div>
        
        <div class="row">
            <form action="set_export_customers.php" method="post">
                <input type="submit" class="input_field_button" style="width:200px;" value="Export Customers">
            </form>
        </div>
    </div>
</div>

<script>
function openTab(evt, cityName) 
{
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) 
  {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) 
  {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

<script src="include/jquery-3.3.1-slim.js"></script>
<script src="include/bootstrap.js"></script>
<script src="validation/jquery.datetimepicker.full.js" type="text/javascript"></script> 
<script>
  $(document).ready(function(){
    $(\'.datetimepicker\').datetimepicker({
      format:\'Y-m-d H:i\',
   });
   });
</script>
   
</body>
</html> 
';

} else {
    header("Location: index.php");
    exit();
}
?>