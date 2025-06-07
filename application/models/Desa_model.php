<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desa_model extends CI_Model {

    private $table = 'desa';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all()
    {
        $this->db->select('d.*, k.nama_kecamatan');
        $this->db->from($this->table . ' d');
        $this->db->join('kecamatan k', 'k.id = d.kecamatan_id');
        $this->db->order_by('d.nama_desa', 'ASC');
        return $this->db->get()->result();
    }

    public function get_by_id($id)
    {
        $this->db->select('d.*, k.nama_kecamatan');
        $this->db->from($this->table . ' d');
        $this->db->join('kecamatan k', 'k.id = d.kecamatan_id');
        $this->db->where('d.id', $id);
        return $this->db->get()->row();
    }

    public function get_by_kecamatan($kecamatan_id)
    {
        $this->db->where('kecamatan_id', $kecamatan_id);
        $this->db->order_by('nama_desa', 'ASC');
        return $this->db->get($this->table)->result();
    }

    public function create($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    public function get_all_kecamatan()
    {
        return $this->db->get('kecamatan')->result();
    }

    public function get_kecamatan_by_id($id)
    {
        return $this->db->get_where('kecamatan', ['id' => $id])->row();
    }

    public function create_kecamatan($data)
    {
        return $this->db->insert('kecamatan', $data);
    }

    public function update_kecamatan($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('kecamatan', $data);
    }

    public function delete_kecamatan($id)
    {
        return $this->db->delete('kecamatan', ['id' => $id]);
    }

    // New method to update specific desa details
    public function update_desa_details($id, $data) {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }
} 