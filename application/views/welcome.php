<?php $this->load->view('htmlheader'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1>Ruphsa <small>Opensource picture sharing tool</small></h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h2>What does it do?</h2>
            <p>
                Application provides easy to use picture sharing without any dependencies on Facebook, Google+ or so.<br>
                Every photo is on your server and under your management.
            </p>
        </div>
        <div class="col-md-6">
            <h2>Example</h2>
            <p>
                Rupsha uses <a href="https://github.com/Kris-B/nanoGALLERY">nanoGallery</a> as a default gallery viewer.<br>
                <a href="http://rupsha.eu/e1c13d5513" class="btn btn-info" role="button">Kittens and Puppies</a>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h2>Requirements</h2>
            <ul>
                <li>
                    Your server with:
                </li>
                <li>
                    Php 5.4 + GD <small>Or allowed shor tags in php.ini</small>
                </li>
                <li>
                    SQL server <small>MySQL as default.</small>
                </li>
            </ul>
        </div>
        <div class="col-md-6">
            <h2>Built using</h2>
            <ul>
                <li>
                    Codeigniter 3.0
                </li>
                <li>
                    Twitter Bootstrap 
                </li>
                <li>
                    nanoGallery
                </li>
                <li>
                    dropzone.js
                </li>
                <li>
                    and more...
                </li>
            </ul>
        </div>
    </div>
            <!--<img src="<?= base_url() ?>img/mainpage/uploader.png" alt="" class="img-rounded">-->
    <?php $this->load->view('album/footer'); ?>