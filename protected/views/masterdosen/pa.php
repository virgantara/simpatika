
<div class="row">
<div class="col-lg-offset-3 col-lg-6" data-step="1" data-intro="Fitur Baru. Pemetaan Dosen Pembimbing Akademik">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pa-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class' => 'form-horizontal'
	),
	'method' => 'get',
	'action' => $this->createUrl('masterdosen/pa'),
)); 
?>

	
	<div class="form-group" >
		<label class="col-sm-3 control-label no-padding-right">Kelas</label>
			<div class="col-sm-9 col-lg-4">
		<?php 
		$list = CHtml::listData(Kampus::model()->findAll(), 'kode_kampus', 'nama_kampus');
		echo CHtml::dropDownList('kampus',!empty($_GET['kampus']) ? $_GET['kampus'] : '',$list,array('empty' => '(Pilih Kelas)','class'=>'form-control','data-intro'=>'Pilih Kelas')); 
		// echo $form->textField($model,'prodi',array('size'=>10,'maxlength'=>10)); 
		?>
		</div>
	</div>	
	<div class="form-group" >
		<label class="col-sm-3 control-label no-padding-right">Fakultas</label>
			<div class="col-sm-9 col-lg-4">
		<?php 
		$list = CHtml::listData(Masterfakultas::model()->findAll(), 'kode_fakultas', function($dsn) {
		    return ($dsn->nama_fakultas);
		});
		echo CHtml::dropDownList('fakultas',!empty($_GET['fakultas']) ? $_GET['fakultas'] : '',$list,['class'=>'form-control','data-intro'=>'Pilih Fakultas']); 
		// echo $form->textField($model,'fakultas',array('size'=>7,'maxlength'=>7)); 
		?>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Prodi</label>
			<div class="col-sm-9 col-lg-4">
		<?php 
		$prodis = array();

		echo CHtml::dropDownList('prodi',!empty($_GET['prodi']) ? $_GET['prodi'] : '',$prodis,array('empty' => '(Pilih  prodi)','class'=>'form-control','data-intro'=>'Pilih Prodi')); 
		// echo $form->textField($model,'prodi',array('size'=>10,'maxlength'=>10)); 
		?>
		</div>
	</div>



	<div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">

          <button class="btn btn-info" type="submit" data-intro="Klik Tombol Ini">
            <i class="ace-icon glyphicon glyphicon-search bigger-110"></i>
            Tampilkan Mahasiswa
          </button>
      
		</div>
	</div>


</div><!-- form -->
<div class="row form">
	<div class="col-xs-12">

<table id="tabel_mhs" class="table table-bordered table-hovered table-striped table-responsive">
	<thead>
	<tr>
		<th>No</th>
		<th>NIM</th>
		<th>Nama Mahasiswa</th>
		<th>JK</th>
		<th>Semester</th>
		<th>Opsi</th>
	</tr>
</thead>
<tbody>
	<?php 
	$i=0;
	if(!empty($result)){
	foreach($result as $m)
	{
		$i++;

		$intro = '';
		if($i==1)
			$intro = 'data-intro="Ketik Nama Dosen PA"';
		
		$d = Masterdosen::model()->findByPk($m->nip_promotor);
	?>
	<tr>
		<td><?=($i);?></td>
		<td><?=$m->nim_mhs;?>
		</td>
		<td><?=$m->nama_mahasiswa;?></td>
		<td><?=$m->jenis_kelamin;?></td>
		<td><?=$m->semester;?></td>
		<td>
			<input <?=$intro;?> type="text" value="<?=!empty($d) ? $d->nama_dosen : '';?>" class="nama_dosen" placeholder="Ketik Nama Dosen" />
			<input type="hidden" value="<?=!empty($d) ? $d->id : '';?>" class="kode_dosen" name="kode_dosen_<?=$m->id;?>"/>
		</td>
	</tr>
	<?php 
}
}
	?>
</tbody>
</table>

     <div class="clearfix form-actions">
        <div class="col-md-offset-3" >
          <button class="btn btn-success" type="submit" id="btn-submit" data-intro="Klik Simpan Data">
            <i class="ace-icon fa fa-check bigger-110"></i>
            Simpan Data
          </button>
          <div id="info-msg" style="display: none;"></div>
          
        
        </div>
      </div>

<?php $this->endWidget(); ?>

</div>
</div>
</div>
<script type="text/javascript">

