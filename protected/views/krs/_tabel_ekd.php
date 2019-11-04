<?php 

	if($xls){
		 header('Content-Type: application/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename="laporan_belum_input_ekd.xls"');
	    header('Cache-Control: max-age=0');
	}
?>
<table class="table table-bordered table-hovered table-striped">
	<thead>
	<tr>
		<th>No</th>
		<th>NIM</th>
		<th>Nama Mahasiswa</th>
		<th>Prodi</th>
		<th>MK yang belum di isi EKD-nya</th>
	</tr>
</thead>
<tbody>
	<?php 
	
	if(!empty($result)){
		$i=0;
	foreach($result as $m)
	{
		$m = (object) $m;
		
		if(empty($m)) continue;
		$i++;
	?>
	<tr>
		<td><?=($i);?></td>
		<td><?=$m->nim;?></td>
		<td><?=$m->nm;?></td>
		<td><?=$m->prodi;?></td>
		<td><?=$m->mk;?></td>
	</tr>
	<?php 
}
}
	?>
</tbody>
</table>
