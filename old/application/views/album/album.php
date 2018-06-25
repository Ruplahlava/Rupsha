<?php $this->load->view('album/htmlheader'); ?>
<?php $this->load->view('album/header'); ?>

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