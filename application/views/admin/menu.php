<div class="container">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?= base_url() ?>admin">Rupsha</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse navbar-right">
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Settings <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="<?= base_url() ?>admin/settings/account">Account</a></li>
                    <!--<li><a href="<?= base_url() ?>admin/settings/gallery">Gallery</a></li> tbd -->
                    <?php if (true === $this->authentication->is_admin()): ?>
                        <li class="divider"></li>
                        <li class="dropdown-header">Administration</li>
                        <li><a href="<?= base_url() ?>admin/settings/page">Page</a></li>
                        <li><a href="<?= base_url() ?>admin/settings/mainpage">Mainpage</a></li>
                        <li><a href="<?= base_url() ?>admin/settings/users">Users</a></li>
                    <?php endif; ?>
                </ul>
            </li>
        </ul>
        <a href="<?= base_url() ?>admin/login/logout" class="btn btn-success navbar-btn navbar-right">Log out</a>
    </div><!--/.nav-collapse -->
</div><!--/.container -->