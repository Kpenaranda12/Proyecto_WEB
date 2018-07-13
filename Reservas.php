<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reservas extends CI_Controller
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
    public function Seguridad()
    {
        if ($this->session->userdata('rol') == false || $this->session->userdata('rol') != '2') {
            redirect(base_url() . 'Usuario/login');
        }
    }
    public function create($miIDlibro = null)
    {
        $this->Seguridad();
        $data['title'] = 'Crear Reservas';
        $data['reservas'] = $this->reserva_model->get_reservas_cli($this->session->userdata('user_id'));
        $data['libros'] = $this->reserva_model->get_libros();
        $data['users'] = $this->reserva_model->get_users_cli($this->session->userdata('user_id'));
        $data['multas'] = $this->reserva_model->get_multas_cli($this->session->userdata('user_id'));
        $data['parametros'] = $this->reserva_model->get_parametros();
        $data['miIDlibro'] = $miIDlibro;
        $this->form_validation->set_rules('fecha', 'Fecha', 'required');
        $this->form_validation->set_rules('devolucion', 'Devolucion', 'required');
        if ($this->form_validation->run() === false) {
            $this->load->view('plantilla/header');
            $this->load->view('reservas', $data);
            $this->load->view('plantilla/footer');
        } else {
            $datos = $this->reserva_model->get_parametros();
            foreach ($datos as $dt) {
                $copias = $dt['copias'];
                $datos = $this->reserva_model->create_reservas($copias);
                if ($datos == FALSE) {
                    $this->session->set_flashdata('error', 'Soliciud no pudo se procesada porque ha excedido el número de copias.');
                    redirect('Reservas/create');
                } else {
                    $this->session->set_flashdata('exito', 'Registro realizado con éxito.');
                    redirect('Reservas/create');
                }
            }

        }

    }
    public function devolver($id, $id_l)
    {
        $this->Seguridad();
        $this->reserva_model->update_reserv($id, $id_l);
        $this->session->set_flashdata('exito', 'Devolución realizada.');
        redirect('Reservas/create');
    }
    public function devolverPago($id, $id_l)
    {
        $this->Seguridad();
        $datos = $this->reserva_model->get_parametros();
        foreach ($datos as $dt) {
            $costo = $dt['multa_por_dia'];
            $this->reserva_model->update_reservPago($id, $costo, $id_l);
        }
        $this->session->set_flashdata('exito', 'Devolución y pago realizado.');
        redirect('Reservas/create');
    }
}
