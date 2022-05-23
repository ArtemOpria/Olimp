<?php
session_start();
include "header.php";
include "../connection.php";
error_reporting(E_ALL);
ini_set('display_errors', 'on');
if (!isset($_SESSION["admin"])) {
    ?>
    <script type="text/javascript">
        window.location = "admin_login.php";
    </script>
    <?php
}

$id = $_GET["id"];

$firstname = "";
$lastname = "";
$username = "";
$password = "";
$email = "";
$avatar = "";
$contact = "";

$res = mysqli_query($link, "select * from registration where id=$id");
while ($row = mysqli_fetch_array($res)) {
    $firstname = $row["firstname"];
    $lastname = $row["lastname"];
    $username = $row["username"];
    $password = $row["password"];
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
                                                <label class=" form-control-label">Ім'я</label>
                                                <input type="text" placeholder="" class="form-control" name="firstname"
                                                       value="<?php echo $firstname; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label">Прізвище</label>
                                                <input type="text" placeholder="" class="form-control" name="lastname"
                                                       value="<?php echo $lastname; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label">Псевдонім</label>
                                                <input type="text" placeholder="" class="form-control" name="username"
                                                       value="<?php echo $username; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label">Пароль</label>
                                                <input type="text" name="password" class="form-control"
                                                       value="<?php echo $password; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label">Електронна пошта</label>
                                                <input type="email" placeholder="" class="form-control" name="email"
                                                       value="<?php echo $email; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label">Зображення профілю</label>
                                                <img src="../user_side/<?php echo $avatar; ?>" width="70">
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
        $dst1 = "uploads/" . $tm . $avatar;
        $dst_db1 = "uploads/" . $tm . $avatar;
        move_uploaded_file($_FILES["avatar"]["tmp_name"], $dst1);
        mysqli_query($link, "update registration set firstname='$_POST[firstname]', lastname='$_POST[lastname]', 
                        username='$_POST[username]', password='$_POST[password]',
                     email='$_POST[email]', avatar='$dst_db1', contact='$_POST[contact]' where id=$id");
    }
    else{
        mysqli_query($link, "update registration set firstname='$_POST[firstname]', lastname='$_POST[lastname]', 
                        username='$_POST[username]', password='$_POST[password]',
                     email='$_POST[email]', contact='$_POST[contact]' where id=$id");
    }

    ?>
    <script type="text/javascript">
        window.location="show_users.php";
    </script>
    <?php
}
?>


<?php
include "footer.php";
?>