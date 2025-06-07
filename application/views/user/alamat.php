<div class="row justify-content-center" style="margin-top: 8rem !important;">
	<div class="col-12">
		<div class="card">
			<div class="card-body p-0">
				<ul class="products-list product-list-in-card pl-2 pr-2">
					<li class="item">
			            <a href="<?php echo base_url('user/form_alamat'); ?>" class="product-info ml-0">
			              	<span class="product-description">
			              		<span>Tambah alamat baru</span>
			              		<span class="float-right"><i class="fa fa-plus"></i></span>
			              	</span>
			            </a>
			        </li>
			    </ul>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body p-0">
				<ul class="products-list product-list-in-card pl-2 pr-2">
					<?php 
					
					$toko_id = "";
					foreach ($alamat as $val) {
						if($val->status==1){
							$status = '<span class="badge badge-danger float-right"><i class="fa fa-map-marker-alt"></i></span>';
						} else {
							$status = '<span class="badge badge-primary float-right"><i class="fa fa-map-marker-alt"></i></span>';
							$status	= "";
						}
					?>
					<li class="item">
				        <div class="product-info ml-0">
				          	<a href="<?php echo base_url('user/form_alamat/'.$val->id) ?>" class="product-title"><?php echo $val->nama_lengkap; ?>
				            <?php echo $status; ?></a>

				          	<span class="product-description">
				          		<?php echo $val->nohp; ?>
				          	</span>
				          	<span class="product-description">
				          		<?php echo $val->alamat; ?>
				          	</span>
				          	<span class="product-description">
				            	<?php echo $val->address_name; ?>
				          	</span>
				        </div>
				      </li>
					<?php
					}
					?>
			          
			      
			    </ul>
			</div>
		</div>
	</div>  
</div>