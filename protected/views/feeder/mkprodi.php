
<table>
	<thead>
	<tr>
		<th>No</th>
		<th>KODE</th>
		<th>Nama</th>
		<th>SKS</th>
		<th>Jns<br>MK</th>
		
	</tr>
</thead>

<body>
<?php
	$items = $hasil->values->output->result->item;
	foreach($items as $q => $item){
		$mk = (array)$item->id_mk;
		$kode_mk = (array)$item->kode_mk;
		$nm_mk = (array)$item->nm_mk;
		$jns_mk=(array)$item->jns_mk;
		$sks_mk = (array)$item->sks_mk;

		
?>
	<tr>
		<td><?=$q+1	;?></td>
		
		<td><a href="<?=Yii::app()->createUrl('feeder/mkprodi',['id_sms'=>$mk['$value']]);?>"><?=$kode_mk['$value'];?></a></td>
		<td><?=!empty($nm_mk['$value']) ? $nm_mk['$value'] : '';?></td>

		<td><?=$sks_mk['$value'];?></td>
		<td><?=!empty($jns_mk['$value']) ? $jns_mk['$value'] : '';?></td>
		
	</tr>
	<?php
	}
	 ?>
</body>
</table>
