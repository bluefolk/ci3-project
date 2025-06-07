<?php
defined('BASEPATH') or exit('No direct script access allowed');

class History extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load necessary models here if needed
        $this->load->model('Pengajuan_model');
        $this->load->library('session');

    }

    //  public function __construct() {
    //     parent::__construct();
    //     $this->load->model('Dana_desa_model');
    //     $this->load->model('Desa_model');
    //     $this->load->model('Kecamatan_model');
    // }

    public function index()
    {
        $data['active_sidebar'] = 'history';

        $data['sidebar_menu'] = [
            ['icon' => 'fas fa-home', 'link' => 'dashboard', 'title' => 'Dashboard'],
            ['icon' => 'fas fa-clock', 'link' => 'history', 'title' => 'History'],
            ['icon' => 'fas fa-file-alt', 'link' => 'dana_desa', 'title' => 'Pengajuan Dana'],
            ['icon' => 'fas fa-cog', 'link' => 'settings', 'title' => 'Settings'],
        ];
        $data['title'] = 'SI PANDHU - History'; // Set the title for the page
        $data['pengajuan'] = $this->Pengajuan_model->get_all_pengajuan();
        $data['content'] = $this->load->view('history/index_view', $data, TRUE); // Load the content view
        $this->load->view('layout/sidebar_view', $data); // load sidebar
        $this->load->view('layout/main_layout', $data); // Load the main layout with content
    }


    public function view($id)
    {

        $data['active_sidebar'] = 'history';

        $data['sidebar_menu'] = [
            ['icon' => 'fas fa-home', 'link' => 'dashboard', 'title' => 'Dashboard'],
            ['icon' => 'fas fa-clock', 'link' => 'history', 'title' => 'History'],
            ['icon' => 'fas fa-file-alt', 'link' => 'dana_desa', 'title' => 'Pengajuan Dana'],
            ['icon' => 'fas fa-cog', 'link' => 'settings', 'title' => 'Settings'],
        ];


        $data['title'] = 'SI PANDHU - Detail DD Earmark';
        $data['pengajuan'] = $this->Pengajuan_model->get_pengajuan_by_id($id);
        $data['content'] = $this->load->view('history/view_view', $data, TRUE); // Load the content view

        // $data['dokumen'] = $this->Dd_earmark_model->get_documents($id);
        $data['jenis_dokumen'] = [
            // 'surat_permohonan_bupati_cq_dpmd',
            // 'rekomendasi_camat',
            // 'surat_permohonan_bank',
            // 'spp1_spp2_sptb',
            // 'rencana_penggunaan_dana_rpd',
            'berita_acara_verifikasi_rkpdes_apbdes_2025',
            // 'kertas_kerja_pemeriksaan_lpj_tahap_ii_2024',
            // 'foto_baliho_realisasi_apbdes_2024',
            // 'foto_baliho_apbdes_2025',
            // 'rekening_koran_fc_buku_rekening',
            // 'lpj_tahap_ii_2024'
        ];
        $this->load->view('layout/sidebar_view', $data); // load sidebar
        $this->load->view('layout/main_layout', $data); // Load the main layout with content

    }

}