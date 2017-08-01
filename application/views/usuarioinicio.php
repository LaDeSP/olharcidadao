<?php include "usuarioheader.php" ?>
<div class="container">
<div class="row">
	<div class="col-sm-7">	<?php if (isset($publicacoes)) {	if($publicacoes=='Nenhuma publicação cadastrada!')	{ ?>
	<div class="alert alert-danger" role="alert">		<center><strong>Atenção!</strong> <?php echo $publicacoes; ?></center>
	</div>
	<?php }
	else{
		foreach ($publicacoes as $publicacao) {
		?>
		<center>
		<div class="card">
			<div class="card-block">
				<h4 class="card-title"><?php echo html_escape($publicacao->titulo);?></h4>				<h6 class="card-subtitle text-muted"><strong><?php echo date('d/m/Y', strtotime( $publicacao->curr_time));?></strong></h6>				<center><br /><img src="<?php if($publicacao->foto!='') {echo base_url().$publicacao->foto;} ?>" alt="" <?php if($publicacao->foto!='') ?> /></center><br />				<ul class="list-group list-group-flush">					<li style="text-align:justify;" class="list-group-item"><i class="fa fa-user" aria-hidden="true"></i>&ensp;					<strong>Publicado por:&ensp; </strong><?php echo html_escape($publicacao->usuario_nome);?></li>					<li style="text-align:justify;" class="list-group-item"><i class="fa fa-check-square-o" aria-hidden="true"></i>&ensp;					<strong>Categoria:&ensp; </strong><?php echo html_escape($publicacao->categoria);?></li>					<li style="text-align:justify;" class="list-group-item"><i class="fa fa-cube" aria-hidden="true"></i>&ensp;					<strong>Estado:&ensp; </strong><?php echo html_escape($publicacao->estado);?></li>					<li style="text-align:justify;" class="list-group-item"><i class="fa fa-home" aria-hidden="true"></i>&ensp;					<strong>Cidade:&ensp; </strong><?php echo html_escape($publicacao->cidade);?></li>					<li style="text-align:justify;" class="list-group-item"><i class="fa fa-map-marker" aria-hidden="true"></i>&ensp;					<strong>Endereço:&ensp;</strong><?php echo html_escape($publicacao->endereco);?></li>				</ul><br>				<div align="center"><a href="http://localhost/olharcidadao/inicio/publicacao/<?php echo $publicacao->id;?>" class="btn btn-primary btn-lg btn-block"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp;Visualizar</a></div><br />				<div align="center"><a href="http://localhost/olharcidadao/registrar/editar/<?php echo $publicacao->id;?>/<?php echo html_escape($publicacao->usuario_nome);?>" class="btn btn-warning btn-lg btn-block"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;Editar</a></div><br />				<div align="center"><a href="http://localhost/olharcidadao/registrar/delete_usuario_post/<?php echo $publicacao->id;?>/<?php echo html_escape($publicacao->usuario_nome);?>" class="btn btn-danger btn-lg btn-block"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp;Remover</a></div><br />			</div>		</div><br />		</center>	<?php }}}?>	</div>
	<div class="col-sm-5">
		<div class="card">
			<div class="card-block">
			<h4 class="card-title"><center>Olá, <?php echo html_escape($_SESSION['usuario_nome']);?></center></h4><br />			<div align="center"><a href="http://localhost/olharcidadao/publicar/<?php echo html_escape($usuario_nome);?>" class="btn btn-secondary btn-lg btn-block"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Nova Publicação</a></div><br />			<div align="center"><a href="https://docs.google.com/forms/d/e/1FAIpQLSeYk6Plp9-WSdB9l5xJpbb1vg5XRvhLGQ8ImQl-ZGpRV78pqw/viewform" target="_blank" class="btn btn-secondary btn-lg btn-block"><i class="fa fa-pie-chart" aria-hidden="true"></i>&nbsp;&nbsp;Avaliar Sistema</a></div><br />			<div align="center"><a href="http://localhost/olharcidadao/sair" class="btn btn-secondary btn-lg btn-block"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;Sair</a></div>			</div>		</div><br />
		<div class="card">			<div class="card-block">			<form action="http://localhost/olharcidadao/buscar/usuario" method="post">			<input class="form-control" id="keyword" name="keyword" type="text" placeholder="Palavras-chave..." required=""><br>			<button class="btn btn-primary btn-block btn-lg" type="submit">Buscar <i class="fa fa-search" aria-hidden="true"></i></button>			</form>
			</div>
		</div><br />
	</div>
</div></div>
<?php include "footer.php"?>
