<div class="row " style="margin-top: 4rem !important;">
          <div class="col-md-4">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle square" src="<?php echo base_url($mitra->icon) ?>" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $mitra->nama; ?></h3>

                <p class="text-muted text-center"><?php echo $mitra->nama_kategori ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <strong><i class="fas fa-building mr-1"></i> Alamat</strong>
	                <p class="text-muted mb-0">
	                  <?php echo $mitra->alamat; ?>
	                </p>
                  </li>
                  <li class="list-group-item">
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Lokasi</strong>
	                <p class="text-muted mb-0">
	                  <?php echo $mitra->address_name; ?>
	                </p>
                  </li>
                </ul>

                <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            
          </div>
          <!-- /.col -->
          <div class="col-md-8">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Tentang</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Kontak</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="activity">
                    <?php echo $mitra->deskripsi; ?>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
	                  <li class="item">
	                    <div class="product-info ml-0">
	                      <a href="javascript:void(0)" class="product-title">Owner</a>
	                      <span class="product-description">
	                        <?php echo $mitra->owner; ?>
	                      </span>
	                    </div>
	                  </li>
	                  <li class="item">
	                    <div class="product-info ml-0">
	                      <a href="javascript:void(0)" class="product-title">No HP</a>
	                      <span class="product-description">
	                        <?php echo $mitra->nohp; ?>
	                      </span>
	                    </div>
	                  </li>
	                  <li class="item">
	                    <div class="product-info ml-0">
	                      <a href="javascript:void(0)" class="product-title">No WA</a>
	                      <span class="product-description">
	                        <?php echo $mitra->no_wa; ?>
	                      </span>
	                    </div>
	                  </li>
	                  <li class="item">
	                    <div class="product-info ml-0">
	                      <a href="javascript:void(0)" class="product-title">Email</a>
	                      <span class="product-description">
	                        <?php echo $mitra->email; ?>
	                      </span>
	                    </div>
	                  </li>
	                  <!-- /.item -->
	                  
	                </ul>
                  </div>
                  <!-- /.tab-pane -->

                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>