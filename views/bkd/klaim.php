<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>
<h1>Klaim Kegiatan BKD</h1>
<p>
    <?= Html::dropDownList('tahun','', [], ['id' => 'tahun_list','prompt'=>'- Pilih Tahun -']) ?>
</p>
<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				Pengajaran
			</div>
			<div class="panel-body">
				<table class="table" id="tabel-pengajaran">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode MK</th>
							<th>Nama MK</th>
							<th>SKS</th>
							<th>Kelas</th>
							<th>Prodi</th>
							<th>TA</th>
							<th>SKS BKD</th>
							<th>Klaim</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
					
				</table>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				Publikasi Karya/HKI
			</div>
			<div class="panel-body">
				<table class="table" id="tabel-publikasi">
					<thead>
						<tr>
							<th>No</th>
							<th>Judul</th>
							<th>Jenis Publikasi</th>
							<th>Tanggal terbit</th>
							<th>Tautan</th>
							<th>Vol/Nomor/Hal</th>
							<th>Penerbit</th>
							<th>DOI</th>
							<th>ISSN</th>
							<th>SKS BKD</th>
							<th>Klaim</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
					
				</table>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				Pengabdian
			</div>
			<div class="panel-body">
				<table class="table" id="tabel-pengabdian">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>SKIM</th>
                            <th>Tahun Kegiatan</th>
                            <th>Tempat Kegiatan</th>
                            <th>SKS BKD</th>
                            <th>Klaim</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                    
                </table>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				Penunjang
			</div>
			<div class="panel-body">
				<table class="table" id="tabel-penunjang">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kegiatan</th>
                            <th>SKS BKD</th>
                            <th>Klaim</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                    
                </table>
			</div>
		</div>
	</div>
</div>



<?php 

