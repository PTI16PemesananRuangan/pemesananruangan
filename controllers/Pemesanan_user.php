<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pemesanan_user extends user_controller
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
        $userId =  $this->session->userdata('username_id');

        $config['base_url'] = base_url() . 'pemesanan_user/index/';
        $config['total_rows'] = $this->pemesanan_model->total_rows_user($userId);
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['suffix'] = '';
        $config['first_url'] = base_url() . 'pemesanan_user';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(3, 0);
        $daftar_pemesanan = $this->pemesanan_model->index_limit_user($config['per_page'], $start, $order,$type, $userId);


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
            'pemesan_order' => site_url('pemesanan_user?order=u.name&type='.  $ordering),
            'ruang_order' =>  site_url('pemesanan_user?order=r.nama&type='.  $ordering),
            'tanggal_order' => site_url('pemesanan_user?order=tanggal_mulai&type='.  $ordering),
            'jam_order' => site_url('pemesanan_user?order=jam_mulai&type='.  $ordering),
            'acara_order' => site_url('pemesanan_user?order=acara&type='.  $ordering),
            'status_order' => site_url('pemesanan_user?order=status&type='.  $ordering),
        );

         $this->content = 'user/pemesanan_user/pemesanan_list';
        $this->layout();
    }
    
    public function search() 
    {
        $config = array();
        $config['base_url'] = base_url().'/pemesanan_user/search/';

        if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;

        $keyword = $this->input->get('keyword', TRUE);
        $kolom = $this->input->get('kolom', TRUE)  ;
           $userId =  $this->session->userdata('username_id');


        $config["total_rows"] = $this->pemesanan_model->search_total_rows_user($keyword,$kolom,   $userId);
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);


        $start = ($page-1)*$config["per_page"];
        $daftar_pemesanan = $this->pemesanan_model->search_index_limit_user($config['per_page'], $start, $keyword,$kolom,$userId);
       

        $this->data = array(
            'daftar_pemesanan_data' => $daftar_pemesanan,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'kolom' => $kolom,
             'pemesan_order' => site_url('pemesanan_user?order=u.name&type='),
            'ruang_order' =>  site_url('pemesanan_user?order=r.nama&type='),
            'tanggal_order' => site_url('pemesanan_user?order=tanggal_mulai&type='),
            'jam_order' => site_url('pemesanan_user?order=jam_mulai&type='),
            'acara_order' => site_url('pemesanan_user?order=acara&type='),
            'status_order' => site_url('pemesanan_user?order=status&type='),
        );

        $this->content = 'user/pemesanan_user/pemesanan_list';
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
        'tanggal_pesan' => $row->tanggal_pesan!='0000-00-00' and $row->tanggal_pesan!=null  ?  date_formater( $row->tanggal_pesan) : '',
		'jam_mulai' => $row->jam_mulai,
		'jam_selesai' => $row->jam_selesai,
		'acara' => $row->acara,
		'ketua_acara' => $row->ketua_acara,
		'jumlah_peserta' => $row->jumlah_peserta,
		'status' => $row->status,
	    );
           // $this->load->view('pemesanan_read', $data);
               $this->content = 'user/pemesanan_user/pemesanan_read';
        $this->layout();

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pemesanan_user'));
        }
    }
    

    public function delete($id) 
    {
        $row = $this->pemesanan_model->get_by_id($id);

        if ($row) {
            $this->pemesanan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pemesanan_user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pemesanan_user'));
        }
    }

   

   

};

/* End of file Daftar_pemesanan.php */
/* Location: ./application/controllers/Daftar_pemesanan.php */
