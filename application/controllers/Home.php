<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->helper('form','url');
		$this->load->model('M_home');
	}
	public function index(){
		$this->load->view('home/page/ruangan');
	}
//calender
	public function calender(){
		$this->load->view('home/page/calender');
	}
//ruangan
	public function getruangan($c){
		$data= $this->M_home->getruangan($c);
		echo json_encode($data);
	}
}
?>