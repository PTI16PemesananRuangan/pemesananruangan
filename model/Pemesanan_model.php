<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pemesanan_model extends CI_Model
{

    public $table = 'pemesanan';
    public $id = 'id';
    public $order = 'DESC';


    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by('p.'.$this->id, $this->order);
        $return =  $this->db->select('p.*, u.name as pemesan, r.nama as ruang')
                        ->from('pemesanan p')
                        ->join('users u','p.id_member=u.id')
                        ->join('ruangan r', 'r.id=p.id_ruangan')
                        ->get()
                        ->result();


        return $return;
    }
    function get_all_byruang($id)//pencarian data berdasarkan ruang
    {
        $this->db->order_by('p.'.$this->id, $this->order);
        $return =  $this->db->select('p.*, u.name as pemesan, r.nama as ruang')
                        ->from('pemesanan p')
                        ->join('users u','p.id_member=u.id')
                        ->join('ruangan r', 'r.id=p.id_ruangan')
                        ->where('p.id_ruangan',$id)
                        ->where('p.status',1)
                        ->get()
                        ->result();
        return $return;
    }

    // get data by id
    function get_by_id($id)//pencarian data berdasarkan id
    {
        $this->db->where('p.'.$this->id, $id);
         $return =  $this->db->select('p.*, u.name as pemesan, r.nama as ruang')
                        ->from('pemesanan p')
                        ->join('users u','p.id_member=u.id')
                        ->join('ruangan r', 'r.id=p.id_ruangan')
                        ->get()
                        ->row();


        return $return;
    }
    
    // get total rows
    function total_rows() {
        $this->db->from($this->table);

        return $this->db->count_all_results();
    }

    function total_rows_user($userId) {
        $this->db->from($this->table);
           $this->db->where('id_member', $userId);
        return $this->db->count_all_results();
    }

    // get data with limit
    function index_limit($limit, $start = 0, $kolom, $type=null) {

        if ($type==null) {
            $type = 'asc';
        }

        $this->db->limit($limit, $start);
        if ($kolom==null) 
            $this->db->order_by('p.'.$this->id, $this->order);
        else
             $this->db->order_by($kolom, $type);

        $return =  $this->db->select('p.*, u.name as pemesan, r.nama as ruang')
                        ->from('pemesanan p')
                        ->join('users u','p.id_member=u.id')
                        ->join('ruangan r', 'r.id=p.id_ruangan')
                        ->get()
                        ->result();

        return $return;
    }


    function index_limit_user($limit, $start = 0, $kolom, $type=null, $user) {

        if ($type==null) {
            $type = 'asc';
        }

        $this->db->limit($limit, $start);
        if ($kolom==null) 
            $this->db->order_by('p.'.$this->id, $this->order);
        else
             $this->db->order_by($kolom, $type);

        $return =  $this->db->select('p.*, u.name as pemesan, r.nama as ruang')
                        ->from('pemesanan p')
                        ->join('users u','p.id_member=u.id')
                        ->join('ruangan r', 'r.id=p.id_ruangan')
                        ->where('id_member',$user)
                        ->get()
                        ->result();

        return $return;
    }

    
    // get search total rows
    function search_total_rows($keyword = NULL, $kolom= null) {
     
        $this->db->like($kolom,$keyword); 
       
        $return =  $this->db->select('p.*, u.name as pemesan, r.nama as ruang')
                        ->from('pemesanan p')
                        ->join('users u','p.id_member=u.id')
                        ->join('ruangan r', 'r.id=p.id_ruangan')
                        ->count_all_results();
        return $return;
    }

    function search_total_rows_user($keyword = NULL, $kolom= null, $user) {
     
        $this->db->like($kolom,$keyword); 
       
        $return =  $this->db->select('p.*, u.name as pemesan, r.nama as ruang')
                        ->from('pemesanan p')
                        ->join('users u','p.id_member=u.id')
                        ->join('ruangan r', 'r.id=p.id_ruangan')
                        ->where('id_member', $user)
                        ->count_all_results();
        return $return;
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL, $kolom= null) {
        $this->db->order_by('p.'.$this->id, $this->order);
        $this->db->like($kolom,$keyword);
        //$this->db->like('id', $keyword);
    	// $this->db->or_like('u.name', $keyword);
    	// $this->db->or_like('r.nama', $keyword);
    	// $this->db->or_like('tanggal_mulai', $keyword);
    	// $this->db->or_like('tanggal_selesai', $keyword);
    	// $this->db->or_like('jam_mulai', $keyword);
    	// $this->db->or_like('jam_selesai', $keyword);
    	// $this->db->or_like('acara', $keyword);
    	// $this->db->or_like('ketua_acara', $keyword);
    	// $this->db->or_like('jumlah_peserta', $keyword);
    	// $this->db->or_like('status', $keyword);


    	$this->db->limit($limit, $start);


        $return =  $this->db->select('p.*, u.name as pemesan, r.nama as ruang')
                        ->from('pemesanan p')
                        ->join('users u','p.id_member=u.id')
                        ->join('ruangan r', 'r.id=p.id_ruangan')
                        ->get()
                        ->result();

        return $return;

        // return $this->db->get($this->table)->result();
    }
     function search_index_limit_user($limit, $start = 0, $keyword = NULL, $kolom= null, $user) {
        $this->db->order_by('p.'.$this->id, $this->order);
        $this->db->like($kolom,$keyword);
        //$this->db->like('id', $keyword);
        // $this->db->or_like('u.name', $keyword);
        // $this->db->or_like('r.nama', $keyword);
        // $this->db->or_like('tanggal_mulai', $keyword);
        // $this->db->or_like('tanggal_selesai', $keyword);
        // $this->db->or_like('jam_mulai', $keyword);
        // $this->db->or_like('jam_selesai', $keyword);
        // $this->db->or_like('acara', $keyword);
        // $this->db->or_like('ketua_acara', $keyword);
        // $this->db->or_like('jumlah_peserta', $keyword);
        // $this->db->or_like('status', $keyword);


        $this->db->limit($limit, $start);


        $return =  $this->db->select('p.*, u.name as pemesan, r.nama as ruang')
                        ->from('pemesanan p')
                        ->join('users u','p.id_member=u.id')
                        ->join('ruangan r', 'r.id=p.id_ruangan')
                         ->where('id_member', $user)
                        ->get()
                        ->result();

        return $return;

        // return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Pemesanan_model.php */
/* Location: ./application/models/Pemesanan_model.php */
