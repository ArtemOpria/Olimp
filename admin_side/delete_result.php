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

$id = $_GET["id"];
mysqli_query($link, "delete from exam_results where id=$id");
?>

<script type="text/javascript">
    window.location = "old-exam-results.php";
</script>