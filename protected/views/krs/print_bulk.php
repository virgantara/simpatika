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
				Kartu Rencana Studi
			</td>
		</tr>	
   </table>
   
 <br>  <br> 
    <table border="0" width="100%" style="font-family: 'Times';font-size: 9px">
    	<tr>
        	<td align="left" width="100px">Nama Mahasiswa</td>
            <td align="left" width="600px" > : <?php echo ucwords($mhs->nama_mahasiswa);?> </td>
            <td align="center">&nbsp;</td>
        </tr>
        <tr>
            <td align="left">Nomor Pokok </td>
            <td align="left"> : <?php echo $mhs->nim_mhs; ?> </td>
             <td align="center" >&nbsp;</td>
        </tr>
      
    </table>
	   <br><br>
<table  border="1" width="100%" style="font-size:9px;;font-family: 'Times'" cellpadding="3">
  <tr>
	    <th style="padding:5px;text-align: center;" width="20px"><strong>No</strong></th>
		 <th style="padding:5px;text-align: center;" width="50px"><strong>Semester</strong></th>
		 <th style="padding:5px;text-align: center;" width="100px"><strong>Kode MK</strong></th>
		 <th style="padding:5px;text-align: center;" width="200px"><strong>MATA KULIAH</strong></th>
		 <th style="padding:5px;text-align: center;" width="30px"><strong>SKS</strong></th>
		 <th style="padding:5px;text-align: center;" width="100px"><strong>Keterangan</strong></th>
	   
  </tr>
  
<?php 
$listkrs = Yii::app()->db->createCommand()
    ->select('*')
    ->from('view_datakrs_mhs')
    ->where('mahasiswa=:p1 AND semester=:p2',array(':p1'=>$mhs->nim_mhs,':p2'=>$semester))
    ->queryAll();

    $total_sks = 0;
    $i = 0;
    foreach($listkrs as $krs)
   	{
   		$i++;
   		$krs = (object)$krs;

   		$total_sks += $krs->sks
   	
?>

	    
				<tr>
				  <td valign="middle" align="center" style="padding:5px;"> <?=$i;?>. </td>
				   <td valign="middle" align="center" style="padding:5px;"> 
				  <?=$krs->semester;?>				  <!--(1.75)-->
				  </td>
				  <td valign="middle" align="center" style="padding:5px;"> <?=$krs->kode_mk;?></td>
				  <td valign="middle" style="padding:5px;"> <?=$krs->nama_mk;?></td>
				  <td valign="middle" align="center" style="padding:5px;"><?=$krs->sks;?></td>
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
<br><br><br>
	 <table border="0" width="100%" style="font-size:9px;;font-family: 'Times'">
        <tr>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4">Mengetahui</td>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4">Siman, <?=$tanggal;?></td>
			<td align="center" colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4">Dosen Penasehat Akademik</td>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4">Mahasiswa Ybs</td>
			<td align="center" colspan="2">&nbsp;</td>
        </tr>
       <tr>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4"><br><br><br></td>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4"><br><br><br></td>
			<td align="center" colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4">(<?php echo !empty($dosenPA)?$dosenPA->nama_dosen : "............................................" ?>)</td>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4">( <?php echo $mhs->nama_mahasiswa ?>) </td>
			<td align="center" colspan="2">&nbsp;</td>
        </tr>
        
    </table>