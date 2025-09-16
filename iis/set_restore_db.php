<?php
$GLOBALS["wcpkofzd"] = "response";
$GLOBALS["lrcyvwotowc"] = "conn";
$GLOBALS["dikrjh"] = "line";
$GLOBALS["jfbsdfck"] = "filePath";
$GLOBALS["vurkqpkgo"] = "lines";
$GLOBALS["pirvcwgi"] = "sql";
$GLOBALS["eircjia"] = "message";

include "session.php";

if (isset($_SESSION["id"]) && isset($_SESSION["username"])) {
    require_once "connection.php";
    $message = "";

    function restoreMysqlDB($filePath, $conn) {
        $error = "";
        $filePath = $filePath;
        $lines = file($filePath);
        $sql = "";

        foreach ($lines as $line) {
            if (substr($line, 0, 2) == "--" || $line == "") {
                continue;
            }
            $sql .= $line;
            if (substr(trim($line), -1, 1) == ";") {
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    $error .= mysqli_error($conn) . "\n";
                }
                $sql = "";
            }
        }

        if ($error) {
            header("Location: settings.php?backup=defaultOpen&berror=" . $error);
            exit();
        } else {
            header("Location: settings.php?backup=defaultOpen&bsuccess=Database Restore Completed Successfully.");
            exit();
        }
    }

    if (!empty($_FILES)) {
        if (!in_array(strtolower(pathinfo($_FILES["backup_file"]["name"], PATHINFO_EXTENSION)), array("sql"))) {
            header("Location: settings.php?backup=defaultOpen&berror=Invalid File Type");
            exit();
        } else {
            if (is_uploaded_file($_FILES["backup_file"]["tmp_name"])) {} else {
                header("Location: settings.php?backup=defaultOpen&berror=Error. File not uploaded.");
                exit();
            }
        }
    } else {
        header("Location: settings.php?backup=defaultOpen&berror=Error restoring the DB.");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>