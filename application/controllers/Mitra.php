<?php 
/**
 * 
 */
class Mitra extends CI_Controller
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
		$data['mitra'] = $this->db->query("SELECT u.*, k.nama as nama_kategori
			from usaha u
			left join kategori k on k.id = u.kategori_id
			where u.id = '".$id."'")->row();
		$this->template->load('template_home','main_page/detail_mitra',$data);
	}
	public function list(){
		$data['mitra'] = $this->db->query("SELECT u.*, k.nama as nama_kategori, (SELECT count(p.id) from produk p where p.usaha_id = u.id) as jumlah_produk from usaha u inner join kategori k on k.id = u.kategori_id order by created_at asc")->result();
		$this->template->load('template_home','main_page/list_mitra',$data);
	}
}
?>