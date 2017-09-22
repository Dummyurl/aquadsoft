<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apidetails extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this -> load -> model('Login_model');
    }
    public function index()
    {
        $this -> load -> view('api_views/allapi.php');

    }

    public function allbusiness()
    {
        $this ->load ->view('api_views/allbusiness.php');

    }
    public function get_all_url_by_business()
    {
        $this->load->view('api_views/get_all_url_by_business.php');
    }

    public function signup()
    {
        $this->load->view('api_views/signup.php');
    }
    public function login()
    {
        $this->load->view('api_views/login.php');
    }



}
