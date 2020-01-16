
	<style type="text/css">
		body { font-family: Helvetica, sans-serif; }
		h2, h3 { margin-top:0; }
		form { margin-top: 15px; }
		form > input { margin-right: 15px; }
		video{
			width: 300px;
			height: 400px;
		}
		#results { float:right; margin:20px; padding:20px; border:1px solid; background:#ccc; }
	</style>
	<div id="results">Your captured image will appear here...</div>
	
	<h1>WebcamJS Test Page</h1>
	<h3>Demonstrates simple 320x240 capture &amp; display</h3>
	
	<div id="my_camera"></div>
	
	<!-- First, include the Webcam.js JavaScript Library -->
	<script type="text/javascript" src="<?=Yii::app()->baseUrl;?>/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?=Yii::app()->baseUrl;?>/js/webcam.js"></script>
	
	<!-- Configure a few settings and attach camera -->
	<script language="JavaScript">
		Webcam.set({
			width: 300,
			height: 400,
			image_format: 'jpeg',
			jpeg_quality: 90
		});
		Webcam.attach( '#my_camera' );
	</script>
	
	<!-- A button for taking snaps -->
	
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'foto-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); 

// echo $form->fileField($model, 'uploadedFile');
?>
	
		<input type="button" value="Take Snapshot" onClick="take_snapshot()">

<?php $this->endWidget(); ?>
	
	<!-- Code to handle taking the snapshot and displaying it locally -->
<script language="JavaScript">
	function b64toBlob(b64Data, contentType, sliceSize) {
        contentType = contentType || '';
        sliceSize = sliceSize || 512;

        var byteCharacters = atob(b64Data);
        var byteArrays = [];

        for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
            var slice = byteCharacters.slice(offset, offset + sliceSize);

            var byteNumbers = new Array(slice.length);
            for (var i = 0; i < slice.length; i++) {
                byteNumbers[i] = slice.charCodeAt(i);
            }

            var byteArray = new Uint8Array(byteNumbers);

            byteArrays.push(byteArray);
        }

      	var blob = new Blob(byteArrays, {type: contentType});
      	return blob;
	}

	function take_snapshot() {
		// take snapshot and get image data
		Webcam.snap( function(data_uri) {
			// display results in page
			document.getElementById('results').innerHTML = 
				'<h2>Here is your image:</h2>' + 
				'<img  src="'+data_uri+'"/>';

			var block = data_uri.split(";");
// Get the content type of the image
			var contentType = block[0].split(":")[1];// In this case "image/gif"
			// get the real base64 content of the file
			var realData = block[1].split(",")[1];// In this case "R0lGODlhPQBEAPeoAJosM...."
			 var form = document.getElementById("foto-form");

			// Convert it to a blob to upload
			var blob = b64toBlob(realData, contentType);
			var fd = new FormData(form);
            fd.append("image", blob);
            $.ajax({
                url:"<?=Yii::app()->createUrl('utils/test');?>",
                data: fd,// the formData function is available in almost all new browsers.
                type:"POST",
                contentType:false,
                processData:false,
                cache:false,
                dataType:"json", // Change this according to your response from the server.
                // error:function(err){
                //     console.error(err);
                // },
                success:function(data){
                    console.log(data);
                },
                complete:function(){
                    console.log("Request finished.");
                }
            });

			// document.getElementById('KartuForm_uploadedFile').value = blob;
			// console.log(blob);
			// document.getElementById('foto-form').submit();
			// $('#foto-form').submit();			
		} );
	}
</script>
