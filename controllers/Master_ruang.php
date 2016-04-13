<?php 


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_ruang extends My_Controller{
	
	private $option = array(''=>'--');

	function __construct()
    {
        parent::__construct();
        $this->load->model('ruang_model');
        $this->load->model('kampus_model');
        $this->load->library('form_validation');
    	$this->load->library('pagination');
    	$this->load->helper('uploading');
    	$this->init();
    }
    public function init(){
    	$kampus = $this->kampus_model->get_all();
        foreach ($kampus as $key => $value) {
                $this->option[$value->id] = $value->nama; 
        }
    }

    public function index(){
    	$keyword = '';
        $config['base_url'] = base_url() . 'master_ruang/index/';
        $config['total_rows'] = $this->ruang_model->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['suffix'] = '';
        $config['first_url'] = base_url() . 'master_ruang';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(3, 0);
        $master_ruang = $this->ruang_model->index_limit($config['per_page'], $start);

        $this->data = array(
            'master_ruang' => $master_ruang,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->content = 'admin/master_ruang/ruang_list';
        $this->layout();
    }
    public function search() 
    {
        $keyword = $this->uri->segment(3, $this->input->post('keyword', TRUE));
     
        
        if ($this->uri->segment(2)=='search') {
            $config['base_url'] = base_url() . 'master_ruang/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'master_ruang/index/';
        }

        $config['total_rows'] = $this->ruang_model->search_total_rows($keyword);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = '';
        $config['first_url'] = base_url() . 'master_ruang/search/'.$keyword.'';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $master_ruang = $this->ruang_model->search_index_limit($config['per_page'], $start, $keyword);

        $this->data = array(
            'master_ruang' => $master_ruang,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->content = 'admin/master_ruang/ruang_list';
        $this->layout();
    }

    public function read($id){
    	 $row = $this->ruang_model->get_by_id($id);

        if ($row) {
            $this->data = array(
				'id' => $row->id,
				'nama' => $row->nama,
				'fasilitas' => $row->fasilitas,
				'kapasitas' => $row->kapasitas,
		     	'foto'	=> $row->foto,
		     	'id_kampus' => $row->id_kampus,
		     	'kampus_options' => $this->option,
	    	);
            $this->content = 'admin/master_ruang/ruang_read';
        	$this->layout();
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_ruang'));
        }
    }


    public function create(){
    	


    	$this->data = array(
    		'button' => 'Create',
            'action' => site_url('master_ruang/create_action'),
            'id' => set_value('id'),
            'nama' => set_value('nama'),
            'kapasitas' => set_value('kapasitas'),
            'fasilitas' => set_value('fasilitas'),
             'id_kampus' => set_value('id_kampus'),
            'foto'		=> set_value('foto'),
            'kampus_options'	=> $this->option,
    	);
    	$this->content = 'admin/master_ruang/ruang_form';
        $this->layout();

    }
    public function create_action(){
        $this->_rules();
        $name='';

        if ($_FILES['foto']['size']>0) {
         	$conf = getConfigUpload($_FILES['foto']['name']);

            $this->load->library('upload',$conf);
            if ($_FILES['foto']['name']&&!$this->upload->do_upload('foto')) {
                 echo "gagal";
            }else{
                $name = $conf['file_name'];
                $image_data = $this->upload->data();
                $config_thumb = getConfigThumb($image_data['full_path']);
                $this->load->library('image_lib', $config_thumb);
                $this->image_lib->resize(); 
            }
        }

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
				'nama' => $this->input->post('nama',TRUE),
				'kapasitas' =>$this->input->post('kapasitas',TRUE),
            	'fasilitas' => $this->input->post('fasilitas',TRUE),
            	'foto'		=> $name,
            	'id_kampus' => $this->input->post('id_kampus',TRUE),
		    );

            $this->ruang_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('master_ruang'));
        }
    }

    public function update($id){
    	$row = $this->ruang_model->get_by_id($id);
    	$kampus = $this->kampus_model->get_all();
        

        if ($row) {
            $this->data = array(
                'button' => 'Update',
                'action' => site_url('master_ruang/update_action'),
				'id' => set_value('id', $row->id),
				'nama' => set_value('nama', $row->nama),
				'fasilitas' => set_value('fasilitas', $row->fasilitas),
				'kapasitas' => set_value('kapasitas', $row->kapasitas),
		     	'foto'	=>  set_value('foto', $row->foto),
	    		'id_kampus' =>set_value('kapasitas', $row->id_kampus),
	    		'kampus_options'	=> $this->option,
	    	);
            $this->content = 'admin/master_ruang/ruang_form';
        	$this->layout();
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_ruang'));
        }
    }
    public function update_action(){
    	$this->_rules();
        $name='';
    	if ($_FILES['foto']['size']>0) {
            $conf = getConfigUpload($_FILES['foto']['name']);
            $this->load->library('upload',$conf);
            
            if ($_FILES['foto']['name']&&!$this->upload->do_upload('foto')) {
                 echo "gagal";
            }else{
                $name =  $conf['file_name'];
                $image_data = $this->upload->data();
                $config_thumb = getConfigThumb($image_data['full_path']);
                $this->load->library('image_lib', $config_thumb);
                $this->image_lib->resize(); 
            }
        }

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
							'nama' => $this->input->post('nama',TRUE),
							'kapasitas' =>$this->input->post('kapasitas',TRUE),
            				'fasilitas' => $this->input->post('fasilitas',TRUE),
            				'id_kampus' => $this->input->post('id_kampus',TRUE),
	    				);

            if ($name!='') {
                $data['foto'] = $name;
                $row = $this->ruang_model->get_by_id($this->input->post('id', TRUE));
                if (!empty($row->foto) ) {
                    if ( unlink('./upload/'.$row->foto)) { 
                     $del = 1;
                    }
                    if (unlink('./upload/thumbs/'.$row->foto)) {
                         $del_thumbs = 1;
                    }
                }
            }

            $this->ruang_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('master_ruang'));
        }

    }
    

     public function delete($id) 
    {
        $row = $this->ruang_model->get_by_id($id);

        	if ($row) {
            if (!empty($row->foto) ) {
                    if ( unlink('./upload/'.$row->foto)) { 
                     $del = 1;
                    }
                    if (unlink('./upload/thumbs/'.$row->foto)) {
                         $del_thumbs = 1;
                    }
            }
            $this->ruang_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('master_ruang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_ruang'));
        }
    }





    public function _rules(){
    	$this->form_validation->set_rules('nama', ' ', 'trim|required');
    	$this->form_validation->set_rules('fasilitas', ' ', 'trim|required');
    	$this->form_validation->set_rules('kapasitas', ' ', 'trim|required|numeric');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    	$this->form_validation->set_rules('id', 'id', 'trim');
    }



}

