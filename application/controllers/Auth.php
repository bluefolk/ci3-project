<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index()
    {
        // If user is already logged in, redirect to dashboard
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }
        // Otherwise show login page
        $this->load->view('auth/login_view');
    }

    public function login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login_view');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->User_model->authenticate($username, $password);

            if ($user) {
                // Set session data
                $session_data = [
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'no_hp' => $user->no_hp,
                    'role' => $user->role,
                    'nama_lengkap' => $user->nama_lengkap,
                    'foto' => $user->foto,
                    'desa_id' => $user->desa_id,
                    'kecamatan_id' => $user->kecamatan_id,
                    'logged_in' => TRUE
                ];
                $this->session->set_userdata($session_data);

                // Redirect based on role
                // switch ($user->role) {
                //     case 'super_admin':
                //     case 'kabid':
                //         redirect('dashboard');
                //         break;
                //     case 'admin_desa':
                //         redirect('das');
                //         break;
                //     case 'kadis':
                //         redirect('pengajuan/kecamatan');
                //         break;
                //     default:
                        redirect('dashboard');
                // }
            } else {
                $this->session->set_flashdata('error', 'Email atau password Anda salah');
                redirect('auth');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata(['user_id', 'username', 'role', 'nama_lengkap', 'no_hp', 'logged_in', 'foto', 'desa_id', 'kecamatan_id']);
        redirect('auth');
    }

    public function change_password()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('current_password', 'Current Password', 'required');
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/change_password_view');
        } else {
            $user = $this->User_model->get_user_by_id($this->session->userdata('user_id'));
            
            if (password_verify($this->input->post('current_password'), $user->password)) {
                $this->User_model->update_user($user->id, [
                    'password' => $this->input->post('new_password')
                ]);
                
                $this->session->set_flashdata('success', 'Password changed successfully');
                redirect('auth/change_password');
            } else {
                $this->session->set_flashdata('error', 'Current password is incorrect');
                redirect('auth/change_password');
            }
        }
    }
} 