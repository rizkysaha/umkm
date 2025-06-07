<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="margin-top: 4rem !important;">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" style="max-height: 400px;">
    <div class="carousel-item active">
      <img class="d-block w-100" src="<?php echo base_url() ?>assets/dist/img/photo1.png" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?php echo base_url() ?>assets/dist/img/photo2.png" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?php echo base_url() ?>assets/dist/img/photo3.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<p></p>
<div class="container justify-content-center">
    <div class="brand-text font-weight-light text-center" id="">
    	<h3>UMKM Terbaru</h3>
    </div>    
</div>

<!-- 
<div id="quote" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#quote" data-slide-to="0" class="active"></li>
    <li data-target="#quote" data-slide-to="1"></li>
    <li data-target="#quote" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" style="background: #f5f5f5;">
    <div class="carousel-item active">
      <blockquote>
	      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
	      <small>Someone famous in <cite title="Source Title">Source Title</cite></small>
	    </blockquote>
    </div>
    <div class="carousel-item">
      <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
          <small>Someone famous in <cite title="Source Title">Source Title</cite></small>
        </blockquote>
    </div>
    <div class="carousel-item">
      <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
          <small>Someone famous in <cite title="Source Title">Source Title</cite></small>
        </blockquote>
    </div>
  </div>
  <a class="carousel-control-prev" href="#quote" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#quote" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div> -->

<div class="row">
    <?php 
    foreach ($mitra as $val) {
    ?>
    <div class="col-lg-3 col-md-3 col-sm-6 col-6">
        <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center ">
                  <img class="profile-user-img img-fluid img-circle square" src="<?php echo base_url($val->icon) ?>" alt="User profile picture" >
                </div>

                <h3 class="profile-username text-center"><?php echo $val->nama; ?></h3>

                <p class="text-muted text-center"></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Produk</b> <a class="float-right"><?php echo number_format($val->jumlah_produk,0,",",".")?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Kategori</b> <a class="float-right"><?php echo $val->nama_kategori; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b><i class="fa fa-map-marker-alt"></i> Lokasi </b> <a class="float-right"><?php echo $val->address_name; ?></a>
                  </li>
                </ul>
                <a href="<?php echo base_url('Mitra/detail/'.$val->id) ?>" class="btn btn-block btn-outline-primary btn-sm"><b> Lihat Detail</b></a>
              </div>
              <!-- /.card-body -->
            </div>
    </div>
    <?php
    }
     ?>
    
</div>

<div class="container justify-content-center">
    <div class="brand-text font-weight-light text-center" id="">
        <h3>Produk UMKM</h3>
    </div>    
</div>

<div class="row">
  <?php 
  foreach ($produk as $val) {
  ?>
  <div class="col-lg-3 col-md-3 col-sm-6 col-6">
    <a href="<?php echo base_url('produk/detail/'.$val->id); ?>" class="card card-widget widget-user">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header text-white" style="background: url('<?php echo $val->foto; ?>') center center;">
      </div>
      
      <div class="card-body pl-0 pr-0 pt-0 pb-0">
        <!-- <div class="row"> -->
            <ul class="products-list product-list-in-card pl-2 pr-2">
                  <li  class="item">
                    <div class="product-info ml-0">
                      
                      <span class="product-description">
                        <?php echo $val->nama; ?>
                      </span>
                      <span class="product-title">Rp. <?php echo number_format($val->harga_jual,0,",",".");?></span>
                      <span class="product-description">
                        <i class="fa fa-map-marker-alt"></i> <?php echo $val->address_name; ?>
                      </span>
                    </div>
                  </li>
                </ul>
        <!-- </div> -->
        <!-- /.row -->
      </div>
    </a>
  </div>
  <?php
  }
   ?>
</div>

<div class="row">
    <div class="col-lg-12"><a href="<?php echo base_url('produk/list') ?>" class="btn btn-block btn-success">Lihat semua</a></div>
</div>