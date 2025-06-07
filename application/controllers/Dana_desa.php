<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Dana_desa extends MY_Controller
{

    protected $allowed_roles = ['super_admin', 'admin_desa', 'kadis', 'kabid'];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dana_desa_model');
        $this->load->model('Desa_model');
        $this->load->model('Berita_acara_model');
        $this->load->model('Kecamatan_model');
        $this->load->model('User_model');
        $this->load->library('session');

    }

    public function index()
    {
        $this->load->library('pagination');
        $data['akun'] = $this->User_model->get_user_by_id($this->session->userdata('user_id'));

        $user = [
            'role' => $this->session->userdata('role'),
            'desa_id' => $this->session->userdata('desa_id')
        ];

        $data['active_sidebar'] = 'dana_desa';
        $status = $this->input->get('status');
        $keyword = $this->input->get('keyword');
        $jenis_pengajuan = $this->input->get('jenis_pengajuan');

        $config['base_url'] = base_url('dana_desa/index');

        log_message('debug', 'USER ROLE: ' . $user['role']);
        log_message('debug', 'USER DESA ID: ' . $user['desa_id']);
        $config['total_rows'] = $this->Dana_desa_model->count_filtered($status, $keyword, $jenis_pengajuan);
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

        $data['title'] = 'SI PANDHU - Pengajuan Dana';
        $data['pengajuan'] = $this->Dana_desa_model->get_paginated($config['per_page'], $offset, $status, $keyword, $jenis_pengajuan, $user);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('layout/sidebar_view', $data); // load sidebar
        $this->load_view('dana_desa/index_view', $data);
    }

    public function create()
    {
        $data['akun'] = $this->User_model->get_user_by_id($this->session->userdata('user_id'));

        $data['active_sidebar'] = 'dana_desa';

        $data['sidebar_menu'] = [
            ['icon' => 'fas fa-home', 'link' => 'dashboard', 'title' => 'Dashboard'],
            ['icon' => 'fas fa-clock', 'link' => 'dana_desa', 'title' => 'Pengajuan Dana'],
            ['icon' => 'fas fa-file-alt', 'link' => 'berita_acara', 'title' => 'Berita Acara'],
            ['icon' => 'fas fa-user-alt', 'link' => 'informasi_akun', 'title' => 'Informasi Akun'],
            ['icon' => 'fas fa-sign-out-alt', 'link' => 'auth/logout', 'title' => 'Keluar'],
        ];

        $this->load->view('layout/sidebar_view', $data); // load sidebar

        if (!in_array($this->user['role'], ['admin_desa'])) {
            show_error('Only village admins can create applications.', 403, 'Access Denied');
        }

        $this->load->library('form_validation');
        // $this->form_validation->set_rules('desa_id', 'Desa', 'required');
        $this->form_validation->set_rules('no_pengajuan', 'Nomor Pengajuan', 'required');
        // $this->form_validation->set_rules('kecamatan_id', 'Kecamatan', 'required');
        $this->form_validation->set_rules('nama_kepala_desa', 'Nama', 'required');
        $this->form_validation->set_rules('no_kontak_kades', 'No. Kontak', 'required');
        $this->form_validation->set_rules('nama_bank', 'Nama BANK', 'required');
        $this->form_validation->set_rules('no_rekening', 'No. Rekening', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('jumlah_bantuan', 'Jumlah Bantuan', 'required|numeric');
        $this->form_validation->set_rules('jenis_bantuan', 'Jenis Bantuan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('jenis_pengajuan', 'Jenis Pengajuan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'SI PANDHU - Tambah Pengajuan Dana';
            $data['desa'] = $this->Desa_model->get_all();
            $data['kecamatan'] = $this->Kecamatan_model->get_all();
            // $data['user'] = [
            //     'kecamatan_id' => $this->session->userdata('kecamatan_id')
            // ];
            if ($this->input->post('desa_id')) {
                $desa_details = $this->Desa_model->get_by_id($this->input->post('desa_id'));
                if ($desa_details) {
                    $data['desa_details'] = $desa_details;
                }
            }

            $this->load_view('dana_desa/create_view', $data);

        } else {
            // Handle form submission

            // Data for desa table update
            $desa_data = [
                'nama_kepala_desa' => $this->input->post('nama_kepala_desa'),
                'no_kontak_kades' => $this->input->post('no_kontak_kades'),
                'nama_bank' => $this->input->post('nama_bank'),
                'no_rekening' => $this->input->post('no_rekening'),
                'alamat' => $this->input->post('alamat'),
                'jabatan' => $this->input->post('jabatan'),
            ];

            // Update desa details
            $desa_id = $this->session->userdata('desa_id');

            $this->Desa_model->update_desa_details($desa_id, $desa_data);
            $jenis_pengajuan = $this->input->post('jenis_pengajuan');

            date_default_timezone_set('Asia/Jayapura'); // WIT
            // Data for pengajuan table creation
            $pengajuan_data = [
                'desa_id' => $desa_id,
                'jenis_pengajuan' => $jenis_pengajuan,
                'jumlah_bantuan' => $this->input->post('jumlah_bantuan'),
                'status' => 'diajukan',
                'no_pengajuan' => $this->input->post('no_pengajuan'),
                'jenis_bantuan' => $this->input->post('jenis_bantuan'),
                'tanggal_verifikasi' => date('Y-m-d H:i:s'),
            ];

            // Create pengajuan record
            $pengajuan_id = $this->Dana_desa_model->create($pengajuan_data);

            // Handle file uploads
            $upload_path = './uploads/dokumen/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            }

            // $dokumen_types = [
            //     'surat_permohonan_ke_bupati_cq_kepala_dpm',
            //     'kertas_kerja_hasil_pemeriksaan_lpj_tahap_ii_2024',
            //     'rekomendasi_camat',
            //     'foto_baliho_realisasi_apbdes_tahun_2024',
            //     'SPP1_SPP2_SPTB',
            //     'foto_baliho_apbdes_tahun_2025',
            //     'rencana_penggunaan_dana',
            //     'foto_buku_tabungan',
            //     'berita_acara_hasil_verivikasi_rkpdes_dan_apbdes_tahun_2025',
            //     'lpj_tahap_sebelumnya'
            // ];
            $jenis_pengajuan_dokumen_map = [
                'dd_earmark_60' => [
                    'surat_permohonan_ke_bupati_cq_kepala_dpm',
                    'kertas_kerja_hasil_pemeriksaan_lpj_tahap_sebelumnya',
                    'rekomendasi_camat',
                    'foto_baliho_realisasi_apbdes_tahun_sebelumnya',
                    'SPP1_SPP2_SPTB',
                    'foto_baliho_apbdes_tahun_berjalan',
                    'rencana_penggunaan_dana',
                    'foto_buku_tabungan',
                    'berita_acara_hasil_verivikasi_rkpdes_dan_apbdes_tahun_berjalan',
                    'lpj_tahap_sebelumnya'
                ],
                'alokasi_dana_desa' => [
                    'surat_permohonan_ke_bank',
                    'surat_permohonan_penerimaan',
                    'rekomendasi_camat',
                    'SPP1_SPP2_SPTB',
                    'rencana_penggunaan_dana',
                    'foto_buku_tabungan',
                    'bukti_pembayaran_bulan_sebelumnya',
                ],
                'dana_lain' => [
                    'surat_permohonan_penerimaan',
                    'rekomendasi_camat',
                    'SPP1_SPP2_SPTB',
                    'rencana_penggunaan_dana',
                    'foto_buku_tabungan',
                    'bukti_setoran_pades',
                ],
                'dd_non_earmark_40' => [
                    'surat_permohonan_ke_bupati_cq_kepala_dpm',
                    'kertas_kerja_hasil_pemeriksaan_lpj_tahap_sebelumnya',
                    'rekomendasi_camat',
                    'foto_baliho_realisasi_apbdes_tahun_sebelumnya',
                    'SPP1_SPP2_SPTB',
                    'foto_baliho_apbdes_tahun_berjalan',
                    'rencana_penggunaan_dana',
                    'foto_buku_tabungan',
                    'berita_acara_hasil_verivikasi_rkpdes_dan_apbdes_tahun_berjalan',
                    'lpj_tahap_sebelumnya'
                ],
                'ketahanan_pangan_tpk' => [
                    'surat_permohonan_ke_bupati_cq_kepala_dpm',
                    'npwp_tpk',
                    'rekomendasi_camat',
                    'foto_copi_ktp_ketua_tpk',
                    'SPP1_SPP2_SPTB',
                    'nomor_rekening_tpk',
                    'rencana_penggunaan_dana',
                    'sk_pembentukan_tpk',
                ],
                'ketahanan_pangan_bumdesa' => [
                    'surat_permohonan_ke_bupati_cq_kepala_dpm',
                    'sk_bumdesa',
                    'rekomendasi_camat',
                    'npwp_bumdesa_dan_bendahara_bumdesa',
                    'SPP1_SPP2_SPTB',
                    'buku_rekening_bumdesa',
                    'rencana_penggunaan_dana',
                    'akta_pendirian_badan_hukum',
                ],
            ];
            $dokumen_types = isset($jenis_pengajuan_dokumen_map[$jenis_pengajuan])
                ? $jenis_pengajuan_dokumen_map[$jenis_pengajuan]
                : [];

            // var_dump($dokumen_types);
            // exit;

            foreach ($dokumen_types as $type) {
                if (isset($_FILES[$type]) && $_FILES[$type]['error'] == 0) {
                    $upload = $this->handle_upload($type, $upload_path);
                    if ($upload['success']) {
                        $this->Dana_desa_model->add_document([
                            'pengajuan_id' => $pengajuan_id,
                            'jenis_dokumen' => $type,
                            'nama_file' => $upload['data']['file_name']
                        ]);
                    }
                }
            }

            $target = $this->input->post('no_kontak_kades') . '|SI PANDHU|Admin';

            $this->kirim_pesan_wa(
                $target,
                'Pengajuan Dana Desa telah berhasil dibuat dengan Nomor Pengajuan ' . $this->input->post('no_pengajuan') . '. Silakan cek aplikasi SI PANDHU untuk detail lebih lanjut.'
            );

            // Hapus session upload (optional)
            $this->session->set_flashdata('success', 'Pengajuan berhasil dibuat');
            redirect('dana_desa');
        }
    }

    public function view($id)
    {
        $data['akun'] = $this->User_model->get_user_by_id($this->session->userdata('user_id'));

        $data['pengajuan'] = $this->Dana_desa_model->get_by_id($id);

        // Cek apakah data ditemukan
        if (!$data['pengajuan']) {
            redirect('dana_desa');
            return;
        }

        // Filter berdasarkan desa_id jika role admin_desa
        if ($this->user['role'] === 'admin_desa' && $data['pengajuan']->desa_id != $this->session->userdata('desa_id')) {
            redirect('dana_desa'); // kembalikan ke halaman index
            return;
        }
        $data['active_sidebar'] = 'dana_desa';

        $data['sidebar_menu'] = [
            ['icon' => 'fas fa-home', 'link' => 'dashboard', 'title' => 'Dashboard'],
            ['icon' => 'fas fa-clock', 'link' => 'dana_desa', 'title' => 'Pengajuan Dana'],
            ['icon' => 'fas fa-file-alt', 'link' => 'berita_acara', 'title' => 'Berita Acara'],
            ['icon' => 'fas fa-user-alt', 'link' => 'informasi_akun', 'title' => 'Informasi Akun'],
            ['icon' => 'fas fa-sign-out-alt', 'link' => 'auth/logout', 'title' => 'Keluar'],
        ];

        $data['title'] = 'SI PANDHU - Detail Pengajuan Dana';
        // $data['pengajuan'] = $this->Dana_desa_model->get_by_id($id);
        $data['bap_dokumen'] = $this->Berita_acara_model->get_documents($data['pengajuan']->berita_acara_id);
        $data['dokumen'] = $this->Dana_desa_model->get_documents($id);
        $jenis_pengajuan_dokumen_map = [
            'dd_earmark_60' => [
                'surat_permohonan_ke_bupati_cq_kepala_dpm',
                'kertas_kerja_hasil_pemeriksaan_lpj_tahap_sebelumnya',
                'rekomendasi_camat',
                'foto_baliho_realisasi_apbdes_tahun_sebelumnya',
                'SPP1_SPP2_SPTB',
                'foto_baliho_apbdes_tahun_berjalan',
                'rencana_penggunaan_dana',
                'foto_buku_tabungan',
                'berita_acara_hasil_verivikasi_rkpdes_dan_apbdes_tahun_berjalan',
                'lpj_tahap_sebelumnya'
            ],
            'alokasi_dana_desa' => [
                'surat_permohonan_ke_bank',
                'surat_permohonan_penerimaan',
                'rekomendasi_camat',
                'SPP1_SPP2_SPTB',
                'rencana_penggunaan_dana',
                'foto_buku_tabungan',
                'bukti_pembayaran_bulan_sebelumnya',
            ],
            'dana_lain' => [
                'surat_permohonan_penerimaan',
                'rekomendasi_camat',
                'SPP1_SPP2_SPTB',
                'rencana_penggunaan_dana',
                'foto_buku_tabungan',
                'bukti_setoran_pades',
            ],
            'dd_non_earmark_40' => [
                'surat_permohonan_ke_bupati_cq_kepala_dpm',
                'kertas_kerja_hasil_pemeriksaan_lpj_tahap_sebelumnya',
                'rekomendasi_camat',
                'foto_baliho_realisasi_apbdes_tahun_sebelumnya',
                'SPP1_SPP2_SPTB',
                'foto_baliho_apbdes_tahun_berjalan',
                'rencana_penggunaan_dana',
                'foto_buku_tabungan',
                'berita_acara_hasil_verivikasi_rkpdes_dan_apbdes_tahun_berjalan',
                'lpj_tahap_sebelumnya'
            ],
            'ketahanan_pangan_tpk' => [
                'surat_permohonan_ke_bupati_cq_kepala_dpm',
                'npwp_tpk',
                'rekomendasi_camat',
                'foto_copi_ktp_ketua_tpk',
                'SPP1_SPP2_SPTB',
                'nomor_rekening_tpk',
                'rencana_penggunaan_dana',
                'sk_pembentukan_tpk',
            ],
            'ketahanan_pangan_bumdesa' => [
                'surat_permohonan_ke_bupati_cq_kepala_dpm',
                'sk_bumdesa',
                'rekomendasi_camat',
                'npwp_bumdesa_dan_bendahara_bumdesa',
                'SPP1_SPP2_SPTB',
                'buku_rekening_bumdesa',
                'rencana_penggunaan_dana',
                'akta_pendirian_badan_hukum',
            ],
        ];
        $data['jenis_dokumen'] = isset($jenis_pengajuan_dokumen_map[$data['pengajuan']->jenis_pengajuan])
            ? $jenis_pengajuan_dokumen_map[$data['pengajuan']->jenis_pengajuan]
            : [];

        $this->load->view('layout/sidebar_view', $data); // load sidebar

        $this->load_view('dana_desa/view_view', $data);
    }



    public function edit($id)
    {
        if (!in_array($this->user['role'], ['admin_desa', 'super_admin'])) {
            show_error('Only village admins can edit applications.', 403, 'Access Denied');
        }

        $pengajuan = $this->Dana_desa_model->get_by_id($id);
        if (!$pengajuan || $pengajuan->status !== 'diajukan') {
            show_error('Application not found or cannot be edited.', 404, 'Not Found');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('jumlah_bantuan', 'Jumlah Bantuan', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'SI PANDHU - Edit Pengajuan Dana';
            $data['pengajuan'] = $pengajuan;
            $data['desa'] = $this->Desa_model->get_all();
            $data['kecamatan'] = $this->Kecamatan_model->get_all();
            $data['dokumen'] = $this->Dana_desa_model->get_documents($id);
            $data['jenis_dokumen'] = [
                'surat_pengajuan',
                'laporan_keuangan',
                'proposal'
            ];

            foreach ($data['jenis_dokumen'] as $k => $jenis_dokumen) {
                $data['dokumen'][$k]->jenis_dokumen = $jenis_dokumen;
            }

            // Fetch desa details based on pengajuan->desa_id
            $data['desa_details'] = $this->Desa_model->get_by_id($pengajuan->desa_id);

            $this->load_view('dana_desa/edit_view', $data);
        } else {
            $pengajuan_data = [
                'jumlah_bantuan' => $this->input->post('jumlah_bantuan')
            ];

            $this->Dana_desa_model->update($id, $pengajuan_data);

            // Update desa details if fields are present in the edit form
            $desa_data = [
                'nama_kepala_desa' => $this->input->post('nama_kepala_desa'),
                'no_kontak_kades' => $this->input->post('no_kontak_kades'),
                'nama_bank' => $this->input->post('nama_bank'),
                'no_rekening' => $this->input->post('no_rekening'),
                'alamat' => $this->input->post('alamat'),
                'jabatan' => $this->input->post('jabatan')
            ];

            $desa_id = $this->input->post('desa_id') ? $this->input->post('desa_id') : $pengajuan->desa_id;
            $this->Desa_model->update_desa_details($desa_id, $desa_data);

            // Handle file uploads
            $upload_path = './uploads/dokumen/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            }

            $dokumen_types = [
                'surat_pengajuan',
                'laporan_keuangan',
                'proposal'
            ];

            foreach ($dokumen_types as $type) {
                if (isset($_FILES[$type]) && $_FILES[$type]['error'] == 0) {
                    $upload = $this->handle_upload($type, $upload_path);
                    if ($upload['success']) {
                        $this->Dana_desa_model->add_document([
                            'pengajuan_id' => $id,
                            'jenis_dokumen' => $type,
                            'nama_file' => $upload['data']['file_name']
                        ]);
                    }
                }
            }

            $this->session->set_flashdata('success', 'Pengajuan berhasil diperbarui');
            redirect('dana_desa/view/' . $id);
        }
    }

    public function delete($id)
    {
        if (!in_array($this->user['role'], ['admin_desa', 'super_admin'])) {
            show_error('Only village admins can delete applications.', 403, 'Access Denied');
        }

        $pengajuan = $this->Dana_desa_model->get_by_id($id);
        if (!$pengajuan || $pengajuan->status !== 'diajukan') {
            show_error('Application not found or cannot be deleted.', 404, 'Not Found');
        }

        $this->Dana_desa_model->delete($id);
        $this->session->set_flashdata('success', 'Pengajuan berhasil dihapus');
        redirect('dana_desa');
    }

    public function update_status($id)
    {
        if (!in_array($this->user['role'], ['kadis', 'kabid', 'super_admin', ''])) {
            show_error('Only district head or treasurer can update status.', 403, 'Access Denied');
        }

        $pengajuan = $this->Dana_desa_model->get_by_id($id);
        // if (!$pengajuan || $pengajuan->status !== 'diajukan') {
        //     show_error('Application not found or cannot be updated.', 404, 'Not Found');
        // }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[diterima,ditolak,verifikasi,verifikasi_ditolak,disposisi_ditolak,disposisi,berita_acara_siap]');
        $this->form_validation->set_rules('catatan', 'Catatan');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('dana_desa/view/' . $id);
        }

        $this->Dana_desa_model->update_status(
            $id,
            $this->input->post('status'),
            $this->input->post('verifikator_id'),
            $this->input->post('catatan')
        );

        $target = $this->input->post('no_kontak_kades') . '|SI PANDHU|Admin';
        $status = $this->input->post('status');
        $no_pengajuan = $this->input->post('no_pengajuan');

        if ($status == 'verifikasi') {
            $this->kirim_pesan_wa(
                $target,
                'Pengajuan Anda dengan nomor ' . $no_pengajuan . ' sedang diverifikasi. Silakan cek aplikasi SI PANDHU untuk detail lebih lanjut.'
            );
        } elseif ($status == 'diterima') {
            $this->kirim_pesan_wa(
                $target,
                'Pengajuan Anda dengan nomor ' . $no_pengajuan . ' telah diterima. Silakan cek aplikasi SI PANDHU untuk detail lebih lanjut.'
            );
        } elseif ($status == 'ditolak') {
            $this->kirim_pesan_wa(
                $target,
                'Pengajuan Anda dengan nomor ' . $no_pengajuan . ' ditolak. Silakan cek aplikasi SI PANDHU untuk detail lebih lanjut.'
            );
        } elseif ($status == 'verifikasi_ditolak') {
            $this->kirim_pesan_wa(
                $target,
                'Pengajuan Anda dengan nomor ' . $no_pengajuan . ' ditolak. Silakan cek aplikasi SI PANDHU untuk detail lebih lanjut.'
            );
        }
        $this->session->set_flashdata('success', 'Status pengajuan berhasil diperbarui');
        redirect('dana_desa/view/' . $id);
    }


    public function get_desa_by_kecamatan($kecamatan_id)
    {
        $desa = $this->Desa_model->get_by_kecamatan($kecamatan_id);
        echo json_encode($desa);
    }

    public function get_desa_details($desa_id)
    {
        $desa = $this->Desa_model->get_by_id($desa_id);
        if ($desa) {
            echo json_encode([
                'nama_kepala_desa' => $desa->nama_kepala_desa,
                'no_kontak_kades' => $desa->no_kontak_kades,
                'nama_bank' => $desa->nama_bank,
                'alamat' => $desa->alamat,
                'jabatan' => $desa->jabatan,
                'no_rekening' => $desa->no_rekening,
                'kecamatan_id' => $desa->kecamatan_id
            ]);
        } else {
            echo json_encode(['error' => 'Desa not found']);
        }
    }

    public function handle_upload($field_name, $upload_path, $allowed_types = 'gif|jpg|png|pdf', $max_size = 2048)
    {
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = $allowed_types;
        $config['max_size'] = $max_size;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload($field_name)) {
            return ['success' => TRUE, 'data' => $this->upload->data()];
        } else {
            log_message('error', 'File upload error for ' . $field_name . ': ' . $this->upload->display_errors());
            $this->session->set_flashdata('error', 'Gagal mengunggah file: ' . $this->upload->display_errors());
            return ['success' => FALSE, 'error' => $this->upload->display_errors()];
        }
    }

    public function kirim_pesan_wa($target = null, $message = null)
    {
        $token = 'EiVkNoUZpQxGejHXgu5v';
        // $target = '08123456789|Fonnte|Admin,08123456789|Lili|User';
        // $message = 'Halo {name}, ini pesan otomatis untuk {var1}';

        $options = [
            'url' => 'https://md.fonnte.com/images/wa-logo.png',
            'filename' => 'logo-wa.png',
            'typing' => false,
            'delay' => 2,
            'followup' => 0,
            // 'file' => FCPATH . 'uploads/dokumen.jpg', // jika kirim file lokal
            // 'location' => '-7.983908,112.621391',
        ];

        $result = send_wa_message($target, $message, $token, $options);

        if ($result['status']) {
            echo 'Sukses: ' . $result['response'];
        } else {
            echo 'Gagal: ' . $result['error'];
        }
    }
    public function get_file_fields()
    {
        $jenis = $this->input->get('jenis_pengajuan', TRUE);

        // Daftar field sesuai jenis pengajuan
        $file_fields = [
            'dd_earmark_60' => [
                'surat_permohonan_ke_bupati_cq_kepala_dpm',
                'kertas_kerja_hasil_pemeriksaan_lpj_tahap_sebelumnya',
                'rekomendasi_camat',
                'foto_baliho_realisasi_apbdes_tahun_sebelumnya',
                'SPP1_SPP2_SPTB',
                'foto_baliho_apbdes_tahun_berjalan',
                'rencana_penggunaan_dana',
                'foto_buku_tabungan',
                'berita_acara_hasil_verivikasi_rkpdes_dan_apbdes_tahun_berjalan',
                'lpj_tahap_sebelumnya'
            ],
            'alokasi_dana_desa' => [
                'surat_permohonan_ke_bank',
                'surat_permohonan_penerimaan',
                'rekomendasi_camat',
                'SPP1_SPP2_SPTB',
                'rencana_penggunaan_dana',
                'foto_buku_tabungan',
                'bukti_pembayaran_bulan_sebelumnya'
            ],
            'dana_lain' => [
                'surat_permohonan_penerimaan',
                'rekomendasi_camat',
                'SPP1_SPP2_SPTB',
                'rencana_penggunaan_dana',
                'foto_buku_tabungan',
                'bukti_setoran_pades'
            ],
            'dd_non_earmark_40' => [
                'surat_permohonan_ke_bupati_cq_kepala_dpm',
                'kertas_kerja_hasil_pemeriksaan_lpj_tahap_sebelumnya',
                'rekomendasi_camat',
                'foto_baliho_realisasi_apbdes_tahun_sebelumnya',
                'SPP1_SPP2_SPTB',
                'foto_baliho_apbdes_tahun_berjalan',
                'rencana_penggunaan_dana',
                'foto_buku_tabungan',
                'berita_acara_hasil_verivikasi_rkpdes_dan_apbdes_tahun_berjalan',
                'lpj_tahap_sebelumnya'
            ],
            'ketahanan_pangan_tpk' => [
                'surat_permohonan_ke_bupati_cq_kepala_dpm',
                'npwp_tpk',
                'rekomendasi_camat',
                'foto_copi_ktp_ketua_tpk',
                'SPP1_SPP2_SPTB',
                'nomor_rekening_tpk',
                'rencana_penggunaan_dana',
                'sk_pembentukan_tpk'
            ],
            'ketahanan_pangan_bumdesa' => [
                'surat_permohonan_ke_bupati_cq_kepala_dpm',
                'sk_bumdesa',
                'rekomendasi_camat',
                'npwp_bumdesa_dan_bendahara_bumdesa',
                'SPP1_SPP2_SPTB',
                'buku_rekening_bumdesa',
                'rencana_penggunaan_dana',
                'akta_pendirian_badan_hukum'
            ],
        ];

        if (!isset($file_fields[$jenis])) {
            show_error('Jenis pengajuan tidak valid.', 400);
            return;
        }

        foreach ($file_fields[$jenis] as $name): ?>
            <div class="file-item form-section file-field-<?php echo $jenis; ?>">
                <span class="file-label"><?php echo strtoupper(str_replace('_', ' ', $name)); ?></span>
                <span class="file-separator">:</span>
                <div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="<?php echo $name; ?>" name="<?php echo $name; ?>" required>
                        <label class="custom-file-label" for="<?php echo $name; ?>">Pilih File</label>
                    </div>
                    <small class="form-text text-muted">Format: PDF, maksimal 2MB</small>
                </div>
            </div>
        <?php endforeach;
    }

    public function get_detail_pengajuan()
    {
        $no_pengajuan = $this->input->post('no_pengajuan');

        if (!$no_pengajuan) {
            echo json_encode([
                'status' => 'error',
                'message' => 'No pengajuan tidak dikirim'
            ]);
            return;
        }

        $this->load->model('Dana_desa_model');
        $pengajuan = $this->Dana_desa_model->get_by_no_pengajuan($no_pengajuan);

        if ($pengajuan) {
            echo json_encode([
                'status' => 'success',
                'data' => [
                    'desa_id' => $pengajuan->desa_id,
                    'kecamatan_id' => $pengajuan->kecamatan_id,
                    'jumlah_bantuan' => $pengajuan->jumlah_bantuan,
                    'jenis_pengajuan' => $pengajuan->jenis_pengajuan,
                    'jenis_bantuan' => $pengajuan->jenis_bantuan,
                ]
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }
    public function export_excel()
    {
        // Autoload PhpSpreadsheet
        require_once APPPATH . '../vendor/autoload.php';

        $this->load->model('Dana_desa_model'); // pastikan model sudah sesuai
        $pengajuan = $this->Dana_desa_model->get_all(); // sesuaikan dengan model-mu

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'Nomor Pengajuan');
        $sheet->setCellValue('B1', 'Tanggal Pengajuan');
        $sheet->setCellValue('C1', 'Nama Desa');
        $sheet->setCellValue('D1', 'Kecamatan');
        $sheet->setCellValue('E1', 'Jenis Pengajuan');
        $sheet->setCellValue('F1', 'Jumlah Bantuan');
        $sheet->setCellValue('G1', 'Status');

        // Data
        $row = 2;
        foreach ($pengajuan as $p) {
            $sheet->setCellValue('A' . $row, $p->no_pengajuan);
            $sheet->setCellValue('B' . $row, date('d-m-Y', strtotime($p->tanggal_pengajuan)));
            $sheet->setCellValue('C' . $row, strtoupper(str_replace('_', ' ', $p->nama_desa)));
            $sheet->setCellValue('D' . $row, strtoupper(str_replace('_', ' ', $p->nama_kecamatan)));
            $sheet->setCellValue('E' . $row, strtoupper(str_replace('_', ' ', $p->jenis_pengajuan)));
            $sheet->setCellValue('F' . $row, $p->jumlah_bantuan);
            $sheet->setCellValue('G' . $row, strtoupper(str_replace('_', ' ', $p->status)));
            $row++;
        }

        // Download
        $filename = 'pengajuan_dana_' . date('YmdHis') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function get_user_location()
    {
        $response = [
            'desa_id' => $this->session->userdata('desa_id'),
            'kecamatan_id' => $this->session->userdata('kecamatan_id')
        ];
        echo json_encode($response);
    }
}