<?php
require_once $_SERVER['DOCUMENT_ROOT'] . './harbStore/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "Dashboard");
}
if ($user_data['user_role'] != ADMIN_USER) {
    login_error_redirect(PROOT . "index.php", "Admin Pages");
}
include(ROOT . DS . "app" . DS . "components" . DS . "admin_nav.php");

$paid = $db->query("SELECT * FROM `shopping_cart` WHERE `paid` = '1' ORDER BY `date_added` DESC");

?>
<br><br>
<div class="container-fluid">
    <div class="grid">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="text-primary">Sales Management</h2>
                    <p>Get an update sales on featured herbical products.</p>
                </div>
                <div class="well col-md-8 col-md-offset-2" style="background-color:#fff;">
                    <h2 class="text-center">Sales Records</h2>
                    <div class="row">
                        <?php while ($sale = mysqli_fetch_assoc($paid)) :
                            $hid = $sale['herb_id'];
                            $herbs = $db->query("SELECT * FROM `herbs` WHERE `id` = '{$hid}'");
                        ?>
                            <?php while ($herb = mysqli_fetch_assoc($herbs)) : ?>
                                <div class="container col-md-12">
                                    <h3><?= mm_yy($sale['paid_at']) ?></h3>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><Strong>Herb Name</Strong>: <?= $herb['name'] ?><span class="badge pull-right">Price: <?= $herb['price'] ?></span> </li>
                                        <li class="list-group-item"><Strong>Paid to EmailAddress: </Strong> <?= $sale['email_at_buying'] ?></li>
                                        <li class="list-group-item"><Strong>Date added to shopping cart: </Strong><?= human_date($sale['date_added']) ?></li>
                                        <li class="list-group-item"><Strong>Date Sole from store:</Strong> <?= human_date($sale['paid_at']) ?></li>
                                    </ul>
                                </div>
                            <?php endwhile; ?>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once(ROOT . DS . "core" . DS . "resource" . DS . "script.php");
