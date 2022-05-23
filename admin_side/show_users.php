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
                    <h1>Список користувачів</h1>
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
                                <h1>Зареєстровані користувачі</h1>
                            </center>
                            <?php
                            $count = 0;
                            $res = mysqli_query($link, "select * from registration order by id desc");
                            $count = mysqli_num_rows($res);

                            if ($count == 0) {
                                ?>
                                <center>
                                    <h1>Зареєстрованих користувачів не знайдено</h1>
                                </center>
                                <?php
                            } else {
                                echo "<div style='overflow: auto'>";
                                echo "<table class='table table-bordered' style='margin-top: 20px;'>";
                                echo "<tr style='background-color: #272c33; color: white;'> ";
                                echo "<th>"; echo "Ім'я"; echo "</th>";
                                echo "<th>"; echo "Прізвище"; echo "</th>";
                                echo "<th>"; echo "Псевдонім"; echo "</th>";
                                echo "<th>"; echo "Електрона пошта"; echo "</th>";
                                echo "<th>"; echo "Аватар"; echo "</th>";
                                echo "<th>"; echo "Контактний номер телефону"; echo "</th>";
                                echo "<th>"; echo "Редагування"; echo "</th>";
                                echo "<th>"; echo "Видалення"; echo "</th>";
                                echo "</tr>";

                                while ($row = mysqli_fetch_array($res)){
                                    echo "<tr align='center' style='font-size: 20px'>";
                                    echo "<td style='padding-top: 40px;'>"; echo $row["firstname"]; echo "</td>";
                                    echo "<td style='padding-top: 40px;'>"; echo $row["lastname"]; echo "</td>";
                                    echo "<td style='padding-top: 40px;'>"; echo $row["username"]; echo "</td>";
                                    echo "<td style='padding-top: 40px;'>"; echo $row["email"]; echo "</td>";
                                    echo "<td><img src='../user_side/".$row["avatar"]."' width='90'></td>";
                                    echo "<td style='padding-top: 40px;'>"; echo $row["contact"]; echo "</td>";
                                    echo "<td style='padding-top: 40px;'>";
                                    ?>
                                    <a href="edit_user_info.php?id=<?php echo $row["id"]; ?>"> Редагувати</a>
                                    <?php
                                    echo "</td>";
                                    echo "<td style='padding-top: 40px;'>";
                                    ?>
                                    <a href="delete_user.php?id=<?php echo $row["id"]; ?>"> Видалити</a>
                                    <?php
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                                echo "</div>";

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