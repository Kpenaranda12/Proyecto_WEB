<?php

class libro_model extends CI_Model
{


    public function __construct()
    {
        $this->load->database();
    }

    public function get_libros()
    {
        $this->db->order_by('id_libro');
        $this->db->join('categorias', 'categorias.id_cat = libros.categoria_id');
        $query = $this->db->get('libros');
        return $query->result_array();
    }
    public function get_librosExiste($id)
    {

        $this->db->where('id_libro', $id);
		$result = $this->db->get('libros');


		if($result->num_rows() == 1){
			return $result->row(0)->id_libro;
		} else {
			return false;
        }

    }
    public function get_libros_($slug)
    {
        $query = $this->db->get_where('libros', array('slug' => $slug));
        return $query->row_array();
    }
    public function get_libros_filtro($id)
    {
        $query = $this->db->get_where('libros', array('categoria_id' => $id));
        return $query->result_array();
    }



    public function create_libros($libro_image)
    {
        $slug = url_title($this->input->post('titulo'));

        $data = array(
            'titulo' => $this->input->post('titulo'),
            'slug' => $slug,
            'autor' => $this->input->post('autor'),
            'fecha_de_publicion' => $this->input->post('fecha'),
            'edicion' => $this->input->post('edicion'),
            'cantidad' => $this->input->post('cantidad'),
            'pais' => $this->input->post('pais'),
            'resumen' => $this->input->post('resumen'),
            'categoria_id' => $this->input->post('categoria_id'),
            'libro_imagen' => $libro_image,
        );

        return $this->db->insert('libros', $data);
    }


    public function update_libros()
    {
        $slug = url_title($this->input->post('titulo'));

        $data = array(
            'titulo' => $this->input->post('titulo'),
            'slug' => $slug,
            'autor' => $this->input->post('autor'),
            'fecha_de_publicion' => $this->input->post('fecha'),
            'edicion' => $this->input->post('edicion'),
            'cantidad' => $this->input->post('cantidad'),
            'pais' => $this->input->post('pais'),
            'resumen' => $this->input->post('resumen'),
            'categoria_id' => $this->input->post('categoria_id'),
        );

        $this->db->where('id_libro', $this->input->post('id'));
        return $this->db->update('libros', $data);
    }
    //Borar el libro
    public function delete_libro($id)
    {
        $this->db->where('id_libro', $id);
        $this->db->delete('libros');
        return true;
    }

    public function get_categorias()
    {
        $this->db->order_by('nombre');
        $query = $this->db->get('categorias');
        return $query->result_array();
    }

    public function get_libro_by_categoria($categoria_id)
    {
        $this->db->order_by('libros.id_libro');
        $this->db->join('categorias', 'categorias.id_cat = libros.categoria_id');
        $query = $this->db->get_where('libros', array('categoria_id' => $categoria_id));
        return $query->result_array();
    }
}
