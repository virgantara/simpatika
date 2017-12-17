<?php
/* @var $this MastermahasiswaController */
/* @var $data Mastermahasiswa */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_pt')); ?>:</b>
	<?php echo CHtml::encode($data->kode_pt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_fakultas')); ?>:</b>
	<?php echo CHtml::encode($data->kode_fakultas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_prodi')); ?>:</b>
	<?php echo CHtml::encode($data->kode_prodi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_jenjang_studi')); ?>:</b>
	<?php echo CHtml::encode($data->kode_jenjang_studi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nim_mhs')); ?>:</b>
	<?php echo CHtml::encode($data->nim_mhs); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_mahasiswa')); ?>:</b>
	<?php echo CHtml::encode($data->nama_mahasiswa); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('tempat_lahir')); ?>:</b>
	<?php echo CHtml::encode($data->tempat_lahir); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgl_lahir')); ?>:</b>
	<?php echo CHtml::encode($data->tgl_lahir); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jenis_kelamin')); ?>:</b>
	<?php echo CHtml::encode($data->jenis_kelamin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tahun_masuk')); ?>:</b>
	<?php echo CHtml::encode($data->tahun_masuk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('semester_awal')); ?>:</b>
	<?php echo CHtml::encode($data->semester_awal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('batas_studi')); ?>:</b>
	<?php echo CHtml::encode($data->batas_studi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('asal_propinsi')); ?>:</b>
	<?php echo CHtml::encode($data->asal_propinsi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgl_masuk')); ?>:</b>
	<?php echo CHtml::encode($data->tgl_masuk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgl_lulus')); ?>:</b>
	<?php echo CHtml::encode($data->tgl_lulus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_aktivitas')); ?>:</b>
	<?php echo CHtml::encode($data->status_aktivitas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_awal')); ?>:</b>
	<?php echo CHtml::encode($data->status_awal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jml_sks_diakui')); ?>:</b>
	<?php echo CHtml::encode($data->jml_sks_diakui); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nim_asal')); ?>:</b>
	<?php echo CHtml::encode($data->nim_asal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('asal_pt')); ?>:</b>
	<?php echo CHtml::encode($data->asal_pt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_asal_pt')); ?>:</b>
	<?php echo CHtml::encode($data->nama_asal_pt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('asal_jenjang_studi')); ?>:</b>
	<?php echo CHtml::encode($data->asal_jenjang_studi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('asal_prodi')); ?>:</b>
	<?php echo CHtml::encode($data->asal_prodi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_biaya_studi')); ?>:</b>
	<?php echo CHtml::encode($data->kode_biaya_studi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_pekerjaan')); ?>:</b>
	<?php echo CHtml::encode($data->kode_pekerjaan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tempat_kerja')); ?>:</b>
	<?php echo CHtml::encode($data->tempat_kerja); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_pt_kerja')); ?>:</b>
	<?php echo CHtml::encode($data->kode_pt_kerja); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_ps_kerja')); ?>:</b>
	<?php echo CHtml::encode($data->kode_ps_kerja); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nip_promotor')); ?>:</b>
	<?php echo CHtml::encode($data->nip_promotor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nip_co_promotor1')); ?>:</b>
	<?php echo CHtml::encode($data->nip_co_promotor1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nip_co_promotor2')); ?>:</b>
	<?php echo CHtml::encode($data->nip_co_promotor2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nip_co_promotor3')); ?>:</b>
	<?php echo CHtml::encode($data->nip_co_promotor3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nip_co_promotor4')); ?>:</b>
	<?php echo CHtml::encode($data->nip_co_promotor4); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo_mahasiswa')); ?>:</b>
	<?php echo CHtml::encode($data->photo_mahasiswa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('semester')); ?>:</b>
	<?php echo CHtml::encode($data->semester); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keterangan')); ?>:</b>
	<?php echo CHtml::encode($data->keterangan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_bayar')); ?>:</b>
	<?php echo CHtml::encode($data->status_bayar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telepon')); ?>:</b>
	<?php echo CHtml::encode($data->telepon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hp')); ?>:</b>
	<?php echo CHtml::encode($data->hp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alamat')); ?>:</b>
	<?php echo CHtml::encode($data->alamat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('berat')); ?>:</b>
	<?php echo CHtml::encode($data->berat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tinggi')); ?>:</b>
	<?php echo CHtml::encode($data->tinggi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ktp')); ?>:</b>
	<?php echo CHtml::encode($data->ktp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rt')); ?>:</b>
	<?php echo CHtml::encode($data->rt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rw')); ?>:</b>
	<?php echo CHtml::encode($data->rw); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dusun')); ?>:</b>
	<?php echo CHtml::encode($data->dusun); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_pos')); ?>:</b>
	<?php echo CHtml::encode($data->kode_pos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desa')); ?>:</b>
	<?php echo CHtml::encode($data->desa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kecamatan')); ?>:</b>
	<?php echo CHtml::encode($data->kecamatan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jenis_tinggal')); ?>:</b>
	<?php echo CHtml::encode($data->jenis_tinggal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('penerima_kps')); ?>:</b>
	<?php echo CHtml::encode($data->penerima_kps); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_kps')); ?>:</b>
	<?php echo CHtml::encode($data->no_kps); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('provinsi')); ?>:</b>
	<?php echo CHtml::encode($data->provinsi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kabupaten')); ?>:</b>
	<?php echo CHtml::encode($data->kabupaten); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('warga_negara')); ?>:</b>
	<?php echo CHtml::encode($data->warga_negara); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_sipil')); ?>:</b>
	<?php echo CHtml::encode($data->status_sipil); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agama')); ?>:</b>
	<?php echo CHtml::encode($data->agama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gol_darah')); ?>:</b>
	<?php echo CHtml::encode($data->gol_darah); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('masuk_kelas')); ?>:</b>
	<?php echo CHtml::encode($data->masuk_kelas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgl_sk_yudisium')); ?>:</b>
	<?php echo CHtml::encode($data->tgl_sk_yudisium); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_mahasiswa')); ?>:</b>
	<?php echo CHtml::encode($data->status_mahasiswa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kampus')); ?>:</b>
	<?php echo CHtml::encode($data->kampus); ?>
	<br />

	*/ ?>

</div>