<?php
class M_users extends CI_Model{
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
	function aktifusers($c_users){
		return $this->db->query("UPDATE users set status='aktif' where c_users='$c_users' ");
	}
	function konfirmasi($kode){
		return $this->db->query("UPDATE konfirmasi set status='expired' where kode='$kode' ");
	}
	function cekkonfirmasi($kode){
		$query= $this->db->query("SELECT * FROM konfirmasi where kode='$kode' ");
		return $query->row();
	}
	function emailkonfirmasi($c_users,$to_email,$kode){
		return $this->db->query("INSERT INTO konfirmasi set c_users='$c_users',email='$to_email',kode='$kode' ");
	}
	function login(){
		$user= $this->input->post('username');
		$pass= md5($this->input->post('password'));
		$query= $this->db->query("SELECT * FROM users where username='$user' AND password='$pass' ");
		return $query->row();
	}
	function getusers($c_users){
		$query= $this->db->query("SELECT * FROM users where c_users='$c_users' ");
		return $query->result();
	}
	function register($c_users){
		$nama= $this->input->post('nama');
		$email= $this->input->post('email');
		$notelp= $this->input->post('notelp');
		$instansi= $this->input->post('instansi');
		$user= $this->input->post('username');
		$pass= md5($this->input->post('password'));
		$p= $this->input->post('password');
		$data=array(
			"c_users"=> $c_users,
			"nama"=> $nama,
			"email"=> $email,
			"notelp"=> $notelp,
			"instansi"=> $instansi,
			"username"=> $user,
			"password"=> $pass,
			"at"=> date('Y-m-d H:i:s'),
			"status"=> "pending",
			"p"=> $p
		);
		$this->db->insert('users',$data);
	}
	function cap(){
		$aslicap= $this->input->post('aslicap');
		$cap= $this->input->post('cap');
		if($aslicap==$cap){
			return true;
		}
		else{
			return false;
		}
	}
	function cekdata(){
		$user= $this->input->post('username');
		$pass= md5($this->input->post('password'));
		$this->db->where("username='$user' OR password='$pass'");
		$cek= $this->db->get('users')->num_rows();
		if($cek>0){
			return false;
		}
		else{ 
			return true;
		}
	}
//profile
	function updateprofile(){
		$c_users= $this->input->post('c_users');
		$nama= $this->input->post('nama');
		$email= $this->input->post('email');
		$notelp= $this->input->post('notelp');
		$instansi= $this->input->post('instansi');
		return $this->db->query("UPDATE users set nama='$nama',email='$email',notelp='$notelp',instansi='$instansi' where c_users='$c_users' ");
	}
	function passwordlama($c_users,$passlama){
		$query= $this->db->query("SELECT * FROM users where c_users='$c_users' and password='$passlama' ");
		return $query->num_rows();
	}
	function passwordbaru($c_users,$passbaru){
		$query= $this->db->query("SELECT * FROM users where c_users='$c_users' and password='$passbaru' ");
		return $query->num_rows();
	}
	function gantipassword($c_users,$passbaru,$p){
		return $this->db->query("UPDATE users set password='$passbaru',p='$p' where c_users='$c_users' ");
	}
//ruangan
	function ruangan(){
		$dt= date("Y-m-d H:i:s");
		$query= $this->db->query("SELECT *,
		(SELECT count(*) FROM pengajuan where c_ruangan=ruangan.c_ruangan and status='approve') as japprove,
		(SELECT count(*) FROM pengajuan where c_ruangan=ruangan.c_ruangan and status='pending') as jpending,
		(SELECT count(*) FROM pengajuan where c_ruangan=ruangan.c_ruangan and status='reject') as jreject
		FROM ruangan where status='' order by ruangan asc ");
		return $query->result();
	}
	function getruangan($c_ruangan){
		$query= $this->db->query("SELECT * FROM ruangan where c_ruangan='$c_ruangan' ");
		return $query->row();
	}
//pengajuan
	function jpengajuan($c_users){
		$query= $this->db->query("SELECT * FROM pengajuan where c_users='$c_users' ");
		return $query->num_rows();
	}
	function addpengajuan($c_pengajuan,$c_users,$berkas){
		$dt= date("Y-m-d H:i:s");
		$c_ruangan= $this->input->post('c_ruangan');
		$mulai= $this->input->post('mulai');$hmulai= date('Y-m-d H:i:s',strtotime($mulai));
		$selesai= $this->input->post('selesai');$hselesai= date('Y-m-d H:i:s',strtotime($selesai));
		$keperluan= $this->input->post('keperluan');
		return $this->db->query("INSERT INTO pengajuan set c_pengajuan='$c_pengajuan',c_users='$c_users',c_ruangan='$c_ruangan',mulai='$hmulai',selesai='$hselesai',keperluan='$keperluan',berkas='$berkas',at='$dt' ");
	}
	function cekpengajuan($c_ruangan){
		$dt= date("Y-m-d H:i:s");
		$query= $this->db->query("SELECT * FROM pengajuan where c_ruangan='$c_ruangan' and selesai>='$dt' order by at desc limit 1 ");
		return $query->result();
	}
	function allpengajuan(){
		$query= $this->db->query("SELECT *,
		(SELECT nama from users where c_users=pengajuan.c_users) as peminjam,
		(SELECT ruangan from ruangan where c_ruangan=pengajuan.c_ruangan) as ruangan
		FROM pengajuan order by mulai desc ");
		return $query->result();
	}
	function pengajuansaya($c_users){
		$query= $this->db->query("SELECT *,
		(SELECT ruangan from ruangan where c_ruangan=pengajuan.c_ruangan) as ruangan
		FROM pengajuan where c_users='$c_users' order by mulai desc ");
		return $query->result();
	}
	function getpengajuan($c_pengajuan){
		$query= $this->db->query("SELECT *,
		(SELECT ruangan from ruangan where c_ruangan=pengajuan.c_ruangan) as ruangan,
		(SELECT keterangan from ruangan where c_ruangan=pengajuan.c_ruangan) as keterangan
		FROM pengajuan where c_pengajuan='$c_pengajuan' ");
		return $query->result();
	}
	function getpengajuan2($c_pengajuan){
		$query= $this->db->query("SELECT *,
		(SELECT ruangan from ruangan where c_ruangan=pengajuan.c_ruangan) as ruangan,
		(SELECT keterangan from ruangan where c_ruangan=pengajuan.c_ruangan) as keterangan
		FROM pengajuan where c_pengajuan='$c_pengajuan' ");
		return $query->row();
	}
	function editpengajuan1($c_pengajuan,$c_users){
		$dt= date("Y-m-d H:i:s");
		$c_ruangan= $this->input->post('c_ruangan');
		$mulai= $this->input->post('mulai');$hmulai= date('Y-m-d H:i:s',strtotime($mulai));
		$selesai= $this->input->post('selesai');$hselesai= date('Y-m-d H:i:s',strtotime($selesai));
		$keperluan= $this->input->post('keperluan');
		return $this->db->query("UPDATE pengajuan set c_users='$c_users',c_ruangan='$c_ruangan',mulai='$hmulai',selesai='$hselesai',keperluan='$keperluan',at='$dt' where c_pengajuan='$c_pengajuan' ");
	}
	function editpengajuan2($c_pengajuan,$c_users,$berkas){
		$dt= date("Y-m-d H:i:s");
		$c_ruangan= $this->input->post('c_ruangan');
		$mulai= $this->input->post('mulai');$hmulai= date('Y-m-d H:i:s',strtotime($mulai));
		$selesai= $this->input->post('selesai');$hselesai= date('Y-m-d H:i:s',strtotime($selesai));
		$keperluan= $this->input->post('keperluan');
		return $this->db->query("UPDATE pengajuan set c_users='$c_users',c_ruangan='$c_ruangan',mulai='$hmulai',selesai='$hselesai',keperluan='$keperluan',berkas='$berkas',at='$dt' where c_pengajuan='$c_pengajuan' ");
	}
	function batalpengajuan($c_pengajuan){
		return $this->db->query("UPDATE pengajuan set status='batal' where c_pengajuan='$c_pengajuan' ");
	}
//notifikasi users
	function jnotif($c_users){
		$query= $this->db->query("SELECT * FROM notifuser where c_users='$c_users' ");
		return $query->num_rows();
	}
	function jumlahnotif($c_users){
		$query= $this->db->query("SELECT * FROM notifuser where c_users='$c_users' and status='on' ");
		return $query->num_rows();
	}
	function notifatas($c_users){
		$query= $this->db->query("SELECT *,
		(SELECT username from users where c_users=notifuser.c_users) as username,
		(SELECT c_pengajuan from pengajuan where c_pengajuan=notifuser.c_pengajuan) as c_pengajuan
		FROM notifuser where c_users='$c_users' and status='on' order by at desc limit 5 ");
		return $query->result();
	}
	function notif($c_users){
		$query= $this->db->query("SELECT *,
		(SELECT username from users where c_users=notifuser.c_users) as username,
		(SELECT c_pengajuan from pengajuan where c_pengajuan=notifuser.c_pengajuan) as c_pengajuan
		FROM notifuser where c_users='$c_users' order by at desc limit 20");
		return $query->result();
	}
	function offnotifikasi($c_notifuser){
		return $this->db->query("UPDATE notifuser set status='off' where c_notifuser='$c_notifuser' ");
	}
	function notifusersregister($c_users){
		$at= date('Y-m-d H:i:s');
		return $this->db->query("INSERT INTO notifadmin set c_users='$c_users',notif='register',at='$at',status='on' ");
	}
	function notifuserspengajuan($c_users,$c_pengajuan){
		$at= date('Y-m-d H:i:s');
		return $this->db->query("INSERT INTO notifadmin set c_users='$c_users',c_pengajuan='$c_pengajuan',notif='pengajuan',at='$at',status='on' ");
	}
	function notifuserseditpengajuan($c_users,$c_pengajuan){
		$at= date('Y-m-d H:i:s');
		return $this->db->query("INSERT INTO notifadmin set c_users='$c_users',c_pengajuan='$c_pengajuan',notif='edit',at='$at',status='on' ");
	}
	function notifusersbatalpengajuan($c_users,$c_pengajuan){
		$at= date('Y-m-d H:i:s');
		return $this->db->query("INSERT INTO notifadmin set c_users='$c_users',c_pengajuan='$c_pengajuan',notif='batal',at='$at',status='on' ");
	}
	function getnotif($c_notifuser){
		$query= $this->db->query("SELECT * FROM notifuser where c_notifuser='$c_notifuser' ");
		return $query->row();
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