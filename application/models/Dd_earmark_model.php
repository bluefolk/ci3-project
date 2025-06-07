<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dd_earmark_model extends CI_Model {
    
    private $table = 'dd_earmark';
    private $document_table = 'dd_earmark_dokumen';
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_all() {
        $this->db->select('p.*, d.nama_desa, k.nama_kecamatan');
        $this->db->from($this->table . ' p');
        $this->db->join('desa d', 'd.id = p.desa_id');
        $this->db->join('kecamatan k', 'k.id = d.kecamatan_id');
        $this->db->order_by('p.created_at', 'DESC');
        return $this->db->get()->result();
    }
    
    public function get_by_id($id) {
        $this->db->select('p.*, d.nama_desa, d.nama_kepala_desa, d.no_kontak_kades, d.nama_bank, d.no_rekening, k.nama_kecamatan');
        $this->db->from($this->table . ' p');
        $this->db->join('desa d', 'd.id = p.desa_id');
        $this->db->join('kecamatan k', 'k.id = d.kecamatan_id');
        $this->db->where('p.id', $id);
        return $this->db->get()->row();
    }
    
    public function create($data) {
        unset($data['jenis_pengajuan']); 
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function update($id, $data) {
        unset($data['jenis_pengajuan']);
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
    
    public function delete($id) {
        $this->db->where('dd_earmark_id', $id);
        $this->db->delete($this->document_table);
        
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
    
    public function get_documents($dd_earmark_id) {
        $this->db->where('dd_earmark_id', $dd_earmark_id);
        return $this->db->get($this->document_table)->result();
    }
    
    public function add_document($data) {
        return $this->db->insert($this->document_table, $data);
    }
    
    public function update_status($id, $status, $catatan = '') {
        $data = array(
            'status' => $status,
            'tanggal_verifikasi' => date('Y-m-d H:i:s'),
            'catatan' => $catatan
        );
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
} 