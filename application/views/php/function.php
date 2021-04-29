<?php 
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
function rp($str){
    $jum = strlen($str);
    $jumtitik = ceil($jum/3);
    $balik = strrev($str);
    
    $awal = 0;
    $akhir = 3;
    for($x=0;$x<$jumtitik;$x++){
      $a[$x] = substr($balik,$awal,$akhir)."."; 
      $awal+=3;
    }
    $hasil = implode($a);
    $hasilakhir = strrev($hasil);
    $hasilakhir = substr($hasilakhir,1,$jum+$jumtitik);
          
    return "".$hasilakhir."";
}
function tgl($date){  
  $array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
  $date = strtotime($date);
  $tanggal = date ('j', $date);
  $bulan = $array_bulan[date('n',$date)];
  $tahun = date('Y',$date); 
  $result = $tanggal ." ". $bulan ." ". $tahun;       
  return($result);  
}
function bulan($bulan){
  if($bulan=='01'){$namabulan="Januari";}
  elseif($bulan=='01'){$namabulan="Januari";}
  elseif($bulan=='02'){$namabulan="Februari";}
  elseif($bulan=='03'){$namabulan="Maret";}
  elseif($bulan=='04'){$namabulan="April";}
  elseif($bulan=='05'){$namabulan="Mei";}
  elseif($bulan=='06'){$namabulan="Juni";}
  elseif($bulan=='07'){$namabulan="Juli";}
  elseif($bulan=='08'){$namabulan="Agustus";}
  elseif($bulan=='09'){$namabulan="September";}
  elseif($bulan=='10'){$namabulan="Oktober";}
  elseif($bulan=='11'){$namabulan="November";}
  elseif($bulan=='12'){$namabulan="Desember";}
  return($namabulan);
}
function hari($hari){
  $daftar_hari = array( 'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu' );
  $hariini = date('l', strtotime($hari)); 
  return $daftar_hari[$hariini];
}
function h($h){
  if($h=='1'){$hr='Senin';}
  elseif($h=='2'){$hr='Selasa';}
  elseif($h=='3'){$hr='Rabu';}
  elseif($h=='4'){$hr='Kamis';}
  elseif($h=='5'){$hr='Jumat';}
  elseif($h=='6'){$hr='Sabtu';}
  elseif($h=='7'){$hr='Minggu';}
  return $hr;
}
function random($length){
  $data='1234567890AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSstuuUvVwWxXyYyZz';
  $string='';
  for($i=1;$i<=$length;$i++){
    $pos=rand(0,strlen($data)-1);
    $string.=$data{$pos};
  }
  return $string;
}
function l($linku){
  $l=substr(md5($linku), 0,9);
  return $l;
}
?>