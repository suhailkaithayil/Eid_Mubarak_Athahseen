<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    
    // Load the eid_mubarak image
    $eid_mubarak = @imagecreatefromjpeg('/var/www/html/CongratulationsCard.jpg');
    if (!$eid_mubarak) {
        die('Error loading Eid_Mubarak image');
    }

    $font_path = '/var/www/html/MATURASC.TTF';
    $font_size = 50;
    $text_color = imagecolorallocate($eid_mubarak, 154, 13, 82);
    $text_box = imagettfbbox($font_size, 0, $font_path, $name);
    $text_width = abs($text_box[2] - $text_box[0]);
    $text_height = abs($text_box[5] - $text_box[3]);
    $x = (imagesx($eid_mubarak) - $text_width) / 2;
    $y = (imagesy($eid_mubarak) - $text_height) / 2 - 50;
    imagettftext($eid_mubarak, $font_size, 0, $x, $y, $text_color, $font_path, $name);
    header('Content-Type: image/jpeg');
    header('Content-Disposition: attachment; filename="Athahseen_eid_mubarak.jpg"');
    imagejpeg($eid_mubarak);
    imagedestroy($eid_mubarak);
    exit;
}
?>
