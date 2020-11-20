<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class App_model_bar extends CI_Model {

    public function get_mesa_byId($id) {
        $this->db->select('*');
        $this->db->from('mesas');
        $this->db->join('mesas_estado', 'mesas.idEstadoMesa = mesas_estado.idEstadoMesa');
        $this->db->where('mesas.id', $id);
        $this->db->where('mesas.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function status_pedido($idGenPedido) {
        $this->db->select('
                mesas_estado.idEstadoMesa,
                mesas_estado.estadoMesa, 
                mesas.id, mesas.descripcion, 
                mesas.cantidadPersonas, 
                mesas.idGenMesa,
                mesas.eliminado,
                pedidos.idMozo');
        $this->db->from('pedidos');
        $this->db->join('mesas', 'pedidos.idGenPedido = mesas.idPedido');
        $this->db->join('mesas_estado', 'mesas.idEstadoMesa = mesas_estado.idEstadoMesa');
        $this->db->where('mesas.idPedido', $idGenPedido);
        $this->db->where('mesas.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function update_mesa_pedido($idMesa, $idGenPedido) {
        $values = array(
            'idPedido' => $idGenPedido,
            'idEstadoMesa' => 2
        );

        $this->db->where('id', $idMesa);
        $result = $this->db->update('mesas', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function insert_nuevo_pedido($idMesa, $idGenPedido, $idMozo, $idTab) {
        $values = array(
            'idMozo' => $idMozo,
            'idGenPedido' => $idGenPedido,
            'idMesa' => $idMesa,
            'idTab' => $idTab,
            'idEstadoPedido' => 5, //Abierto
            'idEstado' => 2, // 1: Cobrado -- 2: A cobrar -- 3: Vencido
        );
        $result = $this->db->insert('pedidos', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function get_pedido_tab_by_idGenPedido($idGenPedido) {
        $this->db->select('pt.idTab, pt.descripcion as descripcionTab, p.nombre,p.direccion,p.telefono,p.observacion,p.horarioEntrega ');
        $this->db->from('pedidos as p');
        $this->db->join('pedidos_tabs as pt', 'p.idTab = pt.idTab');
        $this->db->where('p.idGenPedido', $idGenPedido);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_productos_pedido_by_group($idGenPedido) {
        $this->db->select('pedidos_detalle.id,
                           pedidos_detalle.numeroTicket,
                           pedidos_detalle.idPedido, 
                           SUM(pedidos_detalle.cantidad) AS cantidad, 
                           pedidos_detalle.precio,
                           pedidos_detalle.descuento,
                           SUM(pedidos_detalle.subTotal) as subtotal,
                           pedidos_detalle.iva, 
                           pedidos_detalle.idEstadoDetalle ,
                           pedidos_detalle.eliminado, 
                           productos.nombre, 
                           productos.idProducto, 
                           productos.idGenProducto, 
                           productos.idTipoProducto, 
                           productos.stock');
        $this->db->from('pedidos_detalle');
        $this->db->join('productos', 'pedidos_detalle.idGenProducto = productos.idGenProducto');
        $this->db->where('pedidos_detalle.idPedido', $idGenPedido);
        $this->db->where('pedidos_detalle.eliminado', 0);
        $this->db->group_by("pedidos_detalle.idGenProducto");
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_sub_productos_pedido_by_group($idGenPedido) {
        $this->db->select('pedidos_detalle.id,
                           pedidos_detalle.numeroTicket,
                           pedidos_detalle.idPedido, 
                           SUM(pedidos_detalle.cantidad) AS cantidad, 
                           pedidos_detalle.precio,
                           pedidos_detalle.descuento,
                           SUM(pedidos_detalle.subTotal) as subtotal,
                           pedidos_detalle.iva, 
                           pedidos_detalle.idEstadoDetalle ,
                           pedidos_detalle.eliminado, 
                           productos.stock, 
                           productos.idTipoProducto, 
                           productos_sub.idSubProducto as idProducto, 
                           productos_sub.nombre, 
                           productos_sub.idGenSubProducto as idGenProducto');
        $this->db->from('pedidos_detalle');
        $this->db->join('productos_sub', 'pedidos_detalle.idGenProducto = productos_sub.idGenSubProducto');
        $this->db->join('productos', 'productos.idGenProducto = productos_sub.idGenProducto');
        $this->db->where('pedidos_detalle.idPedido', $idGenPedido);
        $this->db->where('pedidos_detalle.eliminado', 0);
        $this->db->group_by("pedidos_detalle.idGenProducto");
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_pedidosByIdPedido($idPedido) {
        $this->db->select('
                pedidos.id as id,
                pedidos.idGenPedido as idGenPedido,
                pedidos.cantidadPersonas as cantidadPersonasReales,
                pedidos.idMozo as idMozo,
                pedidos.idMesa as idMesa,
                pedidos.total as total,
                SUM(pedidos_detalle.subTotal) AS totalDetalle,
                pedidos.idEstadoPedido,
                usuarios.nombreCompleto as nombre,
                usuarios.apellido as apellido
            ');
        $this->db->from('pedidos');
        $this->db->join('usuarios', 'pedidos.idMozo = usuarios.idUsuario');
        $this->db->join('pedidos_detalle', 'pedidos.idGenPedido = pedidos_detalle.idPedido', 'left');
        $this->db->where('pedidos.idGenPedido', $idPedido);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_productos_destacados() {
        $this->db->select('                        
                        p.idProducto as idProducto, 
                        p.idGenProducto as idGenProducto, 
                        p.nombre as nombre,
                        p.stock as stock, 
                        p.precioCompra as precioCompra,              
                        p.precioVenta as precioVenta,
                        p.idTipoProducto,
                        p.codigo,
                        p.idCategoriaProducto,
                        pd.cantidad,
                    ');
//        $this->db->select_max('pd.idGenProducto');
        $this->db->select_sum('pd.cantidad');
        $this->db->from('pedidos_detalle as pd');
        $this->db->join('productos as p', 'pd.idGenProducto = p.idGenProducto');
        $this->db->group_by("pd.idGenProducto");
        $this->db->order_by('pd.cantidad', 'DESC');
        $this->db->limit(3);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_sub_productos_destacados() {
        $this->db->select('                        
                        p.stock as stock,
                        p.idTipoProducto,
                        p.idCategoriaProducto,
                        p.codigo,
                        pd.cantidad,
                        ps.idSubProducto as idSubProducto, 
                        ps.idGenSubProducto as idGenProducto, 
                        ps.idSubProducto as idProducto, 
                        ps.nombre as nombre,
                        ps.precioCompra as precioCompra,              
                        ps.precioVenta as precioVenta,
                    ');
//        $this->db->select_max('pd.idGenProducto');
        $this->db->select_sum('pd.cantidad');
        $this->db->from('pedidos_detalle as pd');
        $this->db->join('productos_sub as  ps', 'pd.idGenProducto = ps.idGenSubProducto');
        $this->db->join('productos as p', 'p.idGenProducto = ps.idGenProducto');
        $this->db->group_by("pd.idGenProducto");
        $this->db->order_by('pd.cantidad', 'DESC');
        $this->db->limit(3);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_mesa_byIdGenPedido($idGenPedido) {
        $this->db->where('idPedido', $idGenPedido);
        $this->db->from('mesas');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_venta_check_by_idGenPedido($idGenPedido) {
        $this->db->where('idGenPedido', $idGenPedido);
        $result = $this->db->get('ingresos');

        return ($result->num_rows() > 0) ? true : false;
    }

    public function update_datos_delivery($idGenPedido, $values) {
        $this->db->where('idGenPedido', $idGenPedido);
        $result = $this->db->update('pedidos', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function get_pedidos_by_estados_y_tab_group_nroTicket_idGenPedido($idGenPedido) {
        $this->db->select('
                p.id as idPedido,
                p.idTab as idTab,
                p.idCadete as idCadete,
                p.nombre as nombreCliente,
                p.direccion as direccionCli,
                p.telefono as telefonoCli,
                p.observacion as observacionCli,
                p.horarioEntrega as horarioEntrega,
                p.idGenPedido as idGenPedido,
                p.idMozo as idMozo,
                p.fechaAlta as fechaAlta,
                p.idEstado as idEstado,
                p.idEstadoPedido as idEstadoPedido,
                pd.idEstadoDetalle as idEstadoDetalle,
                pd.nroPedido as nroPedido,
                pd.id as idDetallePedido,
                pd.numeroTicket as numeroTicket,
                pd.fechaModif,
                cad.nombre as nombreCad,
                cad.celular as celularCad,
                usuarios.nombreCompleto as nombreCompleto,
                m.descripcion as nombreMesa,
                pe.estado as estado
                ');
        $this->db->join('pedidos_detalle as pd', 'p.idGenPedido = pd.idPedido');
        $this->db->join('usuarios', 'p.idMozo = usuarios.idUsuario');
        $this->db->join('mesas as m', 'p.idMesa = m.id', 'left');
        $this->db->join('pedidos_estado as pe', 'pe.idEstado = pd.idEstadoDetalle');
        $this->db->join('cadetes as cad', 'p.idCadete = cad.idCadete', "left");
        $this->db->where('p.idGenPedido', $idGenPedido);
        $this->db->where('p.eliminado', 0);
        $this->db->group_by('pd.numeroTicket');
//        $this->db->limit(1);
        $this->db->order_by('pd.fechaModif', 'DESC');
        $result = $this->db->get('pedidos as p');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_productos_pedido_by_numero_pedido($idGenPedido) {
        $this->db->select('
                productos.idGenProducto,
                productos.idCategoriaProducto,
                productos.nombre,
                productos.codigo,
                productos.stock,
                productos.precioVenta,
                productos.idIvaVta,
                productos.precioCompra,
                productos.idIvaCompra,
                productos.eliminado,
                pedidos_detalle.precio,
                pedidos_detalle.numeroTicket,
                pedidos_detalle.comentario,
                pedidos_detalle.cantidad');
        $this->db->from('pedidos_detalle');
        $this->db->join('productos', 'pedidos_detalle.idGenProducto = productos.idGenProducto');
        $this->db->where('pedidos_detalle.idPedido', $idGenPedido);
        $this->db->where('pedidos_detalle.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_sub_productos_pedido_by_numero_pedido($idGenPedido) {
        $this->db->select('
                productos_sub.idGenSubProducto as idGenProducto,
                productos_sub.nombre,
                productos_sub.codigo,
                productos.stock,
                productos_sub.precioVenta,
                productos_sub.idIvaVta,
                productos_sub.precioCompra,
                productos_sub.idIvaCompra,
                productos_sub.eliminado,
                pedidos_detalle.precio,
                pedidos_detalle.numeroTicket,
                pedidos_detalle.cantidad');
        $this->db->from('pedidos_detalle');
        $this->db->join('productos_sub', 'pedidos_detalle.idGenProducto = productos_sub.idGenSubProducto');
        $this->db->join('productos', 'productos.idGenProducto = productos_sub.idGenProducto');
        $this->db->where('pedidos_detalle.idPedido', $idGenPedido);
        $this->db->where('pedidos_detalle.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_pedido_detalle_by_idGenPedido($idGenPedido) {
        $this->db->where('idPedido', $idGenPedido);
        $result = $this->db->get('pedidos_detalle');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function asignar_datos_delivery_by_idGenPedido($idGenPedido, $values) {
        $this->db->where('idGenPedido', $idGenPedido);
        $result = $this->db->update('pedidos', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function get_last_nroPedido() {
        $this->db->select('id,nroPedido,reset');
        $this->db->order_by('pedidos_detalle.id', 'DESC');
        $this->db->limit(1);
        $result = $this->db->get('pedidos_detalle');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_cantidad_producto_en_pedido($idGenPedido, $idGenProducto) {
        $this->db->select_sum('cantidad');
        $this->db->where('idPedido', $idGenPedido);
        $this->db->where('idGenProducto', $idGenProducto);
        $result = $this->db->get('pedidos_detalle');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function insert_pedido_detalle($values) {

        $result = $this->db->insert('pedidos_detalle', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function get_cantidad_producto_ticket_a_eliminar($idGenPedido, $idGenProducto) {
        $this->db->select('SUM(cantidad) as cantidad, numeroTicket,idGenProducto,precio,idTipoProducto');
        $this->db->where('idPedido', $idGenPedido);
        $this->db->where('idGenProducto', $idGenProducto);
        $this->db->group_by("numeroTicket");
        $result = $this->db->get('pedidos_detalle');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function check_seteada_venta($idGenPedido) {
        $this->db->where('idGenPedido', $idGenPedido);
        $result = $this->db->get('ingresos');
        return ($result->num_rows() > 0) ? true : false;
    }

    public function get_productos_pedido_detalle($idGenPedido) {
        $this->db->select('
                            p.idProducto,
                            p.idGenProducto,
                            p.nombre,
                            p.stock,
                            p.idTipoProducto,
                            sum(pd.cantidad) as cantidad,
                            pd.precio,
                            pd.idPedido,
                            pd.subTotal,
                            it.valorIva,
                            it.descripcion,
                        ');
        $this->db->from('pedidos_detalle as pd');
        $this->db->join('productos as p', 'pd.idGenProducto = p.idGenProducto');
        $this->db->join('iva_tipos as it', 'p.idIvaVta = it.idIva');
        $this->db->where('pd.idPedido', $idGenPedido);
        $this->db->where('pd.eliminado', 0);
        $this->db->group_by("pd.idGenProducto");
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_sub_productos_pedido_detalle($idGenPedido) {
        $this->db->select('
                            ps.idGenSubProducto as idGenProducto,
                            ps.idSubProducto as idProducto,
                            ps.nombre,
                            p.stock,
                            p.idTipoProducto,
                            pd.idPedido,
                            sum(pd.cantidad) as cantidad,
                            pd.precio,
                            pd.subTotal,
                            it.valorIva,
                            it.descripcion,
                        ');
        $this->db->from('pedidos_detalle as pd');
        $this->db->join('productos_sub as ps', 'pd.idGenProducto = ps.idGenSubProducto');
        $this->db->join('productos as p', 'ps.idGenProducto = p.idGenProducto');
        $this->db->join('iva_tipos as it', 'p.idIvaVta = it.idIva');
        $this->db->where('pd.idPedido', $idGenPedido);
        $this->db->where('pd.eliminado', 0);
        $this->db->group_by("pd.idGenProducto");
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function cerrar_mesa_pedido_transaccion($idGenPedido, $idMesa, $idTab, $idEstado) {
        $this->db->trans_begin();

        $values = array(
            'idEstadoPedido' => 8,
            'idEstado' => $idEstado
        );
        $this->db->where('idGenPedido', $idGenPedido);
        $result = $this->db->update('pedidos', $values);

        $result1 = ($this->db->affected_rows() > 0) ? true : false;
        //Si es mostrador no hace update de la mesa, con cualquiera de las otras secciones si
        if ($idTab == 1) {
            $values = array(
                'idPedido' => 0,
                'idEstadoMesa' => 1
            );
            $this->db->where('id', $idMesa);
            $result = $this->db->update('mesas', $values);

            $result2 = ($this->db->affected_rows() > 0) ? true : false;
        } else if ($idTab == 2 || $idTab == 3) {
            $result2 = true;
        } else {
            $result2 = false;
        }

        if (!$result1 || !$result2) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function update_pedido_by_idGenPedido_nroTicket($idGenPedido, $numeroTicket, $idEstado) {
        $values = array(
            'idEstadoDetalle' => $idEstado
        );

        $this->db->where('idPedido', $idGenPedido);
        $this->db->where('numeroTicket', $numeroTicket);
        $result = $this->db->update('pedidos_detalle', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function get_pedidos_by_estados_y_tab_group_nroTicket($idTab, $idEstadoPedidoDetalle) {
        $this->db->select('
                p.id as idPedido,
                p.idTab as idTab,
                p.idCadete as idCadete,
                p.nombre as nombreCliente,
                p.direccion as direccionCli,
                p.telefono as telefonoCli,
                p.observacion as observacionCli,
                p.horarioEntrega as horarioEntrega,
                p.idGenPedido as idGenPedido,
                p.idMozo as idMozo,
                p.fechaAlta as fechaAlta,
                p.idEstado as idEstado,
                p.idEstadoPedido as idEstadoPedido,
                pd.idEstadoDetalle as idEstadoDetalle,
                pd.nroPedido as nroPedido,
                pd.id as idDetallePedido,
                pd.numeroTicket as numeroTicket,
                pd.fechaModif,
                cad.nombre as nombreCad,
                cad.celular as celularCad,
                usuarios.nombreCompleto as nombreCompleto,
                m.descripcion as nombreMesa,
                pe.estado as estado
                ');
        $this->db->join('pedidos_detalle as pd', 'p.idGenPedido = pd.idPedido');
        $this->db->join('usuarios', 'p.idMozo = usuarios.idUsuario');
        $this->db->join('mesas as m', 'p.idMesa = m.id', 'left');
        $this->db->join('pedidos_estado as pe', 'pe.idEstado = pd.idEstadoDetalle');
        $this->db->join('cadetes as cad', 'p.idCadete = cad.idCadete', "left");
        $this->db->where('pd.idEstadoDetalle', $idEstadoPedidoDetalle);
        if ($idTab != 4) {
            $this->db->where('p.idTab', $idTab);
        }
        $this->db->where('p.eliminado', 0);
        $this->db->group_by('pd.numeroTicket');
//        $this->db->limit(1);
        $this->db->order_by('pd.fechaModif', 'DESC');
        $result = $this->db->get('pedidos as p');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_productos_pedido_by_numero_ticket($idGenPedido, $numeroTicket) {
        $this->db->select('p.nombre,pd.cantidad,pd.idGenProducto, pd.idTipoProducto, pd.comentario');
        $this->db->from('pedidos_detalle as pd');
        $this->db->join('productos as p', 'pd.idGenProducto = p.idGenProducto');
        $this->db->where('pd.idPedido', $idGenPedido);
        $this->db->where('pd.numeroTicket', $numeroTicket);
        $this->db->where('pd.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_sub_productos_pedido_by_numero_ticket($idGenPedido, $numeroTicket) {
        $this->db->select('ps.nombre,pd.cantidad,pd.idGenProducto, pd.idTipoProducto, pd.comentario');
        $this->db->from('pedidos_detalle as pd');
        $this->db->join('productos_sub as ps', 'pd.idGenProducto = ps.idGenSubProducto');
        $this->db->where('pd.idPedido', $idGenPedido);
        $this->db->where('pd.numeroTicket', $numeroTicket);
        $this->db->where('pd.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_ultimo_pedido() {
        $this->db->select('pd.nroPedido,reset');
        $this->db->limit(1);
        $this->db->order_by('pd.id', 'DESC');
        $result = $this->db->get('pedidos_detalle as pd');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_pedido_by_idCadete($idCadete) {
        $this->db->where('idCadete', $idCadete);
        $result = $this->db->get('pedidos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_pedido_by_idGenPedido($idGenPedido) {
        $this->db->where('idGenPedido', $idGenPedido);
        $result = $this->db->get('pedidos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function update_pedido_detalle_by_idGenPedido($idGenPedido, $idEstado) {
        $values = array(
            'idEstadoDetalle' => $idEstado
        );

        $this->db->where('idPedido', $idGenPedido);
        $result = $this->db->update('pedidos_detalle', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function set_cadete($values) {
        $result = $this->db->insert('cadetes', $values);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function get_cadetes() {
        $this->db->where('eliminado', 0);
        $result = $this->db->get('cadetes');
        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_costos_envios() {
        $this->db->where('eliminado', 0);
        $result = $this->db->get('envios_costos');
        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function resetear_numeracion($idPedido) {
        $values = array(
            'reset' => 1
        );

        $this->db->where('id', $idPedido);
        $result = $this->db->update('pedidos_detalle', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function get_mesas_abiertas_byIdUsuario($idMozo) {
        $this->db->select('*');
        $this->db->from('mesas as m');
        $this->db->join('pedidos as p', 'p.idGenPedido = m.idPedido');
        $this->db->where('m.idEstadoMesa', 2);
        $this->db->where('p.idMozo', $idMozo);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_mesas_libres() {
        $this->db->select('
                mesas_estado.idEstadoMesa as idEstadoMesa, 
                mesas_estado.estadoMesa as estadoMesa, 
                mesas_estado.color as color, 
                mesas.id as id, mesas.descripcion as descripcion, 
                mesas.idGenMesa as idGenMesa,
                mesas.idPedido as idPedido
            ');
        $this->db->from('mesas');
        $this->db->join('mesas_estado', 'mesas.idEstadoMesa = mesas_estado.idEstadoMesa');
        $this->db->where('mesas.eliminado', 0);
        $this->db->where('mesas.idEstadoMesa', 1);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function cambiar_mesa_pedido_transaccion($idGenPedido, $idMesaNueva, $idMesa) {
        $this->db->trans_begin();

        $values = array(
            'idMesa' => $idMesaNueva
        );
        $this->db->where('idGenPedido', $idGenPedido);
        $result = $this->db->update('pedidos', $values);
        $result1 = ($this->db->affected_rows() > 0) ? true : false;

        $values = array(
            'idEstadoMesa' => 1,
            'idPedido' => 0
        );
        $this->db->where('id', $idMesa);
        $result = $this->db->update('mesas', $values);
        $result2 = ($this->db->affected_rows() > 0) ? true : false;

        $values = array(
            'idEstadoMesa' => 2,
            'idPedido' => $idGenPedido
        );
        $this->db->where('id', $idMesaNueva);
        $result = $this->db->update('mesas', $values);
        $result3 = ($this->db->affected_rows() > 0) ? true : false;

        if (!$result1 || !$result2 || !$result3) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function get_mozos() {
        $this->db->from('usuarios');
        $this->db->where('idNivel', 8);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function cambiar_mozo_by_idGenPedido($idGenPedido, $idMozoNuevo) {
        $values = array(
            'idMozo' => $idMozoNuevo
        );

        $this->db->where('idGenPedido', $idGenPedido);
        $result = $this->db->update('pedidos', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function compare_user_password_bar($user, $password) {
        $this->db->where('usuario', $user);
        $this->db->where('password', $password);

//        $this->db->where('idNivel', 7);
//        $this->db->or_where('idNivel', 8);
        $this->db->where('(idNivel = 7 OR idNivel = 8)');

        $this->db->where('eliminado', 0);
        $result = $this->db->get('usuarios');
        return ($result != '') ? $result->result_array() : false;
    }

    public function compare_pin_empleado($pin, $idGenComercio) {
        $this->db->where('password', $pin);
        $this->db->where('idGenComercio', $idGenComercio);
        $this->db->where('idNivel', 8);
//        $this->db->where('eliminado', 0);
        $result = $this->db->get('usuarios');
        return ($result != '') ? $result->result_array() : false;
    }

    public function update_status_empleado($status, $idUsuario) {
        $values = array(
            'status' => $status
        );

        $this->db->where('idUsuario', $idUsuario);
        $result = $this->db->update('usuarios', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function compare_pin_cocina($pin) {
        $this->db->where('password', $pin);
//        $this->db->where('idGenComercio', $idGenComercio);
        $this->db->where('idNivel', 9);
//        $this->db->where('eliminado', 0);
        $result = $this->db->get('usuarios');
        return ($result != '') ? $result->result_array() : false;
    }

}
