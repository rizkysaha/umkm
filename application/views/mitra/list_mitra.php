<div class="row">
  <div class="col-12">
  	<div class="card">
  		<div class="card-header">
	        <h3 class="card-title">Mitra UMKM</h3>
	    </div>

      	<div class="card-body">
      		<form method="post" action="save_mitra" enctype="multipart/form-data">
      			<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" >
      			<div class="row"> 
		      		<div class="col-6">
		      			<div class="form-group">
			                <label for="nama">Nama UMKM</label>
			                <input type="text" class="form-control form-control-sm" id="nama" name="nama" value="<?php echo $nama; ?>" placeholder="Nama UMKM">
			            </div>
		      		</div>
		      	</div>
		      	<div class="row"> 
		      		<div class="col-6">
		      			<div class="form-group">
			                <label for="deskripsi">Deskripsi</label>
			                <textarea name="deskripsi" id="deskripsi" class="form-control form-control-sm" rows="3"><?php echo $deskripsi; ?></textarea>
			                <!-- <input type="text" class="form-control form-control-sm" id="deskripsi" name="deskripsi" value="" placeholder="Deskripsi"> -->
			            </div>
		      		</div>
		      	</div>
		      	<div class="row"> 
		      		<div class="col-6">
		      			<div class="form-group">
			                <label for="nama">Alamat</label>
			                <div class="input-group input-group-sm " style="margin-bottom: 10px; width: 100%;">	
								<select name="address" id="address" class="form-control form-control-sm select2">
									<?php 
									if($address_id!=""){
										echo '<option value="'.$address_id.'|'.$address_name.'" selected="selected">'.$address_name.'</option>';
									}
									?>
								</select>
							</div>
			            </div>
		      		</div>
		      		
		      	</div>
		      	<div class="row"> 
		      		<div class="col-6">
		      			<div class="form-group">
			                <label for="alamat">Alamat Lengkap</label>
			                <textarea name="alamat" id="alamat" class="form-control form-control-sm" rows="3" placeholder="Nama jalan atau gedung, dll"><?php echo $alamat; ?></textarea>
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
									<option value="<?php echo $val->id; ?>" <?php if($val->id==$kategori_id){ echo "selected"; } ?>><?php echo $val->nama; ?></option>
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
			                <input type="text" class="form-control form-control-sm" id="nohp" name="nohp" value="<?php echo $nohp; ?>" placeholder="No HP">
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
			                <label for="email">Email</label>
			                <input type="text" class="form-control form-control-sm" id="email" name="email" value="<?php echo $email; ?>" placeholder="Email">
			            </div>
		      		</div>
		      		<div class="col-3">
		      			<div class="form-group">
			                <label for="is_open">Status Mitra</label>
			                <select name="is_open" id="is_open" class="form-control form-control-sm">	
								<option value="1" <?php if($is_open=="1"){ echo "selected"; } ?>>Buka</option>	
								<option value="0" <?php if($is_open=="0"){ echo "selected"; } ?>>Tutup</option>		
							</select>
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
		      	
		      	<div class="row">
		      		<div class="col-3">
		      			<div class="form-group">
			                
				          <button type="submit" class="btn btn-sm btn-primary"><?php echo $btn_text; ?></button>
				          <a href="<?php echo base_url('Dashboard/mitra') ?>" class="btn btn-sm btn-danger">Batal</a>
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
              <th>Icon</th>
              <th>Nama</th>
              <th>Deskripsi</th>
              <th>Kategori</th>
              <th>Alamat</th>
              <th>Owner</th>
              <th>Jumlah Produk</th>
              <th>Kontak</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody id="tbl_mitra">
            <?php echo $mitra['isi']; ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
<script type="text/javascript">
	$(function () {
		$('.select2').select2({
			minimumInputLength: 3,
		    placeholder: "Ketik desa/kecamatan/kabupaten atau kota/provinsi/kode pos",
		    // data: [
			//   {
			//     id: "<?php echo $address_id.'|'.$address_name; ?>",
			//     text: '"<?php echo $address_name; ?>"'
			//   },
			// ],
			ajax: {
		    url: '<?php echo base_url('Dashboard/load_alamat') ?>',
		    type: "POST",
	        dataType: 'json',
	        delay: 250,
		    data: function (params) {
		      	return {
	              	searchTerm: params.term // search term
	           	};
		    },
		    processResults: function (response) {
	           	return {
	              	results: response
	           	};
	        },
	        cache: false
		  }
		});
		// var data = {
		//     id: "<?php echo $address_id.'|'.$address_name; ?>",
		//     text: '"<?php echo $address_name; ?>"'
		// };

		// var newOption = new Option(data.text, data.id, false, false);
		// $('#address').append(newOption).trigger('change');
		// $("#select2").select2('data', {id: "<?php echo $address_id.'|'.$address_name; ?>", text: "<?php echo $address_name; ?>"}); 

	});
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