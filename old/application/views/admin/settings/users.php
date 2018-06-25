<?php $this->load->view('admin/htmlheader'); ?>
<?php $this->load->view('admin/header'); ?>
<div class="row">
    <?php $this->load->view('alert'); ?>
    <div class="col-md-6">
        <h3>New user</h3>
        <form class="form-horizontal" method="post" action="<?= base_url() ?>admin/settings/add_user">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Login</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Password" name="login">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail4" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="inputEmail4" placeholder="Password" name="password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-default">Add user</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <h3>Delete user</h3>
        <?php foreach ($users as $user): ?>
            <div class="row">
                    <div class="switch-wrap switch-wrap-users">
                        <div class="col-md-6">
                            <a type="button" class="btn btn-danger btn-delete disabled btn-block" href="<?= base_url() ?>admin/settings/delete_user/<?= $user->id ?>">Delete <?= $user->login ?></a>
                        </div> 
                        <div class="col-md-6">                        
                            <input type="checkbox" name="confirm-switch"><br>
                        </div>
                    </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php $this->load->view('admin/footer'); ?>