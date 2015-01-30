<?php $this->load->view('htmlheader'); ?>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="jumbotron center">
          <h1>Album Not Found <small><font face="Tahoma" color="red">Error 404</font></small></h1>
          <br />
          <p>The page you requested could not be found. Please check if your URL is correct or if album you are looking for still exists. You can use your browsers <b>Back</b> button to navigate to the page you have previously come from.</p>
          <p><b>Or you could just press this neat little button:</b></p>
          <a href="<?= base_url() ?>" class="btn btn-large btn-info"><i class="icon-home icon-white"></i> Take Me Home</a>
        </div>
        <br />
        <!-- By ConnerT HTML & CSS Enthusiast -->  
    </div>
  </div>
<?php $this->load->view('album/footer'); ?>