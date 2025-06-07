<?php 
class Kontak extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("M_model");
 		$this->load->library('template');
        date_default_timezone_set('asia/jakarta');
	}
	public function index(){

		$this->template->load('template_home','main_page/kontak_kami');
	}
}
 ?>