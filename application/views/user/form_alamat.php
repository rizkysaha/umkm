<div class="row justify-content-center" style="margin-top: 8rem !important;">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form method="post" action="<?php echo base_url('user/save_alamat') ?>">
					<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
					<div class="form-group">
	                    <label for="nama_lengkap">Nama Lengkap</label>
	                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama lengkap penerima" value="<?php echo $nama_lengkap; ?>">
	                </div>
	                
	                <div class="form-group">
	                    <label for="nohp">No HP</label>
	                    <input type="text" class="form-control" id="nohp" name="nohp" placeholder="No HP" value="<?php echo $nohp; ?>">
	                </div>
	                <div class="form-group">
	                    <label for="nama_lengkap">Alamat</label>
	                    <select name="address" id="address" class="form-control form-control-sm select2">
							<?php 
							if($address_id!=""){
								echo '<option value="'.$address_id.'|'.$address_name.'" selected="selected">'.$address_name.'</option>';
							}
							?>
						</select>
	                </div>
	                
	                <div class="form-group">
	                    <label for="nama_lengkap">Detail Lainnya (Nama jalan, Gedung, Rumah)</label>
	                    <textarea class="form-control" id="alamat" name="alamat" rows="3"><?php echo $alamat; ?></textarea>
	                </div>
	                <div class="form-group">
	                    <label for="nohp">Jadikan alamat utama</label>
	                    <div class="custom-control custom-switch">
	                      <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" <?php if($status=="1"){ echo "checked"; } ?>>
	                      <label class="custom-control-label" for="status"></label>
	                    </div>
	                </div>
	                <div class="form-group">
	                	<button type="submit" class="btn btn-primary"><?php echo $btn_text; ?></button>
	                	<a href="<?php echo base_url('user/alamat'); ?>" class="btn btn-danger">Kembali</a>
	                </div>
	            </form>
			</div>
		</div>
	</div>
</div>
<script>
	$(function () {
		$('.select2').select2({
			minimumInputLength: 3,
		    placeholder: "Ketik desa/kecamatan/kabupaten atau kota/provinsi/kode pos",
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

	});
</script>