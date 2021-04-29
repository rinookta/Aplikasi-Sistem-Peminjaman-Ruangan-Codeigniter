<?php
class M_admin extends CI_Model{
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
		$query= $this->db->query("SELECT * FROM admin where username='$user' AND password='$pass'");
		return $query->row();
	}
	function getadmin($c_admin){
		$query= $this->db->query("SELECT * FROM admin where c_admin='$c_admin' ");
		return $query->result();
	}
//profile
	function updateprofile(){
		$c_admin= $this->input->post('c_admin');
		$nama= $this->input->post('nama');
		return $this->db->query("UPDATE admin set nama='$nama' where c_admin='$c_admin' ");
	}
	function passwordlama($c_admin,$passlama){
		$query= $this->db->query("SELECT * FROM admin where c_admin='$c_admin' and password='$passlama' ");
		return $query->num_rows();
	}
	function passwordbaru($c_admin,$passbaru){
		$query= $this->db->query("SELECT * FROM admin where c_admin='$c_admin' and password='$passbaru' ");
		return $query->num_rows();
	}
	function gantipassword($c_admin,$passbaru){
		return $this->db->query("UPDATE admin set password='$passbaru' where c_admin='$c_admin' ");
	}
//users
	function jusers(){
		$query= $this->db->query("SELECT * FROM users ");
		return $query->num_rows();
	}
	function users(){
		$query= $this->db->query("SELECT * FROM users order by at desc ");
		return $query->result();
	}
	function getusers($c_users){
		$query= $this->db->query("SELECT * FROM users where c_users='$c_users' ");
		return $query->row();
	}
	function nonaktifusers($c_users){
		return $this->db->query("UPDATE users set status='nonaktif' where c_users='$c_users' ");
	}
	function aktifusers($c_users){
		return $this->db->query("UPDATE users set status='aktif' where c_users='$c_users' ");
	}
//ruangan
	function jruangan(){
		$query= $this->db->query("SELECT * FROM ruangan ");
		return $query->num_rows();
	}
	function ruangan(){
		$query= $this->db->query("SELECT * FROM ruangan order by ruangan asc ");
		return $query->result();
	}
	function addruangan($c_ruangan,$nama_file){
		$ruangan= $this->input->post('ruangan');
		$keterangan= $this->input->post('keterangan');
		return $this->db->query("INSERT INTO ruangan set c_ruangan='$c_ruangan',ruangan='$ruangan',keterangan='$keterangan',gambar='$nama_file' ");
	}
	function getruangan($c_ruangan){
		$query= $this->db->query("SELECT * FROM ruangan where c_ruangan='$c_ruangan' ");
		return $query->row();
	}
	function editruangan1(){
		$c_ruangan= $this->input->post('c_ruangan');
		$ruangan= $this->input->post('ruangan');
		$keterangan= $this->input->post('keterangan');
		return $this->db->query("UPDATE ruangan set ruangan='$ruangan',keterangan='$keterangan' where c_ruangan='$c_ruangan' ");
	}
	function editruangan2($c_ruangan,$nama_file){
		$ruangan= $this->input->post('ruangan');
		$keterangan= $this->input->post('keterangan');
		return $this->db->query("UPDATE ruangan set ruangan='$ruangan',keterangan='$keterangan',gambar='$nama_file' where c_ruangan='$c_ruangan' ");
	}
	function delruangan($c_ruangan){
		return $this->db->query("DELETE FROM ruangan where c_ruangan='$c_ruangan' ");
	}
