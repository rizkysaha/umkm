<div class="row">
  <div class="col-12">
  	<div class="card">
  		<div class="card-header">
	        <h3 class="card-title">Kategori</h3>
	    </div>
      	<div class="card-body">
      		<form method="post" action="save_kategori" enctype="multipart/form-data">
      			<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" >
      			<div class="row"> 
		      		<div class="col-3">
		      			<div class="form-group">
			                <label for="nama">Nama</label>
			                <input type="text" class="form-control form-control-sm" id="nama" name="nama" value="<?php echo $nama; ?>" placeholder="Nama">
			            </div>
		      		</div>
		      	</div>
		      	<div class="row">
		      		<div class="col-3">
		      			<div class="form-group">
				          <button type="submit" class="btn btn-sm btn-primary"><?php echo $btn_text; ?></button>
				          <a href="<?php echo base_url('Dashboard/menu_paket') ?>" class="btn btn-sm btn-danger">Batal</a>
			            </div>
		      		</div>
		      	</div>
      		</form>
      	</div>
  	</div>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Menu Paket</h3>
        <div class="card-tools">
        	<button class="btn btn-sm btn-success" onclick="add_setting()"><i class="fa fa-plus"></i> Tambah</button>
          <div class="input-group input-group-sm d-none" style="width: 150px;">
            <input type="hidden" name="token" id="token" value="<?php echo $this->security->get_csrf_hash(); ?>" class="form-control float-right" placeholder="Search">
            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover table-bordered table-sm">
          <thead>
            <tr>
              <th>Aksi</th>
              <th>Nama</th>
            </tr>
          </thead>
          <tbody id="tbl_setting">
            <?php echo $kategori['isi']; ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>