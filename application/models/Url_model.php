<?php
/**
 * Created by PhpStorm.
 * User: Avanish
 * Date: 6/12/2017
 * Time: 4:17 PM
 */
//        if (!defined('BASEPATH'))
//        exit('No direct script access allowed');
class Url_model extends CI_Model
{
    public function __construct()
    {
        $this->load->helper('new_helper');
    }

    public function url_insert($data)
    {
        $this->db->insert('urls', $data);

    }

    public function get_all_url()
    {
        $this -> db -> from('urls');
        $query = $this -> db -> get();
         return $query -> result();

    }
    public function urls_edit_model($id)
    {
        $this->db->where('id',$id);
        $this -> db -> from('urls');
        $query = $this -> db -> get();
        return $query -> result();
    }
    public function urls_delete_model($id)
    {
        $this->db->where('id',$id);
        $this -> db -> delete('urls');
    }
    public function url_update($id,$data)
    {
        $this->db->where('id',$id);
        $this -> db -> update('urls',$data);
    }
    public function get_all_business_model()
    {
        $this->db->select('id ,businesstype');
        $this -> db -> from('urls');
        $query = $this -> db -> get();
        return $query -> result();
    }
    public function get_all_url_by_business_model($id)
    {
        $this->db->where('id',$id);
        $this -> db -> from('urls');
        $query = $this -> db -> get();
        return $query -> result();
    }


}