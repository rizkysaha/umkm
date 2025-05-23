<div class="row">
  <div class="col-12">
  	<div class="card">
  		<div class="card-header">
	        <h3 class="card-title">Mitra UMKM</h3>
	    </div>

      	<div class="card-body">
      		<form method="post" action="save_menu_paket" enctype="multipart/form-data">
      			<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" >
      			<div class="row"> 
		      		<div class="col-3">
		      			<div class="form-group">
			                <label for="nama">Nama UMKM</label>
			                <input type="text" class="form-control form-control-sm" id="nama" name="nama" value="<?php echo $nama; ?>" placeholder="Nama">
			            </div>
		      		</div>
		      		<div class="col-3">
		      			<div class="form-group">
			                <label for="deskripsi">Deskripsi</label>
			                <textarea name="deskripsi" id="deskripsi" class="form-control form-control-sm" rows="3"><?php echo $deskripsi; ?></textarea>
			                <!-- <input type="text" class="form-control form-control-sm" id="deskripsi" name="deskripsi" value="" placeholder="Deskripsi"> -->
			            </div>
		      		</div>
		      	</div>
		      	<div class="row"> 
		      		<div class="col-3">
		      			<div class="form-group">
			                <label for="nama">Kategori</label>
			                <div class="input-group input-group-sm " style="margin-bottom: 10px;">	
								<select name="kategori" id="kategori" class="form-control form-control-sm">
									<?php
									foreach ($kategori as $val) {
									?>
									<option value="<?php echo $val->id; ?>"><?php echo $val->nama; ?></option>
									<?php
									} 
									
									?>
									
								</select>
							</div>
			            </div>
		      		</div>
		      		<div class="col-3">
		      			<div class="form-group">
			                <label for="owner">Owner</label>
			                <input type="text" class="form-control form-control-sm" id="owner" name="owner"  value="<?php echo $owner; ?>" placeholder="Owner">
			            </div>
		      		</div>
		      		
		      	</div>
		      	<div class="row"> 
		      		<div class="col-3">
		      			<div class="form-group">
			                <label for="nohp">No HP</label>
			                <input type="text" class="form-control form-control-sm" id="nohp" name="nohp" value="<?php echo $nohp; ?>" placeholder="Kode Produk Cek">
			            </div>
		      		</div>
		      		
		      		<div class="col-3">
		      			<div class="form-group">
			                <label for="no_wa">No WA</label>
			                <input type="text" class="form-control form-control-sm" id="no_wa" name="no_wa" value="<?php echo $no_wa; ?>" placeholder="No WA">
			            </div>
		      		</div>
		      	</div>
		      	<div class="row">

		      		<div class="col-3">
		      			<div class="form-group">
			                <label for="icon">Gambar Mitra</label>
			                <div class="custom-file">
		                      	<input type="file" class="custom-file-input" id="icon" name="icon" onchange="readURL(this);" <?php if($path_lama==""){ echo "required";} ?>>
		                      	<label class="custom-file-label" for="customFile">Choose file</label>
		                    </div>
		                    <input type="hidden" name="path_lama" id="path_lama"  value="<?php echo $path_lama; ?>" readonly="">
			            </div>
		      		</div>
		      	</div>
		      	<div class="row">
		      		<div class="col-2">
		      			<div class="form-group">
			                <label for="icon">Preview</label>
			                <div id="img_upload" class="<?php echo $hidden ?>" style="margin-bottom: 10px; width: ">
								<img src="<?php echo base_url().$icon; ?>" alt="File Upload" id="imgLogo" width="" class="" style="width: 100%;">	
							</div>
			            </div>
		      		</div>
		      	</div>
		      	<div class="row" id="row_0">
        			<div class="col-md-6">
        				<div class="form-group">
			              	<label for="">Reply</label>
			              	<textarea class="form-control form-control-sm" id="reply_sn" name="reply_sn" placeholder="Reply" rows="3"><?php echo $reply_sn; ?></textarea>
			            </div>
			            <div class="form-group">
			              	<label for="">Regex</label>
			              	<textarea class="form-control form-control-sm" id="regex" name="regex" placeholder="Regex" rows="2"><?php echo $regex; ?></textarea>
			            </div>
			            <div class="form-group">
			              	<label for="">Line break</label>
			              	<textarea class="form-control form-control-sm" id="linebreak" name="linebreak" placeholder="Linebreak" rows="1"><?php echo $linebreak; ?></textarea>
			            </div>
			            <div class="form-group">
			              	<label for="">Prepend</label>
			              	<textarea class="form-control form-control-sm" id="prepend" name="prepend" placeholder="Prepend" rows="1"><?php echo $prepend; ?></textarea>
			            </div>
        			</div>
        			<div class="col-md-6">
        				<div class="form-group">
			              	<label for="">Hasil</label>
			              	<textarea class="form-control form-control-sm" id="hasil" name="hasil" placeholder="Hasil" rows="15" readonly=""></textarea>
			              	<button type="button" class="btn btn-success btn-sm pull-right" onclick="test_regex('reply_sn','regex','hasil','linebreak','prepend')">TEST</button>
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
              <th>#</th>
              <th>Provider</th>
              <th>Icon</th>
              <th>Nama</th>
              <th>Kode Operator</th>
              <th>Kode Produk Cek</th>
              <th>API</th>
              <th>Urutan</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody id="tbl_setting">
            <?php echo $menu_paket['isi']; ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>