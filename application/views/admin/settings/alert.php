<?php if($this->session->flashdata('err')):?>
<div class="alert alert-danger" role="alert"><?= $this->session->flashdata('err') ?></div>
<?php endif;?>
<?php if($this->session->flashdata('succ')):?>
<div class="alert alert-success" role="alert"><?= $this->session->flashdata('succ') ?></div>
<?php endif;?>