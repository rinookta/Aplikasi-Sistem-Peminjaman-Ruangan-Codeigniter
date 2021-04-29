<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->helper('form','url');
		$this->load->model('M_admin');
	}
	public function index(){
		$c_admin= $this->session->userdata('c_admin');
		if($c_admin!=NULL){
			$this->load->view('admin/dashboard');
		}
		else{
			$this->load->view('admin/login');
		}
	}
//login logout
	public function login(){
		$ceklo= $this->M_admin->login();
		if($ceklo!= NULL){
			$this->session->set_userdata('c_admin',$ceklo->c_admin);
			$this->session->set_flashdata('login','success');
			redirect('admin');
		}
		else{
			$this->session->set_flashdata('pesan','gagal');
			redirect('admin');
		}
	}
	public function getadmin(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$this->M_admin->getadmin();
	}
	public function logout(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$this->session->unset_userdata('c_admin');
		redirect('admin');
	}
//profile
	public function profile(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$this->load->view('admin/page/profile');
	}
	public function updateprofile(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$this->M_admin->updateprofile();
		$this->session->set_flashdata('on','updateprofile');
		echo json_encode(array("status" => TRUE));
	}
	public function gantipassword(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$c_admin= $this->input->post('c_admin');
		$passlama= md5($this->input->post('passwordlama'));
		$passbaru= md5($this->input->post('passwordbaru'));
		$cekpasslama= $this->M_admin->passwordlama($c_admin,$passlama);
		if($cekpasslama==0){
			$this->session->set_flashdata('on','passwordlama');
			echo json_encode(array("status" => TRUE));
		}
		else{
			$cekpassbaru= $this->M_admin->passwordbaru($c_admin,$passbaru);
			if($cekpassbaru>0){
				$this->session->set_flashdata('on','passwordbaru');
				echo json_encode(array("status" => TRUE));
			}
			else{
				$this->M_admin->gantipassword($c_admin,$passbaru);
				$this->session->set_flashdata('on','sukses');
				echo json_encode(array("status" => TRUE));
			}
		}
	}
//users
	public function users(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$this->load->view('admin/page/users');
	}
	public function getusers($c){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$data= $this->M_admin->getusers($c);
		echo json_encode($data);
	}
	public function nonaktifusers(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$c_users= $this->input->post('c_users');
		$this->M_admin->nonaktifusers($c_users);
		$this->session->set_flashdata('on','nonaktif');
		echo json_encode(array("status" => TRUE));
	}
	public function aktifusers(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$c_users= $this->input->post('c_users');
		$this->M_admin->aktifusers($c_users);
		$this->session->set_flashdata('on','aktif');
		echo json_encode(array("status" => TRUE));
	}
