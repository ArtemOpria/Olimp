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

$username = "";
$email = "";
$avatar = "";
$contact = "";

$res = mysqli_query($link, "select * from registration where username='$_SESSION[username]'");
while ($row = mysqli_fetch_array($res)) {
    $username = $row["username"];
    $email = $row["email"];
    $avatar = $row["avatar"];
    $contact = $row["contact"];
}

?>
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Оновлення інформації</h1>
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
                                                <label class="form-control-label">Ім'я та прізвище</label>
                                                <input type="text" placeholder="" class="form-control" name="username"
                                                       value="<?php echo $username; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label">Електронна пошта</label>
                                                <input type="email" placeholder="" class="form-control" name="email"
                                                       value="<?php echo $email; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label">Зображення профілю</label>
                                                <img src="<?php echo $avatar; ?>" width="70">
                                                <input type="file" placeholder="" class="form-control" name="avatar"
                                                       style="padding-bottom: 35px;">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label">Контактний номер
                                                    телефону</label>
                                                <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}"
                                                       placeholder="" class="form-control" name="contact"
                                                       value="<?php echo $contact; ?>" required>
                                            </div>

                                            <div class="form-group">

                                                <input type="submit" name="submit1" value="Оновити інформацію"
                                                       class="btn btn-success">

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

    $avatar = $_FILES["avatar"]["name"];
    $tm = md5(time());
    if ($avatar!="") {
        $dst1 = "../user_side/uploads/" . $tm . $avatar;
        $dst_db1 = "uploads/" . $tm . $avatar;
        move_uploaded_file($_FILES["avatar"]["tmp_name"], $dst1);
        mysqli_query($link, "update registration set username='$_POST[username]', 
                     email='$_POST[email]', avatar='$dst_db1', contact='$_POST[contact]' where id=$id");
    }
    else{
        mysqli_query($link, "update registration set username='$_POST[username]', email='$_POST[email]', 
                        contact='$_POST[contact]' where id=$id");
    }
    ?>
    <script type="text/javascript">
        window.location="user_info.php";
    </script>
    <?php
}
?>


<?php
include "footer.php";
?>