<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tree extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Chart_model');
    }

    public function index()
    {
        $data = $this->Chart_model->makeUserChart();

        echo "<pre>";
        print_r($data);
        echo "</pre>";

        $this -> load -> view('common/head');
        $this->load->view('common/sidebar');
        $this->load->view('dashboard/genealogy',$data);
        $this -> load -> view('common/footer');
    }



}