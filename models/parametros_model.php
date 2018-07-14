<?php

class parametros_model extends CI_Model{

		public function __construct(){
			$this->load->database();
		}


		public function get_parametros(){
			$query = $this->db->get('parametros');
			return $query->result_array();
		}
		public function get_parametros_(){
			$query = $this->db->get('parametros');
			return $query->row_array();
		}


		public function create_parametro(){

			$slug = url_title($this->input->post('title'));


			$data = array(
				'title' => $this->input->post('title'),
				'slug' => $slug,
				'multa_por_dia' => $this->input->post('multa'),
				'copias' => $this->input->post('copias'),
				'dias_devolucion' => $this->input->post('dias')
			);


			return $this->db->insert('parametros', $data);
		}
		public function update_parametros(){
			$slug = url_title($this->input->post('title'));

			$data = array(
				'title' => $this->input->post('title'),
				'slug' => $slug,
				'multa_por_dia' => $this->input->post('multa'),
				'copias' => $this->input->post('copias'),
				'dias_devolucion' => $this->input->post('dias')
				);

			$this->db->where('id_par', $this->input->post('id'));
			return $this->db->update('parametros', $data);
		}
		public function delete_parametros($id){
			$this->db->where('id', $id);
			$this->db->delete('parametros');
			return true;
		}


	}