$this->registerJs(' 

$(document).on("click",".btn-claim-pengelolaJurnal",function(e){
    e.preventDefault()

    var obj = new Object
    obj.id = $(this).data("item")
    obj.is_claimed = "0";
    if($(this).is(":checked"))
        obj.is_claimed = "1"

    $.ajax({
        type : \'POST\',
        data : {
            dataPost : obj
        },
        url : \''.Url::to(['bkd/ajax-claim-pengelola-jurnal']).'\',
        async: true,
        beforeSend : function(){

        },
        success: function(res){
            var res = $.parseJSON(res);
            $("#tahun_list").trigger("change")
        }

    });

})

$(document).on("click",".btn-claim-organisasi",function(e){
    e.preventDefault()

    var obj = new Object
    obj.id = $(this).data("item")
    obj.is_claimed = "0";
    if($(this).is(":checked"))
        obj.is_claimed = "1"

    $.ajax({
        type : \'POST\',
        data : {
            dataPost : obj
        },
        url : \''.Url::to(['bkd/ajax-claim-organisasi']).'\',
        async: true,
        beforeSend : function(){

        },
        success: function(res){
            var res = $.parseJSON(res);
            $("#tahun_list").trigger("change")
        }

    });

})

$(document).on("click",".btn-claim-pengabdian",function(e){
    e.preventDefault()

    var obj = new Object
    obj.id = $(this).data("item")
    obj.is_claimed = "0";
    if($(this).is(":checked"))
        obj.is_claimed = "1"

    $.ajax({
        type : \'POST\',
        data : {
            dataPost : obj
        },
        url : \''.Url::to(['bkd/ajax-claim-pengabdian']).'\',
        async: true,
        beforeSend : function(){

        },
        success: function(res){
            var res = $.parseJSON(res);
            $("#tahun_list").trigger("change")
        }

    });

})

$(document).on("click",".btn-claim-publikasi",function(e){
    e.preventDefault()

    var obj = new Object
    obj.id = $(this).data("item")
    obj.is_claimed = "0";
    if($(this).is(":checked"))
    	obj.is_claimed = "1"

    $.ajax({
        type : \'POST\',
        data : {
            dataPost : obj
        },
        url : \''.Url::to(['bkd/ajax-claim-publikasi']).'\',
        async: true,
        beforeSend : function(){

        },
        success: function(res){
            var res = $.parseJSON(res);
            $("#tahun_list").trigger("change")
        }

    });

})

$(document).on("click",".btn-claim",function(e){
    e.preventDefault()

    var obj = new Object
    obj.id = $(this).data("item")
    obj.is_claimed = "0";
    if($(this).is(":checked"))
    	obj.is_claimed = "1"

    $.ajax({
        type : \'POST\',
        data : {
            dataPost : obj
        },
        url : \''.Url::to(['bkd/ajax-claim']).'\',
        async: true,
        beforeSend : function(){

        },
        success: function(res){
            var res = $.parseJSON(res);
            $("#tahun_list").trigger("change")
        }

    });

})

function fetchJadwal(tahun, callback){
    let obj = new Object;
    // obj.prodi_id = id;
    obj.tahun = tahun;
    $.ajax({
        type : \'POST\',
        data : {
            dataPost : obj
        },
        url : \''.Url::to(['pengajaran/ajax-jadwal']).'\',
        async: true,
        beforeSend : function(){
            Swal.showLoading()
        },
        error : function(e){

            Swal.fire({
              title: \'Oops!\',
              icon: \'error\',
              text: e.responseText
            }).then((result) => {
              if (result.value) {
                 
              }
            });
            Swal.hideLoading();
        },
        success: function(res){
            
            var res = $.parseJSON(res);
            if(res)
                callback(null, res)
            else
                callback(res, null)
        }

    });
}

function getPublikasi(tahun){
	

    $.ajax({
        type : \'POST\',
        
        url : \''.Url::to(['publikasi/ajax-list']).'\',
        async: true,
        beforeSend : function(){

        },
        success: function(res){
            var res = $.parseJSON(res);
            var row = ""
            $("#tabel-publikasi > tbody").empty()
            var total_sks = 0
            $.each(res, function(i,obj){
            	let isClaimed = obj.is_claimed == 1 ? "checked" : "";
                row += "<tr>"
                row += "<td>"+(i+1)+"</td>"
                row += "<td>"+obj.judul_publikasi_paten+"</td>"
                row += "<td>"+obj.nama_jenis_publikasi+"</td>"
                row += "<td>"+obj.tanggal_terbit+"</td>"
                row += "<td><a href=\'"+obj.tautan+"\' target=\'_blank\'>Link</a></td>"
                row += "<td>"+obj.volume+" / "+obj.nomor+" / "+obj.halaman+"</td>"
                row += "<td>"+obj.penerbit+"</td>"
                row += "<td><a href=\'"+obj.doi+"\' target=\'_blank\'>Link</a></td>"
                row += "<td>"+obj.issn+"</td>"
                row += "<td></td>"
                row += "<td><input type=\'checkbox\' "+isClaimed+" data-item=\'"+obj.id+"\' class=\'btn-claim-publikasi\'/></td>"
                row += "</tr>"

            })

            $("#tabel-publikasi > tbody").append(row)
                
        }

    });
}

function getPengabdian(tahun){
    
    var obj = new Object;
    obj.tahun = tahun;
    $.ajax({
        type : \'POST\',
        data : {
            dataPost : obj
        },
        url : \''.Url::to(['pengabdian/ajax-list']).'\',
        async: true,
        beforeSend : function(){

        },
        success: function(res){
            var res = $.parseJSON(res);
            var row = ""
            $("#tabel-pengabdian > tbody").empty()
            var total_sks = 0
            $.each(res, function(i,obj){
                let isClaimed = obj.is_claimed == 1 ? "checked" : "";
                row += "<tr>"
                row += "<td>"+(i+1)+"</td>"
                row += "<td>"+obj.judul_penelitian_pengabdian+"</td>"
                row += "<td>"+obj.nama_skim+"</td>"
                row += "<td>"+obj.tahun_kegiatan+"</td>"
                row += "<td>"+obj.tempat_kegiatan+"</td>"
                row += "<td>"+obj.nilai+"</td>"
                row += "<td><input type=\'checkbox\' "+isClaimed+" data-item=\'"+obj.ID+"\' class=\'btn-claim-pengabdian\'/></td>"
                row += "</tr>"

            })

            $("#tabel-pengabdian > tbody").append(row)
                
        }

    });
}



function getPenunjang(tahun){
    $("#tabel-penunjang > tbody").empty()
    var obj = new Object;
    obj.tahun = tahun;
    var counter = 0;
    $.ajax({
        type : \'POST\',
        data : {
            dataPost : obj
        },
        url : \''.Url::to(['organisasi/ajax-list']).'\',
        async: true,
        beforeSend : function(){

        },
        success: function(res){
            var res = $.parseJSON(res);
            var row = ""
            var total_sks = 0
            $.each(res, function(i,obj){
                let isClaimed = obj.is_claimed == 1 ? "checked" : "";
                counter++;
                row += "<tr>"
                row += "<td>"+(counter)+"</td>"
                row += "<td>Menjadi "+obj.jabatan+" pada organisasi "+obj.organisasi+" dari tanggal "+obj.tanggal_mulai_keanggotaan+" hingga tanggal "+obj.selesai_keanggotaan+"</td>"
                row += "<td>"+obj.sks_bkd+"</td>"
                row += "<td><input type=\'checkbox\' "+isClaimed+" data-item=\'"+obj.ID+"\' class=\'btn-claim-organisasi\'/></td>"
                row += "</tr>"

            })

            $("#tabel-penunjang > tbody").append(row)
                
        }

    });

    $.ajax({
        type : \'POST\',
        data : {
            dataPost : obj
        },
        url : \''.Url::to(['pengelola-jurnal/ajax-list']).'\',
        async: true,
        beforeSend : function(){

        },
        success: function(res){
            var res = $.parseJSON(res);
            var row = ""
            
            var total_sks = 0
            $.each(res, function(i,obj){
                let isClaimed = obj.is_claimed == 1 ? "checked" : "";
                counter++;
                row += "<tr>"
                row += "<td>"+(counter)+"</td>"
                row += "<td>Menjadi "+obj.peran_dalam_kegiatan +" pada "+obj.nama_media_publikasi+" dari tanggal "+obj.tgl_sk_tugas+" hingga tanggal "+obj.tgl_sk_tugas_selesai+"</td>"
                row += "<td>"+obj.sks_bkd+"</td>"
                row += "<td><input type=\'checkbox\' "+isClaimed+" data-item=\'"+obj.id+"\' class=\'btn-claim-pengelolaJurnal\'/></td>"
                row += "</tr>"

            })

            $("#tabel-penunjang > tbody").append(row)
                
        }

    });
}

function getJadwal(tahun){
	var obj = new Object
    obj.tahun = tahun

    $.ajax({
        type : \'POST\',
        data : {
            dataPost : obj
        },
        url : \''.Url::to(['pengajaran/ajax-local-jadwal']).'\',
        async: true,
        beforeSend : function(){

        },
        success: function(res){
            var res = $.parseJSON(res);
            var row = ""
            $("#tabel-pengajaran > tbody").empty()
            var total_sks = 0
            $.each(res, function(i,obj){
            	let isClaimed = obj.is_claimed == 1 ? "checked" : "";
                row += "<tr>"
                row += "<td>"+(i+1)+"</td>"
                row += "<td>"+obj.kode_mk+"</td>"
                row += "<td>"+obj.matkul+"</td>"
                row += "<td>"+obj.sks+"</td>"
                row += "<td>"+obj.kelas+"</td>"
                row += "<td>"+obj.jurusan+"</td>"
                row += "<td>"+obj.tahun_akademik+"</td>"
                row += "<td>"+obj.sks+"</td>"
                row += "<td><input type=\'checkbox\' "+isClaimed+" data-item=\'"+obj.ID+"\' class=\'btn-claim\'/></td>"
                row += "</tr>"

                total_sks += eval(obj.sks)
            })

            $("#tabel-pengajaran > tbody").append(row)
                
        }

    });
}

$(document).on("change","#tahun_list",function(e){
    e.preventDefault()

    getJadwal($(this).val())
    getPublikasi($(this).val())
    getPengabdian($(this).val())
    getPenunjang($(this).val())
})

getTahunList(function(err, res){
    $("#tahun_list").empty()
    var row = ""
    $.each(res, function(i, obj){
        row += "<option value=\'"+obj.tahun_id+"\'>"+obj.nama_tahun+"</option>"
    })

    $("#tahun_list").append(row)


    $("#tahun_list").trigger("change")
})

function getTahunList(callback){
    $.ajax({
        type : \'POST\',
        
        url : \''.Url::to(['site/ajax-tahun-list']).'\',
        async: true,
        beforeSend : function(){

        },
        success: function(res){
            var res = $.parseJSON(res);
            callback(null, res)
        }

    });
}
', \yii\web\View::POS_READY);

?>