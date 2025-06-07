<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita_acara_model extends CI_Model
{
    private $table = 'berita_acara';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_bap()
    {
        // $this->db->select('pengajuan.*, desa.nama_desa, desa.kecamatan_id, kecamatan.nama_kecamatan');
        // $this->db->from('pengajuan');
        // $this->db->join('desa', 'desa.id = pengajuan.desa_id');
        // $this->db->join('kecamatan', 'kecamatan.id = desa.kecamatan_id');

        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->join('desa', 'desa.id = berita_acara.desa_id');
        $this->db->join('kecamatan', 'kecamatan.id = desa.kecamatan_id');

        return $this->db->get()->result();
    }

    public function get_bap_by_id($id)
    {
        $this->db->select('berita_acara.*, desa.*, kecamatan.nama_kecamatan');
        $this->db->from('berita_acara');
        $this->db->join('desa', 'desa.id = berita_acara.desa_id');
        $this->db->join('kecamatan', 'kecamatan.id = desa.kecamatan_id');
        $this->db->where('berita_acara.id', $id);
        return $this->db->get()->row();
    }


    public function get_all($status = null, $keyword = null)
    {
        $this->db->select('p.*, d.nama_desa, k.nama_kecamatan');
        $this->db->from($this->table . ' p');
        $this->db->join('desa d', 'd.id = p.desa_id');
        $this->db->join('kecamatan k', 'k.id = d.kecamatan_id');
        // $this->db->where('p.jenis_pengajuan', 'dana_desa');

        if ($status) {
            $this->db->where('p.jenis_pengajuan', $status);
        }

        if ($keyword) {
            $this->db->group_start();
            $this->db->like('d.nama_desa', $keyword);
            $this->db->or_like('k.nama_kecamatan', $keyword);
            $this->db->or_like('p.status', $keyword);
            $this->db->or_like('p.no_bap', $keyword);
            $this->db->or_like('p.no_pengajuan', $keyword);
            $this->db->or_where("REPLACE(p.jenis_pengajuan, '_', ' ') LIKE", '%' . $keyword . '%');
            $this->db->or_like('p.tanggal_pengajuan', $keyword);
            $this->db->group_end();
        }

        $this->db->order_by('p.tanggal_pengajuan', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_id($id)
    {
        $this->db->select('p.*, d.nama_desa, d.nama_kepala_desa, d.no_kontak_kades, d.nama_bank, d.no_rekening, k.nama_kecamatan');
        $this->db->from($this->table . ' p');
        $this->db->join('desa d', 'd.id = p.desa_id');
        $this->db->join('kecamatan k', 'k.id = d.kecamatan_id');
        $this->db->where('p.id', $id);
        // $this->db->where('p.jenis_pengajuan', 'dana_desa');
        return $this->db->get()->row();
    }

    public function create($data)
    {
        // $data['jenis_pengajuan'] = 'dana_desa';
        $data['tanggal_pengajuan'] = date('Y-m-d H:i:s');
        $data['tanggal_verifikasi'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        // $this->db->where('jenis_pengajuan', 'dana_desa');
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        // First, delete related documents from the 'dokumen' table
        $this->db->where('berita_acara_id', $id);
        $this->db->delete('bap_dokumen');

        // Then, delete the main pengajuan record
        $this->db->where('id', $id);
        // $this->db->where('jenis_pengajuan', 'dana_desa');
        return $this->db->delete($this->table);
    }

    public function get_documents($pengajuan_id)
    {
        $this->db->where('berita_acara_id', $pengajuan_id);
        return $this->db->get('bap_dokumen')->result();
    }

    public function add_document($data)
    {
        return $this->db->insert('bap_dokumen', $data);
    }

    public function update_status($id, $status, $verifikator_id, $catatan = '', )
    {
        date_default_timezone_set('Asia/Jayapura'); // WIT
        $data = array(
            'status' => $status,
            'tanggal_verifikasi' => date('Y-m-d H:i:s'),
            'verifikator_id' => $verifikator_id, // Assuming this is passed in the method
            'catatan' => $catatan
        );
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }


    public function get_paginated($limit, $offset, $status = null, $keyword = null, $jenis_pengajuan = null)
    {
        $this->db->select('p.*, d.nama_desa, d.kode_desa, k.nama_kecamatan');
        $this->db->from($this->table . ' p');
        $this->db->join('desa d', 'd.id = p.desa_id');
        $this->db->join('kecamatan k', 'k.id = d.kecamatan_id');

        if ($status) {
            $this->db->where('p.status', $status);
        }
        if ($jenis_pengajuan) {
            $this->db->where('p.jenis_pengajuan', $jenis_pengajuan);
        }
        if ($keyword) {
            $this->db->group_start();
            $this->db->like('d.nama_desa', $keyword);
            $this->db->or_like('k.nama_kecamatan', $keyword);
            $this->db->or_like('p.status', $keyword);
            $this->db->or_like('p.jumlah_bantuan', $keyword);
            $this->db->or_like('p.no_pengajuan', $keyword);
            $this->db->or_where("REPLACE(p.jenis_pengajuan, '_', ' ') LIKE", '%' . $keyword . '%');
            $this->db->or_like('p.tanggal_pengajuan', $keyword);
            $this->db->group_end();
        }

        $this->db->order_by('p.tanggal_pengajuan', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
    public function count_all()
    {
        return $this->db->count_all($this->table);
    }

    public function count_filtered($status = null, $keyword = null, $jenis_pengajuan = null)
    {
        $this->db->from($this->table . ' p');
        $this->db->join('desa d', 'd.id = p.desa_id');
        $this->db->join('kecamatan k', 'k.id = d.kecamatan_id');

        if ($status) {
            $this->db->where('p.status', $status);
        }
        if ($jenis_pengajuan) {
            $this->db->where('p.jenis_pengajuan', $jenis_pengajuan);
        }
        if ($keyword) {
            $this->db->group_start();
            $this->db->like('d.nama_desa', $keyword);
            $this->db->or_like('k.nama_kecamatan', $keyword);
            $this->db->or_like('p.status', $keyword);
            $this->db->or_like('p.jumlah_bantuan', $keyword);
            $this->db->or_like('p.no_pengajuan', $keyword);
            // $this->db->or_where("REPLACE(p.jenis_pengajuan, '_', ' ') LIKE", '%' . $keyword . '%');
            $this->db->or_like('p.tanggal_pengajuan', $keyword);
            $this->db->group_end();
        }

        return $this->db->count_all_results();
    }
}