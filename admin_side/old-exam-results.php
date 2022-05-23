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
                    <h1>Результати тестування</h1>
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

                            <center>
                                <h1>Останні результати</h1>
                            </center>
                            <?php
                            $count = 0;
                            $res = mysqli_query($link, "select * from exam_results order by id desc");
                            $count = mysqli_num_rows($res);

                            if ($count == 0) {
                                ?>
                                <center>
                                    <h1>Останніх результатів не знайдено</h1>
                                </center>
                                <?php
                            } else {
                                echo "<div style='overflow: auto'>";
                                echo "<table class='table table-bordered' style='margin-top: 20px;'>";
                                echo "<tr style='background-color: #272c33; color: white;'> ";
                                echo "<th>"; echo "Псевдонім"; echo "</th>";
                                echo "<th>"; echo "Категорія"; echo "</th>";
                                echo "<th>"; echo "Кількість питань"; echo "</th>";
                                echo "<th>"; echo "Правильні відповіді"; echo "</th>";
                                echo "<th>"; echo "Неправильні відповіді"; echo "</th>";
                                echo "<th>"; echo "Час екзамену"; echo "</th>";
                                echo "<th>"; echo "Видалення"; echo "</th>";
                                echo "<th>"; echo "Сертифікат"; echo "</th>";
                                echo "</tr>";

                                while ($row = mysqli_fetch_array($res)){
                                    echo "<tr>";
                                    echo "<td>"; echo $row["username"]; echo "</td>";
                                    echo "<td>"; echo $row["exam_type"]; echo "</td>";
                                    echo "<td>"; echo $row["total_question"]; echo "</td>";
                                    echo "<td>"; echo $row["correct_answer"]; echo "</td>";
                                    echo "<td>"; echo $row["wrong_answer"]; echo "</td>";
                                    echo "<td>"; echo $row["exam_time"]; echo "</td>";
                                    echo "<td>";
                                    ?>
                                    <a href='delete_result.php?id=<?php echo $row["id"]; ?>'>Видалити</a>
                                    <?php
                                    echo "</td>";

                                    echo "<td>";
                                    ?>
                                    <a href='download_cert.php?id=<?php echo $row["id"]; ?>'>Сертифікат</a>
                                    <?php
                                    echo "</td>";

                                    echo "</tr>";
                                }
                                echo "</table>";
                                echo  "</div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!--/.col-->
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
<?php
include "footer.php";
?>