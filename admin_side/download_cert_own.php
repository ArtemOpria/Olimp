<?php

require_once "PDF_Certificate/fpdf.php";

if (isset($_POST["submit1"])) {
    $font = "PDF_Certificate/Arkhip.ttf";
    $image = imagecreatefrompng("../images/Certificate.png");
    $color = imagecolorallocate($image, 19, 21, 22);
    $name = $_POST["name_certificate"];
    imagettftext($image, 25, 0, 220, 310, $color, $font, $name);
    imagepng($image, "Certificates/" . $name . ".png");

    $pdf = new FPDF('L', 'in', [10,7.5]);
    $pdf->AddPage();
    $pdf->Image("Certificates/" . $name . ".png", 0, 0, 10, 7.5);
    ob_end_clean();
    $pdf->Output($name . ".pdf", "D");


}
?>
