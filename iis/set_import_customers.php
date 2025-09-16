<?php
$GLOBALS["vqhnye"] = "response";
$GLOBALS["btcikgckpev"] = "conn";
$GLOBALS["omvmcxnejf"] = "sql";
$GLOBALS["sbxglxwyho"] = "f";
$GLOBALS["urptyzgepyj"] = "data";
$GLOBALS["fuorfwx"] = "i";
$GLOBALS["pkhsodf"] = "field_count";
$GLOBALS["bcmhekyjjv"] = "fields";
$GLOBALS["xginzbden"] = "handle";
$GLOBALS["bjhggvkidyr"] = "table";
$GLOBALS["vkhcyqijw"] = "filename";
$GLOBALS["nfhrydeuz"] = "message";
include "session.php";

if (isset($_SESSION["id"]) && isset($_SESSION["username"])) {
    require_once "connection.php";
    $message = "";

    function importMysqlDB($filename, $conn) {
        $file = $filename;
        $response = $conn;
        $table = "account_ids";
        $suarzmvecfmt = "file";
        ini_set("auto_detect_line_endings", true);
        $hnjjodu = "sql";
        $handle = fopen($file, "r");

        if (($data = fgetcsv($handle)) === false) {
            header("Location: settings.php?backup=defaultOpen&berror=Cannot read from csv $file");
            exit();
        }

        $fields = array();
        $field_count = 0;

        for ($i = 0; $i < count($data); $i++) {
            $f = strtolower(trim($data[$i]));
            if ($f) {
                $f = substr(preg_replace("/[^0-9a-z]/", "_", $f), 0, 20);
                $field_count++;
                $fields[] = "$f VARCHAR(50)";
            }
        }

        $sql = "CREATE TABLE $table (" . implode(", ", $fields) . ")";
        mysqli_query($conn, $sql);

        while (($data = fgetcsv($handle)) !== false) {
            $fields = array();
            for ($i = 0; $i < $field_count; $i++) {
                $fields[] = "'" . addslashes($data[$i]) . "'";
            }
            $sql = "INSERT INTO $table values(" . implode(", ", $fields) . ")";
            mysqli_query($conn, $sql);
        }

        fclose($handle);
        ini_set("auto_detect_line_endings", false);
        header("Location: settings.php?backup=defaultOpen&bsuccess=Successfully Imported");
    }

    if (!empty($_FILES)) {
        if (!in_array(strtolower(pathinfo($_FILES["import_file"]["name"], PATHINFO_EXTENSION)), array("csv"))) {
            header("Location: settings.php?backup=defaultOpen&berror=Invalid File Type");
            exit();
        } else {
            if (is_uploaded_file($_FILES["import_file"]["tmp_name"])) {} else {
                header("Location: settings.php?backup=defaultOpen&berror=Error. File not uploaded.");
                exit();
            }
        }
    } else {
        header("Location: settings.php?backup=defaultOpen&berror=Error Importing.");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>