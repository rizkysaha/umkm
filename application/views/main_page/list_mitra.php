<div class="row " style="margin-top: 4rem !important;">
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