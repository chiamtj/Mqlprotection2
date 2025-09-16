<?php
$GLOBALS["isbyvbvnjb"] = "newp";
$GLOBALS["plfprptcvhl"] = "newuser";
$GLOBALS["xdjmuwq"] = "newpassword";
$GLOBALS["bxekxhhjk"] = "data";

include "session.php";

if (isset($_SESSION["id"]) && isset($_SESSION["username"])) {
    require_once "connection.php";

    if (isset($_POST["newuser"]) && isset($_POST["newpassword"])) {
        $GLOBALS["govsgqdk"] = "newuser";

        function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $newuser = validate($_POST["newuser"]);
        $newpassword = validate($_POST["newpassword"]);

        if (empty($newuser)) {
            header("Location: settings.php?users=defaultOpen&uerror=Username is required");
            exit();
        } else if (empty($newpassword)) {
            header("Location: settings.php?users=defaultOpen&uerror=Password is required");
            exit();
        } else {
            $conn = $connection;
            $newp = md5($newpassword);
            $sql = "INSERT INTO login (username, password) VALUES ('$newuser', '$newp')";

            if (mysqli_query($conn, $sql)) {
                header("Location: settings.php?users=defaultOpen&usuccess=User added successfully");
                exit();
            } else {
                header("Location: settings.php?users=defaultOpen&uerror=Oops, something went wrong. Please try again.");
                exit();
            }
        }
    } else {
        header("Location: settings.php?users=defaultOpen&uerror=Error");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>