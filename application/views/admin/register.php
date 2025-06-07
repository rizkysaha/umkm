<div class="register-box justify-content-center" style="margin-top: 4rem !important;">

  <div class="card">
    <div class="card-body register-card-body">
        <p class="login-box-msg">Daftar sebagai user baru</p>

        <form id="form_register">
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" id="retype" name="retype" placeholder="Retype password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="button" onclick="register()" class="btn btn-primary btn-block">Daftar</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="<?php echo base_url('User/signin'); ?>" class="btn btn-block btn-primary">
            
            Saya sudah punya akun
          </a>
        </div>

        <!-- <a href="login.html" class="text-center">I already have a membership</a> -->
      </div>
  </div>
  	
</div>
<script>
  function register(){
    var password = $("#password").val();
    var retype = $("#retype").val();
    if(password==retype){
      $.ajax({
        url   : '<?php echo base_url('user/register'); ?>',
        type  : 'POST',
        dataType: 'JSON',
        data : $("#form_register").serialize(),
        success : function(data){
          if(data.code==200){
            window.location.href = '<?php echo base_url() ?>';
          } else {
            Toast.fire({
              icon: 'warning',
              title: data.ket
            })
          }
          
        },
        error : function(data){
          Toast.fire({
            icon: 'error',
            title: 'Terjadi kesalahan'
          })
        }
      })
    } else {
      Toast.fire({
        icon: 'error',
        title: 'Harap masukkan password yang sama'
      })
    }
      
  }
</script>