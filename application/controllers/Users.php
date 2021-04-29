<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->helper('form','url');
		$this->load->model('M_users');
		/*if($this->session->userdata('c_users')==''){
			redirect('users');
		}*/
	}
	public function index(){
		$c_users= $this->session->userdata('c_users');
		if($c_users!=NULL){
			$this->load->view('users/dashboard');
		}
		else{
			$this->load->view('users/login');
		}
	}
//login register
	public function konfirmasi(){
		$kode= $this->uri->segment(3);
		$cekkonfirmasi= $this->M_users->cekkonfirmasi($kode);
		if($cekkonfirmasi==NULL){
			$this->session->set_flashdata('pesan','kodesalah');
			redirect('users');
		}
		else{
			if($cekkonfirmasi->status=='expired'){
				$this->session->set_flashdata('pesan','kodesalah');
				redirect('users');
			}
			else{
				$this->M_users->konfirmasi($kode);
				$this->M_users->aktifusers($cekkonfirmasi->c_users);
				$this->session->set_flashdata('pesan','konfirmasisukses');
				redirect('users');
			}
		}
	}
	public function reg(){
		$this->load->view('users/register');
	}
	public function register(){
		$captcha= $this->M_users->cap();
		if($captcha==true){
			$cekdata= $this->M_users->cekdata();
			if($cekdata==true){
				$c_users= $this->M_users->random(9);
				$email= $this->input->post('email');
				$kode= $this->M_users->random(30);
				//send mail konfirmasi
				$this->load->library('email');

				$this->email->from('rinookta1427@gmail.com', 'Rino Okta');
				$this->email->to($email); 
				$this->email->subject('KONFIRMASI AKUN ANDA');
				$this->email->message(base_url('users/konfirmasi/').$kode);
				if($this->email->send()){
					$this->M_users->emailkonfirmasi($c_users,$to_email,$kode);
					$this->M_users->register($c_users);
					$this->M_users->notifusersregister($c_users);
					$this->session->set_flashdata('pesan','emailsend');
					$this->session->set_flashdata('email',$to_email);
					redirect('users');
				}
				else{
					$this->session->set_flashdata('pesan','gagalemail');
					redirect('users/reg');
				}				
			}
			else{
				$this->session->set_flashdata('pesan','ada');
				redirect('users/reg');
			}
		}
		else{
			$this->session->set_flashdata('pesan','gagaladd');
			redirect('users/reg');
		}	
	}
	public function login(){
		$ceklo= $this->M_users->login();
		if($ceklo!= NULL){
			if($ceklo->status=='aktif'){
				$this->session->set_userdata('c_users',$ceklo->c_users);
				$this->session->set_flashdata('login','success');
				redirect('users');
			}
			else if($ceklo->status=='pending'){
				$this->session->set_flashdata('pesan','pending');
				redirect('users');
			}
			else if($ceklo->status=='nonaktif'){
				$this->session->set_flashdata('pesan','nonaktif');
				redirect('users');
			}
		}
		else{
			$this->session->set_flashdata('pesan','gagal');
			redirect('users');
		}
	}
	public function logout(){
		if($this->session->userdata('c_users')=='') {redirect('users'); }
		$this->session->unset_userdata('c_users');
		redirect('users');
	}
//profile
	public function profile(){
		if($this->session->userdata('c_users')=='') {redirect('users'); }
		$this->load->view('users/page/profile');
	}
	public function updateprofile(){
		if($this->session->userdata('c_users')=='') {redirect('users'); }
		$this->M_users->updateprofile();
		$this->session->set_flashdata('on','updateprofile');
		echo json_encode(array("status" => TRUE));
	}
	public function gantipassword(){
		if($this->session->userdata('c_users')=='') {redirect('users'); }
		$c_users= $this->input->post('c_users');
		$passlama= md5($this->input->post('passwordlama'));
		$passbaru= md5($this->input->post('passwordbaru'));
		$cekpasslama= $this->M_users->passwordlama($c_users,$passlama);
		if($cekpasslama==0){
			$this->session->set_flashdata('on','passwordlama');
			echo json_encode(array("status" => TRUE));
		}
		else{
			$cekpassbaru= $this->M_users->passwordbaru($c_users,$passbaru);
			if($cekpassbaru>0){
				$this->session->set_flashdata('on','passwordbaru');
				echo json_encode(array("status" => TRUE));
			}
			else{
				$p= $this->input->post('passwordbaru');
				$this->M_users->gantipassword($c_users,$passbaru,$p);
				$this->session->set_flashdata('on','sukses');
				echo json_encode(array("status" => TRUE));
			}
		}
	}
