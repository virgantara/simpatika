<?php 

class MyHelper extends CApplicationComponent
{

	function calc_ipk_lalu($nim, $semester)
	{

		$semester = ($semester == 1) ? 0 : $semester -= 1;



		$listkrs = Yii::app()->db->createCommand()
		    ->select('*')
		    ->from('view_datakrs_mhs')
		    ->where('mahasiswa=:p1 AND semester=:p2',array(':p1'=>$nim,':p2'=>$semester))
		    ->queryAll();

		$total_sks = 0;
	    $i = 0;
	    $nilai_bobot= 0;
	    $sks_gagal = 0;
	    foreach($listkrs as $krs)
	   	{
	   		$i++;
	   		$krs = (object)$krs;

			$nilai_angka = !empty($krs->nilai_angka) ? $krs->nilai_angka : 0;
			$nilai_huruf = !empty($krs->nilai_huruf) ? $krs->nilai_huruf : '';

			$nilai_angka = Yii::app()->helper->konvert_nilai_huruf($nilai_huruf);
			$nilai_bobot = $nilai_bobot + $krs->sks * $nilai_angka;

			if($nilai_angka < 2)
				$sks_gagal += $krs->sks;

			$total_sks += $krs->sks;
		}

		$ips = $total_sks > 0 ? round($nilai_bobot / $total_sks,2) : 0;

		return round($ips,2);
	}

	function calc_ipk($nim, $angkatan, $semester)
	{

		$list_smt = array();

		if($angkatan == '352014')
		{
			if($semester <=6)
			{
				for($i=1;$i<=$semester;$i++)
				{
					$list_smt[$i-1] = $i;
				}
			}
		}

		else if($angkatan == '362015')
		{
			if($semester <=4)
			{
				for($i=1;$i<=$semester;$i++)
				{
					$list_smt[$i-1] = $i;
				}
			}
		}

		else if($angkatan == '372016')
		{
			if($semester <=2)
			{
				for($i=1;$i<=$semester;$i++)
				{
					$list_smt[$i-1] = $i;
				}
			}
		}			

	

		$total_sks = 0;
		$nilai_bobot= 0;
		    

		foreach($list_smt as $semester)
		{
			$listkrs = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('view_datakrs_mhs')
			    ->where('mahasiswa=:p1 AND semester=:p2',array(':p1'=>$nim,':p2'=>$semester))
			    ->queryAll();

			foreach($listkrs as $krs)
		   	{
		   		
		   		$krs = (object)$krs;

				$nilai_angka = !empty($krs->nilai_angka) ? $krs->nilai_angka : 0;
				$nilai_huruf = !empty($krs->nilai_huruf) ? $krs->nilai_huruf : '';

				$nilai_angka = Yii::app()->helper->konvert_nilai_huruf($nilai_huruf);
				$nilai_bobot = $nilai_bobot + $krs->sks * $nilai_angka;

				// if($nilai_angka < 2)
				// 	$sks_gagal += $krs->sks;

				$total_sks += $krs->sks;
			}
		}

		return $total_sks > 0 ? round($nilai_bobot / $total_sks,2) : 0;
	}

	function konvert_nilai_huruf($huruf)
	{
		
		$konversi = Konversi::model()->findByAttributes(array('huruf'=>$huruf));	
		
		return !empty($konversi) ? $konversi->angka : 0;
	}

	function konvert_nilai_angka($nilai)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'sampai >= '.$nilai.' AND dari <= '.$nilai;

		$rn = RangeNilai::model()->find($criteria);

