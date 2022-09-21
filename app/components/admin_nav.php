<nav class="navbar navbar-fixed-top navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= PROOT ?>app/users/admin/dashboard.php">Customer Sales</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <a class="navbar-brand" href="<?= PROOT ?>app/users/admin/herbs.php">Herbs Records</a>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle glyphicon glyphicon-user" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Admin User<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= PROOT ?>app/users/admin/users.php">Users</a></li>
                        <li><a href="<?= PROOT ?>app/users/admin/add_admin.php">Add admin</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="../../components/change_password.php?change=<?= $user_data['user_id'] ?>">Change Password</a></li>
                        <li><a href="../../components/logout.php">Sign out</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>