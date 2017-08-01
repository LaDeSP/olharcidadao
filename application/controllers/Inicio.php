<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Campo_Grande');
?>
<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Inicio extends CI_Controller {

public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('publicacoes');
	}


public function index(){
    
    $config = array(
        "base_url" => base_url('publicacoes/p'),
        "per_page" => 3,
        "num_links" => 3,
        "uri_segment" => 3,
        "total_rows" => $this->publicacoes->CountAll(),
        "full_tag_open" => '<div class="pagging text-center"><nav><ul class="pagination justify-content-center pagination">',
        "full_tag_close" => '</ul></nav></div>',
        "first_link" => FALSE,
        "last_link" => FALSE,
        "first_tag_open" => '<li class="page-item"><span class="page-link">',
        "first_tag_close" => '</span></li>',
        "prev_link" => "Anterior",
        "prev_tag_open" => '<li class="page-item"><span class="page-link">',
        "prev_tag_close" => '</span></li>',
        "next_link" => "Próxima",
        "next_tag_open" => '<li class="page-item"><span class="page-link">',
        "next_tag_close" => '<span aria-hidden="true">&raquo;</span></span></li>',
        "last_tag_open" => '<li class="page-item"><span class="page-link">',
        "last_tag_close" => '</span></li>',
        "cur_tag_open" => '<li class="page-item active"><span class="page-link">',
        "cur_tag_close" => '<span class="sr-only">(current)</span></span></li>',
        "num_tag_open" => '<li class="page-item"><span class="page-link">',
        "num_tag_close" => '</span></li>'
    );
    $this->pagination->initialize($config);

    $data = array();
    $data['pagination'] = $this->pagination->create_links();
    $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	
	//$menu['publicacoes'] = $this->publicacoes->getPublicacao('publicacao', 'categoria', '');
	$data['publicacoes'] = $this->publicacoes->getTodasPublicacoes('publicacao');
    $data['categorias'] = $this->publicacoes->getTodasPublicacoes('categoria');
    $data['mostrar_categorias'] = $this->publicacoes->pegar_categoria_query();
	$data['mostrar_publicacoes'] = $this->mostrar_publicacoes($config['per_page'],$offset);
	$this->load->view('inicio',$data);		
	}

public function mostrar_publicacoes($numero, $offset){
	$result = $this->publicacoes->mostrar_todos_inicio($numero, $offset);
		if ($result != false) {
			return $result;
		} 
		else {
			return 'Nenhuma publicação cadastrada!';
		}
	}
public function mostrar_publicacoes_categoria($numero, $offset, $categoria){
	$result = $this->publicacoes->mostrar_todos_inicio_categoria($numero, $offset, $categoria);
		if ($result != false) {
			return $result;
		} 
		else {
			return 'Nenhuma publicação cadastrada!';
		}
	}
public function publicacao($publicacao_id){
		$data['publicacao'] = $this->publicacoes->get_publicacao($publicacao_id);
		$this->load->view('publicacao', $data);
	} 
	
public function filtrar($categoria){
	$config = array(
        "base_url" => base_url('categoria/'.$categoria),
        "per_page" => 3,
        "num_links" => 3,
        "uri_segment" => 3,
        "total_rows" => $this->publicacoes->CountByCategory($categoria),
        "full_tag_open" => '<div class="pagging text-center"><nav><ul class="pagination justify-content-center pagination">',
        "full_tag_close" => '</ul></nav></div>',
        "first_link" => FALSE,
        "last_link" => FALSE,
        "first_tag_open" => '<li class="page-item"><span class="page-link">',
        "first_tag_close" => '</span></li>',
        "prev_link" => "Anterior",
        "prev_tag_open" => '<li class="page-item"><span class="page-link">',
        "prev_tag_close" => '</span></li>',
        "next_link" => "Próxima",
        "next_tag_open" => '<li class="page-item"><span class="page-link">',
        "next_tag_close" => '<span aria-hidden="true">&raquo;</span></span></li>',
        "last_tag_open" => '<li class="page-item"><span class="page-link">',
        "last_tag_close" => '</span></li>',
        "cur_tag_open" => '<li class="page-item active"><span class="page-link">',
        "cur_tag_close" => '<span class="sr-only">(current)</span></span></li>',
        "num_tag_open" => '<li class="page-item"><span class="page-link">',
        "num_tag_close" => '</span></li>'
    );
    $this->pagination->initialize($config);
	$data = array();
    $data['pagination'] = $this->pagination->create_links();
    $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	$id = $this->uri->segment('3');
	$data['categorias'] = $this->publicacoes->getTodasPublicacoes('categoria');
	$data['mostrar_publicacoes'] = $this->mostrar_publicacoes_categoria($config['per_page'], $offset, $categoria);
	$this->load->view('inicio',$data);
}
	
}
?>