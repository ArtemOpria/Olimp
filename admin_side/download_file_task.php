<?php
session_start();
include "../connection.php";
if(!isset($_SESSION["admin"])){
    ?>
    <script type="text/javascript">
        window.location = "admin_login.php";
    </script>
    <?php
}
if (!empty($_GET['task'])) {
    $fileName = basename($_GET['task']);
    $filePath = "file_task/" . $fileName;

    if (!empty($fileName) && file_exists($filePath)) {
        //define header
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");

        //read file
        readfile($filePath);
        exit;
    } else {
        ?>
        <script type="text/javascript">
            alert("Файлу не існує");
        </script>
        <?php
    }
}
?>