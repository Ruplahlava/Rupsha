<?php $this->load->view('album/htmlheader'); ?>
<?php $this->load->view('album/header'); ?>

<div id="nanoAlbum">

</div>
<div class="row album-text">
    <div class="col-md-12">
        <?= $album[0]->text ?>
    </div>
</div>
<?php $this->load->view('album/nanoSettings'); ?>
<?php $this->load->view('album/footer'); ?>