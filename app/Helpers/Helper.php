<?php

namespace App\Helpers;
 
class Helper {
   
    public static function get_hari_kerja($awal, $akhir)
    {
      //list libur nasional
        $libur_nasional=array('2018-01-01',"2018-02-16","2018-03-17","2018-03-30","2018-04-14",'2018-05-01','2018-05-10','2018-05-29',"2018-06-01","2018-06-15","2018-06-16","2018-08-17","2018-08-22","2018-09-11","2018-11-20","2018-12-25");
      //set awal jumlah hari kerja                               
        $hari_kerja= 0;
      //looping dari tgl awal sampai tgl akhir dengan increment 1 hari (60 * 60 * 24 second)
        for ($i=$awal; $i <= $akhir; $i += (60 * 60 * 24)) {
      //ubah format time ke date
          $i_date=date("Y-m-d",$i);
      //cek apakah hari sabtu, minggu atau hari libur nasional, Jika bukan maka tambahkan hari kerja
          if (date("w",$i) !="0" AND date("w",$i) !="6" AND !in_array($i_date,$libur_nasional)) {$hari_kerja++;}
        }
        
      //tampilkan hasil
        return  $hari_kerja;
    }

    public static function get_bulan_romawi($bulan)
    {
      $romans = [1=>'I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'];
      return $romans[(int)$bulan];
    }
    
    public static function masa_kerja($nip)
    {
      $bln = substr($nip,12,2);
      $thn = substr($nip,8,4);
      $tmtCpns = strtotime($thn.'-'.$bln.'-01');
      $now = strtotime(date('Y-m-d'));
      
      $numBulan = 1 + (date("Y",$now)-date("Y",$tmtCpns))*12;
      $numBulan += date("m",$now)-date("m",$tmtCpns);
      $tahun = floor($numBulan/12).' Tahun';
      $bulan = $numBulan%12 .' Bulan';
      return $tahun.' '.$bulan;
    }

    public static function tanggal_id($tgl)
    {
      $tanggal = date('Y-m-d', $tgl);
      $row = explode('-', $tanggal);
      $bulan = [1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
      return $row[2].' '.$bulan[(int)$row[1]].' '.$row[0];
    }
}
 
?>