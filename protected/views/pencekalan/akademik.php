 <?php
$this->breadcrumbs=array(
	array('name'=>'Pencekalan','url'=>['index']),
	array('name'=>'Manage'),
);

$semesters = [];

for($i=1;$i<=8;$i++)
{
  $semesters[$i] = $i;
}

$semester = !empty($_GET['semester']) ? $_GET['semester'] : '';
$matkul = !empty($_GET['kode_mk']) ? $_GET['kode_mk'] : '';
$jid = !empty($_GET['jid']) ? $_GET['jid'] : '';
?>
<h1>Data Pencekalan</h1>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pencekalan-akademik-cari-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'method' => 'get',
	'htmlOptions'=>array(
		'class' => 'form-horizontal'
	),
	'action' => $this->createUrl('pencekalan/akademik'),
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
  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right">Semester</label>
    <div class="col-sm-9">
      <?=CHtml::dropDownList('semester',$semester,$semesters);?>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right">Mata kuliah</label>
    <div class="col-sm-9">
      <select id="matkul" name="kode_mk">
        <option value=""> - Pilih Mata Kuliah - </option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right">Kelas</label>
    <div class="col-sm-9">
      <select id="jid" name="jid">
        <option value=""> - Pilih Kelas - </option>
      </select>
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
  'id'=>'pencekalan-akademik-form',
	'htmlOptions'=>array(
		'class' => 'form-horizontal'
	),
	'action' => $this->createUrl('pencekalan/simpanCekalAkademik'),
)); ?>

<input type="hidden" name="kampus" value="<?=!empty($_GET['kampus']) ? $_GET['kampus'] : 0;?>"/>
<input type="hidden" name="kode_prodi" value="<?=!empty($_GET['kode_prodi']) ? $_GET['kode_prodi'] : 0;?>"/>
<input type="hidden" name="kode_mk" value="<?=!empty($_GET['kode_mk']) ? $_GET['kode_mk'] : 0;?>"/>
<input type="hidden" name="semester" value="<?=!empty($_GET['semester']) ? $_GET['semester'] : 0;?>"/>
<input type="hidden" name="jid" value="<?=!empty($_GET['jid']) ? $_GET['jid'] : 0;?>"/>
<table class="table table-striped table-bordered" id="table-mahasiswa">

  <thead>
    <tr>
      <th >No</th>
      <th >NIM</th>
      <th >Nama</th>
      <th >Akademik</th>
      <th >Keterangan</th>
      
    </tr>
  </thead>
  <tbody>
  	<?php 

  	foreach($results as $q=>$item)
  	{
      // print_r($item);exit;
  		// $cekal = Pencekalan::model()->findByAttributes([
  		// 	'tahun_id' => $tahunaktif,
  		// 	'nim' => $item->nim
  		// ]);
  		$checkedTahfidz = '';
  		$checkedAdm = '';
  		$checkedAkpam = '';
  		$checkedAkademik = '';
  		// if(!empty($cekal))
  		// {
  			// $checkedTahfidz = $cekal->tahfidz ? 'checked' :'';
  			// $checkedAkpam = $cekal->akpam  ? 'checked' :'';
  			// $checkedAdm = $cekal->adm  ? 'Tercekal' :'';
  			$checkedAkademik = $item->is_tercekal ? 'checked' :'';	
  		// }
  		
  	?>
<tr>
	<td><?=$q+1;?></td>
	<td><?=$item->nim;?></td>
	<td><?=$item->nm;?></td>
	<td><input type="checkbox" name="akademik_<?=$item->id;?>" <?=$checkedAkademik;?>></td>
  <td><input type="text" name="keterangan_tercekal_<?=$item->id;?>" value="<?=$item->ket;?>"/></td>
</tr>
  	<?php 
  }
  	?>
</tbody>
</table>
	 <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">

          <button class="btn btn-info" type="submit" value="1" name="btn-simpan" id="btn-simpan">
            <i class="ace-icon glyphicon glyphicon-check bigger-110"></i>
            Simpan Data
          </button>
          
        
        </div>
      </div>
	</div>
</div>


 <?php $this->endWidget(); ?>

<script type="text/javascript">

function getMk(prodi, smt,kampus){
  

  $.ajax({
    url : '<?=Yii::app()->createUrl('mastermatakuliah/ajaxMkAvailable');?>',
    type : 'POST',
    data : 'semester='+smt+'&prodi='+prodi+'&kampus='+kampus,
    beforeSend : function(){

    },
    success : function(data){
      var data = $.parseJSON(data);

      $('#matkul').empty();

      var row = '';
      $.each(data, function(i,obj){
        row += '<option value="'+obj.id+'">'+obj.id+' - '+obj.value+'</option>';
      });

      $('#matkul').append(row);

      $('#matkul').val('<?=$matkul;?>');
      var kampus = $('#kampus').val();
      getKelas(prodi,smt,'<?=$matkul;?>',kampus);
    }
  });
}

function getKelas(prodi, smt,mk,kampus){
  

  $.ajax({
    url : '<?=Yii::app()->createUrl('mastermatakuliah/ajaxKelasAvailable');?>',
    type : 'POST',
    data : 'semester='+smt+'&prodi='+prodi+'&kode_mk='+mk+'&kampus='+kampus,
    beforeSend : function(){

    },
    success : function(data){
      var data = $.parseJSON(data);

      $('#jid').empty();

      var row = '';
      $.each(data, function(i,obj){
        row += '<option value="'+obj.id+'">'+obj.value+' - '+obj.dsn+'</option>';
      });

      $('#jid').append(row);

      $('#jid').val('<?=$jid;?>');
    }
  });
}

  $(document).ready(function(){

    $('#btn-simpan').click(function(e){
      e.preventDefault();

      Swal.fire({
        title: 'Anda yakin ingin mencekal mahasiswa ini ?',
        text: "Proses ini tidak bisa ditarik kembali. Mahasiswa tercekal akan otomatis mendapat nilai E.",
        icon: 'warning',
        showCancelButton: true,
        width:'50%',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, cekal sekarang!',
        cancelButtonText: 'Tidak, batalkan'
      }).then((result) => {
        if (result.value) {
          $('#pencekalan-akademik-form').submit();
        }

      });
    });

    $('.alert').fadeOut(2000);

    var prodi = $('#kode_prodi').val();
    var smt = $('#semester').val();
    var kampus = $('#kampus').val();
    getMk(prodi, smt,kampus);

    

    $('#semester, #kode_prodi').change(function(){
      var prodi = $('#kode_prodi').val();
      var smt = $('#semester').val();
      var kampus = $('#kampus').val();
      getMk(prodi, smt,kampus);

    });

     $('#matkul').change(function(){
      var prodi = $('#kode_prodi').val();
      var smt = $('#semester').val();
      var mk = $('#matkul').val();
      var kampus = $('#kampus').val();
      getKelas(prodi,smt,mk,kampus);
      
    });
  });
</script>