//ruangan
	public function ruangan(){
		if($this->session->userdata('c_users')=='') {redirect('users'); }
		$this->load->view('users/page/ruangan');
	}
	public function getruangan($c){
		if($this->session->userdata('c_users')=='') {redirect('users'); }
		$data= $this->M_users->getruangan($c);
		echo json_encode($data);
	}
//pengajuan
	public function addpengajuan(){
		if($this->session->userdata('c_users')=='') {redirect('users'); }
		$config =  array(
      		'upload_path'     => "./media/berkaspengajuan/",
      		'allowed_types'   => "doc|docx|pdf",
      		'encrypt_name'    => False
	  	);
	  	$this->upload->initialize($config);
	  	$this->load->library('upload',$config);
		if ( ! $this->upload->do_upload('berkas')){
			$this->session->set_flashdata('on','gagal');
			redirect('users/ruangan');
	 	}
	 	else{
			$upload_data=$this->upload->data();
	    	$berkas="media/berkaspengajuan/".$upload_data['file_name'];
	   		$c_users= $this->input->post('c_users');
	   		$c_pengajuan= $this->M_users->random(9);
			$this->M_users->addpengajuan($c_pengajuan,$c_users,$berkas);
			$this->M_users->notifuserspengajuan($c_users,$c_pengajuan);
			$this->session->set_flashdata('on','add');
			redirect('users/ruangan');
		}
	}
	public function allpengajuan(){
		if($this->session->userdata('c_users')=='') {redirect('users'); }
		$this->load->view('users/page/allpengajuan');
	}
	public function pengajuansaya(){
		if($this->session->userdata('c_users')=='') {redirect('users'); }
		$this->load->view('users/page/pengajuansaya');
	}
	public function getpengajuan($c){
		if($this->session->userdata('c_users')=='') {redirect('users'); }
		$data= $this->M_users->getpengajuan($c);
		echo json_encode($data);
	}
	public function getpengajuan2($c){
		if($this->session->userdata('c_users')=='') {redirect('users'); }
		$data= $this->M_users->getpengajuan2($c);
		echo json_encode($data);
	}
	public function editpengajuan(){
		if($this->session->userdata('c_users')=='') {redirect('users'); }
		$c_users= $this->input->post('c_users');
		$c_pengajuan= $this->input->post('c_pengajuan');
		if(!empty($this->input->post('tg'))){
			$this->M_users->editpengajuan1($c_pengajuan,$c_users);
			$this->M_users->notifuserseditpengajuan($c_users,$c_pengajuan);
			$this->session->set_flashdata('on','edit');
			redirect('users/pengajuansaya');
		}
		else{
			$config =  array(
      		'upload_path'     => "./media/berkaspengajuan/",
      		'allowed_types'   => "doc|docx|pdf",
      		'encrypt_name'    => False
		  	);
		  	$this->upload->initialize($config);
		  	$this->load->library('upload',$config);
			if ( ! $this->upload->do_upload('berkas')){
				$this->session->set_flashdata('on','gagal');
				redirect('users/pengajuansaya');
		 	}
		 	else{
				$upload_data=$this->upload->data();
		    	$berkas="media/berkaspengajuan/".$upload_data['file_name'];
		   		$ambil= $this->M_users->getpengajuan2($c_pengajuan);
		   		if($ambil->berkas != NULL){
	   				unlink("$ambil->berkas");
	   			}
				$this->M_users->editpengajuan2($c_pengajuan,$c_users,$berkas);
				$this->M_users->notifuserseditpengajuan($c_users,$c_pengajuan);
				$this->session->set_flashdata('on','edit');
				redirect('users/pengajuansaya');
			}
		}
	}
	public function batalpengajuan(){
		if($this->session->userdata('c_users')=='') {redirect('users'); }
		$c_users= $this->input->post('c_users');
		$c_pengajuan= $this->input->post('c_pengajuan');
		$this->M_users->batalpengajuan($c_pengajuan);
		$this->M_users->notifusersbatalpengajuan($c_users,$c_pengajuan);
		$this->session->set_flashdata('on','batal');
		echo json_encode(array("status" => TRUE));
	}
