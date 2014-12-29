<body>
    <!--[if lt IE 7]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= base_url() ?>admin">Fotoshare</a>
            </div>
            <?php if (TRUE === $this->session->userdata("is_logged")): ?>
            <form action="<?=  base_url() ?>admin/uploader/logout" class="navbar-right" method="get">
                        <button type="submit" class="btn btn-success navbar-btn">Log out</button>
            </form>
            <?php else: ?>
                <div id="navbar" class="navbar-collapse collapse">
                    <form class="navbar-form navbar-right" role="form" method="post" action="<?= current_url() ?>">
                        <div class="form-group">
                            <input type="text" placeholder="Username" class="form-control" name="login">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Password" class="form-control" name="password">
                        </div>
                        <button type="submit" class="btn btn-success">Sign in</button>
                    </form>
                </div><!--/.navbar-collapse -->
            <?php endif; ?>
        </div>
    </nav>
    <div class="container">
