<?php
session_start();
include "../connection.php";

$question_no = "";
$question = "";
$opt1 = "";
$opt2 = "";
$opt3 = "";
$opt4 = "";
$answer = "";
$count = 0;
$ans = "";


$queno = $_GET["questionno"];

if (isset($_SESSION["answer"][$queno])) {
    $ans = $_SESSION["answer"][$queno];
}

$res = mysqli_query($link, "select * from questions where category='$_SESSION[exam_category]' && question_no=$_GET[questionno]");
$count = mysqli_num_rows($res);


if ($count == 0) {
    echo "over";
} else {

    while ($row = mysqli_fetch_array($res)) {
        $question_no = $row["question_no"];
        $question = $row["question"];
        $opt1 = $row["opt1"];
        $opt2 = $row["opt2"];
        $opt3 = $row["opt3"];
        $opt4 = $row["opt4"];
    }
    ?>
    <table>
        <tr>
            <style>
                .ques {
                    font-size: 30px;
                    font-weight: 500;
                    padding-left: 10px;
                }

                .answ{
                    font-size: 30px;
                    margin-left: 20px;
                }
                @media screen and (max-width: 600px) {
                    .ques {
                        font-size: 22px;
                    }
                    .answ{
                        font-size: 22px;
                        margin-left: 10px;
                    }
                }
            </style>
                <td class="ques" colspan="2">
                <?php echo $question; ?>
            </td>
        </tr>
    </table>

    <table class="answ">
        <tr>
            <td>
                <label class="containerR">
                <input type="radio" name="r1" id="r1" value="<?php echo $opt1; ?>"
                       onclick="radioclick(this.value, <?php echo $question_no ?>)"
                <?php
                if ($ans == $opt1) {
                    echo "checked";
                }
                ?>>
                    <span class="checkmark"></span>
                </label>
            </td>
            <td style="padding-left: 10px;">
                <?php
                if (strpos($opt1, 'images/') != false) {

                    ?>
                    <img src="../admin_side/<?php echo $opt1; ?>" height="160" width="160" style="padding-bottom: 10px;">
                    <?php
                } else {
                    echo $opt1;
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <label class="containerR">
                <input type="radio" name="r1" id="r1" value="<?php echo $opt2; ?>"
                       onclick="radioclick(this.value, <?php echo $question_no ?>)"
                <?php
                if ($ans == $opt2) {
                    echo "checked";
                }
                ?>>
                    <span class="checkmark"></span>
                </label>
            </td>
            <td style="padding-left: 10px;">
                <?php
                if (strpos($opt2, 'images/') != false) {

                    ?>
                    <img src="../admin_side/<?php echo $opt2; ?>" height="160" width="160" style="padding-bottom: 10px;">
                    <?php
                } else {
                    echo $opt2;
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <label class="containerR">
                <input type="radio" name="r1" id="r1" value="<?php echo $opt3; ?>"
                       onclick="radioclick(this.value, <?php echo $question_no ?>)"
                <?php
                if ($ans == $opt3) {
                    echo "checked";
                }
                ?>>
                    <span class="checkmark"></span>
                </label>
            </td>
            <td style="padding-left: 10px;">
                <?php
                if (strpos($opt3, 'images/') != false) {

                    ?>
                    <img src="../admin_side/<?php echo $opt3; ?>" height="160" width="160" style="padding-bottom: 10px;">
                    <?php
                } else {
                    echo $opt3;
                }
                ?>
            </td>
        </tr>

        <tr>
            <td>
                <label class="containerR">
                <input type="radio" name="r1" id="r1" value="<?php echo $opt4; ?>"
                       onclick="radioclick(this.value, <?php echo $question_no ?>)"
                <?php
                if ($ans == $opt4) {
                    echo "checked";
                }
                ?>>
                    <span class="checkmark"></span>
                </label>
            </td>
            <td style="padding-left: 10px;">
                <?php
                if (strpos($opt4, 'images/') != false) {

                    ?>
                    <img src="../admin_side/<?php echo $opt4; ?>" height="160" width="160" style="padding-bottom: 10px;">
                    <?php
                } else {
                    echo $opt4;
                }
                ?>
            </td>
        </tr>
    </table>


    <?php
}
?>
