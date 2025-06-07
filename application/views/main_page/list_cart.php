<?php 
$utama_alamat = "";
$utama_id = "";
$list_alamat = "";
$no = 0;
foreach ($alamat as $val) {
	if($no==0){
		$utama_alamat = '
			<li class="item" data-toggle="modal" data-target="#bottom">
				<span class="pull-right m-l-xs"><i class="fa fa-map-marker-alt"></i></span>
				 Dikirim ke <span class="" style="font-weight:bold;" id="alamat_nama">'.$val->nama_lengkap.'</span> <i class="fa fa-angle-right"></i>
				 <div id="detail_alamat">
				 	<span class="text-muted block" id="alamat_nohp">'.$val->nohp.'</span><br>
					<span class="text-muted block" id="alamat_lengkap">'.$val->alamat.'</span><br>
	      			<span class="text-muted block" id="alamat_ket">'.$val->address_name.'</span>
				 </div>
					
    	</li>';
		$utama_id = $val->id;
		$checked = "checked";

	} else {
		$checked = "";
	}
	if($val->status==1){
		$is_utama = '<span class="pull-right m-l-xs text-red">[Utama]</span>';
	} else {
		$is_utama = '';
	}
	
	$list_alamat .= '
	<li class="item">
		<div class="custom-control custom-radio">
          <input class="custom-control-input" type="radio" id="ongkir_'.$val->id.'" name="ongkir" value="'.$val->id.'" '.$checked.' onclick="set_ongkir(this,\''.$val->nama_lengkap.'\',\''.$val->nohp.'\',\''.$val->alamat.'\',\''.$val->address_name.'\')">
          <label for="ongkir_'.$val->id.'" class="custom-control-label">
          		'.$is_utama.'
			    <span class="text-muted block">'.$val->nama_lengkap.' | '.$val->nohp.'</span><br>
			    <span class="text-muted block">'.$val->alamat.'</span><br>
			    <span class="text-muted block">'.$val->address_name.'</span>
          </label>
        </div>
  	</li>
	';
	$no++;
}
 ?>
