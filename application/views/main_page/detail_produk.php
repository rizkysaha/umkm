<div style="margin-top: 4rem !important;">
	<div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <!-- <h3 class="d-inline-block d-sm-none"><?php echo $produk->nama; ?></h3> -->
              <div class="col-12">
                <img src="<?php echo base_url($produk->foto); ?>" class="product-image" alt="Product Image">
              </div>
              <div class="col-12 product-image-thumbs">
                <!-- <div class="product-image-thumb active"><img src="<?php echo base_url($produk->foto); ?>" alt="Product Image"></div>
                <div class="product-image-thumb"><img src="<?php echo base_url(); ?>assets/dist/img/prod-2.jpg" alt="Product Image"></div>
                <div class="product-image-thumb"><img src="<?php echo base_url(); ?>assets/dist/img/prod-3.jpg" alt="Product Image"></div>
                <div class="product-image-thumb"><img src="<?php echo base_url(); ?>assets/dist/img/prod-4.jpg" alt="Product Image"></div>
                <div class="product-image-thumb"><img src="<?php echo base_url(); ?>assets/dist/img/prod-5.jpg" alt="Product Image"></div> -->
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3"><?php echo $produk->nama; ?></h3>
              <p>Rp. <?php echo number_format($produk->harga_jual,0,",","."); ?></p>

              <table width="100%" class="table table-condensed">
                <tr>
                  <td width="50%">Dikirim dari</td>
                  <td width="50%"><i class="fa fa-map-marker-alt"></i> <?php echo $produk->address_name; ?></td>
                </tr>
                <tr>
                  <td width="50%">Stok</td>
                  <td width="50%"><?php echo $produk->stok; ?></td>
                </tr>
                <tr>
                  <td width="50%">Berat</td>
                  <td width="50%"><?php echo number_format($produk->berat,0,",","."); ?> gram</td>
                </tr>
                <!-- <?php 
                if($val->url!=""){
                ?>
                <tr>
                  <td width="50%">Link Produk</td>
                  <td width="50%"><span class="text-indigo" onclick="copy(this)"><?php echo $val->url; ?></span> </td>
                </tr>
                <?php 
                }?> -->
              </table>
              <div class="mt-4">
                <div class="btn btn-primary btn-flat" onclick="add_cart(<?php echo $produk->id; ?>)">
                  <i class="fas fa-cart-plus fa-lg mr-2"></i>
                  Add to Cart
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-4">
            <nav class="w-100">
              <div class="nav nav-tabs" id="product-tab" role="tablist">
                <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Deskripsi</a>
                <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Comments</a>
                <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Rating</a>
              </div>
            </nav>
            <div class="tab-content p-3" id="nav-tabContent">
              <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"><?php echo $produk->deskripsi; ?></div>
              <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum. </div>
              <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"> Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. Donec varius massa at semper posuere. Integer finibus orci vitae vehicula placerat. </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
</div>
<script>
  $(document).ready(function() {
    $('.product-image-thumb').on('click', function () {
      var $image_element = $(this).find('img')
      $('.product-image').prop('src', $image_element.attr('src'))
      $('.product-image-thumb.active').removeClass('active')
      $(this).addClass('active')
    })
  });
  function add_cart(id){
    $.ajax({
      url : '<?php echo base_url('cart/add'); ?>',
      data : { produk_id : id },
      type : 'POST',
      dataType : 'JSON',
      success : function(data){
        if(!data.is_login){
          $("#modal_login").modal('show');
        } else {

          location.reload();
        }
      },
      error   : function(data){
        Toast.fire({
          icon: 'error',
          title: 'Terjadi kesalahan'
        });
      }
    });
  }
</script>