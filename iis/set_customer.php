<?php
$GLOBALS["hlsgwnqxj"] = "conn";
$GLOBALS["ozkwirbifsb"] = "licenses";
$GLOBALS["tggwdv"] = "acc_type";
$GLOBALS["qwgymxqyw"] = "status";
$GLOBALS["xpoautym"] = "account_id";
$GLOBALS["gdmdfgunu"] = "data";
$GLOBALS["vfkhfy"] = "message";

include "session.php";

if (isset($_SESSION["id"]) && isset($_SESSION["username"])) {
    require_once "connection.php";
    $message = "";

    if (count($_POST) > 0) {
        $GLOBALS["lekreip"] = "expiry_date";

        function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $account_id = validate($_POST["account_id"]);
        $status = validate($_POST["status"]);
        $licenses = validate($_POST["licenses"]);
        $acc_type = $_POST["acc_type"];
        $expiry_date = validate($_POST["expiry_date"]);

        if (empty($account_id)) {
            header("Location: settings.php?customer=defaultOpen&error=Customer Id is required");
            exit();
        } else if (empty($status)) {
            header("Location: settings.php?customer=defaultOpen&error=Status is required");
            exit();
        } else if (empty($licenses)) {
            header("Location: settings.php?customer=defaultOpen&error=Licenses is required");
            exit();
        } else if (empty($expiry_date)) {
            header("Location: settings.php?customer=defaultOpen&error=Account Expire Date/Time is required");
            exit();
        } else {
            $sql = "INSERT INTO account_ids (customer_id, status, licenses, acc_type, expiry_date) VALUES ('$account_id', '$status', '$licenses', '$acc_type', '$expiry_date')";

            if (mysqli_query($conn, $sql)) {
                header("Location: settings.php?customer=defaultOpen&success=New customer has been added successfully");
                exit();
            } else {
                echo "Error: " . $sql . " " . mysqli_error($conn);
                exit();
            }
        }
    }
} else {
    header("Location: index.php");
    exit();
}
?>