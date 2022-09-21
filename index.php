<?php
require_once $_SERVER['DOCUMENT_ROOT'] . './harbStore/core/connection/init.php';
include(ROOT . DS . 'nav.php');
$featured = $db->query("SELECT * FROM `herbs` WHERE `featured` = '1' AND `deleted` != '1'");
?>
<br><br>
<div class="container-fuid">
    <div class="container">
        <h2 class="text-secondary">Harbical Drug Store</h2>
        <p class="text-primary">Herbical drugs that are effective in curing a described disease</p>
        <div class="col">
            <div class="grid">
                <div class="well" style="background-color: #fff;">
                    <p class="text-center">You must sing in to start adding items to your shoping cart</p>
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
                                    <div><span class="badge">PRICE GMD <?= $ftr['price'] ?></span><a href="" class="btn btn-success pull-right" disabled>To Cart</a>
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
