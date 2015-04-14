<?php if ($this->session->flashdata('err')): ?>
    <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('err') ?><button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button></div>
<?php endif; ?>
<?php if ($this->session->flashdata('succ')): ?>
    <div class="alert alert-success" role="alert"><?= $this->session->flashdata('succ') ?><button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button></div>
<?php endif; ?>