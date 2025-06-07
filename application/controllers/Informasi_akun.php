<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class informasi_akun extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();

        $this->load->model('Informasi_akun_model');
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper('form');


    }

    public function index()
    {
        $data['active_sidebar'] = 'informasi_akun';

        $data['sidebar_menu'] = [
            ['icon' => 'fas fa-home', 'link' => 'dashboard', 'title' => 'Dashboard'],
            ['icon' => 'fas fa-clock', 'link' => 'dana_desa', 'title' => 'Pengajuan Dana'],
            ['icon' => 'fas fa-file-alt', 'link' => 'berita_acara', 'title' => 'Berita Acara'],
            ['icon' => 'fas fa-user-alt', 'link' => 'informasi_akun', 'title' => 'Informasi Akun'],
            ['icon' => 'fas fa-sign-out-alt', 'link' => 'auth/logout', 'title' => 'Keluar'],
        ];
        $data['title'] = 'SI PANDHU - Informasi Akun';
        $data['akun'] = $this->User_model->get_user_by_id($this->session->userdata('user_id'));

        $this->load->view('layout/sidebar_view', $data); // load sidebar
        $this->load_view('informasi_akun/view_view', $data);
    }

    public function edit($id)
    {
        $data['akun'] = $this->User_model->get_user_by_id($this->session->userdata('user_id'));

        $data['active_sidebar'] = 'informasi_akun';

        $data['sidebar_menu'] = [
            ['icon' => 'fas fa-home', 'link' => 'dashboard', 'title' => 'Dashboard'],
            ['icon' => 'fas fa-clock', 'link' => 'dana_desa', 'title' => 'Pengajuan Dana'],
            ['icon' => 'fas fa-file-alt', 'link' => 'berita_acara', 'title' => 'Berita Acara'],
            ['icon' => 'fas fa-user-alt', 'link' => 'informasi_akun', 'title' => 'Informasi Akun'],
            ['icon' => 'fas fa-sign-out-alt', 'link' => 'auth/logout', 'title' => 'Keluar'],
        ];
        $data['title'] = 'SI PANDHU - Edit Informasi Akun';

        $this->load->view('layout/sidebar_view', $data); // load sidebar

        $data['akun'] = $this->User_model->get_user_by_id($id);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('no_hp', 'Nomor Handphone', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');

        $password = $this->input->post('password');
        if (!empty($password)) {
            $this->form_validation->set_rules('password', 'Password', 'min_length[6]');
        }
        if ($this->form_validation->run() == FALSE) {
            $this->load_view('informasi_akun/edit_view', $data);
        } else {
            $user_data = [
                'email' => $this->input->post('email'),
                'no_hp' => $this->input->post('no_hp'),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'password' => $this->input->post('password'),
            ];

            $this->User_model->update_user($id, $user_data);

            $this->session->set_flashdata('success', 'Profil berhasil diperbarui');
            redirect('informasi_akun');
        }
    }



    public function view($id)
    {

        $data['active_sidebar'] = 'dana_desa';

        $data['sidebar_menu'] = [
            ['icon' => 'fas fa-home', 'link' => 'dashboard', 'title' => 'Dashboard'],
            ['icon' => 'fas fa-clock', 'link' => 'dana_desa', 'title' => 'Pengajuan Dana'],
            ['icon' => 'fas fa-file-alt', 'link' => 'berita_acara', 'title' => 'Berita Acara'],
            ['icon' => 'fas fa-user-alt', 'link' => 'informasi_akun', 'title' => 'Informasi Akun'],
            ['icon' => 'fas fa-sign-out-alt', 'link' => 'auth/logout', 'title' => 'Keluar'],
        ];


        $data['title'] = 'SI PANDHU - Detail Pengajuan Dana';
        $data['pengajuan'] = $this->Dana_desa_model->get_by_id($id);
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

    public function upload_foto($id)
    {
        $config['upload_path'] = './uploads/dokumen/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048;
        $config['file_name'] = 'foto_' . $id . '_' . time();

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, true);
        }

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            $file_name = $this->upload->data('file_name');
            $this->db->where('id', $id);
            $this->db->update('users', ['foto' => $file_name]);

            $this->session->set_userdata('foto', $file_name);
            $this->session->set_flashdata('success', 'Foto berhasil diunggah.');
        } else {
            $this->session->set_flashdata('error', $this->upload->display_errors());
        }

        redirect('informasi_akun');
    }
}