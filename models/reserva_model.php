<?php

class reserva_model extends CI_Model
{


    public function __construct()
    {
        $this->load->database();
    }

    public function get_reservas()
    {
        $query = $this->db->get('reservas');
        return $query->result_array();
    }



    public function get_reservas_cli($id)
    {
        $query = $this->db->query("SELECT * FROM reservas where users_id='" . $id . "' ;");
        return $query->result_array();
    }
    public function get_multas()
    {
        $query = $this->db->get('multas');
        return $query->result_array();
    }
    public function get_multas_cli($id)
    {
        $query = $this->db->query("SELECT * FROM multas where users_id='" . $id . "' ;");
        return $query->result_array();
    }


    public function create_reservas($copias)
    {

        $data = array(
            'libro_id' => $this->input->post('libro_id'),
            'users_id' => $this->input->post('users_id'),
            'parametros_id' => $this->input->post('parametros_id'),
            'fecha_de_reserva' => $this->input->post('fecha'),
            'fecha_de_devolucion' => $this->input->post('devolucion'),
        );

        $query_copias = $this->db->query("SELECT count(*) as copias FROM reservas where users_id='".$this->input->post('users_id')."' and estado='Prestado' ;");
        if ($query_copias->num_rows() > 0) {
            foreach ($query_copias->result() as $row_copias) {
                $data_copias[] = $row_copias;
            }
            foreach ($data_copias as $cop)
            {
                $copias_ = $cop->copias;
                if($copias_ < $copias)
                {

                    $query = $this->db->query("SELECT * FROM libros where id_libro='" . $this->input->post('libro_id') . "' ;");
                    if ($query->num_rows() > 0) {
                        foreach ($query->result() as $row) {
                            $data2[] = $row;
                        }
                        foreach ($data2 as $dt) {
                            $cantidad = $dt->cantidad;
                            if ($cantidad <= 0) {
                                return;
                            } else {
                                $datos = array(
                                    'cantidad' => $cantidad - 1,
                                );
                                $this->db->where('id_libro', $this->input->post('libro_id'));
                                $this->db->update('libros', $datos);
                                return $this->db->insert('reservas', $data);
                            }

                        }
                    }
                }
                else
                {
                    return FALSE;
                }
            }
        }


    }
    public function get_libros()
    {
        $query = $this->db->get('libros');
        return $query->result_array();
    }
    public function get_libros_fill($id)
    {
        $query = $this->db->query("SELECT * FROM libros where id_libro='" . $id . "' ;");
        return $query->result_array();
    }
    public function get_users_fill($id)
    {
        $query = $this->db->query("SELECT * FROM users where id_user='" . $id . "' ;");
        return $query->result_array();
    }

    public function get_users()
    {
        $query = $this->db->get('users');
        return $query->result_array();
    }
    public function get_users_cli($id)
    {
        $query = $this->db->query("SELECT * FROM users where id_user='" . $id . "' ;");
        return $query->result_array();
    }
    public function get_parametros()
    {
        $query = $this->db->get('parametros');
        return $query->result_array();
    }
    public function delete_reserva($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('reservas');
    }
    public function update_reserv($id, $id_l)
    {
        $data = array(
            'estado' => 'Devuelto',
        );

        $query = $this->db->query("SELECT * FROM libros where id_libro='" . $id_l . "' ;");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data2[] = $row;
            }
            foreach ($data2 as $dt) {
                $cantidad = $dt->cantidad;
                if ($cantidad < 0) {
                    return;
                } else {
                    $datos = array(
                        'cantidad' => $cantidad + 1,
                    );
                    $this->db->where('id_libro', $id_l);
                    $this->db->update('libros', $datos);

                    $this->db->where('id_reserv', $id);
                    return $this->db->update('reservas', $data);

                }

            }
        }

    }
    public function update_reservPago($id, $costo, $id_l)
    {
        $data = array(
            'estado' => 'Devuelto',
        );

        $query_ = $this->db->query("SELECT * FROM libros where id_libro='" . $id_l . "' ;");
        if ($query_->num_rows() > 0) {
            foreach ($query_->result() as $row_) {
                $data2_[] = $row_;
            }
            foreach ($data2_ as $dt_) {
                $cantidad = $dt_->cantidad;
                if ($cantidad < 0) {
                    return;
                } else {
                    $datos = array(
                        'cantidad' => $cantidad + 1,
                    );
                    $this->db->where('id_libro', $id_l);
                    $this->db->update('libros', $datos);

                    $this->db->where('id_reserv', $id);
                    $this->db->update('reservas', $data);

                    $query = $this->db->query("SELECT * FROM reservas where id_reserv='" . $id . "' ;");
                    if ($query->num_rows() > 0) {
                        foreach ($query->result() as $row) {
                            $data2[] = $row;
                        }
                        foreach ($data2 as $dt) {
                            $fecha_dev = $dt->fecha_de_devolucion;
                            $today_date = date('Y-m-d');
                            $count = abs(strtotime($today_date) - strtotime($fecha_dev));
                            $day = $count / 86400;
                            $precio = $day * $costo;
                            $datos_ = array(
                                'users_id' => $dt->users_id,
                                'id_reserv' => $id,
                                'total_Multa' => $precio,
                                'estado' => 'Pago realizado',
                                'dias' => $day,

                            );

                            return $this->db->insert('multas', $datos_);

                        }
                    }

                }

            }
        }

    }

}
