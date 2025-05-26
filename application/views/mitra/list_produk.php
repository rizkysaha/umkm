<div class="row">
  <div class="col-12">
  	<div class="card">
  		<div class="card-header">
	        <h3 class="card-title">Produk Mitra UMKM</h3>
	    </div>

      	<div class="card-body">
      		<form method="post" action="<?php echo base_url('Dashboard'); ?>/save_mitra_produk/<?php echo $mitra_id; ?>" enctype="multipart/form-data">
      			<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" >
      			<div class="row"> 
		      		<div class="col-6">
		      			<div class="form-group">
			                <label for="nama">Nama Produk</label>
			                <input type="text" class="form-control form-control-sm" id="nama" name="nama" value="<?php echo $nama; ?>" placeholder="Nama">
			            </div>
		      		</div>
		      	</div>
		      	<div class="row"> 
		      		<div class="col-6">
		      			<div class="form-group">
			                <label for="deskripsi">Deskripsi</label>
			                <textarea name="deskripsi" id="deskripsi" class="form-control form-control-sm" rows="3"><?php echo $deskripsi; ?></textarea>
			            </div>
		      		</div>
		      	</div>
		      	<div class="row"> 
		      		<div class="col-3">
		      			<div class="form-group">
			                <label for="harga_beli">Harga Beli</label>
			                <input type="text" class="form-control form-control-sm text-right" id="harga_beli" name="harga_beli" value="<?php echo number_format((int)$harga_beli,0,",","."); ?>" placeholder="Harga Beli" onkeyup="hapuskoma(this.id)" onchange="hapuskoma(this.id)" onblur="hapuskoma(this.id)">
			            </div>
		      		</div>
		      		<div class="col-3">
		      			<div class="form-group">
			                <label for="harga_jual">Harga Jual</label>
			                <input type="text" class="form-control form-control-sm text-right" id="harga_jual" name="harga_jual" value="<?php echo number_format((int)$harga_jual,0,",","."); ?>" placeholder="Harga Jual" onkeyup="hapuskoma(this.id)" onchange="hapuskoma(this.id)" onblur="hapuskoma(this.id)">
			            </div>
		      		</div>
		      	</div>
		      	<div class="row"> 
		      		<div class="col-3">
		      			<div class="form-group">
			                <label for="stok">Stok</label>
			                <input type="text" class="form-control form-control-sm" id="stok" name="stok" value="<?php echo $stok; ?>" placeholder="Stok" onkeyup="hapuskoma(this.id)" onchange="hapuskoma(this.id)" onblur="hapuskoma(this.id)">
			            </div>
		      		</div>
		      	</div>
		      	<div class="row">
		      		<div class="col-3">
		      			<div class="form-group">
			                <label for="foto">Gambar Produk</label>
			                <div class="custom-file">
		                      	<input type="file" class="custom-file-input" id="foto" name="foto" onchange="readURL(this);" <?php if($path_lama==""){ echo "required";} ?>>
		                      	<label class="custom-file-label" for="customFile">Choose file</label>
		                    </div>
		                    <input type="hidden" name="path_lama" id="path_lama"  value="<?php echo $path_lama; ?>" readonly="">
			            </div>
		      		</div>
		      	</div>
		      	<div class="row">
		      		<div class="col-2">
		      			<div class="form-group">
			                <label for="foto">Preview</label>
			                <div id="img_upload" class="<?php echo $hidden ?>" style="margin-bottom: 10px; width: ">
								<img src="<?php echo base_url().$foto; ?>" alt="File Upload" id="imgLogo" width="" class="" style="width: 100%;">	
							</div>
			            </div>
		      		</div>
		      	</div>
		      	
		      	<div class="row">
		      		<div class="col-3">
		      			<div class="form-group">
			                
				          <button type="submit" class="btn btn-sm btn-primary"><?php echo $btn_text; ?></button>
				          <a href="<?php echo base_url('Dashboard/mitra_produk/'.$mitra_id) ?>" class="btn btn-sm btn-danger">Batal</a>
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
              <th>Foto</th>
              <th>Nama</th>
              <th>Deskripsi</th>
              <th>Harga Jual</th>
              <th>Harga Beli</th>
              <th>Stok</th>
            </tr>
          </thead>
          <tbody id="tbl_mitra">
            <?php echo $produk['isi']; ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
<script type="text/javascript">
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#imgLogo').attr('src', e.target.result);
			};

			reader.readAsDataURL(input.files[0]);
			$("#img_upload").removeClass('d-none');
		}
	}
	function hapus_mitra(id){
		var token = $("#token").val();
		if(confirm("Hapus data ini ?")){
			$.ajax({
				url 	: 'hapus_mitra',
				data 	: { id : id, token : token },
				type 	: 'POST',
				dataType: 'JSON',
				success : function(data){
					$("#tbl_mitra").html(data.isi);
					// $("#token").val(data.token);
				},
				error 	: function(data){
					alert("Error edit");
				}
			});
		}
			
	}
</script>