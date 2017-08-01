<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller{

  public function __construct()
  {
      parent::__construct();
      $this->load->model('categoria_model');
	  $this->load->model('publicacao_model');
	  $this->load->model('usuario_model');
  }

  public function index()
  {
      $this->load->helper('url');			
      $this->load->view('admin/index');
  }

  public function ajax_list_categoria()
  {
      $list = $this->categoria_model->get_datatables();
      $data = array();
      $no = $_POST['start'];
      foreach ($list as $categoria) {
          $no++;
          $row = array();
          $row[] = '<input type="checkbox" class="data-check" value="'.$categoria->id.'" onclick="showBottomDeleteCategoria()"/>';
          $row[] = $categoria->nome;
          //add html for action
          $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Editar" onclick="edit('."'".$categoria->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
                <a class="btn btn-sm btn-danger" href="javascript:void()" title="Deletar" onclick="deleteCategoria('."'".$categoria->id."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar</a>';
          $data[] = $row;
      }
      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->categoria_model->count_all(),
                      "recordsFiltered" => $this->categoria_model->count_filtered(),
                      "data" => $data,
              );
      //output to json format
      echo json_encode($output);
  }
  
    public function ajax_list_publicacao()
  {
      $list = $this->publicacao_model->get_datatables();
      $data = array();
      $no = $_POST['start'];
      foreach ($list as $publicacao) {
          $no++;
          $row = array();
          $row[] = '<input type="checkbox" class="data-check" value="'.$publicacao->id.'" onclick="showBottomDeletePublicacao()"/>';
          $row[] = $publicacao->titulo;
          //add html for action
          $row[] = '<a class="btn btn-sm btn-danger" href="javascript:void()" title="Deletar" onclick="deletePublicacao('."'".$publicacao->id."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar</a>';
          $data[] = $row;
      }
      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->publicacao_model->count_all(),
                      "recordsFiltered" => $this->publicacao_model->count_filtered(),
                      "data" => $data,
              );
      //output to json format
      echo json_encode($output);
  }
 
   public function ajax_list_usuario()
  {
      $list = $this->usuario_model->get_datatables();
      $data = array();
      $no = $_POST['start'];
      foreach ($list as $usuario) {
          $no++;
          $row = array();
          $row[] = '<input type="checkbox" class="data-check" value="'.$usuario->usuario_nome.'" onclick="showBottomDeleteUsuario()"/>';
          $row[] = $usuario->usuario_nome;
          //add html for action
          $row[] = '<a class="btn btn-sm btn-danger" href="javascript:void()" title="Deletar" onclick="deleteUsuario('."'".$usuario->usuario_nome."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar</a>';
          $data[] = $row;
      }
      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->usuario_model->count_all(),
                      "recordsFiltered" => $this->usuario_model->count_filtered(),
                      "data" => $data,
              );
      //output to json format
      echo json_encode($output);
  }

  public function ajax_edit($id)
  {
      $data = $this->categoria_model->get_by_id($id);
      echo json_encode($data);
  }

  public function ajax_add()
  {
      $this->_validate();
      $data = array(
              'nome' => $this->input->post('nome'),
          );
      $insert = $this->categoria_model->save($data);
      echo json_encode(array("status" => TRUE));
  }

  public function ajax_update()
  {
      $this->_validate();
      $data = array(
              'nome' => $this->input->post('nome'),
          );
      $this->categoria_model->update(array('id' => $this->input->post('id')), $data);
      echo json_encode(array("status" => TRUE));
  }

  public function ajax_delete_categoria($id)
  {
      $this->categoria_model->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
  }
  
  public function ajax_delete_publicacao($id)
  {
      $this->publicacao_model->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
  }
  
  public function ajax_delete_usuario($usuario_nome)
  {
      $this->usuario_model->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
  }

  public function ajax_list_delete_categoria()
   {
       $list_id = $this->input->post('id');
       foreach ($list_id as $id) {
           $this->categoria_model->delete_by_id($id);
       }
       echo json_encode(array("status" => TRUE));
   }

  public function ajax_list_delete_publicacao()
   {
       $list_id = $this->input->post('id');
       foreach ($list_id as $id) {
           $this->publicacao_model->delete_by_id($id);
       }
       echo json_encode(array("status" => TRUE));
   }

  public function ajax_list_delete_usuario()
   {
       $list_id = $this->input->post('usuario_nome');
       foreach ($list_id as $usuario_nome) {
           $this->usuario_model->delete_by_id($usuario_nome);
       }
       echo json_encode(array("status" => TRUE));
   }

  private function _validate(){

      $data = array();
      $data['error_string'] = array();
      $data['inputerror'] = array();
      $data['status'] = TRUE;

      if($this->input->post('nome') == ''){
          $data['inputerror'][] = 'nome';
          $data['error_string'][] = 'Obrigatório!';
          $data['status'] = FALSE;
      }else{

        if(!$this->_validate_string($this->input->post('nome')))
        {
          $data['inputerror'][] = 'nome';
          $data['error_string'][] = 'Valor inválido!';
          $data['status'] = FALSE;
        }
      }
   

	  if($data['status'] === FALSE){
	      echo json_encode($data);
	      exit();
	  }
 }

  private function _validate_string($string)
  {
      $allowed = "ABCDEFGHIJKLMNOPQRSTUVWXYZaáàãbcçdeéfghijklmnoôpqrstuúvwxyz";
      for ($i=0; $i<strlen($string); $i++)
      {
          if (strpos($allowed, substr($string,$i,1))===FALSE)
          {
              return FALSE;
          }
      }

     return TRUE;
  }
  
  
}
