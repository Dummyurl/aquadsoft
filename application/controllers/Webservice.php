<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webservice extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this -> load -> model('Login_model');
        $this -> load -> model('Url_model');
        $this -> load -> model('Merchant_model');

    }

    public function Get_all_business()
        {
            $all_business = $this->Url_model->get_all_business_model();
//            print_r($all_business);
            if($all_business)
            {
                $raw_data=array('status'=>'true',
                                 "message"=>"data send",
                                "data"=>$all_business
                                );
            }
            else
            {
                $raw_data=array('status'=>'false',
                    "message"=>"data not send",
                    "data"=>""
                );

            }
            echo json_encode($raw_data);
        }

     public function  get_all_url_by_business_api()
     {
         $id=$this->input->post('id');
         $all_urls=$this->Url_model->get_all_url_by_business_model($id);
         //echo  json_encode($all_urls[0]);
         $data=array();
         if($all_urls) {
             $data['id'] = $all_urls[0]->id;
             $data['businesstype'] = $all_urls[0]->businesstype;
             $data['urls'] = array();
             $url_array = explode(',', $all_urls[0]->url);
             foreach ($url_array as $value) {
                    $url_string['url']=$value;
                 $allpos=strpos_all($value,'.');
                 $url_string['url_name']=substr($value,$allpos[0]+1,$allpos[1]-$allpos[0]-1);

                 array_push($data['urls'],$url_string );
             }
         }
             if ($data) {
                 $raw_data = array('status' => 'true',
                     "message" => "data send",
                     "data" => $data
                 );
             } else {
                 $raw_data = array('status' => 'false',
                     "message" => "data not send",
                     "data" => ""
                 );

             }
             echo json_encode($raw_data);
             // echo json_encode($data);

     }

     public function signup_api()
     {
         $fullname=$this->input->post('fullname');
         $email=$this->input->post('email');

         $password=$this->input->post('password');
         $birthday=$this->input->post('birthday');
         $image=$this->input->post('image');
         // print_r($file);
         $this->load->library('upload');
         $check_user=$this->Merchant_model->check_merchant($email);
//check email already exists or not 
         if(!$check_user)
         {

         $config['upload_path']   = './assets/images/'; 
         $config['allowed_types'] = 'gif|jpg|jpeg|png';
         $config['max_size']      = 10000; 
         $config['file_name']     = time().$fullname;
         $this->upload->initialize($config);
         $updatedbarimage="";
         if ( $this->upload->do_upload('image'))
         {
            // echo " uploaded";
             $updatedbarimage='assets/images/'.$this->upload->data('file_name'); 
         }
         else   {
//            echo $this->upload->display_errors();
                }

         $data['fullname']=$fullname;
         $data['email']=$email;
         $data['password']=md5($password);
         $data['birthday']=$birthday;
         $data['image']=$updatedbarimage;

         if(  $this->Merchant_model->merchant_insert($data))
         {
                        $data['image']= $updatedbarimage?base_url($updatedbarimage):"";
                    $raw_data=array('status'=>"true",
                                     'message'=>"Register Successfull",
                                     "data" =>   $data
                                        );
         }
         else
         {
             $raw_data=array('status'=>"false",
                                     'message'=>"data not inserted",
                                     "data" => ""
                                        );
         }
     }
     else
     {
        $raw_data=array('status'=>"false",
                                     'message'=>"Email Already Exist",
                                     "data" => ""
                                        );

     }

         echo json_encode($raw_data);

     }
     public function login_api()
     {
         $email=$this->input->post('email');
         $password=$this->input->post('password');
         $result= $this->Merchant_model->login($email,$password);
         if($result)
         {
            $result[0]->password="*********";
            $result[0]->image= base_url($result[0]->image);

             $raw_data=array('status'=>"true",
                                     'message'=>"Login Successfull",
                                     "data" => $result[0]
                                        );
         }
          else{
             $raw_data=array('status'=>"false",
                                     'message'=>"Login Failed",
                                     "data" =>  ""
                                        );
          }

          echo json_encode($raw_data);

     }
}