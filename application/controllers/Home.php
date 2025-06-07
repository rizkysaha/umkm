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
		$data['mitra'] = $this->db->query("SELECT u.*, k.nama as nama_kategori, (SELECT count(p.id) from produk p where p.usaha_id = u.id) as jumlah_produk from usaha u inner join kategori k on k.id = u.kategori_id order by created_at asc")->result();
		$data['produk'] = $this->db->query("SELECT p.*, u.address_name from produk p inner join usaha u on u.id = p.usaha_id order by rand() limit 4")->result();
		$this->template->load('template_home','main_page/home',$data);
	}
}
 ?>