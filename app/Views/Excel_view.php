<!DOCTYPE html>
<html lang="en">
	<?php $session = \Config\Services::session(); ?>
<head>
	<meta charset="UTF-8">
	<title>Excel Upload</title>
	<meta name="description" content="excel upload">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?php echo base_url('assets/bootstrap4/dist/css/bootstrap.min.css');?>" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" >
	<link href="<?php echo base_url('assets/bootstrap4/dist/css/bootstrap-grid.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/bootstrap4/dist/css/bootstrap-reboot.css');?>" rel="stylesheet">
	<script src="<?php echo base_url('assets/js/jquery-3.6.0.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bootstrap4/dist/js/bootstrap.js');?>"></script>
	
</head>
<body>
	<div class="container">
		<div class="row pt-3">
			<div class="col-6">
				<div id="errorHandler"></div>
				<div class="card">
					<div class="card-header">
						Excel Upload
						<div style="width: 18px;height: 18px;" id="loader" class="spinner-border text-primary" role="status">
							<span class="sr-only">Loading...</span>
						</div>
					</div>
					<div class="card-body">
						<form method="post" action="<?php echo site_url('exportExcel')?>" enctype="multipart/form-data">
							<div class="form-group">
								<div class="custom-file">
									<input type="file" class="custom-file-input"  name="files" id="excelUpload">
									<label class="custom-file-label" id="browseName">Choose file</label>
								</div>
							</div>
							<button type="submit" id="submitBtn" class="btn btn-primary">Upload</button>
						</form> 
					</div>
				</div>
			</div>
			<div class="col-6">
				<?php 
				$validation = $session->getFlashdata('error');
				if(isset($validation)){
					echo '<div class="alert alert-danger" role="alert">'.$validation.'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
  					</button></div>';
				}
				$validation = $session->getFlashdata('success');
				if(isset($validation)){
					echo '<div class="alert alert-success" role="alert">'.$validation.'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
  					</button></div>';
				}
				?>
			</div>
		</div>
	</div>	
</body>
</html>
<script>
	$(document).ready(function(){
		console.log( "ready!" );
	});

	$(document).on('change','#excelUpload',function(e){
		console.log( e.target.files[0],"test" );
		$('#submitBtn').prop('disabled',false);
		var fileName = e.target.files[0].name;
		var filextension = fileName.split('.')[1];
		$('#browseName').text(fileName);
		console.log(filextension,"SDFF");
		if(filextension !== 'xlsx' && filextension !== "csv"){
			$('#errorHandler').append('<div class="alert alert-danger" role="alert">Error, use only xlsx,csv format files !</div>');
			setTimeout(function(){ $('#errorHandler').empty(); }, 4000);
			$('#submitBtn').prop('disabled',true);
		}
	});
	$(document).on('click','#submitBtn',function(e){
		$('#loader').css({"visibility":"visible"});
	});
</script>
<style>
	body::after{
		content: "";
		background-image: url('http://ib1.keep4u.ru/b/070815/ef2714da63d5940bf5.jpg');
		background-repeat: no-repeat;
		background-position: 50% 0;
		background-size: cover;
		opacity: 0.6;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
		position: absolute;
		z-index: -1; 
		position: absolute;
	}
	.listing_error li{
		padding: 5px;
		background:red;
		color:black;
	}
	#loader{
		visibility:hidden;
	}
</style>