function findProdi(fak){
	$.ajax({
		type : 'POST',
		data : 'q='+fak,
		url : '<?php echo Yii::app()->createUrl('jadwal/getProdi');?>',
		success : function(data){
			$('#prodi').empty();

			var jsondata = JSON.parse(data);


			var row = '';
			$.each(jsondata,function(i,item){
				row += '<option value="'+i+'">'+item+'</option>';
			});

			$('#prodi').append(row);

			<?php 
			if(!empty($_GET['prodi'])){
				echo "$('#prodi').val(".$_GET['prodi'].")";				
			}
			?>
			

		}

	});
}

$(document).ready(function(){
// localStorage.clear();
	var introguide = introJs();
	introguide.setOptions({
		exitOnOverlayClick: false
	});
	// introguide.start();
    // // localStorage.clear();
    var doneTour = localStorage.getItem('evt_pa') === 'Completed';
    
    if(!doneTour) {
        introguide.start()

        introguide.oncomplete(function () {
            localStorage.setItem('evt_pa', 'Completed');
            Swal.fire({
              title: 'Ulangi Langkah Fitur ini ?',
              text: "",
              icon: 'warning',
              showCancelButton: true,
              width:'35%',
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, ulangi lagi!',
              cancelButtonText: 'Tidak, sudah cukup'
            }).then((result) => {
              if (result.value) {
                introguide.start();
                localStorage.removeItem('evt_pa');
              }

            });
        });

        // introguide.onexit(function () {
        //     localStorage.setItem('evt_pa', 'Completed');
        //     Swal.fire({
        //       title: 'Lewati pengenalan ini ?',
        //       text: "",
        //       icon: 'warning',
        //       showCancelButton: true,
        //       width:'35%',
        //       confirmButtonColor: '#d33',
        //       cancelButtonColor: '#3085d6',
        //       confirmButtonText: 'Ya, lewati saja!',
        //       cancelButtonText: 'Tidak, saya ingin lihat'
        //     }).then((result) => {
        //       if (!result.value) {
        //         introguide.start();
        //         localStorage.removeItem('evt_pa');
        //       }

        //     });
        // });
    }

	$('#btn-submit').click(function(e){
      e.preventDefault();
      var dataku = $('#pa-form').serialize();

      $.ajax({
        type : 'POST',
        url : '<?=Yii::app()->createUrl('masterdosen/ajaxSimpanPa');?>',
        data : {
          datapost : dataku
        },
        beforeSend : function(){
          $('#info-msg').show();
          $('#info-msg').html('Loading...');
        },
        error : function(e){
          $('#info-msg').hide();
          $('#info-msg').html('');
        },
        success : function(data){
          var hasil = $.parseJSON(data);

          if(hasil.code == 200){
            $('#info-msg').val('');
            $('#info-msg').hide();
             Swal.fire({
              icon: 'success',
              width:'40%',
              title: 'SUKSES...',
              text: hasil.message,
           });
             
           
          }

          else{
            $('#info-msg').val('');
            $('#info-msg').hide();
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              width:'40%',
              text: hasil.message,
              // footer: '<a href>Why do I have this issue?</a>'
            })
            // $('#info-msg').html('<div class="alert alert-'+hasil.short+'">'+hasil.message+'</div>');
          }

        }
      });
  });
  
	
	var fak = $('#fakultas').val();
	findProdi(fak);

	$('#fakultas').change(function(){
		var fak = $(this).val();

		findProdi(fak);
	});

	$('#prodi').change(function(){
		var prodi = $(this).val();
		findMk(prodi);
		
	});

	$('.nama_dosen').autocomplete({
      minLength:1,
      select:function(event, ui){
       
        $(this).next().val(ui.item.id);
        $(this).val(ui.item.value);
                
      },
      
      focus: function (event, ui) {
        $(this).next().val(ui.item.id);
        $(this).val(ui.item.value);
      },
      source:function(request, response) {
        $.ajax({
                url: "<?php echo Yii::app()->createUrl('masterdosen/ajaxSearchDosen');?>",
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
$(document).on('keydown','input', function(e) {
    var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
    
    if (e.ctrlKey && e.keyCode == 13) {
        $('form').submit();
    }
    else if(key == 13) {
   		e.preventDefault();

		var inputs = $(this).closest('div.form').find(':input:visible');
	          
        inputs.eq( inputs.index(this)+ 1 ).focus().select();
        // $('html, body').animate({
        //     scrollTop: $(this).offset().top - 100
        // }, 10);


    }
});

</script>