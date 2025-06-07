<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Berita_acara extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load necessary models here if needed
        $this->load->model('Berita_acara_model');
        $this->load->library('session');
        $this->load->model('Dana_desa_model');
        $this->load->model('User_model');
        $this->load->model('Desa_model');
        $this->load->model('Pengajuan_model');
        $this->load->model('Kecamatan_model');

    }

    public function index()
    {
        $this->load->library('pagination');
        $data['akun'] = $this->User_model->get_user_by_id($this->session->userdata('user_id'));
        $data['active_sidebar'] = 'berita_acara';
        $status = $this->input->get('status');
        $keyword = $this->input->get('keyword');
        $jenis_pengajuan = $this->input->get('jenis_pengajuan');

        $config['base_url'] = base_url('berita_acara/index');
        $config['total_rows'] = $this->Berita_acara_model->count_filtered($status, $keyword, $jenis_pengajuan);
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = FALSE;
        // Styling Bootstrap 4
        $config['full_tag_open'] = '<nav class="pagination-nav"><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);

        $offset = $this->uri->segment(3);
        if (!is_numeric($offset)) {
            $offset = 0;
        }

        $data['sidebar_menu'] = [
            ['icon' => 'fas fa-home', 'link' => 'dashboard', 'title' => 'Dashboard'],
            ['icon' => 'fas fa-clock', 'link' => 'dana_desa', 'title' => 'Pengajuan Dana'],
            ['icon' => 'fas fa-file-alt', 'link' => 'berita_acara', 'title' => 'Berita Acara'],
            ['icon' => 'fas fa-user-alt', 'link' => 'informasi_akun', 'title' => 'Informasi Akun'],
            ['icon' => 'fas fa-sign-out-alt', 'link' => 'auth/logout', 'title' => 'Keluar'],
        ];

        $data['status_filter'] = $status;

        $data['title'] = 'SI PANDHU - Berita Acara'; // Set the title for the page
        // $data['bap'] = $this->Berita_acara_model->get_all($status, $keyword);
        // $this->load->view('layout/sidebar_view', $data); // load sidebar
        $data['bap'] = $this->Berita_acara_model->get_paginated($config['per_page'], $offset, $status, $keyword, $jenis_pengajuan);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('layout/sidebar_view', $data); // Load the main layout with content
        $this->load_view('berita_acara/index_view', $data); // Load the content view
    }


    public function view($id)
    {
        $data['akun'] = $this->User_model->get_user_by_id($this->session->userdata('user_id'));
        $data['active_sidebar'] = 'berita_acara';
        $data['sidebar_menu'] = [
            ['icon' => 'fas fa-home', 'link' => 'dashboard', 'title' => 'Dashboard'],
            ['icon' => 'fas fa-clock', 'link' => 'dana_desa', 'title' => 'Pengajuan Dana'],
            ['icon' => 'fas fa-file-alt', 'link' => 'berita_acara', 'title' => 'Berita Acara'],
            ['icon' => 'fas fa-user-alt', 'link' => 'informasi_akun', 'title' => 'Informasi Akun'],
            ['icon' => 'fas fa-sign-out-alt', 'link' => 'auth/logout', 'title' => 'Keluar'],
        ];

        $data['title'] = 'SI PANDHU - Berita Acara';
        $data['bap'] = $this->Berita_acara_model->get_by_id($id);
        $data['dokumen'] = $this->Berita_acara_model->get_documents($id);


        $data['jenis_dokumen'] = [
            // 'surat_permohonan_bupati_cq_dpmd',
            // 'rekomendasi_camat',
            // 'surat_permohonan_bank',
            // 'spp1_spp2_sptb',
            // 'rencana_penggunaan_dana_rpd',
            'berita_acara',
            // 'kertas_kerja_pemeriksaan_lpj_tahap_ii_2024',
            // 'foto_baliho_realisasi_apbdes_2024',
            // 'foto_baliho_apbdes_2025',
            // 'rekening_koran_fc_buku_rekening',
            // 'lpj_tahap_ii_2024'
        ];
        $data['content'] = $this->load->view('berita_acara/view_view', $data, TRUE); // Load the content view

        $this->load->view('layout/sidebar_view', $data); // load sideba

        $this->load->view('layout/main_layout', $data); // Load the main layout with content

    }

    public function create()
    {
        $data['akun'] = $this->User_model->get_user_by_id($this->session->userdata('user_id'));

        $data['active_sidebar'] = 'berita_acara';
        $data['sidebar_menu'] = [
            ['icon' => 'fas fa-home', 'link' => 'dashboard', 'title' => 'Dashboard'],
            ['icon' => 'fas fa-clock', 'link' => 'dana_desa', 'title' => 'Pengajuan Dana'],
            ['icon' => 'fas fa-file-alt', 'link' => 'berita_acara', 'title' => 'Berita Acara'],
            ['icon' => 'fas fa-user-alt', 'link' => 'informasi_akun', 'title' => 'Informasi Akun'],
            ['icon' => 'fas fa-sign-out-alt', 'link' => 'auth/logout', 'title' => 'Keluar'],
        ];

        $this->load->view('layout/sidebar_view', $data); // load sidebar

        if (!in_array($this->user['role'], ['super_admin'])) {
            show_error('Only village admins can create applications.', 403, 'Access Denied');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('pengajuan_id', 'Nomor Pengajuan', 'required');
        $this->form_validation->set_rules('desa_id', 'Desa');
        $this->form_validation->set_rules('no_bap', 'Nomor Berita Acara', 'required');
        $this->form_validation->set_rules('kecamatan_id', 'Kecamatan');
        $this->form_validation->set_rules('nama_kepala_desa', 'Nama', 'required');
        $this->form_validation->set_rules('no_kontak_kades', 'No. Kontak', 'required');
        $this->form_validation->set_rules('nama_bank', 'Nama BANK', 'required');
        $this->form_validation->set_rules('no_rekening', 'No. Rekening', 'required');
        $this->form_validation->set_rules('jumlah_bantuan', 'Jumlah Bantuan', 'required|numeric');
        $this->form_validation->set_rules('jenis_pengajuan', 'Jenis Pengajuan', 'required');
        $this->form_validation->set_rules('jenis_bantuan', 'Jenis Bantuan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'SI PANDHU - Buat Berita Acara';
            $data['desa'] = $this->Desa_model->get_all();
            $data['kecamatan'] = $this->Kecamatan_model->get_all();
            $data['pengajuan'] = $this->Dana_desa_model->get_all(null, 'disposisi');
            $this->db->select('berita_acara_id');
            $this->db->from('bap_dokumen');
            $this->db->where('jenis_dokumen', 'berita_acara');
            $query = $this->db->get();
            $data['berita_acara_terisi'] = array_column($query->result_array(), 'berita_acara_id');

            // Get desa details if desa_id is set
            if ($this->input->post('desa_id')) {
                $desa_details = $this->Desa_model->get_by_id($this->input->post('desa_id'));
                if ($desa_details) {
                    $data['desa_details'] = $desa_details;
                }
            }

            $this->load_view('berita_acara/create_view', $data);

        } else {
            // Handle form submission

            // Data for desa table update
            $desa_data = [
                'nama_kepala_desa' => $this->input->post('nama_kepala_desa'),
                'no_kontak_kades' => $this->input->post('no_kontak_kades'),
                'nama_bank' => $this->input->post('nama_bank'),
                'no_rekening' => $this->input->post('no_rekening'),
            ];

            // Update desa details
            $desa_id = $this->input->post('desa_id');
            $this->Desa_model->update_desa_details($desa_id, $desa_data);

            // Data for pengajuan table creation
            $pengajuan_data = [
                'desa_id' => $desa_id,
                'jenis_pengajuan' => $this->input->post('jenis_pengajuan'),
                'jumlah_bantuan' => $this->input->post('jumlah_bantuan'),
                'status' => 'diajukan',
                'no_bap' => $this->input->post('no_bap'),
                'no_pengajuan' => $this->input->post('pengajuan_id'),
                'jenis_bantuan' => $this->input->post('jenis_bantuan'),
            ];

            // Create pengajuan record
            $bap_id = $this->Berita_acara_model->create($pengajuan_data);

            $this->Dana_desa_model->update_berita_acara($this->input->post('pengajuan_id'), $bap_id, $this->session->userdata('user_id'), 'Berita Acara diproses');
            // Handle file uploads
            $upload_path = './uploads/dokumen/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            }

            $dokumen_types = [
                'berita_acara',
            ];

            foreach ($dokumen_types as $type) {
                if (isset($_FILES[$type]) && $_FILES[$type]['error'] == 0) {
                    $upload = $this->handle_upload($type, $upload_path);
                    if ($upload['success']) {
                        $this->Berita_acara_model->add_document([
                            'berita_acara_id' => $bap_id,
                            'jenis_dokumen' => $type,
                            'nama_file' => $upload['data']['file_name']
                        ]);
                    }
                }
            }

            $target = $this->input->post('no_kontak_kades') . '|SI PANDHU|Admin';

            // $this->kirim_pesan_wa(
            //     $target,
            //     'Berita Acara Anda telah berhasil dibuat dengan Nomor Berita Acara ' . $this->input->post('no_bap') . '. Silakan cek aplikasi SI PANDHU untuk detail lebih lanjut.'
            // );


            $this->session->set_flashdata('success', 'Berita Acara berhasil dibuat');
            redirect('berita_acara');
        }
    }

    public function update_status($id)
    {
        if (!in_array($this->user['role'], ['kadis', 'kabid', 'super_admin'])) {
            show_error('Only district head or treasurer can update status.', 403, 'Access Denied');
        }

        $bap = $this->Berita_acara_model->get_by_id($id);
        // if (!$pengajuan || $pengajuan->status !== 'diajukan') {
        //     show_error('Application not found or cannot be updated.', 404, 'Not Found');
        // }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[diterima,ditolak]');
        $this->form_validation->set_rules('catatan', 'Catatan');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('berita_acara/view/' . $id);
        }

        $this->Berita_acara_model->update_status(
            $id,
            $this->input->post('status'),
            $this->input->post('verifikator_id'),
            $this->input->post('catatan')
        );

        $this->Dana_desa_model->update_pengajuan_by_kadis($id, $this->input->post('status'), $this->session->userdata('user_id'));

        $target = $this->input->post('no_kontak_kades') . '|SI PANDHU|Admin';
        $status = $this->input->post('status');
        $no_bap = $this->input->post('no_bap');

        // if ($status == 'diterima') {
        //     $this->kirim_pesan_wa(
        //         $target,
        //         'Berita Acara Anda dengan nomor ' . $no_bap . ' telah diterima. Silakan cek aplikasi SI PANDHU untuk detail lebih lanjut.'
        //     );
        // } elseif ($status == 'ditolak') {
        //     $this->kirim_pesan_wa(
        //         $target,
        //         'Pengajuan Anda dengan nomor ' . $no_bap . ' ditolak. Silakan cek aplikasi SI PANDHU untuk detail lebih lanjut.'
        //     );
        // }
        $this->session->set_flashdata('success', 'Status Berita Acara berhasil diperbarui');
        redirect('berita_acara/view/' . $id);
    }



    public function delete($id)
    {
        if (!in_array($this->user['role'], ['super_admin'])) {
            show_error('Only village admins can delete applications.', 403, 'Access Denied');
        }

        $bap = $this->Berita_acara_model->get_by_id($id);
        if (!$bap || $bap->status !== 'diajukan') {
            show_error('Application not found or cannot be deleted.', 404, 'Not Found');
        }

        $this->Berita_acara_model->delete($id);
        $this->session->set_flashdata('success', 'Berita Acara berhasil dihapus');
        redirect('berita_acara');
    }

    public function export_excel()
    {
        // Autoload PhpSpreadsheet
        require_once APPPATH . '../vendor/autoload.php';


        // Ambil data dari model
        $this->load->model('Berita_acara_model');
        $data_bap = $this->Berita_acara_model->get_all(); // sesuaikan jika pakai filter tertentu

        // Buat spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nomor Berita Acara');
        $sheet->setCellValue('C1', 'Nama Desa');
        $sheet->setCellValue('D1', 'Nomor Pengajuan');
        $sheet->setCellValue('E1', 'Jenis Pengajuan');

        // Isi data
        $row = 2;
        $no = 1;
        foreach ($data_bap as $bap) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $bap->no_bap);
            $sheet->setCellValue('C' . $row, $bap->nama_desa);
            $sheet->setCellValue('D' . $row, $bap->no_pengajuan);
            $sheet->setCellValue('E' . $row, strtoupper(str_replace('_', ' ', $bap->jenis_pengajuan)));
            $row++;
        }

        // Atur nama file dan kirim sebagai download
        $filename = 'berita_acara_' . date('Ymd_His') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

}