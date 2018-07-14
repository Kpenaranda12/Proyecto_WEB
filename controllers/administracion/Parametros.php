<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Parametros extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('parametros_model');
        $this->load->library(array(
            'session',
            'form_validation',
        ));
        $this->load->helper(array(
            'url',
            'form',
        ));
    }
    function Seguridad()
    {
        if ($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != '1') {
            redirect(base_url() . 'Usuario/login');
        }
    }
    public function index()
    {
        $this->Seguridad();
        $data['parametros'] = $this->parametros_model->get_parametros_();
        if (empty($data['parametros'])) {
            show_404();
        }
        $data['title'] = 'Parametros generales del sistema';
        $this->load->view('plantilla/header');
        $this->load->view('admin/parametro/view', $data);
        $this->load->view('plantilla/footer');
    }

    //Funcion para actualizar
    public function update()
    {
        $this->Seguridad();
        $this->parametros_model->update_parametros($slug);
        $this->session->set_flashdata('exito', 'Cambio realizado con éxito.');
        redirect('administracion/Parametros');
    }

}
