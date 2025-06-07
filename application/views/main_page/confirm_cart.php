<style type="text/css">
	.b-b {
	    padding: 1rem;
	    border: 3px solid transparent;
	    border-image: 1 repeating-linear-gradient(-45deg, red 0, red 1em, transparent 0, transparent 2em,
	                  #58a 0, #58a 3em, transparent 0, transparent 4em);
	    
	}
	.b-dashed{
		border-bottom:dashed; border-bottom-color:red;
	}
</style>
<div class="row " style="margin-top: 8rem !important;">
	<div class="col-12">
		<div class="card">
			<form id="form_cart" method="post" action="<?php echo base_url(); ?>cart/confirm_cart">
			<div class="card-body pl-0 pr-0 pt-0">
				<ul class="products-list product-list-in-card pl-2 pr-2">
					<?php 
					if($alamat){ ?>
						<li class="item " data-toggle="modal" data-target="#bottom">
							<span class="pull-right m-l-xs"><i class="fa fa-map-marker-alt"></i></span>
							 Alamat pengiriman 
							 <div id="detail_alamat">
							 	<span class="text-muted block" id="alamat_nama"><?php echo $alamat->nama_lengkap?></span><br>
							 	<span class="text-muted block" id="alamat_nohp"><?php echo $alamat->nohp?></span><br>
								<span class="text-muted block" id="alamat_lengkap"><?php echo $alamat->alamat?></span><br>
				      			<span class="text-muted block" id="alamat_ket"><?php echo $alamat->address_name?></span>

				      			<input type="hidden" name="alamat_id" id="alamat_id" value="<?php echo $alamat->id; ?>">
							 </div>
								
			    		</li>
			    		<li class="b-dashed"></li>
					<?php
					} else {

					}
					$total_bayar = 0;
	        		$subtotal_produk = 0;
	        		$subtotal_ongkir = 0;

	        		$berat = 0;
	        		$jml_qty = 0;
	        		$jml_sub = 0;
	        		$toko_id = "";
	        		$no = 0;
	        		$div_prev = "";
	        		$dv_now = "";
	        		foreach ($keranjang as $val) {
	        			if($toko_id!=$val->usaha_id){
	        				if($no>0){
	        					// echo '</ul>';
	        				}
	        				echo '
	        				<li class="item">
					          	<div class="badge badge-success">'.$val->nama_toko.'</div>
					        </li>
	        				';
	        				
	        			} 
	        			$no++;
	        			$sub_total = $val->jumlah*$val->harga_jual;

	        			$subtotal_produk += $sub_total;
	        			$total_bayar += $sub_total;
	        			$jml_sub += $sub_total;

	        			$berat += $val->jumlah*$val->berat;
	        			$jml_qty += $val->jumlah;	
	        			?>
	        			<li class="item">
	        				<div class="product-img">
	        					<img src="<?php echo base_url($val->foto_produk); ?>" alt="Product Image" class="img-size-50 ">
	        				</div>
					        <div class="product-info">
					        	<input type="hidden" name="cart_id[]" value="<?php echo $val->id; ?>">
					        	<input type="hidden" name="produk_id[]" value="<?php echo $val->produk_id; ?>">
					        	<input type="hidden" name="produk_nama[]" value="<?php echo $val->nama_produk; ?>">
					        	<input type="hidden" name="produk_foto[]" value="<?php echo $val->foto_produk; ?>">
					        	<input type="hidden" name="harga[]" value="<?php echo $val->harga_jual; ?>">
					        	<input type="hidden" name="qty[]" value="<?php echo $val->jumlah; ?>">
					        	<input type="hidden" name="catatan[]" value="<?php echo $val->catatan; ?>">
					        	<input type="hidden" name="toko_id[]" id="toko_<?php echo $val->id; ?>" value="<?php echo $val->usaha_id; ?>">
					        	<span class="product-description pl-2">
					                <?php echo $val->nama_produk ?>
					            </span>
					            <span class="pl-2 text-primary">Rp. <?php echo number_format($val->harga_jual,0,",","."); ?></span>
					            <div class="row">
					            	<div class="col-12">
					            		<div class="pull-left text-muted">
							            	x<?php echo number_format($val->jumlah,0,",","."); ?> (<?php echo number_format(($val->jumlah*$val->berat),0,",","."); ?> gram)
							            </div>
							            <div class="pull-right">
								            
								        </div>
					            	</div>
					            </div>
					        </div>
					        <div class="row ">
					        	<div class="col-12">
					        		<div class="p-t-sm">
					            		<span ><?php echo $val->catatan; ?></span>
					            	</div>
					        	</div>
				            </div>
				        </li>
				        <?php
				        if(($toko_id!=$val->usaha_id && $val->jml_toko==1 && $toko_id!="") || ($val->jml_toko==$no) ){
				        	?>
				        	<li class="item">
				        		<div class="btn btn-block btn-sm btn-info" onclick="get_ongkir('<?php echo $val->id; ?>', '<?php echo $val->usaha_id; ?>','<?php echo $berat; ?>')">Pilih opsi pengiriman </div>
				        		<input type="hidden" name="total_bayar[]" id="subongkir_<?php echo $val->id; ?>" value="0">
				        		<input type="hidden" name="kurir_<?php echo $val->usaha_id; ?>" id="kurir_<?php echo $val->id; ?>" value="">
				        		<input type="hidden" name="ongkir_<?php echo $val->usaha_id; ?>" id="ongkir_<?php echo $val->id; ?>" value="">
				        		<input type="hidden" name="subtotal_<?php echo $val->usaha_id; ?>" id="subtotal_<?php echo $val->id; ?>" value="<?php echo $jml_sub; ?>">
				        	</li>
				        	<li class="item">
					        	Total pesanan (<?php echo $jml_qty; ?> Produk) : 
					        	<span class="float-right text-orange font-bold" id="txt_subtotal_<?php echo $val->id;?>" style="font-weight:bold;">Rp. <?php echo number_format($jml_sub,0,",","."); ?></span>
					        </li>
					        <div id="modal_form_<?php echo $val->id; ?>" class="modal fade" data-backdrop="true">

					        </div>
					        <div class="modal fade" id="modal_ongkir_<?php echo $val->id; ?>">
						        <div class="modal-dialog">
						          <div class="modal-content">
						            <div class="modal-header">
						              <h4 class="modal-title">Pilih Jasa Pengiriman</h4>
						              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						                <span aria-hidden="true">&times;</span>
						              </button>
						            </div>
						            <div class="modal-body" id="isi_modal_<?php echo $val->id; ?>">
						             	
						            </div>
						            <div class="modal-footer justify-content-between">
						              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						              <button type="button" class="btn btn-primary" onclick="selected_ongkir('<?php echo $val->id; ?>')" data-dismiss="modal">Selesai</button>
						            </div>
						          </div>
						          <!-- /.modal-content -->
						        </div>
						        <!-- /.modal-dialog -->
						      </div>
						      <!-- /.modal -->
				        	<?php
				        	$no = 0;
	        				$berat = 0;
		        			$jml_qty = 0;
		        			$jml_sub = 0;
				        } ?>

				        <?php
				        $toko_id = $val->usaha_id;
	        		}
					?>

					<li class="item">
						&nbsp;
					</li>
					<li class="item">
			        	Subtotal Produk : 
			        	<span class="float-right text-orange font-bold" id="" style="font-weight:bold;">Rp. <?php echo number_format($subtotal_produk,0,",","."); ?></span>
			        </li>
			        <li class="item">
			        	Subtotal Ongkir : 
			        	<span class="float-right text-orange font-bold" id="subtotal_ongkir" style="font-weight:bold;">Rp. 0</span>
			        </li>
			        <li class="item">
			        	Total Pembayaran : 
			        	<span class="float-right text-orange font-bold" id="total_bayar" style="font-weight:bold;">Rp. <?php echo number_format($total_bayar,0,",","."); ?></span>
			        	<input type="hidden" name="total_bayar[]" value="<?php echo number_format($total_bayar,0,",","."); ?>">
			        </li>
			        <li class="item">
			        	<button class="btn btn-success btn-sm float-right">Buat Pesanan</button>
			        </li>
				</ul>
			</div>
			</form>
			<div class="overlay dark invisible" id="overlay_paging">
			    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
			</div>
		</div>
	</div>
</div>
<script>
	function get_ongkir(id, usaha_id, berat){
		var alamat_id = $("#alamat_id").val();
		buka_overlay("overlay_paging");
		$.ajax({
			url 	: '<?php echo base_url('cart/get_ongkir'); ?>',
			type 	: 'POST',
			dataType: 'JSON',
			data 	: { id : id, usaha_id : usaha_id, alamat_id : alamat_id, berat : berat },
			success : function(data){
				tutup_overlay("overlay_paging");
				$("#modal_ongkir_"+id).modal('show');
				$("#isi_modal_"+id).html(data.isi);
			},
			error 	: function(data){
				tutup_overlay("overlay_paging");
				show_alert('error','Terjadi kesalahan');
			}
		});
	}
	function selected_ongkir(id){
 		var isi = document.querySelector('input[name="'+id+'"]:checked');
 		var txt = $("#lbl_"+id+isi.value).text();
 		var toko = $("#toko_"+id).val();
 		// alert(txt);
 		var cost = $("#tarif_"+id+isi.value).val();
 		var header = $("#header_"+id+isi.value).val();
 		var subtotal = $("#subtotal_"+id).val();
 		$("#kurir_"+id).val(header+", "+txt);
 		$(".list_selected_"+id).removeClass("hidden");
 		$(".list_selected_"+id).html('<span class="pull-right m-l-xs">Rp. '+cost+'</span>'+header+'<span class="text-muted block">'+txt+'</span>');
 		$("#subongkir_"+id).val(cost);
 		$("#ongkir_"+id).val(cost);
 		$("#txt_subtotal_"+id).text("Rp. "+formatAngka(parseInt(subtotal) + parseInt(cost.replace(".",""))));
 		sum_total();
 	}
	function buka_overlay(overlay_id){
	    $("#"+overlay_id).removeClass("invisible");
	}
	function tutup_overlay(overlay_id){
	    $("#"+overlay_id).addClass("invisible");
	}
	function show_alert(tipe, isi){
		Toast.fire({
	        icon: tipe,
	        title: isi
	      })
	}
</script>