//calender
	public function calender(){
		if($this->session->userdata('c_users')=='') {redirect('users'); }
		$this->load->view('users/page/calender');
	}
//notifikasi
	public function notifikasi(){
		if($this->session->userdata('c_users')=='') {redirect('users'); }
		$this->load->view('users/page/notifikasi');
	}
	public function jumlahnotif(){
		if($this->session->userdata('c_users')=='') {redirect('users'); }
		$c_users= $this->uri->segment(3);
		$jumlahnotif= $this->M_users->jumlahnotif($c_users);
		echo $jumlahnotif;
	}
	public function notifatas(){
		if($this->session->userdata('c_users')=='') {redirect('users'); }
		$c_users= $this->uri->segment(3);
		$notifatas= $this->M_users->notifatas($c_users); foreach($notifatas as $hnotifatas){
			if($hnotifatas->notif=='reject'){
				echo 
				'<li>
	              <a href="#">
	                <i class="fa fa-refresh text-red"></i> Pengajuan Anda di Reject
	              </a>
	            </li>';
			}
			else if($hnotifatas->notif=='pending'){
				echo 
				'<li>
	              <a href="#">
	                <i class="fa fa-ellipsis-h text-green"></i> Pengajuan Anda di Pending...
	              </a>
	            </li>';
			}
			else if($hnotifatas->notif=='approve'){
				echo 
				'<li>
	              <a href="#">
	                <i class="fa fa-check text-blue"></i> Pengajuan Anda di Approve
	              </a>
	            </li>';
			}
			else if($hnotifatas->notif=='delete'){
				echo 
				'<li>
	              <a href="#">
	                <i class="fa fa-trash text-red"></i> Pengajuan Anda di Hapus
	              </a>
	            </li>';
			}
		}
	}
	public function notif(){
		if($this->session->userdata('c_users')=='') {redirect('users'); }
		$c_users= $this->uri->segment(3);
		$notif= $this->M_users->notif($c_users); $vr=1; foreach($notif as $hnotif){
			echo
			'<tr>
    			<td>'.$vr.'</td>';
    			if($hnotif->notif=='reject'){
    				echo '<td class="mailbox-subject"><b>Reject -</b> Pengajuan Anda di Reject <a href="#" onclick="detailnotif('.$hnotif->c_notifuser.')">Lihat Detail</a></td>';
    			}
    			else if($hnotif->notif=='pending'){
    				echo '<td class="mailbox-subject"><b>Pending -</b> Pengajuan Anda di Pending <a href="#" onclick="detailnotif('.$hnotif->c_notifuser.')">Lihat Detail</a></td>';
    			}
    			else if($hnotif->notif=='approve'){
    				echo '<td class="mailbox-subject"><b>Approve -</b> Pengajuan Anda di Approve <a href="#" onclick="detailnotif('.$hnotif->c_notifuser.')">Lihat Detail</a></td>';
    			}
    			else if($hnotif->notif=='delete'){
    				echo '<td class="mailbox-subject"><b>Delete -</b> Pengajuan Anda di Hapus <a href="#" onclick="detailnotif('.$hnotif->c_notifuser.')">Lihat Detail</a></td>';
    			}
    			echo '<td class="mailbox-date">'.$this->M_users->waktulalu($hnotif->at).'</td>';
    			if($hnotif->status=='on'){
    			echo
    			'<td>
					<a href="'.base_url().'users/offnotifikasi/'.$hnotif->c_notifuser.'" class="btn bg-red btn-xs">OFF</a>
				</td>';
				}else{
					echo '<td>-</td>';
				}
    		echo 
    		'</tr>';
		$vr++; }
	}
	public function offnotifikasi(){
		if($this->session->userdata('c_users')=='') {redirect('users'); }
		$c_notifuser= $this->uri->segment(3);
		$this->M_users->offnotifikasi($c_notifuser);
		redirect('users/notifikasi');
	}
	public function getnotif($c){
		if($this->session->userdata('c_users')=='') {redirect('users'); }
		$data= $this->M_users->getnotif($c);
		echo json_encode($data);
	}
}
?>