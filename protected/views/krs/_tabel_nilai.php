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
		<th>Kode MK</th>
		<th>Nama MK</th>
		<th>Semester</th>
		<th>NIM</th>
		<th>Nama Mahasiswa</th>
	</tr>
</thead>
<tbody>
	<?php 
	$i=0;
	if(!empty($model)){
	foreach($model as $q => $m)
	{
		$m = (object) $m;
		$i++;
	?>
	<tr>
		<td><?=($i);?></td>
		<td><?=$m->singkatan;?></td>
		<td><?=$m->nama_dosen;?></td>
		<td><?=$m->kode_mk;?></td>
		<td><?=$m->nama_mk;?></td>
		<td><?=$m->semester;?></td>
		<td><?=$m->mahasiswa;?></td>
		<td><?=$m->nama_mahasiswa;?></td>
	</tr>
	<?php 
}
}
	?>
</tbody>
</table>
