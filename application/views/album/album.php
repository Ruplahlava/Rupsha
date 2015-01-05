<?php $this->load->view('album/htmlheader'); ?>
<?php $this->load->view('album/header'); ?>

<?php foreach ($photo as $value): ?>
<img src="<?=  base_url()?>img/user/<?= $user[0]->login ?>/<?= $album[0]->id ?>/<?= $value->name?>_thumb<?=$value->extension ?>">
<?php endforeach; ?>
<div class="nanoAlbum">
    
</div>
<?php $this->load->view('album/footer'); ?>