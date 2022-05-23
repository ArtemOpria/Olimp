<?php
session_start();
include "header.php";
include "../connection.php";

if(!isset($_SESSION["admin"])){
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
                    <h1>Додавання тестування</h1>
                </div>
            </div>
        </div>

    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form name="form1" action="" method="post">
                        <div class="card-body">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Параметри тестування</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <div class="form-group">
                                            <label for="company" class=" form-control-label">Введіть категорію</label>
                                            <input type="text"  placeholder="Категорія" class="form-control" name="examname" required="">
                                        </div>
                                        <div class="form-group"><label for="vat" class=" form-control-label">Час тестування в хвилинах</label>
                                            <input type="text" placeholder="" class="form-control" name="examtime" required="">
                                        </div>

                                        <div class="form-group">

                                            <input type="submit" name="submit1" value="Додати тест" class="btn btn-success">
                                            
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title">Наявні категорії</strong>
                                    </div>
                                    <div class="card-body">
                                        <div style='overflow: auto'>
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr style='background-color: #272c33; color: white;'>
                                                <th scope="col">#</th>
                                                <th scope="col">Категорія</th>
                                                <th scope="col">Час тестування</th>
                                                <th scope="col">Редакція</th>
                                                <th scope="col">Видалення</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $count = 0;
                                            $res = mysqli_query($link,"select * from exam_category");
                                            while($row = mysqli_fetch_array($res)){

                                                $count+=1;

                                                ?>
                                                <tr>
                                                    <td scope="row">
                                                        <?php
                                                        echo $count;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo $row["category"];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo $row["exam_time_in_minutes"];
                                                        ?>
                                                    </td>
                                                    <td><a href="edit_exam.php?id=<?php echo $row["id"]; ?>"> Редагувати</a></td>
                                                    <td><a href="delete.php?id=<?php echo $row["id"]; ?>">Видалити</a></td>
                                                </tr>
                                                <?php


                                            }
                                            ?>



                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
<!--
                        </form>
                    </div>

                </div>
                <!--/.col-->


        </div><!-- .animated -->
    </div><!-- .content -->

<?php
if (isset($_POST["submit1"])) {
    mysqli_query($link, "insert into exam_category values(null, '$_POST[examname]','$_POST[examtime]')") or die(mysqli_error($link));
    ?>
    <script type="text/javascript">
         alert("Тест успішно додано");
        window.location.href = window.location.href;
    </script>
    <?php

}
?>




<?php
include "footer.php";
?>