//ruangan
	public function ruangan(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$this->load->view('admin/page/ruangan');
	}
	public function addruangan(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$config =  array(
      		'upload_path'     => "./media/ruangan/",
      		'allowed_types'   => "gif|jpg|png|jpeg",
      		'encrypt_name'    => False
	  	);
	  	$this->upload->initialize($config);
	  	$this->load->library('upload',$config);
		if ( ! $this->upload->do_upload('gambar')){
			$this->session->set_flashdata('on','gagal');
			redirect('admin/ruangan'); 
	 	}
	 	else{
			$upload_data=$this->upload->data();
	    	$nama_file="media/ruangan/".$upload_data['file_name'];
	    	$ukuran_file=$upload_data['file_size'];
	    	$config['source_image'] = $upload_data['full_path'];
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
	    	$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()){
				$this->session->set_flashdata('on','gagal');
	      		redirect('admin/ruangan');
	   		}
	   		$c_ruangan= $this->M_admin->random(9);
			$this->M_admin->addruangan($c_ruangan,$nama_file);
			$this->session->set_flashdata('on','add');
			redirect('admin/ruangan');
		}
	}
	public function getruangan($c){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$data= $this->M_admin->getruangan($c);
		echo json_encode($data);
	}
	public function editruangan(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		if(!empty($this->input->post('tg'))){
			$this->M_admin->editruangan1();
			$this->session->set_flashdata('on','edit');
			redirect('admin/ruangan');
		}
		else{
			$config =  array(
      		'upload_path'     => "./media/ruangan/",
      		'allowed_types'   => "gif|jpg|png|jpeg",
      		'encrypt_name'    => False
		  	);
		  	$this->upload->initialize($config);
		  	$this->load->library('upload',$config);
			if ( ! $this->upload->do_upload('gambar')){
				$this->session->set_flashdata('on','gagal');
				redirect('admin/ruangan'); 
		 	}
		 	else{
				$upload_data=$this->upload->data();
		    	$nama_file="media/ruangan/".$upload_data['file_name'];
		    	$ukuran_file=$upload_data['file_size'];
		    	$config['source_image'] = $upload_data['full_path'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
		    	$this->image_lib->initialize($config);
				if (!$this->image_lib->resize()){
					$this->session->set_flashdata('on','gagal');
		      		redirect('admin/ruangan');
		   		}
		   		$c_ruangan= $this->input->post('c_ruangan');
		   		//hapus gambar
		   		$ambil= $this->M_admin->getruangan($c_ruangan);
		   		if($ambil->gambar != NULL){
	   				unlink("$ambil->gambar");
	   			}
		   		$this->M_admin->editruangan2($c_ruangan,$nama_file);
		   		$this->session->set_flashdata('on','edit');
				redirect('admin/ruangan');
			}
		}
	}
	public function delruangan(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$c_ruangan= $this->input->post('c_ruangan');
		$ambil= $this->M_admin->getruangan($c_ruangan);
		if($ambil->gambar != NULL){
	   		unlink("$ambil->gambar");
	   	}
	   	$this->M_admin->delruangan($c_ruangan);
	   	$this->session->set_flashdata('on','delete');
		redirect('admin/ruangan');
	}
//pengajuan
	public function pengajuan(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$this->load->view('admin/page/pengajuan');
	}
	public function getpengajuan($c){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$data= $this->M_admin->getpengajuan($c);
		echo json_encode($data);
	}
	public function pendingpengajuan(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$c_pengajuan= $this->input->post('c_pengajuan');
		$c_users= $this->input->post('c_users');
		$catatan= $this->input->post('catatan');
		$this->M_admin->pendingpengajuan($c_pengajuan);
		$this->M_admin->notifadminpending($c_pengajuan,$c_users,$catatan);
		$this->session->set_flashdata('on','pending');
		echo json_encode(array("status" => TRUE));
	}
	public function approvepengajuan(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$c_pengajuan= $this->input->post('c_pengajuan');
		$c_users= $this->input->post('c_users');
		$catatan= $this->input->post('catatan');
		$this->M_admin->approvepengajuan($c_pengajuan);
		$this->M_admin->notifadminapprove($c_pengajuan,$c_users,$catatan);
		$this->session->set_flashdata('on','approve');
		echo json_encode(array("status" => TRUE));
	}
	public function rejectpengajuan(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$c_pengajuan= $this->input->post('c_pengajuan');
		$c_users= $this->input->post('c_users');
		$catatan= $this->input->post('catatan');
		$this->M_admin->rejectpengajuan($c_pengajuan);
		$this->M_admin->notifadminreject($c_pengajuan,$c_users,$catatan);
		$this->session->set_flashdata('on','reject');
		echo json_encode(array("status" => TRUE));
	}
	public function delpengajuan(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$c_pengajuan= $this->input->post('c_pengajuan');
		$c_users= $this->input->post('c_users');
		$catatan= $this->input->post('catatan');
		$ambil= $this->M_admin->getpengajuan($c_pengajuan);
		if($ambil->berkas != NULL){
	   		unlink("$ambil->berkas");
	   	}
		$this->M_admin->delpengajuan($c_pengajuan);
		$this->M_admin->notifadmindel($c_pengajuan,$c_users,$catatan);
		$this->session->set_flashdata('on','del');
		echo json_encode(array("status" => TRUE));
	}
	public function allpengajuan(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$this->load->view('admin/page/allpengajuan');
	}
	public function perbulan(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$this->load->view('admin/page/perbulan');
	}
	public function pertanggal(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$this->load->view('admin/page/pertanggal');
	}
	public function perstatus(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$this->load->view('admin/page/perstatus');
	}
//opsi
	public function keperbulan(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$bulan= $this->input->post('bulan');
		$tahun= $this->input->post('tahun');
		redirect('admin/perbulan/'.$bulan.'/'.$tahun);
	}
	public function kepertanggal(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$mulai= $this->input->post('mulai'); $hmulai= date('Y-m-d',strtotime($mulai));
		$sampai= $this->input->post('sampai'); $hsampai= date('Y-m-d',strtotime($sampai));
		redirect('admin/pertanggal/'.$hmulai.'/'.$hsampai);
	}
//calender
	public function calender(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$this->load->view('admin/page/calender');
	}
//notifikasi
	public function notifikasi(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$this->load->view('admin/page/notifikasi');
	}
	public function jumlahnotif(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$jumlahnotif= $this->M_admin->jumlahnotif();
		echo $jumlahnotif;
	}
	public function notifatas(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$notifatas= $this->M_admin->notifatas(); foreach($notifatas as $hnotifatas){
			if($hnotifatas->notif=='register'){
				echo 
				'<li>
	              <a href="#">
	                <i class="fa fa-users text-aqua"></i> '.$hnotifatas->username.' Melakukan Registrasi
	              </a>
	            </li>';
			}
			else if($hnotifatas->notif=='pengajuan'){
				echo 
				'<li>
	              <a href="#">
	                <i class="fa fa-external-link text-red"></i> '.$hnotifatas->username.' Membuat Pengajuan
	              </a>
	            </li>';
			}
			else if($hnotifatas->notif=='edit'){
				echo 
				'<li>
	              <a href="#">
	                <i class="fa fa-external-link text-red"></i> '.$hnotifatas->username.' Melakukan Edit Pengajuan
	              </a>
	            </li>';
			}
			else if($hnotifatas->notif=='batal'){
				echo 
				'<li>
	              <a href="#">
	                <i class="fa fa-external-link text-red"></i> '.$hnotifatas->username.' Membatalkan Pengajuan
	              </a>
	            </li>';
			}
		}
	}
	public function notif(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$notif= $this->M_admin->notif(); $vr=1; foreach($notif as $hnotif){ $peng= $this->M_admin->getpengajuan2($hnotif->c_pengajuan); foreach($peng as $hpeng);
			echo
			'<tr>
    			<td>'.$vr.'</td>
    			<td class="mailbox-name"><b>'.$hnotif->nama.'</b></td>';
    			if($hnotif->notif=='register'){
    				echo '<td class="mailbox-subject"><b>Register -</b> Melakukan Registrasi Users</td>';
    			}
    			else if($hnotif->notif=='pengajuan'){
    				echo '<td class="mailbox-subject"><b>Pengajuan -</b> Membuat Pengajuan Untuk '.$hpeng->ruangan.'</td>';
    			}
    			else if($hnotif->notif=='edit'){
    				echo '<td class="mailbox-subject"><b>Edit -</b> Melakukan Edit Pengajuan Untuk '.$hpeng->ruangan.'</td>';
    			}
    			else if($hnotif->notif=='batal'){
    				echo '<td class="mailbox-subject"><b>Batal -</b> Membatalkan Pengajuan Untuk '.$hpeng->ruangan.'</td>';
    			}
    			echo '<td class="mailbox-date">'.$this->M_admin->waktulalu($hnotif->at).'</td>';
    			if($hnotif->status=='on'){
    			echo
    			'<td>
					<a href="'.base_url().'admin/offnotifikasi/'.$hnotif->c_notifadmin.'" class="btn bg-red btn-xs">OFF</a>
				</td>';
				}else{
					echo '<td>-</td>';
				}
    		echo 
    		'</tr>';
		$vr++; }
	}
	public function offnotifikasi(){
		if($this->session->userdata('c_admin')=='') {redirect('admin'); }
		$c_notifadmin= $this->uri->segment(3);
		$this->M_admin->offnotifikasi($c_notifadmin);
		redirect('admin/notifikasi');
	}
//export
	public function export(){
		$this->load->view('php/function');
		$per= $this->uri->segment(3);
		$this->load->helper('dompdf');
		$content= '
			<style type="text/css">
			html {
			  font-size: 10px;

			  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
			}
			body {
			  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
			  font-size: 14px;
			  line-height: 1.42857143;
			  color: #333;
			  background-color: #fff;
			}
			table {
			  border-spacing: 0;
			  border-collapse: collapse;
			}
			td,
			th {
			  padding: 0;
			}
			.table {
			  border-collapse: collapse !important;
			}
			.table td,
			.table th {
			  background-color: #fff !important;
			}
			.table-bordered th,
			.table-bordered td {
			  border: 1px solid #bbb !important;
			}
			.table {
			  width: 100%;
			  max-width: 100%;
			  margin-bottom: 20px;
			}
			.table > thead > tr > th,
			.table > tbody > tr > th,
			.table > tfoot > tr > th,
			.table > thead > tr > td,
			.table > tbody > tr > td,
			.table > tfoot > tr > td {
			  padding: 8px;
			  line-height: 1.42857143;
			  vertical-align: top;
			  border-top: 1px solid #bbb;
			}
			.table > thead > tr > th {
			  vertical-align: bottom;
			  border-bottom: 2px solid #bbb;
			}
			.table > caption + thead > tr:first-child > th,
			.table > colgroup + thead > tr:first-child > th,
			.table > thead:first-child > tr:first-child > th,
			.table > caption + thead > tr:first-child > td,
			.table > colgroup + thead > tr:first-child > td,
			.table > thead:first-child > tr:first-child > td {
			  border-top: 0;
			}
			.table > tbody + tbody {
			  border-top: 2px solid #bbb;
			}
			.table .table {
			  background-color: #fff;
			}
			.table-condensed > thead > tr > th,
			.table-condensed > tbody > tr > th,
			.table-condensed > tfoot > tr > th,
			.table-condensed > thead > tr > td,
			.table-condensed > tbody > tr > td,
			.table-condensed > tfoot > tr > td {
			  padding: 5px;
			}
			.table-bordered {
			  border: 1px solid #bbb;
			}
			.table-bordered > thead > tr > th,
			.table-bordered > tbody > tr > th,
			.table-bordered > tfoot > tr > th,
			.table-bordered > thead > tr > td,
			.table-bordered > tbody > tr > td,
			.table-bordered > tfoot > tr > td {
			  border: 1px solid #bbb;
			}
			.table-bordered > thead > tr > th,
			.table-bordered > thead > tr > td {
			  border-bottom-width: 2px;
			}
			.table-striped > tbody > tr:nth-of-type(odd) {
			  background-color: #f9f9f9;
			}
			.table-hover > tbody > tr:hover {
			  background-color: #f5f5f5;
			}
			.text-left {
			  text-align: left;
			}
			.text-right {
			  text-align: right;
			}
			.text-center {
			  text-align: center;
			}
			.text-justify {
			  text-align: justify;
			}
			.text-nowrap {
			  white-space: nowrap;
			}
			.text-lowercase {
			  text-transform: lowercase;
			}
			.text-uppercase {
			  text-transform: uppercase;
			}
			.text-capitalize {
			  text-transform: capitalize;
			}
			.pull-right {
			  float: right !important;
			}
			.pull-left {
			  float: left !important;
			}
			</style>
			';
		if($per=='allpengajuan'){
			$allpeng= $this->M_admin->allpengajuan();
			$content.= '<title>Export Seluruh Pengajuan</title><h2 class="text-center">Seluruh Pengajuan</h2>';
			$filename = 'Seluruh Pengajuan';
		}
		else if($per=='perbulan'){
			$bulan= $this->uri->segment(4); $tahun= $this->uri->segment(5); 
			$allpeng= $this->M_admin->perbulan($bulan,$tahun);
			$content.= '<title>Export Per- Bulan</title><h2 class="text-center">Pengajuan Per- Bulan '.bulan($bulan).' '.$tahun.'</h2>';
			$filename = 'Per- Bulan '.$bulan.'/'.$tahun;
		}
		else if($per=='perstatus'){
			$status= $this->uri->segment(4); 
			if($this->uri->segment(4)==''){$statusnya= 'No Respon';}else{ $statusnya=$status;} 
			$allpeng= $this->M_admin->perstatus($status);
			$content.= '<title>Export Per- Status</title><h2 class="text-center">Pengajuan Per- Status <span style="text-transform:uppercase;">'.$statusnya.'</span></h2>';
			$filename = 'Per- Status '.$statusnya;
		}
		else if($per=='pertanggal'){
			$mulai= $this->uri->segment(4); $sampai= $this->uri->segment(5);
			$allpeng= $this->M_admin->pertanggal($mulai,$sampai);
			$content.= '<title>Export Per- Tanggal</title><h2 class="text-center">Pengajuan Per- Tanggal '.tgl($mulai).' Sampai '.tgl($sampai).'</h2>';
			$filename = 'Per- Tanggal '.$mulai.'sampai'.$sampai;
		}

	        //load content html
	        $content.= '
  			<table class="table table-bordered">
			    <tr class="text-center">
			        <th width="5%">NO</th>
	                <th>MULAI</th>
	                <th>SELESAI</th>
	                <th>RUANGAN</th>
	                <th>KEPERLUAN</th>
	                <th>PEMINJAM</th>
	                <th>STATUS</th>
			    </tr>';
			    $vr=1; foreach($allpeng as $hallpeng){
			    	if($hallpeng->status==''){ $s= 'no respon';}else {$s= $hallpeng->status;}
			    	$content.= '
			    	<tr>
					<td class="text-center">'.$vr.'</td>';
                	$content.='
                	<td>'.date('d-m-Y H:i',strtotime($hallpeng->mulai)).'</td>
                	<td>'.date('d-m-Y H:i',strtotime($hallpeng->selesai)).'</td>
                	<td>'.$hallpeng->ruangan.'</td>
                	<td>'.$hallpeng->keperluan.'</td>
                	<td>'.$hallpeng->peminjam.'</td>
                	<td style="text-transform: uppercase;">'.$s.'</td>
                	</tr>
			    	';
			    $vr++; }
			$content.= '
			</table>';
	        
	        // create pdf using dompdf
	        $paper = 'A4';
	        $orientation = 'Landscape';
	        pdf_create($content, $filename, $paper, $orientation);
	}
}
?>