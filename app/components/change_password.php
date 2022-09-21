<?php
require_once $_SERVER['DOCUMENT_ROOT'] . './harbStore/core/connection/init.php';
$errors = [];

if (isset($_GET['change'])) {
    $user_id = (int)sanitize($_GET['change']);

    $new_password = ((isset($_POST['new'])) ? sanitize($_POST['new']) : '');
    $confirm_password = ((isset($_POST['confirm'])) ? sanitize($_POST['confirm']) : '');

    if ($_POST) {
        if (strlen($new_password) < 6) {
            $errors[] = 'The password must be at least 6 characters.';
        }
        if ($new_password != $confirm_password) {
            $errors[] .= "Your new password and confirmation does not match";
        }
        if (!empty($errors)) {
            echo display_errors($errors);
        } else {
            $hashed = password_hash($new_password, PASSWORD_DEFAULT);
            $db->query("UPDATE `users` SET `password` = '{$hashed}', `change_password` = '1' WHERE `user_id` = '{$user_id}'");
            unset($_SESSION['ADMIN_USER_SESSIONS']);
            $_SESSION['success_mesg'] .= 'Password changed successfully.';
            redirect(PROOT . 'index.php');
        }
    }
?>
    <br><br><br><br><br>
    <div class="container-fluid">
        <div class="row">
            <div class="login-container well">
                <h3 class="text-center">Change Password!</h3>
                <hr>
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="new">New Password</label>
                        <input type="password" name="new" id="new" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="confirm">Confirm Password</label>
                        <input type="password" name="confirm" id="confirm" class="form-control">
                    </div>
                    <input type="submit" value="Change" class="btn btn-default">
                    <a href="<?= PROOT ?>app/users/admin/dashboard.php" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
<?php }
?>