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

    public function makeTabularChart($user_id = 0)
    {
        $legs = array();

        $this->db->select('l.position, l.customer_id, c.firstname');
        $this->db->from('leg_positions l');
        $this->db->join('customer c', 'l.customer_id=c.customer_id');
        $this->db->where('parent_id', $user_id);
        $records = $this->db->get()->result(); 

        if(count($records) > 0){
            foreach($records as $row){
                $name = $row->firstname;
                if($user_id == 0)
                    $parent = 'Root';
                else {
                    $customer = $this->getCustomerData( $user_id );
                    $parent = $customer->firstname;
                }
                
                $child = self::makeTabularChart($row->customer_id);

                $legs[] = array('name'=>$name, 'parent'=>$parent, 'children'=>$child);
                
            }
        }

        return $legs;
    }

    public function makeUnilevelChart($user_id = 0)
    {
        $legs = array();

        $this->db->select('r.customer_id, c.firstname');
        $this->db->from('reference r');
        $this->db->join('customer c', 'r.customer_id=c.customer_id');
        $this->db->where('sponsor_id', $user_id);
        $records = $this->db->get()->result(); 

        if(count($records) > 0){
            foreach($records as $row){
                //$legs[$row->position]['name'] = $row->firstname;
                $legs[$row->firstname] = self::makeUnilevelChart($row->customer_id);
            }
        }

        return $legs;
    }

    public function getCustomerData( $customer_id )
    {
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where('customer_id', $customer_id);
        return $this->db->get()->row();
    }
}