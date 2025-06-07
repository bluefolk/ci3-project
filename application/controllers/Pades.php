<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pades extends MY_Controller {

    protected $allowed_roles = ['super_admin', 'admin_desa', 'kadis', 'kabid'];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pengajuan_model');
        $this->load->model('Desa_model');
    }

    public function index()
    {
        $data['title'] = 'SI PANDHU - PADes';
        
        // Get applications based on user role
        switch ($this->user['role']) {
            case 'admin_desa':
                $data['pengajuan'] = $this->Pengajuan_model->get_pengajuan_by_desa($this->user['desa_id']);
                break;
            case 'kadis':
                $data['pengajuan'] = $this->Pengajuan_model->get_pengajuan_by_kecamatan($this->user['kecamatan_id']);
                break;
            default:
                $data['pengajuan'] = $this->Pengajuan_model->get_all_pengajuan();
        }

        $this->load_view('pades/index_view', $data);
    }

    public function view($id)
    {
        $data['title'] = 'SI PANDHU - Detail PADes';
        $data['pengajuan'] = $this->Pengajuan_model->get_pengajuan_by_id($id);
        $data['dokumen'] = $this->Pengajuan_model->get_dokumen_by_pengajuan($id);
        $data['riwayat'] = $this->Pengajuan_model->get_riwayat_pengajuan($id);

        $this->load_view('pades/detail_view', $data);
    }

    public function create()
    {
        if ($this->user['role'] !== 'admin_desa') {
            show_error('Only village admins can create applications.', 403, 'Access Denied');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('jumlah_bantuan', 'Jumlah Bantuan', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'SI PANDHU - Buat PADes';
            $data['desa'] = $this->Desa_model->get_desa_by_id($this->user['desa_id']);
            $this->load_view('pades/create_view', $data);
        } else {
            $pengajuan_data = [
                'desa_id' => $this->user['desa_id'],
                'jenis_pengajuan' => 'pades',
                'jumlah_bantuan' => $this->input->post('jumlah_bantuan'),
                'status' => 'diajukan'
            ];

            $pengajuan_id = $this->Pengajuan_model->create_pengajuan($pengajuan_data);

            // Handle file uploads
            $upload_path = './uploads/dokumen/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            }

            $dokumen_types = [
                'surat_permohonan_bupati',
                'rekomendasi_camat',
                'surat_permohonan_bank',
                'spp_sptb',
                'rpd',
                'rekening_koran',
                'bukti_setoran_apdes'
            ];

            foreach ($dokumen_types as $type) {
                if (isset($_FILES[$type]) && $_FILES[$type]['error'] == 0) {
                    $upload = $this->handle_upload($type, $upload_path);
                    if ($upload['success']) {
                        $this->Pengajuan_model->add_dokumen([
                            'pengajuan_id' => $pengajuan_id,
                            'jenis_dokumen' => $type,
                            'nama_file' => $upload['data']['file_name'],
                            'path_file' => $upload_path . $upload['data']['file_name']
                        ]);
                    }
                }
            }

            $this->session->set_flashdata('success', 'Application submitted successfully');
            redirect('pades');
        }
    }

    public function update_status($id)
    {
        if (!in_array($this->user['role'], ['super_admin', 'kadis', 'kabid'])) {
            show_error('You do not have permission to update application status.', 403, 'Access Denied');
        }

        $status = $this->input->post('status');
        $catatan = $this->input->post('catatan');

        if ($this->Pengajuan_model->update_status($id, $status, $this->user['id'], $catatan)) {
            $this->session->set_flashdata('success', 'Application status updated successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to update application status');
        }

        redirect('pades/view/' . $id);
    }

    public function download_dokumen($dokumen_id)
    {
        $dokumen = $this->Pengajuan_model->get_dokumen_by_id($dokumen_id);
        
        if (!$dokumen) {
            show_error('Document not found', 404);
        }

        $this->load->helper('download');
        force_download($dokumen->path_file, NULL);
    }
} 