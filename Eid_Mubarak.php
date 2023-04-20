<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];

    // Load the eid_mubarak image
    $eid_mubarak = @imagecreatefromjpeg('EidCard.jpg');
    if (!$eid_mubarak) {
        die('Error loading Eid_Mubarak image');
    }
    
    $is_arabic = preg_match('/\p{Arabic}/u', $name);
    if ($is_arabic) {
        $reversed_name = implode('', array_reverse(preg_split('//u', $name, null, PREG_SPLIT_NO_EMPTY)));
    } else {
        $reversed_name = $name;
    }

    $font_path = '/public_html/Cairo-SemiBold.ttf';
    $font_size = 40;
    $text_color = imagecolorallocate($eid_mubarak, 184, 134, 11);
    $text_box = imagettfbbox($font_size, 0, $font_path, $reversed_name);
    $text_width = abs($text_box[2] - $text_box[0]);
    $text_height = abs($text_box[5] - $text_box[3]);
    $x = (imagesx($eid_mubarak) - $text_width) / 2;
    $y = (imagesy($eid_mubarak) - $text_height) - 150;

    // Set text direction to left-to-right for Arabic text
    $text_direction = $is_arabic ? 'rtl' : 'ltr';
    imagettftext($eid_mubarak, $font_size, 0, $x, $y, $text_color, $font_path, $reversed_name, array('text_dir' => $text_direction));
    header('Content-Type: image/jpeg');
    header('Content-Disposition: attachment; filename="Athahseen_eid_mubarak.jpg"');
    imagejpeg($eid_mubarak);
    imagedestroy($eid_mubarak);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eid Mubarak</title>
    <link rel="icon" href="logo.png" type="image/png">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .logo {
            max-width: 100px;
        }

        .logo img {
            max-width: 100%;
            
        }

        h1 {
            margin-bottom: 20px;
            color: #1565c0; 
            font-family: 'Pacifico';
            font-weight: bold;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555555;
        }

        input[type="text"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #dddddd;
            border-radius: 3px;
            font-size: 16px;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #1976d2; 
            color: #ffffff;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #1565c0;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            color: #777777;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="logo.png" alt="Logo">
        </div>
        <h1>Eid Mubarak</h1>
        <form method="post" action="">
            <label for="name">Student Name:</label>
            <input type="text" id="name" name="name" required>
            <button type="submit">Eid Mubarak</button>
        </form>
        <div class="footer">
            <p>Thank you for visiting! &copy; 2023 Eid Mubarak. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
