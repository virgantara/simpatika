<?php
/* @var $this TahunakademikController */
/* @var $data Tahunakademik */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tahun_id')); ?>:</b>
	<?php echo CHtml::encode($data->tahun_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tahun')); ?>:</b>
	<?php echo CHtml::encode($data->tahun); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('semester')); ?>:</b>
	<?php echo CHtml::encode($data->semester); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_tahun')); ?>:</b>
	<?php echo CHtml::encode($data->nama_tahun); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('krs_mulai')); ?>:</b>
	<?php echo CHtml::encode($data->krs_mulai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('krs_selesai')); ?>:</b>
	<?php echo CHtml::encode($data->krs_selesai); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('krs_online_mulai')); ?>:</b>
	<?php echo CHtml::encode($data->krs_online_mulai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('krs_online_selesai')); ?>:</b>
	<?php echo CHtml::encode($data->krs_online_selesai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('krs_ubah_mulai')); ?>:</b>
	<?php echo CHtml::encode($data->krs_ubah_mulai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('krs_ubah_selesai')); ?>:</b>
	<?php echo CHtml::encode($data->krs_ubah_selesai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kss_cetak_mulai')); ?>:</b>
	<?php echo CHtml::encode($data->kss_cetak_mulai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kss_cetak_selesai')); ?>:</b>
	<?php echo CHtml::encode($data->kss_cetak_selesai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cuti')); ?>:</b>
	<?php echo CHtml::encode($data->cuti); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mundur')); ?>:</b>
	<?php echo CHtml::encode($data->mundur); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bayar_mulai')); ?>:</b>
	<?php echo CHtml::encode($data->bayar_mulai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bayar_selesai')); ?>:</b>
	<?php echo CHtml::encode($data->bayar_selesai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kuliah_mulai')); ?>:</b>
	<?php echo CHtml::encode($data->kuliah_mulai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kuliah_selesai')); ?>:</b>
	<?php echo CHtml::encode($data->kuliah_selesai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uts_mulai')); ?>:</b>
	<?php echo CHtml::encode($data->uts_mulai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uts_selesai')); ?>:</b>
	<?php echo CHtml::encode($data->uts_selesai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uas_mulai')); ?>:</b>
	<?php echo CHtml::encode($data->uas_mulai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uas_selesai')); ?>:</b>
	<?php echo CHtml::encode($data->uas_selesai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nilai')); ?>:</b>
	<?php echo CHtml::encode($data->nilai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('akhir_kss')); ?>:</b>
	<?php echo CHtml::encode($data->akhir_kss); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('proses_buka')); ?>:</b>
	<?php echo CHtml::encode($data->proses_buka); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('proses_ipk')); ?>:</b>
	<?php echo CHtml::encode($data->proses_ipk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('proses_tutup')); ?>:</b>
	<?php echo CHtml::encode($data->proses_tutup); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('buka')); ?>:</b>
	<?php echo CHtml::encode($data->buka); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('syarat_krs')); ?>:</b>
	<?php echo CHtml::encode($data->syarat_krs); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('syarat_krs_ips')); ?>:</b>
	<?php echo CHtml::encode($data->syarat_krs_ips); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cuti_selesai')); ?>:</b>
	<?php echo CHtml::encode($data->cuti_selesai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('max_sks')); ?>:</b>
	<?php echo CHtml::encode($data->max_sks); ?>
	<br />

	*/ ?>

</div>