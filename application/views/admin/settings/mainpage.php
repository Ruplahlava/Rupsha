<?php $this->load->view('admin/htmlheader'); ?>
<?php $this->load->view('admin/header'); ?>
<div class="row"><div class="col-md-12"> 
        <?php $this->load->view('admin/settings/alert'); ?>
        <h3>Mainpage settings</h3>
        <input type="checkbox" name="mainpage-switch">
    </div>
</div>
<div class="row">
    <div class="col-md-6">   
        <form class="form-horizontal mainpage" method="post" action="<?= base_url() ?>admin/settings/mainpage_set">
            <div class="form-group">
                <label for="ganal" class="col-sm-3 control-label">Mainpage text<small class="text-muted"> HTML enabled</small></label>
                <div class="col-sm-9">
                    <textarea class="form-control" rows="6" name="mainpagetext"></textarea>
                </div>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="mainpagestyle" id="optionsRadios1" value="1">
                    Boxes with album names
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="mainpagestyle" id="optionsRadios2" value="2">
                    Each album on line with name and text
                </label>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-default submit-mainpage">Change values</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">
                Here you can set up your mainpage, or completely disable it - blank page will be shown.<br>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('admin/footer'); ?>