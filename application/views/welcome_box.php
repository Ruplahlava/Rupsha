<?php $this->load->view('htmlheader'); ?>
<?php $this->load->view('header'); ?>
<div class="row">
    <div class="col-md-12">
        <h1>Album previews</h1>
    </div>
</div>
<?php foreach (array_chunk($overview_array, 4) as $album_chunk): ?>
    <div class="row">
        <?php foreach ($album_chunk as $album): ?>
            <a href="<?= base_url() ?><?= $album['hash'] ?>" alt="<?= $album['name'] ?>"> 
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <img src="<?= base_url() ?>img/user/<?= $album['login'] ?>/<?= $album['id'] ?>/<?= $album['fname'] ?>_thumb<?= $album['extension'] ?>" class="img-responsive" alt="<?= $album['name'] ?>">
                    <h4><?= $album['name'] ?></h4>
                    <?= $album['login'] ?>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>
<?php $this->load->view('footer'); ?>