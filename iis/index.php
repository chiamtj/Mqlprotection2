<?php
// Decoded and cleaned up version of the obfuscated PHP code

// Include session and database connection files
include "session.php";
include "connection.php";

$message = "";

// Generate CAPTCHA if not set
if (!isset($_POST["captcha"])) {
    $var = "ABCDEFGHKLMNOPQRSTUYV WXYZ23456789 0";
    $random = str_shuffle($var);
    $captcha = substr($random, 0, 4);
    $_SESSION["captcha"] = $captcha;
}

// Process form submission
if (count($_POST) > 0) {
    
    // Data validation function
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    // Validate input data
    $user = validate($_POST["username"]);
    $pass = validate($_POST["password"]);
    
    // Check CAPTCHA
    if (isset($_POST["captcha"])) {
        $check = $_POST["captcha"];
        
        if ($_SESSION["captcha"] == $check) {
            // CAPTCHA is correct, proceed with login
            $result = mysqli_query($conn, "SELECT * FROM login WHERE username='".$user."' and password = '".md5($pass)."'");
            $row = mysqli_fetch_array($result);

            if (is_array($row)) {
                // Login successful
                $_SESSION["id"] = $row["id"];
                $_SESSION["username"] = $row["username"];
                $_SESSION["expire"] = time() + (30 * 60); // 30 minutes
                header("Location: " . $_SERVER["HTTP_REFERER"]);
                
            } else {
                // Invalid credentials
                $message = "Invalid Username or Password!";
            }
        } 
        else {
            // Wrong CAPTCHA
            $message = "Wrong captcha!";
            // Regenerate CAPTCHA
            $var = "ABCDEFGHKLMNOPQRSTUYV WXYZ23456789 0";
            $random = str_shuffle($var);
            $captcha = substr($random, 0, 4);
            $_SESSION["captcha"] = $captcha;
        }
    }
}

// Redirect if already logged in
if (isset($_SESSION["id"])) {
    header("Location: index2.php");
}

// HTML output for login form
echo '<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="validation/validationEngine.jquery.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <title>SIGN IN</title>
</head>

<body>
<div class="main">
    <p class="sign" align="center">SIGN IN</p>
    <p class="forgot" align="center">';
    
if ($message != "") {
    echo $message;
}

echo '</p>

    <form class="form1" method="post" action="" id="allforms-validation">
        <input class="un validate[required]" name="username" id="username" type="text" align="center" placeholder="Username">
        <input class="pass validate[required]" name="password" id="password" type="password" align="center" placeholder="Password">
        <div style="text-align: center;">
            <label class="captcha_l">';
            
echo $captcha;

echo '</label><input class="captcha_t validate[required]" name="captcha" id="captcha" type="text" align="center">
        </div>
        <input type="submit" name="submit" class="submit" value="Sign in">
        <!-- <p class="forgot" align="center"><a href="#">Forgot Password?</p> -->

    </form>
</div>

<script src="validation/jquery.js" type="text/javascript"></script>
<script src="validation/jquery.validationEngine.js" type="text/javascript"></script>
<script src="validation/jquery.validationEngine-en.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $("#allforms-validation").validationEngine();
    });
</script>
</body>
</html>';
?>