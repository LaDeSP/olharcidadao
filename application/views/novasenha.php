<?php include "header.php"?>
<div class="container">
	<nav class="navbar navbar-toggleable-md navbar-light bg-faded" style="background-color: #ECEEEF;">
			<form class="form-inline my-2 my-lg-0" action="<?php base_url() ?>buscar/todos" method="post">
		<div class="container">
		<div class="row">
			<div class="col-sm-8">
			<?php if(!empty($success))
			{ ?>
			<div class="alert alert-success" role="alert">
			<form data-toggle="validator" enctype="multipart/form-data" role="form" action="<?php echo base_url() ?>registrar/gravarsenha/<?php echo $usuarionome;?>" method="post" id='newpassword' onsubmit="return validate()" class="form-signin">
			<div class="form-group">
			<center><label class="control-label"><strong>Digite uma senha:</strong></label></center>
			<div class="form-group">
			<center><label class="control-label"><strong>Confirme sua senha:</strong></label></center>
			<div class="form-group">
			<center>
			<input type="submit" name="submit" id="submit" value="Concluir Registro" class="btn btn-success">
			</div>
			
			<div class="col-sm-4">
			<div class="card">	
			<div class="card-block">
			<div class="alert alert-warning" role="alert">
			</div>	
			</div><br />
			</div>
			
		</div>
	</div>			
<style type="text/css">
.wrapper {
margin-top: 80px;
margin-bottom: 80px;
}
.form-signin {
max-width: 380px;
padding: 25px 25px 25px;
margin: 0 auto;
background-color: #F5F5F5;
border: 2px solid rgba(0,0,0,0.1);
.checkbox {
font-weight: normal;
}
.form-control {
position: relative;
font-size: 16px;
height: auto;
padding: 10px;
@include box-sizing(border-box);
&:focus {
z-index: 2;
}
input[type="text"] {
margin-bottom: -1px;
border-bottom-left-radius: 0;
border-bottom-right-radius: 0;
}
input[type="password"] {
margin-bottom: 20px;
border-top-left-radius: 0;
border-top-right-radius: 0;
}
}
</style>
<?php include "footer.php"?>			