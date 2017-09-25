<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tree extends CI_Controller
{
    private $chart_data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Chart_model');
    }

    public function index()
    {
        $data['Root'] = $this->Chart_model->makeUserChart();

        $this->recarray('', $data);

        $data['tree_data'] = implode(',',$this->chart_data);
        
        $this -> load -> view('common/head');
        $this->load->view('common/sidebar');
        $this->load->view('dashboard/genealogy',$data);
        $this -> load -> view('common/footer');
    }

    function recarray($node, $array)
    {
        foreach($array as $key=>$value)
        {
            if(is_array($value)) {
                $this->chart_data[] = "['".$key."','".$node."','']";
                self::recarray($key, $value);
            }
        }
    }

}