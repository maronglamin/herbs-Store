<?php
require_once $_SERVER['DOCUMENT_ROOT'] . './harbStore/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "Herbs Records");
}
if ($user_data['user_role'] != ADMIN_USER) {
    login_error_redirect(PROOT . "index.php", "Admin Pages");
}
include(ROOT . DS . "app" . DS . "components" . DS . "admin_nav.php");

$herb_data = $db->query("SELECT * FROM `herbs` WHERE `deleted` != '1'");

$name = ((isset($_POST['name'])) ? sanitize($_POST['name']) : '');
$remedy = ((isset($_POST['remedy'])) ? sanitize($_POST['remedy']) : '');
$price = ((isset($_POST['price'])) ? sanitize($_POST['price']) : '');
$desc = ((isset($_POST['desc'])) ? sanitize($_POST['desc']) : '');
$errors = [];
?>
<br><br>
<?php if (isset($_GET['ftr']) || (isset($_GET['remove'])) || (isset($_GET['delete']))) :
    if (isset($_GET['ftr'])) {
        $id = (int)sanitize($_GET['ftr']);
        $db->query("UPDATE `herbs` SET `featured` = '1' WHERE `id` = '{$id}'");
        $_SESSION['success_mesg'] .= 'Herbical product featured to the front page';
        redirect('herbs.php');
    }
    if (isset($_GET['remove'])) {
        $id = (int)sanitize($_GET['remove']);
        $db->query("UPDATE `herbs` SET `featured` = '0' WHERE `id` = '{$id}'");
        $_SESSION['success_mesg'] .= 'Herbical product removed to the front page';
        redirect('herbs.php');
    }
    if (isset($_GET['delete'])) {
        $id = (int)sanitize($_GET['delete']);
        $db->query("UPDATE `herbs` SET `deleted` = '1' WHERE `id` = '{$id}'");
        $_SESSION['success_mesg'] .= 'Herbical product send to trash records';
        redirect('herbs.php');
    }
?>

<?php endif; ?>
<?php if (isset($_GET['details'])) : ?>
    <?= include('details.php'); ?>
<?php else : ?>
    <div class="container-fluid">
        <div class="grid">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h2 class="text-primary">Herbalic Record Entry Point</h2>
                        <p>Add record of Herbalic Products and feature them to client space.</p>
                    </div>
                    <div class="well" style="background-color:#fff;">
                        <h2 class="text-center">Add New Herbalic Products</h2>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <form action="herbs.php" method="post" enctype="multipart/form-data">
                                    <?php include('validate.php'); ?>
                                    <div class="form-group">
                                        <div class="col-md-12 form-group">
                                            <label for="name">Herb Name</label>
                                            <input type="text" name="name" placeholder="Herb Name" id="name" class="form-control">
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <input type="text" name="remedy" placeholder="Remedy" id="remedy" class="form-control">
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <input type="text" min="1" name="price" placeholder="Price" id="price" class="form-control">
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <textarea type="text" name="desc" placeholder="Write some description about this HERB" id="desc" class="form-control"></textarea>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <input type="file" name="photo" id="photo" class="form-control">
                                        </div>
                                        <button type="sumbit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Save</button>
                                        <button type="reset" class="btn btn-info"> Cancel</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-10 col-md-offset-1">
                                <table class="table table-responsive table-bordered table-striped table-hover table-condensed">
                                    <thead>
                                        <th>Herb's Name</th>
                                        <th>Remedy</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <?php while ($herb = mysqli_fetch_assoc($herb_data)) : ?>
                                            <tr>
                                                <td><?= $herb['name'] ?></td>
                                                <td><?= $herb['remedy'] ?></td>
                                                <td><?= 'GMD ' . $herb['price'] ?></td>
                                                <td><?= substrwords($herb['descr'], 70) ?></td>
                                                <td>
                                                    <a href="herbs.php?details=<?= $herb['id'] ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-resize-full"> </span> Details</a>
                                                    <?php if ($herb['featured'] == 0) : ?>
                                                        <a href="herbs.php?ftr=<?= $herb['id'] ?>" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-repeat"></span> Feature</a>
                                                    <?php else : ?>
                                                        <a href="herbs.php?remove=<?= $herb['id'] ?>" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-exclamation-sign"></span> Remove</a>
                                                    <?php endif; ?>
                                                    <a href="herbs.php?delete=<?= $herb['id'] ?>" class="btn btn-xs btn-danger"> <span class="glyphicon glyphicon-trash"></span> Delete</a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php endif; ?>


<?php require_once(ROOT . DS . "core" . DS . "resource" . DS . "script.php");
