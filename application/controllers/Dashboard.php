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
        	if($this->session->userdata('role_id')!="1"){
				redirect("");
        	}
		}
	}
	public function index(){
		$data['produk'] = $this->db->query("SELECT count(id) as total from produk")->row();
		$data['usaha'] = $this->db->query("SELECT count(id) as total from usaha")->row();
		$data['user'] = $this->db->query("SELECT count(id) as total from users")->row();
		$data['kategori'] = $this->db->query("SELECT count(id) as total from kategori")->row();
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
		$data = $this->getKategori();
		echo json_encode($data);
	}
	public function mitra(){
		$id = $this->input->get('id');
		$get = $this->db->query("SELECT * FROM usaha where id = '".$id."'")->row();
		if($get){
			$data['id']           = $get->id;
			$data['nama']         = $get->nama;
			$data['deskripsi']    = $get->deskripsi;
			$data['kategori_id']  = $get->kategori_id;
			$data['alamat']       = $get->alamat;
			$data['address_id']   = $get->address_id;
			$data['address_name'] = $get->address_name;
			$data['owner']        = $get->owner;
			$data['nohp']         = $get->nohp;
			$data['no_wa']        = $get->no_wa;
			$data['email']        = $get->email;
			$data['is_open']      = $get->is_open;
			$data['icon']         = $get->icon;
			$data['hidden']       = "";
			$data['path_lama']    = $get->icon;
			$data['btn_text']     = "Update";
		} else {
			$data['id']           = "";
			$data['nama']         = "";
			$data['deskripsi']    = "";
			$data['kategori_id']  = "";
			$data['alamat']       = "";
			$data['address_id']   = "";
			$data['address_name'] = "";
			$data['owner']        = "";
			$data['nohp']         = "";
			$data['no_wa']        = "";
			$data['email']        = "";
			$data['is_open']      = "";
			$data['icon']         = "";
			$data['hidden']       = "d-none";
			$data['path_lama']    = "";
			$data['btn_text']     = "Simpan";
		}
		$data['kategori'] = $this->db->query("SELECT * from kategori")->result();
		$data['mitra'] = $this->getListMitra();
		$this->template->load('template','mitra/list_mitra', $data);
	}
	public function getListMitra(){
		$isi = "";
		$no = 0;
		$get = $this->db->query("SELECT u.*, k.nama as nama_kategori, (SELECT count(p.id) from produk p where p.usaha_id = u.id) as jumlah_produk from usaha u inner join kategori k on k.id = u.kategori_id order by created_at asc")->result();
		foreach ($get as $val) {
			if($val->is_open==0){
				$statusnya = '<span class="badge badge-danger">Tutup</span>';
			} else {
				$statusnya = '<span class="badge badge-success">Buka</span>';
			}
			$isi .= '
			<tr>
				<td>
					<a href="'.base_url().'Dashboard/mitra?id='.$val->id.'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
					<a href="javascript:void(0);" class="btn btn-xs btn-danger" onclick="hapus_mitra('.$val->id.')"><i class="fa fa-trash"></i></a>
					<a href="'.base_url().'Dashboard/mitra_produk/'.$val->id.'" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
				</td>
				<td><img src="'.base_url().$val->icon.'" alt="" height="100px" class="" style=""></td>
				<td>'.$val->nama.'</td>
				<td>'.substr($val->deskripsi, 0, 100).'</td>
				<td>'.$val->nama_kategori.'</td>
				<td>
					<p>'.$val->address_name.'</p>
					<p>'.$val->alamat.'</p>
				</td>
				<td>'.$val->owner.'</td>
				<td class="text-right">'.number_format($val->jumlah_produk,0,",",".").'</td>
				<td>
					<ul>
						<li>Nohp : '.$val->nohp.'</li>
						<li>No WA : '.$val->no_wa.'</li>
						<li>Email : '.$val->email.'</li>
					</ul>
				</td>
				<td>'.$statusnya.'</td>
			</tr>
			';
		}
		if(count($get)==0){
			$isi .= '
			<tr>
				<td colspan="9" class="text-center">Tidak ada data</td>
			</tr>
			';
		}
		$data['isi'] = $isi;
		$data[$this->security->get_csrf_token_name()] = $this->security->get_csrf_hash();
		return $data;
	}
	public function save_mitra(){
		$id     = $this->input->post('id');
		$nama   = $this->input->post('nama');
		$deskripsi = $this->input->post('deskripsi');
		$kategori_id = $this->input->post('kategori');
		$alamat = $this->input->post('alamat');
		$owner = $this->input->post('owner');
		$nohp = $this->input->post('nohp');
		$no_wa = $this->input->post('no_wa');
		$email = $this->input->post('email');
		$is_open = $this->input->post('is_open');
		$icon = $this->input->post('icon');

		$address = $this->input->post('address');
		$address_id = explode("|", $address)[0];
		$address_name = explode("|", $address)[1];

		$path_lama = $this->input->post('path_lama');
		$path_lama = str_replace(base_url(), "", $path_lama);
		$namafile = "mitra_".date("ymdHis");
		$path = 'assets/images/';

		$tgl = date("Y-m-d H:i:s");

		$img_url = $this->M_model->set_upload2($path,$namafile,'icon',$path_lama);
		if($img_url!=""){
			if($id==""){
				$value = array(
					'nama'=>$nama,
					'deskripsi'=>$deskripsi,
					'kategori_id'=>$kategori_id,
					'alamat'=>$alamat,
					'address_id'=>$address_id,
					'address_name'=>$address_name,
					'owner'=>$owner,
					'nohp'=>$nohp,
					'no_wa'=>$no_wa,
					'email'=>$email,
					'is_open'=>$is_open,
					'icon'=>$img_url,
					'created_at'=>$tgl,
					'updated_at'=>$tgl,
				);
				$this->db->insert('usaha',$value);

				$last_id = $this->db->insert_id();
				
				
				$alert = $this->M_model->create_alert("Data Tersimpan","pesan","alert-success");
				$this->session->set_flashdata('pesan', $alert);
			} else {
				$where = array('id'=>$id);
				$value = array(
					'nama'=>$nama,
					'deskripsi'=>$deskripsi,
					'kategori_id'=>$kategori_id,
					'alamat'=>$alamat,
					'address_id'=>$address_id,
					'address_name'=>$address_name,
					'owner'=>$owner,
					'nohp'=>$nohp,
					'no_wa'=>$no_wa,
					'email'=>$email,
					'is_open'=>$is_open,
					'icon'=>$img_url,
					'updated_at'=>$tgl,
				);
				$this->db->update('usaha',$value,$where);

				$last_id = $id;
				
				$alert = $this->M_model->create_alert("Data Terupdate","pesan","success");
				$this->session->set_flashdata('pesan', $alert);
			}
		} else {
			$alert = $this->M_model->create_alert("Gagal simpan data","pesan","danger");
			$this->session->set_flashdata('pesan', $alert);
		}
		redirect('Dashboard/mitra');
	}
	public function hapus_mitra(){
		$id = $this->input->post('id');
		$where = array('id'=>$id);
		$this->db->delete('usaha',$where);
		$data = $this->getListMitra();
		echo json_encode($data);
	}
	public function load_alamat(){
		$cari = $this->input->post("searchTerm");
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://rajaongkir.komerce.id/api/v1/destination/domestic-destination?search='.$cari.'&limit=100',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'key: kt5gb1lFd6c17b89f72a9be3DpNhqaUX'
		  ),
		));

		$response = curl_exec($curl);
		curl_close($curl);

		$dec = json_decode($response,true);
		$data = array();
		for ($i=0; $i < count($dec['data']); $i++) { 
			array_push($data, array(
				"id"=>$dec['data'][$i]['id']."|".$dec['data'][$i]['label'],
				"text"=>$dec['data'][$i]['label'],
			));
		}
		echo json_encode($data);
	}
	public function mitra_produk(){
		$mitra_id = $this->uri->segment(3);
		$id = $this->input->get('id');
		$get = $this->db->query("SELECT * FROM produk where id = '".$id."'")->row();
		if($get){
			$data['id']         = $get->id;
			$data['nama']       = $get->nama;
			$data['deskripsi']  = $get->deskripsi;
			$data['harga_jual'] = $get->harga_jual;
			$data['harga_beli'] = $get->harga_beli;
			$data['foto']       = $get->foto;
			$data['stok']       = $get->stok;
			$data['berat']      = $get->berat;
			$data['hidden']     = "";
			$data['path_lama']  = $get->foto;
			$data['btn_text']   = "Update";
		} else {
			$data['id']         = "";
			$data['nama']       = "";
			$data['deskripsi']  = "";
			$data['harga_jual'] = "";
			$data['harga_beli'] = "";
			$data['foto']       = "";
			$data['stok']       = "";
			$data['berat']      = "";
			$data['hidden']     = "d-none";
			$data['path_lama']  = "";
			$data['btn_text']   = "Simpan";
		}
		$data['mitra'] = $this->db->query("SELECT * from usaha where id = '".$mitra_id."'")->row();
		$data['produk'] = $this->getListMitraProduk($mitra_id);
		$data['mitra_id'] = ($mitra_id);
		$this->template->load('template','mitra/list_produk', $data);
	}
	public function getListMitraProduk($mitra_id){
		$isi = "";
		$no = 0;
		$get = $this->db->query("SELECT p.* from produk p where p.usaha_id = '".$mitra_id."'")->result();
		foreach ($get as $val) {
			$isi .= '
			<tr>
				<td>
					<a href="'.base_url().'Dashboard/mitra_produk/'.$mitra_id.'?id='.$val->id.'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
					<a href="javascript:void(0);" class="btn btn-xs btn-danger" onclick="hapus_produk_mitra('.$val->id.')"><i class="fa fa-trash"></i></a>
				</td>
				<td><img src="'.base_url().$val->foto.'" alt="" height="100px" class="" style=""></td>
				<td>'.$val->nama.'</td>
				<td>'.$val->deskripsi.'</td>
				<td class="text-center">'.number_format($val->harga_jual,0,",",".").'</td>
				<td class="text-center">'.number_format($val->harga_beli,0,",",".").'</td>
				<td class="text-center">'.number_format($val->stok,0,",",".").'</td>
			</tr>
			';
		}
		if(count($get)==0){
			$isi .= '
			<tr>
				<td colspan="9" class="text-center">Tidak ada data</td>
			</tr>
			';
		}
		$data['isi'] = $isi;
		$data[$this->security->get_csrf_token_name()] = $this->security->get_csrf_hash();
		return $data;
	}
	public function save_mitra_produk(){
		$mitra_id = $this->uri->segment(3);

		$id     = $this->input->post('id');
		$nama = $this->input->post('nama');
		$deskripsi = $this->input->post('deskripsi');
		$harga_jual = str_replace(".", "", $this->input->post('harga_jual'));
		$harga_beli = str_replace(".", "", $this->input->post('harga_beli'));
		$foto = $this->input->post('foto');
		$stok = str_replace(".", "", $this->input->post('stok'));
		$berat = str_replace(".", "", $this->input->post('berat'));

		$path_lama = $this->input->post('path_lama');
		$path_lama = str_replace(base_url(), "", $path_lama);
		$namafile = "mitra_produk_".date("ymdHis");
		$path = 'assets/images/';

		$tgl = date("Y-m-d H:i:s");

		$img_url = $this->M_model->set_upload2($path,$namafile,'foto',$path_lama);
		if($img_url!=""){
			if($id==""){
				$value = array(
					'nama'=>$nama,
					'usaha_id'=>$mitra_id,
					'deskripsi'=>$deskripsi,
					'harga_jual'=>$harga_jual,
					'harga_beli'=>$harga_beli,
					'foto'=>$img_url,
					'stok'=>$stok,
					'berat'=>$berat,
					'created_at'=>$tgl,
					'updated_at'=>$tgl,
				);
				$this->db->insert('produk',$value);

				$last_id = $this->db->insert_id();
				
				
				$alert = $this->M_model->create_alert("Data Tersimpan","pesan","alert-success");
				$this->session->set_flashdata('pesan', $alert);
			} else {
				$where = array('id'=>$id);
				$value = array(
					'nama'=>$nama,
					'usaha_id'=>$mitra_id,
					'deskripsi'=>$deskripsi,
					'harga_jual'=>$harga_jual,
					'harga_beli'=>$harga_beli,
					'foto'=>$img_url,
					'stok'=>$stok,
					'berat'=>$berat,
					'updated_at'=>$tgl,
				);
				$this->db->update('produk',$value,$where);

				$last_id = $id;
				
				$alert = $this->M_model->create_alert("Data Terupdate","pesan","success");
				$this->session->set_flashdata('pesan', $alert);
			}
		} else {
			$alert = $this->M_model->create_alert("Gagal simpan data","pesan","danger");
			$this->session->set_flashdata('pesan', $alert);
		}
		redirect('Dashboard/mitra_produk/'.$mitra_id);
	}
	public function transaksi(){
		$data['mitra'] = $this->getListMitra();
		$this->template->load('template','transaksi/list_transaksi', $data);
	}
}
?>