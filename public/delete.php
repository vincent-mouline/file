<?php
if (!empty($_POST)) {
    $path = 'upload/' . $_POST['delete'];
    if (file_exists($path)) {
        unlink($path);
    }
}
header('location: index.php');
