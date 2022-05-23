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
        <div class="col-sm-12">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Вибір категорії</h1>
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
                            <div style="overflow: auto">

                                    <table class="table table-bordered">
                                        <thead>
                                        <tr style='background-color: #272c33; color: white;'>
                                            <th scope="col">Номер</th>
                                            <th scope="col">Категорія</th>
                                            <th scope="col">Час тестування</th>
                                            <th scope="col">Вибір </th>
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
                                                <td><a href="add_edit_questions.php?id=<?php echo $row["id"]; ?>"> Вибрати</a></td>
                                            </tr>
                                            <?php


                                        }
                                        ?>



                                        </tbody>
                                    </table>
                            </div>


                        </div>
                        <!--/.col-->


                    </div><!-- .animated -->
                </div><!-- .content -->
<?php
include "footer.php";
?>