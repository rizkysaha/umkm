<div class="" style="margin-top: 8rem !important;">

<?php 
if(count($mitra)>0){
?>
    <div class="brand-text font-weight-light text-center" id="">
    	<h3>Hasil Pencarian</h3>
    </div>    

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
<?php
} ?>


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

</div>