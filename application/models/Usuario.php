<?php
class Usuario extends CI_Model{		function criar_usuario($data){
		$this->db->insert('tbl_usuario', $data);
	}
	function seUsuarioNomeExiste($nome){		$this->db->select()->from('tbl_usuario')->where('usuario_nome', $nome);		$query = $this->db->get();
		return $query->num_rows();
	}
	function seEmailExiste($email){		$this->db->select()->from('tbl_usuario')->where('usuario_email', $email);		$query = $this->db->get();
		return $query->num_rows();
	}
	function atualizar_usuario($usuario_nome, $data){
		$this->db->where('usuario_nome', $usuario_nome);
		$this->db->update('tbl_usuario', $data);
	}
	function get_password($usuario_nome){		$this->db->select()->from('tbl_usuario')->where(array('usuario_nome'=>$usuario_nome));		$query = $this->db->get();
		return $query->first_row('array');	}
}?>