//pengajuan
	function jpengajuan(){
		$query= $this->db->query("SELECT * FROM pengajuan ");
		return $query->num_rows();
	}
	function allpengajuan(){
		$query= $this->db->query("SELECT *,
		(SELECT nama from users where c_users=pengajuan.c_users) as peminjam,
		(SELECT ruangan from ruangan where c_ruangan=pengajuan.c_ruangan) as ruangan
		FROM pengajuan order by mulai desc ");
		return $query->result();
	}
	function cekpengajuan($c_ruangan){
		$dt= date("Y-m-d H:i:s");
		$query= $this->db->query("SELECT * FROM pengajuan where c_ruangan='$c_ruangan' and selesai>='$dt' order by at desc limit 1 ");
		return $query->result();
	}
	function getpengajuan($c_pengajuan){
		$query= $this->db->query("SELECT *,
		(SELECT ruangan from ruangan where c_ruangan=pengajuan.c_ruangan) as ruangan
		FROM pengajuan where c_pengajuan='$c_pengajuan' ");
		return $query->row();
	}
	function getpengajuan2($c_pengajuan){
		$query= $this->db->query("SELECT *,
		(SELECT ruangan from ruangan where c_ruangan=pengajuan.c_ruangan) as ruangan
		FROM pengajuan where c_pengajuan='$c_pengajuan' ");
		return $query->result();
	}
	function pendingpengajuan($c_pengajuan){
		return $this->db->query("UPDATE pengajuan set status='pending' where c_pengajuan='$c_pengajuan' ");
	}
	function approvepengajuan($c_pengajuan){
		return $this->db->query("UPDATE pengajuan set status='approve' where c_pengajuan='$c_pengajuan' ");
	}
	function rejectpengajuan($c_pengajuan){
		return $this->db->query("UPDATE pengajuan set status='reject' where c_pengajuan='$c_pengajuan' ");
	}
	function delpengajuan($c_pengajuan){
		return $this->db->query("DELETE FROM pengajuan where c_pengajuan='$c_pengajuan' ");
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
//notifikasi
	function jnotif(){
		$query= $this->db->query("SELECT * FROM notifadmin ");
		return $query->num_rows();
	}
	function jumlahnotif(){
		$query= $this->db->query("SELECT * FROM notifadmin where status='on' ");
		return $query->num_rows();
	}
	function notifatas(){
		$query= $this->db->query("SELECT *,
		(SELECT username from users where c_users=notifadmin.c_users) as username,
		(SELECT c_pengajuan from pengajuan where c_pengajuan=notifadmin.c_pengajuan) as c_pengajuan
		FROM notifadmin where status='on' order by at desc limit 5 ");
		return $query->result();
	}
	function notif(){
		$query= $this->db->query("SELECT *,
		(SELECT username from users where c_users=notifadmin.c_users) as username,
		(SELECT nama from users where c_users=notifadmin.c_users) as nama,
		(SELECT c_pengajuan from pengajuan where c_pengajuan=notifadmin.c_pengajuan) as c_pengajuan
		FROM notifadmin order by at desc limit 20");
		return $query->result();
	}
	function offnotifikasi($c_notifadmin){
		return $this->db->query("UPDATE notifadmin set status='off' where c_notifadmin='$c_notifadmin' ");
	}
	function notifadminpending($c_pengajuan,$c_users,$catatan){
		$at= date('Y-m-d H:i:s');
		return $this->db->query("INSERT INTO notifuser set c_users='$c_users',c_pengajuan='$c_pengajuan',notif='pending',catatan='$catatan',at='$at',status='on' ");
	}
	function notifadminapprove($c_pengajuan,$c_users,$catatan){
		$at= date('Y-m-d H:i:s');
		return $this->db->query("INSERT INTO notifuser set c_users='$c_users',c_pengajuan='$c_pengajuan',notif='approve',catatan='$catatan',at='$at',status='on' ");
	}
	function notifadminreject($c_pengajuan,$c_users,$catatan){
		$at= date('Y-m-d H:i:s');
		return $this->db->query("INSERT INTO notifuser set c_users='$c_users',c_pengajuan='$c_pengajuan',notif='reject',catatan='$catatan',at='$at',status='on' ");
	}
	function notifadmindel($c_pengajuan,$c_users,$catatan){
		$at= date('Y-m-d H:i:s');
		return $this->db->query("INSERT INTO notifuser set c_users='$c_users',c_pengajuan='$c_pengajuan',notif='delete',catatan='$catatan',at='$at',status='on' ");
	}
//function
	function waktulalu($timestamp){
	  $selisih= time() - strtotime($timestamp);
	  $detik= $selisih;
	  $menit= round($selisih/60);
	  $jam= round($selisih/3600);
	  $hari= round($selisih/86400);
	  $minggu= round($selisih/604800);
	  $bulan= round($selisih/2419200);
	  $tahun= round($selisih/29030400);
	  if($detik<=60){
	    $waktu= $detik.' detik yang lalu';
	  }
	  else if($menit<=60){
	    $waktu= $menit.' menit yang lalu';
	  }
	  else if($jam<=24){
	    $waktu= $jam.' jam yang lalu';
	  }
	  else if($hari<=7){
	    $waktu= $hari.' hari yang lalu';
	  }
	  else if($minggu<=4){
	    $waktu= $minggu.' minggu yang lalu';
	  }
	  else if($bulan<=12){
	    $waktu= $bulan.' bulan yang lalu';
	  }
	  else{
	    $waktu= $tahun.' tahun yang lalu';
	  }
	  return $waktu;
	}
}
?>