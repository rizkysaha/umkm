<?php 
class User extends CI_Controller
{
	private $pass_key = "4b0g0b0g4y33ll0ww";
	function __construct()
	{
		parent::__construct();
		$this->load->model("M_model");
 		$this->load->library('template');
        date_default_timezone_set('asia/jakarta');
	}
	public function login(){
		$this->form_validation->set_rules('text_filed', 'username', 'required');
 		$this->form_validation->set_rules('password_field', 'password', 'required');
 		if ($this->form_validation->run() == FALSE){
 			$username = $this->db->escape_str($this->input->post("username"));
	 		$password = $this->db->escape_str($this->input->post("password"));
	 		$pass = hash_hmac('sha256', $password , $this->pass_key);

	 		$get_user = $this->db->query("SELECT * from users where username = '".$username."' and password = '".$pass."'")->row();
	 		if($get_user){
	 			// membuat session
	            $this->session->set_userdata('id', $get_user->id);
	            $this->session->set_userdata('role_id', $get_user->role_id);
	            $this->session->set_userdata('is_login', TRUE);

	            $data['code'] = 200;
	            $data['ket'] = "Sukses login";
	 		} else {
	 			$this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissible">
	                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                  Username dan password salah
	                </div>');
	 			$data['code'] = 500;
	            $data['ket'] = "Username dan password salah";
	 		}
 		} else {
 			$data['code'] = 500;
            $data['ket'] = "Harap isi form dengan lengkap";
 		}
 		echo json_encode($data);
	}
	public function register(){
		$this->form_validation->set_rules('text_filed', 'username', 'required');
 		$this->form_validation->set_rules('password_field', 'password', 'required');
		$this->form_validation->set_rules('text_filed', 'nama', 'required');
		if ($this->form_validation->run() == FALSE){
			$nama = $this->db->escape_str($this->input->post("nama"));
			$username = $this->db->escape_str($this->input->post("username"));
	 		$password = $this->db->escape_str($this->input->post("password"));
	 		$pass = hash_hmac('sha256', $password , $this->pass_key);

			$get_user = $this->db->query("SELECT * from users where username = '".$username."' ")->row();
			if($get_user){
				$data['ket'] = "Username sudah digunakan";
				$data['code'] = 500;
			} else {
				$tgl = date("Y-m-d H:i:s");
				$values = array(
					'username'=>$username,
					'password'=>$pass,
					'nama'=>$nama,
					'created_at'=>$tgl,
					'updated_at'=>$tgl,
					'role_id'=>2,
					'status'=>1
				);
				$this->db->insert('users',$values);
                $last_id = $this->db->insert_id();
				$this->session->set_userdata('id', $last_id);
	            $this->session->set_userdata('role_id', 2);
	            $this->session->set_userdata('is_login', TRUE);

				$data['ket'] = "Sukses register";
				$data['code'] = 200;
			}

				
		}else {
			$data['ket'] = "Harap isi form dengan lengkap";
			$data['code'] = 500;
		}
		echo json_encode($data);
	}
	public function daftar(){
		$this->template->load('template_home','admin/register');
	}
	public function signin(){
		$this->template->load('template_home','admin/login');
	}
	public function alamat(){
		$user_id = $this->session->userdata('id');
		$data['alamat'] = $this->db->query("SELECT * from alamat where user_id = '".$user_id."' order by status desc, id desc")->result();
		$this->template->load('template_home','user/alamat',$data);
	}
	public function form_alamat(){
		$user_id = $this->session->userdata('id');
		$id = $this->uri->segment(3);
		$get = $this->db->query("SELECT * from alamat where id = '".$id."'")->row();
		if($get){
			$data['id']           = $get->id;
			$data['user_id']      = $get->user_id;
			$data['alamat']       = $get->alamat;
			$data['nama_lengkap'] = $get->nama_lengkap;
			$data['nohp']         = $get->nohp;
			$data['address_id']   = $get->address_id;
			$data['address_name'] = $get->address_name;
			$data['status'] 	  = $get->status;
			$data['hidden']       = "";
			$data['btn_text']     = "Update";
		} else {
			$data['id']           = "";
			$data['user_id']      = "";
			$data['alamat']       = "";
			$data['nama_lengkap'] = "";
			$data['nohp']         = "";
			$data['address_id']   = "";
			$data['address_name'] = "";
			$data['status'] 	  = "";
			$data['hidden']       = "d-none";
			$data['btn_text']     = "Simpan";
		}
		$this->template->load('template_home','user/form_alamat',$data);
	}
	public function save_alamat(){
		$user_id = $this->session->userdata('id');
		$id = $this->input->post('id');
		$alamat = $this->input->post('alamat');
		$nama_lengkap = $this->input->post('nama_lengkap');
		$nohp = $this->input->post('nohp');
		$status = $this->input->post('status'); if($status==""){ $status = 0;}

		$address = $this->input->post('address');
		$address_id = explode("|", $address)[0];
		$address_name = explode("|", $address)[1];

		$cek_alamat = $this->db->query("SELECT * from alamat where user_id = '".$user_id."' and id = '".$id."' limit 1")->row();
    	if($cek_alamat && $cek_alamat->status==1 && $status == 0){
    		$alert = "Alamat utama tidak boleh dihapus";
			$this->session->set_flashdata('pesan', $alert);
    	} else {
    		if($status==1){
	    		$this->db->query("UPDATE alamat set status = 0 where user_id = '".$user_id."'");
	    	}
	    	$ada = $this->db->query("SELECT id from alamat where user_id = '".$user_id."'")->row();
	    	if($ada){

	    	} else {
	    		$status = 1;
	    	}
	    	$values = array(
    			'user_id'=>$user_id,
    			'nama_lengkap'=>$nama_lengkap,
    			'nohp'=>$nohp,
    			'alamat'=>$alamat,
    			'status'=>$status,
    			'address_id'=>$address_id,
				'address_name'=>$address_name,
    		);
	    	if($id==""){
	    		$this->db->insert('alamat',$values);
			} else {
				$where = array('id'=>$id);
				$this->db->update('alamat',$values,$where);
			}
    	}
    	redirect(base_url('user/alamat'));
	}
	public function pesanan(){
		$this->template->load('template_home','user/pesanan');
	}
	public function logout(){
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('is_login');
		$this->session->unset_userdata('role_id');
		session_destroy();
		redirect(base_url());
	}
}
 ?>