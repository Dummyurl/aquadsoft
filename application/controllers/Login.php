<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this -> load -> model('Login_model');
    }

    /**
     *
     */
    public function index()
    {

        if (!empty($this -> session -> userdata) && $this -> session -> userdata!=null && !empty($this -> session -> userdata['email']) ) {
           redirect('/dashboard');
       } else {

            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $usr_result = $this->Login_model->get_verified_user($username, $password);

            if ($usr_result) {

                //set the session variables
                $sessiondata = array(
                    'fullname' => $usr_result->fullname,
                    'username' => $usr_result->username,
                    'email' => $usr_result->email,
                    'loginuser' => TRUE
                );
                $this->session->set_userdata($sessiondata);
                redirect('/dashboard');
            }
            else
            {
                $this->session->set_flashdata('msg', 'Invalid username or password!');
                redirect('login');
            }
        }
    }

    public function login()
    {
        $this -> load -> view('common/head.php');
        $this -> load ->view('login.php');
        $this -> load -> view('common/footer.php');
    }
    public function signup()
    {
        $this -> load -> view('common/head.php');
        $this -> load ->view('signup.php');
        $this -> load -> view('common/footer.php');
    }

    public function signup_Store()
    {
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['password'];

        $data['name']=$name;
        $data['email']=$email;
        $data['password']=md5($password);
        if($this -> Login_model -> insert_data($data)){
                redirect('login');
        }
        else{
            redirect('signup');
        }

    }

    public function forgotpassword()
    {
        $this -> load -> view('common/head.php');
        $this->load ->view('forgotpassword.php');
        $this -> load -> view('common/footer.php');
    }
}

