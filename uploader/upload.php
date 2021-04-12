<?php

/**
 * Upload file in php
 * 
 * @see https://daskhat.ir/upload-file-in-php/
 * @copyright Daskhat
 * @version 1.0.0
 * 
 */

if (isset($_POST['submit']) && !empty($_FILES["fileToUpload"]["tmp_name"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $message = array();
// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            $message[] = "پرونده یک تصویر است -" . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $message[] = "پرونده تصویری نیست.";
            $uploadOk = 0;
        }
    }
 
// Check if file already exists
    if (file_exists($target_file)) {
        $message[] = "با عرض پوزش ، پرونده از قبل وجود دارد.";
        $uploadOk = 0;
    }
 
// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $message[] = "با عرض پوزش ، پرونده شما بسیار بزرگ است.";
        $uploadOk = 0;
    }
 
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        $message[] = "متاسفیم فرمت فایل شما باید JPG, JPEG, PNG & GIF باشد.";
        $uploadOk = 0;
    }
 
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $message[] = "متاسفانه فایل شما به درستی آپلود نشد!";
 
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $message[] = "فایل شما با نام " . basename($_FILES["fileToUpload"]["name"]) . "به خوبی آپلود شد.";
        } else {
            $message[] = "متأسفیم ، هنگام بارگذاری پرونده شما خطایی رخ داد.";
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</head>

<body>
    <br>
    <div class="containers">
        <form id="upload-form" action="upload.php" method="post" enctype="multipart/form-data">

            <p class="form-element">
                <label>تصویر را انتخاب کنید:</label>
                <br>
                <br>
                <input type="file" name="fileToUpload" id="fileToUpload">
            </p>

            <p class="form-element">
                <input type="submit" value="آپلود تصویر" name="submit">
            </p>
        </form>
    </div>
  <br>
    <?php if (isset($message)) { ?>
        <div class="container alert alert-primary">
            <?php echo implode('<br>', $message); ?>
        </div>
        <br>
    <?php 
} ?>
</body>
</html>
