<?php
session_start();
include "header.php";
include "../connection.php";
include "download_cert_own.php";
if (!isset($_SESSION["admin"])) {
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
                    <h1>Генерація сертифікату</h1>
                </div>
            </div>
        </div>

    </div>

        <div class="content mt-3">
            <div class="animated fadeIn">


                <div class="row" align="center">
                    <div class="col-md-4 offset-md-4" style="font-size: 25px">
                        <div class="card">
                            <form name="form1" action="" method="post">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class=" form-control-label">Ім'я та прізвище</label>
                                        <input type="text" class="form-control"
                                               required="" name="name_certificate">
                                    </div>
                                    <div class="form-group">

                                        <input type="submit" name="submit1" value="Згенерувати сертифікат"
                                               class="btn btn-success">

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--/.col-->
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->

<?php
include "footer.php";
?>