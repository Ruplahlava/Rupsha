<?php $this->load->view('admin/htmlheader'); ?>
<?php $this->load->view('admin/header'); ?>
<div class="row">
    <?php $this->load->view('alert'); ?>
    <h3>Page settings</h3>
    <div class="col-md-6">        
        <form class="form-horizontal" method="post" action="<?= base_url()?>admin/settings/page_set">
            <div class="form-group">
                <label for="ganal" class="col-sm-3 control-label">Google analytics</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="ganal" placeholder="Google analytics code" name="ga" value="<?= $settings[0]->ga?>">
                </div>
            </div>
            <h5>Picture settings</h5>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Max dimension</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Vertical or horizontal" name="max_dimension" value="<?= $settings[0]->max_dimension?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Quality</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputPassword3" placeholder="In percents" name="quality" value="<?= $settings[0]->quality?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-default">Change values</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">
                Picture settings is applied for new pictures only!
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('admin/footer'); ?>