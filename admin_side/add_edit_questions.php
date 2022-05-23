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


$id = $_GET["id"];
$exam_category = '';
$res = mysqli_query($link, "select * from exam_category where id=$id");
while ($row = mysqli_fetch_array($res)) {

    $exam_category = $row["category"];
}
?>
    <div class="breadcrumbs">
        <div class="col-sm-5">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Додати запитання в категорію
                        — <?php echo "<font color='#3A424D'><b>" . $exam_category . "</b></font>"; ?></h1>
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
                                            <strong>Додавання текстового запитання</strong>
                                        </div>
                                        <div class="card-body card-block">
                                            <div class="form-group">
                                                <label for="company" class=" form-control-label">Запитання</label>
                                                <input type="text" placeholder="" class="form-control" name="question"
                                                >
                                            </div>
                                            <div class="form-group">
                                                <label for="company" class="form-control-label">Перший варіант
                                                    відповіді</label>
                                                <input type="text" placeholder="" class="form-control" name="opt1"
                                                >
                                            </div>
                                            <div class="form-group">
                                                <label for="company" class="form-control-label">Другий варіант
                                                    відповіді</label>
                                                <input type="text" placeholder="" class="form-control" name="opt2"
                                                >
                                            </div>
                                            <div class="form-group">
                                                <label for="company" class="form-control-label">Третій варіант
                                                    відповіді</label>
                                                <input type="text" placeholder="" class="form-control" name="opt3"
                                                >
                                            </div>
                                            <div class="form-group">
                                                <label for="company" class="form-control-label">Четвертий варіант
                                                    відповіді</label>
                                                <input type="text" placeholder="" class="form-control" name="opt4"
                                                >
                                            </div>
                                            <div class="form-group">
                                                <label for="company" class="form-control-label">Відповідь</label>
                                                <input type="text" placeholder="" class="form-control" name="answer"
                                                >
                                            </div>

                                            <div class="form-group">

                                                <input type="submit" name="submit1" value="Додати питання"
                                                       class="btn btn-success">

                                            </div>

                                        </div>
                                    </div>

                            </div>


                            <div class="col-lg-6">
                                <form name="form1" action="" method="post">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>Додавання запитання з зображенням</strong>
                                        </div>
                                        <div class="card-body card-block">
                                            <div class="form-group">
                                                <label for="company" class=" form-control-label">Запитання</label>
                                                <input type="text" placeholder="" class="form-control" name="fquestion"
                                                >
                                            </div>
                                            <div class="form-group">
                                                <label for="company" class="form-control-label">Перший варіант
                                                    відповіді</label>
                                                <input type="file" placeholder="" class="form-control" name="fopt1"
                                                       style="padding-bottom: 40px;">
                                            </div>
                                            <div class="form-group">
                                                <label for="company" class="form-control-label">Другий варіант
                                                    відповіді</label>
                                                <input type="file" placeholder="" class="form-control" name="fopt2"
                                                       style="padding-bottom: 40px;">
                                            </div>
                                            <div class="form-group">
                                                <label for="company" class="form-control-label">Третій варіант
                                                    відповіді</label>
                                                <input type="file" placeholder="" class="form-control" name="fopt3"
                                                       style="padding-bottom: 40px;">
                                            </div>
                                            <div class="form-group">
                                                <label for="company" class="form-control-label">Четвертий варіант
                                                    відповіді</label>
                                                <input type="file" placeholder="" class="form-control" name="fopt4"
                                                       style="padding-bottom: 40px;">
                                            </div>
                                            <div class="form-group">
                                                <label for="company" class="form-control-label">Відповідь</label>
                                                <input type="file" placeholder="" class="form-control" name="fanswer"
                                                       style="padding-bottom: 40px;">
                                            </div>

                                            <div class="form-group">

                                                <input type="submit" name="submit2" value="Додати питання"
                                                       class="btn btn-success">

                                            </div>

                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div style='overflow: auto'>
                                <table class="table table-bordered">
                                    <tr style='background-color: #272c33; color: white; text-align: center'>
                                        <th>Номер</th>
                                        <th>Питання</th>
                                        <th>Варіант 1</th>
                                        <th>Варіант 2</th>
                                        <th>Варіант 3</th>
                                        <th>Варіант 4</th>
                                        <th>Редагувати</th>
                                        <th>Видалити</th>
                                    </tr>


                                    <?php
                                    $res = mysqli_query($link, "select * from questions where category='$exam_category' order by id asc");
                                    while ($row = mysqli_fetch_array($res)) {
                                        echo "<tr>";
                                        echo "<td>";
                                        echo $row["question_no"];
                                        echo "</td>";
                                        echo "<td>";
                                        echo $row["question"];
                                        echo "</td>";
                                        echo "<td>";
                                        if (strpos($row["opt1"], 'opt_images/') !== false) {
                                            ?>
                                            <img src="<?php echo $row["opt1"]; ?>" height="160" width="160">
                                            <?php
                                        } else {
                                            echo $row["opt1"];
                                        }
                                        echo "</td>";
                                        echo "<td>";
                                        if (strpos($row["opt2"], 'opt_images/') !== false) {
                                            ?>
                                            <img src="<?php echo $row["opt2"]; ?>" height="160" width="160">
                                            <?php
                                        } else {
                                            echo $row["opt2"];
                                        }
                                        echo "</td>";
                                        echo "<td>";
                                        if (strpos($row["opt3"], 'opt_images/') !== false) {
                                            ?>
                                            <img src="<?php echo $row["opt3"]; ?>" height="160" width="160">
                                            <?php
                                        } else {
                                            echo $row["opt3"];
                                        }
                                        echo "</td>";
                                        echo "<td>";
                                        if (strpos($row["opt4"], 'opt_images/') !== false) {
                                            ?>
                                            <img src="<?php echo $row["opt4"]; ?>" height="160" width="160">
                                            <?php
                                        } else {
                                            echo $row["opt4"];
                                        }
                                        echo "</td>";

                                        echo "<td>";
                                        if (strpos($row["opt4"], 'opt_images/') !== false) {
                                            ?>
                                            <a href="edit_option_images.php?id=<?php echo $row["id"]; ?>&id1=<?php echo $id; ?>">Редагувати</a>
                                            <?php
                                        } else {
                                            ?>
                                            <a href="edit_option.php?id=<?php echo $row["id"]; ?>&id1=<?php echo $id; ?>">Редагувати</a>
                                            <?php
                                        }
                                        echo "</td>";

                                        echo "<td>";
                                        ?>
                                        <a href="delete_option.php?id=<?php echo $row["id"]; ?>&id1=<?php echo $id; ?>">Видалити</a>
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
    $loop = 0;
    $count = 0;
    $res = mysqli_query($link, "select * from questions where category='$exam_category' order by id asc") or die(mysqli_error($link));
    $count = mysqli_num_rows($res);

    if ($count == 0) {

    } else {
        while ($row = mysqli_fetch_array($res)) {
            $loop += 1;
            mysqli_query($link, "update questions set question_no='$loop' where id=$row[id]");
        }
    }


    $loop += 1;
    mysqli_query($link, "insert into questions values(NULL,'$loop','$_POST[question]','$_POST[opt1]','$_POST[opt2]',
                             '$_POST[opt3]','$_POST[opt4]','$_POST[answer]', '$exam_category')") or die(mysqli_error($link));
    ?>

    <script type="text/javascript">
        alert("Питання успішно додано");
        window.location.href = window.location.href;
    </script>
    <?php
}
?>


