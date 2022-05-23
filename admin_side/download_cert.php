<?php
session_start();
require "PDF_Certificate/fpdf.php";
include "../connection.php";
if(!isset($_SESSION["admin"])){
    ?>
    <script type="text/javascript">
        window.location = "admin_login.php";
    </script>
<?php
}

$id = $_GET["id"];
$res = mysqli_query($link, "select username from exam_results where id=$id");
while ($row = mysqli_fetch_array($res)) {
    $font = "../admin_side/PDF_Certificate/Arkhip.ttf";
    $image = imagecreatefrompng("../images/Certificate.png");
    $color = imagecolorallocate($image, 19, 21,22);
    $name = $row['username'];
    imagettftext($image, 30,0,220,310, $color, $font, $name);
    imagepng($image,"Certificates/".$name.".png");
    imagedestroy($image);

    $pdf = new FPDF('L', 'in', [10,7.5]);
    $pdf->AddPage();
    $pdf->Image("Certificates/".$name.".png",0,0,10,7.5);
    ob_end_clean();
    $pdf->Output($name.".pdf", "D");

}
?>

<script type="text/javascript">
    window.location = "old-exam-results.php";
</script>
