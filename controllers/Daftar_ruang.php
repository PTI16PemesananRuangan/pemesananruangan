<?php 
	if (!defined('BASEPATH'))
    	exit('No direct script access allowed');


      

    class Daftar_ruang extends user_controller{
    
    	private $kampus_option = array('','--');
    	 private $ruang_option = array('','--');
    	  private $field_option = array('','--');

    	function __construct(){
    		parent::__construct();		
    		$this->load->library('form_validation');
    		$this->load->helper(array('form','url'));
    		$this->load->model('kampus_model');
    		$this->load->model('ruang_model');
    		$this->load->model('pemesanan_model');
    		$this->load->helper('uploading');
    		$this->load->library('session');
    		 $this->load->library('pagination');
    		 $this->init();
    	}

    	public function init(){
    		$kampus = $this->kampus_model->get_all();
    		foreach ($kampus as $key => $value) {
   				  $this->kampus_option[$value->id] = $value->nama; 
    		}

    		$ruang = $this->ruang_model->get_all();
        	foreach ($ruang as $key => $value) {
                $this->ruang_option[$value->id] = $value->nama; 
        	}
    	}


    	public function index(){

    		$id_kampus = isset($_GET['id_kampus'])?$_GET['id_kampus']:null;
    		$keyword = '';
    		$config['base_url'] = base_url().'daftar_ruang/index/';
    		if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        	$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);	
    		$config['total_rows'] =  $this->ruang_model->total_rows($id_kampus);
    		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
    		$config['per_page'] = 10;
    		$config['uri_segment'] = 3;
    		$config['use_page_numbers'] = TRUE;
    		$config['first_url'] = base_url().'daftar_ruang';
    		$this->pagination->initialize($config);
    		$start = ($page-1)*$config["per_page"];
    		$daftar_ruang = $this->ruang_model->index_limit($config['per_page'], $start,$id_kampus);
    		$this->data = array(
    			'daftar_ruang' => $daftar_ruang,
    			'keyword'      => $keyword,
    			'pagination' => $this->pagination->create_links(),
    			'total_rows' => $config['total_rows'],
    			'start' 	 => $start,
    			'kampus_option' => $this->kampus_option,
    			'id_kampus'		=> isset($_GET['id_kampus'])?$_GET['id_kampus']:'' ,
    			'search'		=> isset($_GET['txtsearch'])?$_GET['txtsearch']:'',
    		);


    		$this->content = 'user/daftar_ruang/index';
    		$this->layout();
    	}
    	public function search(){
    		$config = array();
	        $config["base_url"] = base_url() . "/daftar_ruang/search/";
	        $_GET['txtsearch'] = isset($_GET['txtsearch'])?$_GET['txtsearch']:'';

	        if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
	        $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
	        $config["total_rows"] = $this->ruang_model->search_total_rows($_GET['txtsearch']) ;
	        $config["per_page"] = 10;
	        $config["uri_segment"] = 3;
        	$config['use_page_numbers'] = TRUE;

        	$start = ($page-1)*$config["per_page"];

        	$this->pagination->initialize($config);
        	$daftar_ruang = $this->ruang_model->search_index_limit($config["per_page"], $start ,$_GET['txtsearch']);

        	$this->data = array(
    			'daftar_ruang' => $daftar_ruang,
    			'pagination' => $this->pagination->create_links(),
    			'total_rows' => $config['total_rows'],
    			'start' 	 => $start,
    			'kampus_option' => $this->kampus_option,
    			'id_kampus'		=> isset($_GET['id_kampus'])?$_GET['id_kampus']:'' ,
    			'search'		=> isset($_GET['txtsearch'])?$_GET['txtsearch']:'',
    		);

    		$this->content = 'user/daftar_ruang/index';
    		$this->layout();

    	}


    	public function booking($id){
    		// echo 'masuk'; die();
    		$userId =  $this->session->userdata('username_id');
    		$ruangId = $id;

    		$this->data = array(
		        'button' => 'Create',
		        'action' => site_url('daftar_ruang/booking_action'),
		        'ruang_option' => $this->ruang_option,
				'id' => set_value('id'),
				'id_member' => set_value('id_member', $userId),
				'id_ruangan' => set_value('id_ruangan', $id),
				'tanggal_mulai' => set_value('tanggal_mulai'),
				'tanggal_selesai' => set_value('tanggal_selesai'),
				'jam_mulai' => set_value('jam_mulai'),
				'jam_selesai' => set_value('jam_selesai'),
				'acara' => set_value('acara'),
				'ketua_acara' => set_value('ketua_acara'),
				'jumlah_peserta' => set_value('jumlah_peserta'),
				'status' => set_value('status'),
			);


    		$this->content = 'user/daftar_ruang/bookingform';
    		$this->layout();


    	}

    	public function booking_action(){
    		$this->_rules();
    		if ($this->form_validation->run() == FALSE) {
            	$this->booking($this->input->post('id_ruangan',TRUE));
        	}else{
        		$data = array(
        			'id_member' => $this->input->post('id_member',TRUE),
					'id_ruangan' => $this->input->post('id_ruangan',TRUE),
					'tanggal_mulai' =>  date_for_mysql( $this->input->post('tanggal_mulai',TRUE) )  ,
					'tanggal_selesai' =>  date_for_mysql( $this->input->post('tanggal_selesai',TRUE) )  ,
					'jam_mulai' => $this->input->post('jam_mulai',TRUE),
					'jam_selesai' => $this->input->post('jam_selesai',TRUE),
					'acara' => $this->input->post('acara',TRUE),
					'ketua_acara' => $this->input->post('ketua_acara',TRUE),
					'jumlah_peserta' => $this->input->post('jumlah_peserta',TRUE),
                    'tanggal_pesan' => date('Y-m-d'),
					'status' => $this->input->post('status',TRUE),
        		);

        		$this->pemesanan_model->insert($data);
            	$this->session->set_flashdata('message', 'Pemesanan Berhasil');
            	redirect(site_url('pemesanan_user'));

        	}
    	}



    	 public function _rules() 
	    {
			$this->form_validation->set_rules('id_member', ' ', 'trim|required|numeric');
			$this->form_validation->set_rules('id_ruangan', ' ', 'trim|required|numeric');
			$this->form_validation->set_rules('tanggal_mulai', ' ', 'trim|required');
			$this->form_validation->set_rules('tanggal_selesai', ' ', 'trim|required');
			$this->form_validation->set_rules('jam_mulai', ' ', 'trim|required');
			$this->form_validation->set_rules('jam_selesai', ' ', 'trim|required');
			$this->form_validation->set_rules('acara', ' ', 'trim|required');
			$this->form_validation->set_rules('ketua_acara', ' ', 'trim|required');
			$this->form_validation->set_rules('jumlah_peserta', ' ', 'trim|required|numeric');
			$this->form_validation->set_rules('status', ' ', 'trim|required|numeric');

			$this->form_validation->set_rules('id', 'id', 'trim');
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	    }



    	public function detail($id){
    		$pemesanan = $this->transform($this->pemesanan_model->get_all_byruang($id));
    	
    		$row = $this->ruang_model->get_by_id($id);
    		 if ($row) {
	            $this->data = array(
					'id' => $row->id,
					'nama' => $row->nama,
					'fasilitas' => $row->fasilitas,
					'kapasitas' => $row->kapasitas,
			     	'foto'	=> $row->foto,
			     	'id_kampus' => $row->id_kampus,
			     	'kampus_option' => $this->kampus_option,
			     	'pemesanan'		=> $pemesanan,
		    	);

	            $this->content = 'user/daftar_ruang/detail';
	        	$this->layout();
	        } else {
	            $this->session->set_flashdata('message', 'Record Not Found');
	            redirect(site_url('daftar_ruang'));
	        }
    	}

    	public function transform($pemesanan){
    		// print_r($pemesanan); die();
    		$ret = array();
    		foreach ($pemesanan as $key => $value) {
    			$tanggal_mulai = explode('-', $value->tanggal_mulai);
    			$tanggal_selesai = explode('-', $value->tanggal_selesai);
    			$jam_mulai = preg_split("/[.:]/", $value->jam_mulai);
    			$jam_selesai = preg_split("/[.:]/", $value->jam_selesai);
    			$ret[] = array(
    				'title' => $value->acara.' ('.$value->pemesan.')',
    				'start' =>  $value->tanggal_mulai.' '.$jam_mulai[0].':'.$jam_mulai[1].":00" ,
    				'end'	=>    $value->tanggal_selesai.' '.$jam_selesai[0].':'.$jam_selesai[1].":00",
    			);
    		}
    		return json_encode($ret);
    	}



    }



?>