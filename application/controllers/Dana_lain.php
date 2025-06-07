<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dana_lain extends MY_Controller {

    protected $allowed_roles = ['super_admin', 'admin_desa', 'kadis', 'kabid'];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dana_lain_model');
        $this->load->model('Desa_model');
        $this->load->model('Kecamatan_model');
    }

    public function index()
    {
        $data['title'] = 'SI PANDHU - Dana Lain';
        $data['pengajuan'] = $this->Dana_lain_model->get_all();
        $this->load_view('dana_lain/index_view', $data);
    }

    public function create()
    {
        if (!in_array($this->user['role'], ['admin_desa', 'super_admin'])) {
            show_error('Only authorized users can create Dana Lain applications.', 403, 'Access Denied');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('desa_id', 'Desa', 'required');
        $this->form_validation->set_rules('kecamatan_id', 'Kecamatan', 'required');
        $this->form_validation->set_rules('nama_kepala_desa', 'Nama', 'required');
        $this->form_validation->set_rules('no_kontak_kades', 'No. Kontak', 'required');
        $this->form_validation->set_rules('nama_bank', 'Nama BANK', 'required');
        $this->form_validation->set_rules('no_rekening', 'No. Rekening', 'required');
        $this->form_validation->set_rules('jumlah_bantuan', 'Jumlah Bantuan', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'SI PANDHU - Buat Dana Lain';
            $data['desa'] = $this->Desa_model->get_all();
            $data['kecamatan'] = $this->Kecamatan_model->get_all();
            
            if ($this->input->post('desa_id')) {
                $desa_details = $this->Desa_model->get_by_id($this->input->post('desa_id'));
                if ($desa_details) {
                    $data['desa_details'] = $desa_details;
                }
            }
            
            $this->load_view('dana_lain/create_view', $data);
        } else {
            $desa_data = [
                'nama_kepala_desa' => $this->input->post('nama_kepala_desa'),
                'no_kontak_kades' => $this->input->post('no_kontak_kades'),
                'nama_bank' => $this->input->post('nama_bank'),
                'no_rekening' => $this->input->post('no_rekening'),
            ];

            $desa_id = $this->input->post('desa_id');
            $this->Desa_model->update_desa_details($desa_id, $desa_data);

            $dana_lain_data = [
                'desa_id' => $desa_id,
                'jumlah_bantuan' => $this->input->post('jumlah_bantuan'),
                'status' => 'diajukan'
            ];

            $dana_lain_id = $this->Dana_lain_model->create($dana_lain_data);

            $upload_path = './uploads/dokumen_lain/';
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
                        $this->Dana_lain_model->add_document([
                            'dana_lain_id' => $dana_lain_id,
                            'jenis_dokumen' => $type,
                            'nama_file' => $upload['data']['file_name']
                        ]);
                    }
                }
            }

            $this->session->set_flashdata('success', 'Pengajuan Dana Lain berhasil dibuat');
            redirect('dana_lain');
        }
    }

    public function view($id)
    {
        $data['title'] = 'SI PANDHU - Detail Dana Lain';
        $data['pengajuan'] = $this->Dana_lain_model->get_by_id($id);
        $data['dokumen'] = $this->Dana_lain_model->get_documents($id);
        $data['jenis_dokumen'] = [
            'surat_pengajuan',
            'laporan_keuangan',
            'proposal'
        ];
        $this->load_view('dana_lain/view_view', $data);
    }

    public function edit($id)
    {
        if (!in_array($this->user['role'], ['admin_desa', 'super_admin'])) {
            show_error('Only authorized users can edit Dana Lain applications.', 403, 'Access Denied');
        }

        $pengajuan = $this->Dana_lain_model->get_by_id($id);
        if (!$pengajuan || (isset($pengajuan->status) && $pengajuan->status !== 'diajukan')) {
            show_error('Dana Lain application not found or cannot be edited.', 404, 'Not Found');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('jumlah_bantuan', 'Jumlah Bantuan', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'SI PANDHU - Edit Dana Lain';
            $data['pengajuan'] = $pengajuan;
            $data['desa'] = $this->Desa_model->get_all();
            $data['kecamatan'] = $this->Kecamatan_model->get_all();
            $data['dokumen'] = $this->Dana_lain_model->get_documents($id);
            $data['jenis_dokumen'] = [
                'surat_pengajuan',
                'laporan_keuangan',
                'proposal'
            ];
            foreach ($data['jenis_dokumen'] as $k => $jenis_dokumen) {
                $data['dokumen'][$k]->jenis_dokumen = $jenis_dokumen;
            }
            
            $data['desa_details'] = $this->Desa_model->get_by_id($pengajuan->desa_id);

            $this->load_view('dana_lain/edit_view', $data);
        } else {
            $dana_lain_data = [
                'jumlah_bantuan' => $this->input->post('jumlah_bantuan')
            ];

            $this->Dana_lain_model->update($id, $dana_lain_data);
            
            $desa_data = [
                'nama_kepala_desa' => $this->input->post('nama_kepala_desa'),
                'no_kontak_kades' => $this->input->post('no_kontak_kades'),
                'nama_bank' => $this->input->post('nama_bank'),
                'no_rekening' => $this->input->post('no_rekening'),
            ];

            $desa_id = $this->input->post('desa_id') ? $this->input->post('desa_id') : $pengajuan->desa_id;
            $this->Desa_model->update_desa_details($desa_id, $desa_data);

            $upload_path = './uploads/dokumen_lain/';
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
                        $this->Dana_lain_model->add_document([
                            'dana_lain_id' => $id,
                            'jenis_dokumen' => $type,
                            'nama_file' => $upload['data']['file_name']
                        ]);
                    }
                }
            }

            $this->session->set_flashdata('success', 'Pengajuan Dana Lain berhasil diperbarui');
            redirect('dana_lain/view/'.$id);
        }
    }

    public function delete($id)
    {
        if (!in_array($this->user['role'], ['admin_desa', 'super_admin'])) {
            show_error('Only authorized users can delete Dana Lain applications.', 403, 'Access Denied');
        }

        $pengajuan = $this->Dana_lain_model->get_by_id($id);
        if (!$pengajuan || (isset($pengajuan->status) && $pengajuan->status !== 'diajukan')) {
            show_error('Dana Lain application not found or cannot be deleted.', 404, 'Not Found');
        }

        $this->Dana_lain_model->delete($id);
        $this->session->set_flashdata('success', 'Pengajuan Dana Lain berhasil dihapus');
        redirect('dana_lain');
    }

    public function update_status($id)
    {
        if (!in_array($this->user['role'], ['kadis', 'kabid'])) {
            show_error('Only district head or treasurer can update status for Dana Lain.', 403, 'Access Denied');
        }

        $pengajuan = $this->Dana_lain_model->get_by_id($id);
         if (!$pengajuan || (isset($pengajuan->status) && $pengajuan->status !== 'diajukan')) {
            show_error('Dana Lain application not found or cannot be updated.', 404, 'Not Found');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[diterima,ditolak]');
        $this->form_validation->set_rules('catatan', 'Catatan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('dana_lain/view/'.$id);
        }

        $this->Dana_lain_model->update_status(
            $id,
            $this->input->post('status'),
            $this->input->post('catatan')
        );

        $this->session->set_flashdata('success', 'Status pengajuan Dana Lain berhasil diperbarui');
        redirect('dana_lain/view/'.$id);
    }

    public function get_desa_by_kecamatan($kecamatan_id) {
        $desa = $this->Desa_model->get_by_kecamatan($kecamatan_id);
        echo json_encode($desa);
    }

    public function get_desa_details($desa_id) {
        $desa = $this->Desa_model->get_by_id($desa_id);
        if ($desa) {
            echo json_encode([
                'nama_kepala_desa' => $desa->nama_kepala_desa,
                'no_kontak_kades' => $desa->no_kontak_kades,
                'nama_bank' => $desa->nama_bank,
                'no_rekening' => $desa->no_rekening,
                'kecamatan_id' => $desa->kecamatan_id
            ]);
        } else {
            echo json_encode(['error' => 'Desa not found']);
        }
    }

    public function handle_upload($field_name, $upload_path, $allowed_types = 'gif|jpg|png|pdf', $max_size = 2048) {
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
} 