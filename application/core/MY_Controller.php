<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    protected $user;
    protected $allowed_roles = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->check_auth();
    }

    protected function check_auth()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        $this->user = [
            'id' => $this->session->userdata('user_id'),
            'username' => $this->session->userdata('username'),
            'role' => $this->session->userdata('role'),
            'no_hp' => $this->session->userdata('role'),
            'nama_lengkap' => $this->session->userdata('nama_lengkap')
        ];

        if (!empty($this->allowed_roles) && !in_array($this->user['role'], $this->allowed_roles)) {
            show_error('You do not have permission to access this page.', 403, 'Access Denied');
        }
    }

    protected function load_view($view, $data = [])
    {
        $data['user'] = $this->user;
        $data['content'] = $this->load->view($view, $data, TRUE);
        $this->load->view('layout/main_layout', $data);
    }

    protected function json_response($data, $status = 200)
    {
        $this->output
            ->set_content_type('application/json')
            ->set_status_header($status)
            ->set_output(json_encode($data));
    }

    protected function handle_upload($field_name, $upload_path, $allowed_types = 'gif|jpg|jpeg|png|pdf', $max_size = 2048)
    {
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = $allowed_types;
        $config['max_size'] = $max_size;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($field_name)) {
            return [
                'success' => FALSE,
                'error' => $this->upload->display_errors()
            ];
        }

        return [
            'success' => TRUE,
            'data' => $this->upload->data()
        ];
    }
} 