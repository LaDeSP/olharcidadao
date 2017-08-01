<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usuario_model extends CI_Model {

    var $table = 'tbl_usuario';
    var $column = array('usuario_nome'); //set column field database for order and search
    var $order = array('usuario_nome' => 'desc'); // default order

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db->select('usuario_nome');
        $this->db->from('tbl_usuario');
        $i = 0;
        foreach ($this->column as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $column[$i] = $item; // set column array variable to order processing
            $i++;
        }
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from('tbl_usuario');
        return $this->db->count_all_results();
    }

    public function get_by_id($usuario_nome)
    {
        $this->db->from('tbl_usuario');
        $this->db->where('usuario_nome',$usuario_nome);
        $query = $this->db->get();

        return $query->row();
    }

    public function save($data)
    {
        $this->db->insert('tbl_usuario', $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update('tbl_usuario', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($usuario_nome)
    {
        $this->db->where('usuario_nome', $usuario_nome);
        $this->db->delete('tbl_usuario');
    }


}
