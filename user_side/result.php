<?php
session_start();
include "header.php";
include "../connection.php";
$date = date("Y-m-d H:i:s");
date("Y-m-d H:i:s", strtotime($date . "+ $_SESSION[exam_time] minutes"));
$_SESSION["end_time"] = "00:00:00";
?>

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Результат</h1>
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
                            <?php
                            $correct = 0;
                            $wrong = 0;

                            if (isset($_SESSION["answer"])) {
                                for ($i = 1; $i <= sizeof($_SESSION["answer"]); $i++) {
                                    $answer = "";
                                    $res = mysqli_query($link, "select * from questions where category='$_SESSION[exam_category]' && question_no=$i");
                                    while ($row = mysqli_fetch_array($res)) {
                                        $answer = $row["answer"];
                                    }

                                    if (isset($_SESSION["answer"][$i])) {
                                        if ($answer == $_SESSION["answer"][$i]) {
                                            $correct += 1;
                                        } else {
                                            $wrong += 1;
                                        }
                                    } else {
                                        $wrong += 1;
                                    }
                                }
                            }
                            $count = 0;
                            $res = mysqli_query($link, "select * from questions where category='$_SESSION[exam_category]'");
                            $count = mysqli_num_rows($res);
                            $wrong = $count - $correct;
                            $row = mysqli_fetch_array($res);
                            if ($count == 0) {
                                echo "<center>";
                                echo "<h2>";
                                echo "Тест в розробці!";
                                echo "</h2>";
                            } else {


                                echo "<center>";
                                echo "<h2>";
                                echo "Вітаю! Ви пройшли тестову частину з категорії — " . "<font color='#3A424D'><b>" . $row['category'] . "</b></font>";
                                echo "</h2>";
                                echo "<br>";

                                echo "<div id='rcorner_res' style='font-size: 25px'>";
                                echo "Загальна кількість питань = " . $count;
                                echo "<br>";
                                echo "Кількість правильних відповідей = " . $correct;
                                echo "<br>";
                                echo "Кількість неправильних відповідей = " . $wrong;
                                echo "</center>";
                                echo "</div>";
}

                            ?>
                        </div>
                    </div>
                </div> <!--/.col-->
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->


<?php
if (isset($_SESSION["exam_start"])) {
    if ($count == 0) {
    } else {
        mysqli_query($link, "insert into exam_results(id, username, exam_type, total_question, correct_answer, 
                         wrong_answer, exam_time) values(NULL, '$_SESSION[username]', '$_SESSION[exam_category]', 
                                                         '$count', '$correct','$wrong', '$date')")
        or die(mysqli_error($link));
    }
}

if (isset($_SESSION["exam_start"])) {
    unset($_SESSION["exam_start"]);
    ?>
    <script type="text/javascript">
        window.location.href = window.location.href;
    </script>
    <?php
}

?>

<?php
include "footer.php";
?>