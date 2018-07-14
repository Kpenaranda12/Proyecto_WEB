<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuario extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('users_model');
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
        $pagina = 'admin/usuario/view';
        // variables que quiero ensenar en la vista
        $data['users'] = $this->users_model->get_users();
        $data['title'] = ucfirst($pagina);
        $this->load->view('plantilla/header');
        $this->load->view($pagina, $data);
        $this->load->view('plantilla/footer');
    }
    public function delete($id)
	{
        $this->Seguridad();
        $existe = $this->users_model->get_usersExiste($id);
        if($existe=="")
        {
            $this->users_model->delete_users($id);
            $this->session->set_flashdata('exito', 'Usuario eliminado.');
            redirect('administracion/Usuario');
        }
        else
        {
            $this->session->set_flashdata('error', 'Este usuario tiene reservas activas, no es posible eliminarlo.');
            redirect('administracion/Usuario');
        }
		
    }
    public function edit($slug){
        $this->Seguridad();
        $data['user'] = $this->users_model->get_users($slug);

        if(empty($data['user'])){
            show_404();
        }
        $data['title'] = 'Editar Usuario';

        $this->load->view('plantilla/header');
        $this->load->view('admin/usuario/edit', $data);
        $this->load->view('plantilla/footer');
    }
    public function update(){
        $this->Seguridad();
        $this->users_model->update_users();
        $this->session->set_flashdata('exito', 'Cambio realizado con éxito.');
        redirect('administracion/Usuario');
    }

    public function create(){
        $this->Seguridad();
        $data['title'] = 'Registrar Usuario';
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
         $this->form_validation->set_rules('apellido', 'Apellido', 'required');
         $this->form_validation->set_rules('correo', 'Correo', 'required');
         $this->form_validation->set_rules('username', 'Username', 'required');
         $this->form_validation->set_rules('password', 'Password', 'required');
         $this->form_validation->set_rules('telefono', 'Telefono', 'required');

        if($this->form_validation->run() === FALSE){
           $this->load->view('plantilla/header');
           $this->load->view('admin/usuario/create', $data);
           $this->load->view('plantilla/footer');
       } else {
           $this->users_model->create_users();
           $this->session->set_flashdata('exito', 'Registro realizado con éxito.');
           redirect('administracion/Usuario');
       }

   }

}
