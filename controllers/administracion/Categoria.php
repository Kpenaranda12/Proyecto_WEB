<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categoria extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('categoria_model');
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
        $pagina = 'admin/categoria/view';
        // variables que quiero ensenar en la vista
        $data['title'] = 'Categorias';
        $data['categorias'] = $this->categoria_model->get_categorias();
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->load->view('plantilla/header');
        $this->load->view($pagina, $data);
        $this->load->view('plantilla/footer');
    }
    public function create()
    {
        $this->Seguridad();
        $data['title'] = 'Crear Categoria';
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        if ($this->form_validation->run() === false) {
            $this->load->view('plantilla/header');
            $this->load->view('administracion/Categoria/create', $data);
            $this->load->view('plantilla/footer');
        } else {
            $this->categoria_model->create_categoria();
            $this->session->set_flashdata('exito', 'Registro realizado con éxito.');
            redirect('administracion/Categoria');
        }

    }
    public function delete($id)
    {
        $this->Seguridad();
        $existe = $this->categoria_model->get_categoriasExiste($id);
        if($existe=="")
        {
            $this->categoria_model->delete_categoria($id);
            $this->session->set_flashdata('exito', 'Categoria eliminadqs.');
            redirect('administracion/Categoria');
        }
        else
        {
            $this->session->set_flashdata('error', 'Esta categoria esta siendo usado por un usuario, no es posible eliminarla.');
            redirect('administracion/Categoria');
        }
    }

    public function edit($id)
    {
        $this->Seguridad();
        $pagina = 'admin/categoria/edit';
        // variables que quiero ensenar en la vista
        $data['title'] = 'Categorias';
        $data['categorias'] = $this->categoria_model->get_categoria($id);
        $this->load->view('plantilla/header');
        $this->load->view($pagina, $data);
        $this->load->view('plantilla/footer');
    }

    public function update()
    {
        $this->Seguridad();
        $this->categoria_model->update_categoria($id);
        $this->session->set_flashdata('exito', 'Cambio realizado con éxito.');
        redirect('administracion/Categoria');
    }

}
