<?php
class M_pimpinan extends CI_Model{
	function __construct(){
		parent:: __construct();
	}
	function random($length){
	  $data='A1aB2bC3cD4dE5eF6fG7gH8hI9iJ0jK1kL2lM3mN4nO5oP6pQ7qR8rS9sT0tu1uUv2Vw3Wx4Xy5Y6yZ7z';
	  $string='';
	  for($i=1;$i<=$length;$i++){
	    $pos=rand(0,strlen($data)-1);
	    $string.=$data{$pos};
	  }
	  return $string;
	}
//login register
	function login(){
		$user= $this->input->post('username');
		$pass= md5($this->input->post('password'));
		$query= $this->db->query("SELECT * FROM pimpinan where username='$user' AND password='$pass'");
		return $query->row();
	}
	function getpimpinan($c_pimpinan){
		$query= $this->db->query("SELECT * FROM pimpinan where c_pimpinan='$c_pimpinan' ");
		return $query->result();
	}
//profile
	function updateprofile(){
		$c_pimpinan= $this->input->post('c_pimpinan');
		$nama= $this->input->post('nama');
		return $this->db->query("UPDATE pimpinan set nama='$nama' where c_pimpinan='$c_pimpinan' ");
	}
	function passwordlama($c_pimpinan,$passlama){
		$query= $this->db->query("SELECT * FROM pimpinan where c_pimpinan='$c_pimpinan' and password='$passlama' ");
		return $query->num_rows();
	}
	function passwordbaru($c_pimpinan,$passbaru){
		$query= $this->db->query("SELECT * FROM pimpinan where c_pimpinan='$c_pimpinan' and password='$passbaru' ");
		return $query->num_rows();
	}
	function gantipassword($c_pimpinan,$passbaru){
		return $this->db->query("UPDATE pimpinan set password='$passbaru' where c_pimpinan='$c_pimpinan' ");
	}
//pengajuan
	function allpengajuan(){
		$query= $this->db->query("SELECT *,
		(SELECT nama from users where c_users=pengajuan.c_users) as peminjam,
		(SELECT ruangan from ruangan where c_ruangan=pengajuan.c_ruangan) as ruangan
		FROM pengajuan order by mulai desc ");
		return $query->result();
	}
	function perbulan($bulan,$tahun){
		$query= $this->db->query("SELECT *,
		(SELECT nama from users where c_users=pengajuan.c_users) as peminjam,
		(SELECT ruangan from ruangan where c_ruangan=pengajuan.c_ruangan) as ruangan
		FROM pengajuan where month(mulai)='$bulan' and year(mulai)='$tahun' order by mulai desc ");
		return $query->result();
	}
	function pertanggal($mulai,$sampai){
		$query= $this->db->query("SELECT *,
		(SELECT nama from users where c_users=pengajuan.c_users) as peminjam,
		(SELECT ruangan from ruangan where c_ruangan=pengajuan.c_ruangan) as ruangan
		FROM pengajuan where mulai>='$mulai' and mulai<='$sampai' order by mulai desc ");
		return $query->result();
	}
	function perstatus($status){
		$query= $this->db->query("SELECT *,
		(SELECT nama from users where c_users=pengajuan.c_users) as peminjam,
		(SELECT ruangan from ruangan where c_ruangan=pengajuan.c_ruangan) as ruangan
		FROM pengajuan where status='$status' order by mulai desc ");
		return $query->result();
	}
	function jpengajuan(){
		$query= $this->db->query("SELECT * FROM pengajuan ");
		return $query->num_rows();
	}
	function cekpengajuan($c_ruangan){
		$dt= date("Y-m-d H:i:s");
		$query= $this->db->query("SELECT * FROM pengajuan where c_ruangan='$c_ruangan' and selesai>='$dt' order by at desc limit 1 ");
		return $query->result();
	}
//users
	function jusers(){
		$query= $this->db->query("SELECT * FROM users ");
		return $query->num_rows();
	}
//ruangan
	function jruangan(){
		$query= $this->db->query("SELECT * FROM ruangan ");
		return $query->num_rows();
	}
	function ruangan(){
		$dt= date("Y-m-d H:i:s");
		$query= $this->db->query("SELECT *,
		(SELECT count(*) FROM pengajuan where c_ruangan=ruangan.c_ruangan and status='approve') as japprove,
		(SELECT count(*) FROM pengajuan where c_ruangan=ruangan.c_ruangan and status='pending') as jpending,
		(SELECT count(*) FROM pengajuan where c_ruangan=ruangan.c_ruangan and status='reject') as jreject
		FROM ruangan where status='' order by ruangan asc ");
		return $query->result();
	}
}
?>