<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Urls extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('Url_model');
    }

    public function index()
    {
        $data['urls']=$this->Url_model->get_all_url();

        $this -> load -> view('common/head.php');
        $this -> load -> view('common/sidebar.php');
        $this -> load -> view('urls/urls_list_view.php',$data);
        $this -> load -> view('common/footer.php');
    }
    public function urls_edit($id)
    {
        $data['url']=$this->Url_model->urls_edit_model($id);

        $this -> load -> view('common/head.php');
        $this -> load -> view('common/sidebar.php');
        $this -> load -> view('urls/urls_list_view_edit.php',$data);
        $this -> load -> view('common/footer.php');
    }
    public function urls_delete($id)
    {

        $this->Url_model->urls_delete_model($id);
        redirect('Urls');
    }
    public function urls_create()
    {
        $this -> load -> view('common/head.php');
        $this->load->view('common/sidebar.php');
        $this->load->view('urls/urls_list_view_create.php');
        $this -> load -> view('common/footer.php');

    }

    public function store()
    {

        $businesstype = $this->input->post('businesstype');
        $url = $this->input->post('url');
        $data['url']=$url;
        $data['businesstype']=$businesstype;
        $this->Url_model->url_insert($data);
        redirect('Urls');

    }
    public function edit_store()
    {
        $id = $this->input->post('id');
        $url = $this->input->post('url');

        $data['url']=$url;
        $data['id']=$id;

        $this->Url_model->url_update($id,$data);
        redirect('Urls');




    }


}