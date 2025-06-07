<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi_akun_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_pengajuan()
    {
        // $this->db->select('pengajuan.*, desa.nama_desa, desa.kecamatan_id, kecamatan.nama_kecamatan');
        // $this->db->from('pengajuan');
        // $this->db->join('desa', 'desa.id = pengajuan.desa_id');
        // $this->db->join('kecamatan', 'kecamatan.id = desa.kecamatan_id');
        
        $this->db->select('*');
        $this->db->from('pengajuan');
        $this->db->join('desa', 'desa.id = pengajuan.desa_id');
        $this->db->join('kecamatan', 'kecamatan.id = desa.kecamatan_id');
        
        return $this->db->get()->result();
    }

    public function get_pengajuan_by_id($id)
    {
        // $this->db->select('pengajuan.*, desa.*, kecamatan.nama_kecamatan');
        // $this->db->from('pengajuan');
        
        $this->db->select('*');
        $this->db->from('pengajuan');
        $this->db->join('desa', 'desa.id = pengajuan.desa_id');
        $this->db->join('kecamatan', 'kecamatan.id = desa.kecamatan_id');
        $this->db->where('pengajuan.id', $id);
        return $this->db->get()->row();
    }

    public function get_pengajuan_by_desa($desa_id)
    {
        $this->db->select('pengajuan.*, desa.nama_desa');
        $this->db->from('pengajuan');
        $this->db->join('desa', 'desa.id = pengajuan.desa_id');
        $this->db->where('pengajuan.desa_id', $desa_id);
        return $this->db->get()->result();
    }

    public function get_pengajuan_by_kecamatan($kecamatan_id)
    {
        $this->db->select('pengajuan.*, desa.nama_desa');
        $this->db->from('pengajuan');
        $this->db->join('desa', 'desa.id = pengajuan.desa_id');
        $this->db->where('desa.kecamatan_id', $kecamatan_id);
        return $this->db->get()->result();
    }

    public function create_pengajuan($data)
    {
        $this->db->insert('pengajuan', $data);
        return $this->db->insert_id();
    }

    public function update_pengajuan($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('pengajuan', $data);
    }

    public function delete_pengajuan($id)
    {
        return $this->db->delete('pengajuan', ['id' => $id]);
    }

    public function get_dokumen_by_pengajuan($pengajuan_id)
    {
        return $this->db->get_where('dokumen', ['pengajuan_id' => $pengajuan_id])->result();
    }

    public function add_dokumen($data)
    {
        return $this->db->insert('dokumen', $data);
    }

    public function update_status($id, $status, $user_id, $catatan = '')
    {
        $pengajuan = $this->get_pengajuan_by_id($id);
        
        // Record history
        $history_data = [
            'pengajuan_id' => $id,
            'user_id' => $user_id,
            'status_sebelum' => $pengajuan->status,
            'status_sesudah' => $status,
            'catatan' => $catatan
        ];
        $this->db->insert('riwayat_pengajuan', $history_data);

        // Update status
        $update_data = [
            'status' => $status,
            'tanggal_verifikasi' => date('Y-m-d H:i:s'),
            'verifikator_id' => $user_id,
            'catatan' => $catatan
        ];
        
        $this->db->where('id', $id);
        return $this->db->update('pengajuan', $update_data);
    }

    public function get_riwayat_pengajuan($pengajuan_id)
    {
        $this->db->select('riwayat_pengajuan.*, users.nama_lengkap');
        $this->db->from('riwayat_pengajuan');
        $this->db->join('users', 'users.id = riwayat_pengajuan.user_id');
        $this->db->where('riwayat_pengajuan.pengajuan_id', $pengajuan_id);
        $this->db->order_by('riwayat_pengajuan.created_at', 'DESC');
        return $this->db->get()->result();
    }
    
} 