<?php
if (isset($_POST["submit2"])) {
    $loop = 0;
    $count = 0;
    $res = mysqli_query($link, "select * from questions where category='$exam_category' order by id asc") or die(mysqli_error($link));
    $count = mysqli_num_rows($res);

    if ($count == 0) {

    } else {
        while ($row = mysqli_fetch_array($res)) {
            $loop += 1;
            mysqli_query($link, "update questions set question_no='$loop' where id=$row[id]");
        }
    }


    $loop += 1;


    $tm = md5(time());

    $fnm1 = $_FILES["fopt1"]["name"];
    $dst1 = "./opt_images/" . $tm . $fnm1;
    $dst_db1 = "opt_images/" . $tm . $fnm1;
    move_uploaded_file($_FILES["fopt1"]["tmp_name"], $dst1);

    $fnm2 = $_FILES["fopt2"]["name"];
    $dst2 = "./opt_images/" . $tm . $fnm2;
    $dst_db2 = "opt_images/" . $tm . $fnm2;
    move_uploaded_file($_FILES["fopt2"]["tmp_name"], $dst2);

    $fnm3 = $_FILES["fopt3"]["name"];
    $dst3 = "./opt_images/" . $tm . $fnm3;
    $dst_db3 = "opt_images/" . $tm . $fnm3;
    move_uploaded_file($_FILES["fopt3"]["tmp_name"], $dst3);

    $fnm4 = $_FILES["fopt4"]["name"];
    $dst4 = "./opt_images/" . $tm . $fnm4;
    $dst_db4 = "opt_images/" . $tm . $fnm4;
    move_uploaded_file($_FILES["fopt4"]["tmp_name"], $dst4);

    $fnm5 = $_FILES["fanswer"]["name"];
    $dst5 = "./opt_images/" . $tm . $fnm5;
    $dst_db5 = "opt_images/" . $tm . $fnm5;
    move_uploaded_file($_FILES["fanswer"]["tmp_name"], $dst5);


    mysqli_query($link, "insert into questions values(NULL,'$loop','$_POST[fquestion]','$dst_db1','$dst_db2',
                             '$dst_db3','$dst_db4','$dst_db5', '$exam_category')") or die(mysqli_error($link));
    ?>

    <script type="text/javascript">
        alert("Питання успішно додано");
        window.location.href = window.location.href;
    </script>
    <?php
}
?>


<?php
include "footer.php";
?>