<?php 

class Produk extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("M_model");
 		$this->load->library('template');
        date_default_timezone_set('asia/jakarta');
	}
	public function detail(){
		$id = $this->uri->segment(3);
		$data['produk'] = $this->db->query("SELECT p.*, u.address_name from produk p inner join usaha u on u.id = p.usaha_id where p.id = '".$id."'")->row();

		$this->template->load('template_home','main_page/detail_produk',$data);
	}
	public function list(){
		$data['produk'] = $this->db->query("SELECT p.*, u.address_name from produk p inner join usaha u on u.id = p.usaha_id order by rand()")->result();
		$this->template->load('template_home','main_page/list_produk',$data);
	}
}
 ?>