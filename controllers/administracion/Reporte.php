<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reporte extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('reserva_model');
        $this->load->model('reporte_model');
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
        $pagina = 'admin/reporte/view';
        $data['title'] = 'Reporte General';
        $data['reservas'] = $this->reserva_model->get_reservas();
        $data['libros'] = $this->reserva_model->get_libros();
        $data['users'] = $this->reserva_model->get_users();
        $data['multas'] = $this->reserva_model->get_multas();
        $data['parametros'] = $this->reserva_model->get_parametros();
        $data['miIDlibro'] = Null;
        $this->load->view('plantilla/header');
        $this->load->view($pagina, $data);
        $this->load->view('plantilla/footer');
    }
    public function filtro()
    {
        $this->Seguridad();
        $pagina = 'admin/reporte/view';
        $FDev=$this->input->post('fecha_de_devolucion');
        $FRes=$this->input->post('fecha_de_reserva');
        $fecha_estado=$this->input->post('estado');
        $libro=$this->input->post('libro_id');
        $usuario=$this->input->post('users_id');
        if($FDev=="")
        {
            $campos = array('libro_id', 'users_id', 'fecha_de_reserva', 'estado');
        }
        else
        {
            if( $FRes=="")
            {
                $campos = array('libro_id', 'users_id', 'fecha_de_devolucion', 'estado');
            }
            else
            {
                $campos = array('libro_id', 'users_id', 'fecha_de_reserva','fecha_de_devolucion','estado');
            }
        }
        $data['reservas'] = $this->reporte_model->nueva_busqueda($campos);
        if($data['reservas']  !== FALSE)
        {
            $data['title'] = 'Reporte General';
            $data['libros'] = $this->reserva_model->get_libros();
            $data['users'] = $this->reserva_model->get_users();
            $data['multas'] = $this->reserva_model->get_multas();
            $data['parametros'] = $this->reserva_model->get_parametros();
            $data['miIDlibro'] = Null;
            $this->session->set_flashdata('exito', 'Datos filtrados correctamente');
            $this->load->view('plantilla/header');
            $this->load->view($pagina, $data);
            $this->load->view('plantilla/footer');
        }
        else
        {
            $this->session->set_flashdata('error', 'No existen datos para los filtros especificos, Intente nuevamente');
            redirect('administracion/Reporte');
        }
    }
}
