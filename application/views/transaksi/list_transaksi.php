<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">List Transaksi</h3>
        <div class="card-tools">
        	<!-- <button class="btn btn-sm btn-success" onclick="add_setting()"><i class="fa fa-plus"></i> Tambah</button> -->
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
              <th>No Faktur</th>
              <th>User</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody id="tbl_setting">
            <tr>
            	<td><button class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button></td>
            	<td>2506072030</td>
            	<td>Saha</td>
            	<td>Belum terbayar</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>