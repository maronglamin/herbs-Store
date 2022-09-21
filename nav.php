<nav class="navbar navbar-fixed-top navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php if (!is_logged_in()) : ?>
                <a class="navbar-brand" href="<?= PROOT ?>index.php">Harb Store</a>
            <?php else : ?>
                <a class="navbar-brand" href="<?= PROOT ?>app/users/client/dashboard.php">Harb Store</a>
            <?php endif; ?>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?php if (!is_logged_in()) : ?>
                    <a class="navbar-brand" href="register.php">Sign Up</a>
                    <a class="navbar-brand" href="login.php">Sign In</a>
                <?php else : ?>
                    <a class="navbar-brand" href="<?= PROOT ?>app/components/logout.php">Sing Out</a>
                    <a class="navbar-brand" href="<?= PROOT ?>app/users/client/shopping.php">Shopping Cart</a>
                <?php endif; ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>