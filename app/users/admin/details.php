<?php
if (isset($_GET['details'])) {
    $id = (int)sanitize($_GET['details']);
    $details = $db->query("SELECT * FROM `herbs` WHERE `id` = '{$id}'");

?>
    <div class="container">
        <h2 class="text-secondary">Harbical Drug Store</h2>
        <p text-primary>Herbical drugs that are effective in curing a described disease</p>
        <div class="col">
            <div class="grid">
                <div class="well" style="background-color: #fff;">
                    <h2 class="text-center">Details</h2>
                    <div class="row">
                        <?php while ($detail = mysqli_fetch_assoc($details)) : ?>
                            <div class="col-md-4">
                                <h3 class="text-center fst-bold"><?= $detail['name'] ?></h3>
                                <div>
                                    <img class="herb-img-detail" src="<?= PROOT . 'app/' . $detail['photo_url'] ?>" alt="">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="">
                                    <h3 class="text-center">Description</h3>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><Strong>Herb's Name</Strong>: <?= $detail['name'] ?> <span class="badge pull-right">Price: 65.08</span> </li>
                                        <li class="list-group-item"><Strong>Remedy For: </Strong>: <?= $detail['remedy'] ?></li>
                                        <li class="list-group-item"><Strong>Description:</Strong><br>
                                            <?= $detail['descr'] ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <?php if ($user_data['user_role'] == ADMIN_USER) : ?>
                                <a href="herbs.php" class="btn btn-primary"><span class="glyphicon glyphicon-back"></span> Back</a>
                            <?php else : ?>
                                <a href="<?= PROOT; ?>app/users/client/dashboard.php" class="btn btn-primary"><span class="glyphicon glyphicon-back"></span> Back</a>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>