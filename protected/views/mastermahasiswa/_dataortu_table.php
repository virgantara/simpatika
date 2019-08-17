

<?php 
	if($xls == 'y'){
header('Content-type: application/excel');
header('Content-Disposition: attachment; filename='.$filename);
header("Content-Transfer-Encoding: BINARY");
	}
?>



<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jam-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,	
	'action' => $this->createUrl('mastermahasiswa/updatebio'),
)); ?>
<?php 
foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="alert alert-success">' . $message . "</div>\n";
}
    ?>
<table class="table table-striped table-bordered">
<?php 
$kampus = $_GET['kampus'] ?: '';
$kode_prodi = $_GET['kode_prodi'] ?: '';
$ta_masuk = $_GET['ta_masuk'] ?: '';
$tgl_masuk = $_GET['tgl_masuk'] ?: '';
echo CHtml::hiddenField('kampus',$kampus);
echo CHtml::hiddenField('kode_prodi',$kode_prodi);
echo CHtml::hiddenField('ta_masuk',$ta_masuk);
echo CHtml::hiddenField('tgl_masuk',$tgl_masuk);
 ?> 
  <thead>
    <tr>
      <th width="3%">No</th>
       <th width="5%">NIM</th>
      
     
      <th width="30%">Nama</th>
      <th>Tmpt Lhr</th>
      <th>Tgl Lhr</th>
      <th>JK</th>
      <th width="15%">Kecamatan</th>
      <th width="15%">Kecamatan<br>SIAKAD</th>
      <th width="15%">Kota</th>
      <th width="15%">Kota<br>SIAKAD</th>
      <th width="15%">Provinsi</th>
      <th width="15%">Prov<br>SIAKAD</th>
      <th width="5%">KTP</th>
      <th width="5%">Negara</th>
      <th>Data Ortu<br>
      Yg Sudah</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>
 <?php

$i = 0;
foreach($mahasiswas as $m)
{

	$q = $m->agama ?: 'I';
	$agama = $list_agama[$q];

	$jml_ortu = count($m->ortus);
	$bg = '';

	switch ($jml_ortu) {
		case 1:
			$bg = 'background-color: orange;color:white';
			break;
		case 2:
			$bg = 'background-color: green;color:white';
			break;
		default:
			$bg = 'background-color: red;color:white';
			break;
	}

	$sudah_input = !empty($m->kecamatan_feeder) ? 'success' : 'danger';
?>
<tr>
<td width="3%"><?=($i+1);?></td>

<td width="5%"><?php echo $m->nim_mhs;?>
	
	<a class="btn btn-success btn-xs btn-block sync" data-item="<?=$m->nim_mhs;?>" href="javascript:void(0)"><i class="glyphicon glyphicon-refresh"></i>  Sync to Feeder</a>
	<span class="loading" style="display: none">Syncing...</span>
</td>
<td><?php echo $m->nama_mahasiswa;?></td>
<td>
<input type="text" size="10" name="tempat_lahir_<?=$m->nim_mhs;?>" value="<?=$m->tempat_lahir ?: '';?>" />
</td>
<td>
<input type="text" size="10"  class="datepicker" name="tgl_lahir_<?=$m->nim_mhs;?>" value="<?=$m->tgl_lahir ?: '';?>" />
</td>
<td><?php echo $m->jenis_kelamin;?></td>

<td width="15%">
	<input type="text" class="input kecamatan"/>
	<input type="hidden" class="input id_kecamatan" value="<?=$m->kecamatan_feeder ?: '';?>" name="id_kecamatan_<?=$m->nim_mhs;?>" />
	<input type="hidden" class="input id_induk"/>
	<input type="hidden" class="input nama_kecamatan" name="nama_kecamatan_<?=$m->nim_mhs;?>"/>
</td>
<td width="15%" >
	<div class="alert alert-<?=$sudah_input;?>">
	<?=$m->kecamatan;?>
		</div>
	</td>
<td width="15%">
	<input type="text" readonly class="input kota"/>
	<input type="hidden" class="input id_induk_kota"/>
</td>
<td width="15%"><?=$m->kabupaten;?></td>
<td width="15%"><input readonly type="text" class="input propinsi"/></td>
<td width="15%"><?=$m->provinsi;?></td>
<td width="5%">
<input type="text" size="10" name="ktp_<?=$m->nim_mhs;?>" value="<?=$m->ktp ?: '';?>" />
</td>
<td>
	<input type="text" size="10" class="negara input" />
<input type="hidden" size="10" name="id_negara_<?=$m->nim_mhs;?>" value="<?=$m->ktp ?: '';?>" />
</td>

<td>
	<?php 

	if(count($m->ortus) > 1)
	{
		echo '<div class="alert alert-success">';
		foreach($m->ortus as $ortu)
			echo $ortu->hubungan.'<br>';

		echo '</div>';
	}
	else if(count($m->ortus) > 0)
	{
		echo '<div class="alert alert-warning">';
		foreach($m->ortus as $ortu)
			echo $ortu->hubungan;
		echo '</div>';
	}
	else{
		echo '<div class="alert alert-danger">BELUM LENGKAP</div>';
	}
	?>
</td>
<td>
	<a class="btn btn-info btn-xs btn-block" href="<?=Yii::app()->createUrl('mahasiswaOrtu/create',[
	'kode_prodi'=>$kode_prodi,
	'kampus'=>$kampus,
	'ta_masuk'=>$ta_masuk,
	'tgl_masuk' => $tgl_masuk,
	'nim'=>$m->nim_mhs
	]);?>"><i class="glyphicon glyphicon-plus"></i> Input</a>
	<a class="btn btn-success btn-xs btn-block list-ortu" href="<?=Yii::app()->createUrl('mahasiswaOrtu/admin',['nim'=>$m->nim_mhs]);?>"><i class="glyphicon glyphicon-list"></i>  List</a>
	
