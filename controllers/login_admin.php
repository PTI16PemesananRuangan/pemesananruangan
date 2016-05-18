<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper(array('form','url'));
        $this->load->model('admin_model');
        $this->load->library('form_validation');
        $this->load->library('encrypt');
        $this->load->library('session');
    }

    public function index()
    {   

         $user = $this->session->userdata('username_admin');
         if ($user) {
            redirect(site_url('daftar_pemesanan'));
         }else{
            $this->load->view('admin/login');      
         }

      
    }

    public function logout(){http://localhost/ci-simpeg/
        $this->session->unset_userdata('username_admin');
        redirect('admin');
    }

    public function submit(){
        $username = $this->input->post('username' , true);
        $password =  $this->encrypt->hash($this->input->post('password' , true));
          $login = $this->admin_model->login($username, $password);
           if ($login) {
            $this->session->set_userdata('username_admin', $username);
            redirect('daftar_pemesanan');
        }else{
            $data = array( 
                'error' => 'Username or password false',
            );
            $this->load->view('admin/login',$data);
        }
    }
};

/* End of file master_admin.php */
/* Location: ./application/controllers/master_admin.php */