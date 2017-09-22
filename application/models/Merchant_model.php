<?php

class Merchant_model extends CI_Model
{
    public function __construct()
    {
        $this->load->helper('new_helper');
    }

    public function merchant_insert($data)
    {
        $this->db->insert('merchant', $data);
        return true;
    }

    public function login($email,$password)
    {
        $this->db->where('email',$email);
        $this->db->where('password',md5($password));
        $this -> db -> from('merchant');
        $query = $this -> db -> get();
        return $query->result();
    }
    public function  check_merchant($email)
    {
    	$this->db->where('email',$email);
        $this -> db -> from('merchant');
        $query = $this -> db -> get();
        return $query->result();
    }

    public function get_all_merchant()
    {
        $this -> db -> from('merchant');
        $query = $this -> db -> get();
        return $query->result();
    }


}
