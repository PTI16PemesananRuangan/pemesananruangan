<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Daftar_pemesanan extends My_Controller
{
    private $user_option = array('','--');
    private $ruang_option = array('','--');
    private $field_option = array('','--');

    function __construct()
    {
        parent::__construct();
        $this->load->model('ruang_model');
        $this->load->model('users_model');
        $this->load->model('pemesanan_model');
        $this->load->library('form_validation');
        $this->load->helper('uploading');
        $this->load->library('pagination');
        $this->init();
        $this->_bulan = array(
            "januari", 'februari','maret','april',
            'mei', 'juni', 'juli', 'agustus', 'september',
            'oktober','november','desember'
        );
    }

    public function init(){
        $user = $this->users_model->get_all();
        foreach ($user as $key => $value) {
                $this->user_option[$value->id] = $value->name; 
        }

        $ruang = $this->ruang_model->get_all();
        foreach ($ruang as $key => $value) {
                $this->ruang_option[$value->id] = $value->nama; 
        }



    }


    public function index()
    {
        $keyword = '';
        $this->load->library('pagination');
        $order = null;
        $type = null;
        if (isset($_GET['order']) ) {
            $order = $_GET['order'];
        }
        if (isset($_GET['type']) ) {
            $type = $_GET['type'];
        }

        $config['base_url'] = base_url() . 'daftar_pemesanan/index/';
        $config['total_rows'] = $this->pemesanan_model->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['suffix'] = '';
        $config['first_url'] = base_url() . 'daftar_pemesanan';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(3, 0);
        $daftar_pemesanan = $this->pemesanan_model->index_limit($config['per_page'], $start, $order,$type);


        if (isset($_GET['type'])&&$_GET['type']=='asc') {
            $ordering = 'desc';
        }else{
            if (isset($_GET['type'])&&$_GET['type']=='desc') {
                $ordering = 'asc';
            }else if (isset($_GET['type'])&&$_GET['type']=='asc') {
                $ordering = 'desc';
            }else{
                $ordering = 'asc';
            }
        }
        

        $this->data = array(
            'daftar_pemesanan_data' => $daftar_pemesanan,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'kolom'      => set_value('kolom'),
            'start' => $start,
            'pemesan_order' => site_url('daftar_pemesanan?order=u.name&type='.  $ordering),
            'ruang_order' =>  site_url('daftar_pemesanan?order=r.nama&type='.  $ordering),
            'tanggal_order' => site_url('daftar_pemesanan?order=tanggal_mulai&type='.  $ordering),
            'jam_order' => site_url('daftar_pemesanan?order=jam_mulai&type='.  $ordering),
            'acara_order' => site_url('daftar_pemesanan?order=acara&type='.  $ordering),
            'status_order' => site_url('daftar_pemesanan?order=status&type='.  $ordering),
        );

         $this->content = 'admin/daftar_pemesanan/pemesanan_list';
        $this->layout();
    }
    
    public function search() 
    {
        $config = array();
        $config['base_url'] = base_url().'/daftar_pemesanan/search/';

        if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;

        $keyword = $this->input->get('keyword', TRUE);
        $kolom = $this->input->get('kolom', TRUE)  ;

        $config["total_rows"] = $this->pemesanan_model->search_total_rows($keyword,$kolom);
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);


        $start = ($page-1)*$config["per_page"];
        $daftar_pemesanan = $this->pemesanan_model->search_index_limit($config['per_page'], $start, $keyword,$kolom);
       

        $this->data = array(
            'daftar_pemesanan_data' => $daftar_pemesanan,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'kolom' => $kolom,
             'pemesan_order' => site_url('daftar_pemesanan?order=u.name&type='),
            'ruang_order' =>  site_url('daftar_pemesanan?order=r.nama&type='),
            'tanggal_order' => site_url('daftar_pemesanan?order=tanggal_mulai&type='),
            'jam_order' => site_url('daftar_pemesanan?order=jam_mulai&type='),
            'acara_order' => site_url('daftar_pemesanan?order=acara&type='),
            'status_order' => site_url('daftar_pemesanan?order=status&type='),
        );

        $this->content = 'admin/daftar_pemesanan/pemesanan_list';
        $this->layout();
    }

    public function read($id) 
    {
        $row = $this->pemesanan_model->get_by_id($id);
        if ($row) {
            $this->data = array(
		'id' => $row->id,
		'id_member' => $row->id_member,
           'status_option' => getStatus(),
        'pemesan'   => $row->pemesan,
        'ruang'     => $row->ruang,
		'id_ruangan' => $row->id_ruangan,
		'tanggal_mulai' => date_formater($row->tanggal_mulai),
		'tanggal_selesai' => date_formater( $row->tanggal_selesai),
		'jam_mulai' => $row->jam_mulai,
		'jam_selesai' => $row->jam_selesai,
		'acara' => $row->acara,
		'ketua_acara' => $row->ketua_acara,
		'jumlah_peserta' => $row->jumlah_peserta,
		'status' => $row->status,
	    );
           // $this->load->view('pemesanan_read', $data);
               $this->content = 'admin/daftar_pemesanan/pemesanan_read';
        $this->layout();

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('daftar_pemesanan'));
        }
    }
    
    public function create() 
    {
        $this->data = array(
            'button' => 'Create',
            'action' => site_url('daftar_pemesanan/create_action'),
            'ruang_option' => $this->ruang_option,
            'user_option' => $this->user_option,
            'status_option' => getStatus(),
	    'id' => set_value('id'),
	    'id_member' => set_value('id_member'),
	    'id_ruangan' => set_value('id_ruangan'),
	    'tanggal_mulai' => set_value('tanggal_mulai'),
	    'tanggal_selesai' => set_value('tanggal_selesai'),
	    'jam_mulai' => set_value('jam_mulai'),
	    'jam_selesai' => set_value('jam_selesai'),
	    'acara' => set_value('acara'),
	    'ketua_acara' => set_value('ketua_acara'),
	    'jumlah_peserta' => set_value('jumlah_peserta'),
	    'status' => set_value('status'),
	);
       // $this->load->view('pemesanan_form', $data);
           $this->content = 'admin/daftar_pemesanan/pemesanan_form';
        $this->layout();
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
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
		'status' => $this->input->post('status',TRUE),
	    );

            $this->pemesanan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('daftar_pemesanan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->pemesanan_model->get_by_id($id);

        if ($row) {

            $this->data = array(
                'button' => 'Update',
                'action' => site_url('daftar_pemesanan/update_action'),
                 'ruang_option' => $this->ruang_option,
                 'user_option' => $this->user_option,
                 'status_option' => getStatus(),
        		'id' => set_value('id', $row->id),
        		'id_member' => set_value('id_member', $row->id_member),
        		'id_ruangan' => set_value('id_ruangan', $row->id_ruangan),
        		'tanggal_mulai' => set_value('tanggal_mulai', date('d/m/Y', strtotime($row->tanggal_mulai) ) ),
        		'tanggal_selesai' => set_value('tanggal_selesai', date('d/m/Y', strtotime($row->tanggal_selesai) ) ),
        		'jam_mulai' => set_value('jam_mulai', $row->jam_mulai),
        		'jam_selesai' => set_value('jam_selesai', $row->jam_selesai),
        		'acara' => set_value('acara', $row->acara),
        		'ketua_acara' => set_value('ketua_acara', $row->ketua_acara),
        		'jumlah_peserta' => set_value('jumlah_peserta', $row->jumlah_peserta),
        		'status' => set_value('status', $row->status),
	        );
            // $this->load->view('pemesanan_form', $data);
              $this->content = 'admin/daftar_pemesanan/pemesanan_form';
             $this->layout();
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('daftar_pemesanan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
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
		'status' => $this->input->post('status',TRUE),
	    );

            $this->pemesanan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('daftar_pemesanan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->pemesanan_model->get_by_id($id);

        if ($row) {
            $this->pemesanan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('daftar_pemesanan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('daftar_pemesanan'));
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

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "pemesanan.xls";
        $judul = "pemesanan";
        $tablehead = 2;
        $tablebody = 3;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        xlsWriteLabel(0, 0, $judul);

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "no");
	xlsWriteLabel($tablehead, $kolomhead++, "id_member");
	xlsWriteLabel($tablehead, $kolomhead++, "id_ruangan");
	xlsWriteLabel($tablehead, $kolomhead++, "tanggal_mulai");
	xlsWriteLabel($tablehead, $kolomhead++, "tanggal_selesai");
	xlsWriteLabel($tablehead, $kolomhead++, "jam_mulai");
	xlsWriteLabel($tablehead, $kolomhead++, "jam_selesai");
	xlsWriteLabel($tablehead, $kolomhead++, "acara");
	xlsWriteLabel($tablehead, $kolomhead++, "ketua_acara");
	xlsWriteLabel($tablehead, $kolomhead++, "jumlah_peserta");
	xlsWriteLabel($tablehead, $kolomhead++, "status");

	foreach ($this->pemesanan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_member);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_ruangan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_mulai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_selesai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jam_mulai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jam_selesai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->acara);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ketua_acara);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah_peserta);
	    xlsWriteNumber($tablebody, $kolombody++, $data->status);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

};

/* End of file Daftar_pemesanan.php */
/* Location: ./application/controllers/Daftar_pemesanan.php */