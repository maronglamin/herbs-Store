<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/harbStore/core/connection/init.php';
// require_once(ROOT . DS . "core" . DS . "resource" . DS . "user_inputs.php");

$reg_name = ((isset($_POST['name'])) ? sanitize($_POST['name']) : '');
$reg_user_name = ((isset($_POST['user_name'])) ? sanitize($_POST['user_name']) : '');
$reg_email = ((isset($_POST['email'])) ? sanitize($_POST['email']) : '');
$reg_roles = "2";
$reg_password = ((isset($_POST['password'])) ? sanitize($_POST['password']) : '');
$reg_password_confirm = ((isset($_POST['password_confirmed'])) ? sanitize($_POST['password_confirmed']) : '');

$reg_password = trim($reg_password);
$reg_password_confirm = trim($reg_password);

?>


<br><br><br>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2 col-sm-6 col-md-4 col-md-offset-4 well">
            <h3 class="text-center text-primary">SIGN UP</h3><br>
            <?php
            if ($_POST) {

                $emailQuery = $db->query("SELECT * FROM users WHERE email = '{$reg_email}' ");
                $emailCount = mysqli_num_rows($emailQuery);

                $userQuery = $db->query("SELECT * FROM users WHERE `user_name` = '{$reg_user_name}'");
                $userCount = mysqli_num_rows($userQuery);

                if ($emailCount != 0) {
                    $errors[] = 'That email exist in our database';
                }

                if ($userCount != 0) {
                    $errors[] = 'That user name exist in our database';
                }

                $required = array('name', 'email', 'user_name', 'password', 'password_confirmed');
                foreach ($required as $fields) {
                    if ($_POST[$fields] == '') {
                        $errors[] = 'You must fill out all fields marked with star(*).';
                        break;
                    }
                }
                if (strlen($reg_password) < 6) {
                    $errors[] = 'The password must be at least 6 characters.';
                }
                if ($reg_password != $reg_password_confirm) {
                    $errors[] = 'Your password does not match the confirmation';
                }
                if (!empty($errors)) {
                    echo display_errors($errors);
                } else {
                    // add user
                    $hashed = password_hash($reg_password, PASSWORD_DEFAULT);
                    $db->query("INSERT INTO users (`full_name`, `email`, `user_name`, `password`, `user_role`) VALUES('$reg_name','$reg_email', '$reg_user_name', '$hashed', $reg_roles)");
                    $_SESSION['success_mesg'] = 'Registration successful.';
                    redirect(PROOT . 'login.php');
                }
            }
            ?>
            <form action="#" method="post" enctype="multipart/form-data">
                <p class="text-left text-danger">Required fields <strong>*</strong></p>
                <div class="form-group">
                    <label for="name">Full Name*:</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">User Name*:</label>
                    <input type="text" name="user_name" id="user_name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email*:</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password*:</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password_confirmed">Confirm Password*:</label>
                    <input type="password" name="password_confirmed" id="password_confirmed" class="form-control">
                </div>
                <div>
                    <input class="btn btn-primary btn-block" type="submit" value="Register">
                    <a href="<?= PROOT ?>index.php" class="btn btn-danger btn-block">Cancel</a>
                    <br>
                    Have an account! <a href="<?= PROOT ?>login.php">Sign in</a>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>