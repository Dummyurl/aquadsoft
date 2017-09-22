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
	
	public function makeUserChart($user_id = null)
    {
        if($user_id == null){
        	$legs = $this->getLegUsers(0);
        }else{
        	$legs = $this->getLegUsers($user_id);
        }
        
        return $legs;
    }

    public function getLegUsers($parent_id)
    {
    	$this->db->select('l.*, c.firstname');
    	$this->db->from('leg_positions l');
    	$this->db->join('customer c', 'l.customer_id=c.customer_id');
    	$this->db->where('parent_id', $parent_id);
    	$data = $this->db->get()->result();

    	if(count($data) > 0){
    		foreach($data as $val){
    			$legs[$parent_id]['name'] = $val->firstname;
    			$legs[$parent_id][$val->position] = $this->getLegUsers($val->customer_id);
    		}    		
    	}

    	return $legs;
    	
    }
}