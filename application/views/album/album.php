<?php $this->load->view('album/htmlheader'); ?>
<?php $this->load->view('album/header'); ?>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5&appId=157562951113623";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    <div class="fb-like" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div>
    <div id="nanoAlbum">

    </div>
    <div class="row album-text">
        <div class="col-md-12">
            <?= $album[0]->text ?>
        </div>
    </div>
<?php if ($zip_download): ?>
    <div class="row album-text">
        <div class="col-md-12">
            <a href="<?= base_url().UPLOAD_PATH . $user[0]->login . '/' . $album[0]->id . '/' . ZIP_FILENAME ?>">
                <span class="glyphicon glyphicon-download-alt glyphicon-album-download" aria-hidden="true"></span>
                Download
            </a>
        </div>
    </div>
<?php endif; ?>
<?php $this->load->view('album/nanoSettings'); ?>
<?php $this->load->view('album/footer'); ?>