<?php

class reporte_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function nueva_busqueda($campos)
    {

    $and_or = $this->input->post('libro_id') != '' ? ' AND ' : ' AND ';
    $condiciones = array();

    foreach($campos as $campo){

    if($this->input->post($campo) && $this->input->post($campo) != '')
    {
        $condiciones[] = "$campo =" . "'".$this->input->post($campo). "'";
            }
    }

    $sql = "SELECT * FROM reservas ";


    if(count($condiciones) > 0)
    {

        $sql .= "WHERE " . implode ($and_or, $condiciones);
    }

    $query = $this->db->query($sql);
   // var_dump($sql); exit;


    //si se ha encontrado algo
    if($query->num_rows() > 0)
    {

    return $query->result_array();

    }else{

    return FALSE;

    }

    }

}
