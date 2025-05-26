<?php

class M_model extends CI_Model
{
	private $pass_key = "4b0g0b0g4y33ll0ww";
	public function CreateTable(){
		
	}
	public function getUser($id){
		$get = $this->db->query("SELECT * from users where id = '".$id."'")->row();
		if($get){
			return $get;
		} else {
			$this->session->unset_userdata('id');
			$this->session->unset_userdata('is_login');
			session_destroy();
			redirect(base_url(''));
		}
		
	}
	public function get_bulan_short($x,$type='long'){
		switch ($x) {
	        case 1  : $bln = "Januari";
	           break;
	        case 2  : $bln = "Februari";
	           break;
	        case 3  : $bln = "Maret";
	           break;
	        case 4  : $bln = "April";
	           break;
	        case 5  : $bln = "Mei";
	           break;
	        case 6  : $bln = "Juni";
	           break;
	        case 7  : $bln = "Juli";
	           break;
	        case 8  : $bln = "Agustus";
	           break;
	        case 9  : $bln = "September";
	           break;
	        case 10 : $bln = "Oktober";
	           break;
	        case 11 : $bln = "November";
	           break;
	        case 12 : $bln = "Desember";
	           break;
	    }
	    if($type=="short"){
	    	$bln = substr($bln, 0,3);
	    }
		return $bln;
	}
    public function countKeyOccurrences($array, $key, $value) {
        $count = 0;
        foreach ($array as $item) {
            if (isset($item[$key]) && $item[$key] === $value) {
                $count++;
            }
        }
        return $count;
    }
	public function generateRandomString($length) {
        $characters = '012345678998765432100987654321';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }
	function enc_aes($plaintext, $key) {
	    $cipher = "aes-256-cbc";
	    $ivlen = openssl_cipher_iv_length($cipher);
	    $iv = openssl_random_pseudo_bytes($ivlen);
	    $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv);
	    return base64_encode($iv . $ciphertext);
	}

	function dec_aes($ciphertext, $key) {
		$asli = $ciphertext;
		
	    $cipher = "aes-256-cbc";
	    $ivlen = openssl_cipher_iv_length($cipher);
	    $ciphertext = base64_decode($ciphertext);
	    $iv = substr($ciphertext, 0, $ivlen);
	    $ciphertext = substr($ciphertext, $ivlen);

	    $result = openssl_decrypt($ciphertext, $cipher, $key, $options=0, $iv);
	    if($result!=""){
	    	return $result;
	    } else {
	    	return $asli;
	    }
	    
	}
	public function get_value_array($array, $kode){
        $res = "";
        for ($i=0; $i < count($array); $i++) { 
            if($array[$i]['kode']==$kode){
                $res = $array[$i]['value'];
                return $res;
            }
        }
        return $res;
    }
	public function validateJSON($json) {
        try {
            $test = json_decode($json);
            return true;
        } catch  (Exception $e) {
            return false;
        }
    }
	public function base64($string){
        // $encode = base64_encode($string);
        $encode = ($string);
        $encode = rtrim($encode,"=");
        $encode = str_replace("+", "-", $encode);
        $encode = str_replace("/", "_", $encode);
        return $encode;
    }
    public function set_upload2($Folder, $Filename, $FileFoto, $path_lama){
		$this->load->library('upload');
		$Foto	= "";

		if($_FILES[$FileFoto]['name']){
			$Filename	= preg_replace("/[^A-Za-z0-9]/", "", $Filename);

			$config['upload_path']		= $Folder; //path folder
			$config['allowed_types']	= 'jpg|jpeg|png|gif'; //type yang dapat diakses bisa anda sesuaikan
			$config['max_size']			= '3072'; //maksimum besar file 3M
			$config['max_width']		= '5000'; //lebar maksimum 5000 px
			$config['max_height']		= '5000'; //tinggi maksimu 5000 px
			$config['file_name']		= $Filename; //nama yang terupload nantinya
			$this->upload->initialize($config);
			if(is_file($path_lama)){ 	unlink($path_lama); }
			if($this->upload->do_upload($FileFoto)){
				$Foto	= $Folder.$this->upload->file_name;
			} else {
				$ket = $this->upload->display_errors();
				$alert = $this->create_alert($ket,'pesan_gbr','danger');
				$this->session->set_flashdata('pesan',$alert);
				$Foto	= "";
			}
		} else {
			$Foto = $path_lama;
		}

		return $Foto;
	}
	public function create_alert($pesan,$pesan_id,$tipe='text-color'){
		$alert = '
		<div class="alert '.$tipe.' alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5>'.$pesan.'</h5>
                </div>';
        return $alert;
	}

}