		$konversi = null;
		if(!empty($rn))
		{
			$konversi = Konversi::model()->findByAttributes(array('huruf'=>$rn->nilai_huruf));	
		}
		return !empty($konversi) ? $konversi->angka : 0;
	}

	function contains($haystack, $needle)
	{
		return strpos($haystack, $needle) !== false; 
	}

	function terbilang($bilangan) {

	  $angka = array('0','0','0','0','0','0','0','0','0','0',
	                 '0','0','0','0','0','0');
	  $kata = array('','satu','dua','tiga','empat','lima',
	                'enam','tujuh','delapan','sembilan');
	  $tingkat = array('','ribu','juta','milyar','triliun');

	  $panjang_bilangan = strlen($bilangan);

	  /* pengujian panjang bilangan */
	  if ($panjang_bilangan > 15) {
	    $kalimat = "Diluar Batas";
	    return $kalimat;
	  }

	  /* mengambil angka-angka yang ada dalam bilangan,
	     dimasukkan ke dalam array */
	  for ($i = 1; $i <= $panjang_bilangan; $i++) {
	    $angka[$i] = substr($bilangan,-($i),1);
	  }

	  $i = 1;
	  $j = 0;
	  $kalimat = "";


	  /* mulai proses iterasi terhadap array angka */
	  while ($i <= $panjang_bilangan) {

	    $subkalimat = "";
	    $kata1 = "";
	    $kata2 = "";
	    $kata3 = "";

	    /* untuk ratusan */
	    if ($angka[$i+2] != "0") {
	      if ($angka[$i+2] == "1") {
	        $kata1 = "seratus";
	      } else {
	        $kata1 = $kata[$angka[$i+2]] . " ratus";
	      }
	    }

	    /* untuk puluhan atau belasan */
	    if ($angka[$i+1] != "0") {
	      if ($angka[$i+1] == "1") {
	        if ($angka[$i] == "0") {
	          $kata2 = "sepuluh";
	        } elseif ($angka[$i] == "1") {
	          $kata2 = "sebelas";
	        } else {
	          $kata2 = $kata[$angka[$i]] . " belas";
	        }
	      } else {
	        $kata2 = $kata[$angka[$i+1]] . " puluh";
	      }
	    }

	    /* untuk satuan */
	    if ($angka[$i] != "0") {
	      if ($angka[$i+1] != "1") {
	        $kata3 = $kata[$angka[$i]];
	      }
	    }

	    /* pengujian angka apakah tidak nol semua,
	       lalu ditambahkan tingkat */
	    if (($angka[$i] != "0") OR ($angka[$i+1] != "0") OR
	        ($angka[$i+2] != "0")) {
	      $subkalimat = "$kata1 $kata2 $kata3 " . $tingkat[$j] . " ";
	    }

	    /* gabungkan variabe sub kalimat (untuk satu blok 3 angka)
	       ke variabel kalimat */
	    $kalimat = $subkalimat . $kalimat;
	    $i = $i + 3;
	    $j = $j + 1;

	  }

	  /* mengganti satu ribu jadi seribu jika diperlukan */
	  if (($angka[5] == "0") AND ($angka[6] == "0")) {
	    $kalimat = str_replace("satu ribu","seribu",$kalimat);
	  }

	  return trim($kalimat);

	} 

	function formatRupiah($val,$comma = 0)
	{
		return number_format($val,$comma,',','.');
	}

	function convertSQLDate($date)
	{
		$date = str_replace('/', '-', $date);
				

		return date('Y-m-d', strtotime($date));
	}

	function getSelisihHari($old, $new)
	{
		$date1 = new DateTime($old);
		$date2 = new DateTime($new);
		$interval = $date1->diff($date2);
		return $interval->d ; 

		// shows the total amount of days (not divided into years, months and days like above)
		//echo "difference " . $interval->days . " days ";
	}

	function getSelisihHariInap($old, $new)
	{
		$date1 = new DateTime($old);
		$date2 = new DateTime($new);
		$interval = $date1->diff($date2);
		return $interval->d + 1; 

		// shows the total amount of days (not divided into years, months and days like above)
		//echo "difference " . $interval->days . " days ";
	}

	function appendZeros($str, $charlength=6)
	{

		return str_pad($str, $charlength, '0', STR_PAD_LEFT);;
	}
	
	function getSelisihTanggal($old, $new)
	{
		$date1 = new DateTime($old);
		$date2 = new DateTime($new);
		$interval = $date1->diff($date2);
		return $interval->y. " tahun " . $interval->m." bulan ".$interval->d." hari"; 

		// shows the total amount of days (not divided into years, months and days like above)
		//echo "difference " . $interval->days . " days ";
	}

	function randomPassword() {
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
	
	function generateUniqueCode()
	{
		$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
		$string = '';
		 for ($i = 0; $i < 10; $i++) {
			  $string .= $characters[rand(0, strlen($characters) - 1)];
		 }
		
		return strtoupper($string);
	}

	function generateNoDaftar()
	{
		$characters = '0123456789';
		$string = '';
		 for ($i = 0; $i < 6; $i++) {
			  $string .= $characters[rand(0, strlen($characters) - 1)];
		 }
		
		return strtoupper($string);
	}

	function generateNoPegawai()
	{
		$characters = '0123456789';
		$string = '';
		 for ($i = 0; $i < 6; $i++) {
			  $string .= $characters[rand(0, strlen($characters) - 1)];
		 }
		
		return 'PEG'.$this->appendZeros(strtoupper($string),17);
	}

	function getKodeRawat()
	{
		$sql = 'SELECT kode_rawat FROM tr_rawat_inap ORDER BY kode_rawat DESC LIMIT 1';
		$medrec = Yii::app()->db->createCommand($sql)->queryAll();

		$hasil = 0;

		if(!empty($medrec))
			$hasil = $medrec[0]['kode_rawat'];

		return $hasil+1;

	}
	
	function getMinimumUnusedID()
	{
		$sql = 'SELECT MIN(t1.NoMedrec + 1) AS nextID FROM a_pasien t1 LEFT JOIN a_pasien t2 ON t1.NoMedrec + 1 = t2.NoMedrec WHERE t2.NoMedrec IS NULL';
		$medrec = Yii::app()->db->createCommand($sql)->queryAll();


		$hasil = 1;

		if (count($medrec[0]['nextID']) > 0)
			$hasil = $medrec[0]['nextID'];


		
		return $this->appendZeros($hasil);

	}
}

?>