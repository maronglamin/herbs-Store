<?php
require_once $_SERVER['DOCUMENT_ROOT'] . './harbStore/core/connection/init.php';
include(ROOT . DS . 'nav.php');
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "Dashboard");
}
if ($user_data['user_role'] != CLIENT_USER) {
    login_error_redirect(PROOT . "index.php", "client Pages");
}
$featured = $db->query("SELECT * FROM `herbs` WHERE `featured` = '1' AND `deleted` != '1'");
$id = $user_data['user_id'];

if (isset($_GET['user']) && isset($_GET['hid'])) {
    $userid = (int)sanitize($_GET['user']);
    $id = (int)sanitize($_GET['hid']);

    $checks = $db->query("SELECT * FROM `shopping_cart` WHERE `herb_id` = '{$id}' AND `user_id` = '{$userid}'");
    $checked = mysqli_fetch_assoc($checks);

    if ($checked == EMPTY_VALUE) {
        $db->query("INSERT INTO `shopping_cart` (`herb_id`, `user_id`) VALUES('{$id}', '{$userid}')");
        $_SESSION['success_mesg'] .= 'product add to shopping CART successfully';
    } else {
        $_SESSION['error_mesg'] .= 'product exist your shopping CART, please checkout the product';
    }
    redirect('dashboard.php');
}

?>
<br><br>
<div class="container-fuid">
    <div class="container">
        <h2 class="text-secondary">Harbical Drug Store</h2>
        <p text-primary>Herbical drugs that are effective in curing a described disease</p>
        <div class="col">
            <div class="grid">
                <div class="well" style="background-color: #fff;">
                    <h2 class="text-center">Featured Herbical Products</h2>
                    <div class="row">
                        <?php while ($ftr = mysqli_fetch_assoc($featured)) : ?>


                            <div class="col-md-4">
                                <h3 class="text-center fst-bold"><?= $ftr['name'] ?></h3>
                                <div>
                                    <img class="herb-img-detail" src="<?= PROOT . 'app/' . $ftr['photo_url'] ?>" alt="">
                                </div>
                                <div>
                                    <h4>Description</h4>
                                    <p><?= substrwords($ftr['descr'], 60) ?></p>
                                    <div><span class="badge">PRICE GMD <?= $ftr['price'] ?></span>
                                        <a href="details.php?details=<?= $ftr['id'] ?>" class="btn btn-default pull-right ms">Details</a>
                                        <a href="dashboard.php?user=<?= $id ?>&hid=<?= $ftr['id'] ?>" class="btn btn-success pull-right">To Cart</a>
                                    </div>
                                </div>
                            </div>

                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once(ROOT . DS . "core" . DS . "resource" . DS . "script.php");
