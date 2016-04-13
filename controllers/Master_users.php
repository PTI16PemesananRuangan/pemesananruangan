<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_users extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->library('form_validation');
        $this->load->library('encrypt');
    }

    public function index()
    {
        $keyword = '';
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'master_users/index/';
        $config['total_rows'] = $this->users_model->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['suffix'] = '';
        $config['first_url'] = base_url() . 'master_users';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(3, 0);
        $master_users = $this->users_model->index_limit($config['per_page'], $start);

        $this->data = array(
            'master_users_data' => $master_users,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->content = 'admin/master_user/users_list';
        $this->layout();
    }
    
    public function search() 
    {
        $keyword = $this->uri->segment(3, $this->input->post('keyword', TRUE));
        $this->load->library('pagination');
        
        if ($this->uri->segment(2)=='search') {
            $config['base_url'] = base_url() . 'master_users/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'master_users/index/';
        }

        $config['total_rows'] = $this->users_model->search_total_rows($keyword);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = '';
        $config['first_url'] = base_url() . 'master_users/search/'.$keyword.'';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $master_users = $this->users_model->search_index_limit($config['per_page'], $start, $keyword);

        $this->data = array(
            'master_users_data' => $master_users,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->content = 'admin/master_user/users_list';
        $this->layout();
    }

    public function read($id) 
    {
        $row = $this->users_model->get_by_id($id);
        if ($row) {
            $this->data = array(
		      'id' => $row->id,
		      'name' => $row->name,
              'username' => $row->username,
		      'email' => $row->email,
		      'password' => $row->password,
              'ketua' => $row->ketua,
	        );
            $this->content = 'admin/master_user/users_read';
            $this->layout();
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_users'));
        }
    }
    
    public function create() 
    {
        $this->data = array(
            'button' => 'Create',
            'action' => site_url('master_users/create_action'),
	        'id' => set_value('id'),
	        'name' => set_value('name'),
             'ketua' => set_value('ketua'),
             'username' => set_value('username'),
	        'email' => set_value('email'),
	        'password' => set_value('password'),
	    );
        $this->content = 'admin/master_user/users_form';
        $this->layout();
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
    		      'name' => $this->input->post('name',TRUE),
    		      'email' => $this->input->post('email',TRUE),
                  'username' =>  $this->input->post('username',TRUE),
                    'ketua' =>  $this->input->post('ketua',TRUE),
    		      'password' => $this->encrypt->hash($this->input->post('password',TRUE)),
	        );

            $this->users_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('master_users'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->users_model->get_by_id($id);

        if ($row) {
            $this->data = array(
                'button' => 'Update',
                'action' => site_url('master_users/update_action'),
        		'id' => set_value('id', $row->id),
        		'name' => set_value('name', $row->name),
                'ketua' => set_value('ketua', $row->ketua),
                'username' => set_value('username', $row->username),
        		'email' => set_value('email', $row->email),
        		'password' => set_value('password'),
	        );
            $this->content = 'admin/master_user/users_form';
            $this->layout();
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_users'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
            'username' => $this->input->post('username',TRUE),
            'ketua' => $this->input->post('ketua',TRUE),
		'email' => $this->input->post('email',TRUE),
		'password' =>$this->encrypt->hash($this->input->post('password',TRUE)),
	    );

            $this->users_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('master_users'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->users_model->get_by_id($id);

        if ($row) {
            $this->users_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('master_users'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_users'));
        }
    }

    public function _rules() 
    {
    	$this->form_validation->set_rules('name', ' ', 'trim|required');
    	$this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    	$this->form_validation->set_rules('id', 'id', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

};

/* End of file Master_users.php */
/* Location: ./application/controllers/Master_users.php */