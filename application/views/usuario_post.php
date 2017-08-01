<?php include "usuarioheader.php"?>
<div class="container">
<div class="row">

	<div class="col-sm-7">
	<?php if(!empty($error))
	{ ?>
	<div class="alert alert-danger" role="alert">
		<center><strong>Atenção!</strong> <?php echo $error; ?></center>
	</div>
	<?php } ?>
		<form data-toggle="validator" role="form" action="http://localhost/olharcidadao/registrar/salvar_post/<?php echo $usuario_nome;?>" method="post" enctype="multipart/form-data" class="form-signin">
			<center>
				<img class="img-responsive" alt="Olhar Cidadão" src="http://localhost/olharcidadao/imagens/user3.png"><br><br>
			</center>

			<div class="form-group">
				<strong><label for="PostTitulo">Título:</label></strong>
				<div class="input-group">
					<input type="text" class="form-control" name="PostTitulo" id="PostTitulo" data-minlength="10" data-error="O título deve ter no mínimo 10 caracteres." required>
					<span class="input-group-addon"><i class="fa fa-info" aria-hidden="true"></i></span>
				</div>
				<div class="help-block with-errors"></div>
			</div>

			<div class="form-group">
				<strong><label for="PostFoto">Imagem Representativa:</label></strong>
				<div class="input-group">
					<input type="file" class="form-control" name="PostFoto" id="PostFoto" onchange="mostrarimagem();" required>
					<span class="input-group-addon"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
				</div>
				<label id="mensagem"></label>
			</div>

			<center><img src="" style="width:400; height:300; border:1px solid gray;border-radius:1px;" id="imagem"></center><br />

			<div class="form-group">
				<strong><label for="PostTexto">Texto da Publicação:</label></strong>
				<div class="input-group">
					<textarea class="form-control" name="PostTexto" id="PostTexto" data-minlength="50" data-error="O texto deve ter no mínimo 50 caracteres." required rows="8"> </textarea>
					<span class="input-group-addon"><i class="fa fa-font" aria-hidden="true"></i></span>
				</div>
				<div class="help-block with-errors"></div>
			</div>

			<div class="form-group">
				<strong><label for="categorias">Categoria Relacionada:</label></strong>
				<select class="form-control" id="categorias" name="categorias" required>
					<option value="">Selecionar Categoria</option>
					<?php foreach ($categoria as $categorias): ?>
						<option value="<?php echo $categorias->id; ?>"> <?php echo $categorias->nome;?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="form-group">
				<strong><label for="estados">Estado:</label></strong>
				<select class="form-control" id="estados" name="estados" required>
					<option value="">Selecionar Estado</option>
					<?php foreach ($estado as $estados): ?>
						<option value="<?php echo $estados->idEstado; ?>"> <?php echo $estados->nomeEstado;?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="form-group">
				<strong><label for="cidades">Cidade:</label></strong>
				<select class="form-control" id="cidades" name="cidades" required>
					<option value="">Selecionar Cidade</option>
				</select>
			</div>

			<div class="form-group">
				<strong><label for="enderecos">Endereço:</label></strong>
				<div class="input-group">
					<input type="text" class="form-control" id="enderecos" name="enderecos" placeholder="Coloque o nome da rua e o número." data-minlength="10" data-error="O endereço deve ter no mínimo 10 caracteres." required>
					<span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
				</div>
				<div class="help-block with-errors"></div>
			</div><br />

			<center><input type="submit" name="upload" id="submit" value="Publicar" class="btn btn-info pull" "></center><br /><br />
	</form><br />
	</div>
        <div class="col-sm-5">

            <div class="card">
                <div class="card-block">
                    <h4 class="card-title"><center>Olá, <?php echo $_SESSION['usuario_nome'];?></center></h4><br />
                    <div align="center"><a href="http://localhost/olharcidadao/painel" class="btn btn-secondary btn-lg btn-block"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;Painel</a></div><br />
					<div align="center"><a href="https://docs.google.com/forms/d/e/1FAIpQLSeYk6Plp9-WSdB9l5xJpbb1vg5XRvhLGQ8ImQl-ZGpRV78pqw/viewform" target="_blank" class="btn btn-secondary btn-lg btn-block"><i class="fa fa-pie-chart" aria-hidden="true"></i>&nbsp;&nbsp;Avaliar Sistema</a></div><br />
					<div align="center"><a href="http://localhost/olharcidadao/sair" class="btn btn-secondary btn-lg btn-block"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;Sair</a></div>
                </div>
            </div><br />

            <div class="card">
                <div class="card-block">
                    <form action="http://localhost/olharcidadao/buscar/usuario" method="post">
                        <input class="form-control" id="keyword" name="keyword" type="text" placeholder="Palavras-chave..." required=""><br>
                        <button class="btn btn-primary btn-block btn-lg" type="submit">Buscar <i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div><br />
		</div>

    </div>
</div>

<script type="text/javascript">
    function mostrarimagem(){
        var preview=document.getElementById('imagem');
        var file=document.querySelector('input[type=file]').files[0];
        var fil=document.getElementById("PostFoto").value;
        var mensagem=document.getElementById("mensagem");
        var extensoes_validas=[".jpeg",".jpg",".png"];
        var extension=fil.substring(fil.lastIndexOf(".")).toLowerCase();
        var leer = new FileReader();
        if(!file){}
        else{
            for(var i=0;i<extensoes_validas.length;i++){
                if(extensoes_validas[i]===extension){
                    var permissao = true;
                    break;}
            }
            if (!permissao){
                mensagem.textContent="Formato de imagem incorreto.";
                preview.src="";
                document.getElementById("PostFoto").value="";
            }else{
                leer.readAsDataURL(file);
                leer.onloadend=function(){
                    preview.src=leer.result;
                }
                mensagem.textContent="";
            }
        }
    }
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#estados').on('change', function(){
            var idEstado = $(this).val();
            console.log(idEstado);
            if(idEstado === ''){
							$('#cidades').prop('disable', true);
            }else{
                $('#cidades').prop('disable', false);
                $.ajax({
                    url:"http://olharcidadao.kinghost.net/registrar/pegar_cidades",
                    type: "POST",
                    data: {'idEstado' : idEstado},
                    dataType: 'json',
                    success: function(data){
                        $('#cidades').html(data);
                    },
                    error: function(data, err){
                        console.log(err);
                        alert('Um erro ocorreu');
                    }
                });
            }
        });
    });
</script>

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
