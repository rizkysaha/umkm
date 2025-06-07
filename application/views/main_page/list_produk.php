<div class="row " style="margin-top: 4rem !important;">
	<?php 
  foreach ($produk as $val) {
  ?>
  <div class="col-lg-3 col-md-3 col-sm-6 col-6">
    <a href="<?php echo base_url('produk/detail/'.$val->id); ?>" class="card card-widget widget-user">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header text-white" style="background: url('<?php echo base_url($val->foto); ?>') center center;">
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