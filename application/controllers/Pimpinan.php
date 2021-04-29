<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pimpinan extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->helper('form','url');
		$this->load->model('M_pimpinan');
	}
	public function index(){
		$c_pimpinan= $this->session->userdata('c_pimpinan');
		if($c_pimpinan!=NULL){
			$this->load->view('pimpinan/dashboard');
		}
		else{
			$this->load->view('pimpinan/login');
		}
	}
//pdf
	public function pdf(){
		$this->load->helper('dompdf');
        //load content html
        $html = $this->load->view('pimpinan/page/allpengajuan');
        // create pdf using dompdf
        $filename = 'Message';
        $paper = 'A4';
        $orientation = 'potrait';
        pdf_create($html, $filename, $paper, $orientation);
	}
//login logout
	public function login(){
		$ceklo= $this->M_pimpinan->login();
		if($ceklo!= NULL){
			$this->session->set_userdata('c_pimpinan',$ceklo->c_pimpinan);
			$this->session->set_flashdata('login','success');
			redirect('pimpinan');
		}
		else{
			$this->session->set_flashdata('pesan','gagal');
			redirect('pimpinan');
		}
	}
	public function getpimpinan(){
		if($this->session->userdata('c_pimpinan')=='') {redirect('pimpinan'); }
		$this->M_pimpinan->getpimpinan();
	}
	public function logout(){
		if($this->session->userdata('c_pimpinan')=='') {redirect('pimpinan'); }
		$this->session->unset_userdata('c_pimpinan');
		redirect('pimpinan');
	}
//profile
	public function profile(){
		if($this->session->userdata('c_pimpinan')=='') {redirect('pimpinan'); }
		$this->load->view('pimpinan/page/profile');
	}
	public function updateprofile(){
		if($this->session->userdata('c_pimpinan')=='') {redirect('pimpinan'); }
		$this->M_pimpinan->updateprofile();
		$this->session->set_flashdata('on','updateprofile');
		echo json_encode(array("status" => TRUE));
	}
	public function gantipassword(){
		if($this->session->userdata('c_pimpinan')=='') {redirect('pimpinan'); }
		$c_pimpinan= $this->input->post('c_pimpinan');
		$passlama= md5($this->input->post('passwordlama'));
		$passbaru= md5($this->input->post('passwordbaru'));
		$cekpasslama= $this->M_pimpinan->passwordlama($c_pimpinan,$passlama);
		if($cekpasslama==0){
			$this->session->set_flashdata('on','passwordlama');
			echo json_encode(array("status" => TRUE));
		}
		else{
			$cekpassbaru= $this->M_pimpinan->passwordbaru($c_pimpinan,$passbaru);
			if($cekpassbaru>0){
				$this->session->set_flashdata('on','passwordbaru');
				echo json_encode(array("status" => TRUE));
			}
			else{
				$this->M_pimpinan->gantipassword($c_pimpinan,$passbaru);
				$this->session->set_flashdata('on','sukses');
				echo json_encode(array("status" => TRUE));
			}
		}
	}
//pengajuan
	public function allpengajuan(){
		if($this->session->userdata('c_pimpinan')=='') {redirect('pimpinan'); }
		$this->load->view('pimpinan/page/allpengajuan');
	}
	public function perbulan(){
		if($this->session->userdata('c_pimpinan')=='') {redirect('pimpinan'); }
		$this->load->view('pimpinan/page/perbulan');
	}
	public function pertanggal(){
		if($this->session->userdata('c_pimpinan')=='') {redirect('pimpinan'); }
		$this->load->view('pimpinan/page/pertanggal');
	}
	public function perstatus(){
		if($this->session->userdata('c_pimpinan')=='') {redirect('pimpinan'); }
		$this->load->view('pimpinan/page/perstatus');
	}
//opsi
	public function keperbulan(){
		if($this->session->userdata('c_pimpinan')=='') {redirect('pimpinan'); }
		$bulan= $this->input->post('bulan');
		$tahun= $this->input->post('tahun');
		redirect('pimpinan/perbulan/'.$bulan.'/'.$tahun);
	}
	public function kepertanggal(){
		if($this->session->userdata('c_pimpinan')=='') {redirect('pimpinan'); }
		$mulai= $this->input->post('mulai'); $hmulai= date('Y-m-d',strtotime($mulai));
		$sampai= $this->input->post('sampai'); $hsampai= date('Y-m-d',strtotime($sampai));
		redirect('pimpinan/pertanggal/'.$hmulai.'/'.$hsampai);
	}
//calender
	public function calender(){
		if($this->session->userdata('c_pimpinan')=='') {redirect('pimpinan'); }
		$this->load->view('pimpinan/page/calender');
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
			$allpeng= $this->M_pimpinan->allpengajuan();
			$content.= '<title>Export Seluruh Pengajuan</title><h2 class="text-center">Seluruh Pengajuan</h2>';
			$filename = 'Seluruh Pengajuan';
		}
		else if($per=='perbulan'){
			$bulan= $this->uri->segment(4); $tahun= $this->uri->segment(5); 
			$allpeng= $this->M_pimpinan->perbulan($bulan,$tahun);
			$content.= '<title>Export Per- Bulan</title><h2 class="text-center">Pengajuan Per- Bulan '.bulan($bulan).' '.$tahun.'</h2>';
			$filename = 'Per- Bulan '.$bulan.'/'.$tahun;
		}
		else if($per=='perstatus'){
			$status= $this->uri->segment(4); 
			if($this->uri->segment(4)==''){$statusnya= 'No Respon';}else{ $statusnya=$status;} 
			$allpeng= $this->M_pimpinan->perstatus($status);
			$content.= '<title>Export Per- Status</title><h2 class="text-center">Pengajuan Per- Status <span style="text-transform:uppercase;">'.$statusnya.'</span></h2>';
			$filename = 'Per- Status '.$statusnya;
		}
		else if($per=='pertanggal'){
			$mulai= $this->uri->segment(4); $sampai= $this->uri->segment(5);
			$allpeng= $this->M_pimpinan->pertanggal($mulai,$sampai);
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