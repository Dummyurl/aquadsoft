<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merchant extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this -> load -> model('Login_model');
        $this -> load -> model('Merchant_model');
    }

    public function index()
    {
        $data['merchant'] = array((object)array(
            'id' => "2",
            'fullname' => "Ajay kumar",
            'email' => "test@test.com",
            'birthday' => '2017-09-19 16:26:45',
            'image' => ''
        ));

        //$this->Merchant_model->get_all_merchant();
//        print_r($data);
//        exit();
//        echo "you are sign in ";
        $this -> load -> view('common/head');
        $this->load->view('common/sidebar');
        $this->load->view('merchant_view',$data);
        $this -> load -> view('common/footer');
    }



}