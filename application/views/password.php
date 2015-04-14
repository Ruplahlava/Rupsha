<?php $this->load->view('htmlheader'); ?>
<?php $this->load->view('header'); ?>
<div class="row row-centered">
    <div class="col-centered col-md-6">
<?php $this->load->view('alert'); ?>
        
        <form class="form-inline" action="<?= current_url() ?>" method="post">
            <div class="form-group">
                <label for="inputPWD">Password</label>
                <input type="password" class="form-control" id="inputPWD" placeholder="Pasword for album" name="album_password">
            </div>
            <button type="submit" class="btn btn-default">Show album</button>
        </form>
    </div>
</div>
</div>
<?php $this->load->view('footer'); ?>