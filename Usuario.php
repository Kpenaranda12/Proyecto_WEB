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
    public function login()
    {
        $data['title'] = 'Iniciar Sesión';
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === false) {
            $this->load->view('plantilla/header');
            $this->load->view('login', $data);
            $this->load->view('plantilla/footer');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user_id = $this->users_model->login($username, $password);
            $rol = $this->users_model->login_rol($username, $password);
            if ($user_id) {
                $user_data = array(
                    'user_id' => $user_id,
                    'username' => $username,
                    'logged_in' => true,
                    'rol' => $rol,
                );

                $this->session->set_userdata($user_data);

                $this->session->set_flashdata('user_loggedin', 'Estas Logiado ahora, BIENVENIDO');


                redirect('Usuario/redirect');

            } else {


                $this->session->set_flashdata('login_failed', 'Usuario/contraseña invalido, Intente de nuevo');


                redirect('Usuario/login');
            }
        }
    }
    public function create()
    {
        $data['title'] = 'Registrar Usuario';
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('apellido', 'Apellido', 'required');
        $this->form_validation->set_rules('correo', 'Correo', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('telefono', 'Telefono', 'required');

        if ($this->form_validation->run() === false) {

            $this->load->view('plantilla/header');
            $this->load->view('registrar', $data);
            $this->load->view('plantilla/footer');
        } else {
            $this->session->set_flashdata('user_loggedin', 'Registro exitoso. Usa tus datos registrados para el ingreso.');
            $this->users_model->create_users();
            redirect('Usuario/Login');
        }

    }
    public function redirect()
    {

        switch ($this->session->userdata('rol')) {
            case '':
                $data['token'] = $this->token();
                $this->load->view('plantilla/header');
                $this->load->view('Usuario/login', $data);
                $this->load->view('plantilla/footer');
                break;
            case '1':
                redirect(base_url() . 'Admin');
                break;
            case '2':
                redirect(base_url() . 'Libros');
                break;

            default:
                $data['token'] = $this->token();
                $this->load->view('plantilla/header');
                $this->load->view('Usuario/login', $data);
                $this->load->view('plantilla/footer');
                break;
        }

    }

    public function logout()
    {

        $this->session->sess_destroy();
    
        $this->session->set_flashdata('user_loggedout', 'Acabas de salir de la session Gracias');
        redirect('Usuario/login');
    }
}
