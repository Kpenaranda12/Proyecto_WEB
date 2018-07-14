<?php

	class categoria_model extends CI_Model{


		public function __construct(){
			$this->load->database();
		}


		public function get_categories(){
			$this->db->order_by('nombre');
			$query = $this->db->get('categorias');
			return $query->result_array();
		}


		public function create_categoria(){


			$data = array(
				'nombre' => $this->input->post('nombre')
			);


			return $this->db->insert('categorias', $data);
		}


		public function get_categorias(){
			$this->db->order_by('nombre');
			$query = $this->db->get('categorias');
			return $query->result_array();
		}
		public function get_categoriasExiste($id){
			$result= $this->db->query("SELECT * FROM categorias, libros where id_cat='$id' and categorias.id_cat=libros.categoria_id");

			if($result->num_rows() == 1){
				return $result->row(0)->id_cat;
			} else {
				return false;
			}
		}
		public function get_categoria($id){
			$query = $this->db->get_where('categorias', array('id_cat' => $id));
			return $query->row_array();

		}
		public function delete_categoria($id){
			$this->db->where('id_cat', $id);
			$this->db->delete('categorias');
			return true;
		}

		public function update_categoria()
		{
			$data = array(
				'nombre' => $this->input->post('titulo'),
			);
			$this->db->where('id_cat', $this->input->post('id'));
			return $this->db->update('categorias', $data);
		}
	}
