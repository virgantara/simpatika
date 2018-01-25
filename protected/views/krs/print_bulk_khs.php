<table border="0" style="font-size:9px;font-weight:bold;;font-family: 'Times'" width="100%">
 	
	   <tr>
		  <td width="150px">
			  <img src="<?php echo Yii::app()->baseUrl;?>images/logonew.jpg" width="90px"/>
		  </td> 
			<td align="center">
				<h3> UNIVERSITAS DARUSSALAM GONTOR </h3>
				SAINS DAN TEKNOLOGI	<br>	
				Jalan Raya Siman Km.6 254 
				<br>
				KARTU HASIL STUDI
			</td>
		</tr>	
   </table>
   
 <br>  <br> 
<table border="0" width="100%" style="font-size:9px;;font-family: 'Times'">
  <tr>
    <td width="15%" align="left"> Nomor Pokok Mhs</td>
    <td width="3%">:</td> 
    <td width="32%"> <?php echo $mhs->nim_mhs; ?> </td>
    <td width="15%" align="left"> Dosen PA</td>
    <td width="3%">:</td> 
    <td width="32%"> <?php echo !empty($dosenPA)?$dosenPA->nama_dosen:"" ?></td>
     
  </tr>
  <tr>
    <td align="left"> Semester </td>
    <td>:</td>
     <td> <?php echo $thn->nama_tahun;?></td>
    <td align="left"> Program Studi </td>
    <td>:</td>
     <td> Teknik Informatika </td>
     
    
  </tr>
   <tr>
    <td align="left"> Nama Mahasiswa </td>
    <td>:</td> 
    <td> <?php echo ucwords($mhs->nama_mahasiswa);?></td>
    <td></td>
    <td>  </td>
    <td>  </td>  
  </tr>
    
</table>

	   <br><br>
<table  border="0" width="100%" style="font-size:9px;;font-family: 'Times'" cellpadding="3">
  <tr>
	    <th style="padding:5px;text-align: center;border-top: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;" width="20px"><strong>No</strong></th>
		 <th style="padding:5px;text-align: center;border-top: 1px solid black;border-bottom: 1px solid black;" width="100px"><strong>Kode MK</strong></th>
		 <th style="padding:5px;text-align: center;border-top: 1px solid black;border-bottom: 1px solid black;" width="300px"><strong>MATA KULIAH</strong></th>
		 <th style="padding:5px;text-align: center;border-top: 1px solid black;border-bottom: 1px solid black;" width="30px"><strong>SKS</strong></th>
		 <th style="padding:5px;text-align: center;border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;" width="60px"><strong>Nilai</strong></th>
	   
  </tr>
  
<?php 
$listkrs = Yii::app()->db->createCommand()
    ->select('*')
    ->from('view_datakrs_mhs')
    ->where('mahasiswa=:p1 AND semester=:p2',array(':p1'=>$mhs->nim_mhs,':p2'=>$semester))
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


   	
?>

	    
				<tr>
				  <td valign="middle" align="center" style="padding:5px;border-left: 1px solid black"> <?=$i;?>. </td>
				  
				  <td valign="middle" align="center" style="padding:5px;"> <?=$krs->kode_mk;?></td>
				  <td valign="middle" style="padding:5px;"> <?=$krs->nama_mk;?></td>
				  <td valign="middle" align="center" style="padding:5px;"><?=$krs->sks;?></td>
				  <td style="padding:5px;text-align: center;border-right: 1px solid black;" valign="top"><?=$krs->nilai_huruf;?></td>
				</tr>
	   
<?php 
	}
?>
	  			   <tr>
				   <td colspan="3" valign="middle" align="right" style="border-bottom: 1px solid black;border-left: 1px solid black">Jumlah </td>
				   <td align="center" style="border-bottom: 1px solid black">
					   <?=$total_sks;?>				   </td>
				   <td style="border-bottom: 1px solid black;border-right: 1px solid black">
				   </td>
				    
			   </tr>
   <tr>
           <td colspan="5" style="border-bottom: 1px solid black;border-left: 1px solid black;border-right: 1px solid black">
             <table  cellpadding="2">
               <tr>
                 <td width="32%">
                   <table  style="border-right: 1px solid black;">
                    <tr>
                      <td width="60%">KHS Semester</td>
                      <td width="40%" >: <?php echo $thn->semester%2==1 ? "Ganjil":"Genap";?></td>
                    </tr>
                     <tr>
                      <td width="60%">SKS yang diambil</td>
                      <td width="40%">: <?=$total_sks;?></td>
                    </tr>
                     <tr>
                      <td width="60%">SKS yang diselesaikan</td>
                      <td width="40%">: <?=$total_sks-$sks_gagal;?></td>
                    </tr>
                     <tr>
                      <td width="60%">SKS yang gagal</td>
                      <td width="40%">: <?=$sks_gagal;?></td>
                    </tr>
                     <tr>
                      <td width="60%">IPS</td>
                      <td width="40%">: <?php echo $total_sks > 0 ? round($nilai_bobot / $total_sks,2) : 0;?></td>
                    </tr>
                   </table>
                 </td>
                 <td width="35%">
                   <table  style="border-right: 1px solid black;">
                   
<!--                      <tr>
                      <td width="60%">IPK Semester lalu</td>
                      <td width="40%">: <?php
                       // echo Yii::app()->helper->calc_ipk_lalu($mhs->nim_mhs,$semester);
                       ?></td>
                    </tr> -->
                     <tr>
                      <td width="60%">IPK Sekarang</td>
                      <td width="40%">: <?=$ipk;?></td>
                    </tr>
                     <tr>
                      <td width="60%"></td>
                      <td width="40%"></td>
                    </tr>
                     <tr>
                      <td width="60%"></td>
                      <td width="40%"></td>
                    </tr>
                   </table>
                 </td>
                 <td width="33%" valign="middle">
                   Beban studi yang diperkenankan pada semester selanjutnya : 24 SKS
                 </td>
               </tr>
              
             </table>
           </td>
                       
         </tr> 
  </table>
 
 <br>
<br><br>
	 <table border="0" width="100%" style="font-size:9px;;font-family: 'Times'">
  <tr>
    <td width="70%">
      
    </td>
    <td valign="top">
       <br/>
       
        <table border="0" width="100%">
         <tr>
           <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4">Siman, <?=$tanggal;?></td>
           <td align="center" colspan="2">&nbsp;</td>
           
         </tr>
         <tr>
           <td align="center" colspan="2">&nbsp;</td>
           <td align="center" colspan="4">Ketua Program Studi,</td>
           <td align="center" colspan="2">&nbsp;</td> 
         </tr>
        <tr>
           <td align="center" colspan="2">&nbsp;</td>
           <td align="center" colspan="4"><br><br><br></td>
           <td align="center" colspan="2">&nbsp;</td> 
         </tr>
         <tr>
           <td align="center" colspan="8"><br>
           (<?php echo !empty($kaprodi)?$kaprodi->nama_dosen : "............................................" ?>)</td>
            
         </tr>
    
       </table>
    </td>
    <td>
      
         <br>
         
      
    </td>
  </tr>
 </table>
    