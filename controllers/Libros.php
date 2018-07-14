<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Libros extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('libro_model');
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

    public function index()
    {
        $data['title'] = 'Nuestros Libros';
        $data['libros'] = $this->libro_model->get_libros();
        $data['categorias'] = $this->categoria_model->get_categorias();
        $pagina = 'libros';
        $data['title'] = ucfirst($pagina);
        $this->load->view('plantilla/header');
        $this->load->view($pagina, $data);
        $this->load->view('plantilla/footer');
    }
    public function view($slug = null)
    {
        $data['libro'] = $this->libro_model->get_libros_($slug);

        if (empty($data['libro'])) {
            show_404();
        }
        $data['titulo'] = "Información detallada";
        $this->load->view('plantilla/header');
        $this->load->view('detalle', $data);
        $this->load->view('plantilla/footer');
    }
    public function filtro()
    {
        $data['title'] = 'Libros';
        $data['libros'] = $this->libro_model->get_libros_filtro($this->input->post('categoria_id'));
        $data['categorias'] = $this->categoria_model->get_categorias();
        $pagina = 'libros';
        $this->load->view('plantilla/header');
        $this->load->view($pagina, $data);
        $this->load->view('plantilla/footer');
    }

}
