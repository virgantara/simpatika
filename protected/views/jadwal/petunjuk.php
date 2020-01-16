<h3>Petunjuk Unggah Mandiri Jadwal UNIDA</h3>
<?php 
$list_hari = array(
	'Sabtu'=>'Sabtu',
	'Ahad'=> 'Ahad',
	'Senin'=>'Senin',
	'Selasa'=>'Selasa',
	'Rabu'=> 'Rabu',
	'Kamis'=>'Kamis'
);
?>

<h3 style="color: red">
	Catatan: Harap mengikuti petunjuk unggah berikut. 
</h3>
<ol>
	<li>
		Silakan mengunduh template jadwal terlebih dahulu di <?php echo CHtml::link('sini',array('jadwal/template'));?>
	</li>
	<li>
		Kolom HARI hanya menerima data input nama hari, yaitu : <?php 
			foreach($list_hari as $q => $v)
			{
				echo $v.', ';
			}
		?>. 
	</li>

	<li>
		Kolom JAM hanya menerima data input berikut : 
		<?php 
			foreach(Jam::model()->findAll() as $item)
			{
				echo $item->nama_jam.', ';
			}
		?>. 
	</li>

	<li>
		Kolom WAKTU hanya menerima data input dengan format jam mulai-jam selesai.<br> Di mana format jam mulai dan jam selesai adalah hh:mm. Contoh : 07:30-09:10
	</li>
	<li>
		Kode MK yang benar adalah tanpa menggunakan titik (.) atau tanpa spasi. Contoh <strong>BENAR</strong>: K3311245, UNIV22224. Contoh <strong>SALAH</strong> : PMH.5.1.1.3.61, UNIV 2 2 2 2 4 
	</li>

	<li>
		Kolom NIY di isi dengan data NIY dosen yang pernah kami kirimkan ke email masing-masing prodi.
	</li>
	<li>
		DOSEN PENGAMPU di sini dengan nama lengkap dan gelarnya
	</li>
	<li>
		RUANG di sini dengan kode ruang. Jika tidak diketahui, silakan diisi dengan tanda dash '-'
	</li>

	<li>
		KODE FT adalah kode fakultas. Diisi dengan angka kode fakultas
	</li>
	<li>
		Fakultas diisi dengan nama fakultas saja 
	</li>
	<li>KD PRODI diisi dengan kode prodi</li>
	<li>PRODI diisi dengan singkatan nama prodi. Contoh : 
		<?php 
		foreach(Masterprogramstudi::model()->findAll() as $item)
		{
			echo $item->singkatan.', ';
		}
		?>
	</li>
	<li>TAHUN diisi dengan kode tahun akademik. Contoh : 20172</li>
	<li>SEMESTER diisi dengan angka saja</li>
	<li>KAMPUS diambil dari data berikut. 
		<?php 
		foreach(Kampus::model()->findAll() as $item)
		{
			echo $item->nama_kampus.', ';
		}
		?>
	</li>
	<li>
		KELAS diambil dari data berikut:
		<?php 

		$tahun_akademik = Tahunakademik::model()->findByAttributes(array('buka'=>'Y'));
		$tahunaktif = $tahun_akademik->tahun_id;
		foreach(Masterkelas::model()->findAllByAttributes(array('tahun_akademik'=>$tahunaktif)) as $item)
		{
			echo $item->nama_kelas.', ';
		}
		?>

		di mana kode kelas tersebut mewakili masing-masing kampus.
		<ul>
			<li>A = Siman</li>
			<li>B = Gontor</li>
			<li>C = Mantingan</li>
			<li>D = Kediri</li>
			<li>E = Kandangan</li>
			<li>F = Magelang</li>

		</ul> 
		Adapun angka yang mengikuti adalah urutan jadwal pertemuan. Contoh: A1 adalah kelas Siman Pagi, C1 adalah Mantingan Pagi, C2 adalah Mantingan Siang, C3 adalah Mantingan Sore, dan seterusnya. 
	</li>
</ol>
<h4>Terima kasih</h4>