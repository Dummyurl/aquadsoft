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
        $user_id = 0;

        $data = $this->getChartData($user_id);

        $this->recarray('', $data);

        $data['tree_data'] = implode(',',$this->chart_data);
        
        $this -> load -> view('common/head');
        $this->load->view('common/sidebar');
        $this->load->view('dashboard/genealogy',$data);
        $this -> load -> view('common/footer');
    }

    function getChartData($user_id) {
        if($user_id == 0) {
            $data['Root'] = $this->Chart_model->makeUserChart($user_id);
        }else{
            $user_data = $this->Chart_model->getCustomerData($user_id);
            $data[$user_data->firstname] = $this->Chart_model->makeUserChart($user_id);
        }

        return $data;
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