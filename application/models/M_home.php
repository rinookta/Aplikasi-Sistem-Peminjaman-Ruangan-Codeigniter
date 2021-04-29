<?php
class M_home extends CI_Model{
	function __construct(){
		parent:: __construct();
	}
//pengajuan
	function allpengajuan(){
		$query= $this->db->query("SELECT *,
		(SELECT nama from users where c_users=pengajuan.c_users) as peminjam,
		(SELECT ruangan from ruangan where c_ruangan=pengajuan.c_ruangan) as ruangan
		FROM pengajuan order by mulai desc ");
		return $query->result();
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
//pengajuan
	function cekpengajuan($c_ruangan){
		$dt= date("Y-m-d H:i:s");
		$query= $this->db->query("SELECT * FROM pengajuan where c_ruangan='$c_ruangan' and selesai>='$dt' order by at desc limit 1 ");
		return $query->result();
	}
	function getruangan($c_ruangan){
		$query= $this->db->query("SELECT * FROM ruangan where c_ruangan='$c_ruangan' ");
		return $query->row();
	}
}
?>