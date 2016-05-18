<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_user extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper(array('form','url'));
        $this->load->model('users_model');
        $this->load->library('form_validation');
        $this->load->library('encrypt');
        $this->load->library('session');
    }
    
    public function index()
    {   

         $user = $this->session->userdata('username_user');
         if ($user) {
            redirect(site_url('home'));
         }else{
            $this->load->view('user/login');      
         }

      
    }

    public function logout(){
        $this->session->unset_userdata('username_user');
        redirect('login_user');
    }

    public function submit(){
        $username = $this->input->post('username' , true);
        $password =  $this->encrypt->hash($this->input->post('password' , true));
          $login = $this->users_model->login($username, $password);
           if ($login) {
            $this->session->set_userdata('username_user', $username);
            $this->session->set_userdata('username_id', $login);
            redirect('home');
        }else{
            $data = array( 
                'error' => 'Username or password false',
            );
            $this->load->view('user/login',$data);
        }


    }
    
   
  
    
    
 
  

};

/* End of file master_admin.php */
/* Location: ./application/controllers/master_admin.php */