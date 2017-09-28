<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tree extends CI_Controller
{
    private $chart_data;
    private $tabular_data;
    private $unilevel_data;

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

    public function tabular()
    {
        $user_id = 0;

        $data = $this->getTabularData($user_id);

        $data['tree_data'] = json_encode($data);
        
        $this -> load -> view('common/head');
        $this->load->view('common/sidebar');
        $this->load->view('dashboard/tabular',$data);
        $this -> load -> view('common/footer');
    }

    public function unilevel()
    {
        $user_id = 0;

        $data = $this->getUnilevelChartData($user_id);

        $this->recarray('', $data);

        $data['tree_data'] = implode(',',$this->chart_data);
        
        $this -> load -> view('common/head');
        $this->load->view('common/sidebar');
        $this->load->view('dashboard/unilevel',$data);
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

    function getUnilevelChartData($user_id) {
        if($user_id == 0) {
            $data['Root'] = $this->Chart_model->makeUnilevelChart($user_id);
        }else{
            $user_data = $this->Chart_model->getCustomerData($user_id);
            $data[$user_data->firstname] = $this->Chart_model->makeUnilevelChart($user_id);
        }

        return $data;
    }

    function getTabularData($user_id) {
        if($user_id == 0) {
            $data['name'] = 'Root';
            $data['parent'] = '';
            $data['children'] = $this->Chart_model->makeTabularChart($user_id);
        }else{
            $user_data = $this->Chart_model->getCustomerData($user_id);
            $data['name'] = $user_data->firstname;
            $data['parent'] = '';
            $data['children'] = $this->Chart_model->makeTabularChart($user_id);
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