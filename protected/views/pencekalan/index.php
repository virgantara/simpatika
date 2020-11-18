 <?php
$this->breadcrumbs=array(
	array('name'=>'Pencekalan','url'=>['index']),
	array('name'=>'Manage'),
);

?>
<h1>Data Pencekalan</h1>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jam-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'method' => 'get',
	'htmlOptions'=>array(
		'class' => 'form-horizontal'
	),
	'action' => $this->createUrl('pencekalan/index'),
)); ?>

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Kelas</label>
		<div class="col-sm-9">
		<?php 
		$kampus = !empty($_GET['kampus']) ? $_GET['kampus'] : '';
		$list = CHtml::listData(Kampus::model()->findAll(), 'kode_kampus', 'nama_kampus');
		echo CHtml::dropDownList('kampus',$kampus,$list,array('empty' => '(Pilih Kelas)','class'=>'input')); 
		// echo $form->textField($model,'prodi',array('size'=>10,'maxlength'=>10)); 
		?>
		</div>
	</div>		

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Prodi</label>
		<div class="col-sm-9">
		<?php
		$kode_prodi = !empty($_GET['kode_prodi']) ? $_GET['kode_prodi'] : '';
    
    $list = CHtml::listData(Masterprogramstudi::model()->findAll(), 'kode_prodi','nama_prodi');
    
		echo CHtml::dropDownList('kode_prodi',$kode_prodi,$list);
		
		?>
		</div>
	</div>

	 <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">

          <button class="btn btn-info" type="submit" value="1" name="btn-lihat">
            <i class="ace-icon glyphicon glyphicon-check bigger-110"></i>
            Lihat
          </button>
          
        
        </div>
      </div>



 <?php $this->endWidget(); ?>
<div class="row">
    <div class="col-xs-12">
        
            <?php    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . $message . "</div>\n";
    }
?>

        <br>
<?php $form=$this->beginWidget('CActiveForm', array(
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'method' => 'post',
	'htmlOptions'=>array(
		'class' => 'form-horizontal'
	),
	'action' => $this->createUrl('pencekalan/postdata'),
)); ?>

<input type="hidden" name="kampus" value="<?=!empty($_GET['kampus']) ? $_GET['kampus'] : 0;?>"/>
<input type="hidden" name="kode_prodi" value="<?=!empty($_GET['kode_prodi']) ? $_GET['kode_prodi'] : 0;?>"/>
<table class="table table-striped table-bordered" id="table-mahasiswa">

  <thead>
    <tr>
      <th width="5%">No</th>
      <th width="25%">NIM</th>
      <th width="30%">Nama</th>
      <th width="10%">Tahfidz</th>
      <th width="10%">AKPAM</th>
      <th width="10%">ADM</th>
      <th width="10%">Akademik</th>
      
    </tr>
  </thead>
  <tbody>
  	<?php 

  	foreach($results as $q=>$item)
  	{

  		$cekal = Pencekalan::model()->findByAttributes([
  			'tahun_id' => $tahunaktif,
  			'nim' => $item->nim_mhs
  		]);
  		$checkedTahfidz = '';
  		$checkedAdm = '';
  		$checkedAkpam = '';
  		$checkedAkademik = '';
  		if(!empty($cekal))
  		{
  			$checkedTahfidz = $cekal->tahfidz ? 'checked' :'';
  			$checkedAkpam = $cekal->akpam  ? 'checked' :'';
  			$checkedAdm = $cekal->adm  ? 'Tercekal' :'';
  			$checkedAkademik = $cekal->akademik ? 'checked' :'';	
  		}
  		
  	?>
<tr>
	<td><?=$q+1;?></td>
	<td><?=$item->nim_mhs;?></td>
	<td><?=$item->nama_mahasiswa;?></td>
	<td><input type="checkbox" name="tahfidz_<?=$tahunaktif;?>_<?=$item->nim_mhs;?>" <?=$checkedTahfidz;?>></td>
	<td><input type="checkbox" name="akpam_<?=$tahunaktif;?>_<?=$item->nim_mhs;?>" <?=$checkedAkpam;?>></td>
	<td><?=$checkedAdm;?></td>
	<td><input type="checkbox" name="akademik_<?=$tahunaktif;?>_<?=$item->nim_mhs;?>" <?=$checkedAkademik;?>></td>
</tr>
  	<?php 
  }
  	?>
</tbody>
</table>
	 <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">

          <button class="btn btn-info" type="submit" value="1" name="btn-simpan">
            <i class="ace-icon glyphicon glyphicon-check bigger-110"></i>
            Simpan Data
          </button>
          
        
        </div>
      </div>
	</div>
</div>


 <?php $this->endWidget(); ?>
