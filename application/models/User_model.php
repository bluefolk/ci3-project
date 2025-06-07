<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function authenticate($username, $password)
    {
        $user = $this->db->get_where('users', ['username' => $username])->row();

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }

        return false;
    }

    public function get_user_by_id($id)
    {
        $this->db->select('users.*, desa.nama_desa, kecamatan.nama_kecamatan');
        $this->db->from('users');
        $this->db->join('desa', 'desa.id = users.desa_id', 'left');
        $this->db->join('kecamatan', 'kecamatan.id = users.kecamatan_id', 'left');
        $this->db->where('users.id', $id);
        return $this->db->get()->row();
    }
    public function get_all_users()
    {
        return $this->db->get('users')->result();
    }

    public function create_user($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $this->db->insert('users', $data);
    }

    public function update_user($id, $data)
    {
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function delete_user($id)
    {
        return $this->db->delete('users', ['id' => $id]);
    }

    public function get_users_by_role($role)
    {
        return $this->db->get_where('users', ['role' => $role])->result();
    }
}