</td>
</tr>
		
	<?php
	$i++;
}			
?>

  </tbody>

</table>
<?= CHtml::submitButton('Update',['class'=>'btn btn-info']); ?>
<?php $this->endWidget(); ?>


<script type="text/javascript">
function popitup(url,label) {
    var w = screen.width * 0.8;
    var h = 800;
    var left = (screen.width - w) / 2;
    var top = (screen.height - h) / 2;
    
    window.open(url,label,'height='+h+',width='+w+',top='+top+',left='+left);
    
}
	$(document).ready(function(){
		$( ".datepicker" ).datepicker({
			'dateFormat' : 'yy-mm-dd'
		});

		$('.sync').click(function(){
			var nim = $(this).attr('data-item');
			var stat = $(this).next();
			$.ajax({
				type : 'POST',
                url: "<?php echo Yii::app()->createUrl('mastermahasiswa/ajaxSync');?>",
                // dataType: "json",
                data: 'nim='+nim,
                beforeSend: function(){
                	stat.show();
                },
                error : function(e){
                	stat.hide();
                },
                success: function (data) {
                    stat.hide();
                    var hsl = $.parseJSON(data);
                    if(hsl.status == 200)
                    	alert(JSON.stringify(hsl.values.output.result));
                    else{
                    	alert(hsl);
                    }
                }
	        });
		});

		$('.list-ortu').click(function(e){
			e.preventDefault();
			var url = $(this).attr('href');
	        popitup(url,'List Ortu');
		});

		$('.negara').autocomplete({
	      minLength:1,
	      select:function(event, ui){
	      	var obj = $(this);
	        obj.next().val(ui.item.id);
	        
	      },
	      
	      focus: function (event, ui) {
	      	$(this).next().val(ui.item.id);
	       //  $('#kode_dosen').val(ui.item.id);
	       // $('#nama_dosen').val(ui.item.value);
	      },
	      source:function(request, response) {
	        	$.ajax({
	                url: "<?php echo Yii::app()->createUrl('mastermahasiswa/AjaxFindNegara');?>",
	                dataType: "json",
	                data: {
	                    term: request.term,
	                },
	                success: function (data) {
	                    response(data);
	                }
	            })
	        },
	       
	  	}); 

		$('.kecamatan').autocomplete({
	      minLength:1,
	      select:function(event, ui){
	      	var obj = $(this);
	        obj.next().val(ui.item.id);
	        obj.next().next().val(ui.item.id_induk_wilayah);
	        var kec = obj.next().next().next();
	        kec.val(ui.item.value.split(" - ")[1]);
	        
	        $.ajax({
                url: "<?php echo Yii::app()->createUrl('mastermahasiswa/AjaxFindWilayahOne');?>",
                dataType: "json",
                data: {
                    term: ui.item.id_induk_wilayah,
                },
                beforeSend : function(){
                	var kota = obj.parent().next().next().find('.kota');
                    kota.val('');
                },
                success: function (data) {
                	var kota = obj.parent().next().next().find('.kota');
                    kota.val(data[0].value);
                    var induk_kota = kota.next();
                    
                    if(data[0].id_induk_wilayah != '000000')
                    {
	                    $.ajax({
			                url: "<?php echo Yii::app()->createUrl('mastermahasiswa/AjaxFindWilayahOne');?>",
			                dataType: "json",
			                data: {
			                    term: data[0].id_induk_wilayah,
			                },
			                beforeSend : function(){
			                	var prop = obj.parent().next().next().next().next().find('.propinsi');
			                    prop.val('');
			                },
			                success: function (data) {
			                	var prop = obj.parent().next().next().next().next().find('.propinsi');
			                    prop.val(data[0].value);
			                }
			            });
		            }
                }
            });
	        
	      },
	      
	      focus: function (event, ui) {
	      	$(this).next().val(ui.item.id);
	      	$(this).next().val(ui.item.id_induk_wilayah);
	       //  $('#kode_dosen').val(ui.item.id);
	       // $('#nama_dosen').val(ui.item.value);
	      },
	      source:function(request, response) {
	        $.ajax({
	                url: "<?php echo Yii::app()->createUrl('mastermahasiswa/AjaxFindWilayah');?>",
	                dataType: "json",
	                data: {
	                    term: request.term,
	                },
	                success: function (data) {
	                    response(data);
	                }
	            })
	        },
	       
	  	}); 
	});
</script>
