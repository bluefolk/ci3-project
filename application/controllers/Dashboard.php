<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load necessary models here if needed
        $this->load->library('session');
        $this->load->model('Dashboard_model');
        $this->load->model('User_model');
    }

    public function index()
    {
        $data['akun'] = $this->User_model->get_user_by_id($this->session->userdata('user_id'));

        $user = [
            'role' => $this->session->userdata('role'),
            'desa_id' => $this->session->userdata('desa_id')
        ];

        $dashboard_link = ($this->session->userdata('role') == 'admin_desa') ? 'dashboard_pemdes' : 'dashboard';
        $data['active_sidebar'] = 'dashboard'; // Set the active sidebar menu item
        $data['sidebar_menu'] = [
            ['icon' => 'fas fa-home', 'link' => 'dashboard', 'title' => 'Dashboard'],
            ['icon' => 'fas fa-clock', 'link' => 'dana_desa', 'title' => 'Pengajuan Dana'],
            ['icon' => 'fas fa-file-alt', 'link' => 'berita_acara', 'title' => 'Berita Acara'],
            ['icon' => 'fas fa-user-alt', 'link' => 'informasi_akun', 'title' => 'Informasi Akun'],
            ['icon' => 'fas fa-sign-out-alt', 'link' => 'auth/logout', 'title' => 'Keluar'],
        ];
        $data['title'] = 'SI PANDHU - Dashboard'; // Set the title for the page
        if ($dashboard_link == 'dashboard_pemdes') {
            $data['total'] = $this->Dashboard_model->get_total_status($user);
        } else {
            $data['total'] = $this->Dashboard_model->get_total_dana(); // Get total status counts
        }
        $data['content'] = $this->load->view($dashboard_link . '/index_view', $data, TRUE); // Load the content view

        $this->load->view('layout/sidebar_view', $data); // load sidebar

        $this->load->view('layout/main_layout', $data); // Load the main layout with content
    }
}