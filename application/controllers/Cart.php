<?php 
class Cart extends CI_Controller
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
		$user_id = $this->session->userdata('id');
		$data['alamat'] = $this->db->query("SELECT * from alamat where user_id = '".$user_id."' order by status desc, id desc")->result();
		$data['cart'] = $this->db->query("SELECT k.*, p.nama as nama_produk, p.foto, p.harga_jual, p.stok, u.nama as nama_usaha
			from keranjang k 
			inner join produk p on p.id = k.produk_id
			inner join usaha u on u.id = k.usaha_id
			where k.user_id = '".$user_id."' and k.status = 0
			order by k.usaha_id desc, k.produk_id desc")->result();
		$this->template->load('template_home','main_page/list_cart',$data);
	}
	public function update_qty(){

		$res = 20;
		$ket = "OK";
		$user_id = $this->session->userdata('id');

		$id = $this->input->post('id');
		$qty = $this->input->post('qty');

		$cek = $this->db->query("SELECT stok from produk where id = '".$id."'")->row();
		if($cek){
			$stok = $cek->stok;
		}
		if($qty>$stok){
			$res = 50;
			$ket = "Stok produk tersisa ".$stok;
			$seharusnya = $stok;
		} else {
			$this->db->query("UPDATE keranjang set jumlah = '".$qty."' where user_id = '".$user_id."' and produk_id = '".$id."'");
		}
		$data['res'] = $res;
		$data['ket'] = $ket;
		echo json_encode($data);
	}
	public function add(){
		$user_id = $this->session->userdata('id');
		$produk_id = $this->input->post("produk_id");
		$is_login = true;
		if($this->session->userdata('id')==""||!$this->session->userdata('is_login')){
			$is_login = false;
		} else {
			$get = $this->db->query("SELECT usaha_id from produk where id = '".$produk_id."'")->row();
			if($get){
				$usaha_id = $get->usaha_id;
			} else {
				$usaha_id = 0;
			}
			$cek_produk = $this->db->query("SELECT count(c.id) as jml, c.jumlah, p.* from keranjang c left join produk p on p.id = c.produk_id where c.user_id = '".$user_id."' and c.status = 0 and c.produk_id = '".$produk_id."'")->row();
			$data['pesan'] = "Barang berhasil dimasukkan ke keranjang";

			if($cek_produk->jml>0){
				if($cek_produk->stok>$cek_produk->jumlah){
					$where = array(
						'user_id'=>$user_id,
						'produk_id'=>$produk_id,
					);
					$values = array(
						'jumlah'=>$cek_produk->jumlah+1,
					);
					$this->db->update('keranjang',$values,$where);
				}
			} else {
				$qty = 1;
				$produk = $this->db->query("SELECT stok from produk where id = '".$produk_id."'")->row();
				// if($produk->stok>$produk->minimal_beli){
				// 	$qty = $produk->minimal_beli;
				// }
				$values = array(
					'user_id'=>$user_id,
					'produk_id'=>$produk_id,
					'usaha_id'=>$usaha_id,
					'jumlah'=>$qty,
					'status'=>0,
				);
				$this->db->insert('keranjang',$values);
			}
		}

		$data['is_login'] = $is_login;
		echo json_encode($data);
	}
	public function update_catatan(){
		$user_id = $this->session->userdata('id');
		$res = 20;
		$ket = "OK";
		$id = $this->input->post('id');
		$catatan = $this->input->post('catatan');

		$this->db->query("UPDATE keranjang set catatan = '".$catatan."' where user_id = '".$user_id."' and id = '".$id."'");


		$data['res'] = $res;
		$data['ket'] = $ket;
		echo json_encode($data);
	}
	public function cek_cart(){
		$user_id = $this->session->userdata('id');
		$cek = $this->input->post('cek');
		$qty = $this->input->post('qty');
		$produk_id = "";
		$case = "";
		$harga = 0;
		for($x=0;$x<count((array)$cek);$x++){
			if($produk_id==""){ $produk_id = $cek[$x]; }
			else { 	$produk_id .= ", ".$cek[$x]; }
			$case .= " case when ";
		}
		if($produk_id == ""){ $produk_id = "0";}
		$get = $this->db->query("SELECT c.*, p.nama, p.harga_jual, (p.harga_jual*c.jumlah) as subtotal 
			FROM keranjang c 
			inner join produk p on p.id = c.produk_id 
			where c.user_id = '".$user_id."' and c.status = 0 and c.produk_id in (".$produk_id.")")->result();
		foreach ($get as $val) {
			$harga += $val->subtotal;
		}

		$data = array(
			'harga'=>number_format($harga,0,",","."),
			'total_produk'=>count((array)$cek),
		);
		echo json_encode($data);
	}
	public function confirm_cart(){
		$user_id = $this->session->userdata('id');
		$and_where = "";
	    $alamat_id = $this->input->post('alamat_id');
	    if($alamat_id!=""){
	    	$and_where = " and id = '".$alamat_id."'";
	    	$get_alamat = $this->db->query("SELECT * from alamat where user_id = '".$user_id."'  $and_where order by status desc, id desc ")->row();
	    } else {
	    	$get_alamat = $this->db->query("SELECT * from alamat where user_id = '".$user_id."' and status = 1 order by status desc, id desc ")->row();
	    }
	    $data['alamat'] = $get_alamat;
	    if($get_alamat){
	    	$produk_id = "";
		    $cek = $this->input->post('cek');
			for ($x=0; $x < count($cek); $x++) { 
				if($produk_id==""){
					$produk_id = $cek[$x];
				} else {
					$produk_id .= ",".$cek[$x];
				}
			}
			if($produk_id==""){ $produk_id = "0"; }
			$and_where = " and c.produk_id in (".$produk_id.")";

			$data['keranjang'] = $this->db->query("SELECT c.*, p.usaha_id, p.nama as nama_produk, p.id as produk_id, p.foto as foto_produk, p.harga_jual, p.berat, t.nama as nama_toko, t.address_name, (select count(id) from keranjang where user_id = '".$user_id."' and status = 0 and c.usaha_id = usaha_id ".str_replace("c.", "", $and_where).") as jml_toko 
				from keranjang c 
				left join produk p on p.id = c.produk_id 
				left join usaha t on t.id = p.usaha_id  
				where c.user_id = '".$user_id."' and c.status = 0 $and_where order by c.usaha_id desc ")->result();
		    $data['keranjang2'] = $this->db->query("SELECT c.*, t.nama as nama_toko, t.address_id
		    	from produk c 
		    	left join usaha t on t.id = c.usaha_id 
		    	where c.id = c.id ".str_replace('c.produk_id', 'c.id', $and_where))->result();
		    // $this->template->load('template_android','android/toko/confirm_cart', $data);
		    $this->template->load('template_home','main_page/confirm_cart',$data);
	    } else {
	    	$pesan = "Harap isi alamat terlebih dahulu";
			$alert = $this->M_model->create_alert($pesan,"info_alert","danger");
			$this->session->set_flashdata('pesan', $alert);
	    	redirect(base_url());
	    }
	}
	public function get_ongkir(){
		$user_id = $this->session->userdata('id');
		$id = $this->input->post('id');
		$alamat_id = $this->input->post('alamat_id');
		$usaha_id = $this->input->post('usaha_id');
		$berat = $this->input->post('berat');
		$isi = '';

		$alamat = $this->db->query("SELECT * FROM alamat where id = '".$alamat_id."'")->row();

		$get = $this->db->query("SELECT * from usaha
			where id = '".$usaha_id."'")->row();

		$respon = $this->calculate($get->address_id, $alamat->address_id, ceil($berat/1000));
		$decoded = json_decode($respon,true);
		for ($i=0; $i < count((array)$decoded['data']['calculate_reguler']); $i++) { 
			$isi .= '
			<li class="item">
                <div class="custom-control custom-radio">
		          <input class="custom-control-input" type="radio" id="ongkir_'.$decoded['data']['calculate_reguler'][$i]['shipping_name'].'" name="'.$get->id.'" value="'.$decoded['data']['calculate_reguler'][$i]['shipping_name'].'" >
		          <label for="ongkir_'.$decoded['data']['calculate_reguler'][$i]['shipping_name'].'" class="custom-control-label">
			          '.$decoded['data']['calculate_reguler'][$i]['shipping_name'].'
					    <span class="text-muted block">'.$decoded['data']['calculate_reguler'][$i]['service_name'].'</span>
		          </label>
		        </div>

                <span class="float-right text-orange font-bold" id="txt_ongkir_'.$decoded['data']['calculate_reguler'][$i]['shipping_name'].'" style="font-weight:bold;">Rp. '. number_format($decoded['data']['calculate_reguler'][$i]['shipping_cost'],0,",",".").'</span>
	        </li>';
		}
		$isi = '
		<ul class="products-list product-list-in-card pl-2 pr-2">
		'.$isi.'
		</ul>';
		$data['isi'] = $isi;
		echo json_encode($data);
	}
	public function calculate($destination_id, $receiver_id, $weight){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://api-sandbox.collaborator.komerce.id/tariff/api/v1/calculate?shipper_destination_id='.$destination_id.'&receiver_destination_id='.$receiver_id.'&weight='.$weight.'&item_value=10000&cod=no',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'x-api-key: aMkHrk9Wd6c17b89f72a9be3jAe62drC'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		return $response;

	}
}
 ?>