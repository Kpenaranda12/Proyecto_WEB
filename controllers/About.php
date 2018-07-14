<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About extends CI_Controller
{
    public function index()
    {
        $pagina = 'about';
        $data['title'] = ucfirst($pagina);
        $this->load->view('plantilla/header');
        $this->load->view($pagina, $data);
        $this->load->view('plantilla/footer');
    }
}
