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

    // get data by id
    function get_by_id($id)
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

    // get data with limit
    function index_limit($limit, $start = 0) {

        $this->db->limit($limit, $start);

        $this->db->order_by('p.'.$this->id, $this->order);
        $return =  $this->db->select('p.*, u.name as pemesan, r.nama as ruang')
                        ->from('pemesanan p')
                        ->join('users u','p.id_member=u.id')
                        ->join('ruangan r', 'r.id=p.id_ruangan')
                        ->get()
                        ->result();

        return $return;
    }
    
    // get search total rows
    function search_total_rows($keyword = NULL) {
        $this->db->like('id', $keyword);
	$this->db->or_like('id_member', $keyword);
	$this->db->or_like('id_ruangan', $keyword);
	$this->db->or_like('tanggal_mulai', $keyword);
	$this->db->or_like('tanggal_selesai', $keyword);
	$this->db->or_like('jam_mulai', $keyword);
	$this->db->or_like('jam_selesai', $keyword);
	$this->db->or_like('acara', $keyword);
	$this->db->or_like('ketua_acara', $keyword);
	$this->db->or_like('jumlah_peserta', $keyword);
	$this->db->or_like('status', $keyword);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $keyword);
	$this->db->or_like('id_member', $keyword);
	$this->db->or_like('id_ruangan', $keyword);
	$this->db->or_like('tanggal_mulai', $keyword);
	$this->db->or_like('tanggal_selesai', $keyword);
	$this->db->or_like('jam_mulai', $keyword);
	$this->db->or_like('jam_selesai', $keyword);
	$this->db->or_like('acara', $keyword);
	$this->db->or_like('ketua_acara', $keyword);
	$this->db->or_like('jumlah_peserta', $keyword);
	$this->db->or_like('status', $keyword);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
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