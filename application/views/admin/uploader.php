<?php $this->load->view('admin/htmlheader'); ?>
<?php $this->load->view('admin/header'); ?>
<div class="row">
    <h2><a href="#" class="header-xeditable" data-type="text" data-pk="<?= $album[0]->id ?>"  data-placeholder="Required" data-type="text" data-url="<?= base_url() ?>admin/uploader/alter_album/<?= $album[0]->id ?>/name/" name="header"><?= $album[0]->name ?></a></h2>        
</div>
<div class="row">
    <dl class="dl-horizontal">
        <dt>Date</dt>
        <dd><a class="date-xeditable" href="#" data-type="date" data-pk="<?= $album_xeditable->id ?>" data-url="<?= base_url() ?>admin/uploader/alter_album/<?= $album_xeditable->id ?>/date/" data-title="Select date"><?= $album_xeditable->date ?></a></dd>
        <dt>Location</dt>
        <dd><a href="#" class="location-xeditable" data-type="text" data-pk="<?= $album_xeditable->id ?>"  data-type="text" data-url="<?= base_url() ?>admin/uploader/alter_album/<?= $album_xeditable->id ?>/location/" name="place"><?= $album_xeditable->place ?></a></dd>
        <dt>Text</dt>
        <dd><a href="#" class="text-xeditable" data-type="textarea" data-pk="<?= $album_xeditable->id ?>"  data-type="text" data-url="<?= base_url() ?>admin/uploader/alter_album/<?= $album_xeditable->id ?>/text/" name="place"><?= $album_xeditable->text ?></a></dd>
    </dl>     
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="input-group">
            <input type="text" class="form-control input-copy enable-copy" value="<?= base_url() ?><?= $album[0]->hash ?>" disabled>
            <span class="input-group-btn">
                <button class="btn btn-default btn-copy" data-clipboard-text="<?= base_url() ?><?= $album[0]->hash ?>" type="button" data-toggle="popover" data-trigger="focus" data-content="Copied!">Copy</button>
            </span>
        </div><!-- /input-group -->
    </div><!-- /.col-lg-6 -->
    <div class="col-lg-6">
        <div class="switch-wrap">
            <a type="button" class="btn btn-danger btn-delete disabled" href="<?= base_url() ?>admin/uploader/delete_album/<?= $album[0]->id ?>">Delete album</a> <input type="checkbox" name="confirm-switch">
        </div><!-- /.col-lg-6 -->
    </div><!-- /.col-lg-6 -->
</div>    
<div id="actions" class="row">
    <div class="col-lg-7">
        <!-- The fileinput-button span is used to style the file input field as button -->
        <span class="btn btn-success fileinput-button">
            <i class="glyphicon glyphicon-plus"></i>
            <span>Add files...</span>
        </span>
        <button type="submit" class="btn btn-primary start">
            <i class="glyphicon glyphicon-upload"></i>
            <span>Start upload</span>
        </button>
        <button type="reset" class="btn btn-warning cancel">
            <i class="glyphicon glyphicon-ban-circle"></i>
            <span>Cancel upload</span>
        </button>
    </div>

    <div class="col-lg-5">
        <!-- The global file processing state -->
        <span class="fileupload-process">
            <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
            </div>
        </span>
    </div>

</div>
<div class="table table-striped" class="files" id="previews">

    <div id="template" class="file-row">
        <!-- This is used as the file preview template -->
        <div>
            <span class="preview"><img data-dz-thumbnail /></span>
            <span class="glyphicon glyphicon-sort file-row-handle" aria-hidden="true"></span>
        </div>
        <div>
            <strong class="error text-danger" data-dz-errormessage></strong>
        </div>
        <div class="pull-right">

            <div>
                <p class="size" data-dz-size></p>
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                </div>
            </div>
            <div>
                <button class="btn btn-primary start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
                <button data-dz-remove class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
                <button data-dz-remove class="btn btn-danger delete">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
            </div>
        </div>
    </div>

</div>
<?php $this->load->view('admin/dropzone_settings'); ?>
<?php $this->load->view('admin/footer'); ?>