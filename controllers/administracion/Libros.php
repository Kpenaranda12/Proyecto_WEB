<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Libros extends CI_Controller
{
    public function __construct()
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
    function Seguridad()
    {
        if ($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != '1') {
            redirect(base_url() . 'Usuario/login');
        }
    }
    public function index()
    {
        $this->Seguridad();
        $data['title'] = 'Nuestros Libros';
        $data['libros'] = $this->libro_model->get_libros();
        $data['categorias'] = $this->categoria_model->get_categorias();
        $pagina = 'admin/libro/view';
        // variables que quiero ensenar en la vista
        $this->load->view('plantilla/header');
        $this->load->view($pagina, $data);
        $this->load->view('plantilla/footer');
    }
    public function filtro()
    {
        $this->Seguridad();
        $data['title'] = 'Nuestros Libros';
        $data['libros'] = $this->libro_model->get_libros_filtro($this->input->post('categoria_id'));
        $data['categorias'] = $this->categoria_model->get_categorias();
        $pagina = 'admin/libro/view';
        // variables que quiero ensenar en la vista
        $this->load->view('plantilla/header');
        $this->load->view($pagina, $data);
        $this->load->view('plantilla/footer');
    }

    public function create()
    {
        $this->Seguridad();
        $data['title'] = 'Crear Libro';
        $data['categorias'] = $this->libro_model->get_categorias();

        $this->form_validation->set_rules('titulo', 'Titulo', 'required');
        $this->form_validation->set_rules('autor', 'Autor', 'required');
        $this->form_validation->set_rules('fecha', 'Fecha', 'required');
        $this->form_validation->set_rules('edicion', 'Edicion', 'required');
        $this->form_validation->set_rules('cantidad', 'Cantidad', 'required');
        $this->form_validation->set_rules('pais', 'Pais', 'required');
        $this->form_validation->set_rules('resumen', 'Resumen', 'required');

        if ($this->form_validation->run() === false) {
            $this->load->view('plantilla/header');
            $this->load->view('admin/libro/create', $data);
            $this->load->view('plantilla/footer');
        } else {
            $config['upload_path'] = './public/images/libros';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2048';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';

            $this->load->library('upload', $config);

            # En caso que no se suba la foto me salga un error
            if (!$this->upload->do_upload()) {
                $errors = array('error' => $this->upload->display_errors());
                $libro_image = 'noimage.jpg'; #variable de default
            } else {
                #En caso que si se subio
                #userfile es el nombre del campo que creamos, y queremos obtener el nombre
                $data = array('upload_data' => $this->upload->data());
                $libro_image = $_FILES['userfile']['name'];
            }
            $this->libro_model->create_libros($libro_image);
            redirect('administracion/Libros');
        }

    }
    public function edit($slug)
    {
        $this->Seguridad();
        $data['libro'] = $this->libro_model->get_libros_($slug);
        $data['categorias'] = $this->libro_model->get_categorias();

        if (empty($data['libro'])) {
            show_404();
        }
        $data['title'] = 'Editar Libro';
        $this->load->view('plantilla/header');
        $this->load->view('admin/libro/edit', $data);
        $this->load->view('plantilla/footer');
    }
    public function update()
    {
        $this->Seguridad();
        $this->libro_model->update_libros($slug);
        $this->session->set_flashdata('exito', 'Cambio realizado con éxito.');
        redirect('administracion/Libros');
    }
    public function delete($id)
    {
        $this->Seguridad();
        $existe = $this->libro_model->get_librosExiste($id);
        if($existe=="")
        {
            $this->libro_model->delete_libro($id);
            $this->session->set_flashdata('exito', 'Libro eliminado.');
            redirect('administracion/Libros');
        }
        else
        {
            $this->session->set_flashdata('error', 'Este libro esta siendo usado por un usuario, no es posible eliminarlo.');
            redirect('administracion/Libros');
        }

    }
    public function view($slug = null)
    {
        $this->Seguridad();
        $data['libro'] = $this->libro_model->get_libros_($slug);

        if (empty($data['libro'])) {
            show_404();
        }
        $data['titulo'] = "Información detallada";
        $this->load->view('plantilla/header');
        $this->load->view('admin/libro/detalle', $data);
        $this->load->view('plantilla/footer');
    }
}
