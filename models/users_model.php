<?php

	class users_model extends CI_Model{


		public function __construct(){
			$this->load->database();
		}

		public function get_users($slug = FALSE){
			if($slug === FALSE){
				$this->db->order_by('nombre');
				$query = $this->db->get('users');
				return $query->result_array();
			}
			$query = $this->db->get_where('users', array('slug' => $slug));
			return $query->row_array();
		}
		public function get_usersExiste($id){
			$result= $this->db->query("SELECT * FROM users, reservas where id_user='$id' and users.id_user=reservas.users_id limit 1");

			if($result->num_rows() == 1){
				return $result->row(0)->id_user;
			} else {
				return false;
			}
		}


		public function create_users(){
			$slug = url_title($this->input->post('nombre'));

			$data = array(
				'nombre' => $this->input->post('nombre'),
				'slug' => $slug,
				'apellido' => $this->input->post('apellido'),
				'correo' => $this->input->post('correo'),
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'telefono' => $this->input->post('telefono'),
				'rol' => 2
				);

			return $this->db->insert('users', $data);
		}

	 	public function login($username, $password){

	 		$this->db->where('username', $username);
	 		$this->db->where('password', $password);


	 		$result = $this->db->get('users');


	 		if($result->num_rows() == 1){
	 			return $result->row(0)->id_user;
	 		} else {
	 			return false;
	 		}

	 	}


		public function update_users(){
			$slug = url_title($this->input->post('nombre'));
			$data = array(
				'nombre' => $this->input->post('nombre'),
				'slug' => $slug,
				'apellido' => $this->input->post('apellido'),
				'correo' => $this->input->post('correo'),
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'telefono' => $this->input->post('telefono'),
				'rol' => $this->input->post('id_role')
				);

			$this->db->where('id_user', $this->input->post('id'));
			return $this->db->update('users', $data);
		}

		public function delete_users($id){
			$this->db->where('id_user', $id);
			$this->db->delete('users');
			return true;
		}
		 public function check_email_exists($correo){
	 	$query = $this->db->get_where('users', array('correo' => $correo));
	 	if(empty($query->row_array())){
	 		return true;
	 	} else {
	 		return false;
	 	}
	}

	 public function check_username_exists($username){
	 	$query = $this->db->get_where('users', array('username' => $username));
	 	if(empty($query->row_array())){
	 		return true;
	 	} else {
	 		return false;
	 	}
	 }
	 public function login_rol($username, $password){

		$this->db->where('username', $username);
		$this->db->where('password', $password);


		$result = $this->db->get('users');


		if($result->num_rows() == 1){
			return $result->row(0)->rol;
		} else {
			return false;
		}

	}
}
