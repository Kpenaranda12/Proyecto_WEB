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
    public function index(){
        $data['title'] = 'Parametros';
        $data['parametros'] = $this->parametros_model->get_parametros();
        if (empty($data['parametros'])) {
            show_404();
        }
           $this->load->view('plantilla/header');
           $this->load->view('parametros', $data);
           $this->load->view('plantilla/footer');
   }

}
