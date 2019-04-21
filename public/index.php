<?php

if (!empty($_FILES['upload']['name'][0])) {
    $files = $_FILES['upload'];

    $uploaded = [];
    $failed = [];
    $uploadDir = 'upload/';
    $allowed = ['png', 'jpg', 'gif'];

    foreach ($files['name'] as $position => $file_name) {
        $file_size = $files['size'][$position];
        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));
        $file_tmp = $files['tmp_name'][$position];
        $file_name_new = 'image' . uniqid() . '.' . $file_ext;
        $file_destination = $uploadDir . $file_name_new;
        if (in_array($file_ext, $allowed)) {
            if ($file_size <= 1000000) {
                $uploadFile = $uploadDir . basename($file_name);
                (move_uploaded_file($file_tmp, $file_destination));
            }
        }
    }
}

?>


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>File quest</title>
</head>
<body>
<h1>Formulaire d'envoi</h1>

<form action="index.php" enctype="multipart/form-data" method="post">
    <div class="input-group mb-3">
        <div class="custom-file">
            <input type="file" multiple="multiple" class="custom-file-input" id="upload" name="upload[]">
            <label class="custom-file-label" for="upload">Choisissez vos fichiers à envoyer</label>
        </div>
    </div>
    <p><input type="submit" name="submit" value="Submit"></p>
</form>
<?php
$dataDir = __DIR__ . '/upload';

$iterator = new RecursiveDirectoryIterator($dataDir, FilesystemIterator::SKIP_DOTS);
foreach ($iterator as $picture) {
    $pic = $picture->getFilename(); ?>
    <div class="row">
        <div class="col-xs-6 col-md-3">
            <img src="upload/<?= $pic ?>" class="img-thumbnail" alt="Nature">
            <p><?= $pic ?></p>
            <form action="delete.php" method="post">
                <button name="delete" value="<?= $pic ?>">Delete</button>
            </form>
        </div>
    </div>
    <hr>
<?php } ?>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>
