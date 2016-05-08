<?php 


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_kampus extends My_Controller{
	
	function __construct()
    {
        parent::__construct();
        $this->load->model('kampus_model');
        $this->load->library('form_validation');
    	$this->load->library('pagination');

    }
    public function index(){
    	$keyword = '';
        $config['base_url'] = base_url() . 'master_kampus/index/';
        $config['total_rows'] = $this->kampus_model->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['suffix'] = '';
        $config['first_url'] = base_url() . 'master_kampus';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(3, 0);
        $master_kampus = $this->kampus_model->index_limit($config['per_page'], $start);

        $this->data = array(
            'master_kampus' => $master_kampus,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->content = 'admin/master_kampus/kampus_list';
        $this->layout();
    }
    public function search() 
    {
        $keyword = $this->uri->segment(3, $this->input->post('keyword', TRUE));
     
        
        if ($this->uri->segment(2)=='search') {
            $config['base_url'] = base_url() . 'master_kampus/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'master_kampus/index/';
        }

        $config['total_rows'] = $this->kampus_model->search_total_rows($keyword);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = '';
        $config['first_url'] = base_url() . 'master_kampus/search/'.$keyword.'';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $master_kampus = $this->kampus_model->search_index_limit($config['per_page'], $start, $keyword);

        $this->data = array(
            'master_kampus' => $master_kampus,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->content = 'admin/master_kampus/kampus_list';
        $this->layout();
    }

    public function read($id){
    	 $row = $this->kampus_model->get_by_id($id);

        if ($row) {
            $this->data = array(
				'id' => $row->id,
				'nama' => $row->nama,
				'alamat' => $row->alamat,
	    	);
            $this->content = 'admin/master_kampus/kampus_read';
        	$this->layout();
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_kampus'));
        }
    }


    public function create(){
    	$this->data = array(
    		'button' => 'Create',
            'action' => site_url('master_kampus/create_action'),
            'id' => set_value('id'),
            'nama' => set_value('nama'),
            'alamat'    => set_value('alamat'),
    	);
    	$this->content = 'admin/master_kampus/kampus_form';
        $this->layout();

    }
    public function create_action(){
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
				'nama' => $this->input->post('nama',TRUE),
				'alamat' =>$this->input->post('alamat',TRUE),
            
		    );

            $this->kampus_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('master_kampus'));
        }
    }

    public function update($id){
    	$row = $this->kampus_model->get_by_id($id);

        if ($row) {
            $this->data = array(
                'button' => 'Update',
                'action' => site_url('master_kampus/update_action'),
				'id' => set_value('id', $row->id),
				'nama' => set_value('nama', $row->nama),
				'alamat'  => set_value('nama', $row->alamat),
	    	);
            $this->content = 'admin/master_kampus/kampus_form';
        	$this->layout();
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_kampus'));
        }
    }


    public function delete($id) 
    {
        $row = $this->kampus_model->get_by_id($id);

        if ($row) {
            $this->kampus_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('master_kampus'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_kampus'));
        }
    }

    public function update_action(){
    	$this->_rules();
      
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
							'nama' => $this->input->post('nama',TRUE),
							'alamat' =>$this->input->post('alamat',TRUE),
	    				);


            $this->kampus_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('master_kampus'));
        }

    }





    public function _rules(){
    	$this->form_validation->set_rules('nama', ' ', 'trim|required');
    	$this->form_validation->set_rules('alamat', ' ', 'trim|required');
  
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    	$this->form_validation->set_rules('id', 'id', 'trim');
    }



}

