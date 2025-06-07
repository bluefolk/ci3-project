<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // Load database jika belum otomatis
        $this->load->database();
    }
    public function get_total_dana()
    {
        $sql = "
    SELECT 
        IFNULL(SUM(CASE WHEN jenis_pengajuan = 'dd_earmark_60' THEN 1 ELSE 0 END), 0) AS total_dd_earmark_60,
        IFNULL(SUM(CASE WHEN jenis_pengajuan = 'alokasi_dana_desa' THEN 1 ELSE 0 END), 0) AS total_add,
        IFNULL(SUM(CASE WHEN jenis_pengajuan = 'dana_lain' THEN 1 ELSE 0 END), 0) AS total_dana_lain,
        IFNULL(SUM(CASE WHEN jenis_pengajuan = 'dd_non_earmark_40' THEN 1 ELSE 0 END), 0) AS total_dd_non_earmark_40,
        IFNULL(SUM(CASE WHEN jenis_pengajuan = 'ketahanan_pangan_tpk' THEN 1 ELSE 0 END), 0) AS total_ketahanan_pangan_tpk,
        IFNULL(SUM(CASE WHEN jenis_pengajuan = 'ketahanan_pangan_bumdesa' THEN 1 ELSE 0 END), 0) AS total_ketahanan_pangan_bumdesa
    FROM pengajuan
    ";

        return $this->db->query($sql)->row();
    }

    public function get_total_status($user = null)
    {
        $whereClause = '';

        if ($user && isset($user['role']) && $user['role'] === 'admin_desa') {
            $desa_id = (int) $user['desa_id'];
            $whereClause = "WHERE desa_id = $desa_id";
        }

        $sql = "
        SELECT 
            IFNULL(SUM(CASE WHEN status = 'diajukan' THEN 1 ELSE 0 END), 0) AS total_pending,
            IFNULL(SUM(CASE WHEN status = 'diterima' THEN 1 ELSE 0 END), 0) AS total_approved,
            IFNULL(SUM(CASE WHEN status = 'ditolak' THEN 1 ELSE 0 END), 0) AS total_rejected,
            IFNULL(SUM(CASE WHEN status = 'verifikasi' THEN 1 ELSE 0 END), 0) AS total_verifikasi,
            IFNULL(SUM(CASE WHEN status = 'verifikasi_ditolak' THEN 1 ELSE 0 END), 0) AS total_verifikasi_ditolak,
            IFNULL(SUM(CASE WHEN status = 'berita_acara_siap' THEN 1 ELSE 0 END), 0) AS total_berita_acara_siap,
            IFNULL(SUM(CASE WHEN status = 'disposisi' THEN 1 ELSE 0 END), 0) AS total_disposisi,
            IFNULL(SUM(CASE WHEN status IN ('verifikasi', 'berita_acara_siap', 'disposisi') THEN 1 ELSE 0 END), 0) AS total_diproses,
            IFNULL(SUM(CASE WHEN status IN ('diajukan', 'diterima', 'ditolak', 'verifikasi', 'verifikasi_ditolak', 'berita_acara_siap', 'disposisi') THEN 1 ELSE 0 END), 0) AS total_pengajuan
        FROM pengajuan
        $whereClause
    ";

        return $this->db->query($sql)->row();
    }
}
