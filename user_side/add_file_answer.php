<?php
session_start();
include "header.php";
include "../connection.php";
if (!isset($_SESSION["username"])) {
    ?>
    <script type="text/javascript">
        window.location = "login.php";
    </script>
    <?php
}
?>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Індивідуальне завдання</h1>
            </div>
        </div>
    </div>

</div>

<div class="content mt-3">
    <div class="animated fadeIn">


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-lg-6">
                            <form name="form1" action="" method="post" enctype="multipart/form-data">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Виконання індивідуального завдання</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <div class="form-group">
                                            <label class=" form-control-label">Прикріплене завдання</label>
                                            <input type="file" placeholder="" class="form-control" name="file_answer"
                                                   style="padding-bottom: 35px;" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="submit1" value="Підтвердити"
                                                   class="btn btn-success">
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.col-->
    </div><!-- .animated -->
</div><!-- .content -->



<?php
if (isset($_POST["submit1"])) {

    $fileName = $_FILES["file_answer"]["name"];
    $dst1 = "../admin_side/file_answer/" . $fileName;
    $dst_db1 = "file_answer/" . $fileName;
    move_uploaded_file($_FILES["file_answer"]["tmp_name"], $dst1);

    mysqli_query($link, "insert into file_answer values(NULL,'$_SESSION[username]','$_GET[id]','$dst_db1')") or die(mysqli_error($link));
    ?>

    <script type="text/javascript">
        alert("Відповідь успішно додано");
            window.location = "file_task_own.php";
    </script>
    <?php
}
?>


<?php
include "footer.php";
?>
