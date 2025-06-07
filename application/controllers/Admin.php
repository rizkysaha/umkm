<?php 
 class Admin extends CI_Controller
 {
	private $pass_key = "4b0g0b0g4y33ll0ww";
 	function __construct()
 	{
 		parent::__construct();
		$this->load->model("M_model");
 		$this->load->library('template');
        date_default_timezone_set('asia/jakarta');
 	}
 	public function signin(){
 		$data['admin'] = hash_hmac('sha256', "admin" , $this->pass_key);

 		$this->load->view('admin/login',$data);
		// $this->template->load('template_home','admin/login');
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
	            if($get_user->role_id==1){
		            redirect(base_url('dashboard'));
	            } else {
		            redirect(base_url());
	            }
	 		} else {
	 			$this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissible">
	                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                  Username dan password salah
	                </div>');
	 			// echo "salah";
	 			redirect(base_url('adm'));
	 		}
 		} else {
 			$this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  Harap isi form dengan lengkap
                </div>');
 			// echo "salah";
 			redirect(base_url('adm'));
 		}
	 		
 	}
 } 
?>