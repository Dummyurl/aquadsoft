<?php
/**
 * Created by PhpStorm.
 * User: Ajay
 * Date: 6/12/2017
 * Time: 4:17 PM
 */
//        if (!defined('BASEPATH'))
//        exit('No direct script access allowed');
class Chart_model extends CI_Model
{

    public function makeUserChart($user_id = 0)
    {
        $legs = array();

        if($user_id == 0){
            $legs['root'] = "root";
        }

        $this->db->select('l.position, l.customer_id, c.firstname');
        $this->db->from('leg_positions l');
        $this->db->join('customer c', 'l.customer_id=c.customer_id');
        $this->db->where('parent_id', $user_id);
        $records = $this->db->get()->result(); 

        if(count($records) > 0){
            foreach($records as $row){
                //$legs[$row->position]['name'] = $row->firstname;
                $legs[$row->firstname] = self::makeUserChart($row->customer_id);
            }
        }
        
        return $legs;
    }
}