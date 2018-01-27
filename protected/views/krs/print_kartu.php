<table border="0" style="font-size:9px;font-weight:bold;;font-family: 'Times'" width="100%">
 	
    <tr>
        <td width="20%" style="border-bottom: 1px solid black">
       <img src="<?php echo Yii::app()->baseUrl;?>images/logonew.jpg" width="90px"/>
      </td> 
      <td colspan="3" style="text-align: center;border-bottom: 1px solid black"><b>UNIVERSITAS DARUSSALAM GONTOR</b>
        <br>Jalan Raya Siman Km.6 254<br><b>Telp : </b>+62 352 483 762<br><b>Email : </b>rektorat@unida.gontor.ac.id <br><b>Website : </b> www.unida.gontor.ac.id
      </td width="80%" >
      </tr>
      <tr>
        <td colspan="4" align="center">
          
        </td>
      </tr>
      <tr>
        <td colspan="4" align="center">
          <strong style="font-size: 12px">KARTU UJIAN TENGAH SEMESTER</strong>
        </td>
      </tr>
       
   </table>
   
 <br>  <br> 
    <table border="0" width="100%" style="font-family: 'Times';font-size: 8px;font-weight: bold;">
    	<tr>
        <td width="60%">
          <table border="0" width="100%" >
         <tr>
           <td align="left" width="100px"> NAMA</td>
           <td align="center" width="10px">:</td>
           <td align="left" width="600px" ><?php echo ucwords($mhs->nama_mahasiswa);?></td>
         </tr>
         <tr>
            
           <td align="left"> NIM </td>
            <td align="center">:</td>
            <td align="left"><?php echo ($mhs->nim_mhs);?></td>
         </tr>
          <tr>
            
           <td align="left"> KAMPUS </td>
            <td align="center">:</td>
            <td align="left"><?php echo $kampus->nama_kampus;?></td>
         </tr>
          <tr>
            
           <td align="left"> FAKULTAS </td>
            <td align="center">:</td>
            <td align="left"><?php echo $fakultas->nama_fakultas;?></td>
         </tr>
         <tr>
            
           <td align="left"> PROGRAM STUDI </td>
            <td align="center">:</td>
            <td align="left"><?php echo $prodi->nama_prodi;?></td>
         </tr>
         <tr>
          <td align="left"> SEMESTER </td>
           <td align="center"> : </td>
            <td align="left"><?php echo $mhs->semester;?></td>
         </tr>
          <tr>
          <td align="left"> TAHUN AKADEMIK </td>
           <td align="center"> : </td>
            <td align="left"><?php echo $thn->nama_tahun;?></td>
         </tr>
        </table>
        </td>
        <td align="center" width="40%">
         
        <img  src="<?php echo Yii::app()->baseUrl;?>images/noimage.jpg" width="70"/>
        
        </td>
      </tr>
     
    </table>
    <br><br>
<table  border="1" width="100%" style="font-size:8px;;font-family: 'Times'" cellpadding="3">
  <tr>
	    <th style="padding:5px;text-align: center;" width="5%"><strong>No</strong></th>
		 <th style="padding:5px;text-align: center;" width="30%"><strong>MATA KULIAH</strong></th>
     <th style="padding:5px;text-align: center;" width="5%"><strong>SKS</strong></th>
     <th style="padding:5px;text-align: center;" width="12%"><strong>Kelas</strong></th>
     <th style="padding:5px;text-align: center;" width="28%"><strong>Hari/Tanggal</strong></th>
		 <th style="padding:5px;text-align: center;" width="10%"><strong>Paraf <br>Pengawas</strong></th>
		 <th style="padding:5px;text-align: center;" width="10%"><strong>Nilai</strong></th>
		 
		 
  </tr>
  
<?php 

    $attr = array('mahasiswa'=>$mhs->nim_mhs,'tahun_akademik'=>$thn->tahun_id);

    $listkrs = Datakrs::model()->findAllByAttributes($attr);

    $total_sks = 0;
    $i = 0;
    foreach($listkrs as $krs)
   	{
   		$i++;

   		$total_sks += $krs->sks
   	
?>

	    
				<tr>
				  <td valign="middle" align="center" style="padding:5px;"><?=$i;?>. </td>
				  <td valign="middle" style="padding:5px;"> <?=$krs->nama_mk;?></td>
          <td valign="middle" align="center" style="padding:5px;"><?=$krs->sks;?></td>
          <td valign="middle" align="center" style="padding:5px;"><?=$krs->kelas;?></td>
          <td valign="middle" align="center" style="padding:5px;">&nbsp;</td>
				  <td valign="middle" align="center" style="padding:5px;">&nbsp;</td>
				  <td style="padding:5px;" valign="top">&nbsp;</td>
				</tr>
	   
<?php 
	}
?>
	  			   <tr>
				   <td colspan="4" valign="middle" align="right">
					   <b>Total SKS </b> 
				   </td>
				   <td align="center">
					   <?=$total_sks;?>				   </td>
				   <td>
				   </td>
				    
			   </tr> 
  </table>
<br><br>
	 <table border="0" width="100%" style="font-size:8px;;font-family: 'Times'">
         <tr>
    <td>
      Catatan : <br>
      1. Kartu Ujian ini harap dibawa pada saat ujian <br>
      2. Pakaian hitam putih/kemeja <br>
      3. Kartu ujian hilang dikenakan denda Rp.10.000 <br>
      4. Kolom nilai diisi setelah nilai keluar sebagai kontrol untuk mengambil KHS
      
    </td>
    <td>
       
    </td>
    <td align="left" valign="top">
       PONOROGO,  <?php echo $tanggal; ?><br>
       DEKAN 
       <br>
       <br>
       <br>
       <br>
       <br>
       <br>
       <br>
       <u style="margin: 4px"><strong><?php echo !empty($dekan) ? $dekan->nama_dosen : '';?></strong></u><br>
       NIDN : <?php echo !empty($dekan) ? $dekan->nidn : '';?>
       
    </td>
    
  </tr>
    </table>