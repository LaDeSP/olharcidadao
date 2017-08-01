<?php
defined('BASEPATH') OR exit('No direct script access allowed');date_default_timezone_set('America/Campo_Grande');?>
<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class Buscar extends CI_Controller {    function __construct(){        parent::__construct();        $this->load->model('publicacoes');		$this->load->helper('url');    }
	function todos(){
        $keyword=$this->input->post('keyword');        $data['results']=$this->publicacoes->search($keyword);		if($data['results'] != FALSE){			$this->load->view('buscar',$data);		}else{			$mensagem = 'Nenhuma publicação cadastrada!';			$this->load->view('buscar', $mensagem);		}	}
function usuario(){
        $keyword=$this->input->post('keyword');        $data['results']=$this->publicacoes->search_user($keyword);        $this->load->view('buscar_usuario',$data);	}
}
?>