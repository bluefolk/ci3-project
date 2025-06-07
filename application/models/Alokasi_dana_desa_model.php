<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alokasi_dana_desa_model extends CI_Model {
    
    private $table = 'dana_lain'; // Use the new table name
    private $document_table = 'dana_lain_dokumen'; // New document table
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_all() {
        $this->db->select('p.*, d.nama_desa, k.nama_kecamatan');
        $this->db->from($this->table . ' p');
        // Assuming dana_lain table still joins to desa and kecamatan
        $this->db->join('desa d', 'd.id = p.desa_id');
        $this->db->join('kecamatan k', 'k.id = d.kecamatan_id');
        // No specific jenis_pengajuan for this new table type
        $this->db->order_by('p.created_at', 'DESC'); // Assuming a created_at column
        return $this->db->get()->result();
    }
    
    public function get_by_id($id) {
        $this->db->select('p.*, d.nama_desa, d.nama_kepala_desa, d.no_kontak_kades, d.nama_bank, d.no_rekening, k.nama_kecamatan');
        $this->db->from($this->table . ' p');
        // Assuming dana_lain table still joins to desa and kecamatan
        $this->db->join('desa d', 'd.id = p.desa_id');
        $this->db->join('kecamatan k', 'k.id = d.kecamatan_id');
        $this->db->where('p.id', $id);
        return $this->db->get()->row();
    }
    
    public function create($data) {
        // Remove jenis_pengajuan as it's a separate table now
        unset($data['jenis_pengajuan']); 
        $data['created_at'] = date('Y-m-d H:i:s'); // Assuming a created_at column
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function update($id, $data) {
        // Remove jenis_pengajuan
        unset($data['jenis_pengajuan']);
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
    
    public function delete($id) {
        // First, delete related documents from the new document table
        $this->db->where('dana_lain_id', $id); // Use the new foreign key column name
        $this->db->delete($this->document_table);
        
        // Then, delete the main dana_lain record
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
    
    public function get_documents($dana_lain_id) {
        $this->db->where('dana_lain_id', $dana_lain_id); // Use the new foreign key column name
        return $this->db->get($this->document_table)->result();
    }
    
    public function add_document($data) {
        // The data array passed here should already have 'dana_lain_id', 'jenis_dokumen', 'nama_file'
        return $this->db->insert($this->document_table, $data);
    }
    
    // Assuming update_status is still needed, adjusted for the new table
    public function update_status($id, $status, $catatan = '') {
        $data = array(
            'status' => $status,
            'tanggal_verifikasi' => date('Y-m-d H:i:s'), // Assuming these columns exist in dana_lain
            'catatan' => $catatan
        );
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
} 