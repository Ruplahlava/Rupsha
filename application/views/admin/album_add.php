<?php $this->load->view('admin/htmlheader'); ?>
<?php $this->load->view('admin/header'); ?>
<div class="row">
    <h2>Create new album</h2>
</div>
<div class="row">
    <form class="form-horizontal" role="form" method="post" action="<?= current_url() ?>">
        <div class="col-md-4">
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName" placeholder="Name" name="name" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputLocation" class="col-sm-2 control-label">Location</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputLocation" placeholder="Location" name="place">
                </div>
            </div>
            <div class="form-group">
                <label for="inputDate" class="col-sm-2 control-label">Date</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="inputDate" placeholder="Date" name="date" value="<?= date('Y-m-d'); ?>">
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Text</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="6" name="text" placeholder="Text"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Add album</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="list-group">
            <?php if (!empty($album[0])): ?>
            <table id="album_overview">
                
            </table>
                <?php foreach ($album as $value): ?>
                    <a href="<?= current_url() ?>/<?= $value->id ?>" class="list-group-item">    
                        <span class="badge"><?= $value->cnt ?></span>
                        <?= $value->name ?>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-info" role="alert">You have not created any albums yet!</div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-4">

    </div>
</div>
<?php $this->load->view('admin/footer'); ?>