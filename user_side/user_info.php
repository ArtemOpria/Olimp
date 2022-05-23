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
?>

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Кабінет користувача</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            $count = 0;
                            $res = mysqli_query($link, "select * from registration where username='$_SESSION[username]'");
                            $count = mysqli_num_rows($res);

                            if ($count == 0) {
                                ?>
                                <center>
                                    <h3>Користувача не знайдено!</h3>
                                </center>
                                <?php
                            } else {
                                while ($row = mysqli_fetch_array($res)) {
                                    ?>
                                        <center>
                                    <img src="<?php echo $row["avatar"]; ?>" height="300" width="300">
                                        </center>
                                    <div style="font-size: 20px; margin-top: 10px;">
                                    <div><b>Ім'я та прізвище: </b><?php echo $row["username"]; ?></div>
                                    <div><b>Електронна пошта: </b><?php echo $row["email"]; ?></div>
                                    <div><b>Контактний номер телефону: </b><?php echo $row["contact"]; ?></div>
                                        </div>
                                    <center style="padding-top: 20px; font-size: 20px">
                                        <a href="edit_user_info.php?id=<?php echo $row["id"]; ?>" style="background: #515C6B; padding: 10px 25px; color: white; text-decoration: none; border-radius: 5px"> Редагувати профіль</a>&nbsp;<br><br>
                                        <a href="change_pwd.php?id=<?php echo $row["id"]; ?>" class="butthov" style="background: #515C6B; padding: 10px 25px; color: white; text-decoration: none; border-radius: 5px"> Змінити пароль</a>
                                    </center>
                                    <?php
                                }
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