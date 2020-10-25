
<table>
	<thead>
	<tr>
		<th>No</th>
		<th>KODE</th>
		<th>Singkatan</th>
		<th>Nama</th>
		<th>Email</th>
		<th>Website</th>
		
	</tr>
</thead>

<body>
<?php
	$items = $hasil->values->output->result->item;
	foreach($items as $q => $item){
		$sms = (array)$item->id_sms;
		$kode = (array)$item->kode_prodi;
		$nama = (array)$item->nm_lemb;
		$email = !empty($item->email) ? (array)$item->email : '';
		$web = !empty($item->website) ? (array)$item->website : '';

		$singkatan = !empty($item->singkatan) ? (array)$item->singkatan : '';
		
?>
	<tr>
		<td><?=$sms['$value'];?></td>
		
		<td><a href="<?=Yii::app()->createUrl('feeder/mkprodi',['id_sms'=>$sms['$value']]);?>"><?=$kode['$value'];?></a></td>
		<td><?=!empty($singkatan['$value']) ? $singkatan['$value'] : '';?></td>

		<td><?=$nama['$value'];?></td>
		<td><?=!empty($email['$value']) ? $email['$value'] : '';?></td>
		<td><?=!empty($web['$value']) ? $web['$value'] : '';?></td>
		
	</tr>
	<?php
	}
	 ?>
</body>
</table>
