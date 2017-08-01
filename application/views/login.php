<?php include "header.php"?>
<div class="container">
	<nav class="navbar navbar-toggleable-md navbar-light bg-faded" style="background-color: #ECEEEF;">		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">			<span class="navbar-toggler-icon"></span>		</button>  		  		<a class="navbar-brand" href="<?php echo base_url() ?>">			<img src="<?php echo base_url() ?>imagens/icon.png" width="30" height="200" class="d-inline-block align-top" alt="">&ensp; OLHAR CIDADÃO &ensp;&ensp;&ensp;&ensp;		</a>  		<div class="collapse navbar-collapse" id="navbar">			<ul class="navbar-nav mr-auto mt-2 mt-md-0">				<?php if(!isset($_SESSION['usuario_nome']))					{?>					<li class="nav-item"><a class="nav-link" href="<?php echo base_url() ?>"><b>Início</b></a></li>					<li class="nav-item"><a class="nav-link active" href="<?php echo base_url() ?>painel"><b>Entrar</b></a></li>					<li class="nav-item"><a class="nav-link" href="<?php echo base_url() ?>cadastrar"><b>Cadastrar</b></a></li>					<?php } else {?>					<li class="nav-item"><a class="nav-link active" href="<?php echo base_url() ?>"><b>Início</b></a></li>					<li class="nav-item"><a class="nav-link" href="<?php echo base_url() ?>painel"><b>Minhas Publicações</b></a></li>					<li class="nav-item"><a class="nav-link" href="<?php echo base_url() ?>sair"><b>Sair</b></a></li>				<?php }?>			</ul>			<form class="form-inline my-2 my-lg-0" action="<?php base_url() ?>buscar/todos" method="post">				<input class="form-control mr-sm-2" type="text" placeholder="Palavras-chave..." id="keyword" name="keyword" required oninvalid="this.setCustomValidity('Preencha este campo')"><br>				<button class="btn btn-outline-info my-2 my-sm-0" type="submit">Buscar <i class="fa fa-search" aria-hidden="true"></i></button>	 		</form>				</div>			</nav><br>
			</div>		
<div class="container">
	<div class="row">	
		<div class="col-sm-12">			<?php if(!empty($error))			{ ?>			<center>			<div class="container">			<div class="alert alert-danger pull">			<strong>Atenção!</strong> <?php echo $error; ?>			</div>			</div>			</center>			<?php } ?>			<form data-toggle="validator" enctype="multipart/form-data" role="form" action="<?php echo base_url() ?>painel" method="post" class="form-signin">			<center>			<img class="img-responsive" alt="Olhar Cidadão" src="<?php echo base_url() ?>imagens/user1.png"><br><br>			</center>
			<div class="form-group">			<center><label for="inputConfirm" class="control-label"><strong>Nome do Usuário:</strong></label></center>			<div class="input-group">			<span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span>			<input type="text" class="form-control" name="InputUsuarioNome" id="InputUsuarioNome" placeholder="Digite o nome do seu usuário"			data-minlength="6" data-error="Por favor, informe um usuário correto." required>			</div>			<div class="help-block with-errors"></div>			</div>
			<div class="form-group">			<center><label for="inputConfirm" class="control-label"><strong>Senha:</strong></label></center>			<div class="input-group">			<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>			<input type="password" class="form-control" name="InputPassword" id="InputPassword" placeholder="Digite sua Senha..."			data-minlength="6" data-error="A senha deve conter 6 dígitos" required>			</div>			<div class="help-block with-errors"></div>			</div>
			<div class="form-group">			<center>			<input type="submit" name="submit" id="submit" value="Entrar" class="btn btn-primary">			</center><br>			</div>			</form>		</div>			</div>	</div>
<style type="text/css">
.wrapper {
margin-top: 80px;margin-bottom: 80px;}.form-signin {
max-width: 380px;padding: 25px 25px 25px;
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
}
input[type="text"] {
margin-bottom: -1px;
border-bottom-left-radius: 0;border-bottom-right-radius: 0;
}
input[type="password"] {
margin-bottom: 20px;
border-top-left-radius: 0;
border-top-right-radius: 0;
}
}
</style>
<?php include "footer.php"?>					