<div class="row " style="margin-top: 8rem !important;">
	<div class="col-12">
		<div class="card">
			<form id="form_cart" method="post" action="<?php echo base_url(); ?>cart/confirm_cart">

			<div class="card-body p-0">

				<ul class="products-list product-list-in-card pl-2 pr-2">
					<?php 
	        		if(count($alamat)<1){ ?>
						<li class="item" onclick="buka()">
					        <a href="<?php echo base_url(); ?>user/form_alamat" class="block _500" >
					        <span class="pull-right text-muted m-l-xs"><i class="fa fa-plus"></i></span>
					        Tambah alamat agar bisa checkout</a>
					    </li>
					<?php
					} ?>

					<?php echo $utama_alamat; ?>
					<input type="hidden" name="alamat_id" id="alamat_id" value="<?php echo $utama_id; ?>">
					<?php 
					
	        		$toko_id = "";
	        		$no = 0;
					foreach ($cart as $val) {
						if($toko_id!=$val->usaha_id){
	        				if($no>0){
		        			?>

		        			<?php
		        			}
		        			$no = 0;
		        			$no++;
	        			?>

	        			<li class="item">
	        				<div class="custom-control custom-checkbox float-left">
	                          <input class="custom-control-input cek_all_" type="checkbox" id="cek_<?php echo $val->id; ?>" value="<?php echo $val->usaha_id ?>">
	                          <label for="cek_<?php echo $val->usaha_id; ?>" class="custom-control-label"><?php echo $val->nama_usaha; ?></label>
	                        </div>
				        </li>
				        	
	        			<?php
	        			}
					?>
					<li class="item">
						<div class="custom-control custom-checkbox float-left">
                          <input class="custom-control-input cek_<?php echo $val->usaha_id; ?>" type="checkbox" name="cek[]" id="<?php echo $val->id ?>" value="<?php echo $val->produk_id; ?>" onclick="get_jml_data('<?php echo $val->usaha_id; ?>')">
                          <label for="<?php echo $val->id ?>" class="custom-control-label"></label>
                        </div>
						<div class="product-img">

	                      <img src="<?php echo base_url($val->foto); ?>" alt="Product Image" class="img-size-50 ">
	                    </div>
			            <div class="product-info ">
			              <!-- <a href="javascript:void(0)" class="product-title"><?php echo $val->nama_produk ?>
			                </a> -->
			              <span class="product-description pl-2">
			                <?php echo $val->nama_produk ?>
			              </span>
			              <span class="pl-2">Rp. <?php echo number_format($val->harga_jual,0,",","."); ?></span>
			              <div class="row">
			              	<div class="col-6">
			              		<div class="input-group">
				            		<span class="input-group-btn">
						            	<button class="btn btn-sm white btn_kurang_<?php echo $val->id; ?>" type="button" onclick="kurang('<?php echo $val->id; ?>')" disabled=""><i class="fa fa-minus"></i></button>
						          	</span>
						          	<input type="number" value="<?php echo $val->jumlah; ?>" id="qty_<?php echo $val->id; ?>" name="qty[]" class="form-control form-control-sm text-center qty has-value" style="z-index:0;">
						          	<span class="input-group-btn">
						            	<button class="btn btn-sm white btn_tambah_<?php echo $val->id; ?>" type="button" onclick="tambah('<?php echo $val->id; ?>')"><i class="fa fa-plus"></i></button>
						          	</span>
					        	</div>
			              	</div>
			              	<div class="col-6">
			              		<a href="javascript:void(0);" class="text-danger float-right" onclick="">
			              			<i class="fa fa-trash"></i>
			              		</a>
			              	</div>
			              </div>
				          <div class="row">
				          	<?php 
				          	if($val->catatan==""){
			          			$hidden_txt = "";
			          			$hidden_catatan = "d-none";
			          		} else {
			          			$hidden_txt = "d-none";
			          			$hidden_catatan = "";
			          		}
				          	 ?>
				          	<div class="col-12 mt-2">
				          		<span class="text-orange <?php echo $hidden_txt; ?>" id="txt_catatan_<?php echo $val->id ?>" onclick="tampilkan_form(<?php echo $val->id; ?>)">Tulis catatan</span>
				          		<span class="<?php echo $hidden_catatan; ?>" id="hasil_catatan_<?php echo $val->id ?>"><?php echo $val->catatan; ?></span>
				          		<span class="text-orange <?php echo $hidden_catatan; ?>" id="ubah_catatan_<?php echo $val->id ?>" onclick="tampilkan_form(<?php echo $val->id; ?>)">Ubah</span>
				          		<div class="input-group input-group-sm d-none" style="z-index:0;" id="form_catatan_<?php echo $val->id; ?>">
						          	<input type="text" class="form-control form-control-sm" name="" id="catatan_<?php echo $val->id; ?>" value="<?php echo $val->catatan; ?>" placeholder="Catatan maks 225 karakter"  disabled>
						          	<span class="input-group-append" onclick="save_catatan(<?php echo $val->id; ?>)" id="btn_catatan_<?php echo $val->id; ?>">
						          		<button type="button" class="btn btn-info btn-flat">
							            	<i class="fa fa-edit"></i>
						          		</button>
						          	</span>

						        </div>
				          	</div>
				          </div>
			            </div>
			        </li>
					<?php
						$toko_id = $val->usaha_id;
					}
					?>
		        </ul>
			</div>
			<div class="card-footer">
				<div class="row">
					<div class="col-4">
						<div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="cek_all" value="option1">
                          <label for="cek_all" class="custom-control-label">SEMUA</label>
                        </div>
					</div>
					<div class="col-4">
						Subtotal
						<p  class="text-primary">Rp. <span id="subtotal"></span></p>
					</div>
					<div class="col-4">
						
						<button type="submit" class="btn btn-primary float-right" id="btn_checkout" onclick="btn_loading(this)" disabled>Checkout</button>
					</div>
				</div>
			</div>

			</form>
			<div class="overlay dark invisible" id="overlay_paging">
			    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
			</div>
		</div>
				
	</div>
