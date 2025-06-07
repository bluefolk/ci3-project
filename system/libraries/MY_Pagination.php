<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Pagination extends CI_Pagination
{
    public function create_links()
    {
        // Periksa nilai segment URI dengan default 0
        $segment = $this->CI->uri->segment($this->uri_segment, 0);

        // Jika bukan angka, pagination tidak akan diproses
        if (!is_numeric($segment)) {
            return '';
        }

        // Panggil fungsi aslinya
        return parent::create_links();
    }
}