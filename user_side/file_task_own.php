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
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div style='overflow: auto'>
                                <table class="table table-bordered" style="text-align: center">
                                    <tr style='background-color: #272c33; color: white;'>
                                        <th>Тема завдання</th>
                                        <th>Завантаження</th>
                                        <th>Додавання</th>
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
                                            <a href="../admin_side/download_file_task.php?task=<?php echo $row["task"];?>">Завантажити завдання</a>
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
                                            <a href="add_file_answer.php?id=<?php echo $row["id"];?>">Додати відповідь</a>
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
include "footer.php";
?>