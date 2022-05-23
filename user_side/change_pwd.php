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

$id = $_GET["id"];

$password = "";

$res = mysqli_query($link, "select * from registration where username='$_SESSION[username]'");
while ($row = mysqli_fetch_array($res)) {
    $password = $row["password"];
}

?>
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Оновлення паролю</h1>
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
                                            <strong>Оновлення інформації про користувача</strong>
                                        </div>
                                        <div class="card-body card-block">
                                            <div class="form-group">
                                                <label class=" form-control-label">Поточний пароль</label>
                                                <input type="password" placeholder="" class="form-control" name="old_password"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label">Новий пароль</label>
                                                <input type="password" placeholder="" class="form-control" name="new_password"
                                                        required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label">Повторіть новий пароль</label>
                                                <input type="password" placeholder="" class="form-control" name="new_passwordR"
                                                        required>
                                            </div>

                                            <div class="form-group">

                                                <input type="submit" name="submit1" value="Змінити пароль"
                                                       class="btn btn-success">

                                            </div>
                                            <div class="alert alert-danger" id="failure" style="margin-top: 10px; display: none">
                                                <strong>Поточний пароль не співпадає</strong>
                                            </div>
                                            <div class="alert alert-danger" id="failure2" style="margin-top: 10px; display: none">
                                                <strong>Поля "Новий пароль" та "Повторіть новий пароль" повинні бути однакові</strong>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/.col-->
            </div>

        </div><!-- .animated -->
    </div><!-- .content -->

<?php
if (isset($_POST["submit1"])) {

    ?>
    <script type="text/javascript">
        document.getElementById("failure").style.display = "none";
    </script>
    <script type="text/javascript">
        document.getElementById("failure2").style.display = "none";
    </script>
    <?php


    if ($_POST["old_password"] === $password){
        if ($_POST["new_password"] === $_POST["new_passwordR"]){
            mysqli_query($link, "update registration set password='$_POST[new_password]' where id=$id");
            ?>
            <script type="text/javascript">
                alert("Пароль успішно змінено");
                window.location="user_info.php";
            </script>
            <?php
        }
        else{
            ?>
            <script type="text/javascript">
                document.getElementById("failure2").style.display = "block";
            </script>
            <?php
        }
    }
    else{
        ?>
        <script type="text/javascript">
            document.getElementById("failure").style.display = "block";
        </script>
        <?php
    }
}
?>


<?php
include "footer.php";
?>