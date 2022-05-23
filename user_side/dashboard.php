<?php
session_start();
include "../connection.php";
include "header.php";
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
                    <h1>Проходження тестування</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-lg-7">
                    <div class="card" style="background-color: #3A424D; color: #fff">
                        <div class="card-body">
                            <div class="row">
                                <br>
                                <div class="col-lg-12" style="font-size: 30px;">
                                    <?php
                                    $category = "";
                                    $res = mysqli_query($link, "select category from questions where category='$_SESSION[exam_category]'");
                                    while ($row = mysqli_fetch_array($res)) {
                                        $category = $row["category"];
                                    }
                                    echo "<div style='display: inline-block'>КАТЕГОРІЯ " . $category . "</div>";
                                    echo "<br>";
                                    echo "<div style='display: inline-block'>ПИТАННЯ #</div> ";
                                    ?>
                                    <div id="current_que" style="display: inline-block">0</div>
                                    <div style="display: inline-block">/</div>
                                    <div id="total_que" style="display: inline-block">0</div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2" align="center">
                    <div class="card" style="background-color: #3A424D; color: #fff">
                        <div class="card-body">
                            <h2>ЧАС</h2>
                            <div id="countdowntimer"
                                 style="font-size: 30px; border: #fff 4px solid; border-radius: 20px; font-weight: bolder"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="card" style="margin-top: 0;">
                        <div class="card-body">
                            <div class="col-lg-12"
                                 id="load_questions">
                            </div>

                            <div class="col-md-12" style="margin-top: 10px; padding-left: 30px;">
                                <input type="button" class="btn btn-success my-but" value="Назад"
                                       style="color: white"
                                       onclick="load_previous();">&nbsp;
                                <input type="button" class="btn btn-success my-but" value="Вперед"
                                       onclick="load_next();">
                            </div>

                        </div>
                    </div>
                </div><!--/.col-->


                <script type="text/javascript">
                    function load_total_que() {
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function () {
                            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                                document.getElementById("total_que").innerHTML = xmlhttp.responseText;
                            }
                        };
                        xmlhttp.open("GET", "../forajax/load_total_que.php", true);
                        xmlhttp.send(null);
                    }


                    var questionno = "1";
                    load_questions(questionno);

                    function load_questions(questionno) {

                        document.getElementById("current_que").innerHTML = questionno;

                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function () {
                            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                                if (xmlhttp.responseText == "over") {

                                    window.location = "result.php";
                                } else {
                                    document.getElementById("load_questions").innerHTML = xmlhttp.responseText;
                                    load_total_que();
                                }

                            }
                        };
                        xmlhttp.open("GET", "../forajax/load_questions.php?questionno=" + questionno, true);
                        xmlhttp.send(null);
                    }

                    function radioclick(radiovalue, questionno) {
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function () {
                            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                            }
                        };
                        xmlhttp.open("GET", "../forajax/save_answer_in_session.php?questionno=" + questionno + "&value1=" + radiovalue, true);
                        xmlhttp.send(null);
                    }

                    function load_previous() {
                        if (questionno == "1") {
                            load_questions(questionno);
                        } else {
                            questionno = eval(questionno) - 1;
                            load_questions(questionno);
                        }
                    }

                    function load_next() {
                        questionno = eval(questionno) + 1;
                        load_questions(questionno);
                    }

                </script>

<?php
include "footer_timer.php";
?>