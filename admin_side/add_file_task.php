<?php
session_start();
include "header.php";
include "../connection.php";

if (!isset($_SESSION["admin"])) {
    ?>
    <script type="text/javascript">
        window.location = "admin_login.php";
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


                            <div class="col-lg-12">
                                <form name="form1" action="" method="post" enctype="multipart/form-data">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>Додавання індивідуального завдання</strong>
                                        </div>
                                        <div class="card-body card-block">
                                            <div class="form-group">
                                                <label class=" form-control-label">Тема завдання</label>
                                                <input type="text" placeholder="" class="form-control" name="topic"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Завдання</label>
                                                <input type="file" placeholder="" class="form-control" name="task"
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
            </div>
            <!--/.col-->

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div style='overflow: auto'>
                                <table class="table table-bordered" style="text-align: center">
                                    <tr style='background-color: #272c33; color: white;'>
                                        <th>Тема завдання</th>
                                        <th>Завантаження</th>
                                        <th>Видалити</th>
                                    </tr>
                                    <?php
                                    $res = mysqli_query($link, "select * from file_task order by id asc");
                                    while ($row = mysqli_fetch_array($res)) {
                                        echo "<tr>";
                                        echo "<td>";
                                        echo $row["topic"];
                                        echo "</td>";
                                        echo "<td>";
                                        if (strpos($row["task"], 'file_task/') !== false) {
                                            ?>
                                            <a href="download_file_task.php?task=<?php echo $row["task"]; ?>">Завантажити</a>
                                            <?php
                                        } else {
                                            echo "Файлу не знайдено";
                                        }
                                        echo "</td>";
                                        echo "<td>";
                                        ?>
                                        <a href="delete_file_task.php?id=<?php echo $row["id"]; ?>">Видалити</a>
                                        <?php
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div style='overflow: auto'>
                                <table class="table table-bordered" style="text-align: center">
                                    <tr style='background-color: #272c33; color: white;'>
                                        <th>Ім'я користувача</th>
                                        <th>Тема завдання</th>
                                        <th>Завдання</th>
                                        <th>Відповідь</th>
                                        <th>Видалити</th>
                                    </tr>
                                    <?php
                                    $res = mysqli_query($link, "SELECT file_answer.id, username, topic, task, answer from file_answer, file_task where file_task.id = file_answer.id_task order by file_answer.id asc");
                                    echo "<tr>";
                                    while ($row = mysqli_fetch_array($res)) {
                                        echo "<td>";
                                        echo $row["username"];
                                        echo "</td>";
                                        echo "<td>";
                                        echo $row["topic"];
                                        echo "</td>";
                                        echo "<td>";
                                    if (strpos($row["task"], 'file_task/') !== false) {
                                        ?>
                                        <a href="download_file_task.php?task=<?php echo $row["task"]; ?>">Завантажити</a>
                                    <?php
                                    } else {
                                    ?>
                                        <script type="text/javascript">
                                            alert("Файлу не існує");
                                        </script>
                                    <?php
                                    }
                                    echo "</td>";

                                    echo "<td>";
                                    if (strpos($row["answer"], 'file_answer/') !== false) {
                                    ?>
                                        <a href="download_file_answer.php?answer=<?php echo $row["answer"]; ?>">Завантажити</a>
                                    <?php
                                    } else {
                                    ?>
                                        <script type="text/javascript">
                                            alert("Файлу не існує");
                                        </script>
                                    <?php
                                    }
                                    echo "</td>";
                                    echo "<td>";
                                    ?>
                                        <a href="delete_file_answer.php?id=<?php echo $row["id"]; ?>">Видалити</a>
                                        <?php
                                        echo "</td>";
                                        echo "</tr>";
                                    }

                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- .animated -->
    </div><!-- .content -->


<?php
if (isset($_POST["submit1"])) {


    $fileName = $_FILES["task"]["name"];
    $dst1 = "./file_task/" . $fileName;
    $dst_db1 = "file_task/" . $fileName;
    move_uploaded_file($_FILES["task"]["tmp_name"], $dst1);
    mysqli_query($link, "insert into file_task values(NULL,'$_POST[topic]','$dst_db1')") or die(mysqli_error($link));
    ?>

    <script type="text/javascript">
        alert("Завдання успішно додано");
        window.location.href = window.location.href;
    </script>
    <?php
}
?>


<?php
include "footer.php";
?>