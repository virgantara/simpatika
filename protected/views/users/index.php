 <?php
$this->breadcrumbs=array(
	array('name'=>'Users','url'=>['index']),
	array('name'=>'Manage'),
);

?>
<h1>Manage Users</h1>

<script type="text/javascript">
	$(document).ready(function(){
		$('#search,#size').change(function(){
			$('#users-grid').yiiGridView.update('users-grid', {
			    url:'<?php echo Yii::app()->createUrl("Users/index"); ?>&filter='+$('#search').val()+'&size='+$('#size').val()
			});
		});
		
	});
</script>
<div class="row">
    <div class="col-xs-12">
        
            <?php    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . $message . "</div>\n";
    }
?>
                        <div class="pull-left"> </div>


                         <div class="pull-right">Data per halaman
                              <?php                            echo CHtml::dropDownList('Users[PAGE_SIZE]',isset($_GET['size'])?$_GET['size']:'',[10=>10,50=>50,100=>100,],['id'=>'size']); 
                            ?> 
                             <?php        echo CHtml::textField('Users[SEARCH]','',['placeholder'=>'Cari','id'=>'search']);
        ?> 	 </div>
                    
<?php $this->widget('application.components.ComplexGridView', array(
	'id'=>'users-grid',
	'dataProvider'=>$model->search(),
	'filter' => $model,
	'columns'=>[
	[
		'header'=>'No',
		'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)'
	],
		'role_id',
		'email',
		'username',
		'display_name',
		// 'password_hash',
		// 'reset_hash',
		'nim',
		'last_login',
		'active',
		/*
		'last_login',
		'last_ip',
		'created_on',
		'deleted',
		'reset_by',
		'banned',
		'ban_message',
		'display_name',
		'display_name_changed',
		'timezone',
		'language',
		'active',
		'activate_hash',
		'password_iterations',
		'force_password_reset',
		'nim',
		'status_data',
		'kampus',
		'fakultas',
		'prodi',
		*/
		// [
		// 	'class'=>'CButtonColumn',
		// ],
	],
	'htmlOptions'=>[
		'class'=>'table'
	],
	'pager'=>[
		'class'=>'SimplePager',
		'header'=>'',
		'firstPageLabel'=>'Pertama',
		'prevPageLabel'=>'Sebelumnya',
		'nextPageLabel'=>'Selanjutnya',
		'lastPageLabel'=>'Terakhir',
		'firstPageCssClass'=>'btn btn-info',
		'previousPageCssClass'=>'btn btn-info',
		'nextPageCssClass'=>'btn btn-info',
		'lastPageCssClass'=>'btn btn-info',
		'hiddenPageCssClass'=>'disabled',
		'internalPageCssClass'=>'btn btn-info',
		'selectedPageCssClass'=>'btn btn-sky',
		'maxButtonCount'=>5
	],
	'itemsCssClass'=>'table  table-bordered table-hover',
	'summaryCssClass'=>'table-message-info',
	'filterCssClass'=>'filter',
	'summaryText'=>'menampilkan {start} - {end} dari {count} data',
	'template'=>'{items}{summary}{pager}',
	'emptyText'=>'Data tidak ditemukan',
	'pagerCssClass'=>'pagination pull-right no-margin',
)); ?>


	</div>
</div>

