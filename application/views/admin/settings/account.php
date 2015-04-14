<?php $this->load->view('admin/htmlheader'); ?>
<?php $this->load->view('admin/header'); ?>
<div class="row">
    <?php $this->load->view('alert'); ?>
    <div class="col-md-6">
        <h3>Password change</h3>
        <form class="form-horizontal" method="post" action="<?= base_url()?>admin/settings/pwd_change">
            <div class="form-group">
                <label for="inputEmail4" class="col-sm-3 control-label">Old password</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="inputEmail4" placeholder="Password" name="old_password">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="inputEmail3" placeholder="Password" name="new_password">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Repeat</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="Password again" name="match_password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-default">Change password</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $this->load->view('admin/footer'); ?>