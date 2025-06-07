<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siltap extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Load necessary models here if needed
        // $this->load->model('siltap_model');
    }

    public function add()
    {
        $data['title'] = 'SI PANDHU - Add Siltap'; // Set the title for the page
        $data['content'] = $this->load->view('siltap/add_siltap_view', '', TRUE); // Load the content view

        $this->load->view('layout/main_layout', $data); // Load the main layout with content
    }
} 