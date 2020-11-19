<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class App_model_importarXLS extends CI_Model {

    public function set_historico(
    $idUsuario, $idAccion, $tipoAccion, $tipoOperacion, $detalle, $total
    ) {
        $values = array(
            'idUsuario' => $idUsuario,
            'idAccion' => $idAccion,
            'tipoAccion' => $tipoAccion,
            'tipoOperacion' => $tipoOperacion,
            'detalle' => $detalle,
            'total' => $total
        );

        $result = $this->db->insert('historico', $values);
        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function get_historico() {
        $this->db->select('
                    usuarios.nombreCompleto as nombreCompleto, 
                    usuarios.imgPerfil as miniatura, 
                    historico.fechaAlta as fechaAlta, 
                    historico.detalle as detalle, 
                    historico.total as total, 
                    historico_tipo.descripcion as descripcionTipo, 
                    historico_operacion.descripcion as descripcionOperacion
                ');
        $this->db->join('usuarios', 'usuarios.idUsuario = historico.idUsuario');
        $this->db->join('historico_tipo', 'historico_tipo.idTipo = historico.tipoAccion');
        $this->db->join('historico_operacion', 'historico_operacion.idOperacion = historico.tipoOperacion');
        $this->db->order_by('fechaAlta', 'DESC');
        $this->db->from('historico');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function insert_datos_file_clientes($datos_clientes) {

        $result = $this->db->insert_batch('clientes', $datos_clientes);
        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function insert_datos_file_clientes_detalle_facturacion($datos_clientes_detalle_facturacion) {

        $result = $this->db->insert_batch('clientes_detalle_facturacion', $datos_clientes_detalle_facturacion);
        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function insert_datos_file_clientes_detalle_ventas($datos_clientes_detalle_ventas) {

        $result = $this->db->insert_batch('clientes_detalle_ventas', $datos_clientes_detalle_ventas);
        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function insert_datos_file_proveedores($datos_proveedores) {

        $result = $this->db->insert_batch('proveedores', $datos_proveedores);
        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function insert_datos_file_proveedores_detalle_facturacion($datos_proveedores_detalle_facturacion) {

        $result = $this->db->insert_batch('proveedores_detalle_facturacion', $datos_proveedores_detalle_facturacion);
        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function insert_datos_file_proveedores_detalle_compras($datos_proveedores_detalle_compras) {

        $result = $this->db->insert_batch('proveedores_detalle_compras', $datos_proveedores_detalle_compras);
        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function insert_datos_file_productos($datos_productos) {

        $result = $this->db->insert_batch('productos', $datos_productos);
        return (($this->db->affected_rows() > 0) ? true : false);
    }

}
