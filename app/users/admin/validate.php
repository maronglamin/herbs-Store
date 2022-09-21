<?php  
if (isset($_POST['submit'])) {
    $filename =  date("Y-m-d", time()) . "-" .  $_FILES['photo']['name'];
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $destination = '../../photos/' . $filename;
    $size = $_FILES['photo']['size'];
    $file = $_FILES['photo']['tmp_name'];
    if (!in_array($extension, ['jpg', 'png', 'jpng', 'JPG', 'PNG', 'JPNG'])) {
        $errors[] .= 'Photo format isn\'t allowed';
    }
    if ($_FILES['photo']['size'] > 1000000) {
        $errors[] .= 'file shouldn\'t be larger than 1 Megabyte';
    }
    if ($filename == EMPTY_VALUE) {
        $errors[] .= 'No scanned file selected';
    }

    $required = ['name', 'remedy', 'price', 'desc'];
    foreach ($required as $fields) {
        if ($_POST[$fields] == EMPTY_VALUE) {
            $errors[] = 'You must fill out the fields.';
            break;
        }
    }

    if (!empty($errors)) {
        echo display_errors($errors);
    } else {
        if (move_uploaded_file($file, $destination)) {
            $url = ltrim($destination, '../..');
            $db->query("INSERT INTO `herbs`(`name`, `remedy`, `price`, `descr`, `photo_url`) VALUES ('{$name}','{$remedy}','{$price}','{$desc}', '{$url}')");
            $_SESSION['success_mesg'] .= 'Herbs added successfully';
            redirect('herbs.php');
        }
    }
}
