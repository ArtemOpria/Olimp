<?php
session_start();
include "../connection.php";
?>

    <!doctype html>
    <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
    <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
    <!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
    <!--[if gt IE 8]><!-->
    <html class="no-js" lang="en">
    <!--<![endif]-->

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Користувач - Реєстрація</title>
        <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="../images/favicon.ico" type="image/x-icon">

        <meta name="viewport" content="width=device-width, initial-scale=1">




        <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../vendors/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../vendors/themify-icons/css/themify-icons.css">
        <link rel="stylesheet" href="../vendors/flag-icon-css/css/flag-icon.min.css">
        <link rel="stylesheet" href="../vendors/selectFX/css/cs-skin-elastic.css">

        <link rel="stylesheet" href="../assets/css/style.css">

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>



    </head>

    <body style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.8)), url(../images/fourth_page.jpg);
    height: 100vh;
    -webkit-background-size: cover;
    background-size: cover;
    background-position: center center;">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content animated fadeIn" style="animation-duration: 1s">
                <div class="login-logo" style="color: white">
                    КОРИСТУВАЧ - РЕЄСТРАЦІЯ
                </div>
                <div class="login-form">
                    <form name="form1" action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Прзвище та ім'я</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Пароль</label>
                            <input type="password" name="password" class="form-control" placeholder="******" required>
                        </div>
                        <div class="form-group">
                            <label>Електронна пошта</label>
                            <input type="email" name="email" class="form-control" placeholder="example@gmail.com" required>
                        </div>
                        <div class="form-group">
                            <label>Зображення профілю</label>
                            <input type="file" name="avatar" class="form-control"
                                   style="padding-bottom: 35px;">
                        </div>
                        <div class="form-group">
                            <label>Контактний номер телефону</label>
                            <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}"
                                   name="contact" class="form-control" placeholder="099-999-99-99" required>
                        </div>
                        <button type="submit" name="submit1" class="btn btn-success btn-flat m-b-30 m-t-30">Реєстрація</button>

                        <button name="login" class="btn btn-success btn-flat m-b-30 m-t-30" style="margin-top: 10px;"
                                onclick="document.location = 'login.php'">Вхід</button>

                        <div class="alert alert-success" id="success" style="margin-top: 10px; display: none">
                            <strong>Аккаунт успішно зареєстровано</strong>
                        </div>
                        <div class="alert alert-danger" id="failure" style="margin-top: 10px; display: none">
                            <strong>Аккаунт з таким ім'ям вже існує</strong>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>


<?php
if (isset($_POST["submit1"])) {

    $count = 0;
    $res = mysqli_query($link,"select * from registration where username='$_POST[username]'") or die(mysqli_error($link));
    $count = mysqli_num_rows($res);

    if($count>0){
        ?>
        <script type="text/javascript">
            document.getElementById("success").style.display = "none";
            document.getElementById("failure").style.display = "block";
        </script>
        <?php
    } else {

        $tm = md5(time());

        $fnm = $_FILES['avatar']['name'];
        $dst = "uploads/" . $tm . $fnm;
        $dst_db = "uploads/" . $tm . $fnm;
        move_uploaded_file($_FILES['avatar']['tmp_name'], $dst);

        mysqli_query($link, "insert into registration values(null, '$_POST[username]','$_POST[password]',
                                '$_POST[email]','$dst_db','$_POST[contact]')") or die(mysqli_error($link));
        ?>
        <script type="text/javascript">
            document.getElementById("success").style.display = "block";
            document.getElementById("failure").style.display = "none";
        </script>
        <?php
    }
}
?>
    </body>

</html>
