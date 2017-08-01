<?php include "header.php" ?>
<div class="container">
	<nav class="navbar navbar-toggleable-md navbar-light bg-faded" style="background-color: #ECEEEF;">
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">			<span class="navbar-toggler-icon"></span>		</button>  		  		<a class="navbar-brand" href="<?php echo base_url() ?>">			<img src="<?php echo base_url() ?>imagens/icon.png" width="30" height="200" class="d-inline-block align-top" alt="">&ensp; OLHAR CIDADÃO &ensp;&ensp;&ensp;&ensp;		</a>  		<div class="collapse navbar-collapse" id="navbar">			<ul class="navbar-nav mr-auto mt-2 mt-md-0">				<?php if(!isset($_SESSION['usuario_nome']))					{?>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url() ?>"><b>Início</b></a></li>					<li class="nav-item"><a class="nav-link" href="<?php echo base_url() ?>painel"><b>Entrar</b></a></li>					<li class="nav-item"><a class="nav-link active" href="<?php echo base_url() ?>cadastrar"><b>Cadastrar</b></a></li>					<?php } else {?>					<li class="nav-item"><a class="nav-link active" href="<?php echo base_url() ?>"><b>Início</b></a></li>					<li class="nav-item"><a class="nav-link" href="<?php echo base_url() ?>painel"><b>Minhas Publicações</b></a></li>					<li class="nav-item"><a class="nav-link" href="<?php echo base_url() ?>sair"><b>Sair</b></a></li>				<?php }?>			</ul>			<form class="form-inline my-2 my-lg-0" action="<?php base_url() ?>buscar/todos" method="post">				<input class="form-control mr-sm-2" type="text" placeholder="Palavras-chave..." id="keyword" name="keyword" required oninvalid="this.setCustomValidity('Preencha este campo')"><br>				<button class="btn btn-outline-info my-2 my-sm-0" type="submit">Buscar <i class="fa fa-search" aria-hidden="true"></i></button>	 		</form>				</div>			</nav><br>			</div><div class="container">	<div class="row">		<div class="col-sm-8">			<?php if(!empty($nome_error))			{ ?>
			<div class="alert alert-danger" role="alert">			<center><strong>Atenção!</strong> <?php echo $nome_error; ?></center>			</div>			<?php }			else if(!empty($email_error))			{ ?>			<div class="alert alert-danger" role="alert">			<center><strong>Atenção!</strong> <?php echo $email_error; ?></center>			</div>			<?php }			else if(!empty($both_error))			{			?>			<div class="alert alert-danger" role="alert">			<center><strong>Atenção!</strong> <?php echo $both_error; ?></center>			</div>			<?php }			else if(!empty($success))			{			?>
			<div class="alert alert-success" role="alert">			<center><strong>Sucesso!</strong> <?php echo $success; ?></center>			</div><br><br>			<?php } ?>			<form data-toggle="validator" enctype="multipart/form-data" role="form" action="<?php echo base_url() ?>registrar/novousuario" method="post" class="form-signin" accept-charset="UTF-8">			<center>			<img class="img-responsive" alt="Olhar Cidadão" src="<?php echo base_url() ?>imagens/user2.png"><br><br>			</center>			<div class="form-group">			<center><label class="control-label"><strong>Seu nome de usuário:</strong></label></center>			<div class="input-group">			<span class="input-group-addon"><i class="fa fa-user-circle-o"  aria-hidden="true"></i></span>			<input type="text" class="form-control" name="InputNome" id="InputNome" placeholder="Digite o nome do seu usuário"			data-minlength="6" data-error="O usuário deve conter 6 caracteres no minímo." required>			</div>			<div class="help-block with-errors"></div>			</div>
			<div class="form-group">
			<center><label class="control-label"><strong>Digite um e-mail válido:</strong></label></center>			<div class="input-group">			<span class="input-group-addon"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>			<input type="email" class="form-control" name="InputEmail" id="InputEmailFirst" placeholder="Digite um e-mail válido."			data-minlength="6" data-error="E-mail inválido." required>			</div>			<div class="help-block with-errors"></div>			</div>			<div class="form-group">			<center>			<input type="submit" name="submit" id="submit" value="Cadastrar" class="btn btn-primary">			</center>			</div>			</form><br />		</div>	
		
		<div class="col-sm-4">
			<div class="card">	
			<div class="card-block">
			<div class="alert alert-warning" role="alert">
			<strong>Atenção!</strong> Para efetuar seu cadastro no Olhar Cidadão corretamente será enviado um e-mail de confirmação para o respectivo e-mail cadastrado, portanto coloque um e-mail válido e verifique sua caixa de entrada ou spam.
			</div>  
			</div>	
			</div><br />
		</div>	</div></div>
			
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