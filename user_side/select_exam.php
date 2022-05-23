<?php
session_start();
if (!isset($_SESSION["username"])) {

    ?>
    <script type="text/javascript">
        window.location = "login.php";
    </script>
    <?php

}
?>

<?php
include "../connection.php";
include "header.php";
?>

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Вибір категорії</h1>
                </div>
            </div>
        </div>

    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row" >
                <div class="col-md-4 offset-md-4" >
                    <div class="card">
                        <div class="card-body">

                            <center>
                                <h3>Доступні категорії</h3>
                            </center>

                            <?php
                            $res = mysqli_query($link, "select * from exam_category");
                            while ($row = mysqli_fetch_array($res)) {
                                ?>
                                <input type="button" class="btn btn-success form-control my-but2" value="<?php echo $row["category"]; ?>"
                                       style="width: 100%;"
                                       onclick="set_exam_type_session(this.value);" align="center">
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div> <!--/.col-->
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
<?php
include "footer.php";
?>

<script type="text/javascript">
    function set_exam_type_session(exam_category){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function (){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

                window.location = "dashboard.php";
            }
        };
        xmlhttp.open("GET", "../forajax/set_exam_type_session.php?exam_category=" + exam_category, true);
        xmlhttp.send(null);
    }
</script>