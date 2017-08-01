<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Campo_Grande');
?>
<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Registrar extends CI_Controller {
	
public function __construct(){
		parent::__construct();
		$this->load->model('usuario');
		$this->load->model('publicacoes');
		$this->session;
		$this->load->library('encrypt');
		$this->load->helper('url');
	}

public function index(){
	$data['nome'] = '';
	$data['email'] = '';
	$this->load->view('registrar',$data);
	$this->load->view('usuario_post',$data);
	$this->load->view('usuario_post', array('error' => ' ' ));
}

public function editar($id=NULL){
	if($id == NULL) {
		redirect('/');
	}

	$query = $this->publicacoes->getPublicacaoByID($id);

	if($query == NULL) {
		redirect('/');
	}

	$dados['publicacao'] = $query;
	$dados['categorias'] = $this->publicacoes->pegar_categoria_query_editar($query->categoriaid);
	$dados['estados'] = $this->publicacoes->pegar_estado_query_editar($query->idestado);
	$dados['cidades'] = $this->publicacoes->pegar_cidades_query_editar($query->idcidade,$query->idestado);
	$this->load->view('editar_publicacao', $dados);
}

public function salvar_editar(){
if ($this->session->userdata('usuario_nome') == NULL){
	session_unset();
	session_destroy();
	redirect(base_url());
	exit();
} else {
	
	$titulo = $_POST['PostTitulo'];
	$altura = "450";
	$largura = "600";

	switch($_FILES['PostFoto']['type']):
		case 'image/jpeg';
			$imagem_temporaria = imagecreatefromjpeg($_FILES['PostFoto']['tmp_name']);
			$largura_original = imagesx($imagem_temporaria);
			$altura_original = imagesy($imagem_temporaria);
			$nova_largura = $largura ? $largura : floor (($largura_original / $altura_original) * $altura);
			$nova_altura = $altura ? $altura : floor (($altura_original / $largura_original) * $largura);
			$imagem_redimensionada = imagecreatetruecolor($nova_largura, $nova_altura);
			imagecopyresampled($imagem_redimensionada, $imagem_temporaria, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura_original, $altura_original);
			imagejpeg($imagem_redimensionada, '././imagens/' . $_FILES['PostFoto']['name']);
			$nomeAntigo = $_FILES['PostFoto']['name'];
			
			$dados['titulo'] = mb_strtoupper($titulo,'UTF-8');
			$dados['texto'] = $this->input->post('PostTexto');
			$dados['categoria'] = $this->input->post('categorias');
			$dados['cidade'] = $this->input->post('cidades');
			$dados['estado'] = $this->input->post('estados');
			$dados['endereco'] = $this->input->post('enderecos');
			$nomeFoto = $this->geraNomeAleatorio($nomeAntigo);
			$dados['foto'] = "imagens/".$nomeAntigo;
			

			if ($this->input->post('id') != NULL) {
				$this->publicacoes->editarPublicacao($dados, $this->input->post('id'));
			} else {
				redirect(base_url().'painel',$data);
			}
			
		break;

		case 'image/jpg';
			$imagem_temporaria = imagecreatefromjpeg($_FILES['PostFoto']['tmp_name']);
			$largura_original = imagesx($imagem_temporaria);
			$altura_original = imagesy($imagem_temporaria);
			$nova_largura = $largura ? $largura : floor (($largura_original / $altura_original) * $altura);
			$nova_altura = $altura ? $altura : floor (($altura_original / $largura_original) * $largura);
			$imagem_redimensionada = imagecreatetruecolor($nova_largura, $nova_altura);
			imagecopyresampled($imagem_redimensionada, $imagem_temporaria, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura_original, $altura_original);
			imagejpeg($imagem_redimensionada, '././imagens/' . $_FILES['PostFoto']['name']);
			$nomeAntigo = $_FILES['PostFoto']['name'];
			
			$dados['titulo'] = mb_strtoupper($titulo,'UTF-8');
			$dados['texto'] = $this->input->post('PostTexto');
			$dados['categoria'] = $this->input->post('categorias');
			$dados['cidade'] = $this->input->post('cidades');
			$dados['estado'] = $this->input->post('estados');
			$dados['endereco'] = $this->input->post('enderecos');
			$nomeFoto = $this->geraNomeAleatorio($nomeAntigo);
			$dados['foto'] = "imagens/".$nomeAntigo;

			if ($this->input->post('id') != NULL) {
				$this->publicacoes->editarPublicacao($dados, $this->input->post('id'));
			} else {
				redirect(base_url().'painel',$data);
			}
			
		break;

		case 'image/png':
			$nova_imagem_nome = 'image_' . date('d-m-Y-H-i-s') . '_' . uniqid() . '.png';
			$imagem_temporaria = imagecreatefrompng($_FILES['PostFoto']['tmp_name']);
			$largura_original = imagesx($imagem_temporaria);
			$altura_original = imagesy($imagem_temporaria);
			$nova_largura = $largura ? $largura : floor(( $largura_original / $altura_original ) * $altura);
			$nova_altura = $altura ? $altura : floor(( $altura_original / $largura_original ) * $largura);
			$imagem_redimensionada = imagecreatetruecolor($nova_largura, $nova_altura);
			imagecopyresampled($imagem_redimensionada, $imagem_temporaria, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura_original, $altura_original);
			imagepng($imagem_redimensionada, '././imagens/' . $nova_imagem_nome);
			
			$dados['titulo'] = mb_strtoupper($titulo,'UTF-8');
			$dados['texto'] = $this->input->post('PostTexto');
			$dados['categoria'] = $this->input->post('categorias');
			$dados['cidade'] = $this->input->post('cidades');
			$dados['estado'] = $this->input->post('estados');
			$dados['endereco'] = $this->input->post('enderecos');
			$dados['foto'] = "imagens/".$nova_imagem_nome;

			if ($this->input->post('id') != NULL) {
				$this->publicacoes->editarPublicacao($dados, $this->input->post('id'));				
			} else {
				redirect(base_url().'painel',$data);
			}
			
		break;

	endswitch;
}
}

public function novousuario(){
		if ($_POST){
			$this->load->helper('url');
			$usuario_nome = str_replace(' ', '', strtolower(strtr(utf8_decode($_POST['InputNome']), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY')));
			$email = $_POST['InputEmail'];
			$nomeCount = $this->usuario->seUsuarioNomeExiste($usuario_nome);
			if($nomeCount >0){
				$data['nome_error'] = 'O nome do usuário já está registrado.';
				$data['success']='';
			}
			$emailCount = $this->usuario->seEmailExiste($email);
			if($emailCount > 0){
				$data['email_error'] = 'O e-mail já está registrado.';
				$data['success']='';
			}
			if($nomeCount >0 && $emailCount >0){
				$data['both_error'] = 'Nome de usuário e e-mail ambos estão registrados.';
				$data['nome_error']  ='';
				$data['email_error']='';
				$data['success']='';
			}
			$data['nome'] = $usuario_nome;
			$data['email'] = $email;
			if($nomeCount==0 && $emailCount==0){
					$config = Array(
					  'protocol' => 'smtp',
					  'smtp_host' => 'smtp.kinghost.net',
					  'smtp_port' => 587,
					  'smtp_user' => 'contato@olharcidadao.kinghost.net',
					  'smtp_pass' => '7259310684ivan',
					  'mailtype' => 'html',
					  'charset' => 'UTF-8',
					  'wordwrap' => TRUE
					);
					  $this->email->initialize($config);
					  $this->email->set_newline("\r\n");
					  $this->email->from('contato@olharcidadao.kinghost.net', 'Olhar Cidadão');
					  $this->email->to($email);
					  $this->email->subject('Confirmar Registro');
					  $html = '
					  <img style="user-select: none; cursor: zoom-in;" src="https://image.ibb.co/iTZNVF/logo.png" width="300" height="86">
					  <br/>
					  <p>Por favor clique no link abaixo para completar seu registro.</p>
					  <br/>
					  <a href="'.$this->config->base_url().'registrar/novasenha/'.$usuario_nome.'" target="_blank">'.$this->config->base_url().'registrar/novasenha/'.$usuario_nome.'</a>';
					  $this->email->message($html);
					  if (!$this->email->send()){
					    $data['danger'] = 'O envio do e-mail falhou. Por favor, tente novamente mais tarde.';
							$data['nome'] = '';
							$data['email'] = '';
						}
					  else{
					     $data['success'] = 'Um e-mail de confirmação foi enviado. Verifique seu e-mail na caixa de entrada ou spam.';
					     $data_usuario = array(
							'usuario_nome'	=>	$usuario_nome,
							'usuario_email'	=> $email
						);
						$usuario_id = $this->usuario->criar_usuario($data_usuario);
						$data['nome'] = '';
						$data['email'] = '';
				  	}
			}
			$this->load->view('registrar',$data);
		}
		else{
			$data['both_error'] = '';
			$data['nome_error']  ='';
			$data['email_error']='';
			$data['success']='';
			$data['nome'] = '';
			$data['email'] = '';
			$this->load->view('registrar',$data);
		}
	}

public function novasenha($usuario_nome){
			$data['success']='';
			$data['usuarionome']=$usuario_nome;
			$this->load->view('novasenha',$data);
}

public function gravarsenha($usuario_nome){
		if ($this->session->userdata('usuario_password') != NULL){
		redirect(base_url());
		exit();}
		$enc_passoword = $this->encrypt($_POST['InputNovaSenha']);
		if ($_POST) {
			$userInfo = $this->usuario->get_password(trim($usuario_nome));
			if($userInfo['usuario_password']){
				redirect(base_url().'inicio');
			}
			$password = $enc_passoword;
			$data_usuario = array(
							'usuario_password'	=>	$password
							);
			$this->usuario->atualizar_usuario($usuario_nome,$data_usuario);
			$data['success']='Agora você pode realizar o login.';
			$data['usuarionome']=$usuario_nome;
			$_SESSION['gravarsenha']= $usuario_nome;
			redirect(base_url().'painel', 'refresh',$data);
		}

		else{
			$data['success']='';
			if(isset($_SESSION['gravarsenha'])){
				$data['usuarionome']=$_SESSION['gravarsenha'];
			}
			else{
				session_unset();
				session_destroy();
	 			redirect(base_url().'inicio');
			}
			redirect(base_url().'inicio', 'refresh',$data);
		}
}

public function login(){
		if ($_POST != NULL) {
			$enc_passoword = $this->encrypt($_POST['InputPassword']);
			$usuario_nome = str_replace(' ', '', strtolower(strtr(utf8_decode($_POST['InputUsuarioNome']), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY')));
			$password = $enc_passoword;
			$nomeCount = $this->usuario->seUsuarioNomeExiste($usuario_nome);

			if($nomeCount == 1){
					$userInfo = $this->usuario->get_password($usuario_nome);
					if($userInfo['usuario_password']==$password){
						$data['publicacoes'] = $this->ver_usuario_publicacao($usuario_nome);
						$data['usuario_nome'] = $usuario_nome;
						$_SESSION['usuario_nome'] = $usuario_nome;
						$_SESSION['publicacoes'] = $this->ver_usuario_publicacao($usuario_nome);
						$this->load->view('usuarioinicio',$data);
					}else{
						$data['error'] = 'Senha Incorreta';
						$this->load->view('login',$data);
					}
			}else{
				$data['error'] = 'Usuário Incorreto';
				$this->load->view('login',$data);
			}
		}
		else if(!isset($_SESSION['usuario_nome'])){
			$data['usuarionome']='';
			$data['password']='';
			$this->load->view('login',$data);
		}
	    else if(isset($_SESSION['publicacoes'])){
	    	$data['publicacoes']=$this->ver_usuario_publicacao($this->session->userdata('usuario_nome')) ;
	    	$data['usuario_nome']=$_SESSION['usuario_nome'];
	    	$this->load->view('usuarioinicio',$data);
	    }
	}

public function ver_usuario_publicacao($usuario_nome){
		$resultado = $this->publicacoes->get_usuario_publicacao($usuario_nome);
		if ($resultado != false){
		return $resultado;
		}else{return 'Nenhuma publicação cadastrada!';}
}

public function mostrar_publicacoes(){
	$resultado = $this->publicacoes->mostrar_todos_inicio();
		if ($resultado != true){
		return $resultado;
	}else{return 'Nenhuma publicação cadastrada!';}
}

public function logout(){
	unset($_SESSION['usuario_nome']);
	session_unset();
	$this->session->sess_destroy();
 	redirect(base_url().'inicio');
}

public function delete_usuario_post($id,$usuario_nome){
	if ($this->session->userdata('usuario_nome') == NULL){
	session_unset();
	session_destroy();
	redirect(base_url());
	exit();}
 	$this->publicacoes->delete_usuario_publicacao($id);
 	$data['publicacoes'] = $this->ver_usuario_publicacao($usuario_nome);
	$_SESSION['publicacoes'] = $this->ver_usuario_publicacao($usuario_nome);
	redirect(base_url().'painel', 'refresh',$data);
}

public function publicacao($usuario_nome){
		if ($this->session->userdata('usuario_nome') == NULL){
		session_unset();
		session_destroy();
		redirect(base_url());
		exit();}
 		$this->load->model('publicacoes');
 		$data['error'] = '';
 		$data['usuario_nome'] = $usuario_nome;
 		$data['estado'] = $this->publicacoes->pegar_estado_query();
		$this->load->view('usuario_post',[
		'error' => '',
		'usuario_nome' =>  $usuario_nome,
		'estado' => $this->publicacoes->pegar_estado_query(),
		'categoria' => $this->publicacoes->pegar_categoria_query()]);
}

public function pegar_cidades(){
	$idEstado = $this->input->post('idEstado');
	$cidade = $this->publicacoes->pegar_cidades_query($idEstado);
	if(count($cidade)>0){
		$selecionar = '';
		$selecionar .= '<option value="">Cidades</option>';
		foreach ($cidade as $cidades){
			$selecionar .='<option value="'.$cidades->idCidade.'">'.$cidades->nomeCidade.'</option>';
		}
		echo json_encode($selecionar);
		}
}

public function pegaExtensao($arquivo){
  $ext = explode('.',$arquivo);
  $ext = array_reverse($ext);
  return ".".$ext[0]; 
}
public function pegaSomenteNome($arquivo){
  $nome = pathinfo($arquivo);
  return $nome['filename'];
}
public function geraNomeAleatorio($arquivo){
  $extensao    = $this->pegaExtensao($arquivo);
  $somenteNome = $this->pegaSomenteNome($arquivo);
  $rand	       = rand(0, 99999);
  //ou
  //$rand = sha1($somenteNome.time());
  return $rand.$extensao;
}

public function salvar_post($usuario_nome){
	if ($this->session->userdata('usuario_nome') == NULL){
	session_unset();
	session_destroy();
	redirect(base_url());
	exit();}

	if (($_POST) != NULL){
	$titulo = $_POST['PostTitulo'];
	$texto =  $_POST['PostTexto'];
	$categoria = $_POST['categorias'];
	$cidade = $_POST['cidades'];
	$estado = $_POST['estados'];
	$endereco = $_POST['enderecos'];
	$nomeAntigo = $_FILES['PostFoto']['name'];

	$altura = "450";
	$largura = "600";

	switch($_FILES['PostFoto']['type']):
	
		case 'image/jpg';
			$imagem_temporaria = imagecreatefromjpeg($_FILES['PostFoto']['tmp_name']);
			$largura_original = imagesx($imagem_temporaria);
			$altura_original = imagesy($imagem_temporaria);
			$nova_largura = $largura ? $largura : floor (($largura_original / $altura_original) * $altura);
			$nova_altura = $altura ? $altura : floor (($altura_original / $largura_original) * $largura);
			$imagem_redimensionada = imagecreatetruecolor($nova_largura, $nova_altura);
			imagecopyresampled($imagem_redimensionada, $imagem_temporaria, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura_original, $altura_original);
			imagejpeg($imagem_redimensionada, '././imagens/' . $_FILES['PostFoto']['name']);
			$nomeAntigo = $_FILES['PostFoto']['name'];
		
			$data_usuario = array(
					'titulo' =>	mb_strtoupper($titulo,'UTF-8'),
					'foto' => "imagens/".$nomeAntigo,
					'texto'  => $texto,
					'categoria' => $categoria,
					'estado' => $estado,
					'cidade' => $cidade,
					'endereco' => $endereco,
					'usuario_nome' => trim(strtolower($usuario_nome))
					);
			$nomeFoto = $this->geraNomeAleatorio($nomeAntigo);
			$this->publicacoes->criar_publicacao($data_usuario);
			$data['publicacoes'] = $this->ver_usuario_publicacao($usuario_nome);
			$data['usuario_nome'] = $usuario_nome;
			$_SESSION['publicacoes'] = $this->ver_usuario_publicacao($usuario_nome);
			redirect(base_url().'painel',$data);
		break;

		case 'image/jpeg';
			$imagem_temporaria = imagecreatefromjpeg($_FILES['PostFoto']['tmp_name']);
			$largura_original = imagesx($imagem_temporaria);
			$altura_original = imagesy($imagem_temporaria);
			$nova_largura = $largura ? $largura : floor (($largura_original / $altura_original) * $altura);
			$nova_altura = $altura ? $altura : floor (($altura_original / $largura_original) * $largura);
			$imagem_redimensionada = imagecreatetruecolor($nova_largura, $nova_altura);
			imagecopyresampled($imagem_redimensionada, $imagem_temporaria, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura_original, $altura_original);
			imagejpeg($imagem_redimensionada, '././imagens/' . $_FILES['PostFoto']['name']);
			$nomeAntigo = $_FILES['PostFoto']['name'];
			
				$data_usuario = array(
						'titulo' =>	mb_strtoupper($titulo,'UTF-8'),
						'foto' => "imagens/".$nomeAntigo,
						'texto'  => $texto,
						'categoria' => $categoria,
						'estado' => $estado,
						'cidade' => $cidade,
						'endereco' => $endereco,
						'usuario_nome' => trim(strtolower($usuario_nome))
						);
				$nomeFoto = $this->geraNomeAleatorio($nomeAntigo);
				$this->publicacoes->criar_publicacao($data_usuario);
				$data['publicacoes'] = $this->ver_usuario_publicacao($usuario_nome);
				$data['usuario_nome'] = $usuario_nome;
				$_SESSION['publicacoes'] = $this->ver_usuario_publicacao($usuario_nome);
				redirect(base_url().'painel',$data);
		break;

		case 'image/png':
			$nova_imagem_nome = 'image_' . date('d-m-Y-H-i-s') . '_' . uniqid() . '.png';
			$imagem_temporaria = imagecreatefrompng($_FILES['PostFoto']['tmp_name']);
			$largura_original = imagesx($imagem_temporaria);
			$altura_original = imagesy($imagem_temporaria);
			$nova_largura = $largura ? $largura : floor(( $largura_original / $altura_original ) * $altura);
			$nova_altura = $altura ? $altura : floor(( $altura_original / $largura_original ) * $largura);
			$imagem_redimensionada = imagecreatetruecolor($nova_largura, $nova_altura);
			imagecopyresampled($imagem_redimensionada, $imagem_temporaria, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura_original, $altura_original);
			imagepng($imagem_redimensionada, '././imagens/' . $nova_imagem_nome);
			
				$data_usuario = array(
						'titulo' =>	mb_strtoupper($titulo,'UTF-8'),
						'foto' => "imagens/".$nova_imagem_nome,
						'texto'  => $texto,
						'categoria' => $categoria,
						'estado' => $estado,
						'cidade' => $cidade,
						'endereco' => $endereco,
						'usuario_nome' => trim(strtolower($usuario_nome))
						);
			$nomeFoto = $this->geraNomeAleatorio($nomeAntigo);
			$this->publicacoes->criar_publicacao($data_usuario);
			$data['publicacoes'] = $this->ver_usuario_publicacao($usuario_nome);
			$data['usuario_nome'] = $usuario_nome;
			$_SESSION['publicacoes'] = $this->ver_usuario_publicacao($usuario_nome);
			redirect(base_url().'painel',$data);
		break;

	endswitch;
}else {
	session_unset();
	session_destroy();
	redirect(base_url());
	exit();
	}
}

public function encrypt($password){
	 $salt_key = '*!@!UJjs0982ue092u09u(*hjsaljksal*A*';
	 $password = $password . $salt_key;
	 $enc_passoword = sha1($password);
	 return $enc_passoword;
}
}
?>
