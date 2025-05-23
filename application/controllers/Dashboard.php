<?php

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
 		$this->load->library('template');
		$this->load->model("M_model");
        date_default_timezone_set('asia/jakarta');
        if($this->session->userdata('id')==""||!$this->session->userdata('is_login')){
			redirect("");
		}
	}
	public function index(){
		$data['teest'] = "";
		$this->template->load('template','admin/dashboard', $data);
	}
	public function kategori(){
		$id = $this->input->get('id');
		$get = $this->db->query("SELECT * FROM kategori where id = '".$id."'")->row();
		if($get){
			$data['id']            = $get->id;
			$data['nama']          = $get->nama;
			$data['hidden']        = "";
			$data['path_lama']     = $get->icon;
			$data['btn_text']      = "Update";
		} else {
			$data['id']            = "";
			$data['nama']          = "";
			$data['hidden']        = "d-none";
			$data['path_lama']     = "";
			$data['btn_text']      = "Simpan";
		}
		$data['kategori'] = $this->getKategori();
		$this->template->load('template','admin/kategori', $data);
	}
	public function getKategori(){
		$isi = "";
		$no = 0;
		$get = $this->db->query("SELECT k.* from kategori k order by created_at asc")->result();
		foreach ($get as $val) {
			$isi .= '
			<tr>
				<td>
					<a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="edit_mitra('.$val->id.')"><i class="fa fa-edit"></i></a>
					<a href="javascript:void(0);" class="btn btn-xs btn-danger" onclick="hapus_mitra('.$val->id.')"><i class="fa fa-trash"></i></a>
				</td>
				<td>'.$val->nama.'</td>
			</tr>
			';
		}
		if(count($get)==0){
			$isi .= '
			<tr>
				<td colspan="2" class="text-center">Tidak ada data</td>
			</tr>
			';
		}
		$data['isi'] = $isi;
		$data[$this->security->get_csrf_token_name()] = $this->security->get_csrf_hash();
		return $data;
	}
	
	public function save_kategori(){
		$id     = $this->input->post('id');
		$nama   = $this->input->post('nama');

		$tgl = date("Y-m-d H:i:s");
		if($id==""){
			$value = array(
				'nama'=>$nama,
				'status'=>'1',
				'created_at'=>$tgl,
				'updated_at'=>$tgl,
			);
			$this->db->insert('kategori',$value);

			$last_id = $this->db->insert_id();
			
			$alert = $this->M_model->create_alert("Data Tersimpan","pesan","alert-success");
			$this->session->set_flashdata('pesan', $alert);
		} else {
			$where = array('id'=>$id);
			$value = array(
				'nama'=>$nama,
				'updated_at'=>$tgl,
			);
			$this->db->update('kategori',$value,$where);

			$last_id = $id;
			
			$alert = $this->M_model->create_alert("Data Terupdate","pesan","success");
			$this->session->set_flashdata('pesan', $alert);
		}
		redirect('Dashboard/kategori');
	}
	public function hapus_kategori(){
		$id = $this->input->post('id');
		$where = array('id'=>$id);
		$this->db->delete('kategori',$where);
		$data = $this->getDataMitra();
		echo json_encode($data);
	}
	public function getDataMitra(){
		$isi = "";
		$no = 0;
		$get = $this->db->query("SELECT u.* from usaha u inner join kategori k on k.id = u.kategori_id order by created_at asc")->result();
		foreach ($get as $val) {
			$isi .= '
			<tr>
				<td>
					<a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="edit_mitra('.$val->id.')"><i class="fa fa-edit"></i></a>
					<a href="javascript:void(0);" class="btn btn-xs btn-danger" onclick="hapus_mitra('.$val->id.')"><i class="fa fa-trash"></i></a>
				</td>
				<td>'.$val->nama.'</td>
				<td>'.$val->kategori.'</td>
				<td>'.$val->created_at.'</td>
			</tr>
			';
		}
		if(count($get)==0){
			$isi .= '
			<tr>
				<td colspan="5" class="text-center">Tidak ada data</td>
			</tr>
			';
		}
		$data['isi'] = $isi;
		$data[$this->security->get_csrf_token_name()] = $this->security->get_csrf_hash();
		return $data;
	}
	public function mitra(){
		$id = $this->input->get('id');
		$get = $this->db->query("SELECT * FROM usaha where id = '".$id."'")->row();
		if($get){
			$data['id']          = $get->id;
			$data['nama']        = $get->nama;
			$data['deskripsi']   = $get->deskripsi;
			$data['kategori_id'] = $get->kategori_id;
			$data['alamat']      = $get->alamat;
			$data['owner']       = $get->owner;
			$data['nohp']        = $get->nohp;
			$data['no_wa']       = $get->no_wa;
			$data['email']       = $get->email;
			$data['is_open']     = $get->is_open;
			$data['hidden']      = "";
			$data['path_lama']   = $get->icon;
			$data['btn_text']    = "Update";
		} else {
			$data['id']          = "";
			$data['nama']        = "";
			$data['deskripsi']   = "";
			$data['kategori_id'] = "";
			$data['alamat']      = "";
			$data['owner']       = "";
			$data['nohp']        = "";
			$data['no_wa']       = "";
			$data['email']       = "";
			$data['is_open']     = "";
			$data['hidden']      = "d-none";
			$data['path_lama']   = "";
			$data['btn_text']    = "Simpan";
		}
		$data['kategori'] = $this->db->query("SELECT * from kategori")->result();
		$this->template->load('template','mitra/list_mitra', $data);
	}
}
?>