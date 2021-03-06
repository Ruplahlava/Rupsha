<?php $this->load->view('admin/htmlheader'); ?>

<!-- 
 * parallax_login.html
 * @Author original @msurguy (tw) -> http://bootsnipp.com/snippets/featured/parallax-login-form
 * @Tested on FF && CH
 * @Reworked by @kaptenn_com (tw)
 * @package PARALLAX LOGIN.
-->
<script src="<?= base_url() ?>js/TweenLite.min.js"></script>
<body>
    <div class="container">
        <div class="row vertical-offset-100">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">                                
                        <div class="row-fluid user-row">
                            <img src="<?= base_url() ?>img/login/logo_sm_2_mr_1.png" class="img-responsive" alt="Conxole Admin"/>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form accept-charset="UTF-8" role="form" class="form-signin" method="post" action="<?= current_url() ?>">
                            <fieldset>
                                <label class="panel-login">
                                    <div class="login_result"></div>
                                </label>
                                <input class="form-control" placeholder="Username" id="username" type="text" name="login">
                                <input class="form-control" placeholder="Password" id="password" type="password" name="password">
                                <br></br>
                                <input class="btn btn-lg btn-success btn-block" type="submit" id="login" value="Login »">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?= base_url() ?>js/vendor/jquery-1.11.1.min.js"><\/script>')</script>

<script src="<?= base_url() ?>js/vendor/bootstrap.min.js"></script>

<script src="<?= base_url() ?>js/main.js"></script>
<script>
    $(document).ready(function () {
        $(document).mousemove(function (event) {
            TweenLite.to($("body"),
                    .5, {
                        css: {
                            backgroundPosition: "" + parseInt(event.pageX / 8) + "px " + parseInt(event.pageY / '12') + "px, " + parseInt(event.pageX / '15') + "px " + parseInt(event.pageY / '15') + "px, " + parseInt(event.pageX / '30') + "px " + parseInt(event.pageY / '30') + "px",
                            "background-position": parseInt(event.pageX / 8) + "px " + parseInt(event.pageY / 12) + "px, " + parseInt(event.pageX / 15) + "px " + parseInt(event.pageY / 15) + "px, " + parseInt(event.pageX / 30) + "px " + parseInt(event.pageY / 30) + "px"
                        }
                    })
        })
    })
</script>
</body>
</html>