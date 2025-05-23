<?php 

class Home extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("M_model");
 		$this->load->library('template');
        date_default_timezone_set('asia/jakarta');
	}
	public function index(){
		$data['test'] = "home test";
		$this->template->load('template_home','main_page/home',$data);
	}
}
 ?>