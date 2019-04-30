<?php 

	if($xls){
		 header('Content-Type: application/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename="laporan_belum_input_nilai.xls"');
	    header('Cache-Control: max-age=0');
	}
?>
<table>
	<thead>
	<tr>
		<th>No</th>
		<th>Prodi</th>
		<th>Nama Dosen</th>
		
	</tr>
</thead>
<tbody>
	<?php 
	$i=0;
	if(!empty($result)){
	foreach($result as $m)
	{
		$m = (object) $m;
		if($m->count == 0) continue;
		$i++;
	?>
	<tr>
		<td><?=($i);?></td>
		<td><?=$m->prodi;?></td>
		<td><?=$m->nama;?></td>
		
	</tr>
	<?php 
}
}
	?>
</tbody>
</table>
