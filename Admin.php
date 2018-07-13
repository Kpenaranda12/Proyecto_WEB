<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function Seguridad()
    {
        if ($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != '1') {
            redirect(base_url() . 'Usuario/login');
        }
    }
    public function index()
    {
        $this->Seguridad();
        $pagina = 'admin';
        $data['title'] = 'Administración';
        $this->load->view('plantilla/header');
        $this->load->view($pagina, $data);
        $this->load->view('plantilla/footer');
    }
}
