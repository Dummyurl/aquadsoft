<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array();

        $this -> load -> view('common/head');
        $this->load->view('common/sidebar');
        $this->load->view('dashboard/dashboard',$data);
        $this -> load -> view('common/footer');
    }



}