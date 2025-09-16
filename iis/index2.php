<?php
// Decoded and cleaned up version of the obfuscated PHP code

include "session.php";

// Session check - redirect if not logged in
if (!isset($_SESSION["id"])) {
    header("Location:index.php");
}

include "connection.php";

// Get search text parameter
$search_text = isset($_GET["search_text"]) ? $_GET["search_text"] : "";

// HTML Document Start
echo "<!DOCTYPE html>
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
<title>List of Customers</title>
<link rel=\"stylesheet\" type=\"text/css\" href=\"include/bootstrap.min.css\">
<link rel=\"stylesheet\" href=\"validation/jquery.datetimepicker.min.css\">
<style>
body {font-family: \"Lato\", sans-serif;}
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
    background-color:#f5fffa;
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
</style>
<style>
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
</style>
</head>
<body>";

// Header section
echo "<!--
<p style=\"background-color: #fa8787; color: #ffffff; font-family:Candara,Georgia,sans-serif;margin-bottom: auto;padding-left: 10px;\"> The developer who is working on the design can contact me on Telegram: @fx_seemore</p>
-->
<div class=\"header\">
    <p>
        <label class=\"logo\">MT4/5</label>
        <label>&nbsp;REMOTE CONTROL</label>&nbsp;&nbsp;
        <label class=\"version\">v1.001</label>
    </p>
</div>

<div class=\"header_menu\">
<div style=\"float: left;\">
    <ul>
        <li style=\"width:10px;height:1px;\">&nbsp;</li>
        <li style=\"border-top: 1px solid #eee;\"><a class=\"active\" href=\"#\">CUSTOMERS</a></li>
        <li style=\"border-top: 1px solid #eee;\"><a href=\"settings.php?customer=defaultOpen\">SETTINGS</a></li>
        <li><a href=\"logout.php\">LOGOUT</a></li>
    </ul>
</div>
<div style=\"float: right;\">
<form method=\"GET\" action=\"\">
    <input class=\"text_input_medium\" style=\"width:300px;border: 1px solid #dddddd;\" type=\"text\" name=\"search_text\" placeholder=\"Search Box\" value=\"";

echo $search_text;

echo "\">
    <input type=\"submit\" name=\"search_frm\" class=\"button_input_medium\" style=\"background-color:#87cefa;\" value=\"Search\" />
</form>
</div>
<div style=\"clear: both;\"></div>
</div>

<table class=\"table table-responsive table-hover\" style=\"font-family: sans-serif;\">
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th style=\"padding-left:0px;\">Account Id</th>
            <th style=\"padding-left:0px;\">&nbsp;Type</th>
            <th style=\"padding-left:0px;\">&nbsp;Status</th>
            <th style=\"padding-left:0px;\">&nbsp;Licenses</th>
            <th style=\"padding-left:0px;\">&nbsp;Expire</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>";

// Database queries
if (isset($_GET["search_frm"])) {
    $results = mysqli_query($conn, "SELECT * FROM account_ids WHERE customer_id LIKE '%$search_text%' OR expiry_date LIKE '%$search_text%' OR status LIKE '%$search_text%'");
} else {
    $results = mysqli_query($conn, "SELECT * FROM account_ids ORDER BY created_date ASC");
}

$num_rows = mysqli_num_rows($results);
$per_page = 10;
$page = isset($_GET["page"]) && is_numeric($_GET["page"]) ? $_GET["page"] : 1;
$start_from = ($page - 1) * $per_page;
$total_pages = ceil($num_rows / $per_page);

if (isset($_GET["search_text"])) {
    $query = "SELECT * FROM account_ids WHERE customer_id LIKE '%$search_text%' OR expiry_date LIKE '%$search_text%' OR status LIKE '%$search_text%' LIMIT $start_from, $per_page";
} else {
    $query = "SELECT * FROM account_ids ORDER BY created_date ASC LIMIT $start_from, $per_page";
}

$result = mysqli_query($conn, $query);

// Display results
while ($row = mysqli_fetch_array($result)) {
    echo "        <tr>
            <form action=\"edited.php\" method=\"POST\" onsubmit=\"return confirm('Are you sure you want to proceed?');\">
                <td class=\"clickable\" data-toggle=\"collapse\" data-target=\"#group-of-rows-";
    
    echo $row["id"];
    
    echo "\" aria-expanded=\"false\" aria-controls=\"group-of-rows-1\" style=\"width:40px;padding-top:10px !important;cursor: pointer;\" align=\"center\"><b>+</b></td>
                <td style=\"width:300px;\"><input type=\"text\" name=\"customer_id\" placeholder=\"Account ID\" class=\"text_input_medium\" value=\"";
    
    echo $row["customer_id"];
    
    $selected = $row["acc_type"];
    
    echo "\"></td>
                
                <td style=\"width:200px;\">
                    <select name=\"acc_type\" placeholder=\"Account Type\" class=\"text_input_medium\">
                        <option ";
    
    if ($selected == "LIVE") {
        echo("selected");
    }
    
    echo ">LIVE</option>
                        <option ";
    
    if ($selected == "DEMO") {
        echo("selected");
    }
    
    echo ">DEMO</option>
                        <option ";
    
    if ($selected == "BOTH") {
        echo("selected");
    }
    
    echo ">BOTH</option>
                    </select>
                </td>
                
                <td style=\"width:200px;\">";
    
    $selected = $row["status"];
    
    echo "                    <select name=\"status\" placeholder=\"Status\" class=\"text_input_medium\">
                        <option ";
    
    if ($selected == "Ok") {
        echo("selected");
    }
    
    echo ">Ok</option>
                        <option ";
    
    if ($selected == "Expiring") {
        echo("selected");
    }
    
    echo ">Expiring</option>
                        <option ";
    
    if ($selected == "Expired") {
        echo("selected");
    }
    
    echo ">Expired</option>
                    </select>
                </td>
                <td style=\"width:50px;\"><input type=\"text\" name=\"licenses\" placeholder=\"Licenses\" class=\"text_input_medium\" style=\"width:82px;\" value=\"";
    
    echo $row["licenses"];
    
    echo " \"></td>
                ";
    
    $date = date_create($row["expiry_date"]);
    $exp_date = date_format($date, "Y/m/d H:i");
    
    echo "                <td style=\"width:200px;\"><input type=\"text\" class=\"datetimepicker text_input_medium\" name=\"last_update\" placeholder=\"Expire Date\" value=\"";
    
    echo $exp_date;
    
    echo "\"></td>
                <td><input type=\"hidden\" name=\"autoid\" value=\"";
    
    echo $row["id"];
    
    echo "\">
                    <input type=\"submit\" value=\"Update\" class=\"button_input_medium\" name=\"update\" id=\"next\"><input class=\"button_input_medium\" type=\"submit\" value=\"Del\" name=\"delete\" id=\"delete\" style=\"background-color:#ffa07a;cursor: pointer;\"></td>
            </form>
        </tr>
        ";
    
    $email = $row["customer_id"];
    
    echo "        <tr>
            <td colspan=\"8\">
                ";
    
    $query2 = "SELECT * FROM accounts WHERE `customer_id`='$email' ORDER BY updated DESC";
    $result2 = mysqli_query($conn, $query2);
    $num_rows = mysqli_num_rows($result2);
    
    echo "                <table class=\"table table-responsive table-hover\" style=\"font-family: sans-serif;padding:0px;margin:0px;\">
                    <thead id=\"group-of-rows-";
    
    echo $row["id"];
    
    echo "\" class=\"collapse\">
                        ";
    
    if ($num_rows > 0) {
        echo "                        <tr style=\"background-color:#f5fffa;\">
                                <th style=\"background-color:#f5fffa;\">&nbsp;</th>
                                <th style=\"background-color:#f5fffa;padding-left:0px;\">App</th>
                                <th style=\"background-color:#f5fffa;padding-left:0px;\">Account Number</th>
                                <th style=\"background-color:#f5fffa;padding-left:0px;\">Account Name</th>
                                <th style=\"background-color:#f5fffa;padding-left:0px;\">Updated</th>
                                <th style=\"background-color:#f5fffa;padding-left:0px;\">Min Bal Allowed</th>
                                <th style=\"background-color:#f5fffa;padding-left:0px;\">Initial Balance</th>
                                <th style=\"background-color:#f5fffa;padding-left:0px;\">Current Balance</th>
                                <th style=\"background-color:#f5fffa;padding-left:0px;\">Current Equity</th>
                                <th style=\"background-color:#f5fffa;padding-left:0px;\">Initial date</th>
                                <th style=\"background-color:#f5fffa;padding-left:0px;\">Broker</th>
                                <th style=\"background-color:#f5fffa;\"></th>
                        </tr>
                        ";
    } else {
        echo "                        <tr style=\"background-color:#f5fffa;\">
                                <th style=\"background-color:#f5fffa;\">&nbsp;</th>
                                <th style=\"background-color:#f5fffa;padding-left:0px;\">There isn't accounts for this user!</th>
                        </tr>
                        ";
    }
    
    echo " 
                    </thead>
                    <tbody id=\"group-of-rows-";
    
    echo $row["id"];
    
    echo "\" class=\"collapse\">
                        ";
    
    while ($row2 = mysqli_fetch_array($result2)) {
        echo "                        <tr>
                                <form action=\"edit_2.php\" method=\"POST\">
                                    <input type=\"hidden\" name=\"id\" value=\"";
        
        echo $row2["account_number"];
        
        echo "\" />
                                    <td style=\"padding-left:12px !important;\">-</td>
                                    <td><input type=\"text\" name=\"application\" placeholder=\"Application\" class=\"text_input_small\" value=\"";
        
        echo $row2["application"];
        
        echo "\" disabled=disabled ></td>
                                    <td><input type=\"text\" name=\"account_number\" placeholder=\"Account number\" class=\"text_input_small\" value=\"";
        
        echo $row2["account_number"];
        
        echo "\" disabled=disabled ></td>
                                    <td><input type=\"text\" name=\"account_name\" placeholder=\"Enter account name\" class=\"text_input_small\" value=\"";
        
        echo $row2["account_name"];
        
        echo "\"></td>
                                    <td><input type=\"text\" name=\"updated\" placeholder=\"Updated\" class=\"datetimepicker text_input_small\" value=\"";
        
        echo $row2["updated"];
        
        echo "\"></td>
                                    <td><input type=\"text\" name=\"min_allowed_balance\" placeholder=\"Min Allowed Balance\" class=\"text_input_small\" value=\"";
        
        echo $row2["min_allowed_balance"];
        
        echo "\"></td>
                                    <td><input type=\"text\" name=\"initial_balance\" placeholder=\"Initial Balance\" class=\"text_input_small\" value=\"";
        
        echo $row2["initial_balance"];
        
        echo "\"></td>
                                    <td><input type=\"text\" name=\"current_balance\" placeholder=\"Current Balance\" class=\"text_input_small\" value=\"";
        
        echo $row2["current_balance"];
        
        echo "\"></td>
                                    <td><input type=\"text\" name=\"current_equity\" placeholder=\"Enter current Equity\" class=\"text_input_small\" value=\"";
        
        echo $row2["current_equity"];
        
        echo "\"></td>
                                    <td><input type=\"text\" name=\"initial_date\" placeholder=\"Initial Date\"  class=\"datetimepicker text_input_small\" value=\"";
        
        echo $row2["initial_date"];
        
        echo "\"></td>
                                    <td><input type=\"text\" name=\"broker\" placeholder=\"Enter Broker\" class=\"text_input_small\" value=\"";
        
        echo $row2["broker"];
        
        echo "\"></td>
                                    <td style=\"width:140px;\"><input type=\"submit\" value=\"Update\" name=\"update\" style=\"background-color:#fafad2;cursor: pointer;\" id=\"update\"><input type=\"submit\" value=\"Del\" name=\"delete\" id=\"delete\" style=\"background-color:#ffa07a;cursor: pointer;\"></td>

                                </form>
                            </tr>
                        ";
    }
    
    echo "                        <tr><td>&nbsp;</td></tr>
                    </tbody>
                </table>
            </td>
        </tr>
    ";
}

echo "</tbody>
</table>";

// Pagination
$pagLink = "<ul class='pagination' style='margin-left:40px;'>";
for ($i = 1; $i <= $total_pages; $i++) {
    if ($search_text) {
        $pagLink .= "<li class='page-item'><a class='page-link' href='index2.php?page=" . $i . "&search_text=" . $search_text . "'>" . $i . "</a></li>";
    } else {
        $pagLink .= "<li class='page-item'><a class='page-link' href='index2.php?page=" . $i . "'>" . $i . "</a></li>";
    }
}

echo $pagLink . "</ul>";

echo "
<p style='margin-left:20px; margin-top:40px;'>Field \"Status\" legend</p>
<ul style='margin-left:20px;'>
<li><strong>expired</strong> - Will popup a message box in the trader's terminal \"EXPIRED\" and will remove the client EA</li>
<li><strong>expiring</strong> - Will popup a message box(days left backwards counter) on the Customer's terminal</li>
</ul>

<script src=\"include/jquery-3.3.1-slim.js\"></script>
<script src=\"include/bootstrap.js\"></script>
<script src=\"validation/jquery.datetimepicker.full.js\" type=\"text/javascript\"></script> 
<script>
  $(document).ready(function(){
    $('.datetimepicker').datetimepicker({
      format:'Y-m-d H:i',
   });
  });
</script>";

mysqli_close($conn);

echo "</body>
</html>";
?>