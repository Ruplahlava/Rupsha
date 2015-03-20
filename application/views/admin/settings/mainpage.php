<?php $this->load->view('admin/htmlheader'); ?>
<?php $this->load->view('admin/header'); ?>
<div class="row">
    <?php $this->load->view('admin/settings/alert'); ?>
    <h3>Mainpage settings</h3>
    
    <div class="col-md-6">   
        <br>
        <input type="checkbox" name="mainpage-switch">
        <form class="form-horizontal mainpage" method="post" action="<?= base_url()?>admin/settings/mainpage_set">
            <div class="form-group">
                <label for="ganal" class="col-sm-3 control-label">Google analytics</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="ganal" placeholder="Google analytics code" name="ga" value="">
                </div>
            </div>
            <h5>Picture settings</h5>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Max dimension</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Vertical or horizontal" name="max_dimension" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Quality</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputPassword3" placeholder="In percents" name="quality" value="">
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
                Some text probably
            </div>
        </div>
    </div>
</div>
<!--vypnut zapnout mainpage-->
<!--style mainpage-->
<!--editor popisu stranky-->
<?php $this->load->view('admin/footer'); ?>