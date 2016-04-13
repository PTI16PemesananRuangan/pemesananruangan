<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller 
 { 

   //set the class variable.
   var $template  = array();
   var $data      = array();
   var $page      = '';
   var $model     = '';
   var $input     = array();
   public $userdata = array();
   

   public function __construct()
   {
        parent::__construct();
        $this->is_logged_in();
        $this->load->library('pagination');
        $this->load->library('form_validation');
   }
    public function is_logged_in()
    {
        $user = $this->session->userdata('username_admin');
        if (!$user) {
            redirect('admin');
        }
        $this->userdata =array(
            '_username' => $user,
        );
       
        
    }

   
   //Load layout    
   public function layout() {
      $this->data['_username'] = $this->session->userdata('username_admin');
      $this->template['sidebar']   = $this->load->view('template/admin/sidebar', $this->data, true);
      $this->template['top']   = $this->load->view('template/admin/top', $this->data, true);
      $this->template['content'] = $this->load->view($this->content, $this->data, true);
      $this->template['footer'] = $this->load->view('template/admin/footer', $this->data, true);
      $this->load->view('template/admin/layout', $this->template);
   }
   
  


}
class user_controller extends CI_Controller{
    public function __construct() {
       parent::__construct();
       $this->is_logged_in_user();
    }

    public function is_logged_in_user()
    {
        $user = $this->session->userdata('username_user');
        if (!$user) {
            redirect('login_user');
        }
        $this->userdata =array(
            '_username' => $user,
        );   
    }

    public function layout() {
      $this->data['_username'] = $this->session->userdata('username_user');
      $this->template['sidebar']   = $this->load->view('template/user/sidebar', $this->data, true);
      $this->template['top']   = $this->load->view('template/user/top', $this->data, true);
      $this->template['content'] = $this->load->view($this->content, $this->data, true);
      $this->template['footer'] = $this->load->view('template/user/footer', $this->data, true);
      $this->load->view('template/admin/layout', $this->template);
   }


}