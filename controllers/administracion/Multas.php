<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Multas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('reserva_model');
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
    public function index(){
        $this->Seguridad();
        $data['title'] = 'Multas';
        $data['reservas'] = $this->reserva_model->get_reservas();
        $data['libros'] = $this->reserva_model->get_libros();
        $data['users'] = $this->reserva_model->get_users();
        $data['multas'] = $this->reserva_model->get_multas();
        $data['parametros'] = $this->reserva_model->get_parametros();
        $this->form_validation->set_rules('fecha', 'Fecha', 'required');
        $this->form_validation->set_rules('devolucion', 'Devolucion', 'required');
        if($this->form_validation->run() === FALSE){
            $this->load->view('plantilla/header');
            $this->load->view('admin/multa/view', $data);
            $this->load->view('plantilla/footer');
        } else {
            $this->reserva_model->create_reservas();
            redirect('Reservas/create');
        }
    }

}
