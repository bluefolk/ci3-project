<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kecamatan_model extends CI_Model {
    
    private $table = 'kecamatan';
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_all() {
        $this->db->order_by('nama_kecamatan', 'ASC');
        return $this->db->get($this->table)->result();
    }
    
    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }
    
    public function create($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
    
    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
} 