</div>
<div class="modal modal-xl fade" id="bottom">
        <div class="modal-dialog" style="position: fixed;
    z-index: 1055;
    top: auto;
    left: 0;
    right: 0;
    bottom: 0;
    height:250px;
    ">
          <div class="modal-content" style="width: 100%;">
            <div class="modal-header">
              <h5 class="modal-title">Pilih Alamat</h5>
              
                <button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal" aria-label="Close">Pilih</button>
              
            </div>
            <div class="modal-body">
            	<ul class="products-list product-list-in-card pl-2 pr-2">
              		<?php echo $list_alamat; ?>
	            </ul>
            </div>
            <div class="modal-footer float-right">
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#cek_all").click(function() {
	        var cek_all = document.getElementById("cek_all");
	        var cek = document.getElementsByName("cek[]");
	        if(cek_all.checked==true){
	        	var checked = 0;
	            for(var x=0; x<cek.length; x++){
	            	if(!cek[x].hasAttribute('disabled')){
	            		cek[x].checked=true;
	            		checked++;
	            	}
	                
	            }
	            if(checked>=cek.length){
	            	$(".cek_all_").prop('checked', true);
	            }
	            
	        } else {
	            for(var x=0; x<cek.length; x++){
	                cek[x].checked=false;
	            }
	            $(".cek_all_").prop('checked', false);
	        }
	        cek_harga();
	        // get_jml_data();
    	});
		$(".cek_all_").change(function() {
	        var cek_all = $(this);
	        var checked = $(this).is(":checked");
	        var cek = $(".cek_"+cek_all.val());
	        if(checked){
	        	$(".cek_"+cek_all.val()).prop('checked', true);
	        } else {
	        	$(".cek_"+cek_all.val()).prop('checked',false);
	        }
	        cek_harga();
	        get_jml_data();
	    });
	    $(".qty").keydown(function(e){
	    	if(e.keyCode==13){
	    		var qty = $(this).val();
	    		var id = $(this).attr("id").split("_")[1];
	    		// alert(id);	
	    		

	    		update_qty(id,qty,"");
	    		event.preventDefault();
			    return false;
	    	}
	    });

	});
	function kurang(id){
		var isi = $("#qty_"+id).val();
		if(isi>1){
			isi = parseInt(isi) - 1;
			// $("#qty_"+id).val(isi);
			update_qty(id,isi,"minus");
		}
			
	}
	function tambah(id){
		var isi = $("#qty_"+id).val();
		isi = parseInt(isi) + 1;
		// $("#qty_"+id).val(isi);
		update_qty(id,isi,"plus");
	}
	function update_qty(id,val, jenis){
  		buka_overlay("overlay_paging");
  		$.ajax({
  			url 	: '<?php echo base_url(); ?>cart/update_qty',
  			data 	: { id : id, qty : val },
  			dataType: 'JSON',
  			type 	: 'POST',
  			success : function(data){
  				if(parseInt(val)>parseInt(data.minimal)){
  					$(".btn_kurang_"+id).attr('disabled', false);
  				} else {
  					$(".btn_kurang_"+id).attr('disabled', true);
  				}
  				if(data.res==20){
  					$("#qty_"+id).val(val);
  					cek_harga();
  				} else {
  					if(jenis=="plus"){
  						$("#qty_"+id).val(parseInt(val)-1);
  					} else if(jenis=="minus") {
  						$("#qty_"+id).val(parseInt(val)+1);
  					} else {
  						$("#qty_"+id).val(data.seharusnya);
  					}

  					show_alert(id,data.ket);
  				}
  				tutup_overlay("overlay_paging");
  			},
  			error 	: function(data){
  				tutup_overlay("overlay_paging");
  				alert("Terjadi kesalahan update qty");
  			}
  		});
  	}
  	function cek_harga(){
  		var alamat_id = $("#alamat_id").val();
  		var cek = document.getElementsByName("cek[]");
        var jml = 0;
        for(var x=0; x<cek.length; x++){
            if(cek[x].checked){
            	jml = parseInt(jml)+parseInt(1);
            }
        }
        if(jml>0 && alamat_id!=""){
        	$("#btn_checkout").attr('disabled', false);
        } else {
        	$("#btn_checkout").attr('disabled', true);
        }

  		buka_overlay("overlay_paging");
  		$.ajax({
  			url 	: '<?php echo base_url(); ?>cart/cek_cart',
  			data 	: $("#form_cart").serialize(),
  			type 	: 'POST',
  			dataType: 'JSON',
  			success : function(data){
  				tutup_overlay("overlay_paging");
  				$("#subtotal").text(data.harga);
  				$("#btn_checkout").text("Checkout ("+data.total_produk+")");
  			},
  			error 	: function(data){
  				tutup_overlay("overlay_paging");
  				alert("Terjadi Kesalahan");
  			}
  		});
  	}
  	function buka_overlay(overlay_id){
	    $("#"+overlay_id).removeClass("invisible");
	}
	function tutup_overlay(overlay_id){
	    $("#"+overlay_id).addClass("invisible");
	}
	function tampilkan_form(id){
    	$("#txt_catatan_"+id).addClass("d-none");
    	$("#form_catatan_"+id).removeClass("d-none");
    	$("#hasil_catatan_"+id).addClass("d-none");
    	$("#ubah_catatan_"+id).addClass("d-none");
    	save_catatan(id);
    }
    function tampilkan_txt(id){
    	$("#txt_catatan_"+id).removeClass("d-none");
    	$("#form_catatan_"+id).addClass("d-none");
    	$("#hasil_catatan_"+id).addClass("d-none");
    	$("#ubah_catatan_"+id).addClass("d-none");
    }
    function tampilkan_hasil(id, hasil){
    	$("#hasil_catatan_"+id).html(hasil);
    	$("#hasil_catatan_"+id).removeClass("d-none");
    	$("#ubah_catatan_"+id).removeClass("d-none");
    	$("#form_catatan_"+id).addClass("d-none");
    	$("#txt_catatan_"+id).addClass("d-none");
    }
    function set_ongkir(ini, nama, nohp, alamat_lengkap, address_name){
  		$("#alamat_id").val(ini.value);
  		$("#alamat_nama").text(nama);
  		$("#alamat_nohp").text(nohp);
		$("#alamat_lengkap").text(alamat_lengkap);
		$("#alamat_ket").text(address_name);
  	}
  	function btn_loading(ini){
  		var isi = $(ini).text();
  		$(ini).html(isi+' <i class="fa fa-spin fa-spinner"></i>');
  		// buka();
  	}
    function get_jml_data(toko_id){
		
		var cek2 = $(".cek_"+toko_id);
		var jml2 = 0;
		for(var x=0; x<cek2.length; x++){
            if(cek2[x].checked){
                jml2 = parseInt(jml2)+parseInt(1);
            }
        }
		if(jml2==cek2.length){
			$("#"+toko_id).prop('checked', true);
		} else {
			$("#"+toko_id).prop('checked', false);
		}


        var cek_all = document.getElementById("cek_all");
        var cek = document.getElementsByName("cek[]");
        var jml = 0;
        for(var x=0; x<cek.length; x++){
            if(cek[x].checked){
                jml = parseInt(jml)+parseInt(1);
            }
        }
        if(jml==cek.length){
            cek_all.checked=true;
        } else {
            cek_all.checked=false;
        }
        cek_harga();
        // if(id!=""){
        // 	show_alert(id);
        // }
  	}
    function save_catatan(id){
    	var btn = $("#btn_catatan_"+id);
    	var formx = $("#catatan_"+id);
    	if(btn.hasClass('primary')){
    		simpan_catatan(id);
    		btn.removeClass('primary');
    		btn.html('<button type="button" class="btn btn-success btn-flat"><i class="fa fa-edit"></i></button>');
    		formx.prop('disabled', true);
    	} else {
    		btn.addClass('primary');
    		btn.html('<button type="button" class="btn btn-success btn-flat"><i class="fa fa-check"></i></button>');
    		formx.prop('disabled', false);
    		var strLength= formx.val().length;
    		formx.focus();
    		formx[0].setSelectionRange(strLength, strLength);
    	}
    }
    function simpan_catatan(id){
    	var catatan = $("#catatan_"+id).val();
    	buka_overlay("overlay_paging");
  		$.ajax({
  			url 	: '<?php echo base_url(); ?>Cart/update_catatan',
  			data 	: { id : id, catatan : catatan },
  			dataType: 'JSON',
  			type 	: 'POST',
  			success : function(data){
  				if(data.res==20){
  					
  				} else {
  					show_alert(id,data.ket);
  				}
  				tutup_overlay("overlay_paging");
  				if(catatan==""){
  					tampilkan_txt(id);
  				} else {
  					tampilkan_hasil(id, catatan);
  				}
  			},
  			error 	: function(data){
  				tutup_overlay("overlay_paging");
  				alert("Terjadi kesalahan update qty");
  			}
  		});
    }
    function cek_harga(){
  		var alamat_id = $("#alamat_id").val();
  		var cek = document.getElementsByName("cek[]");
        var jml = 0;
        for(var x=0; x<cek.length; x++){
            if(cek[x].checked){
            	jml = parseInt(jml)+parseInt(1);
            }
        }
        if(jml>0 && alamat_id!=""){
        	$("#btn_checkout").attr('disabled', false);
        } else {
        	$("#btn_checkout").attr('disabled', true);
        }

  		buka_overlay("overlay_paging");
  		$.ajax({
  			url 	: '<?php echo base_url(); ?>cart/cek_cart',
  			data 	: $("#form_cart").serialize(),
  			type 	: 'POST',
  			dataType: 'JSON',
  			success : function(data){
  				tutup_overlay("overlay_paging");
  				$("#subtotal").text(data.harga);
  				$("#btn_checkout").text("Checkout ("+data.total_produk+")");
  			},
  			error 	: function(data){
  				tutup_overlay("overlay_paging");
  				alert("Terjadi Kesalahan");
  			}
  		});
  	}
    function show_alert(form_id, txt){
  		$(".pop").hide();
		$("#txt_pop_"+form_id).text(txt);
		$("#pop_"+form_id).slideDown(500);
		window.setTimeout(function(){
			$("#pop_"+form_id).slideUp(500);
		},1000);
  	}
</script>