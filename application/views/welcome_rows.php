<?php $this->load->view('htmlheader'); ?>
<?php $this->load->view('header'); ?>
<div class="row">
    <div class="col-md-12">
        <h1>Album previews</h1>
    </div>
</div>
<?php foreach ($overview_array as $album): ?>
    <div class="row">
        <a href="<?= base_url() ?><?= $album['hash'] ?>" alt="<?= $album['name'] ?>"> 
            <div class="col-md-12 foto-row">
                <div class="col-md-3 center">                    
                    <?php if($album['password'] != ''): ?>
                        <span class="glyphicon glyphicon-lock glyphicon-password-image" aria-hidden="true"></span>
                    <?php else: ?>
                        <img src="<?= base_url() ?>img/user/<?= $album['login'] ?>/<?= $album['id'] ?>/<?= $album['fname'] ?>_thumb<?= $album['extension'] ?>" class="img-responsive" alt="<?= $album['name'] ?>">
                    <?php endif;?>
                </div>
                <div class="col-md-9">
                    <h4><?= $album['name'] ?><small> - <?= $album['login'] ?></small></h4>
                    <p><?= $album['text'] ?></p>
                </div>
            </div>
        </a>
    </div>
<?php endforeach; ?>
<?php $this->load->view('footer'); ?>