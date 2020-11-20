<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class App_model extends CI_Model
{
    public function get_title()
    {
        $this->db->where('nombre', 1);
        $result = $this->db->get('empresa');
        return $result->result_array();
    }

    public function get_totClientes()
    {
        $result = $this->db->get('clientes');
        return $result->num_rows;
    }

    public function get_totProveedores()
    {
        $result = $this->db->get('proveedores');
        return $result->num_rows;
    }

    public function get_totProductos()
    {
        $result = $this->db->get('productos');
        return $result->num_rows;
    }

    public function get_totUsuarios()
    {
        $result = $this->db->get('usuarios');
        return $result->num_rows;
    }

    public function get_regIDs_all()
    {
        $this->db->where('token != ', '');
        $result = $this->db->get('socios_app');

        return ($result != '') ? $result->result_array() : false;
    }

    public function get_categorias()
    {
        $this->db->order_by('descripcion', 'ASC');
        $result = $this->db->get('categorias');

        return (($result->num_rows() > 0) ? $result->result_array() : false);
    }

    public function get_categoria_by_idCategoria($idCategoria)
    {
        $this->db->where('idCategoria', $idCategoria);
        $result = $this->db->get('categorias');

        return (($result->num_rows() > 0) ? $result->result_array() : false);
    }

    public function get_idCategoria_by_descrcipcion($descripcionCategoriaAgregar)
    {
        $this->db->where('descripcion', $descripcionCategoriaAgregar);
        $result = $this->db->get('categorias');

        return (($result->num_rows() > 0) ? $result->result_array() : false);
    }

    public function insert_categoria($descripcionCategoriaAgregar)
    {
        $values = array(
            'descripcion' => $descripcionCategoriaAgregar
        );
        $result = $this->db->insert('categorias', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function get_usuario_byId($idUsuario)
    {
        $this->db->select('
            idUsuario,
            usuarios.idNivel as idNivel,
            nivel as nombreNivel,
            usuarios.idProvincia,
            usuarios.idLocalidad,
            provincia,
            localidad,
            imgPerfil,
            nombreCompleto,
            apellido,
            usuario,
            password,
            usuarios.eliminado,
            email,
            telefono
        ');
        $this->db->from('usuarios');
        $this->db->join('niveles', 'niveles.idNivel = usuarios.idNivel');
        $this->db->join('provincias', 'provincias.idProvincia = usuarios.idProvincia');
        $this->db->join('localidades', 'localidades.idLocalidad = usuarios.idLocalidad');
        $this->db->where('usuarios.eliminado', 0);
        $this->db->where('usuarios.idUsuario', $idUsuario);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function delete_usuario_by_idUsuario($idUsuario)
    {
        $values = array(
            'eliminado' => 1
        );

        $this->db->where('idUsuario', $idUsuario);
        $result = $this->db->update('usuarios', $values);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function get_id_usuarioMenuAdmin($id)
    {
        $this->db->select('idUsuarioMenuAdmin');
        $this->db->from('usuario_menu_admin');
        $this->db->where('idUsuario', $id);
        $this->db->limit(1);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function delete_usuarioMenuAdmin($id)
    {
        $this->db->delete('usuario_menu_admin', array('idUsuario' => $id));
        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function update_usuario($id, $provincia, $localidad, $nombre, $apellido, $nombreUsuario, $password, $nivel, $email, $telefono)
    {
        $values = array(
            'idNivel' => $nivel,
            'idProvincia' => $provincia,
            'idLocalidad' => $localidad,
            'nombreCompleto' => $nombre,
            'apellido' => $apellido,
            'usuario' => $nombreUsuario,
            'password' => $password,
            'email' => $email,
            'telefono' => $telefono,
            'eliminado' => 0
        );
        $this->db->where('idUsuario', $id);
        $result = $this->db->update('usuarios', $values);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function update_usuario_perfil($id, $nombreImg)
    {
        $values = array(
            'idUsuario' => $id,
            'imgPerfil' => $nombreImg,
            'eliminado' => 0
        );
        $this->db->where('idUsuario', $id);
        $result = $this->db->update('usuarios', $values);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function add_menu_usuario($id, $menu)
    {
        $values = array(
            'idUsuario' => $id,
            'idMenu' => $menu
        );
        $result = $this->db->insert('usuario_menu_admin', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function get_idGeneradoUsuarioMenuAdmin($idGeneradoUsuarioMenuAdmin)
    {
        $this->db->select('idUsuario');
        $this->db->from('usuarios');
        $this->db->where('idGeneradoUsuarioMenuAdmin', $idGeneradoUsuarioMenuAdmin);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function add_usuario($provincia, $localidad, $nombre, $apellido, $nombreUsuario, $password, $nivel, $email, $telefono, $idGeneradoUsuarioMenuAdmin)
    {
        $values = array(
            'idProvincia' => $provincia,
            'idLocalidad' => $localidad,
            'email' => $email,
            'telefono' => $telefono,
            'nombreCompleto' => $nombre,
            'apellido' => $apellido,
            'usuario' => $nombreUsuario,
            'password' => $password,
            'idNivel' => $nivel,
            'idGeneradoUsuarioMenuAdmin' => $idGeneradoUsuarioMenuAdmin,
            'eliminado' => 0
        );
        $result = $this->db->insert('usuarios', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function get_usuarios()
    {
        $this->db->select('
            idUsuario,
            usuarios.idNivel as idNivel,
            nivel as nombreNivel,
            idProvincia,
            idLocalidad,
            imgPerfil,
            nombreCompleto,
            apellido,
            usuario,
            password,
            usuarios.eliminado,
            email,
            turno,
            telefono
        ');
        $this->db->from('usuarios');
        $this->db->join('niveles', 'niveles.idNivel = usuarios.idNivel');
        $this->db->where('usuarios.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_idNivel_byUser($idNivel)
    {
        $this->db->select('idGenMenuNivel');
        $this->db->from('menu_nivel');
        $this->db->where('menu_nivel.idNivel', $idNivel);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_menu_byIdNivel($idNivelGen)
    {
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->where('menu.eliminado', 0);
        $this->db->where('menu.idNivelGen', $idNivelGen);
        $this->db->order_by('posicion', 'DESC');

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_menuAdmin()
    {
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->where('menu.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_niveles()
    {
        $this->db->select('*');
        $this->db->from('niveles');
        $this->db->where('eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_tipoInterna()
    {
        $this->db->select('*');
        $this->db->from('tipo_interna');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_menuNivel($idNivelGen)
    {
        $this->db->select('
            niveles.nivel as nombreNivel,
            niveles.idNivel,
            menu_nivel.idGenMenuNivel
        ');
        $this->db->from('menu_nivel');
        $this->db->join('niveles', 'niveles.idNivel = menu_nivel.idNivel');

        $this->db->where('menu_nivel.idGenMenuNivel', $idNivelGen);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_menuAdmin_byId($idMenu)
    {
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->where('menu.eliminado', 0);
        $this->db->where('menu.idMenu', $idMenu);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function add_menuAdmin($nombre, $posicion, $icono, $link, $idNivel, $color, $usuarioAdmin, $tipoInterna, $subItem)
    {
        $values = array(
            'nombre' => $nombre,
            'posicion' => $posicion,
            'icono' => $icono,
            'link' => $link,
            'color' => $color,
            'idNivelGen' => $idNivel,
            'idUsuarioAdmin' => $usuarioAdmin,
            'idTipoInterna' => $tipoInterna,
            'idSubItem' => $subItem
        );
        $result = $this->db->insert('menu', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function actualizar_menuAdmin($idMenuAdmin, $idNivelGen, $nombre, $color, $link, $posicion, $icono, $usuarioAdmin, $tipoInterna, $subItem)
    {
        $values = array(
            'nombre' => $nombre,
            'icono' => $icono,
            'color' => $color,
            'link' => $link,
            'idNivelGen' => $idNivelGen,
            'posicion' => $posicion,
            'idUsuarioAdmin' => $usuarioAdmin,
            'idTipoInterna' => $tipoInterna,
            'idSubItem' => $subItem
        );
        $this->db->where('idMenu', $idMenuAdmin);
        $result = $this->db->update('menu', $values);


        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function delete_nivel_byIdMenuGen($idMenuGen)
    {
        $this->db->delete('menu_nivel', array('idGenMenuNivel' => $idMenuGen));
        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function add_menuNivel($idNivel, $nivel)
    {
        $values = array(
            'idGenMenuNivel' => $idNivel,
            'idNivel' => $nivel
        );
        $result = $this->db->insert('menu_nivel', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function delete_menuAdmin($idMenuAdmin)
    {
        $values = array(
            'eliminado' => 1
        );
        $this->db->where('idMenu', $idMenuAdmin);
        $result = $this->db->update('menu', $values);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function insert_tag($idCategoria, $tag)
    {
        $values = array(
            'idCategoria' => $idCategoria,
            'descripcion' => $tag
        );
        $result = $this->db->insert('tags_categorias', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function actualiza_categoria($idCategoria, $descripcionCategoria)
    {
        $values = array(
            'descripcion' => $descripcionCategoria
        );
        $this->db->where('idCategoria', $idCategoria);
        $result = $this->db->update('categorias', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Actualiza el stock del producto
     * @param type $idProducto
     * @param type $cantidad
     * @return type
     */
    public function update_stock_by_idProducto($idProducto, $cantidad)
    {
        $values = array(
            'stock' => $cantidad
        );
        $this->db->where('idProducto', $idProducto);
        $result = $this->db->update('productos', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function update_estado_ingreso_by_idGenIngreso($idGenIngreso, $saldo, $saldado, $idEstado)
    {
        $values = array(
            'aCobrar' => $saldo,
            'saldado' => $saldado,
            'idEstado' => $idEstado
        );
        $this->db->where('idGenIngreso', $idGenIngreso);
        $result = $this->db->update('ingresos', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function update_estado_egreso_by_idGenEgreso($idGenEgreso, $saldo, $saldado, $idEstado)
    {
        $values = array(
            'aPagar' => $saldo,
            'saldado' => $saldado,
            'idEstado' => $idEstado
        );
        $this->db->where('idGenEgreso', $idGenEgreso);
        $result = $this->db->update('egresos', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Eliminar ingreso correspondiente al idGenIngreso
     * @param type $idGenIngreso
     * @return type
     */
    public function eliminar_ingreso_by_idGenIngreso($idGenIngreso)
    {
        $values = array(
            'eliminado' => 1
        );
        $this->db->where('idGenIngreso', $idGenIngreso);
        $result = $this->db->update('ingresos', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function eliminar_egreso_by_idGenEgreso($idGenEgreso)
    {
        $values = array(
            'eliminado' => 1
        );
        $this->db->where('idGenEgreso', $idGenEgreso);
        $result = $this->db->update('egresos', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function eliminar_gasto_idGasto($idGasto)
    {
        $values = array(
            'eliminado' => 1
        );
        $this->db->where('idGasto', $idGasto);
        $result = $this->db->update('gastos', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Eliminar el detalle del ingreso correspondiente al idGenIngreso
     * @param type $idGenIngreso
     * @return type
     */
    public function eliminar_ingreso_detalle_by_idGenIngreso($idGenIngreso)
    {
        $values = array(
            'eliminado' => 1
        );
        $this->db->where('idGenIngresoAbono', $idGenIngreso);
        $result = $this->db->update('ingresos_detalle', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function eliminar_caja_ingreso_by_idGenIngreso($idGenIngreso)
    {
        $this->db->delete('cajas_ingresos_egresos', array('idGenIngEgGasto' => $idGenIngreso));

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function eliminar_cuenta_corriente_by_idGenIngreso($idGenIngreso)
    {
        $values = array(
            'eliminado' => 1
        );
        $this->db->where('idGenIngreso', $idGenIngreso);
        $result = $this->db->update('clientes_cuenta_corriente', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function eliminar_egreso_detalle_by_idGenEgreso($idGenEgreso)
    {
        $values = array(
            'eliminado' => 1
        );
        $this->db->where('idGenEgreso', $idGenEgreso);
        $result = $this->db->update('egresos_detalle', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Eliminar el abono correspondiente al idGenAbono
     * @param type $idGenAbono
     * @return type
     */
    public function eliminar_abono_by_idGenAbono($idGenAbono)
    {
        $values = array(
            'eliminado' => 1
        );
        $this->db->where('idGenAbono', $idGenAbono);
        $result = $this->db->update('abonos', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Eliminacion de un abono correspondiente al idAbono
     * @param type $idAbono
     * @return type
     */
    public function eliminar_abono_by_idAbono($idAbono)
    {
        $values = array(
            'eliminado' => 1
        );
        $this->db->where('idAbono', $idAbono);
        $result = $this->db->update('abonos', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Cambiar el estado a pausado
     * @param type $idGenAbono
     * @return type
     */
    public function pausar_abono_by_idGenAbono($idGenAbono)
    {
        $values = array(
            'idEstado' => 3
        );
        $this->db->where('idGenAbono', $idGenAbono);
        $result = $this->db->update('abonos', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Cambiar el estado a terminado
     * @param type $idGenAbono
     * @return type
     */
    public function terminar_abono_by_idGenAbono($idGenAbono)
    {
        $values = array(
            'idEstado' => 2
        );
        $this->db->where('idGenAbono', $idGenAbono);
        $result = $this->db->update('abonos', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Cambiar el estado a activado
     * @param type $idGenAbono
     * @return type
     */
    public function activar_abono_by_idGenAbono($idGenAbono)
    {
        $values = array(
            'idEstado' => 1
        );
        $this->db->where('idGenAbono', $idGenAbono);
        $result = $this->db->update('abonos', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function eliminar_ingreso_abono_by_idGenIngreso($idGenIngreso)
    {
        $values = array(
            'eliminado' => 1
        );
        $this->db->where('idGenIngresoAbono', $idGenIngreso);
        $result = $this->db->update('ingresos_detalle', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function eliminar_categoria($idCategoria)
    {
        $this->db->delete('categorias', array('idCategoria' => $idCategoria));

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function elimina_ingreso_cta_cte($idGenIngreso)
    {
        $this->db->delete('clientes_cuenta_corriente', array('idGenIngreso' => $idGenIngreso));

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function eliminar_tags_categoria($idCategoria)
    {
        $this->db->delete('tags_categorias', array('idCategoria' => $idCategoria));

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function eliminar_tag($idCategoria)
    {
        $this->db->delete('tags_categorias', array('idCategoria' => $idCategoria));

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function get_tags($query)
    {
        $this->db->like('descripcion', $query);
        $result = $this->db->get('tags', 10);
        return $result->result();
    }

    public function get_idTag_by_descripcion($value)
    {
        $this->db->where('descripcion', $value);
        $result = $this->db->get('tags');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function insert_palabra_clave_tag_entrada($idTag, $idComercio)
    {
        $values = array(
            'idTag' => $idTag,
            'idComercio' => $idComercio
        );
        $result = $this->db->insert('comercios_tags', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function insert_palabra_clave($value)
    {
        $values = array(
            'descripcion' => $value
        );
        $result = $this->db->insert('tags', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function get_paises()
    {
        $this->db->select('*');
        $this->db->from('paises');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_provincias()
    {
        $this->db->select('*');
        $this->db->from('provincias');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_localidades()
    {
        $this->db->select('*');
        $this->db->from('localidades');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_menuNivel_by_idNivel($idNivel)
    {
        $this->db->select('idGenMenuNivel');
        $this->db->from('menu_nivel');
        $this->db->where('menu_nivel.idNivel', $idNivel);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_menuAdmin_by_Nivel($idGenMenuNivel)
    {
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->where('menu.idNivelGen', $idGenMenuNivel);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_localidades_by_provincia($idProvincia)
    {
        $this->db->where('idProvincia', $idProvincia);
        $result = $this->db->get('localidades');

        return $result->result_array();
    }

    public function get_subcategorias_ventas_detalle_by_idCategoriaVentaDetalle($idCategoriaVentaDetalle)
    {
        $this->db->where('IdCategoriaVentaDetalle', $idCategoriaVentaDetalle);
        $this->db->order_by('idSubcategoriaVenta', 'ASC');
        $result = $this->db->get('categorias_subcategorias_venta_detalle');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_subcategorias_ventas_detalle_by_idSubCategoriaVenta($idSubCategoriaVenta)
    {
        $this->db->where('idSubcategoriaVenta', $idSubCategoriaVenta);
        $this->db->order_by('idSubcategoriaVenta', 'ASC');
        $result = $this->db->get('categorias_subcategorias_venta_detalle');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_subcategorias_ventas_detalle()
    {
        $result = $this->db->get('categorias_subcategorias_venta_detalle');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_subcategorias_compras_detalle_by_idCategoriaCompra($idCategoriaCompra)
    {
        $this->db->where('idCategoriaCompra', $idCategoriaCompra);
        $result = $this->db->get('categorias_subcategorias_compra_detalle');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_subcategorias_gastos_by_idCategoriaGasto($idCatGasto)
    {
        $this->db->where('idCategoriaGasto', $idCatGasto);
        $this->db->order_by('idCategoriaGasto', 'ASC');
        $result = $this->db->get('gastos_subcategorias');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_subcategorias_gastos_by_idSubCategoriaGasto($idSubCatGasto)
    {
        $this->db->where('idSubCatGasto', $idSubCatGasto);
        $this->db->order_by('idSubCatGasto', 'ASC');
        $result = $this->db->get('gastos_subcategorias');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function set_log_usuario($idUser, $nombreUser, $idNivel)
    {
        $values = array(
            'idUsuarioLog' => $idUser,
            'usuarioLog' => $nombreUser,
            'idNivel' => $idNivel
        );

        $result = $this->db->insert('session_logs', $values);
    }

    public function set_historico(
        $idUsuario,
        $idAccion,
        $tipoAccion,
        $tipoOperacion,
        $detalle,
        $total
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

    public function get_historico()
    {
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

    public function get_ultimos_usuarios()
    {
        $this->db->select('*');
        $this->db->from('session_logs');
        $this->db->where('idUsuarioLog !=', 1);
        $this->db->order_by('fechaIngresoLog', 'DESC');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_ultimos_productos()
    {
        $this->db->select('                        
                        productos.idProducto as idProducto, 
                        productos.idGenProducto as idGenProducto, 
                        productos.nombre as nombre,
                        productos.fechaAlta as fechaAlta,
                        productos_img.nombreImg as nombreImg,
                    ');
        $this->db->join('productos_img', 'productos_img.idGenProducto = productos.idGenProducto', 'left');
        $this->db->order_by('productos.fechaAlta', 'DESC');
        $this->db->from('productos');
        $result = $this->db->get();
        return $result->result_array();
    }

    //    public function get_usuarios() {
    //        $this->db->select('*');
    //        $this->db->from('usuarios');
    //        $result = $this->db->get();
    //
    //        return ($result->num_rows() > 0) ? $result->result_array() : false;
    //    }

    public function get_tesoreria_tipo_cuenta()
    {
        $this->db->select('*');
        $this->db->from('tesoreria_tipo_cuenta');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_movimientos_caja_by_fecha($fechaDesde, $fechaHasta, $selectMedioCajaFiltro)
    {
        $this->db->where('fechaAlta >=', $fechaDesde);
        $this->db->where('fechaAlta <=', $fechaHasta);
        $this->db->where('idCuenta', $selectMedioCajaFiltro);
        $result = $this->db->get('cajas_ingresos_egresos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_movimientos_caja_ultimo()
    {
        $this->db->where('cajas_ingresos_egresos.saldoActual !=', 0);
        $this->db->limit(1);
        $this->db->order_by('cajas_ingresos_egresos.idIngEgr', 'DESC');
        $result = $this->db->get('cajas_ingresos_egresos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_movimientos_caja_ultimo_by_fecha($fechaI, $fechaF)
    {
        $this->db->where('fechaAlta >=', $fechaI);
        $this->db->where('fechaAlta <=', $fechaF);
        $this->db->limit(1);
        $this->db->order_by('idIngEgr', 'DESC');
        $result = $this->db->get('cajas_ingresos_egresos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_movimientos_caja_by_fecha_actual($fecha)
    {
        $this->db->where('cajas_ingresos_egresos.saldoActual !=', 0);
        $this->db->where('cajas_ingresos_egresos.fechaAlta >=', $fecha);
        $this->db->limit(1);
        $this->db->order_by('cajas_ingresos_egresos.idIngEgr', 'ASC');
        $result = $this->db->get('cajas_ingresos_egresos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_primer_movimiento_caja_by_fecha($fechaI, $fechaF)
    {
        $this->db->where('cajas_ingresos_egresos.fechaAlta >=', $fechaI);
        $this->db->where('cajas_ingresos_egresos.fechaAlta <=', $fechaF);
        $this->db->limit(1);
        $this->db->order_by('cajas_ingresos_egresos.idIngEgr', 'ASC');
        $result = $this->db->get('cajas_ingresos_egresos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_tesoreria_cuentas_by_idTipoCuenta($idTipoCuenta)
    {
        $this->db->where('idTipoCuenta', $idTipoCuenta);
        $result = $this->db->get('tesoreria_cuentas');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_saldo_a_cobrar()
    {
        $this->db->from('tesoreria_tipo_cuenta as tc');

        $this->db->join('tesoreria_cuentas as c', 'c.idTipoCuenta = tc.idTipoCuenta');
        $this->db->where('tc.idTipoCuenta', 1);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_saldo_a_pagar()
    {
        $this->db->from('tesoreria_tipo_cuenta as tc');

        $this->db->join('tesoreria_cuentas as c', 'c.idTipoCuenta = tc.idTipoCuenta');
        $this->db->where('tc.idTipoCuenta', 2);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_saldo_disponible_cajas()
    {
        $this->db->from('tesoreria_tipo_cuenta as tc');

        $this->db->join('tesoreria_cuentas as c', 'c.idTipoCuenta = tc.idTipoCuenta');
        $this->db->where('tc.idTipoCuenta', 4);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_saldo_disponible_cajas_by_idCuenta($idCuenta)
    {
        $this->db->from('tesoreria_tipo_cuenta as tc');

        $this->db->join('tesoreria_cuentas as c', 'c.idTipoCuenta = tc.idTipoCuenta');
        $this->db->where('tc.idTipoCuenta', 4);
        $this->db->where('tc.idCuenta', $idCuenta);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_saldo_disponible_bancos()
    {
        $this->db->from('tesoreria_tipo_cuenta as tc');

        $this->db->join('tesoreria_cuentas as c', 'c.idTipoCuenta = tc.idTipoCuenta');
        $this->db->where('tc.idTipoCuenta', 3);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_saldo_cta_cte_clientes()
    {
        $this->db->from('ingresos');
        $this->db->where('eliminado', 0);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_saldo_cta_cte_clientes_by_idTipoCuenta($idTipoCuenta)
    {
        $this->db->from('clientes_cuenta_corriente');

        $this->db->where('idMedioCobro', $idTipoCuenta);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_saldo_cta_cte_proveredores()
    {
        $this->db->from('egresos');

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_saldo_cta_cte_proveedores_by_idTipoCuenta($idTipoCuenta)
    {
        $this->db->from('proveedores_cuenta_corriente');

        $this->db->where('idMedioPago', $idTipoCuenta);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_gastos_pendientes()
    {
        $this->db->from('gastos');

        $this->db->where('idEstado', 1);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_estados()
    {
        $result = $this->db->get('estados_ingresos_egresos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de los gastos con sus join correspondientes
     * @return type
     */
    public function get_gastos()
    {
        $this->db->select('
                g.idGasto as idGasto, 
                g.idGenGasto as idGenGasto, 
                g.idEstado as idEstado, 
                ge.descripcion as estado, 
                g.fechaGasto as fechaGasto,
                gc.descripcion as categoria,
                gs.descripcion as subcategoria,
                g.montoGasto as montoGasto,
                g.fechaVtoGasto as fechaVtoGasto,
                g.descripcionGasto as descripcionGasto,
                tc.descripcion as medioPago,
                g.fechaAlta
            ');
        $this->db->from('gastos as g');
        $this->db->join('gastos_estados as ge', 'g.idEstado = ge.idEstado');
        $this->db->join('gastos_categorias as gc', 'g.idCategoria = gc.idCategoriaGasto');
        $this->db->join('gastos_subcategorias as gs', 'g.idSubCategoria = gs.idSubCatGasto');
        $this->db->join('tesoreria_cuentas as tc', 'g.idMedioPago = tc.idCuenta');
        $this->db->where('eliminado', 0);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de los gastos con sus join correspondientes perteneciente al idGenGasto
     * @param type $idGenGasto
     * @return type
     */
    public function get_gastos_by_idGenGasto($idGenGasto)
    {
        $this->db->select('
                g.idGasto as idGasto,  
                g.idGenGasto,
                g.idCategoria,
                g.idSubCategoria,
                g.montoGasto,
                g.descripcionGasto,
                g.idTipoFactura,
                g.idMedioPago,
                g.nombreImg,
                g.fechaGasto,
                g.fechaVtoGasto,
                g.fechaAlta,
                g.idEstado, 
                ge.descripcion as estado, 
                gc.descripcion as categoria,
                gs.descripcion as subcategoria,
                tc.descripcion as medioPago,
            ');
        $this->db->from('gastos as g');
        $this->db->join('gastos_estados as ge', 'g.idEstado = ge.idEstado');
        $this->db->join('gastos_categorias as gc', 'g.idCategoria = gc.idCategoriaGasto');
        $this->db->join('gastos_subcategorias as gs', 'g.idSubCategoria = gs.idSubCatGasto');
        $this->db->join('tesoreria_cuentas as tc', 'g.idMedioPago = tc.idCuenta');
        $this->db->where('g.eliminado', 0);
        $this->db->where('g.idGenGasto', $idGenGasto);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtenemos el gatos que pertenece al id
     */
    public function get_gastos_by_idGasto($idGasto)
    {
        $this->db->select('
                g.idGasto as idGasto,  
                g.idGenGasto,
                g.idCategoria,
                g.idSubCategoria,
                g.montoGasto,
                g.descripcionGasto,
                g.idTipoFactura,
                g.idMedioPago,
                g.nombreImg,
                g.fechaGasto,
                g.fechaVtoGasto,
                g.fechaAlta,
                g.idEstado, 
                ge.descripcion as estado, 
                gc.descripcion as categoria,
                gs.descripcion as subcategoria,
                tc.descripcion as medioPago,
            ');
        $this->db->from('gastos as g');
        $this->db->where('g.idGasto', $idGasto);
        $this->db->join('gastos_estados as ge', 'g.idEstado = ge.idEstado');
        $this->db->join('gastos_categorias as gc', 'g.idCategoria = gc.idCategoriaGasto');
        $this->db->join('gastos_subcategorias as gs', 'g.idSubCategoria = gs.idSubCatGasto');
        $this->db->join('tesoreria_cuentas as tc', 'g.idMedioPago = tc.idCuenta');

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtenemos el gatos que pertenece al id
     */
    public function get_gastos_by_idSubCategoriaGasto($idSubCatGasto)
    {
        $this->db->from('gastos as g');
        $this->db->where('g.idSubCategoria', $idSubCatGasto);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_gastos_by_idCategoriaGasto($idCatGasto)
    {
        $this->db->from('gastos as g');
        $this->db->where('g.idCategoria', $idCatGasto);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * obtencion de los gastos con sus correspondientes datos e inner join donde se necesite con el filtro desde hasta con respecto a la fechaEmision
     * @return type
     */
    public function get_gastos_desde_hasta($desde, $hasta)
    {
        $this->db->select('
                g.idGasto as idGasto,  
                g.idGenGasto,
                g.idCategoria,
                g.idEstado,
                g.idSubCategoria,
                g.montoGasto,
                g.descripcionGasto,
                g.idTipoFactura,
                g.idMedioPago,
                g.fechaGasto,
                g.fechaVtoGasto,
                g.fechaAlta,
                ge.descripcion as estado, 
                gc.descripcion as categoria,
                gs.descripcion as subcategoria,
                tc.descripcion as medioPago,
            ');
        $this->db->from('gastos as g');
        $this->db->join('gastos_estados as ge', 'g.idEstado = ge.idEstado');
        $this->db->join('gastos_categorias as gc', 'g.idCategoria = gc.idCategoriaGasto');
        $this->db->join('gastos_subcategorias as gs', 'g.idSubCategoria = gs.idSubCatGasto');
        $this->db->join('tesoreria_cuentas as tc', 'g.idMedioPago = tc.idCuenta');
        $this->db->where('g.fechaGasto >=', $desde);
        $this->db->where('g.fechaGasto <=', $hasta);
        $this->db->where('g.eliminado', 0);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de todos los gastos para la exportacion
     * @return type
     */
    public function get_gastos_exportar()
    {
        //--- cabeceras ---//
        $fields[0]['name'] = 'Estado';
        $fields[1]['name'] = 'Emisión';
        $fields[2]['name'] = 'Categoria';
        $fields[3]['name'] = 'Subcategoria';
        $fields[4]['name'] = 'Monto';
        $fields[5]['name'] = 'Descripcion';
        $fields[6]['name'] = 'Medio Pago';
        $fields[7]['name'] = 'Fecha Alta';

        $this->db->select('
                ge.descripcion as estado, 
                g.fechaGasto,
                gc.descripcion as categoria,
                gs.descripcion as subcategoria,
                g.montoGasto,
                g.descripcionGasto,
                tc.descripcion as medioPago,
                g.fechaAlta
            ');
        $this->db->from('gastos as g');
        $this->db->join('gastos_estados as ge', 'g.idEstado = ge.idEstado');
        $this->db->join('gastos_categorias as gc', 'g.idCategoria = gc.idCategoriaGasto');
        $this->db->join('gastos_subcategorias as gs', 'g.idSubCategoria = gs.idSubCatGasto');
        $this->db->join('tesoreria_cuentas as tc', 'g.idMedioPago = tc.idCuenta');
        $this->db->where('g.eliminado', 0);
        $result = $this->db->get();

        return ($result != '') ? array("fields" => $fields, "query" => $result) : false;
    }

    /**
     * obtencion de los gastos con sus correspondientes datos e inner join donde se necesite para la exportacion de datos filtrando la fecha desde hasta
     * @return type
     */
    public function get_gastos_desde_hasta_exportar($desde, $hasta)
    {
        //--- cabeceras ---//
        $fields[0]['name'] = 'Estado';
        $fields[1]['name'] = 'Emisión';
        $fields[2]['name'] = 'Categoria';
        $fields[3]['name'] = 'Subcategoria';
        $fields[4]['name'] = 'Monto';
        $fields[5]['name'] = 'Descripcion';
        $fields[6]['name'] = 'Medio Pago';
        $fields[7]['name'] = 'Fecha Alta';

        $this->db->select('
                ge.descripcion as estado, 
                g.fechaGasto,
                gc.descripcion as categoria,
                gs.descripcion as subcategoria,
                g.montoGasto,
                g.descripcionGasto,
                tc.descripcion as medioPago,
                g.fechaAlta
            ');
        $this->db->from('gastos as g');
        $this->db->join('gastos_estados as ge', 'g.idEstado = ge.idEstado');
        $this->db->join('gastos_categorias as gc', 'g.idCategoria = gc.idCategoriaGasto');
        $this->db->join('gastos_subcategorias as gs', 'g.idSubCategoria = gs.idSubCatGasto');
        $this->db->join('tesoreria_cuentas as tc', 'g.idMedioPago = tc.idCuenta');
        $this->db->where('g.fechaGasto >=', $desde);
        $this->db->where('g.fechaGasto <=', $hasta);
        $this->db->where('g.eliminado', 0);

        $result = $this->db->get();

        return ($result != '') ? array("fields" => $fields, "query" => $result) : false;
    }

    /**
     * Obtencion de las cuentas de tesoreria
     * @return type
     */
    public function get_tesoreria_cuentas()
    {
        $result = $this->db->get('tesoreria_cuentas');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     *
     * @param type $idUsuario
     * @return type
     */
    public function get_tesoreria_cuentas_by_idUsuario($idUsuario)
    {
        $this->db->where('idUsuario', $idUsuario);
        $result = $this->db->get('tesoreria_cuentas');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencio de las categorias de los gastos
     * @return type
     */
    public function get_gastos_categorias()
    {
        $result = $this->db->get('gastos_categorias');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     *
     * @return \typeObtencion
     * @return typeObtencion de categorias generales
     */
    public function get_gastos_categorias_general()
    {
        $result = $this->db->get('categorias_gastos_general');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_gastos_subcategorias()
    {
        $result = $this->db->get('gastos_subcategorias');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_estados_abonos()
    {
        $result = $this->db->get('estados_abonos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * obtenemos el ingreso correspondiente al idIngreso pasado por parametro y este ingreso con todos sus join correspondientes
     * @param type $idIngreso
     * @return type
     */
    public function get_ingreso_by_idIngreso($idIngreso)
    {
        $this->db->select('
            i.idIngreso, 
            i.idGenIngreso, 
            i.idTipoIngreso,
            i.idCategoria, 
            i.fechaEmision, 
            i.fechaVtoCobro, 
            i.tipoFactura, 
            i.descuentoGral, 
            i.descuentoTotal,
            i.descuentoCliente,
            i.importeNetoNoGravado, 
            i.ivaTotal, 
            i.subTotalSinDescuento, 
            i.subTotalConDescuento, 
            i.total,
            i.aCobrar,
            i.saldado,
            i.idSubcategoriaVenta,
            i.idCategoria,
            i.idRazonSocial,
            i.notaCliente,
            i.notaInterna,
            i.fechaInicioServicio,
            i.fechaFinServicio,
            i.idEstado,
            i.fechaAlta,
            c.nombEmpresa as nombEmpresa,
            c.idCliente as idCliente,
            u.nombreCompleto as nombreVend,
            u.apellido as apellidoVend,
            u.idUsuario as idUsuarioVend
        ');
        $this->db->from('ingresos as i');
        $this->db->join('clientes as c', 'c.idCliente = i.idCliente');
        $this->db->join('usuarios as u', 'u.idUsuario = i.idVendedor');
        $this->db->where('i.eliminado', 0);
        $this->db->where('idIngreso', $idIngreso);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * obtenemos el ingreso correspondiente al idGenPresupuesto pasado por parametro y este ingreso con todos sus join correspondientes
     * @param type $idGenPresupuesto
     * @return type
     */
    public function get_ingreso_by_idGenPresupuesto($idGenPresupuesto)
    {
        $this->db->select('
            i.idGenIngreso
        ');
        $this->db->from('ingresos as i');
        $this->db->where('i.eliminado', 0);
        $this->db->where('i.idGenPresupuesto', $idGenPresupuesto);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtener el ingreso
     * @param type $idGenAbono
     * @return type
     */
    public function get_ingreso_by_idGenAbono($idGenAbono)
    {
        $this->db->select('
                i.idIngreso, 
                i.idGenIngreso, 
                i.idTipoIngreso,
                i.idCategoria, 
                i.fechaEmision, 
                i.fechaVtoCobro, 
                i.tipoFactura, 
                i.descuentoGral, 
                i.descuentoTotal,
                i.importeNetoNoGravado, 
                i.ivaTotal, 
                i.subTotalSinDescuento, 
                i.subTotalConDescuento, 
                i.total,
                i.aCobrar,
                i.saldado,
                i.notaCliente,
                i.notaInterna,
                i.idEstado,
                i.fechaAlta,
                cv.descripcion as categoria,
                c.nombEmpresa as nombEmpresa,
                c.idCliente as idCliente,
                u.nombreCompleto as nombreVend,
                u.apellido as apellidoVend,
                u.idUsuario as idUsuarioVend
            ');
        $this->db->from('ingresos as i');
        $this->db->join('clientes as c', 'c.idCliente = i.idCliente');
        $this->db->join('usuarios as u', 'u.idUsuario = i.idVendedor');
        $this->db->join('categorias_ventas as cv', 'cv.idCategoriaVentas = i.idCategoria');
        $this->db->where('i.eliminado', 0);
        $this->db->where('i.idGenAbono', $idGenAbono);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion del ingreso correspondiente al idGenAbono sin sus join correspondientes
     * @param type $idGenAbono
     * @return type
     */
    public function get_ingreso_idGenAbono($idGenAbono)
    {
        $this->db->select('
                i.idIngreso, 
                i.idGenIngreso, 
                i.idTipoIngreso,
                i.idCategoria, 
                i.fechaEmision, 
                i.fechaVtoCobro, 
                i.tipoFactura, 
                i.descuentoGral, 
                i.descuentoTotal,
                i.importeNetoNoGravado, 
                i.ivaTotal, 
                i.subTotalSinDescuento, 
                i.subTotalConDescuento, 
                i.total,
                i.aCobrar,
                i.saldado,
                i.notaCliente,
                i.notaInterna,
                i.idEstado,
                i.fechaAlta,
                c.nombEmpresa,
            ');
        $this->db->from('ingresos as i');
        $this->db->join('clientes as c', 'c.idCliente = i.idCliente');
        $this->db->where('i.eliminado', 0);
        $this->db->where('i.idGenAbono', $idGenAbono);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de un egreso segun corresponda al idEgreso pasado
     * @param type $idEgreso
     * @return type
     */
    public function get_egreso_by_idEgreso($idEgreso)
    {
        $this->db->where('idEgreso', $idEgreso);
        $result = $this->db->get('egresos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de los egresos correspondientes al idProveedor pasado por parametro
     * @param type $idProveedor
     * @return type
     */
    public function get_egreso_by_ididProveedor($idProveedor)
    {
        $this->db->where('idProveedor', $idProveedor);
        $this->db->where('eliminado', 0);
        $result = $this->db->get('egresos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_egreso_by_idProveedor_idGenEgreso($idGenEgreso, $idProveedor)
    {
        $this->db->where('idGenEgreso', $idGenEgreso);
        $this->db->where('idProveedor', $idProveedor);
        $this->db->where('eliminado', 0);
        $result = $this->db->get('egresos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de los egresos correspondientes al idProveedor e idGenEgreso pasado por parametro
     * @param type $idGenEgreso
     * @param type $idProveedor
     * @return type
     */
    public function get_egreso_by_ididProveedor_idGenEgreso($idGenEgreso, $idProveedor)
    {
        $this->db->where('idGenEgreso', $idGenEgreso);
        $this->db->where('idProveedor', $idProveedor);
        $this->db->where('eliminado', 0);
        $result = $this->db->get('egresos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * obtencion de ingresos correspondiente al idCliente e idGenIngreso pasado por parametro
     * @param type $idCliente
     * @return type
     */
    public function get_ingreso_by_idCliente_idGenIngreso($idGenIngreso, $idCliente)
    {
        $this->db->where('idGenIngreso', $idGenIngreso);
        $this->db->where('idCliente', $idCliente);
        $this->db->where('eliminado', 0);
        $result = $this->db->get('ingresos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_ingreso_by_idCliente($idCliente)
    {
        $this->db->where('idCliente', $idCliente);
        $this->db->where('eliminado', 0);
        $result = $this->db->get('ingresos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion del ingreso correspondiente al idGenIngreso
     * @param type $idGenIngreso
     * @return type
     */
    public function get_ingreso_by_idGenIngreso($idGenIngreso)
    {
        $this->db->where('idGenIngreso', $idGenIngreso);
        $this->db->where('eliminado', 0);
        $result = $this->db->get('ingresos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtenemos los ingresos pertenecientes al id de Categoria
     *
     * @param [type] $idCategoria
     * @return void
     */
    public function get_ingreso_by_idCategoria($idCategoria)
    {
        $this->db->where('idCategoria', $idCategoria);
        $this->db->where('eliminado', 0);
        $result = $this->db->get('ingresos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtenemos los ingresos pertenecientes al id de la SubCategoria
     *
     * @param [type] $idCategoria
     * @return void
     */
    public function get_ingreso_by_idSubCategoria($idSubCategoria)
    {
        $this->db->where('idSubcategoriaVenta', $idSubCategoria);
        $this->db->where('eliminado', 0);
        $result = $this->db->get('ingresos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion del ingreso teniendo en cuento el igGenIngreso con todos los datos necesarios de los join
     * @param type $idGenIngreso
     * @return type
     */
    public function get_ingreso_clientes_by_idGenIngreso($idGenIngreso)
    {
        $this->db->select('
                i.idIngreso,
                i.idTipoIngreso,
                i.idCategoria, 
                i.fechaEmision, 
                i.fechaVtoCobro, 
                i.tipoFactura, 
                i.descuentoGral, 
                i.descuentoTotal,
                i.importeNetoNoGravado, 
                i.ivaTotal, 
                i.subTotalSinDescuento, 
                i.subTotalConDescuento, 
                i.total, 
                i.aCobrar, 
                i.saldado, 
                i.notaCliente, 
                i.notaInterna, 
                i.idEstado, 
                i.fechaAlta, 
                c.nombEmpresa as nombEmpresa, 
                c.nombre as nombreCliente, 
                c.apellido as apellidoCliente, 
                c.domicilio as domicilio, 
                c.numero as nro, 
                c.piso as piso, 
                c.dpto as dpto, 
                c.cel as cel, 
                cv.descripcion as categoria, 
                dt.descripcion as tipoDoc,
                cdf.cuit as cuit,
                cdf.razonSocial as razonSocial,
                cdf.domicilio as domicilioLegal,
                cdf.cel as celularLegal,
                ic.descripcion as condicionIva,
                c.nombEmpresa as nombEmpresa, 
                c.idCliente as idCliente,
                c.email,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                ft.descripcion as letraTipoFactura
            ');
        $this->db->from('ingresos as i');
        $this->db->join('clientes as c', 'c.idCliente = i.idCliente');
        $this->db->join('categorias_ventas as cv', 'cv.idCategoriaVentas = i.idCategoria');
        $this->db->join('clientes_detalle_facturacion as cdf', 'c.idGenCliente = cdf.idGenCliente');
        $this->db->join('iva_condiciones as ic', 'cdf.idCondIva = ic.idCondicionIva');
        $this->db->join('documentos_tipos as dt', 'dt.idTipoDocumento = cdf.idTipoDoc');
        $this->db->join('usuarios as u', 'u.idUsuario = i.idVendedor');
        $this->db->join('factura_tipos as ft', 'ft.idTipoFactura = i.tipoFactura');
        $this->db->where('i.eliminado', 0);
        $this->db->where('i.idGenIngreso', $idGenIngreso);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_ingreso_clientes_sindatosfacturacion_by_idGenIngreso($idGenIngreso)
    {
        $this->db->select('
                i.idIngreso,
                i.idTipoIngreso,
                i.idCategoria, 
                i.fechaEmision, 
                i.fechaVtoCobro, 
                i.tipoFactura, 
                i.descuentoGral, 
                i.descuentoTotal,
                i.importeNetoNoGravado, 
                i.ivaTotal, 
                i.subTotalSinDescuento, 
                i.subTotalConDescuento, 
                i.total, 
                i.aCobrar, 
                i.saldado, 
                i.notaCliente, 
                i.notaInterna, 
                i.idEstado, 
                i.fechaAlta, 
                c.nombEmpresa as nombEmpresa, 
                c.nombre as nombreCliente, 
                c.apellido as apellidoCliente, 
                c.domicilio as domicilio, 
                c.numero as nro, 
                c.piso as piso, 
                c.dpto as dpto, 
                c.cel as cel, 
                cv.descripcion as categoria, 
                c.nombEmpresa as nombEmpresa, 
                c.idCliente as idCliente,
                c.email,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                ft.descripcion as letraTipoFactura
            ');
        $this->db->from('ingresos as i');
        $this->db->join('clientes as c', 'c.idCliente = i.idCliente');
        $this->db->join('categorias_ventas as cv', 'cv.idCategoriaVentas = i.idCategoria');
        $this->db->join('usuarios as u', 'u.idUsuario = i.idVendedor');
        $this->db->join('factura_tipos as ft', 'ft.idTipoFactura = i.tipoFactura');
        $this->db->where('i.eliminado', 0);
        $this->db->where('i.idGenIngreso', $idGenIngreso);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion del ingreso teniendo en cuento el igGenIngreso con todos los datos necesarios de los join
     * @param type $idGenIngreso
     * @return type
     */
    public function get_presupuesto_clientes_by_idGenPresupuesto($idGenPresupuesto)
    {
        $this->db->select('
                p.idPresupuesto,
                p.idGenPresupuesto,
                p.idTipoPresupuesto,
                p.idCategoria, 
                p.idSubcategoriaPresupuesto, 
                p.fechaEmision, 
                p.fechaVtoPresupuesto,
                p.descuentoGral, 
                p.descuentoTotal,
                p.importeNetoNoGravado, 
                p.ivaTotal, 
                p.subTotalSinDescuento, 
                p.subTotalConDescuento, 
                p.total, 
                p.notaCliente, 
                p.notaInterna, 
                p.idEstado, 
                p.fechaAlta, 
                c.nombEmpresa as nombEmpresa, 
                c.nombre as nombreCliente, 
                c.apellido as apellidoCliente, 
                c.domicilio as domicilio, 
                c.numero as nro, 
                c.piso as piso, 
                c.dpto as dpto, 
                c.cel as cel, 
                cv.descripcion as categoria, 
                dt.descripcion as tipoDoc,
                cdf.cuit as cuit,
                cdf.razonSocial as razonSocial,
                c.nombEmpresa as nombEmpresa, 
                c.idCliente as idCliente,
                c.email as email,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend
            ');
        $this->db->from('presupuesto as p');
        $this->db->join('clientes as c', 'c.idCliente = p.idCliente');
        $this->db->join('categorias_ventas as cv', 'cv.idCategoriaVentas = p.idCategoria');
        $this->db->join('clientes_detalle_facturacion as cdf', 'c.idGenCliente = cdf.idGenCliente');
        $this->db->join('documentos_tipos as dt', 'dt.idTipoDocumento = cdf.idTipoDoc');
        $this->db->join('usuarios as u', 'u.idUsuario = p.idVendedor');
        $this->db->where('p.eliminado', 0);
        $this->db->where('p.idGenPresupuesto', $idGenPresupuesto);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Actualizacion de los montos del ingreso correspondiente al idGenIngreso
     * @param type $idIngreso
     * @param type $totalIngreso
     * @param type $descEfectuado
     * @param type $importeNoGravado
     * @return type
     */
    public function update_ingreso_monto_by_idGenIngreso($idIngreso, $totalIngreso, $descEfectuado, $importeNoGravado)
    {
        $values = array(
            'total' => $totalIngreso,
            'aCobrar' => $totalIngreso,
            'importeNetoNoGravado' => $importeNoGravado,
            'descuentoTotal' => $descEfectuado
        );
        $this->db->where('idGenIngreso', $idIngreso);
        $result = $this->db->update('ingresos', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Eliminar el detalle del ingreso correspondiente a los parametros pasados
     * @param type $idGenIngreso
     * @param type $idProducto
     * @return type
     */
    public function eliminar_ingreso_by_idGenIngreso_idProducto($idGenIngreso, $idProducto)
    {
        $values = array(
            'eliminado' => 1
        );
        $this->db->where('idGenIngresoAbono', $idGenIngreso);
        $this->db->where('idProducto', $idProducto);
        $result = $this->db->update('ingresos_detalle', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Eliminamos un registro del detalle de egresos/compras correspondiente al idGenEgreso y idProducto
     * @param type $idGenEgreso
     * @param type $idProducto
     * @return type
     */
    public function eliminar_egreso_by_idGenEgreso_idProducto($idGenEgreso, $idProducto)
    {
        $values = array(
            'eliminado' => 1
        );
        $this->db->where('idGenEgreso', $idGenEgreso);
        $this->db->where('idProducto', $idProducto);
        $result = $this->db->update('egresos_detalle', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Eliminar detalle de abono correspòndiente a los filtros pasados por parametros
     * @param type $idGenAbono
     * @param type $idProducto
     * @return type
     */
    public function eliminar_abono_by_idGenAbono_idProducto($idGenAbono, $idProducto)
    {
        $values = array(
            'eliminado' => 1
        );
        $this->db->where('idGenAbono', $idGenAbono);
        $this->db->where('idProducto', $idProducto);
        $result = $this->db->update('abonos_detalle', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function get_egreso_by_idGenEgreso($idGenEgreso)
    {
        $this->db->select('
            e.idEgreso, 
            e.idGenEgreso, 
            e.idTipoEgreso,
            e.idCategoriaGasto, 
            e.fechaEmision, 
            e.fechaVtoPago, 
            e.tipoFactura, 
            e.descuentoGral, 
            e.descuentoTotal,
            e.descuentoProveedor,
            e.importeNetoNoGravado, 
            e.ivaTotal,
            e.subTotalSinDescuento, 
            e.subTotalConDescuento, 
            e.total, 
            e.aPagar, 
            e.saldado, 
            e.notaInterna, 
            e.idRazonSocial, 
            e.idEstado, 
            e.fechaAlta, 
            rs.nombre as razonSocial,
            p.nombEmpresa as nombEmpresa,
            p.idProveedor as idProveedor,
            p.cel,
            p.domicilio,
            p.numero as nro,
            p.piso,
            p.dpto,
            u.nombreCompleto as nombreVend,
            u.apellido as apellidoVend,
            u.idUsuario as idUsuarioVend,
            cc.descripcion as categoriaGasto
        ');
        $this->db->from('egresos as e');
        $this->db->join('proveedores as p', 'p.idProveedor = e.idProveedor');
        $this->db->join('usuarios as u', 'u.idUsuario = e.idVendedor');
        $this->db->join('razon_social as rs', 'e.idRazonSocial = rs.idRazonSocial');
        $this->db->join('categorias_compras as cc', 'cc.idCategoriaCompras = e.idCategoriaGasto');
        $this->db->where('e.idGenEgreso', $idGenEgreso);
        $this->db->where('e.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de la caja correspondiente al idCuenta
     * @param type $idCuenta
     * @return type
     */
    public function get_caja_by_idCuenta($idCuenta)
    {
        $this->db->where('idCuenta', $idCuenta);
        $result = $this->db->get('tesoreria_cuentas');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion del punto de venta correspondiente al idPtoVenta
     * @param type $idPtoVenta
     * @return type
     */
    public function get_punto_by_idPtoVenta($idPtoVenta)
    {
        $this->db->where('idPtoVenta', $idPtoVenta);
        $result = $this->db->get('puntos_ventas');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_estado_cuenta_corriente()
    {
        $this->db->select('
                clientes_cuenta_corriente.idCuentaCorriente as idCuentaCorriente, 
                clientes_cuenta_corriente.idCliente as idCliente, 
                clientes_cuenta_corriente.idGenComprobante as idGenComprobante, 
                clientes_cuenta_corriente.idGenIngreso as idGenIngreso, 
                clientes_cuenta_corriente.debito as debito, 
                clientes_cuenta_corriente.credito as credito, 
                clientes_cuenta_corriente.nombPdf as nombPdf, 
                clientes_cuenta_corriente.idMedioCobro as idMedioCobro, 
                clientes_cuenta_corriente.saldo as saldo, 
                clientes_cuenta_corriente.descripcion as descripcion, 
                clientes_cuenta_corriente.fechaCobro as fechaCobro, 
                clientes_cuenta_corriente.fechaAlta as fechaAlta, 
                clientes_cuenta_corriente.eliminado as eliminado, 
                tesoreria_cuentas.descripcion as cuenta, 
                clientes.nombEmpresa as nombEmpresa, 
                ingresos.total as total,                 
                puntos_ventas.numeroPtoVta as numeroPtoVta,
        ');
        $this->db->join('tesoreria_cuentas', 'tesoreria_cuentas.idCuenta = clientes_cuenta_corriente.idMedioCobro');
        $this->db->join('puntos_ventas', 'puntos_ventas.idPtoVenta = tesoreria_cuentas.idPtoVenta');
        $this->db->join('ingresos', 'ingresos.idGenIngreso = clientes_cuenta_corriente.idGenIngreso');
        $this->db->join('clientes', 'clientes.idCliente = clientes_cuenta_corriente.idCliente');
        $result = $this->db->get('clientes_cuenta_corriente');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_estado_cuenta_corriente_by_idGenIngreso($idGenIngreso)
    {
        $this->db->select('
                clientes_cuenta_corriente.idCuentaCorriente as idCuentaCorriente, 
                clientes_cuenta_corriente.idCliente as idCliente, 
                clientes_cuenta_corriente.idGenIngreso as idGenIngreso, 
                clientes_cuenta_corriente.idGenComprobante as idGenComprobante,
                clientes_cuenta_corriente.debito as debito, 
                clientes_cuenta_corriente.credito as credito, 
                clientes_cuenta_corriente.nombPdf as nombPdf, 
                clientes_cuenta_corriente.idMedioCobro as idMedioCobro, 
                clientes_cuenta_corriente.saldo as saldo, 
                clientes_cuenta_corriente.descripcion as descripcion, 
                clientes_cuenta_corriente.fechaCobro as fechaCobro, 
                clientes_cuenta_corriente.fechaAlta as fechaAlta, 
                clientes_cuenta_corriente.eliminado as eliminado, 
                tesoreria_cuentas.descripcion as cuenta, 
                clientes.nombEmpresa as nombEmpresa, 
                ingresos.total as total,                 
                puntos_ventas.numeroPtoVta as numeroPtoVta,
        ');
        $this->db->join('tesoreria_cuentas', 'tesoreria_cuentas.idCuenta = clientes_cuenta_corriente.idMedioCobro');
        $this->db->join('puntos_ventas', 'puntos_ventas.idPtoVenta = tesoreria_cuentas.idPtoVenta');
        $this->db->join('ingresos', 'ingresos.idGenIngreso = clientes_cuenta_corriente.idGenIngreso');
        $this->db->join('clientes', 'clientes.idCliente = clientes_cuenta_corriente.idCliente');
        $this->db->where('clientes_cuenta_corriente.idGenIngreso', $idGenIngreso);
        $result = $this->db->get('clientes_cuenta_corriente');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de las cuentas corrientes de todos los clientes
     * @return type
     */
    public function get_estado_cuenta_corriente_total()
    {
        $this->db->select('
                clientes_cuenta_corriente.idCuentaCorriente as idCuentaCorriente, 
                clientes_cuenta_corriente.idCliente as idCliente, 
                clientes_cuenta_corriente.idGenIngreso as idGenIngreso, 
                clientes_cuenta_corriente.idGenComprobante as idGenComprobante,
                clientes_cuenta_corriente.debito as debito, 
                clientes_cuenta_corriente.credito as credito, 
                clientes_cuenta_corriente.nombPdf as nombPdf, 
                clientes_cuenta_corriente.idMedioCobro as idMedioCobro, 
                clientes_cuenta_corriente.saldo as saldo, 
                clientes_cuenta_corriente.descripcion as descripcion, 
                clientes_cuenta_corriente.fechaCobro as fechaCobro, 
                clientes_cuenta_corriente.fechaAlta as fechaAlta, 
                clientes_cuenta_corriente.eliminado as eliminado, 
                tesoreria_cuentas.descripcion as cuenta, 
                clientes.nombEmpresa as nombEmpresa, 
                ingresos.total as total,                 
                puntos_ventas.numeroPtoVta as numeroPtoVta,
        ');
        $this->db->where('clientes_cuenta_corriente.eliminado', 0);
        $this->db->join('tesoreria_cuentas', 'tesoreria_cuentas.idCuenta = clientes_cuenta_corriente.idMedioCobro');
        $this->db->join('puntos_ventas', 'puntos_ventas.idPtoVenta = tesoreria_cuentas.idPtoVenta');
        $this->db->join('ingresos', 'ingresos.idGenIngreso = clientes_cuenta_corriente.idGenIngreso');
        $this->db->join('clientes', 'clientes.idCliente = clientes_cuenta_corriente.idCliente');
        $result = $this->db->get('clientes_cuenta_corriente');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de las cuentas corrientes correspondientes al idCliente pasado por parametro
     * @return type
     */
    public function get_estado_cuenta_corriente_total_by_idCliente($idCliente)
    {
        $this->db->select('
                clientes_cuenta_corriente.idCuentaCorriente as idCuentaCorriente, 
                clientes_cuenta_corriente.idCliente as idCliente, 
                clientes_cuenta_corriente.idGenIngreso as idGenIngreso, 
                clientes_cuenta_corriente.idGenComprobante as idGenComprobante,
                clientes_cuenta_corriente.debito as debito, 
                clientes_cuenta_corriente.credito as credito, 
                clientes_cuenta_corriente.nombPdf as nombPdf, 
                clientes_cuenta_corriente.idMedioCobro as idMedioCobro, 
                clientes_cuenta_corriente.saldo as saldo, 
                clientes_cuenta_corriente.descripcion as descripcion, 
                clientes_cuenta_corriente.fechaCobro as fechaCobro, 
                clientes_cuenta_corriente.fechaAlta as fechaAlta, 
                clientes_cuenta_corriente.eliminado as eliminado, 
                tesoreria_cuentas.descripcion as cuenta, 
                clientes.nombEmpresa as nombEmpresa, 
                ingresos.total as total,                 
                puntos_ventas.numeroPtoVta as numeroPtoVta,
        ');
        $this->db->join('tesoreria_cuentas', 'tesoreria_cuentas.idCuenta = clientes_cuenta_corriente.idMedioCobro');
        $this->db->join('puntos_ventas', 'puntos_ventas.idPtoVenta = tesoreria_cuentas.idPtoVenta');
        $this->db->join('ingresos', 'ingresos.idGenIngreso = clientes_cuenta_corriente.idGenIngreso');
        $this->db->join('clientes', 'clientes.idCliente = clientes_cuenta_corriente.idCliente');
        $this->db->where('clientes_cuenta_corriente.idCliente', $idCliente);
        $this->db->where('clientes_cuenta_corriente.eliminado', 0);
        $result = $this->db->get('clientes_cuenta_corriente');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de las cuentas corrientes de los clientes segun correspondan al idCliente
     * @param type $idCliente
     * @return type
     */
    public function get_estado_cuenta_corriente_by_idCliente($idCliente)
    {
        $this->db->select('
                clientes_cuenta_corriente.idCuentaCorriente as idCuentaCorriente, 
                clientes_cuenta_corriente.idCliente as idCliente, 
                clientes_cuenta_corriente.idGenIngreso as idGenIngreso, 
                clientes_cuenta_corriente.idGenComprobante as idGenComprobante,
                clientes_cuenta_corriente.debito as debito, 
                clientes_cuenta_corriente.credito as credito, 
                clientes_cuenta_corriente.nombPdf as nombPdf, 
                clientes_cuenta_corriente.idMedioCobro as idMedioCobro, 
                clientes_cuenta_corriente.saldo as saldo, 
                clientes_cuenta_corriente.descripcion as descripcion, 
                clientes_cuenta_corriente.fechaCobro as fechaCobro, 
                clientes_cuenta_corriente.fechaAlta as fechaAlta, 
                clientes_cuenta_corriente.eliminado as eliminado, 
                tesoreria_cuentas.descripcion as cuenta, 
                clientes.nombEmpresa as nombEmpresa, 
                ingresos.total as total,                 
                puntos_ventas.numeroPtoVta as numeroPtoVta,
        ');
        $this->db->join('tesoreria_cuentas', 'tesoreria_cuentas.idCuenta = clientes_cuenta_corriente.idMedioCobro');
        $this->db->join('puntos_ventas', 'puntos_ventas.idPtoVenta = tesoreria_cuentas.idPtoVenta');
        $this->db->join('ingresos', 'ingresos.idGenIngreso = clientes_cuenta_corriente.idGenIngreso');
        $this->db->join('clientes', 'clientes.idCliente = clientes_cuenta_corriente.idCliente');
        $this->db->where('clientes_cuenta_corriente.idCliente', $idCliente);
        $this->db->where('clientes_cuenta_corriente.eliminado', 0);

        $result = $this->db->get('clientes_cuenta_corriente');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de las cuentas corrientes de los lcientes segun el rango de fecha pasado
     * @param type $desde
     * @param type $hasta
     * @return type
     */
    public function get_estado_cuenta_corriente_total_by_desde_hasta($desde, $hasta)
    {
        $this->db->select('
                clientes_cuenta_corriente.idCuentaCorriente as idCuentaCorriente, 
                clientes_cuenta_corriente.idCliente as idCliente, 
                clientes_cuenta_corriente.idGenIngreso as idGenIngreso, 
                clientes_cuenta_corriente.idGenComprobante as idGenComprobante,
                clientes_cuenta_corriente.debito as debito, 
                clientes_cuenta_corriente.credito as credito, 
                clientes_cuenta_corriente.nombPdf as nombPdf, 
                clientes_cuenta_corriente.idMedioCobro as idMedioCobro, 
                clientes_cuenta_corriente.saldo as saldo, 
                clientes_cuenta_corriente.descripcion as descripcion, 
                clientes_cuenta_corriente.fechaCobro as fechaCobro, 
                clientes_cuenta_corriente.fechaAlta as fechaAlta, 
                clientes_cuenta_corriente.eliminado as eliminado, 
                tesoreria_cuentas.descripcion as cuenta, 
                clientes.nombEmpresa as nombEmpresa, 
                ingresos.total as total,                 
                puntos_ventas.numeroPtoVta as numeroPtoVta,
        ');
        $this->db->join('tesoreria_cuentas', 'tesoreria_cuentas.idCuenta = clientes_cuenta_corriente.idMedioCobro');
        $this->db->join('puntos_ventas', 'puntos_ventas.idPtoVenta = tesoreria_cuentas.idPtoVenta');
        $this->db->join('ingresos', 'ingresos.idGenIngreso = clientes_cuenta_corriente.idGenIngreso');
        $this->db->join('clientes', 'clientes.idCliente = clientes_cuenta_corriente.idCliente');
        $this->db->where('clientes_cuenta_corriente.eliminado', 0);
        $this->db->where('clientes_cuenta_corriente.fechaCobro >=', $desde);
        $this->db->where('clientes_cuenta_corriente.fechaCobro <=', $hasta);
        $result = $this->db->get('clientes_cuenta_corriente');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_estado_cuenta_corriente_total_by_desde_hasta_idCliente($desde, $hasta, $idCliente)
    {
        $this->db->select('
                clientes_cuenta_corriente.idCuentaCorriente as idCuentaCorriente, 
                clientes_cuenta_corriente.idCliente as idCliente, 
                clientes_cuenta_corriente.idGenIngreso as idGenIngreso, 
                clientes_cuenta_corriente.idGenComprobante as idGenComprobante,
                clientes_cuenta_corriente.debito as debito, 
                clientes_cuenta_corriente.credito as credito, 
                clientes_cuenta_corriente.nombPdf as nombPdf, 
                clientes_cuenta_corriente.idMedioCobro as idMedioCobro, 
                clientes_cuenta_corriente.saldo as saldo, 
                clientes_cuenta_corriente.descripcion as descripcion, 
                clientes_cuenta_corriente.fechaCobro as fechaCobro, 
                clientes_cuenta_corriente.fechaAlta as fechaAlta, 
                clientes_cuenta_corriente.eliminado as eliminado, 
                tesoreria_cuentas.descripcion as cuenta, 
                clientes.nombEmpresa as nombEmpresa, 
                ingresos.total as total,                 
                puntos_ventas.numeroPtoVta as numeroPtoVta,
        ');
        $this->db->join('tesoreria_cuentas', 'tesoreria_cuentas.idCuenta = clientes_cuenta_corriente.idMedioCobro');
        $this->db->join('puntos_ventas', 'puntos_ventas.idPtoVenta = tesoreria_cuentas.idPtoVenta');
        $this->db->join('ingresos', 'ingresos.idGenIngreso = clientes_cuenta_corriente.idGenIngreso');
        $this->db->join('clientes', 'clientes.idCliente = clientes_cuenta_corriente.idCliente');
        $this->db->where('clientes_cuenta_corriente.eliminado', 0);
        $this->db->where('clientes_cuenta_corriente.fechaCobro >=', $desde);
        $this->db->where('clientes_cuenta_corriente.fechaCobro <=', $hasta);

        $this->db->where('clientes_cuenta_corriente.idCliente', $idCliente);
        $result = $this->db->get('clientes_cuenta_corriente');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    //    public function get_estado_cuenta_corriente_by_idCliente($idCliente){
    //        $this->db->select('
    //                clientes_cuenta_corriente.idCuentaCorriente as idCuentaCorriente,
    //                clientes_cuenta_corriente.idCliente as idCliente,
    //                clientes_cuenta_corriente.idGenComprobante as idGenComprobante,
    //                clientes_cuenta_corriente.idGenIngreso as idGenIngreso,
    //                clientes_cuenta_corriente.debito as debito,
    //                clientes_cuenta_corriente.credito as credito,
    //                clientes_cuenta_corriente.nombPdf as nombPdf,
    //                clientes_cuenta_corriente.idMedioCobro as idMedioCobro,
    //                clientes_cuenta_corriente.saldo as saldo,
    //                clientes_cuenta_corriente.descripcion as descripcion,
    //                clientes_cuenta_corriente.fechaCobro as fechaCobro,
    //                clientes_cuenta_corriente.fechaAlta as fechaAlta,
    //                clientes_cuenta_corriente.eliminado as eliminado,
    //                tesoreria_cuentas.descripcion as cuenta,
    //                clientes.nombEmpresa as nombEmpresa,
    //                ingresos.total as total,
    //                puntos_ventas.numeroPtoVta as numeroPtoVta,
    //        ');
    //        $this->db->join('tesoreria_cuentas', 'tesoreria_cuentas.idCuenta = clientes_cuenta_corriente.idMedioCobro');
    //        $this->db->join('puntos_ventas', 'puntos_ventas.idPtoVenta = tesoreria_cuentas.idPtoVenta');
    //        $this->db->join('ingresos', 'ingresos.idGenIngreso = clientes_cuenta_corriente.idGenIngreso');
    //        $this->db->join('clientes', 'clientes.idCliente = clientes_cuenta_corriente.idCliente');
    //        $this->db->where('clientes_cuenta_corriente.idCliente', $idCliente);
    //        $result = $this->db->get('clientes_cuenta_corriente');
    //
    //        return ($result->num_rows() > 0) ? $result->result_array() : false;
    //    }
    public function get_estado_cuenta_by_idGenIngreso($idGenIngreso)
    {
        $this->db->where('idGenIngreso', $idGenIngreso);
        $result = $this->db->get('clientes_cuenta_corriente');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_estado_cuenta_by_idGenIngreso_ncnd($idGenIngreso)
    {
        $this->db->select('
            clientes_cuenta_corriente.idCuentaCorriente, 
            clientes_cuenta_corriente.fechaCobro as fechaCobro, 
            clientes_cuenta_corriente.debito as debito, 
            clientes_cuenta_corriente.credito as credito, 
            clientes_cuenta_corriente.idMedioCobro, 
            clientes_cuenta_corriente.idGenComprobante, 
            clientes_cuenta_corriente.idCuentaCorriente, 
            clientes_cuenta_corriente.idGenIngreso, 
            ingresos.total as total,                 
            clientes_cuenta_corriente.saldo as saldo, 
            clientes_cuenta_corriente.descripcion as nota, 
            tesoreria_cuentas.descripcion as cuenta, 
        ');

        $this->db->where('clientes_cuenta_corriente.idGenIngreso', $idGenIngreso);
        $this->db->join('tesoreria_cuentas', 'tesoreria_cuentas.idCuenta = clientes_cuenta_corriente.idMedioCobro');
        $this->db->join('puntos_ventas', 'puntos_ventas.idPtoVenta = tesoreria_cuentas.idPtoVenta');
        $this->db->join('ingresos', 'ingresos.idGenIngreso = clientes_cuenta_corriente.idGenIngreso');
        $this->db->join('clientes', 'clientes.idCliente = clientes_cuenta_corriente.idCliente');
        $result = $this->db->get('clientes_cuenta_corriente');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de todos las cuentas corrientes para la exportacion de las mismas
     * @return type
     */
    public function get_cuentas_corrientes_cliente_exportar()
    {
        //--- cabeceras ---//
        $fields[1]['name'] = 'Emisión';
        $fields[2]['name'] = 'Cliente';
        $fields[3]['name'] = 'A Cobrar';
        $fields[4]['name'] = 'Cobrado';
        $fields[5]['name'] = 'Total';
        $fields[6]['name'] = 'Saldo';
        $fields[7]['name'] = 'Medio de Cobro';

        $this->db->select('
            clientes_cuenta_corriente.fechaCobro as fechaCobro, 
            clientes.nombEmpresa as nombEmpresa, 
            clientes_cuenta_corriente.debito as debito, 
            clientes_cuenta_corriente.credito as credito, 
            ingresos.total as total,                 
            clientes_cuenta_corriente.saldo as saldo, 
            tesoreria_cuentas.descripcion as cuenta, 
        ');
        $this->db->join('tesoreria_cuentas', 'tesoreria_cuentas.idCuenta = clientes_cuenta_corriente.idMedioCobro');
        $this->db->join('puntos_ventas', 'puntos_ventas.idPtoVenta = tesoreria_cuentas.idPtoVenta');
        $this->db->join('ingresos', 'ingresos.idGenIngreso = clientes_cuenta_corriente.idGenIngreso');
        $this->db->join('clientes', 'clientes.idCliente = clientes_cuenta_corriente.idCliente');
        $this->db->where('clientes_cuenta_corriente.eliminado', 0);
        $result = $this->db->get('clientes_cuenta_corriente');

        return ($result != '') ? array("fields" => $fields, "query" => $result) : false;
    }

    /**
     * Obtencion de todos las cuentas corrientes para la exportacion de las mismas
     * @return type
     */
    public function get_cuentas_corrientes_cliente_exportar_by_idCliente($idCliente)
    {
        //--- cabeceras ---//
        $fields[1]['name'] = 'Emisión';
        $fields[2]['name'] = 'Cliente';
        $fields[3]['name'] = 'A Cobrar';
        $fields[4]['name'] = 'Cobrado';
        $fields[5]['name'] = 'Total';
        $fields[6]['name'] = 'Saldo';
        $fields[7]['name'] = 'Medio de Cobro';

        $this->db->select('
            clientes_cuenta_corriente.fechaCobro as fechaCobro, 
            clientes.nombEmpresa as nombEmpresa, 
            clientes_cuenta_corriente.debito as debito, 
            clientes_cuenta_corriente.credito as credito, 
            ingresos.total as total,                 
            clientes_cuenta_corriente.saldo as saldo, 
            tesoreria_cuentas.descripcion as cuenta, 
        ');
        $this->db->join('tesoreria_cuentas', 'tesoreria_cuentas.idCuenta = clientes_cuenta_corriente.idMedioCobro');
        $this->db->join('puntos_ventas', 'puntos_ventas.idPtoVenta = tesoreria_cuentas.idPtoVenta');
        $this->db->join('ingresos', 'ingresos.idGenIngreso = clientes_cuenta_corriente.idGenIngreso');
        $this->db->join('clientes', 'clientes.idCliente = clientes_cuenta_corriente.idCliente');
        $this->db->where('clientes_cuenta_corriente.eliminado', 0);
        $this->db->where('clientes_cuenta_corriente.idCliente', $idCliente);
        $result = $this->db->get('clientes_cuenta_corriente');

        return ($result != '') ? array("fields" => $fields, "query" => $result) : false;
    }

    /**
     * Obtencion de todos las cuentas corrientes para la exportacion de las mismas
     * @return type
     */
    public function get_cuentas_corrientes_cliente_exportar_by_desde_hasta($desde, $hasta)
    {
        //--- cabeceras ---//
        $fields[1]['name'] = 'Emisión';
        $fields[2]['name'] = 'Cliente';
        $fields[3]['name'] = 'A Cobrar';
        $fields[4]['name'] = 'Cobrado';
        $fields[5]['name'] = 'Total';
        $fields[6]['name'] = 'Saldo';
        $fields[7]['name'] = 'Medio de Cobro';

        $this->db->select('
            clientes_cuenta_corriente.fechaCobro as fechaCobro, 
            clientes.nombEmpresa as nombEmpresa, 
            clientes_cuenta_corriente.debito as debito, 
            clientes_cuenta_corriente.credito as credito, 
            ingresos.total as total,                 
            clientes_cuenta_corriente.saldo as saldo, 
            tesoreria_cuentas.descripcion as cuenta, 
        ');
        $this->db->join('tesoreria_cuentas', 'tesoreria_cuentas.idCuenta = clientes_cuenta_corriente.idMedioCobro');
        $this->db->join('puntos_ventas', 'puntos_ventas.idPtoVenta = tesoreria_cuentas.idPtoVenta');
        $this->db->join('ingresos', 'ingresos.idGenIngreso = clientes_cuenta_corriente.idGenIngreso');
        $this->db->join('clientes', 'clientes.idCliente = clientes_cuenta_corriente.idCliente');
        $this->db->where('clientes_cuenta_corriente.fechaCobro >=', $desde);
        $this->db->where('clientes_cuenta_corriente.fechaCobro <=', $hasta);
        $this->db->where('clientes_cuenta_corriente.eliminado', 0);
        $result = $this->db->get('clientes_cuenta_corriente');

        return ($result != '') ? array("fields" => $fields, "query" => $result) : false;
    }

    /**
     * Obtencion de todos las cuentas corrientes para la exportacion de las mismas
     * @return type
     */
    public function get_cuentas_corrientes_cliente_exportar_by_desde_hasta_idCliente($desde, $hasta, $idCliente)
    {
        //--- cabeceras ---//
        $fields[1]['name'] = 'Emisión';
        $fields[2]['name'] = 'Cliente';
        $fields[3]['name'] = 'A Cobrar';
        $fields[4]['name'] = 'Cobrado';
        $fields[5]['name'] = 'Total';
        $fields[6]['name'] = 'Saldo';
        $fields[7]['name'] = 'Medio de Cobro';

        $this->db->select('
            clientes_cuenta_corriente.fechaCobro as fechaCobro, 
            clientes.nombEmpresa as nombEmpresa, 
            clientes_cuenta_corriente.debito as debito, 
            clientes_cuenta_corriente.credito as credito, 
            ingresos.total as total,                 
            clientes_cuenta_corriente.saldo as saldo, 
            tesoreria_cuentas.descripcion as cuenta, 
        ');
        $this->db->join('tesoreria_cuentas', 'tesoreria_cuentas.idCuenta = clientes_cuenta_corriente.idMedioCobro');
        $this->db->join('puntos_ventas', 'puntos_ventas.idPtoVenta = tesoreria_cuentas.idPtoVenta');
        $this->db->join('ingresos', 'ingresos.idGenIngreso = clientes_cuenta_corriente.idGenIngreso');
        $this->db->join('clientes', 'clientes.idCliente = clientes_cuenta_corriente.idCliente');
        $this->db->where('clientes_cuenta_corriente.eliminado', 0);
        $this->db->where('clientes_cuenta_corriente.fechaCobro >=', $desde);
        $this->db->where('clientes_cuenta_corriente.fechaCobro <=', $hasta);
        $this->db->where('clientes_cuenta_corriente.idCliente', $idCliente);
        $result = $this->db->get('clientes_cuenta_corriente');

        return ($result != '') ? array("fields" => $fields, "query" => $result) : false;
    }

    public function get_estado_cuenta_pdf_by_idGenIngreso($idGenIngreso)
    {
        $this->db->select('
                clientes_cuenta_corriente.idCuentaCorriente as idCuentaCorriente, 
                clientes_cuenta_corriente.idCliente as idCliente, 
                clientes_cuenta_corriente.idGenIngreso as idGenIngreso, 
                clientes_cuenta_corriente.idGenComprobante as idGenComprobante, 
                clientes_cuenta_corriente.debito as debito, 
                clientes_cuenta_corriente.credito as credito, 
                clientes_cuenta_corriente.nombPdf as nombPdf, 
                clientes_cuenta_corriente.idMedioCobro as idMedioCobro, 
                clientes_cuenta_corriente.saldo as saldo, 
                clientes_cuenta_corriente.descripcion as descripcion, 
                clientes_cuenta_corriente.fechaCobro as fechaCobro, 
                clientes_cuenta_corriente.fechaAlta as fechaAlta, 
                clientes_cuenta_corriente.eliminado as eliminado, 
                tesoreria_cuentas.descripcion as cuenta, 
                puntos_ventas.numeroPtoVta as numeroPtoVta,
        ');
        $this->db->where('idGenIngreso', $idGenIngreso);
        $this->db->join('tesoreria_cuentas', 'tesoreria_cuentas.idCuenta = clientes_cuenta_corriente.idMedioCobro', 'left');
        $this->db->join('puntos_ventas', 'puntos_ventas.idPtoVenta = tesoreria_cuentas.idPtoVenta', 'left');
        $this->db->limit(1);
        $this->db->order_by('clientes_cuenta_corriente.fechaAlta', 'DESC');
        $result = $this->db->get('clientes_cuenta_corriente');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_detalle_productos_by_idGenIngreso($idGenIngreso)
    {
        $this->db->select('p.nombre, p.descripcion');
        $this->db->join('ingresos_detalle as id', 'i.idGenIngreso=id.idGenIngresoAbono');
        $this->db->join('productos as p', 'id.idProducto=p.idProducto');
        $this->db->where('idGenIngreso', $idGenIngreso);
        $result = $this->db->get('ingresos as i');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_estado_cuenta_pdf_by_idGenEgreso($idGenEgreso)
    {
        $this->db->select('
                proveedores_cuenta_corriente.idCuentaCorriente as idCuentaCorriente, 
                proveedores_cuenta_corriente.idGenComprobante as idGenComprobante, 
                proveedores_cuenta_corriente.idProveedor as idProveedor, 
                proveedores_cuenta_corriente.idGenEgreso as idGenEgreso, 
                proveedores_cuenta_corriente.aPagar as aPagar, 
                proveedores_cuenta_corriente.pague as pague, 
                proveedores_cuenta_corriente.nombPdf as nombPdf, 
                proveedores_cuenta_corriente.idMedioPago as idMedioPago, 
                proveedores_cuenta_corriente.saldo as saldo, 
                proveedores_cuenta_corriente.descripcion as descripcion, 
                proveedores_cuenta_corriente.fechaPago as fechaPago, 
                proveedores_cuenta_corriente.fechaAlta as fechaAlta, 
                proveedores_cuenta_corriente.eliminado as eliminado, 
                tesoreria_cuentas.descripcion as cuenta, 
                puntos_ventas.numeroPtoVta as numeroPtoVta,
        ');
        $this->db->where('idGenEgreso', $idGenEgreso);
        $this->db->join('tesoreria_cuentas', 'tesoreria_cuentas.idCuenta = proveedores_cuenta_corriente.idMedioPago');
        $this->db->join('puntos_ventas', 'puntos_ventas.idPtoVenta = tesoreria_cuentas.idPtoVenta');
        $this->db->limit(1);
        $this->db->order_by('proveedores_cuenta_corriente.fechaAlta', 'DESC');
        $result = $this->db->get('proveedores_cuenta_corriente');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_estado_cuenta_by_idGenEgreso($idGenEgreso)
    {
        $this->db->where('idGenEgreso', $idGenEgreso);
        $result = $this->db->get('proveedores_cuenta_corriente');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_estado_caja_by_idCaja($selectCuentaSalida)
    {
        $this->db->where('idCuenta', $selectCuentaSalida);
        $result = $this->db->get('cajas_ingresos_egresos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtenemos los movimientos del gasto que pasamos por parametro
     */
    public function get_estado_caja_by_idGenGasto($idGenGasto)
    {
        $this->db->where('idGenIngEgGasto', $idGenGasto);
        $result = $this->db->get('cajas_ingresos_egresos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion detalle del egreso correspondiente al idGenEgreso
     * @param type $idGenEgreso
     * @return type
     */
    public function get_egreso_detalle_by_idGenEgreso($idGenEgreso)
    {
        $this->db->select('
            de.idDetalleEgreso, 
            de.cantidad, 
            de.precio,
            de.descuento, 
            de.subTotal, 
            de.fechaAlta,
            de.idProducto, 
            de.idIva, 
            de.ivaText, 
            de.eliminado, 
            p.codigo, 
            p.descripcion as nombre, 
            p.stock,
            it.valorIva as iva
        ');
        $this->db->from('egresos_detalle as de');
        $this->db->join('productos as p', 'p.idProducto = de.idProducto');
        $this->db->join('iva_tipos as it', 'it.valorIva = de.idIva');
        $this->db->where('de.idGenEgreso', $idGenEgreso);
        $this->db->where('de.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion del detalle del ingreso segun corresponda al idGenIngreso obtenido con los inner join necesarios
     * @param type $idGenIngreso
     * @return type
     */
    public function get_ingreso_detalle_by_idGenIngreso($idGenIngreso)
    {
        $this->db->select('
                di.idDetalleIngreso, 
                di.cantidad, 
                di.precio,
                di.descuento, 
                di.subTotal, 
                di.fechaAlta, 
                di.eliminado, 
                di.idProducto, 
                di.iva, 
                di.ivaText, 
                p.codigo, 
                p.descripcion as nombre, 
                p.stock 
            ');
        $this->db->from('ingresos_detalle as di');
        $this->db->join('productos as p', 'p.idProducto = di.idProducto');
        $this->db->where('di.idGenIngresoAbono', $idGenIngreso);
        $this->db->where('di.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion del detalle del ingreso segun corresponda al idGenIngreso obtenido con los inner join necesarios
     * @param type $idGenIngreso
     * @return type
     */
    public function get_presupuesto_detalle_by_idGenPresupuesto($idGenPresupuesto)
    {
        $this->db->select('
                dp.idDetallePresupuesto, 
                dp.cantidad, 
                dp.precio,
                dp.descuento, 
                dp.subTotal, 
                dp.fechaAlta, 
                dp.eliminado, 
                dp.idProducto, 
                dp.iva, 
                dp.ivaText, 
                p.codigo, 
                p.descripcion as nombre, 
                p.stock 
            ');
        $this->db->from('presupuesto_detalle as dp');
        $this->db->join('productos as p', 'p.idProducto = dp.idProducto');
        $this->db->where('dp.idGenPresupuesto', $idGenPresupuesto);
        $this->db->where('dp.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de los productos del presupuesto correspondiente al idGenPresupuesto
     * @param type $idGenPresupuesto
     * @return type
     */
    public function get_productos_presupuestos_by_idGenPresupuesto($idGenPresupuesto)
    {
        $this->db->select('
                presupuesto_detalle.idDetallePresupuesto,
                presupuesto_detalle.idGenPresupuesto, 
                presupuesto_detalle.idProducto as idGenProducto,
                presupuesto_detalle.precio,
                presupuesto_detalle.subTotal,
                presupuesto_detalle.descuento,
                presupuesto_detalle.cantidad,
                presupuesto_detalle.iva,
                productos.stock,
                productos.codigo,
                productos.nombre,
                productos.descripcion,
                productos.idProducto,
                presupuesto.total as totalPresupuesto,
                presupuesto.descuentoTotal as descEfectuado,
                presupuesto.importeNetoNoGravado as importeNoGravado
            ');
        $this->db->from('presupuesto_detalle');
        $this->db->join('productos', 'productos.idGenProducto = presupuesto_detalle.idProducto');
        $this->db->join('presupuesto', 'presupuesto.idGenPresupuesto = presupuesto_detalle.idGenPresupuesto');
        $this->db->where('presupuesto_detalle.idGenPresupuesto', $idGenPresupuesto);
        $this->db->where('presupuesto_detalle.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_detalle_abono_by_idGenAbono($idGenAbono)
    {
        $this->db->select('
                da.idDetalleAbono, 
                da.cantidad, 
                da.precio,
                da.descuento, 
                da.subTotal, 
                da.fechaAlta, 
                da.eliminado, 
                da.idProducto, 
                da.idGenAbono, 
                da.iva, 
                da.ivaText, 
                p.codigo as codigo, 
                p.descripcion as nombre, 
                p.stock, 
                a.idAbono 
            ');
        $this->db->from('abonos_detalle as da');
        $this->db->join('productos as p', 'p.idProducto = da.idProducto');
        $this->db->join('abonos as a', 'a.idGenAbono = da.idGenAbono');
        $this->db->where('da.idGenAbono', $idGenAbono);
        $this->db->where('da.eliminado', 0);
        $result = $this->db->get('');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * obtencion de los ingresos con sus correspondientes datos e inner join donde se necesite
     * @return type
     */
    public function get_ingresos()
    {
        $this->db->select('
                i.idIngreso, 
                i.idGenIngreso, 
                i.idTipoIngreso,
                i.idCategoria, 
                i.fechaEmision, 
                i.fechaVtoCobro, 
                i.tipoFactura, 
                i.descuentoGral, 
                i.descuentoTotal,
                i.importeNetoNoGravado, 
                i.ivaTotal, 
                i.subTotalSinDescuento, 
                i.subTotalConDescuento, 
                i.total, 
                i.aCobrar, 
                i.saldado, 
                i.notaCliente, 
                i.notaInterna, 
                i.idEstado, 
                i.fechaAlta, 
                c.nombEmpresa as nombEmpresa, 
                c.idCliente as idCliente,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend
            ');
        $this->db->from('ingresos as i');
        $this->db->join('clientes as c', 'c.idCliente = i.idCliente');
        $this->db->join('usuarios as u', 'u.idUsuario = i.idVendedor');
        $this->db->where('i.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de los ingresos con IVA
     * @return type
     */
    public function get_ingresos_con_iva()
    {
        $this->db->select('
                i.idIngreso, 
                i.idGenIngreso, 
                i.idTipoIngreso,
                i.idCategoria, 
                i.fechaEmision, 
                i.fechaVtoCobro, 
                i.tipoFactura, 
                i.descuentoGral, 
                i.descuentoTotal,
                i.importeNetoNoGravado, 
                i.ivaTotal, 
                i.subTotalSinDescuento, 
                i.subTotalConDescuento, 
                i.total, 
                i.aCobrar, 
                i.saldado, 
                i.notaCliente, 
                i.notaInterna, 
                i.idEstado, 
                i.fechaAlta, 
                f.nroFactura,
                c.nombEmpresa as nombEmpresa, 
                c.idCliente as idCliente,
                cdf.cuit as cuit,
                ic.descripcion as condicionIva,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend
            ');
        $this->db->from('ingresos as i');
        $this->db->join('facturas as f', 'f.idGenIngreso = i.idGenIngreso');
        $this->db->join('clientes as c', 'c.idCliente = i.idCliente');
        $this->db->join('clientes_detalle_facturacion as cdf', 'cdf.idGenCliente = c.idGenCliente');
        $this->db->join('iva_condiciones as ic', 'ic.idCondicionIva = cdf.idCondIva');
        $this->db->join('usuarios as u', 'u.idUsuario = i.idVendedor');
        $this->db->where('i.ivaTotal >', 0);
        $this->db->where('i.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de los ingresos con IVA
     * @return type
     */
    public function get_ingresos_con_iva_sin_join()
    {
        $this->db->select('
                i.idIngreso, 
                i.idGenIngreso, 
                i.idTipoIngreso,
                i.idCategoria, 
                i.fechaEmision, 
                i.fechaVtoCobro, 
                i.tipoFactura, 
                i.descuentoGral, 
                i.descuentoTotal,
                i.importeNetoNoGravado, 
                i.ivaTotal, 
                i.subTotalSinDescuento, 
                i.subTotalConDescuento, 
                i.total, 
                i.aCobrar, 
                i.saldado, 
                i.notaCliente, 
                i.notaInterna, 
                i.idEstado, 
                i.fechaAlta, 
                f.nroFactura,
                c.nombEmpresa as nombEmpresa, 
                c.idCliente as idCliente,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend
            ');
        $this->db->from('ingresos as i');
        $this->db->join('facturas as f', 'f.idGenIngreso = i.idGenIngreso');
        $this->db->join('clientes as c', 'c.idCliente = i.idCliente');
        $this->db->join('clientes_detalle_facturacion as cdf', 'cdf.idGenCliente = c.idGenCliente');
        $this->db->join('usuarios as u', 'u.idUsuario = i.idVendedor');
        $this->db->where('i.ivaTotal >', 0);
        $this->db->where('i.eliminado', 0);
        $this->db->where('cdf.cuit', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de los ingresos con IVA
     * @return type
     */
    public function get_ingresos_con_iva_by_rango_fechas($fechaIncio, $fechaFin)
    {
        $this->db->select('
                i.idIngreso, 
                i.idGenIngreso, 
                i.idTipoIngreso,
                i.idCategoria, 
                i.fechaEmision, 
                i.fechaVtoCobro, 
                i.tipoFactura, 
                i.descuentoGral, 
                i.descuentoTotal,
                i.importeNetoNoGravado, 
                i.ivaTotal, 
                i.subTotalSinDescuento, 
                i.subTotalConDescuento, 
                i.total, 
                i.aCobrar, 
                i.saldado, 
                i.notaCliente, 
                i.notaInterna, 
                i.idEstado, 
                i.fechaAlta, 
                f.nroFactura,
                c.nombEmpresa as nombEmpresa, 
                c.idCliente as idCliente,
                cdf.cuit as cuit,
                ic.descripcion as condicionIva,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend
            ');
        $this->db->from('ingresos as i');
        $this->db->join('facturas as f', 'f.idGenIngreso = i.idGenIngreso');
        $this->db->join('clientes as c', 'c.idCliente = i.idCliente');
        $this->db->join('clientes_detalle_facturacion as cdf', 'cdf.idGenCliente = c.idGenCliente');
        $this->db->join('iva_condiciones as ic', 'ic.idCondicionIva = cdf.idCondIva');
        $this->db->join('usuarios as u', 'u.idUsuario = i.idVendedor');
        $this->db->where('i.fechaAlta >=', $fechaIncio);
        $this->db->where('i.fechaAlta <=', $fechaFin);
        $this->db->where('i.ivaTotal >=', 1);
        $this->db->where('i.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtenemos los datos del ingreso que corresponde a la nota de debito
     * @param type $idNota
     * @return type
     */
    public function get_ingresos_nota_debito($idNota)
    {
        $this->db->select('
                i.idIngreso, 
                i.idGenIngreso, 
                i.idTipoIngreso,
                i.idCategoria, 
                i.fechaEmision, 
                i.fechaVtoCobro, 
                i.tipoFactura, 
                i.descuentoGral, 
                i.descuentoTotal,
                i.importeNetoNoGravado, 
                i.ivaTotal, 
                i.subTotalSinDescuento, 
                i.subTotalConDescuento, 
                i.total, 
                i.aCobrar, 
                i.saldado, 
                i.notaCliente, 
                i.notaInterna, 
                i.idEstado, 
                i.fechaAlta, 
                c.nombEmpresa as nombEmpresa, 
                c.idCliente as idCliente,
                c.nombre as nombreCliente,
                c.apellido as apellidoCliente,
                c.domicilio as domicilioCliente,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                cdf.cuit,
                cdf.domicilio as domicilioComercial,
                cdf.razonSocial,
                ic.descripcion as condicionIva
            ');
        $this->db->from('notas_debito as nd');
        $this->db->join('ingresos as i', 'nd.idGenIngreso = i.idGenIngreso');
        $this->db->join('clientes as c', 'c.idCliente = i.idCliente');
        $this->db->join('clientes_detalle_facturacion as cdf', 'c.idGenCliente = cdf.idGenCliente');
        $this->db->join('iva_condiciones as ic', 'cdf.idCondIva = ic.idCondicionIva');
        $this->db->join('usuarios as u', 'u.idUsuario = i.idVendedor');
        $this->db->where('i.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtenemos el ingreso al que pertenece la nota de credito que se pasa por parametro
     * @param type $idNota
     * @return type
     */
    public function get_ingresos_nota_credito($idNota)
    {
        $this->db->select('
                i.idIngreso, 
                i.idGenIngreso, 
                i.idTipoIngreso,
                i.idCategoria, 
                i.fechaEmision, 
                i.fechaVtoCobro, 
                i.tipoFactura, 
                i.descuentoGral, 
                i.descuentoTotal,
                i.importeNetoNoGravado, 
                i.ivaTotal, 
                i.subTotalSinDescuento, 
                i.subTotalConDescuento, 
                i.total, 
                i.aCobrar, 
                i.saldado, 
                i.notaCliente, 
                i.notaInterna, 
                i.idEstado, 
                i.fechaAlta, 
                c.nombEmpresa as nombEmpresa, 
                c.idCliente as idCliente,
                c.nombre as nombreCliente,
                c.apellido as apellidoCliente,
                c.domicilio as domicilioCliente,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                cdf.cuit,
                cdf.domicilio as domicilioComercial,
                cdf.razonSocial,
                ic.descripcion as condicionIva
            ');
        $this->db->from('notas_credito as nc');
        $this->db->join('ingresos as i', 'nc.idGenIngreso = i.idGenIngreso');
        $this->db->join('clientes as c', 'c.idCliente = i.idCliente');
        $this->db->join('clientes_detalle_facturacion as cdf', 'c.idGenCliente = cdf.idGenCliente');
        $this->db->join('iva_condiciones as ic', 'cdf.idCondIva = ic.idCondicionIva');
        $this->db->join('usuarios as u', 'u.idUsuario = i.idVendedor');
        $this->db->where('nc.idNotaCredito', $idNota);
        $this->db->where('i.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * obtencion de los ingresos correspondientes al idGenIngresos con sus correspondientes datos e inner join donde se necesite
     * @return type
     */
    public function get_ingresos_by_idGenIngresos($idGenIngreso)
    {
        $this->db->select('
                i.idIngreso, 
                i.idGenIngreso, 
                i.idTipoIngreso,
                i.idCategoria, 
                i.fechaEmision, 
                i.fechaVtoCobro, 
                i.tipoFactura, 
                i.descuentoGral, 
                i.descuentoTotal,
                i.importeNetoNoGravado, 
                i.ivaTotal, 
                i.subTotalSinDescuento, 
                i.subTotalConDescuento, 
                i.total, 
                i.aCobrar, 
                i.saldado, 
                i.notaCliente, 
                i.notaInterna, 
                i.idEstado, 
                i.fechaAlta, 
                c.nombEmpresa as nombEmpresa, 
                c.idCliente as idCliente,
                c.domicilio,
                c.numero,
                c.piso,
                c.dpto,
                c.cp,
                p.provincia,
                l.localidad,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuario,
                u.idUsuario as idUsuarioVend,
                cv.descripcion as categoriaVenta
            ');
        $this->db->from('ingresos as i');
        $this->db->join('clientes as c', 'c.idCliente = i.idCliente');
        $this->db->join('usuarios as u', 'u.idUsuario = i.idVendedor');
        $this->db->join('provincias as p', 'p.idProvincia = c.idProvincia');
        $this->db->join('localidades as l', 'l.idLocalidad = c.idLocalidad');
        $this->db->join('categorias_ventas as cv', 'cv.idCategoriaVentas = i.idCategoria');
        $this->db->where('i.idGenIngreso', $idGenIngreso);
        $this->db->where('i.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtener engresos correspondientes a los datos pasados por parametros
     * @param type $idVendedor
     * @param type $fechaEmision
     * @return type
     */
    public function get_ingresos_by_idVendedor_fechaEmision($idVendedor, $fechaEmision)
    {
        $this->db->select('
                i.idIngreso, 
                i.idGenIngreso, 
                i.idTipoIngreso,
                i.idCategoria, 
                i.fechaEmision, 
                i.fechaVtoCobro, 
                i.tipoFactura, 
                i.descuentoGral, 
                i.descuentoTotal,
                i.importeNetoNoGravado, 
                i.ivaTotal, 
                i.subTotalSinDescuento, 
                i.subTotalConDescuento, 
                i.total, 
                i.aCobrar, 
                i.saldado, 
                i.notaCliente, 
                i.notaInterna, 
                i.idEstado, 
                i.fechaAlta
            ');
        $this->db->from('ingresos as i');
        $this->db->where('i.idVendedor', $idVendedor);
        $this->db->where('i.fechaAlta >=', $fechaEmision);
        $this->db->where('i.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtener engresos correspondientes a los datos pasados por parametros
     * @param type $fechaEmision
     * @return type
     */
    public function get_ingresos_by_fechaEmision($fechaEmision)
    {
        $this->db->select('
                i.idIngreso, 
                i.idGenIngreso, 
                i.idTipoIngreso,
                i.idCategoria, 
                i.fechaEmision, 
                i.fechaVtoCobro, 
                i.tipoFactura, 
                i.descuentoGral, 
                i.descuentoTotal,
                i.importeNetoNoGravado, 
                i.ivaTotal, 
                i.subTotalSinDescuento, 
                i.subTotalConDescuento, 
                i.total, 
                i.aCobrar, 
                i.saldado, 
                i.notaCliente, 
                i.notaInterna, 
                i.idEstado, 
                i.fechaAlta
            ');
        $this->db->from('ingresos as i');
        $this->db->where('i.fechaEmision >=', $fechaEmision);
        $this->db->where('i.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * obtencion de los ingresos con sus correspondientes datos e inner join donde se necesite con el filtro desde hasta con respecto a la fechaEmision
     * @return type
     */
    public function get_ingresos_desde_hasta($desde, $hasta)
    {
        $this->db->select('
                i.idIngreso, 
                i.idGenIngreso, 
                i.idTipoIngreso,
                i.idCategoria, 
                i.fechaEmision, 
                i.fechaVtoCobro, 
                i.tipoFactura, 
                i.descuentoGral, 
                i.descuentoTotal,
                i.importeNetoNoGravado, 
                i.ivaTotal, 
                i.subTotalSinDescuento, 
                i.subTotalConDescuento, 
                i.total, 
                i.aCobrar, 
                i.saldado, 
                i.notaCliente, 
                i.notaInterna, 
                i.idEstado, 
                i.fechaAlta, 
                c.nombEmpresa as nombEmpresa, 
                c.idCliente as idCliente,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend
            ');
        $this->db->from('ingresos as i');
        $this->db->join('clientes as c', 'c.idCliente = i.idCliente');
        $this->db->join('usuarios as u', 'u.idUsuario = i.idVendedor');
        $this->db->where('i.eliminado', 0);
        $this->db->where('i.fechaEmision >=', $desde);
        $this->db->where('i.fechaEmision <=', $hasta);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * obtencion de los ingresos con sus correspondientes datos e inner join donde se necesite para la exportacion de datos
     * @return type
     */
    public function get_ingresos_exportar()
    {
        //--- cabeceras ---//
        $fields[0]['name'] = 'Estado';
        $fields[1]['name'] = 'Emisión';
        $fields[2]['name'] = 'Cliente';
        $fields[3]['name'] = 'Categoria';
        $fields[4]['name'] = 'SubTotal';
        $fields[5]['name'] = 'Descuento';
        $fields[6]['name'] = 'Total';
        $fields[7]['name'] = 'Cobrado';
        $fields[8]['name'] = 'Vendedor';

        $this->db->select('
                ei.nombre as estado, 
                i.fechaEmision, 
                c.nombEmpresa, 
                cv.descripcion as categoriaVenta, 
                i.subTotalSinDescuento, 
                i.descuentoTotal,
                i.total, 
                i.aCobrar, 
                u.nombreCompleto as nombreVend
            ');
        $this->db->from('ingresos as i');
        $this->db->join('clientes as c', 'c.idCliente = i.idCliente');
        $this->db->join('usuarios as u', 'u.idUsuario = i.idVendedor');
        $this->db->join('estados_ingresos as ei', 'ei.idEstadoIngresos = i.idEstado');
        $this->db->join('categorias_ventas as cv', 'cv.idCategoriaVentas = i.idCategoria');
        $this->db->where('i.eliminado', 0);
        $result = $this->db->get();

        return ($result != '') ? array("fields" => $fields, "query" => $result) : false;
    }

    /**
     * obtencion de los ingresos con sus correspondientes datos e inner join donde se necesite para la exportacion de datos
     * @return type
     */
    public function get_ingresos_desde_hasta_exportar($desde, $hasta)
    {
        //--- cabeceras ---//
        $fields[0]['name'] = 'Estado';
        $fields[1]['name'] = 'Emisión';
        $fields[2]['name'] = 'Cliente';
        $fields[3]['name'] = 'Categoria';
        $fields[4]['name'] = 'SubTotal';
        $fields[5]['name'] = 'Descuento';
        $fields[6]['name'] = 'Total';
        $fields[7]['name'] = 'Cobrado';
        $fields[8]['name'] = 'Vendedor';

        $this->db->select('
                ei.nombre as estado, 
                i.fechaEmision, 
                c.nombEmpresa, 
                cv.descripcion as categoriaVenta, 
                i.subTotalSinDescuento, 
                i.descuentoTotal,
                i.total, 
                i.aCobrar, 
                u.nombreCompleto as nombreVend
            ');
        $this->db->from('ingresos as i');
        $this->db->join('clientes as c', 'c.idCliente = i.idCliente');
        $this->db->join('usuarios as u', 'u.idUsuario = i.idVendedor');
        $this->db->join('estados_ingresos as ei', 'ei.idEstadoIngresos = i.idEstado');
        $this->db->join('categorias_ventas as cv', 'cv.idCategoriaVentas = i.idCategoria');
        $this->db->where('i.eliminado', 0);
        $this->db->where('i.fechaEmision >=', $desde);
        $this->db->where('i.fechaEmision <=', $hasta);
        $result = $this->db->get();

        return ($result != '') ? array("fields" => $fields, "query" => $result) : false;
    }

    /**
     * Actualizacion de los datos del detalle de abono que corresponda a un idProducto e idGenAbono
     * @param type $idGenAbono
     * @param type $idProducto
     * @param type $cantidad
     * @param type $precio
     * @param type $descuento
     * @param type $subtotalProd
     * @param type $iva
     * @param type $ivaText
     * @return type
     */
    public function update_abono_detalle_by_idAbono(
        $idGenAbono,
        $idProducto,
        $cantidad,
        $precio,
        $descuento,
        $subtotalProd,
        $iva,
        $ivaText
    ) {
        $values = array(
            'cantidad' => $cantidad,
            'precio' => $precio,
            'descuento' => $descuento,
            'subTotal' => $subtotalProd,
            'iva' => $iva,
            'ivaText' => $ivaText
        );
        $this->db->where('idGenAbono', $idGenAbono);
        $this->db->where('idProducto', $idProducto);
        $result = $this->db->update('abonos_detalle', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Actualizacion de los datos del detalle de ingreso que corresponda a un idProducto e idGenIngreso
     * @param type $idGenIngreso
     * @param type $idProducto
     * @param type $cantidad
     * @param type $precio
     * @param type $descuento
     * @param type $subtotalProd
     * @param type $iva
     * @param type $ivaText
     * @return type
     */
    public function update_ingreso_detalle_by_idProducto(
        $idGenIngreso,
        $idProducto,
        $cantidad,
        $precio,
        $descuento,
        $subtotalProd,
        $iva,
        $ivaText
    ) {
        $values = array(
            'cantidad' => $cantidad,
            'precio' => $precio,
            'descuento' => $descuento,
            'subTotal' => $subtotalProd,
            'iva' => $iva,
            'ivaText' => $ivaText
        );
        $this->db->where('idGenIngresoAbono', $idGenIngreso);
        $this->db->where('idProducto', $idProducto);
        $result = $this->db->update('ingresos_detalle', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Actualizacion de los datos del detalle de egreso que corresponda a un idProducto e idGenEgreso
     * @param type $idGenEgreso
     * @param type $idProducto
     * @param type $cantidad
     * @param type $precio
     * @param type $descuento
     * @param type $subtotalProd
     * @param type $iva
     * @param type $ivaText
     * @return type
     */
    public function update_egreso_detalle_by_idProducto(
        $idGenEgreso,
        $idProducto,
        $cantidad,
        $precio,
        $descuento,
        $subtotalProd,
        $iva,
        $ivaText
    ) {
        $values = array(
            'cantidad' => $cantidad,
            'precio' => $precio,
            'descuento' => $descuento,
            'subTotal' => $subtotalProd,
            'idIva' => $iva,
            'ivaText' => $ivaText
        );
        $this->db->where('idGenEgreso', $idGenEgreso);
        $this->db->where('idProducto', $idProducto);
        $result = $this->db->update('egresos_detalle', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function update_cuenta_corrientes_by_idCliente(
        $idCliente,
        $idGenIngreso
    ) {
        $values = array(
            'idCliente' => $idCliente
        );
        $this->db->where('idGenIngreso', $idGenIngreso);
        $result = $this->db->update('clientes_cuenta_corriente', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Acrualizacion de la cuenta corriente ordenada ascendentemente con limit 1 filtrada por el idGenIngreso
     * @param type $idGenIngreso
     * @param type $idCliente
     * @param type $debito
     * @param type $credito
     * @param type $saldo
     * @param type $descripcionCobro
     * @return type
     */
    public function update_cuenta_corrientes_by_idGenIngreso_ordenAsc_limit1(
        $idGenIngreso,
        $idCliente,
        $debito,
        $credito,
        $saldo,
        $descripcionCobro
    ) {
        $values = array(
            'idCliente' => $idCliente,
            'debito' => $debito,
            'credito' => $credito,
            'saldo' => $saldo,
            'descripcion' => $descripcionCobro
        );
        $this->db->where('idGenIngreso', $idGenIngreso);
        $this->db->order_by('idGenIngreso', 'ASC');
        $this->db->limit(1);
        $result = $this->db->update('clientes_cuenta_corriente', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Actualizacion de la cuenta corriente correspondiente al idGenIngreso pasado
     * @param type $idGenIngreso
     * @param type $idCliente
     * @param type $debito
     * @param type $credito
     * @param type $saldo
     * @param type $descripcionCobro
     * @return type
     */
    public function update_saldo_cuenta_corrientes_by_idGenIngreso(
        $idGenIngreso,
        $idCuentaCorriente,
        $saldo
    ) {
        $values = array(
            'saldo' => $saldo
        );
        $this->db->where('idGenIngreso', $idGenIngreso);
        $this->db->where('idCuentaCorriente', $idCuentaCorriente);
        $result = $this->db->update('clientes_cuenta_corriente', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Obtencion de cuentas corrientes correspondientes al idGenIngreso
     * @param type $idGenIngreso
     * @return type
     */
    public function get_cuenta_corriente_by_idGenIngreso($idGenIngreso)
    {
        $this->db->select('*');
        $this->db->from('clientes_cuenta_corriente');
        $this->db->where('idGenIngreso', $idGenIngreso);
        $this->db->order_by('idCuentaCorriente', 'ASC');
        $this->db->where('eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de cuentas corrientes correspondientes al idCliente
     * @param type $idCliente
     * @return type
     */
    public function get_cuenta_corriente_by_idCliente($idCliente)
    {
        $this->db->select('*');
        $this->db->from('clientes_cuenta_corriente');
        $this->db->where('idCliente', $idCliente);
        $this->db->order_by('idCuentaCorriente', 'ASC');
        $this->db->where('eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Actualizacion de la cuenta corriente ordenada ascendentemente con limit 1 filtrada por el idGenIngreso
     * @param type $idGenIngreso
     * @param type $idCliente
     * @param type $debito
     * @param type $credito
     * @param type $saldo
     * @param type $descripcionCobro
     * @return type
     */
    public function update_cuenta_corrientes_proveedores_by_idGenEgreso_ordenAsc_limit1(
        $idGenEgreso,
        $idProveedor,
        $aPagar,
        $saldo,
        $descripcionCobro
    ) {
        $values = array(
            'idProveedor' => $idProveedor,
            'aPagar' => $aPagar,
            'saldo' => $saldo,
            'descripcion' => $descripcionCobro
        );
        $this->db->where('idGenEgreso', $idGenEgreso);
        $this->db->order_by('idGenEgreso', 'ASC');
        $this->db->limit(1);
        $result = $this->db->update('proveedores_cuenta_corriente', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Obtencion de los medios de pagos
     * @return type
     */
    public function get_medios_pagos()
    {
        $this->db->select('*');
        $this->db->from('medios_pagos');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_debito_cuenta_corriente($idGenIngreso)
    {
        $this->db->select('debito');
        $this->db->from('clientes_cuenta_corriente');
        $this->db->where('idGenIngreso', $idGenIngreso);
        $this->db->where('eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_ingresos2()
    {
        $result = $this->db->get('ingresos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_ingresos3()
    {
        $this->db->where('fechaEmision', "2019-07-02");
        $result = $this->db->get('ingresos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_ingresos4()
    {
        $this->db->where('fechaEmision', "2019-09-10");
        $result = $this->db->get('ingresos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de todos los egresos
     * @return type
     */
    public function get_egresos()
    {
        $this->db->select('
                e.idEgreso, 
                e.idGenEgreso, 
                e.idTipoEgreso,
                e.idCategoriaGasto, 
                e.fechaEmision, 
                e.fechaVtoPago, 
                e.tipoFactura, 
                e.descuentoGral, 
                e.descuentoTotal,
                e.importeNetoNoGravado, 
                e.ivaTotal, 
                e.subTotalSinDescuento, 
                e.subTotalConDescuento, 
                e.total, 
                e.aPagar, 
                e.saldado, 
                e.notaInterna, 
                e.idEstado, 
                e.fechaAlta, 
                p.nombEmpresa as nombEmpresa, 
                p.idProveedor as idProveedor,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend
            ');
        $this->db->from('egresos as e');
        $this->db->join('proveedores as p', 'p.idProveedor= e.idProveedor');
        $this->db->join('usuarios as u', 'u.idUsuario = e.idVendedor');
        $this->db->where('e.eliminado', 0);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de egresos con iva
     * @return type
     */
    public function get_egresos_con_iva()
    {
        $this->db->select('
                e.idEgreso, 
                e.idGenEgreso, 
                e.idTipoEgreso,
                e.idCategoriaGasto, 
                e.fechaEmision, 
                e.fechaVtoPago, 
                e.tipoFactura, 
                e.descuentoGral, 
                e.descuentoTotal,
                e.importeNetoNoGravado, 
                e.ivaTotal, 
                e.subTotalSinDescuento, 
                e.subTotalConDescuento, 
                e.total, 
                e.aPagar, 
                e.saldado, 
                e.notaInterna, 
                e.idEstado, 
                e.fechaAlta, 
                p.nombEmpresa as nombEmpresa, 
                p.idProveedor as idProveedor,
                pdf.cuit as cuit,
                ic.descripcion as condicionIva,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend
            ');
        $this->db->from('egresos as e');
        $this->db->join('proveedores as p', 'p.idProveedor= e.idProveedor');
        $this->db->join('usuarios as u', 'u.idUsuario = e.idVendedor');
        $this->db->join('proveedores_detalle_facturacion as pdf', 'pdf.idGenProveedor = p.idGenProveedor');
        $this->db->join('iva_condiciones as ic', 'ic.idCondicionIva = pdf.idCondIva');
        $this->db->where('e.ivaTotal >=', 1);
        $this->db->where('e.eliminado', 0);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de egresos con iva
     * @return type
     */
    public function get_egresos_con_iva_con_rango_fecha($fechaInicio, $fechaFin)
    {
        $this->db->select('
                e.idEgreso, 
                e.idGenEgreso, 
                e.idTipoEgreso,
                e.idCategoriaGasto, 
                e.fechaEmision, 
                e.fechaVtoPago, 
                e.tipoFactura, 
                e.descuentoGral, 
                e.descuentoTotal,
                e.importeNetoNoGravado, 
                e.ivaTotal, 
                e.subTotalSinDescuento, 
                e.subTotalConDescuento, 
                e.total, 
                e.aPagar, 
                e.saldado, 
                e.notaInterna, 
                e.idEstado, 
                e.fechaAlta, 
                p.nombEmpresa as nombEmpresa, 
                p.idProveedor as idProveedor,
                pdf.cuit as cuit,
                ic.descripcion as condicionIva,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend
            ');
        $this->db->from('egresos as e');
        $this->db->join('proveedores as p', 'p.idProveedor= e.idProveedor');
        $this->db->join('usuarios as u', 'u.idUsuario = e.idVendedor');
        $this->db->join('proveedores_detalle_facturacion as pdf', 'pdf.idGenProveedor = p.idGenProveedor');
        $this->db->join('iva_condiciones as ic', 'ic.idCondicionIva = pdf.idCondIva');
        $this->db->where('e.fechaAlta >=', $fechaInicio);
        $this->db->where('e.fechaAlta <=', $fechaFin);
        $this->db->where('e.ivaTotal >=', 1);
        $this->db->where('e.eliminado', 0);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtenemos el egreso correspondiente a la nota de debito que pasamos por parametros
     * @param type $idNota
     * @return type
     */
    public function get_egresos_nota_debito($idNota)
    {
        $this->db->select('
                e.idEgreso, 
                e.idGenEgreso, 
                e.idTipoEgreso,
                e.idCategoriaGasto, 
                e.fechaEmision, 
                e.fechaVtoPago, 
                e.tipoFactura, 
                e.descuentoGral, 
                e.descuentoTotal,
                e.importeNetoNoGravado, 
                e.ivaTotal, 
                e.subTotalSinDescuento, 
                e.subTotalConDescuento, 
                e.total, 
                e.aPagar, 
                e.saldado, 
                e.notaInterna, 
                e.idEstado, 
                e.fechaAlta, 
                p.nombEmpresa as nombEmpresa, 
                p.idProveedor as idProveedor,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend
            ');
        $this->db->from('notas_debito_proveedores as nd');
        $this->db->join('egresos as e', 'e.idGenEgreso = nd.idGenEgreso');
        $this->db->join('proveedores as p', 'p.idProveedor= e.idProveedor');
        $this->db->join('usuarios as u', 'u.idUsuario = e.idVendedor');
        $this->db->where('nd.idNotaDebito', $idNota);
        $this->db->where('e.eliminado', 0);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * obtenemos el egreso de la nota de credito que se pasa por parametro
     * @param type $idNota
     * @return type
     */
    public function get_egresos_nota_credito($idNota)
    {
        $this->db->select('
                e.idEgreso, 
                e.idGenEgreso, 
                e.idTipoEgreso,
                e.idCategoriaGasto, 
                e.fechaEmision, 
                e.fechaVtoPago, 
                e.tipoFactura, 
                e.descuentoGral, 
                e.descuentoTotal,
                e.importeNetoNoGravado, 
                e.ivaTotal, 
                e.subTotalSinDescuento, 
                e.subTotalConDescuento, 
                e.total, 
                e.aPagar, 
                e.saldado, 
                e.notaInterna, 
                e.idEstado, 
                e.fechaAlta, 
                p.nombEmpresa as nombEmpresa, 
                p.idProveedor as idProveedor,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend
            ');
        $this->db->from('notas_credito_proveedores as nc');
        $this->db->join('egresos as e', 'e.idGenEgreso = nc.idGenEgreso');
        $this->db->join('proveedores as p', 'p.idProveedor= e.idProveedor');
        $this->db->join('usuarios as u', 'u.idUsuario = e.idVendedor');
        $this->db->where('nc.idNotaCredito', $idNota);
        $this->db->where('e.eliminado', 0);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * obtencion de los ingresos con sus correspondientes datos e inner join donde se necesite con el filtro desde hasta con respecto a la fechaEmision
     * @return type
     */
    public function get_egresos_desde_hasta($desde, $hasta)
    {
        $this->db->select('
                e.idEgreso, 
                e.idGenEgreso, 
                e.idTipoEgreso,
                e.idCategoriaGasto, 
                e.fechaEmision, 
                e.fechaVtoPago, 
                e.tipoFactura, 
                e.descuentoGral, 
                e.descuentoTotal,
                e.importeNetoNoGravado, 
                e.ivaTotal, 
                e.subTotalSinDescuento, 
                e.subTotalConDescuento, 
                e.total, 
                e.aPagar, 
                e.saldado, 
                e.notaInterna, 
                e.idEstado, 
                e.fechaAlta, 
                p.nombEmpresa as nombEmpresa, 
                p.idProveedor as idProveedor,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend
            ');
        $this->db->from('egresos as e');
        $this->db->join('proveedores as p', 'p.idProveedor= e.idProveedor');
        $this->db->join('usuarios as u', 'u.idUsuario = e.idVendedor');
        $this->db->where('e.fechaEmision >=', $desde);
        $this->db->where('e.fechaEmision <=', $hasta);
        $this->db->where('e.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Otencion del ultimo egreso que sea mayor a la fechaHora pasada y coincida un detalle con su idProducto
     * @param type $idProducto
     * @param type $fechaHora
     * @return type
     */
    public function get_compra_producto_by_idProducto_fechaHora($idProducto, $fechaHora)
    {
        $this->db->select('
                e.idEgreso, 
                e.idGenEgreso, 
                e.idTipoEgreso,
                e.idCategoriaGasto, 
                e.fechaEmision, 
                e.fechaVtoPago, 
                e.tipoFactura, 
                e.descuentoGral, 
                e.descuentoTotal,
                e.importeNetoNoGravado, 
                e.ivaTotal, 
                e.subTotalSinDescuento, 
                e.subTotalConDescuento, 
                e.total, 
                e.aPagar, 
                e.saldado, 
                e.notaInterna, 
                e.idEstado, 
                e.fechaAlta
            ');
        $this->db->from('egresos as e');
        $this->db->join('egresos_detalle as ed', 'ed.idGenEgreso = e.idGenEgreso');
        $this->db->where('e.fechaAlta >', $fechaHora);
        $this->db->where('ed.idProducto >', $idProducto);
        $this->db->where('e.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_compra_by_idCategoriaCompras($idCategoriaCompras)
    {
        
        $this->db->from('egresos as e');
        $this->db->where('e.idCategoriaGasto', $idCategoriaCompras);
        $this->db->where('e.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de todos los egresos para la exportacion
     * @return type
     */
    public function get_egresos_exportar()
    {
        //--- cabeceras ---//
        $fields[0]['name'] = 'Estado';
        $fields[1]['name'] = 'Emisión';
        $fields[2]['name'] = 'Proveedor';
        $fields[3]['name'] = 'Descuento';
        $fields[4]['name'] = 'Total';
        $fields[5]['name'] = 'Pagado';
        $fields[6]['name'] = 'Usuario';

        $this->db->select('
                ee.descripcion as estado, 
                e.fechaEmision, 
                p.nombEmpresa, 
                e.descuentoTotal,
                e.total, 
                e.aPagar, 
                u.nombreCompleto as nombProveedor
            ');
        $this->db->from('egresos as e');
        $this->db->join('proveedores as p', 'p.idProveedor = e.idProveedor');
        $this->db->join('usuarios as u', 'u.idUsuario = e.idVendedor');
        $this->db->join('egresos_estados as ee', 'ee.idEstado = e.idEstado');
        $this->db->where('e.eliminado', 0);
        $result = $this->db->get();

        return ($result != '') ? array("fields" => $fields, "query" => $result) : false;
    }

    /**
     * obtencion de los egresos con sus correspondientes datos e inner join donde se necesite para la exportacion de datos filtrando la fecha desde hasta
     * @return type
     */
    public function get_egresos_desde_hasta_exportar($desde, $hasta)
    {
        //--- cabeceras ---//
        $fields[0]['name'] = 'Estado';
        $fields[1]['name'] = 'Emisión';
        $fields[2]['name'] = 'Proveedor';
        $fields[3]['name'] = 'Descuento';
        $fields[4]['name'] = 'Total';
        $fields[5]['name'] = 'Pagado';
        $fields[6]['name'] = 'Usuario';

        $this->db->select('
                ee.descripcion as estado, 
                e.fechaEmision, 
                p.nombEmpresa, 
                e.descuentoTotal,
                e.total, 
                e.aPagar, 
                u.nombreCompleto as nombProveedor
            ');
        $this->db->from('egresos as e');
        $this->db->join('proveedores as p', 'p.idProveedor = e.idProveedor');
        $this->db->join('usuarios as u', 'u.idUsuario = e.idVendedor');
        $this->db->join('egresos_estados as ee', 'ee.idEstado = e.idEstado');
        $this->db->where('e.fechaEmision >=', $desde);
        $this->db->where('e.fechaEmision <=', $hasta);
        $this->db->where('e.eliminado', 0);
        $result = $this->db->get();

        return ($result != '') ? array("fields" => $fields, "query" => $result) : false;
    }

    /**
     * Obtencion de abonos con sus join correspondientes
     * @return type
     */
    public function get_abonos()
    {
        $this->db->select('
                a.idAbono, 
                a.idGenAbono, 
                a.idCategoria, 
                a.fechaEmision, 
                a.fechaVtoCobro, 
                a.tipoFactura, 
                a.descuentoGral, 
                a.descuentoTotal,
                a.importeNetoNoGravado, 
                a.ivaTotal, 
                a.subTotalSinDescuento, 
                a.subTotalConDescuento, 
                a.total, 
                a.notaCliente, 
                a.notaInterna, 
                a.idEstado, 
                a.fechaAlta, 
                a.ventasCreadas, 
                a.idAbonoModalidad, 
                a.fechaPrimerVenta, 
                a.fechaInicioAbono, 
                a.fechaFinalizacion,  
                a.idSubcategoriaVenta, 
                c.nombEmpresa as nombEmpresa, 
                c.idCliente as idCliente,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                am.descripcion as descripModalidad
            ');
        $this->db->from('abonos as a');
        $this->db->join('clientes as c', 'c.idCliente = a.idCliente');
        $this->db->join('usuarios as u', 'u.idUsuario = a.idVendedor');
        $this->db->join('abono_modalidades as am', 'am.idAbonoModalidad = a.idAbonoModalidad');
        $this->db->where('a.eliminado', 0);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * obtencion de los gastos con sus correspondientes datos e inner join donde se necesite con el filtro desde hasta con respecto a la fechaEmision
     * @return type
     */
    public function get_abonos_desde_hasta($desde, $hasta)
    {
        $this->db->select('
                a.idAbono, 
                a.idGenAbono, 
                a.idCategoria, 
                a.fechaEmision, 
                a.fechaVtoCobro, 
                a.tipoFactura, 
                a.descuentoGral, 
                a.descuentoTotal,
                a.importeNetoNoGravado, 
                a.ivaTotal, 
                a.subTotalSinDescuento, 
                a.subTotalConDescuento, 
                a.total, 
                a.notaCliente, 
                a.notaInterna, 
                a.idEstado, 
                a.fechaAlta, 
                a.ventasCreadas, 
                a.idAbonoModalidad, 
                a.fechaPrimerVenta, 
                a.fechaInicioAbono, 
                a.fechaFinalizacion, 
                a.idCategoriaVenta, 
                a.idSubcategoriaVenta, 
                c.nombEmpresa as nombEmpresa, 
                c.idCliente as idCliente,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                am.descripcion as descripModalidad
            ');
        $this->db->from('abonos as a');
        $this->db->join('clientes as c', 'c.idCliente = a.idCliente');
        $this->db->join('usuarios as u', 'u.idUsuario = a.idVendedor');
        $this->db->join('abono_modalidades as am', 'am.idAbonoModalidad = a.idAbonoModalidad');
        $this->db->where('a.fechaEmision >=', $desde);
        $this->db->where('a.fechaEmision <=', $hasta);
        $this->db->where('a.eliminado', 0);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de todos los gastos para la exportacion
     * @return type
     */
    public function get_abonos_exportar()
    {
        //--- cabeceras ---//
        $fields[0]['name'] = 'Estado';
        $fields[1]['name'] = 'Emisión';
        $fields[2]['name'] = 'Vencimiento';
        $fields[3]['name'] = 'Cliente';
        $fields[4]['name'] = 'Periocidad';
        $fields[5]['name'] = 'VentasCreadas';
        $fields[6]['name'] = 'SubTotal';
        $fields[7]['name'] = 'Descuento';
        $fields[8]['name'] = 'Total';
        $fields[9]['name'] = 'Vendedor';

        $this->db->select('
                ea.descripcion, 
                a.fechaEmision, 
                a.fechaVtoCobro, 
                c.nombEmpresa as nombEmpresa, 
                am.descripcion as descripModalidad,
                a.ventasCreadas, 
                a.subTotalSinDescuento, 
                a.descuentoTotal,
                a.total, 
                u.nombreCompleto as nombreVend,
            ');
        $this->db->from('abonos as a');
        $this->db->join('clientes as c', 'c.idCliente = a.idCliente');
        $this->db->join('usuarios as u', 'u.idUsuario = a.idVendedor');
        $this->db->join('abono_modalidades as am', 'am.idAbonoModalidad = a.idAbonoModalidad');
        $this->db->join('estados_abonos as ea', 'a.idEstado = ea.idEstado');
        $this->db->where('a.eliminado', 0);
        $result = $this->db->get();

        return ($result != '') ? array("fields" => $fields, "query" => $result) : false;
    }

    /**
     * obtencion de los gastos con sus correspondientes datos e inner join donde se necesite para la exportacion de datos filtrando la fecha desde hasta
     * @return type
     */
    public function get_abonos_desde_hasta_exportar($desde, $hasta)
    {
        //--- cabeceras ---//
        $fields[0]['name'] = 'Estado';
        $fields[1]['name'] = 'Emisión';
        $fields[2]['name'] = 'Vencimiento';
        $fields[3]['name'] = 'Cliente';
        $fields[4]['name'] = 'Periocidad';
        $fields[5]['name'] = 'VentasCreadas';
        $fields[6]['name'] = 'SubTotal';
        $fields[7]['name'] = 'Descuento';
        $fields[8]['name'] = 'Total';
        $fields[9]['name'] = 'Vendedor';

        $this->db->select('
                ea.descripcion, 
                a.fechaEmision, 
                a.fechaVtoCobro, 
                c.nombEmpresa as nombEmpresa, 
                am.descripcion as descripModalidad,
                a.ventasCreadas, 
                a.subTotalSinDescuento, 
                a.descuentoTotal,
                a.total, 
                u.nombreCompleto as nombreVend,
            ');
        $this->db->from('abonos as a');
        $this->db->join('clientes as c', 'c.idCliente = a.idCliente');
        $this->db->join('usuarios as u', 'u.idUsuario = a.idVendedor');
        $this->db->join('abono_modalidades as am', 'am.idAbonoModalidad = a.idAbonoModalidad');
        $this->db->join('estados_abonos as ea', 'a.idEstado = ea.idEstado');
        $this->db->where('a.fechaEmision >=', $desde);
        $this->db->where('a.fechaEmision <=', $hasta);
        $this->db->where('a.eliminado', 0);

        $result = $this->db->get();

        return ($result != '') ? array("fields" => $fields, "query" => $result) : false;
    }

    /**
     * Obtencion de abonos con sus join correspondientes y el filtro de idEstado = 1 significando que esta activo
     * @return type
     */
    public function get_abonos_cronejob()
    {
        $this->db->select('
                a.idAbono, 
                a.idGenAbono, 
                a.idCategoria, 
                a.fechaEmision, 
                a.fechaVtoCobro, 
                a.tipoFactura, 
                a.descuentoGral, 
                a.descuentoTotal,
                a.descuentoCliente,
                a.importeNetoNoGravado, 
                a.ivaTotal, 
                a.subTotalSinDescuento, 
                a.subTotalConDescuento, 
                a.total, 
                a.notaCliente, 
                a.notaInterna, 
                a.idEstado, 
                a.fechaAlta, 
                a.ventasCreadas, 
                a.idAbonoModalidad, 
                a.fechaPrimerVenta, 
                a.fechaInicioAbono, 
                a.fechaFinalizacion, 
                a.idSubcategoriaVenta, 
                a.fechaInicioServicio, 
                a.fechaFinServicio, 
                c.nombEmpresa as nombEmpresa, 
                c.idCliente as idCliente,
                cdf.razonSocial,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                am.descripcion as descripModalidad
            ');
        $this->db->from('abonos as a');
        $this->db->join('clientes as c', 'c.idCliente = a.idCliente');
        $this->db->join('clientes_detalle_facturacion as cdf', 'cdf.idGenCliente = c.idGenCliente');
        $this->db->join('usuarios as u', 'u.idUsuario = a.idVendedor');
        $this->db->join('abono_modalidades as am', 'am.idAbonoModalidad = a.idAbonoModalidad');
        $this->db->where('a.idEstado', 1);
        $this->db->where('a.eliminado', 0);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de los detalle del abono que pasamos correspondiente al idGenAbono pasado por parametro
     * @param type $idGenAbono
     * @return type
     */
    public function get_abonos_detalle($idGenAbono)
    {
        $this->db->select('
            abonos_detalle.idDetalleAbono,
            abonos_detalle.idGenAbono,
            abonos_detalle.idProducto,
            abonos_detalle.cantidad,
            abonos_detalle.precio ,
            abonos_detalle.descuento,
            abonos_detalle.subTotal,
            abonos_detalle.iva,
            abonos_detalle.eliminado,
            abonos_detalle.fechaAlta,
            productos.idGenProducto,
            productos.nombre,
            productos.codigo,
            productos.stock,
            productos.precioVenta,
            productos.precioCompra            
            ');
        $this->db->from('abonos_detalle');
        $this->db->join('productos', 'productos.idProducto = abonos_detalle.idProducto');
        $this->db->where('abonos_detalle.eliminado', 0);
        $this->db->where('abonos_detalle.idGenAbono', $idGenAbono);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_abonos_ingresos()
    {
        $this->db->select('a.idGenAbono, id.idProducto, id.cantidad, id.precio, id.descuento, id.subTotal,id.iva');

        $this->db->from('abonos as a');
        $this->db->join('ingresos as i', 'i.idGenAbono = a.idGenAbono');
        $this->db->join('ingresos_detalle as id', 'id.idGenIngresoAbono = i.idGenIngreso');
        $this->db->where('a.eliminado', 0);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion del abono correspondiente al idGenAbono
     * @param type $idGenAbono
     * @return type
     */
    public function get_abono_by_idGenAbono($idGenAbono)
    {
        $this->db->select('
                a.idAbono, 
                a.idGenAbono, 
                a.idCategoria, 
                a.fechaEmision, 
                a.fechaVtoCobro, 
                a.tipoFactura, 
                a.descuentoGral, 
                a.descuentoTotal,
                a.descuentoCliente,
                a.importeNetoNoGravado, 
                a.ivaTotal, 
                a.subTotalSinDescuento, 
                a.subTotalConDescuento, 
                a.total, 
                a.notaCliente, 
                a.notaInterna, 
                a.idEstado, 
                a.fechaAlta, 
                a.ventasCreadas, 
                a.idAbonoModalidad, 
                a.fechaPrimerVenta, 
                a.fechaInicioAbono, 
                a.fechaFinalizacion,
                a.idSubcategoriaVenta,
                a.fechaInicioServicio,
                a.fechaFinServicio,
                c.nombEmpresa as nombEmpresa, 
                c.idCliente as idCliente,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                am.descripcion as descripModalidad
            ');
        $this->db->from('abonos as a');
        $this->db->join('clientes as c', 'c.idCliente = a.idCliente');
        $this->db->join('usuarios as u', 'u.idUsuario = a.idVendedor');
        $this->db->join('abono_modalidades as am', 'am.idAbonoModalidad = a.idAbonoModalidad');
        $this->db->where('a.eliminado', 0);
        $this->db->where('a.idGenAbono', $idGenAbono);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion del abono correspondiente al idAbono
     * @param type $idAbono
     * @return type
     */
    public function get_abono_by_idAbono($idAbono)
    {
        $this->db->select('
                a.idAbono, 
                a.idGenAbono, 
                a.idCategoria, 
                a.fechaEmision, 
                a.fechaVtoCobro, 
                a.tipoFactura, 
                a.descuentoGral, 
                a.descuentoTotal,
                a.importeNetoNoGravado, 
                a.ivaTotal, 
                a.subTotalSinDescuento, 
                a.subTotalConDescuento, 
                a.total, 
                a.notaCliente, 
                a.notaInterna, 
                a.idEstado, 
                a.fechaAlta, 
                a.ventasCreadas, 
                a.idAbonoModalidad, 
                a.fechaPrimerVenta, 
                a.fechaInicioAbono, 
                a.fechaFinalizacion, 
                a.idCategoriaVenta, 
                a.idSubcategoriaVenta,
                c.nombEmpresa as nombEmpresa, 
                c.idCliente as idCliente,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                am.descripcion as descripModalidad
            ');
        $this->db->from('abonos as a');
        $this->db->join('clientes as c', 'c.idCliente = a.idCliente');
        $this->db->join('usuarios as u', 'u.idUsuario = a.idVendedor');
        $this->db->join('abono_modalidades as am', 'am.idAbonoModalidad = a.idAbonoModalidad');
        $this->db->where('a.eliminado', 0);
        $this->db->where('a.idAbono', $idAbono);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function compare_user_password($user, $password)
    {
        $values = array(
            'usuario' => $user,
            'password' => $password
        );
        $this->db->where($values);
        $result = $this->db->get('usuarios');
        return ($result != '') ? $result->result_array() : false;
    }

    public function get_usuario_info($idUsuario)
    {
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->join('provincias', 'provincias.idProvincia = usuarios.idProvincia');
        $this->db->join('localidades', 'localidades.idLocalidad = usuarios.idLocalidad');
        $this->db->join('niveles', 'niveles.idNivel = usuarios.idNivel');
        $this->db->where('idUsuario', $idUsuario);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function set_usuario($usuario, $password, $nombre, $apellido, $email, $telefono, $provincia, $localidad, $area, $codigoActivacion)
    {
        $values = array(
            'usuario' => $usuario,
            'password' => $password,
            'nombreCompleto' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
            'tel1' => $telefono,
            'idProvincia' => $provincia,
            'idLocalidad' => $localidad,
            'idArea' => $area,
            'codigoActivacion' => $codigoActivacion,
            'idNivel' => 6
        );
        $result = $this->db->insert('usuarios', $values);
    }

    public function get_sexo()
    {
        $this->db->select('*');
        $this->db->from('sexo');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_estado_civil()
    {
        $this->db->select('*');
        $this->db->from('estado_civil');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_existe_categoria_compras($descripcion)
    {
        $this->db->from('categorias_compras');
        $this->db->where('descripcion', $descripcion);
        $result = $this->db->get();

        return $this->db->affected_rows();
    }

    public function get_existe_categoria_ventas($descripcion)
    {
        $this->db->from('categorias_ventas');
        $this->db->where('descripcion', $descripcion);
        $result = $this->db->get();

        return $this->db->affected_rows();
    }

    public function get_existe_categoria_gastos($descripcion)
    {
        $this->db->from('gastos_categorias');
        $this->db->where('descripcion', $descripcion);
        $result = $this->db->get();

        return $this->db->affected_rows();
    }

    public function get_categorias_compras()
    {
        $this->db->select('*');
        $this->db->from('categorias_compras');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_categorias_compras_detalle()
    {
        $this->db->select('*');
        $this->db->from('categorias_compra_detalle');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_categorias_ventas()
    {
        $this->db->select('*');
        $this->db->from('categorias_ventas');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_categorias_ventas_byId($id)
    {
        $this->db->select('*');
        $this->db->from('categorias_ventas');
        $this->db->where('idCategoriaVentas', $id);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_ultimo_id_categoria_ventas($descripcion)
    {
        $this->db->select('idCategoriaVentas as id');
        $this->db->from('categorias_ventas');
        $this->db->where('descripcion', $descripcion);
        $result = $this->db->get();

        return $result->result_array();
    }

    public function get_ultimo_id_subcategoria_ventas($descripcion)
    {
        $this->db->select('idSubcategoriaVenta as id');
        $this->db->from('categorias_subcategorias_venta_detalle');
        $this->db->where('descripcion', $descripcion);
        $result = $this->db->get();

        return $result->result_array();
    }

    public function get_ultimo_id_categoria_compras($descripcion)
    {
        $this->db->select('idCategoriaCompras as id');
        $this->db->from('categorias_compras');
        $this->db->where('descripcion', $descripcion);
        $result = $this->db->get();

        return $result->result_array();
    }

    public function get_ultimo_id_categoria_gastos($descripcion)
    {
        $this->db->select('idCategoriaGasto as id');
        $this->db->from('gastos_categorias');
        $this->db->where('descripcion', $descripcion);
        $result = $this->db->get();

        return $result->result_array();
    }

    public function get_ultimo_id_subcategoria_gastos($descripcion)
    {
        $this->db->select('idSubCatGasto as id');
        $this->db->from('gastos_subcategorias');
        $this->db->where('descripcion', $descripcion);
        $result = $this->db->get();

        return $result->result_array();
    }

    public function get_subcategorias_ventas()
    {
        $this->db->select('*');
        $this->db->from('categorias_subcategorias_venta_detalle');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_subcategorias_ventas_categoria_detalle()
    {
        $this->db->select('categorias_subcategorias_venta_detalle.idSubcategoriaVenta, categorias_subcategorias_venta_detalle.idCategoriaVentaDetalle, categorias_subcategorias_venta_detalle.descripcion, categorias_subcategorias_venta_detalle.fechaAlta, categorias_ventas.descripcion as descripcionVentaDetalle, categorias_ventas.idCategoriaVentas as IdCategoriaVentaDetalle');
        $this->db->from('categorias_subcategorias_venta_detalle');
        $this->db->join('categorias_ventas', 'categorias_ventas.idCategoriaVentas = categorias_subcategorias_venta_detalle.idCategoriaVentaDetalle');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_categorias_gastos()
    {
        $this->db->select('*');
        $this->db->from('gastos_categorias');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_categorias_gastos_by_idCategoria($idCategoriaGasto)
    {
        $this->db->select('*');
        $this->db->from('gastos_categorias');
        $this->db->where('idCategoriaGasto', $idCategoriaGasto);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_subcategorias_gastos_categoria_gastos()
    {
        $this->db->select('gastos_subcategorias.idSubCatGasto, gastos_subcategorias.idCategoriaGasto, gastos_subcategorias.descripcion, gastos_subcategorias.fechaAlta, gastos_categorias.descripcion as descripcionGasto, gastos_categorias.idCategoriaGasto as idCategoriaGasto');
        $this->db->from('gastos_subcategorias');
        $this->db->join('gastos_categorias', 'gastos_categorias.idCategoriaGasto = gastos_subcategorias.idCategoriaGasto');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function insert_categorias_compras($descripcion)
    {
        $values = array(
            'descripcion' => $descripcion
        );
        $result = $this->db->insert('categorias_compras', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function insert_categorias_gastos($descripcion)
    {
        $values = array(
            'descripcion' => $descripcion
        );
        $result = $this->db->insert('gastos_categorias', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function insert_categoria_ventas($descripcion)
    {
        $values = array(
            'descripcion' => $descripcion
        );
        $result = $this->db->insert('categorias_ventas', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function insert_subcategoria_ventas($descripcion, $selectCategoriaDetalle)
    {
        $values = array(
            'idCategoriaVentaDetalle' => $selectCategoriaDetalle,
            'descripcion' => $descripcion
        );
        $result = $this->db->insert('categorias_subcategorias_venta_detalle', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function insert_subcategoria_gastos($descripcion, $selectCategoria)
    {
        $values = array(
            'idCategoriaGasto' => $selectCategoria,
            'descripcion' => $descripcion
        );
        $result = $this->db->insert('gastos_subcategorias', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function update_categoria_ventas($id, $descripcion)
    {
        $values = array(
            'descripcion' => $descripcion
        );
        $this->db->where('idCategoriaVentas', $id);
        $result = $this->db->update('categorias_ventas', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function update_subcategoria_ventas($id, $descripcion, $selectCategoriaDetalle)
    {
        $values = array(
            'idCategoriaVentaDetalle' => $selectCategoriaDetalle,
            'descripcion' => $descripcion
        );
        $this->db->where('idSubcategoriaVenta', $id);
        $result = $this->db->update('categorias_subcategorias_venta_detalle', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function update_categoria_gastos($id, $descripcion)
    {
        $values = array(
            'descripcion' => $descripcion
        );
        $this->db->where('idCategoriaGasto', $id);
        $result = $this->db->update('gastos_categorias', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function update_subcategoria_gastos($id, $descripcion, $selectCategoria)
    {
        $values = array(
            'idCategoriaGasto' => $selectCategoria,
            'descripcion' => $descripcion
        );
        $this->db->where('idSubCatGasto', $id);
        $result = $this->db->update('gastos_subcategorias', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function update_categoria_compras($id, $descripcion)
    {
        $values = array(
            'descripcion' => $descripcion
        );
        $this->db->where('idCategoriaCompras', $id);
        $result = $this->db->update('categorias_compras', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function update_abono_vtas_creadas_by_idGenAbono($idGenAbono, $vtasCreadas)
    {
        $values = array(
            'ventasCreadas' => $vtasCreadas
        );
        $this->db->where('idGenAbono', $idGenAbono);
        $result = $this->db->update('abonos', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function update_reset_monoto_ingreso($idGenIngreso, $monto)
    {
        $values = array(
            'aCobrar' => $monto
        );
        $this->db->where('idGenIngreso', $idGenIngreso);
        $result = $this->db->update('ingresos', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function delete_categoria_ventas($id)
    {
        $this->db->delete('categorias_ventas', array('idCategoriaVentas' => $id));

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function delete_subcategoria_ventas($id)
    {
        $this->db->delete('categorias_subcategorias_venta_detalle', array('idSubcategoriaVenta' => $id));

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function delete_subcategoria_ventas_by_idCategoriaVenta($id)
    {
        $this->db->delete('categorias_subcategorias_venta_detalle', array('IdCategoriaVentaDetalle' => $id));

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function delete_subcategoria_ventas_by_idSubCategoriaVenta($id)
    {
        $this->db->delete('categorias_subcategorias_venta_detalle', array('idSubcategoriaVenta' => $id));

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function delete_categoria_compras($id)
    {
        $this->db->delete('categorias_compras', array('idCategoriaCompras' => $id));

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function delete_categoria_gastos($id)
    {
        $this->db->delete('gastos_categorias', array('idCategoriaGasto' => $id));

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function delete_subcategoria_gastos($id)
    {
        $this->db->delete('gastos_subcategorias', array('idSubCatGasto' => $id));

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function delete_subcategoria_gastos_by_idcatgasto($id)
    {
        $this->db->delete('gastos_subcategorias', array('idCategoriaGasto' => $id));

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function get_factura_idGenIngreso($idGenIngreso)
    {
        $this->db->select('*');
        $this->db->where('idGenIngreso', $idGenIngreso);
        $this->db->from('facturas');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_factura_tipos()
    {
        $this->db->select('*');
        $this->db->from('factura_tipos');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_documentos_tipos()
    {
        $this->db->select('*');
        $this->db->from('documentos_tipos');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_iva_condiciones()
    {
        $this->db->select('*');
        $this->db->from('iva_condiciones');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_iva_tipos()
    {
        $this->db->select('*');
        $this->db->from('iva_tipos');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function check_abono_by_idGenAbono($idGenAbono)
    {
        $this->db->where('idGenAbono', $idGenAbono);
        $result = $this->db->get('abonos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_comprobantes_tipos()
    {
        $this->db->select('*');
        $this->db->from('comprobantes_tipos');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function insert_abono(
        $idGenAbono,
        $fechaPrimerVenta,
        $fechaVtoCobro,
        $idAbonoModalidad,
        $fechaFinalizacionAbono,
        $idEstado,
        $idVendedor,
        $idCliente,
        $fechaInicioAbono,
        $fechaEmision,
        $fechaCobro,
        $tipoFactura,
        $idCategoria,
        $idSubcategoriaVenta,
        $notaCliente,
        $notaInterna,
        $importeNoGravado, //importeNoGravado
        $totalVenta, //totalVenta
        $descuentoTotal, //descuentoTotal
        $descuentoCliente, //descuentoCliente
        $ivaTotal, //ivaTotal
        $fechaInicioServicio, //fechaInicioServicio
        $fechaFinServicio //fechaFinServicio
    ) {
        $values = array(
            'idGenAbono' => $idGenAbono,
            'fechaPrimerVenta' => $fechaPrimerVenta,
            'fechaVencimientoCobro' => $fechaVtoCobro,
            'idAbonoModalidad' => $idAbonoModalidad,
            'fechaFinalizacion' => $fechaFinalizacionAbono,
            'idEstado' => $idEstado,
            'idVendedor' => $idVendedor,
            'idCliente' => $idCliente,
            'fechaInicioAbono' => $fechaInicioAbono,
            'fechaEmision' => $fechaEmision,
            'fechaVtoCobro' => $fechaCobro,
            'tipoFactura' => $tipoFactura,
            'idCategoria' => $idCategoria,
            'idSubcategoriaVenta' => $idSubcategoriaVenta,
            'notaCliente' => $notaCliente,
            'notaInterna' => $notaInterna,
            'importeNetoNoGravado' => $importeNoGravado,
            'total' => $totalVenta,
            'descuentoTotal' => $descuentoTotal,
            'descuentoCliente' => $descuentoCliente,
            'ivaTotal' => $ivaTotal,
            'fechaInicioServicio' => $fechaInicioServicio,
            'fechaFinServicio' => $fechaFinServicio
        );
        $result = $this->db->insert('abonos', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function update_abono(
        $idGenAbono,
        $fechaPrimerVenta,
        $fechaVtoCobro,
        $idAbonoModalidad,
        $fechaFinalizacionAbono,
        $idEstado,
        $idVendedor,
        $idCliente,
        $fechaInicioAbono,
        $fechaEmision,
        $fechaCobro,
        $tipoFactura,
        $idCategoria,
        $idSubcategoriaVenta,
        $notaCliente,
        $notaInterna,
        $importeNoGravado,
        $totalVenta,
        $descuentoTotal,
        $descuentoCliente,
        $ivaTotal,
        $fechaInicioServicio,
        $fechaFinServicio
    ) {
        $values = array(
            'fechaPrimerVenta' => $fechaPrimerVenta,
            'fechaVencimientoCobro' => $fechaVtoCobro,
            'idAbonoModalidad' => $idAbonoModalidad,
            'fechaFinalizacion' => $fechaFinalizacionAbono,
            'idEstado' => $idEstado,
            'idVendedor' => $idVendedor,
            'idCliente' => $idCliente,
            'fechaInicioAbono' => $fechaInicioAbono,
            'fechaEmision' => $fechaEmision,
            'fechaVtoCobro' => $fechaCobro,
            'tipoFactura' => $tipoFactura,
            'idCategoria' => $idCategoria,
            'idSubcategoriaVenta' => $idSubcategoriaVenta,
            'notaCliente' => $notaCliente,
            'notaInterna' => $notaInterna,
            'importeNetoNoGravado' => $importeNoGravado,
            'total' => $totalVenta,
            'descuentoTotal' => $descuentoTotal,
            'descuentoCliente' => $descuentoCliente,
            'ivaTotal' => $ivaTotal,
            'fechaInicioServicio' => $fechaInicioServicio,
            'fechaFinServicio' => $fechaFinServicio
        );
        $this->db->where('idGenAbono', $idGenAbono);
        $result = $this->db->update('abonos', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function insert_log_abono($idGenAbono)
    {
        $values = array(
            'idGenAbono' => $idGenAbono
        );
        $result = $this->db->insert('abonos_logs', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function insert_ingreso(
        $idGenIngreso,
        $idGenAbono,
        $tipoIngreso,
        $idVendedor,
        $selectCliente,
        $fechaEmision,
        $fechaCobro,
        $selectTipoFac,
        $selectCatVenta,
        $notaCliente,
        $notaInterna,
        $importeNoGravado,
        $totalVenta,
        $descuentoTotal,
        $descuentoCliente,
        $ivaTotal,
        $selectSubCategoriaVenta,
        $razonSocial,
        $idGenPresupuesto,
        $aCobrar,
        $saldado,
        $idEstado,
        $fechaInicioServicio,
        $fechaFinServicio
    ) {
        $values = array(
            'idGenIngreso' => $idGenIngreso,
            'idGenAbono' => $idGenAbono,
            'idGenPresupuesto' => $idGenPresupuesto,
            'idTipoIngreso' => $tipoIngreso,
            'idVendedor' => $idVendedor,
            'idCliente' => $selectCliente,
            'fechaEmision' => $fechaEmision,
            'fechaVtoCobro' => $fechaCobro,
            'tipoFactura' => $selectTipoFac,
            'idCategoria' => $selectCatVenta,
            'notaCliente' => $notaCliente,
            'notaInterna' => $notaInterna,
            'importeNetoNoGravado' => $importeNoGravado,
            'total' => $totalVenta,
            'descuentoTotal' => $descuentoTotal,
            'descuentoCliente' => $descuentoCliente,
            'ivaTotal' => $ivaTotal,
            'idSubcategoriaVenta' => $selectSubCategoriaVenta,
            'idRazonSocial' => $razonSocial,
            'aCobrar' => $aCobrar,
            'saldado' => $saldado,
            'idEstado' => $idEstado,
            'fechaInicioServicio' => $fechaInicioServicio,
            'fechaFinServicio' => $fechaFinServicio
        );
        $result = $this->db->insert('ingresos', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Agregamos un nuevo egreso/compra
     * @param type $idGenEgreso
     * @param type $tipoEgreso
     * @param type $idVendedor
     * @param type $selectProveedor
     * @param type $fechaEmision
     * @param type $fechaPago
     * @param type $selectTipoFactCompra
     * @param type $selectCategoriaCompra
     * @param type $notaInterna
     * @param type $totalNoGravado
     * @param type $total
     * @param type $descTotal
     * @param type $totalIva
     * @param type $idSubCategoriaCompra
     * @param type $idCategoriaCompraDetalle
     * @param type $aPagar
     * @param type $saldado
     * @param type $idEstado
     * @return type
     */
    public function insert_compra(
        $idGenEgreso,
        $tipoEgreso, //Compra
        $idVendedor,
        $selectProveedor,
        $fechaEmision,
        $fechaPago,
        $selectTipoFactCompra,
        $selectCategoriaCompra,
        $notaInterna,
        $totalNoGravado,
        $total,
        $descTotal,
        $descProveedor,
        $totalIva,
        $razonSocial,
        $aPagar, //aPagar
        $saldado,
        $idEstado
    ) {
        $values = array(
            'idGenEgreso' => $idGenEgreso,
            'idTipoEgreso' => $tipoEgreso,
            'idVendedor' => $idVendedor,
            'idProveedor' => $selectProveedor,
            'fechaEmision' => $fechaEmision,
            'fechaVtoPago' => $fechaPago,
            'tipoFactura' => $selectTipoFactCompra,
            'idCategoriaGasto' => $selectCategoriaCompra,
            'notaInterna' => $notaInterna,
            'importeNetoNoGravado' => $totalNoGravado,
            'total' => $total,
            'descuentoTotal' => $descTotal,
            'descuentoProveedor' => $descProveedor,
            'ivaTotal' => $totalIva,
            'idRazonSocial' => $razonSocial,
            'aPagar' => $aPagar,
            'saldado' => $saldado,
            'idEstado' => $idEstado
        );
        $result = $this->db->insert('egresos', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Actualizacion de un egreso/compra
     * @param type $idGenEgreso
     * @param type $tipoEgreso
     * @param type $idVendedor
     * @param type $selectProveedor
     * @param type $fechaEmision
     * @param type $fechaPago
     * @param type $selectTipoFactCompra
     * @param type $selectCategoriaCompra
     * @param type $notaInterna
     * @param type $totalNoGravado
     * @param type $total
     * @param type $descTotal
     * @param type $totalIva
     * @param type $idSubCategoriaCompra
     * @param type $idCategoriaCompraDetalle
     * @param type $aPagar
     * @param type $saldado
     * @param type $idEstado
     * @return type
     */
    public function update_egreso(
        $idGenEgreso,
        $tipoEgreso,
        $idVendedor,
        $selectProveedor,
        $fechaEmision,
        $fechaPago,
        $selectTipoFactCompra,
        $selectCategoriaCompra,
        $notaInterna,
        $totalNoGravado,
        $total,
        $descTotal,
        $descProveedor,
        $totalIva,
        $razonSocial,
        $aPagar,
        $saldado,
        $idEstado
    ) {
        $values = array(
            'idTipoEgreso' => $tipoEgreso,
            'idVendedor' => $idVendedor,
            'idProveedor' => $selectProveedor,
            'fechaEmision' => $fechaEmision,
            'fechaVtoPago' => $fechaPago,
            'tipoFactura' => $selectTipoFactCompra,
            'idCategoriaGasto' => $selectCategoriaCompra,
            'notaInterna' => $notaInterna,
            'importeNetoNoGravado' => $totalNoGravado,
            'total' => $total,
            'descuentoTotal' => $descTotal,
            'descuentoProveedor' => $descProveedor,
            'ivaTotal' => $totalIva,
            'idRazonSocial' => $razonSocial,
            'aPagar' => $aPagar,
            'saldado' => $saldado,
            'idEstado' => $idEstado
        );
        $this->db->where('idGenEgreso', $idGenEgreso);
        $result = $this->db->update('egresos', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Guardamos una nueva cuenta corriente
     * @param type $idGenIngreso
     * @param type $idGenComprobante
     * @param type $idCliente
     * @param type $fechaCobro
     * @param type $debito
     * @param type $credito
     * @param type $idMedioCobro
     * @param type $saldo
     * @param type $descripcionCobro
     * @return type
     */
    public function insert_cuenta_corriente(
        $idGenIngreso,
        $idGenComprobante,
        $idCliente, //selectCliente
        $fechaCobro, //fechaCobro
        $debito, //Los movimientos que generan la deuda del cliente. Lo que le DEBE a la EMPRESA
        $credito, //Los movimientos que se ACREDITAN en la EMPRESA.Los pagos que realizan el cliente
        $idMedioCobro, //Medio de cobro
        $saldo, //Saldo
        $descripcionCobro
    ) {
        $values = array(
            'idGenIngreso' => $idGenIngreso,
            'idGenComprobante' => $idGenComprobante,
            'idCliente' => $idCliente,
            'fechaCobro' => $fechaCobro,
            'debito' => $debito,
            'credito' => $credito,
            'idMedioCobro' => $idMedioCobro,
            'saldo' => $saldo,
            'descripcion' => $descripcionCobro
        );
        $result = $this->db->insert('clientes_cuenta_corriente', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Agregamos una nueva cuenta corriente con el idGenNota
     * @param type $idGenIngreso
     * @param type $idGenNota
     * @param type $idGenComprobante
     * @param type $idCliente
     * @param type $fechaCobro
     * @param type $debito
     * @param type $credito
     * @param type $idMedioCobro
     * @param type $saldo
     * @param type $descripcionCobro
     * @return type
     */
    public function insert_cuenta_corriente_idGenNota(
        $idGenIngreso,
        $idGenNota,
        $idGenComprobante,
        $idCliente, //selectCliente
        $fechaCobro, //fechaCobro
        $debito, //Los movimientos que generan la deuda del cliente. Lo que le DEBE a la EMPRESA
        $credito, //Los movimientos que se ACREDITAN en la EMPRESA.Los pagos que realizan el cliente
        $idMedioCobro, //Medio de cobro
        $saldo, //Saldo
        $descripcionCobro
    ) {
        $values = array(
            'idGenIngreso' => $idGenIngreso,
            'idGenNota' => $idGenNota,
            'idGenComprobante' => $idGenComprobante,
            'idCliente' => $idCliente,
            'fechaCobro' => $fechaCobro,
            'debito' => $debito,
            'credito' => $credito,
            'idMedioCobro' => $idMedioCobro,
            'saldo' => $saldo,
            'descripcion' => $descripcionCobro
        );
        $result = $this->db->insert('clientes_cuenta_corriente', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Actualizamos la cuenta corriente correspondiente al idGenNota
     * @param type $idGenNota
     * @param type $idCliente
     * @param type $debito
     * @param type $credito
     * @param type $saldo
     * @return type
     */
    public function update_cuenta_corrientes_by_idGenNota_ordenAsc_limit1(
        $idGenNota,
        $idCliente,
        $debito,
        $credito,
        $saldo
    ) {
        $values = array(
            'idCliente' => $idCliente,
            'debito' => $debito,
            'credito' => $credito,
            'saldo' => $saldo
        );
        $this->db->where('idGenNota', $idGenNota);
        $this->db->order_by('fechaAlta', 'ASC');
        $this->db->limit(1);
        $result = $this->db->update('clientes_cuenta_corriente', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function update_cuenta_corrientes_proveedores_by_idGenNota_ordenAsc_limit1(
        $idGenNota,
        $idProveedor,
        $aPagar,
        $pague,
        $saldo
    ) {
        $values = array(
            'idProveedor' => $idProveedor,
            'aPagar' => $aPagar,
            'pague' => $pague,
            'saldo' => $saldo
        );
        $this->db->where('idGenNota', $idGenNota);
        $this->db->order_by('fechaAlta', 'ASC');
        $this->db->limit(1);
        $result = $this->db->update('proveedores_cuenta_corriente', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Borramos la cuenta corriente asociada al idGenNota
     * @param type $idGenNota
     * @return type
     */
    public function drop_cuenta_corrientes_by_idGenNota($idGenNota)
    {
        $values = array(
            'eliminado' => 1,
        );
        $this->db->where('idGenNota', $idGenNota);
        $result = $this->db->update('clientes_cuenta_corriente', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Borramos la cuenta corriente asociada al idGenNota
     * @param type $idGenNota
     * @return type
     */
    public function drop_cuenta_corrientes_proveedor_by_idGenNota($idGenNota)
    {
        $values = array(
            'eliminado' => 1,
        );
        $this->db->where('idGenNota', $idGenNota);
        $result = $this->db->update('proveedores_cuenta_corriente', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function insert_cuenta_corriente_proveedores(
        $idGenEgreso,
        $idGenComprobante,
        $selectProveedor, //selectCliente
        $fechaPagoCuentaCorriente, //fechaCobro
        $aPagar,
        $pague,
        $idMedioPago, //Medio de cobro
        $saldo, //Medio de cobro
        $descripcionPago
    ) {
        $values = array(
            'idGenEgreso' => $idGenEgreso,
            'idGenComprobante' => $idGenComprobante,
            'idProveedor' => $selectProveedor,
            'fechaPago' => $fechaPagoCuentaCorriente,
            'aPagar' => $aPagar,
            'pague' => $pague,
            'idMedioPago' => $idMedioPago,
            'saldo' => $saldo,
            'descripcion' => $descripcionPago
        );
        $result = $this->db->insert('proveedores_cuenta_corriente', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     *
     * @param type $idGenEgreso
     * @param type $idGenComprobante
     * @param type $idGenNota
     * @param type $selectProveedor
     * @param type $fechaPagoCuentaCorriente
     * @param type $aPagar
     * @param type $pague
     * @param type $idMedioPago
     * @param type $saldo
     * @param type $descripcionPago
     * @return type
     */
    public function insert_cuenta_corriente_proveedores_idGenNota(
        $idGenEgreso,
        $idGenComprobante,
        $idGenNota,
        $selectProveedor, //selectCliente
        $fechaPagoCuentaCorriente, //fechaCobro
        $aPagar,
        $pague,
        $idMedioPago, //Medio de cobro
        $saldo, //Medio de cobro
        $descripcionPago
    ) {
        $values = array(
            'idGenEgreso' => $idGenEgreso,
            'idGenComprobante' => $idGenComprobante,
            'idGenNota' => $idGenNota,
            'idProveedor' => $selectProveedor,
            'fechaPago' => $fechaPagoCuentaCorriente,
            'aPagar' => $aPagar,
            'pague' => $pague,
            'idMedioPago' => $idMedioPago,
            'saldo' => $saldo,
            'descripcion' => $descripcionPago
        );
        $result = $this->db->insert('proveedores_cuenta_corriente', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Insertar un nuevo ingreso_egreso de caja
     * @param type $idCaja
     * @param type $idGenEgresoPagar
     * @param type $ingreso
     * @param type $egreso
     * @param type $descripcionMovimiento
     * @param type $idGenMovimiento
     * @param type $idTipo
     * @return type
     */
    public function insert_ingreso_egreso_caja(
        $idCaja,
        $idGenEgresoPagar,
        $ingreso,
        $egreso,
        $descripcionMovimiento,
        $idGenMovimiento,
        $idTipo
    ) {
        $values = array(
            'idCuenta' => $idCaja,
            'idGenIngEgGasto' => $idGenEgresoPagar,
            'ingreso' => $ingreso,
            'egreso' => $egreso,
            'descripcion' => $descripcionMovimiento,
            'idGenMovimiento' => $idGenMovimiento,
            'idTipo' => $idTipo
        );
        $result = $this->db->insert('cajas_ingresos_egresos', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function insert_ingreso_egreso_caja_con_saldo_actual(
        $idCaja,
        $idGenEgresoPagar,
        $ingreso,
        $egreso,
        $descripcionMovimiento,
        $idGenMovimiento,
        $idTipo,
        $saldoActual
    ) {
        $values = array(
            'idCuenta' => $idCaja,
            'idGenIngEgGasto' => $idGenEgresoPagar,
            'ingreso' => $ingreso,
            'egreso' => $egreso,
            'descripcion' => $descripcionMovimiento,
            'idGenMovimiento' => $idGenMovimiento,
            'idTipo' => $idTipo,
            'saldoActual' => $saldoActual
        );
        $result = $this->db->insert('cajas_ingresos_egresos', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Actualizacion de ingreso_egreso caja
     * @param type $idCaja
     * @param type $idGenEgresoPagar
     * @param type $ingreso
     * @param type $egreso
     * @param type $descripcionMovimiento
     * @param type $idGenMovimiento
     * @param type $idTipo
     * @return type
     */
    public function update_ingreso_egreso_caja(
        $idCaja,
        $idGenEgresoPagar,
        $ingreso,
        $egreso,
        $descripcionMovimiento,
        $idGenMovimiento,
        $idTipo
    ) {
        $values = array(
            'idCuenta' => $idCaja,
            'ingreso' => $ingreso,
            'egreso' => $egreso,
            'descripcion' => $descripcionMovimiento,
            'idGenMovimiento' => $idGenMovimiento,
            'idTipo' => $idTipo
        );
        $this->db->where('idGenIngEgGasto', $idGenEgresoPagar);
        $result = $this->db->update('cajas_ingresos_egresos', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Insertar un nuevo gasto
     * @param type $idVendedor
     * @param type $idGenGasto
     * @param type $idEstado
     * @param type $fechaGasto
     * @param type $montoGasto
     * @param type $selectCatGasto
     * @param type $selectSubCatGasto
     * @param type $selectMedioPago
     * @param type $descripcionGasto
     * @param type $selectCatGastoGeneral
     * @param type $nombreImg
     * @param type $selectTipoFactura
     * @return type
     */
    public function insert_gasto($idVendedor, $idGenGasto, $idEstado, $fechaGasto, $montoGasto, $selectCatGasto, $selectSubCatGasto, $selectMedioPago, $descripcionGasto, $nombreImg, $selectTipoFactura, $inputFechaVtoGasto)
    {
        $values = array(
            'idUsuario' => $idVendedor,
            'idGenGasto' => $idGenGasto,
            'idEstado' => $idEstado,
            'fechaGasto' => $fechaGasto,
            'montoGasto' => $montoGasto,
            'idCategoria' => $selectCatGasto,
            'idSubCategoria' => $selectSubCatGasto,
            'idMedioPago' => $selectMedioPago,
            'descripcionGasto' => $descripcionGasto,
            'nombreImg' => $nombreImg,
            "idTipoFactura" => $selectTipoFactura,
            "fechaVtoGasto" => $inputFechaVtoGasto
        );
        $result = $this->db->insert('gastos', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /*
     * Actualizamos los datos del gasto
     * @param type $idVendedor
     * @param type $idGenGasto
     * @param type $idEstado
     * @param type $fechaGasto
     * @param type $montoGasto
     * @param type $selectCatGasto
     * @param type $selectSubCatGasto
     * @param type $selectMedioPago
     * @param type $descripcionGasto
     * @param type $selectCatGastoGeneral
     * @param type $nombreImg
     * @param type $selectTipoFactura
     * @return type
    **/
    public function update_gasto($idVendedor, $idGenGasto, $idEstado, $fechaGasto, $montoGasto, $selectCatGasto, $selectSubCatGasto, $selectMedioPago, $descripcionGasto, $nombreImg, $selectTipoFactura, $inputFechaVtoGasto)
    {
        $values = array(
            'idUsuario' => $idVendedor,
            'idEstado' => $idEstado,
            'fechaGasto' => $fechaGasto,
            'montoGasto' => $montoGasto,
            'idCategoria' => $selectCatGasto,
            'idSubCategoria' => $selectSubCatGasto,
            'idMedioPago' => $selectMedioPago,
            'descripcionGasto' => $descripcionGasto,
            'nombreImg' => $nombreImg,
            "idTipoFactura" => $selectTipoFactura,
            "fechaVtoGasto" => $inputFechaVtoGasto
        );
        $this->db->where('idGenGasto', $idGenGasto);
        $result = $this->db->update('gastos', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /*
     * Actualizamos el estado del gasto correspondiente al idGen
     * @param type $idGenGasto
     * @param type $idEstado
     * @return type
    **/
    public function update_gasto_estado($idGenGasto, $idEstado)
    {
        $values = array(
            'idEstado' => $idEstado
        );
        $this->db->where('idGenGasto', $idGenGasto);
        $result = $this->db->update('gastos', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    //    public function insert_ingreso(
    //                                $idGenIngreso,
    //                                $tipoIngreso,
    //                                $idVendedor,
    //                                $selectCliente,
    //                                $fechaEmision,
    //                                $fechaCobro,
    //                                $selectTipoFac,
    //                                $selectCatVenta,
    //                                $fechaInicioAbono,
    //                                $duracionAbono,
    //                                $modalidadAbono,
    //                                $notaCliente,
    //                                $notaInterna,
    //                                $importeNoGravado,
    //                                $totalVenta,
    //                                $descuentoTotal,
    //                                $ivaTotal,
    //                                $selectCategoriaVentaDetalle,
    //                                $selectSubCategoriaVenta,
    //                                $aCobrar,
    //                                $saldado,
    //                                $idEstado
    //                            ) {
    //        $values = array(
    //            'idGenIngreso' => $idGenIngreso,
    //            'idTipoIngreso' => $tipoIngreso,
    //            'idVendedor' => $idVendedor,
    //            'idCliente' => $selectCliente,
    //            'fechaEmision' => $fechaEmision,
    //            'fechaVtoCobro' => $fechaCobro,
    //            'tipoFactura' => $selectTipoFac,
    //            'idCategoria' => $selectCatVenta,
    //            'fechaInicioAbono' => $fechaInicioAbono,
    //            'duracionAbono' => $duracionAbono,
    //            'idModalidadAbono' => $modalidadAbono,
    //            'notaCliente' => $notaCliente,
    //            'notaInterna' => $notaInterna,
    //            'importeNetoNoGravado' => $importeNoGravado,
    //            'total' => $totalVenta,
    //            'descuentoTotal' => $descuentoTotal,
    //            'ivaTotal' => $ivaTotal,
    //            'idCategoriaVenta' => $selectCategoriaVentaDetalle,
    //            'idSubcategoriaVenta' => $selectSubCategoriaVenta,
    //            'aCobrar' => $aCobrar,
    //            'saldado' => $saldado,
    //            'idEstado' => $idEstado
    //
    //        );
    //        $result = $this->db->insert('ingresos', $values);
    //
    //        return (($this->db->affected_rows() > 0) ? true : false);
    //    }

    /**
     * Atualizacion del ingreso segun su idGenIngreso
     * @param type $idGenIngreso
     * @param type $tipoIngreso
     * @param type $selectCliente
     * @param type $fechaEmision
     * @param type $fechaCobro
     * @param type $selectTipoFac
     * @param type $selectCatVenta
     * @param type $fechaInicioAbono
     * @param type $duracionAbono
     * @param type $modalidadAbono
     * @param type $notaCliente
     * @param type $notaInterna
     * @param type $importeNoGravado
     * @param type $totalVenta
     * @param type $descuentoTotal
     * @param type $ivaTotal
     * @param type $selectCategoriaVentaDetalle
     * @param type $selectSubCategoriaVenta
     * @param type $aCobrar
     * @param type $saldado
     * @param type $idEstado
     * @return type
     */
    public function update_ingreso(
        $idGenIngreso,
        $tipoIngreso,
        $selectCliente,
        $fechaEmision,
        $fechaCobro,
        $selectTipoFac,
        $selectCatVenta,
        $fechaInicioAbono,
        $duracionAbono,
        $modalidadAbono,
        $notaCliente,
        $notaInterna,
        $importeNoGravado,
        $totalVenta,
        $descuentoTotal,
        $descuentoCliente,
        $ivaTotal,
        $selectSubCategoriaVenta,
        $razonSocial,
        $aCobrar,
        $saldado,
        $idEstado,
        $fechaInicioServicio,
        $fechaFinServicio
    ) {
        $values = array(
            'idTipoIngreso' => $tipoIngreso,
            'idCliente' => $selectCliente,
            'fechaEmision' => $fechaEmision,
            'fechaVtoCobro' => $fechaCobro,
            'tipoFactura' => $selectTipoFac,
            'idCategoria' => $selectCatVenta,
            'notaCliente' => $notaCliente,
            'notaInterna' => $notaInterna,
            'importeNetoNoGravado' => $importeNoGravado,
            'total' => $totalVenta,
            'descuentoTotal' => $descuentoTotal,
            'descuentoCliente' => $descuentoCliente,
            'ivaTotal' => $ivaTotal,
            'idSubcategoriaVenta' => $selectSubCategoriaVenta,
            'idRazonSocial' => $razonSocial,
            'aCobrar' => $aCobrar,
            'saldado' => $saldado,
            'idEstado' => $idEstado,
            'fechaInicioServicio' => $fechaInicioServicio,
            'fechaFinServicio' => $fechaFinServicio
        );
        $this->db->where('idGenIngreso', $idGenIngreso);
        $result = $this->db->update('ingresos', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Actualizo el ingreso segun su idGenAbono
     * @param type $idGenIngreso
     * @param type $tipoIngreso
     * @param type $selectCliente
     * @param type $fechaEmision
     * @param type $fechaCobro
     * @param type $selectTipoFac
     * @param type $selectCatVenta
     * @param type $fechaInicioAbono
     * @param type $duracionAbono
     * @param type $modalidadAbono
     * @param type $notaCliente
     * @param type $notaInterna
     * @param type $importeNoGravado
     * @param type $totalVenta
     * @param type $descuentoTotal
     * @param type $ivaTotal
     * @param type $selectCategoriaVentaDetalle
     * @param type $selectSubCategoriaVenta
     * @param type $aCobrar
     * @param type $saldado
     * @param type $idEstado
     * @return type
     */
    public function update_ingreso_by_idGenAbono(
        $idGenAbono,
        $tipoIngreso,
        $selectCliente,
        $fechaEmision,
        $fechaCobro,
        $selectTipoFac,
        $selectCatVenta,
        $fechaInicioAbono,
        $duracionAbono,
        $modalidadAbono,
        $notaCliente,
        $notaInterna,
        $importeNoGravado,
        $totalVenta,
        $descuentoTotal,
        $ivaTotal,
        $selectSubCategoriaVenta,
        $aCobrar,
        $saldado
    ) {
        $values = array(
            'idTipoIngreso' => $tipoIngreso,
            'idCliente' => $selectCliente,
            'fechaEmision' => $fechaEmision,
            'fechaVtoCobro' => $fechaCobro,
            'tipoFactura' => $selectTipoFac,
            'idCategoria' => $selectCatVenta,
            //            'fechaInicioAbono' => $fechaInicioAbono,
            //            'duracionAbono' => $duracionAbono,
            //            'idModalidadAbono' => $modalidadAbono,
            'notaCliente' => $notaCliente,
            'notaInterna' => $notaInterna,
            'importeNetoNoGravado' => $importeNoGravado,
            'total' => $totalVenta,
            'descuentoTotal' => $descuentoTotal,
            'ivaTotal' => $ivaTotal,
            'idSubcategoriaVenta' => $selectSubCategoriaVenta,
            'aCobrar' => $aCobrar,
            'saldado' => $saldado
        );
        $this->db->where('idGenAbono', $idGenAbono);
        $result = $this->db->update('ingresos', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Insersion del detalle del ingreso que corresponde al idGenIngreso
     * @param type $idGenIngreso
     * @param type $idProducto
     * @param type $cantidad
     * @param type $precio
     * @param type $descuento
     * @param type $subtotalProd
     * @param type $iva
     * @param type $ivaText
     * @return type
     */
    public function insert_ingreso_detalle(
        $idGenIngreso,
        $idProducto,
        $cantidad,
        $precio,
        $descuento,
        $subtotalProd,
        $iva,
        $ivaText
    ) {
        $values = array(
            'idGenIngresoAbono' => $idGenIngreso,
            'idProducto' => $idProducto,
            'cantidad' => $cantidad,
            'precio' => $precio,
            'descuento' => $descuento,
            'subTotal' => $subtotalProd,
            'iva' => $iva,
            'ivaText' => $ivaText
        );
        $result = $this->db->insert('ingresos_detalle', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function insert_abono_detalle(
        $idGenAbono,
        $idProducto,
        $cantidad,
        $precio,
        $descuento,
        $subtotalProd,
        $iva,
        $ivaText
    ) {
        $values = array(
            'idGenAbono' => $idGenAbono,
            'idProducto' => $idProducto,
            'cantidad' => $cantidad,
            'precio' => $precio,
            'descuento' => $descuento,
            'subTotal' => $subtotalProd,
            'iva' => $iva,
            'ivaText' => $ivaText
        );
        $result = $this->db->insert('abonos_detalle', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function insert_compra_detalle(
        $idGenEgreso,
        $idProducto,
        $cantidad,
        $precio,
        $descuento,
        $subtotalProd,
        $iva,
        $ivaText
    ) {
        $values = array(
            'idGenEgreso' => $idGenEgreso,
            'idProducto' => $idProducto,
            'cantidad' => $cantidad,
            'precio' => $precio,
            'descuento' => $descuento,
            'subTotal' => $subtotalProd,
            'idIva' => $iva,
            'ivaText' => $ivaText
        );
        $result = $this->db->insert('egresos_detalle', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Obtencion de los clientes con sus localidades y provincias pertenecientes
     * @return type
     */
    public function get_razon_social()
    {
        $this->db->select('*');
        $this->db->from('razon_social');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de los clientes con sus localidades y provincias pertenecientes
     * @return type
     */
    public function get_clientes()
    {
        $this->db->select('*');
        $this->db->join('provincias', 'provincias.idProvincia = clientes.idProvincia');
        $this->db->join('localidades', 'localidades.idLocalidad = clientes.idLocalidad');
        $this->db->where('clientes.eliminado', 0);
        $this->db->from('clientes');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion del cliente que corresponda al idGenCliente con su localidad y provincia perteneciente
     * @return type
     */
    public function get_cliente_byIdGen($idGenCliente)
    {
        $this->db->select('*');
        $this->db->join('provincias', 'provincias.idProvincia = clientes.idProvincia');
        $this->db->join('localidades', 'localidades.idLocalidad = clientes.idLocalidad');
        $this->db->where('idGenCliente', $idGenCliente);
        $this->db->where('clientes.eliminado', 0);
        $this->db->from('clientes');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_cliente_byIdCliente($idCliente)
    {
        $this->db->select('*');
        $this->db->join('provincias', 'provincias.idProvincia = clientes.idProvincia');
        $this->db->join('localidades', 'localidades.idLocalidad = clientes.idLocalidad');
        $this->db->where('idCliente', $idCliente);
        $this->db->where('clientes.eliminado', 0);
        $this->db->from('clientes');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_cliente_detalle_ventas_byIdCliente($idGenCliente)
    {
        $this->db->select('*');
        $this->db->where('idGenCliente', $idGenCliente);
        $this->db->from('clientes_detalle_ventas');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_info_cliente_byIdGen($idGenCliente)
    {
        $this->db->select('
                        clientes.idCliente as idCliente, 
                        clientes.idGenCliente as idGenCliente, 
                        clientes.nombEmpresa as nombEmpresa, 
                        clientes.nombre as nombre, 
                        clientes.apellido as apellido, 
                        clientes.tel as tel, 
                        clientes.cel as cel, 
                        clientes.email as email, 
                        clientes.pagWeb as pagWeb, 
                        clientes.domicilio as domicilio, 
                        clientes.apodoMl as apodoMl, 
                        clientes.idLocalidad as idLocalidad, 
                        clientes.idProvincia as idProvincia, 
                        clientes.numero as numero, 
                        clientes.piso as piso, 
                        clientes.dpto as dpto, 
                        clientes.cp as cp, 
                        clientes.nota as nota, 
                        clientes_detalle_ventas.idCategoriaVentas as idCategoriaVentas, 
                        clientes_detalle_ventas.idListaPrecios as idListaPrecios, 
                        clientes_detalle_ventas.dtoGeneral as dtoGeneral, 
                        clientes_detalle_ventas.notaCliente as notaCliente, 
                        clientes_detalle_facturacion.razonSocial as razonSocial, 
                        clientes_detalle_facturacion.idTipoDoc as idTipoDoc, 
                        clientes_detalle_facturacion.cuit as cuit, 
                        clientes_detalle_facturacion.idCondIva as idCondIva, 
                        clientes_detalle_facturacion.idComprobante as idComprobante, 
                        clientes_detalle_facturacion.tel as telFacturacion, 
                        clientes_detalle_facturacion.cel as celFacturacion, 
                        clientes_detalle_facturacion.domicilio as domicilioFacturacion, 
                        clientes_detalle_facturacion.idLocalidad as idLocalidadFacturacion, 
                        clientes_detalle_facturacion.idProvincia as idProvinciaFacturacion, 
                        clientes_detalle_facturacion.cp as cpFacturacion, 
                    ');
        $this->db->join('clientes_detalle_ventas', 'clientes_detalle_ventas.idGenCliente = clientes.idGenCliente');
        $this->db->join('clientes_detalle_facturacion', 'clientes_detalle_facturacion.idGenCliente = clientes.idGenCliente');
        $this->db->where('clientes.idGenCliente', $idGenCliente);
        $this->db->where('clientes.eliminado', 0);
        $this->db->from('clientes');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function insert_cliente(
        $idGenCliente,
        $idUsuario,
        $inputCliente,
        $inputNombre,
        $inputApellido,
        $inputNumTel,
        $inputNumCel,
        $inputCorreo,
        $inputWeb,
        $inputDomicilio,
        $inputApodoML,
        $selectLocalidad,
        $selectProvincia,
        $inputNumDir,
        $inputPiso,
        $inputDpto,
        $inputCodPostal,
        $inputNota
    ) {
        $values = array(
            'idGenCliente' => $idGenCliente,
            'idUsuario' => $idUsuario,
            'nombEmpresa' => $inputCliente,
            'nombre' => $inputNombre,
            'apellido' => $inputApellido,
            'tel' => $inputNumTel,
            'cel' => $inputNumCel,
            'email' => $inputCorreo,
            'pagWeb' => $inputWeb,
            'domicilio' => $inputDomicilio,
            'apodoMl' => $inputApodoML,
            'idLocalidad' => $selectLocalidad,
            'idProvincia' => $selectProvincia,
            'numero' => $inputNumDir,
            'piso' => $inputPiso,
            'dpto' => $inputDpto,
            'cp' => $inputCodPostal,
            'nota' => $inputNota,
        );
        $result = $this->db->insert('clientes', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function update_cliente(
        $idGenCliente,
        $idUsuario,
        $inputCliente,
        $inputNombre,
        $inputApellido,
        $inputNumTel,
        $inputNumCel,
        $inputCorreo,
        $inputWeb,
        $inputDomicilio,
        $inputApodoML,
        $selectLocalidad,
        $selectProvincia,
        $inputNumDir,
        $inputPiso,
        $inputDpto,
        $inputCodPostal,
        $inputNota
    ) {
        $values = array(
            'idUsuario' => $idUsuario,
            'nombEmpresa' => $inputCliente,
            'nombre' => $inputNombre,
            'apellido' => $inputApellido,
            'tel' => $inputNumTel,
            'cel' => $inputNumCel,
            'email' => $inputCorreo,
            'pagWeb' => $inputWeb,
            'domicilio' => $inputDomicilio,
            'apodoMl' => $inputApodoML,
            'idLocalidad' => $selectLocalidad,
            'idProvincia' => $selectProvincia,
            'numero' => $inputNumDir,
            'piso' => $inputPiso,
            'dpto' => $inputDpto,
            'cp' => $inputCodPostal,
            'nota' => $inputNota,
        );

        $this->db->where('idGenCliente', $idGenCliente);
        $result = $this->db->update('clientes', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function insert_cliente_detalle_venta(
        $idGenCliente,
        $idUsuario,
        $selectCatVentas,
        $inputDtoGeneral,
        $inputNotaCliente
    ) {
        $values = array(
            'idGenCliente' => $idGenCliente,
            'idUsuario' => $idUsuario,
            'idCategoriaVentas' => $selectCatVentas,
            'dtoGeneral' => $inputDtoGeneral,
            'notaCliente' => $inputNotaCliente
        );
        $result = $this->db->insert('clientes_detalle_ventas', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function update_cliente_detalle_venta(
        $idGenCliente,
        $idUsuario,
        $selectCatVentas,
        $inputDtoGeneral,
        $inputNotaCliente
    ) {
        $values = array(
            'idUsuario' => $idUsuario,
            'idCategoriaVentas' => $selectCatVentas,
            'dtoGeneral' => $inputDtoGeneral,
            'notaCliente' => $inputNotaCliente
        );

        $this->db->where('idGenCliente', $idGenCliente);
        $result = $this->db->update('clientes_detalle_ventas', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function insert_cliente_detalle_facturacion(
        $idGenCliente,
        $idUsuario,
        $inputRazonSocial,
        $selectTipoDoc,
        $inputNumDoc,
        $selectCondIva,
        $selectCompTipo,
        $inputNumTelFac,
        $inputNumCelFac,
        $inputDomicilioFiscal,
        $selectLocalidadFac,
        $selectProvinciaFac,
        $inputCodPostalFac
    ) {
        $values = array(
            'idGenCliente' => $idGenCliente,
            'idUsuario' => $idUsuario,
            'razonSocial' => $inputRazonSocial,
            'idTipoDoc' => $selectTipoDoc,
            'cuit' => $inputNumDoc,
            'idCondIva' => $selectCondIva,
            'idComprobante' => $selectCompTipo,
            'tel' => $inputNumTelFac,
            'cel' => $inputNumCelFac,
            'domicilio' => $inputDomicilioFiscal,
            'idLocalidad' => $selectLocalidadFac,
            'idProvincia' => $selectProvinciaFac,
            'cp' => $inputCodPostalFac
        );
        $result = $this->db->insert('clientes_detalle_facturacion', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function update_cliente_detalle_facturacion(
        $idGenCliente,
        $idUsuario,
        $inputRazonSocial,
        $selectTipoDoc,
        $inputNumDoc,
        $selectCondIva,
        $selectCompTipo,
        $inputNumTelFac,
        $inputNumCelFac,
        $inputDomicilioFiscal,
        $selectLocalidadFac,
        $selectProvinciaFac,
        $inputCodPostalFac
    ) {
        $values = array(
            'idUsuario' => $idUsuario,
            'razonSocial' => $inputRazonSocial,
            'idTipoDoc' => $selectTipoDoc,
            'cuit' => $inputNumDoc,
            'idCondIva' => $selectCondIva,
            'idComprobante' => $selectCompTipo,
            'tel' => $inputNumTelFac,
            'cel' => $inputNumCelFac,
            'domicilio' => $inputDomicilioFiscal,
            'idLocalidad' => $selectLocalidadFac,
            'idProvincia' => $selectProvinciaFac,
            'cp' => $inputCodPostalFac
        );

        $this->db->where('idGenCliente', $idGenCliente);
        $result = $this->db->update('clientes_detalle_facturacion', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function update_ingreso_monto($idGenIngreso, $valor)
    {
        $values = array(
            'aCobrar' => $valor
        );

        $this->db->where('idGenIngreso', $idGenIngreso);
        $result = $this->db->update('ingresos', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function eliminar_cliente($idGenCliente)
    {
        $values = array(
            'eliminado' => 1
        );

        $this->db->where('idGenCliente', $idGenCliente);
        $result = $this->db->update('clientes', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function eliminar_cliente_detalle_venta($idGenCliente)
    {
        $this->db->delete('clientes_detalle_ventas', array('idGenCliente' => $idGenCliente));

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function eliminar_cliente_detalle_facturacion($idGenCliente)
    {
        $this->db->delete('clientes_detalle_facturacion', array('idGenCliente' => $idGenCliente));

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Obtencion de todos los proveedores
     * @return type
     */
    public function get_proveedores()
    {
        $this->db->select('*');
        $this->db->join('provincias', 'provincias.idProvincia = proveedores.idProvincia');
        $this->db->join('localidades', 'localidades.idLocalidad = proveedores.idLocalidad');
        $this->db->where('proveedores.eliminado', 0);
        $this->db->from('proveedores');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de un proveedor por medio de su idGenProveedor con todos los datos correspondientes por medio de sus join
     * @param type $idGenProveedor
     * @return type
     */
    public function get_proveedor_detalle_compra($idGenProveedor)
    {
        $this->db->select('*');
        $this->db->where('idGenProveedor', $idGenProveedor);
        $this->db->from('proveedores_detalle_compras');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_proveedor_byIdGen($idGenProveedor)
    {
        $this->db->select('*');
        $this->db->join('provincias', 'provincias.idProvincia = proveedores.idProvincia');
        $this->db->join('localidades', 'localidades.idLocalidad = proveedores.idLocalidad');
        $this->db->where('idGenProveedor', $idGenProveedor);
        $this->db->where('proveedores.eliminado', 0);
        $this->db->from('proveedores');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de un proveedor filtrado por su id con todos los datos correspondientes por medio de sus join
     * @param type $idProveedor
     * @return type
     */
    public function get_proveedor_byId($idProveedor)
    {
        $this->db->select('*');
        $this->db->join('provincias', 'provincias.idProvincia = proveedores.idProvincia');
        $this->db->join('localidades', 'localidades.idLocalidad = proveedores.idLocalidad');
        $this->db->where('idProveedor', $idProveedor);
        $this->db->where('proveedores.eliminado', 0);
        $this->db->from('proveedores');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_info_proveedor_byIdGen($idGenProveedor)
    {
        $this->db->select('
                        proveedores.idProveedor as idProveedor, 
                        proveedores.idGenProveedor as idGenProveedor, 
                        proveedores.nombEmpresa as nombEmpresa, 
                        proveedores.nombre as nombre, 
                        proveedores.apellido as apellido, 
                        proveedores.tel as tel, 
                        proveedores.cel as cel, 
                        proveedores.email as email, 
                        proveedores.pagWeb as pagWeb, 
                        proveedores.domicilio as domicilio, 
                        proveedores.idLocalidad as idLocalidad, 
                        proveedores.idProvincia as idProvincia, 
                        proveedores.numero as numero, 
                        proveedores.piso as piso, 
                        proveedores.dpto as dpto, 
                        proveedores.cp as cp, 
                        proveedores.nota as nota, 
                        proveedores_detalle_compras.idCategoriaCompras as idCategoriaCompras, 
                        proveedores_detalle_compras.dtoGeneral as dtoGeneral, 
                        proveedores_detalle_compras.notaInterna as notaInterna, 
                        proveedores_detalle_facturacion.razonSocial as razonSocial, 
                        proveedores_detalle_facturacion.idTipoDoc as idTipoDoc, 
                        proveedores_detalle_facturacion.cuit as cuit, 
                        proveedores_detalle_facturacion.idCondIva as idCondIva, 
                        proveedores_detalle_facturacion.idComprobante as idComprobante, 
                        proveedores_detalle_facturacion.tel as telFacturacion, 
                        proveedores_detalle_facturacion.cel as celFacturacion, 
                        proveedores_detalle_facturacion.domicilio as domicilioFacturacion, 
                        proveedores_detalle_facturacion.idLocalidad as idLocalidadFacturacion, 
                        proveedores_detalle_facturacion.idProvincia as idProvinciaFacturacion, 
                        proveedores_detalle_facturacion.cp as cpFacturacion, 
                        proveedores_detalle_facturacion.idMedioPago as idMedioPago, 
                        proveedores_detalle_facturacion.cbu as cbu, 
                    ');
        $this->db->join('proveedores_detalle_compras', 'proveedores_detalle_compras.idGenProveedor = proveedores.idGenProveedor');
        $this->db->join('proveedores_detalle_facturacion', 'proveedores_detalle_facturacion.idGenProveedor = proveedores.idGenProveedor');
        $this->db->where('proveedores.idGenProveedor', $idGenProveedor);
        $this->db->where('proveedores.eliminado', 0);
        $this->db->from('proveedores');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function insert_proveedor(
        $idGenProveedor,
        $idUsuario,
        $inputProveedor,
        $inputNombre,
        $inputApellido,
        $inputNumTel,
        $inputNumCel,
        $inputCorreo,
        $inputWeb,
        $inputDomicilio,
        $selectLocalidad,
        $selectProvincia,
        $inputNumDir,
        $inputPiso,
        $inputDpto,
        $inputCodPostal,
        $inputNota
    ) {
        $values = array(
            'idGenProveedor' => $idGenProveedor,
            'idUsuario' => $idUsuario,
            'nombEmpresa' => $inputProveedor,
            'nombre' => $inputNombre,
            'apellido' => $inputApellido,
            'tel' => $inputNumTel,
            'cel' => $inputNumCel,
            'email' => $inputCorreo,
            'pagWeb' => $inputWeb,
            'domicilio' => $inputDomicilio,
            'idLocalidad' => $selectLocalidad,
            'idProvincia' => $selectProvincia,
            'numero' => $inputNumDir,
            'piso' => $inputPiso,
            'dpto' => $inputDpto,
            'cp' => $inputCodPostal,
            'nota' => $inputNota,
        );
        $result = $this->db->insert('proveedores', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function update_proveedor(
        $idGenProveedor,
        $idUsuario,
        $inputProveedor,
        $inputNombre,
        $inputApellido,
        $inputNumTel,
        $inputNumCel,
        $inputCorreo,
        $inputWeb,
        $inputDomicilio,
        $selectLocalidad,
        $selectProvincia,
        $inputNumDir,
        $inputPiso,
        $inputDpto,
        $inputCodPostal,
        $inputNota
    ) {
        $values = array(
            'idUsuario' => $idUsuario,
            'nombEmpresa' => $inputProveedor,
            'nombre' => $inputNombre,
            'apellido' => $inputApellido,
            'tel' => $inputNumTel,
            'cel' => $inputNumCel,
            'email' => $inputCorreo,
            'pagWeb' => $inputWeb,
            'domicilio' => $inputDomicilio,
            'idLocalidad' => $selectLocalidad,
            'idProvincia' => $selectProvincia,
            'numero' => $inputNumDir,
            'piso' => $inputPiso,
            'dpto' => $inputDpto,
            'cp' => $inputCodPostal,
            'nota' => $inputNota,
        );

        $this->db->where('idGenProveedor', $idGenProveedor);
        $result = $this->db->update('proveedores', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function insert_proveedor_detalle_compra(
        $idGenProveedor,
        $idUsuario,
        $selectCatCompras,
        $inputDtoGeneral,
        $inputNotaInterna
    ) {
        $values = array(
            'idGenProveedor' => $idGenProveedor,
            'idUsuario' => $idUsuario,
            'idCategoriaCompras' => $selectCatCompras,
            'dtoGeneral' => $inputDtoGeneral,
            'notaInterna' => $inputNotaInterna
        );
        $result = $this->db->insert('proveedores_detalle_compras', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function update_proveedor_detalle_compra(
        $idGenProveedor,
        $idUsuario,
        $selectCatCompras,
        $inputDtoGeneral,
        $inputNotaInterna
    ) {
        $values = array(
            'idUsuario' => $idUsuario,
            'idCategoriaCompras' => $selectCatCompras,
            'dtoGeneral' => $inputDtoGeneral,
            'notaInterna' => $inputNotaInterna
        );

        $this->db->where('idGenProveedor', $idGenProveedor);
        $result = $this->db->update('proveedores_detalle_compras', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function insert_proveedor_detalle_facturacion(
        $idGenProveedor,
        $idUsuario,
        $inputRazonSocial,
        $selectTipoDoc,
        $inputNumDoc,
        $selectCondIva,
        $selectCompTipo,
        $inputNumTelFac,
        $inputNumCelFac,
        $inputDomicilioFiscal,
        $selectLocalidadFac,
        $selectProvinciaFac,
        $inputCodPostalFac,
        $selectMedioPago,
        $inputCBU
    ) {
        $values = array(
            'idGenProveedor' => $idGenProveedor,
            'idUsuario' => $idUsuario,
            'razonSocial' => $inputRazonSocial,
            'idTipoDoc' => $selectTipoDoc,
            'cuit' => $inputNumDoc,
            'idCondIva' => $selectCondIva,
            'idComprobante' => $selectCompTipo,
            'tel' => $inputNumTelFac,
            'cel' => $inputNumCelFac,
            'domicilio' => $inputDomicilioFiscal,
            'idLocalidad' => $selectLocalidadFac,
            'idProvincia' => $selectProvinciaFac,
            'cp' => $inputCodPostalFac,
            'idMedioPago' => $selectMedioPago,
            'cbu' => $inputCBU
        );
        $result = $this->db->insert('proveedores_detalle_facturacion', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function update_proveedor_detalle_facturacion(
        $idGenProveedor,
        $idUsuario,
        $inputRazonSocial,
        $selectTipoDoc,
        $inputNumDoc,
        $selectCondIva,
        $selectCompTipo,
        $inputNumTelFac,
        $inputNumCelFac,
        $inputDomicilioFiscal,
        $selectLocalidadFac,
        $selectProvinciaFac,
        $inputCodPostalFac,
        $selectMedioPago,
        $inputCBU
    ) {
        $values = array(
            'idGenProveedor' => $idGenProveedor,
            'idUsuario' => $idUsuario,
            'razonSocial' => $inputRazonSocial,
            'idTipoDoc' => $selectTipoDoc,
            'cuit' => $inputNumDoc,
            'idCondIva' => $selectCondIva,
            'idComprobante' => $selectCompTipo,
            'tel' => $inputNumTelFac,
            'cel' => $inputNumCelFac,
            'domicilio' => $inputDomicilioFiscal,
            'idLocalidad' => $selectLocalidadFac,
            'idProvincia' => $selectProvinciaFac,
            'cp' => $inputCodPostalFac,
            'idMedioPago' => $selectMedioPago,
            'cbu' => $inputCBU
        );

        $this->db->where('idGenProveedor', $idGenProveedor);
        $result = $this->db->update('proveedores_detalle_facturacion', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function eliminar_proveedor($idGenProveedor)
    {
        $values = array(
            'eliminado' => 1
        );

        $this->db->where('idGenProveedor', $idGenProveedor);
        $result = $this->db->update('proveedores', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function eliminar_proveedor_detalle_compra($idGenProveedor)
    {
        $this->db->delete('proveedores_detalle_compras', array('idGenProveedor' => $idGenProveedor));

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function eliminar_proveedor_detalle_facturacion($idGenProveedor)
    {
        $this->db->delete('proveedores_detalle_facturacion', array('idGenProveedor' => $idGenProveedor));

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function get_info_producto_byIdGen($idGenProducto)
    {
        $this->db->select('
                        productos.idProducto as idProducto, 
                        productos.idGenProducto as idGenProducto, 
                        productos.nombre as nombre, 
                        productos.codigo as codigo, 
                        productos.idTipoProducto as idTipoProducto, 
                        productos.idProveedor as idProveedor, 
                        productos.stock as stock, 
                        productos.descripcion as descripcion, 
                        productos.activo as activo, 
                        productos.precioVenta as precioVenta, 
                        productos.idIvaVta as idIvaVta, 
                        productos.precioCompra as precioCompra, 
                        productos.idIvaCompra as idIvaCompra, 
                        productos.controlStock as controlStock, 
                        productos.ecommerce as ecommerce, 
                        productos.porcentajeDescuento as porcentajeDescuento, 
                    ');
        $this->db->where('productos.idGenProducto', $idGenProducto);
        $this->db->from('productos');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_productos()
    {
        $this->db->select('                        
                        productos.idProducto as idProducto, 
                        productos.idGenProducto as idGenProducto, 
                        productos.nombre as nombre,
                        productos.stock as stock, 
                        productos.precioCompra as precioCompra,              
                        productos.precioVenta as precioVenta,
                        productos.codigo as codigo,
                        ivaVta.descripcion as descIvaVentas,
                        ivaCompra.descripcion as descIvaCompras,
                        proveedores.nombEmpresa as nombEmpresa,
                    ');
        $this->db->join('proveedores', 'proveedores.idProveedor = productos.idProveedor');
        $this->db->join('iva_tipos as ivaVta', 'ivaVta.idIva = productos.idIvaVta');
        $this->db->join('iva_tipos as ivaCompra', 'ivaCompra.idIva = productos.idIvaCompra');
        $this->db->from('productos');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_producto($idProducto)
    {
        $values = array(
            'idProducto' => $idProducto
        );
        $this->db->where($values);
        $result = $this->db->get('productos');
        return ($result != '') ? $result->result_array() : false;
    }

    public function get_abono_modalidades()
    {
        $result = $this->db->get('abono_modalidades');
        return ($result != '') ? $result->result_array() : false;
    }

    public function get_producto_imgs($idGenProducto)
    {
        $values = array(
            'idGenProducto' => $idGenProducto
        );
        $this->db->where($values);
        $result = $this->db->get('productos_img');
        return ($result != '') ? $result->result_array() : false;
    }

    public function get_productos_byIdGen($idGenProducto)
    {
        $this->db->select('                        
                        productos.idProducto as idProducto, 
                        productos.idGenProducto as idGenProducto, 
                        productos.nombre as nombre,
                        productos.stock as stock, 
                        productos.codigo as codigo, 
                        productos.precioCompra as precioCompra,              
                        productos.precioVenta as precioVenta,
                        ivaVta.descripcion as descIvaVentas,
                        ivaCompra.descripcion as descIvaCompras,
                        proveedores.nombEmpresa as nombEmpresa,
                        productos.controlStock as controlStock,
                    ');
        $this->db->join('proveedores', 'proveedores.idProveedor = productos.idProveedor');
        $this->db->join('iva_tipos as ivaVta', 'ivaVta.idIva = productos.idIvaVta');
        $this->db->join('iva_tipos as ivaCompra', 'ivaCompra.idIva = productos.idIvaCompra');
        $this->db->where('idGenProducto', $idGenProducto);
        $this->db->from('productos');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_productos_byId($idProducto)
    {
        $this->db->select('                        
                        productos.idProducto as idProducto, 
                        productos.idGenProducto as idGenProducto, 
                        productos.nombre as nombre,
                        productos.stock as stock, 
                        productos.precioCompra as precioCompra,              
                        productos.precioVenta as precioVenta,
                        ivaVta.descripcion as descIvaVentas,
                        ivaCompra.descripcion as descIvaCompras,
                        proveedores.nombEmpresa as nombEmpresa,
                        productos.controlStock as controlStock,
                    ');
        $this->db->join('proveedores', 'proveedores.idProveedor = productos.idProveedor');
        $this->db->join('iva_tipos as ivaVta', 'ivaVta.idIva = productos.idIvaVta');
        $this->db->join('iva_tipos as ivaCompra', 'ivaCompra.idIva = productos.idIvaCompra');
        $this->db->where('idProducto', $idProducto);
        $this->db->from('productos');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_producto_byIdGen($idGenProducto)
    {
        $this->db->select('                        
                        productos.idProducto as idProducto, 
                        productos.idGenProducto as idGenProducto, 
                        productos.nombre as nombre,
                        productos.stock as stock, 
                        productos.precioCompra as precioCompra,              
                        productos.precioVenta as precioVenta,
                        productos.codigo as codigo,
                        ivaVta.descripcion as descIvaVentas,
                        ivaCompra.descripcion as descIvaCompras,
                        proveedores.nombEmpresa as nombEmpresa,
                    ');
        $this->db->from('productos');
        $this->db->join('proveedores', 'proveedores.idProveedor = productos.idProveedor');
        $this->db->join('iva_tipos as ivaVta', 'ivaVta.idIva = productos.idIvaVta');
        $this->db->join('iva_tipos as ivaCompra', 'ivaCompra.idIva = productos.idIvaCompra');
        $this->db->where('idGenProducto', $idGenProducto);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function insert_producto(
        $idGenProducto,
        $idUsuario,
        $inputNombre,
        $inputCodigo,
        $selectProveedor,
        $inputStock,
        $inputDescripcion,
        $selectEstado,
        $inputPrecioVenta,
        $selectIvaVenta,
        $inputPrecioCompra,
        $selectIvaCompra,
        $selectControlStock,
        $productoEcommerce,
        $porcentajeDescuento
    ) {
        $values = array(
            'idGenProducto' => $idGenProducto,
            'idUsuario' => $idUsuario,
            'nombre' => $inputNombre,
            'codigo' => $inputCodigo,
            'idProveedor' => $selectProveedor,
            'stock' => $inputStock,
            'descripcion' => $inputDescripcion,
            'activo' => $selectEstado,
            'precioVenta' => $inputPrecioVenta,
            'idIvaVta' => $selectIvaVenta,
            'precioCompra' => $inputPrecioCompra,
            'idIvaCompra' => $selectIvaCompra,
            'controlStock' => $selectControlStock,
            'ecommerce' => $productoEcommerce,
            'porcentajeDescuento' => $porcentajeDescuento
        );
        $result = $this->db->insert('productos', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function update_producto(
        $idGenProducto,
        $idUsuario,
        $inputNombre,
        $inputCodigo,
        $selectProveedor,
        $inputStock,
        $inputDescripcion,
        $selectEstado,
        $inputPrecioVenta,
        $selectIvaVenta,
        $inputPrecioCompra,
        $selectIvaCompra,
        $selectControlStock,
        $productoEcommerce,
        $porcentajeDescuento
    ) {
        $values = array(
            'idUsuario' => $idUsuario,
            'nombre' => $inputNombre,
            'codigo' => $inputCodigo,
            'idProveedor' => $selectProveedor,
            'stock' => $inputStock,
            'descripcion' => $inputDescripcion,
            'activo' => $selectEstado,
            'precioVenta' => $inputPrecioVenta,
            'idIvaVta' => $selectIvaVenta,
            'precioCompra' => $inputPrecioCompra,
            'idIvaCompra' => $selectIvaCompra,
            'controlStock' => $selectControlStock,
            'ecommerce' => $productoEcommerce,
            'porcentajeDescuento' => $porcentajeDescuento
        );

        $this->db->where('idGenProducto', $idGenProducto);
        $result = $this->db->update('productos', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Actualizacion de precios de un producto
     * @param type $idGenProducto
     * @param type $precio
     * @return type
     */
    public function update_precio_producto(
        $idGenProducto,
        $precio
    ) {
        $values = array(
            'precioVenta' => $precio,
            'precioCompra' => $precio
        );

        $this->db->where('idGenProducto', $idGenProducto);
        $result = $this->db->update('productos', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function insert_img_producto($idGenProducto, $nombreImg)
    {
        $values = array(
            'idGenProducto' => $idGenProducto,
            'nombreImg' => $nombreImg
        );
        $result = $this->db->insert('productos_img', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function eliminar_producto($idGenProducto)
    {
        $this->db->delete('productos', array('idGenProducto' => $idGenProducto));

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function eliminar_img_producto($idGenProducto)
    {
        $this->db->delete('productos_img', array('idGenProducto' => $idGenProducto));

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function get_img_producto($idGenProducto)
    {
        $this->db->select('*');
        $this->db->from('productos_img');
        $this->db->where('idGenProducto', $idGenProducto);
        $result = $this->db->get();

        return (($result->num_rows() > 0) ? $result->result_array() : false);
    }

    public function insert_cuenta_tesoreria(
        $idGenCuenta,
        $idUsuario,
        $inputNombCuenta,
        $selectTipoCuenta
    ) {
        $values = array(
            'idGenCuenta' => $idGenCuenta,
            'idUsuario' => $idUsuario,
            'idTipoCuenta' => $selectTipoCuenta,
            'descripcion' => $inputNombCuenta
        );
        $result = $this->db->insert('tesoreria_cuentas', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function insert_tesoreria_cuentas(
        $idGenCuenta,
        $idUsuario,
        $idPtoVenta,
        $inputNombCuenta,
        $selectTipoCuenta
    ) {
        $values = array(
            'idGenCuenta' => $idGenCuenta,
            'idUsuario' => $idUsuario,
            'idPtoVenta' => $idPtoVenta,
            'idTipoCuenta' => $selectTipoCuenta,
            'descripcion' => $inputNombCuenta
        );
        $result = $this->db->insert('tesoreria_cuentas', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function update_cuenta_tesoreria(
        $inputIdCuenta,
        $idUsuario,
        $inputNombCuenta,
        $selectTipoCuenta
    ) {
        $values = array(
            'idGenCuenta' => $inputIdCuenta,
            'idUsuario' => $idUsuario,
            'idTipoCuenta' => $selectTipoCuenta,
            'descripcion' => $inputNombCuenta
        );

        $this->db->where('idGenCuenta', $inputIdCuenta);
        $result = $this->db->update('tesoreria_cuentas', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function get_cuenta_tesoreria_byIdGen($idGenCuenta)
    {
        $this->db->select('                        
                        tesoreria_cuentas.idGenCuenta as idGenCuenta, 
                        tesoreria_cuentas.descripcion as descripcion, 
                        tesoreria_tipo_cuenta.descripcion as descTipoCuenta,
                        tesoreria_tipo_cuenta.idTipoCuenta as idTipoCuenta,
                    ');
        $this->db->join('tesoreria_tipo_cuenta', 'tesoreria_tipo_cuenta.idTipoCuenta = tesoreria_cuentas.idTipoCuenta');
        $this->db->where('idGenCuenta', $idGenCuenta);
        $this->db->from('tesoreria_cuentas');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_cuenta_tesoreria_byIdGenCuenta($idGenCuenta)
    {
        $this->db->select('                        
                        tesoreria_cuentas.idCuenta as idCuenta, 
                        tesoreria_cuentas.idGenCuenta as idGenCuenta, 
                        tesoreria_cuentas.descripcion as descripcion, 
                    ');
        $this->db->where('idGenCuenta', $idGenCuenta);
        $this->db->from('tesoreria_cuentas');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function eliminar_cuenta_tesoreria($idGenCuenta)
    {
        $this->db->delete('tesoreria_cuentas', array('idGenCuenta' => $idGenCuenta));

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Guardado de presupuesto con los datos correspondientes
     * @param type $idGenIngreso
     * @param type $idVendedor
     * @param type $selectCliente
     * @param type $fechaEmision
     * @param type $fechaCobro
     * @param type $selectTipoFac
     * @param type $selectCatVenta
     * @param type $notaCliente
     * @param type $notaInterna
     * @param type $importeNoGravado
     * @param type $totalVenta
     * @param type $descuentoTotal
     * @param type $ivaTotal
     * @param type $selectCategoriaVentaDetalle
     * @param type $selectSubCategoriaVenta
     * @param type $idEstado
     * @return type
     */
    public function insert_presupuesto(
        $idGenIngreso,
        $idVendedor,
        $selectCliente,
        $fechaEmision,
        $fechaCobro,
        $fechaVigencia,
        $selectCatVenta,
        $notaCliente,
        $notaInterna,
        $importeNoGravado,
        $totalVenta,
        $descuentoTotal,
        $descuentoCliente,
        $ivaTotal,
        $selectSubCategoriaVenta,
        $idEstado
    ) {
        $values = array(
            'idGenPresupuesto' => $idGenIngreso,
            'idVendedor' => $idVendedor,
            'idCliente' => $selectCliente,
            'fechaEmision' => $fechaEmision,
            'fechaVtoPresupuesto' => $fechaCobro,
            'fechaVigencia' => $fechaVigencia,
            'idCategoria' => $selectCatVenta,
            'notaCliente' => $notaCliente,
            'notaInterna' => $notaInterna,
            'importeNetoNoGravado' => $importeNoGravado,
            'total' => $totalVenta,
            'descuentoTotal' => $descuentoTotal,
            'descuentoCliente' => $descuentoCliente,
            'ivaTotal' => $ivaTotal,
            'idSubcategoriaPresupuesto' => $selectSubCategoriaVenta,
            'idEstado' => $idEstado
        );
        $result = $this->db->insert('presupuesto', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Guardado del detalle del presupuesto con sus correspondientes datos
     * @param type $idGenIngreso
     * @param type $idProducto
     * @param type $cantidad
     * @param type $precio
     * @param type $descuento
     * @param type $subtotalProd
     * @param type $iva
     * @param type $eliminado
     * @return type
     */
    public function insert_presupuesto_detalle(
        $idGenPresupuesto,
        $idProducto,
        $cantidad,
        $precio,
        $descuento,
        $subtotalProd,
        $iva,
        $ivaText,
        $eliminado
    ) {
        $values = array(
            'idGenPresupuesto' => $idGenPresupuesto,
            'idProducto' => $idProducto,
            'cantidad' => $cantidad,
            'precio' => $precio,
            'descuento' => $descuento,
            'subTotal' => $subtotalProd,
            'eliminado' => $eliminado,
            'iva' => $iva,
            "ivaText" => $ivaText
        );
        $result = $this->db->insert('presupuesto_detalle', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Obtencion de los presupuestos
     * @return type
     */
    public function get_presupuestos()
    {
        $this->db->select('
                presupuesto.idPresupuesto, 
                presupuesto.idGenPresupuesto, 
                presupuesto.idVendedor,
                presupuesto.descuentoTotal,
                presupuesto.total,
                presupuesto.fechaVtoPresupuesto,
                presupuesto.fechaEmision,
                presupuesto.fechaAlta, 
                presupuesto.idEstado, 
                presupuesto.facturado as facturado, 
                usuarios.nombreCompleto as nombreVend,
                usuarios.idUsuario as idUsuarioVend
            ');
        $this->db->from('presupuesto');
        $this->db->join('usuarios', 'usuarios.idUsuario = presupuesto.idVendedor');
        $this->db->where('presupuesto.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Elimina el presupuesto segun si idGenPresupuesto
     * @param type $idGenPresupuesto
     * @return type
     */
    public function eliminar_presupuesto_detalle_by_idGenPresupuesto($idGenPresupuesto, $idProducto)
    {
        $values = array(
            'eliminado' => 1
        );
        $this->db->where('idGenPresupuesto', $idGenPresupuesto);
        $this->db->where('idProducto', $idProducto);
        $result = $this->db->update('presupuesto_detalle', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Obtencion de los detalles de presu´puesto que correspondan al idGenPresupuesto
     * @param type $idGenPresupuesto
     * @return type
     */
    //    public function get_presupuesto_detalle_by_idGenPresupuesto( $idGenPresupuesto ) {
    //        $this->db->where('idGenPresupuesto', $idGenPresupuesto);
    //        $this->db->where('eliminado', 0);
    //        $result = $this->db->get('presupuestos_detalle');
    //
    //        return ($result->num_rows() > 0) ? $result->result_array() : false;
    //    }

    /**
     * Elimina el detalle de presupuesto segun corresponda con el idGenPrespuesto
     * @param type $idGenPresupuesto
     * @return type
     */
    //    public function eliminar_presupuesto_detalle_by_idGenPresupuesto( $idGenPresupuesto ) {
    //        $values = array(
    //            'eliminado' => 1
    //        );
    //        $this->db->where('idGenPresupuesto', $idGenPresupuesto);
    //        $result = $this->db->update('presupuestos', $values);
    //
    //        return ($this->db->affected_rows() > 0) ? true : false;
    //    }

    /**
     * Elimina el detalle de presupuesto segun corresponda con el idGenPrespuesto y el idProducto
     * @param type $idGenPresupuesto
     * @param type $idProducto
     * @return type
     */
    public function eliminar_presupuesto_by_idGenPresupuesto_idProducto($idGenPresupuesto, $idProducto)
    {
        $values = array(
            'eliminado' => 1
        );
        $this->db->where('idGenPresupuesto', $idGenPresupuesto);
        $this->db->where('idProducto', $idProducto);
        $result = $this->db->update('presupuesto_detalle', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Elimina el presupuesto segun corresponda con el idGenPrespuesto
     * @param type $idGenPresupuesto
     * @return type
     */
    public function eliminar_presupuesto_by_idGenPresupuesto($idGenPresupuesto)
    {
        $values = array(
            'eliminado' => 1
        );
        $this->db->where('idGenPresupuesto', $idGenPresupuesto);
        $result = $this->db->update('presupuesto', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Obtencion del presupuesto con el idGenPresupuesto pasado
     * @return type
     */
    public function get_presupuestos_by_idGenPresupuesto($idGenPresupuesto)
    {
        $this->db->select('
                presupuesto.idPresupuesto, 
                presupuesto.idGenPresupuesto, 
                presupuesto.idCliente,
                presupuesto.idVendedor,
                presupuesto.idCategoria,
                presupuesto.descuentoTotal,
                presupuesto.descuentoCliente,
                presupuesto.fechaEmision,
                presupuesto.fechaVtoPresupuesto,
                presupuesto.fechaVigencia,
                presupuesto.importeNetoNoGravado, 
                presupuesto.notaCliente, 
                presupuesto.notaInterna, 
                presupuesto.subTotalSinDescuento, 
                presupuesto.subTotalConDescuento, 
                presupuesto.total, 
                presupuesto.fechaAlta, 
                presupuesto.ivaTotal, 
                presupuesto.idSubCategoriaPresupuesto, 
                usuarios.nombreCompleto as nombreVend,
                usuarios.idUsuario as idUsuarioVend
            ');
        $this->db->from('presupuesto');
        $this->db->join('usuarios', 'usuarios.idUsuario = presupuesto.idVendedor');
        $this->db->where('presupuesto.idGenPresupuesto', $idGenPresupuesto);
        $this->db->where('presupuesto.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de los datalles del presupuesto correspondiente al idGenPresupuesto
     * @param type $idGenPresupuesto
     * @return type
     */
    public function get_presupuestos_detalle_by_idGenPresupuesto($idGenPresupuesto)
    {
        $this->db->select('
                presupuesto_detalle.idDetallePresupuesto, 
                presupuesto_detalle.idGenPresupuesto, 
                presupuesto_detalle.idProducto,
                presupuesto_detalle.cantidad,
                presupuesto_detalle.precio,
                presupuesto_detalle.descuento,
                presupuesto_detalle.subTotal, 
                presupuesto_detalle.iva,
                productos.stock,
                productos.nombre as nombre,
                productos.codigo
            ');
        $this->db->from('presupuesto_detalle');
        $this->db->join('productos', 'presupuesto_detalle.idProducto = productos.idProducto');
        $this->db->where('presupuesto_detalle.idGenPresupuesto', $idGenPresupuesto);
        $this->db->where('presupuesto_detalle.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Actualiza el monto del presupuesto
     * @param type $idProducto
     * @param type $cantidad
     * @return type
     */
    public function update_presupuesto_monto_by_idGenPresupuesto($idGenPresupuesto, $totalPresupuesto, $descEfectuado, $importeNoGravado)
    {
        $values = array(
            'total' => $totalPresupuesto,
            'importeNetoNoGravado' => $importeNoGravado,
            'descuentoTotal' => $descEfectuado
        );
        $this->db->where('idGenPresupuesto', $idGenPresupuesto);
        $result = $this->db->update('presupuesto', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Actualizacion de presupuesto
     * @param type $idGenPresupuesto
     * @param type $selectCliente
     * @param type $fechaEmision
     * @param type $fechaCobro
     * @param type $selectCatVenta
     * @param type $notaCliente
     * @param type $notaInterna
     * @param type $importeNoGravado
     * @param type $totalVenta
     * @param type $descuentoTotal
     * @param type $ivaTotal
     * @param type $selectCategoriaVentaDetalle
     * @param type $selectSubCategoriaVenta
     * @param type $saldado
     * @param type $idEstado
     * @return type
     */
    public function update_presupuesto(
        $idGenPresupuesto,
        $selectCliente,
        $fechaEmision,
        $fechaCobro,
        $fechaVigencia,
        $selectCatVenta,
        $notaCliente,
        $notaInterna,
        $importeNoGravado,
        $totalVenta,
        $descuentoTotal,
        $descuentoCliente,
        $ivaTotal,
        $selectSubCategoriaVenta,
        $idEstado
    ) {
        $values = array(
            'idCliente' => $selectCliente,
            'fechaEmision' => $fechaEmision,
            'fechaVtoPresupuesto' => $fechaCobro,
            'fechaVigencia' => $fechaVigencia,
            'idCategoria' => $selectCatVenta,
            'notaCliente' => $notaCliente,
            'notaInterna' => $notaInterna,
            'importeNetoNoGravado' => $importeNoGravado,
            'total' => $totalVenta,
            'descuentoTotal' => $descuentoTotal,
            'descuentoCliente' => $descuentoCliente,
            'ivaTotal' => $ivaTotal,
            'idSubcategoriaPresupuesto' => $selectSubCategoriaVenta,
            'idEstado' => $idEstado
        );
        $this->db->where('idGenPresupuesto', $idGenPresupuesto);
        $result = $this->db->update('presupuesto', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Actualizar el detalle de un presupuesto
     * @param type $idGenPresupuesto
     * @param type $idProducto
     * @param type $cantidad
     * @param type $descuento
     * @param type $subtotalProd
     * @param type $iva
     * @param type $ivaText
     * @param type $eliminado
     * @return type
     */
    public function update_presupuesto_detalle(
        $idGenPresupuesto,
        $idProducto,
        $cantidad,
        $descuento,
        $subtotalProd,
        $iva,
        $ivaText
    ) {
        $values = array(
            'cantidad' => $cantidad,
            'descuento' => $descuento,
            'subTotal' => $subtotalProd,
            'iva' => $iva,
            "ivaText" => $ivaText
        );
        $this->db->where('idGenPresupuesto', $idGenPresupuesto);
        $this->db->where('idProducto', $idProducto);
        $result = $this->db->update('presupuesto_detalle', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Cambiar el estado del presupuesto al que se coloca como parametro
     * @param type $idGenPresupuesto
     * @param type $idEstado
     * @return type
     */
    public function update_presupuesto_estado($idGenPresupuesto, $idEstado)
    {
        $values = array(
            'idEstado' => $idEstado
        );
        $this->db->where('idGenPresupuesto', $idGenPresupuesto);
        $result = $this->db->update('presupuesto', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Cambiar el presupuesto a facturado
     * @param type $idGenPresupuesto
     * @return type
     */
    public function update_presupuesto_facturado($idGenPresupuesto)
    {
        $values = array(
            'facturado' => 1
        );
        $this->db->where('idGenPresupuesto', $idGenPresupuesto);
        $result = $this->db->update('presupuesto', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Obtenciones total de la cuenta corriente de los proveedores
     * @return type
     */
    public function get_estado_cuenta_corriente_proveedor_total()
    {
        $this->db->where('proveedores_cuenta_corriente.eliminado', 0);
        $this->db->join('tesoreria_cuentas', 'tesoreria_cuentas.idCuenta = proveedores_cuenta_corriente.idMedioPago');
        $this->db->join('puntos_ventas', 'puntos_ventas.idPtoVenta = tesoreria_cuentas.idPtoVenta');
        $this->db->join('egresos', 'egresos.idGenEgreso = proveedores_cuenta_corriente.idGenEgreso');
        $this->db->join('proveedores', 'proveedores.idProveedor = proveedores_cuenta_corriente.idProveedor');
        $result = $this->db->get('proveedores_cuenta_corriente');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_estado_cuenta_corriente_proveedor_total_by_idProveedor($idProveedor)
    {
        $this->db->where('proveedores_cuenta_corriente.idProveedor', $idProveedor);
        $this->db->where('proveedores_cuenta_corriente.eliminado', 0);
        $this->db->join('tesoreria_cuentas', 'tesoreria_cuentas.idCuenta = proveedores_cuenta_corriente.idMedioPago');
        $this->db->join('puntos_ventas', 'puntos_ventas.idPtoVenta = tesoreria_cuentas.idPtoVenta');
        $this->db->join('egresos', 'egresos.idGenEgreso = proveedores_cuenta_corriente.idGenEgreso');
        $this->db->join('proveedores', 'proveedores.idProveedor = proveedores_cuenta_corriente.idProveedor');
        $result = $this->db->get('proveedores_cuenta_corriente');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de la cuenta corriente de los proveedores correspondiente al periodo desde, hasta
     * @param type $desde
     * @param type $hasta
     * @param type $idProveedor
     * @return type
     */
    public function get_estado_cuenta_corriente_proveedor_total_desde_hasta($desde, $hasta)
    {
        $this->db->where('proveedores_cuenta_corriente.fechaPago >=', $desde);
        $this->db->where('proveedores_cuenta_corriente.fechaPago <=', $hasta);
        $this->db->where('proveedores_cuenta_corriente.eliminado', 0);
        $this->db->join('tesoreria_cuentas', 'tesoreria_cuentas.idCuenta = proveedores_cuenta_corriente.idMedioPago');
        $this->db->join('puntos_ventas', 'puntos_ventas.idPtoVenta = tesoreria_cuentas.idPtoVenta');
        $this->db->join('egresos', 'egresos.idGenEgreso = proveedores_cuenta_corriente.idGenEgreso');
        $this->db->join('proveedores', 'proveedores.idProveedor = proveedores_cuenta_corriente.idProveedor');
        $result = $this->db->get('proveedores_cuenta_corriente');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de la cuenta corriente de los proveedores correspondiente al periodo desde, hasta y al proveedor pasado
     * @param type $desde
     * @param type $hasta
     * @param type $idProveedor
     * @return type
     */
    public function get_estado_cuenta_corriente_proveedor_total_desde_hasta_idProveedor($desde, $hasta, $idProveedor)
    {
        $this->db->where('idProveedor', $idProveedor);
        $this->db->where('fechaPago >=', $desde);
        $this->db->where('fechaPago <=', $hasta);
        $this->db->where('eliminado', 0);
        $this->db->join('tesoreria_cuentas', 'tesoreria_cuentas.idCuenta = proveedores_cuenta_corriente.idMedioPago');
        $this->db->join('puntos_ventas', 'puntos_ventas.idPtoVenta = tesoreria_cuentas.idPtoVenta');
        $this->db->join('egresos', 'egresos.idGenEgreso = proveedores_cuenta_corriente.idGenEgreso');
        $this->db->join('proveedores', 'proveedores.idProveedor = proveedores_cuenta_corriente.idProveedor');
        $result = $this->db->get('proveedores_cuenta_corriente');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion del excel perteneciente a los datos de las cuentas corrientes de los proveedores
     * @return type
     */
    public function get_cuentas_corrientes_proveedores_exportar()
    {
        //--- cabeceras ---//
        $fields[1]['name'] = 'Emisión';
        $fields[2]['name'] = 'Proveedor';
        $fields[3]['name'] = 'A Pagar';
        $fields[4]['name'] = 'Pagado';
        $fields[5]['name'] = 'Total';
        $fields[6]['name'] = 'Saldo';
        $fields[7]['name'] = 'Medio de Pago';

        $this->db->select('
            proveedores_cuenta_corriente.fechaPago as fechaPago, 
            proveedores.nombEmpresa as nombEmpresa, 
            proveedores_cuenta_corriente.aPagar as aPagar, 
            proveedores_cuenta_corriente.pague as pague, 
            egresos.total as total,                 
            proveedores_cuenta_corriente.saldo as saldo, 
            tesoreria_cuentas.descripcion as cuenta, 
        ');
        $this->db->join('tesoreria_cuentas', 'tesoreria_cuentas.idCuenta = proveedores_cuenta_corriente.idMedioPago');
        $this->db->join('puntos_ventas', 'puntos_ventas.idPtoVenta = tesoreria_cuentas.idPtoVenta');
        $this->db->join('egresos', 'egresos.idGenEgreso = proveedores_cuenta_corriente.idGenEgreso');
        $this->db->join('proveedores', 'proveedores.idProveedor = proveedores_cuenta_corriente.idProveedor');
        $this->db->where('proveedores_cuenta_corriente.eliminado', 0);
        $result = $this->db->get('proveedores_cuenta_corriente');

        return ($result != '') ? array("fields" => $fields, "query" => $result) : false;
    }

    /**
     * Obtencion del excel perteneciente a los datos de las cuentas corrientes de los proveedores que corresponda al idProveedor
     * @param type $idProveedor
     * @return type
     */
    public function get_cuentas_corrientes_proveedores_exportar_by_idProveedor($idProveedor)
    {
        //--- cabeceras ---//
        $fields[1]['name'] = 'Emisión';
        $fields[2]['name'] = 'Proveedor';
        $fields[3]['name'] = 'A Pagar';
        $fields[4]['name'] = 'Pagado';
        $fields[5]['name'] = 'Total';
        $fields[6]['name'] = 'Saldo';
        $fields[7]['name'] = 'Medio de Pago';

        $this->db->select('
            proveedores_cuenta_corriente.fechaPago as fechaPago, 
            proveedores.nombEmpresa as nombEmpresa, 
            proveedores_cuenta_corriente.aPagar as aPagar, 
            proveedores_cuenta_corriente.pague as pague, 
            egresos.total as total,                 
            proveedores_cuenta_corriente.saldo as saldo, 
            tesoreria_cuentas.descripcion as cuenta, 
        ');
        $this->db->join('tesoreria_cuentas', 'tesoreria_cuentas.idCuenta = proveedores_cuenta_corriente.idMedioPago');
        $this->db->join('puntos_ventas', 'puntos_ventas.idPtoVenta = tesoreria_cuentas.idPtoVenta');
        $this->db->join('egresos', 'egresos.idGenEgreso = proveedores_cuenta_corriente.idGenEgreso');
        $this->db->join('proveedores', 'proveedores.idProveedor = proveedores_cuenta_corriente.idProveedor');
        $this->db->where('proveedores_cuenta_corriente.idProveedor', $idProveedor);
        $this->db->where('proveedores_cuenta_corriente.eliminado', 0);
        $result = $this->db->get('proveedores_cuenta_corriente');

        return ($result != '') ? array("fields" => $fields, "query" => $result) : false;
    }

    /**
     * Obtencion del excel perteneciente a los datos de las cuentas corrientes de los proveedores que se encuentre dentro del rago de fecha
     * @param type $desde
     * @param type $hasta
     * @return type
     */
    public function get_cuentas_corrientes_proveedores_exportar_by_desde_hasta($desde, $hasta)
    {
        //--- cabeceras ---//
        $fields[1]['name'] = 'Emisión';
        $fields[2]['name'] = 'Proveedor';
        $fields[3]['name'] = 'A Pagar';
        $fields[4]['name'] = 'Pagado';
        $fields[5]['name'] = 'Total';
        $fields[6]['name'] = 'Saldo';
        $fields[7]['name'] = 'Medio de Pago';

        $this->db->select('
            proveedores_cuenta_corriente.fechaPago as fechaPago, 
            proveedores.nombEmpresa as nombEmpresa, 
            proveedores_cuenta_corriente.aPagar as aPagar, 
            proveedores_cuenta_corriente.pague as pague, 
            egresos.total as total,                 
            proveedores_cuenta_corriente.saldo as saldo, 
            tesoreria_cuentas.descripcion as cuenta, 
        ');
        $this->db->join('tesoreria_cuentas', 'tesoreria_cuentas.idCuenta = proveedores_cuenta_corriente.idMedioPago');
        $this->db->join('puntos_ventas', 'puntos_ventas.idPtoVenta = tesoreria_cuentas.idPtoVenta');
        $this->db->join('egresos', 'egresos.idGenEgreso = proveedores_cuenta_corriente.idGenEgreso');
        $this->db->join('proveedores', 'proveedores.idProveedor = proveedores_cuenta_corriente.idProveedor');
        $this->db->where('proveedores_cuenta_corriente.fechaPago >=', $desde);
        $this->db->where('proveedores_cuenta_corriente.fechaPago <=', $hasta);
        $this->db->where('proveedores_cuenta_corriente.eliminado', 0);
        $result = $this->db->get('proveedores_cuenta_corriente');

        return ($result != '') ? array("fields" => $fields, "query" => $result) : false;
    }

    /**
     * Obtencion del excel perteneciente a los datos de las cuentas corrientes de los proveedores que se encuentre dentro del rago de fecha y corresponda al idProveedor
     * @param type $desde
     * @param type $hasta
     * @param type $idProveedor
     * @return type
     */
    public function get_cuentas_corrientes_proveedores_exportar_by_desde_hasta_idProveedor($desde, $hasta, $idProveedor)
    {
        //--- cabeceras ---//
        $fields[1]['name'] = 'Emisión';
        $fields[2]['name'] = 'Proveedor';
        $fields[3]['name'] = 'A Pagar';
        $fields[4]['name'] = 'Pagado';
        $fields[5]['name'] = 'Total';
        $fields[6]['name'] = 'Saldo';
        $fields[7]['name'] = 'Medio de Pago';

        $this->db->select('
            proveedores_cuenta_corriente.fechaPago as fechaPago, 
            proveedores.nombEmpresa as nombEmpresa, 
            proveedores_cuenta_corriente.aPagar as aPagar, 
            proveedores_cuenta_corriente.pague as pague, 
            egresos.total as total,                 
            proveedores_cuenta_corriente.saldo as saldo, 
            tesoreria_cuentas.descripcion as cuenta, 
        ');
        $this->db->join('tesoreria_cuentas', 'tesoreria_cuentas.idCuenta = proveedores_cuenta_corriente.idMedioPago');
        $this->db->join('puntos_ventas', 'puntos_ventas.idPtoVenta = tesoreria_cuentas.idPtoVenta');
        $this->db->join('egresos', 'egresos.idGenEgreso = proveedores_cuenta_corriente.idGenEgreso');
        $this->db->join('proveedores', 'proveedores.idProveedor = proveedores_cuenta_corriente.idProveedor');
        $this->db->where('proveedores_cuenta_corriente.idProveedor', $idProveedor);
        $this->db->where('proveedores_cuenta_corriente.fechaPago >=', $desde);
        $this->db->where('proveedores_cuenta_corriente.fechaPago <=', $hasta);
        $this->db->where('proveedores_cuenta_corriente.eliminado', 0);
        $result = $this->db->get('proveedores_cuenta_corriente');

        return ($result != '') ? array("fields" => $fields, "query" => $result) : false;
    }

    /**
     * Egresos que corresponden para las notificaciones que tienen que cumplir con las siguientes caracteristicas que determinan los where
     * @param type $hoy
     * @return type
     */
    public function get_egresos_by_fecha_noSaldada($hoy)
    {
        $this->db->where('fechaVtoPago', $hoy);
        $this->db->where('idEstado', 1);
        $this->db->where('eliminado', 0);
        $result = $this->db->get('egresos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Egresos que corresponden para las notificaciones que tienen que cumplir con las siguientes caracteristicas que determinan los where
     * @param type $hoy
     * @return type
     */
    public function get_gastos_by_fecha_noSaldada($hoy)
    {
        $this->db->where('fechaVtoGasto', $hoy);
        $this->db->where('idEstado', 1);
        $this->db->where('eliminado', 0);
        $result = $this->db->get('gastos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Egresos que corresponden para las notificaciones que tienen que cumplir con las siguientes caracteristicas que determinan los where
     * @param type $hoy
     * @return type
     */
    public function get_egresos_by_fechaHastaHoy_noSaldada($dosDiasAntes, $hoy)
    {
        $this->db->where('fechaVtoPago >=', $dosDiasAntes);
        $this->db->where('fechaVtoPago <=', $hoy);
        $this->db->where('idEstado', 1);
        $this->db->where('eliminado', 0);
        $result = $this->db->get('egresos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Egresos que corresponden para las notificaciones que tienen que cumplir con las siguientes caracteristicas que determinan los where
     * @param type $hoy
     * @return type
     */
    public function get_gastos_by_fechaHastaHoy_noSaldada($dosDiasAntes, $hoy)
    {
        $this->db->where('fechaVtoGasto >=', $dosDiasAntes);
        $this->db->where('fechaVtoGasto <=', $hoy);
        $this->db->where('idEstado', 1);
        $this->db->where('eliminado', 0);
        $result = $this->db->get('gastos');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Insertamos una nueva notificacion de egreso
     * @param type $idGenEgreso
     * @return type
     */
    public function insert_notificacion_egreso(
        $idGenEgreso
    ) {
        $values = array(
            'idGenEgreso' => $idGenEgreso
        );
        $result = $this->db->insert('notificaciones_egresos', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /*     * Inseramos una nuevo notificacion de gasto
     *
     * @param type $idGenGasto
     * @return type
     */

    public function insert_notificacion_gasto(
        $idGenGasto
    ) {
        $values = array(
            'idGenGasto' => $idGenGasto
        );
        $result = $this->db->insert('notificaciones_gastos', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Obtencion de notificaciones de egresos
     * @return type
     */
    public function get_notificaciones_egresos()
    {
        $this->db->select('
            ne.idGenEgreso,
            ne.fechaAlta as fechaRegistroNotificacion,
            e.fechaVtoPago as fechaVto,
            e.aPagar as montoDeuda,
            p.nombEmpresa
        ');
        $this->db->join('egresos as e', 'e.idGenEgreso = ne.idGenEgreso');
        $this->db->join('proveedores as p', 'p.idProveedor = e.idProveedor');
        $this->db->where('ne.leido', 0);
        $result = $this->db->get('notificaciones_egresos as ne');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de notificaciones de gastos
     * @return type
     */
    public function get_notificaciones_gastos()
    {
        $this->db->select('
            ng.idGenGasto,
            ng.fechaAlta as fechaRegistroNotificacion,
            g.fechaVtoGasto as fechaVto,
            g.montoGasto as montoDeuda
        ');
        $this->db->join('gastos as g', 'g.idGenGasto = ng.idGenGasto');
        $this->db->where('ng.leido', 0);
        $result = $this->db->get('notificaciones_gastos as ng');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Actualizacion de notificacion a leida
     * @param type $idGenGasto
     * @return type
     */
    public function update_notificacion_leida_gasto(
        $idGenGasto,
        $fechaRegistroNotificacion
    ) {
        $values = array(
            'leido' => 1
        );
        $this->db->where('idGenGasto', $idGenGasto);
        $this->db->where('fechaAlta', $fechaRegistroNotificacion);
        $result = $this->db->update('notificaciones_gastos', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Actualizacion de notificacion a leida
     * @param type $idGenEgreso
     * @return type
     */
    public function update_notificacion_leida_egreso(
        $idGenEgreso,
        $fechaRegistroNotificacion
    ) {
        $values = array(
            'leido' => 1
        );
        $this->db->where('idGenEgreso', $idGenEgreso);
        $this->db->where('fechaAlta', $fechaRegistroNotificacion);
        $result = $this->db->update('notificaciones_egresos', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Actualiza el estado del presupuesto a enviado
     * @param type $idGenPresupuesto
     * @return type
     */
    public function update_estado_presupuesto_enviado(
        $idGenPresupuesto
    ) {
        $values = array(
            'idEstado' => 2
        );
        $this->db->where('idGenPresupuesto', $idGenPresupuesto);
        $result = $this->db->update('presupuesto', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Actualiza el estado del presupuesto a pendiente
     * @param type $idGenPresupuesto
     * @return type
     */
    public function update_estado_presupuesto_pendiente(
        $idGenPresupuesto
    ) {
        $values = array(
            'idEstado' => 1
        );
        $this->db->where('idGenPresupuesto', $idGenPresupuesto);
        $result = $this->db->update('presupuesto', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Actualiza el estado del presupuesto a rechazar
     * @param type $idGenPresupuesto
     * @return type
     */
    public function update_estado_presupuesto_rechazar(
        $idGenPresupuesto
    ) {
        $values = array(
            'idEstado' => 3
        );
        $this->db->where('idGenPresupuesto', $idGenPresupuesto);
        $result = $this->db->update('presupuesto', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Actualiza el estado del presupuesto a aceptar
     * @param type $idGenPresupuesto
     * @return type
     */
    public function update_estado_presupuesto_aceptar(
        $idGenPresupuesto
    ) {
        $values = array(
            'idEstado' => 4
        );
        $this->db->where('idGenPresupuesto', $idGenPresupuesto);
        $result = $this->db->update('presupuesto', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Insertamos un nuevo historico de stock
     * @param type $idGenProducto
     * @param type $idGenTransaccion
     * @param type $idTipoMovimiento
     * @param type $cantidad
     * @param type $descripcion
     * @param type $aumento
     * @param type $idUsuario
     * @param type $fecha
     * @return type
     */
    public function insert_movimiento_stock($idGenProducto, $idGenTransaccion, $idTipoMovimiento, $cantidad, $descripcion, $aumento, $idUsuario, $fecha)
    {
        $values = array(
            'idGenProducto' => $idGenProducto,
            'idGenTransaccion' => $idGenTransaccion,
            'idTipoMovimiento' => $idTipoMovimiento,
            'cantidad' => $cantidad,
            'aumento' => $aumento,
            'descripcion' => $descripcion,
            'idUsuario' => $idUsuario,
            'fecha' => $fecha
        );
        $result = $this->db->insert('movimientos_stock', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     *
     * @param type $idGenProducto
     * @param type $idGenTransaccion
     * @param type $idTipoMovimiento
     * @param type $cantidad
     * @param type $descripcion
     * @param type $aumento
     * @param type $fecha
     * @return type
     */
    public function update_movimiento_stock($idGenProducto, $idGenTransaccion, $idTipoMovimiento, $cantidad, $descripcion, $aumento, $idUsuario, $fecha)
    {
        $values = array(
            'idGenProducto' => $idGenProducto,
            'idTipoMovimiento' => $idTipoMovimiento,
            'cantidad' => $cantidad,
            'aumento' => $aumento,
            'descripcion' => $descripcion,
            'idUsuario' => $idUsuario,
            'fecha' => $fecha
        );
        $this->db->where('idGenProducto', $idGenProducto);
        $this->db->where('idGenTransaccion', $idGenTransaccion);
        $result = $this->db->update('movimientos_stock', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Eliminar producto perteneciente a la transaccion de los movimientos del stock
     * @param type $idGenProducto
     * @param type $idGenTransaccion
     * @param type $idTipoMovimiento
     * @param type $aumento
     * @param type $idUsuario
     * @return type
     */
    public function drop_movimiento_stock($idGenProducto, $idGenTransaccion, $idTipoMovimiento, $descripcion, $aumento, $idUsuario)
    {
        $values = array(
            'eliminado' => 1,
            'idTipoMovimiento' => $idTipoMovimiento,
            'descripcion' => $descripcion,
            'aumento' => $aumento,
            'idUsuario' => $idUsuario
        );
        $this->db->where('idGenProducto', $idGenProducto);
        $this->db->where('idGenTransaccion', $idGenTransaccion);
        $result = $this->db->update('movimientos_stock', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Insertamos el historico del precio
     * @param type $idGenProducto
     * @param type $montoActual
     * @return type
     */
    public function insert_historico_precio($idGenProducto, $montoActual, $porcentajeDescuento)
    {
        $values = array(
            'idGenProducto' => $idGenProducto,
            'montoActual' => $montoActual,
            'porcentajeDescuento' => $porcentajeDescuento
        );
        $result = $this->db->insert('historico_precio', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Borrar el historico del producto
     * @param type $idGenProducto
     * @return type
     */
    public function drop_historico_precio($idGenProducto)
    {
        $values = array(
            'eliminado' => 1
        );
        $this->db->where('idGenProducto', $idGenProducto);
        $result = $this->db->update('historico_precio', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Cambiar el estado del turno de un usuario
     * @param type $idUsuario
     * @return type
     */
    public function update_turno_usuarios($idUsuario, $turno)
    {
        $values = array(
            'turno' => $turno
        );
        $this->db->where('idUsuario', $idUsuario);
        $result = $this->db->update('usuarios', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Registrar el nuevo historico de los movimientos de cajas
     * @param type $idGenHistoricoCajas
     * @param type $idUsuario
     * @param type $turnoAbierto
     * @param type $turnoCerrado
     * @param type $montoInicial
     * @param type $deposito
     * @param type $montoCajaRegistradora
     * @param type $margen
     * @return type
     */
    public function insert_arqueo_cajas($idGenArqueoCajas, $idUsuario, $fechaInicioTurno, $fechaFinTurno, $montoInicial, $deposito, $montoFinal, $montoEsperado, $pagosEfectivo, $pagosTarjeta)
    {
        $values = array(
            'idGenArqueoCajas' => $idGenArqueoCajas,
            'idUsuario' => $idUsuario,
            'fechaInicioTurno' => $fechaInicioTurno,
            'fechaFinTurno' => $fechaFinTurno,
            'montoInicial' => $montoInicial,
            'deposito' => $deposito,
            'montoFinal' => $montoFinal,
            'montoEsperado' => $montoEsperado,
            'pagosEfectivo' => $pagosEfectivo,
            'pagosTarjeta' => $pagosTarjeta
        );
        $result = $this->db->insert('arqueo_cajas', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Obtencion del historico completo de cajas
     * @return type
     */
    public function get_arqueo_cajas()
    {
        $this->db->select('
            ac.idArqueoCajas,
            ac.idGenArqueoCajas,
            ac.fechaInicioTurno,
            ac.fechaFinTurno,
            ac.montoInicial,
            ac.deposito,
            ac.montoFinal,
            ac.montoEsperado,
            ac.pagosEfectivo,
            ac.pagosTarjeta,
            ac.fechaAlta,
            ac.eliminado,
            u.usuario,
            tc.descripcion as cuenta,
            ');
        $this->db->where('ac.eliminado', 0);
        $this->db->join('usuarios as u', 'u.idUsuario = ac.idUsuario');
        $this->db->join('tesoreria_cuentas as tc', 'tc.idUsuario = u.idUsuario');
        $result = $this->db->get('arqueo_cajas as ac');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion del ultimo arqueo de cajas
     * @return type
     */
    public function get_arqueo_cajas_ultimo()
    {
        $this->db->select('
            ac.idArqueoCajas,
            ac.idGenArqueoCajas,
            ac.fechaInicioTurno,
            ac.fechaFinTurno,
            ac.montoInicial,
            ac.deposito,
            ac.montoFinal,
            ac.montoEsperado,
            ac.pagosEfectivo,
            ac.pagosTarjeta,
            ac.fechaAlta,
            ac.eliminado,
            u.usuario,
            tc.descripcion as cuenta,
            ');
        $this->db->where('ac.eliminado', 0);
        $this->db->where('ac.fechaFinTurno', "0000-00-00 00:00:00");
        $this->db->join('usuarios as u', 'u.idUsuario = ac.idUsuario');
        $this->db->join('tesoreria_cuentas as tc', 'tc.idUsuario = u.idUsuario');
        $this->db->order_by('ac.idArqueoCajas', 'DESC');
        $this->db->limit(1);
        $result = $this->db->get('arqueo_cajas as ac');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_arqueo_cajas_ultimo_filtro_dia_si_es_anterior()
    {
        $this->db->select('
            ac.idArqueoCajas,
            ac.idGenArqueoCajas,
            ac.fechaInicioTurno,
            ac.fechaFinTurno,
            ac.montoInicial,
            ac.deposito,
            ac.montoFinal,
            ac.montoEsperado,
            ac.pagosEfectivo,
            ac.pagosTarjeta,
            ac.fechaAlta,
            ac.eliminado,
            u.usuario,
            tc.descripcion as cuenta,
            ');
        $this->db->where('ac.eliminado', 0);
        $this->db->join('usuarios as u', 'u.idUsuario = ac.idUsuario');
        $this->db->join('tesoreria_cuentas as tc', 'tc.idUsuario = u.idUsuario');
        $this->db->order_by('ac.idArqueoCajas', 'DESC');
        $this->db->limit(1);
        $result = $this->db->get('arqueo_cajas as ac');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion del historico peteneciente al usuario que es pasado por parametro y aun no fue cerrado
     * @param type $idUsuario
     * @return type
     */
    public function get_arqueo_cajas_by_usuario_tunoNoCerrado($idUsuario)
    {
        $this->db->select('
            ac.idArqueoCajas,
            ac.idGenArqueoCajas,
            ac.fechaInicioTurno,
            ac.fechaFinTurno,
            ac.montoInicial,
            ac.deposito,
            ac.montoFinal,
            ac.montoEsperado,
            ac.pagosEfectivo,
            ac.pagosTarjeta,
            ac.fechaAlta,
            ac.eliminado,
            u.usuario,
            ');
        $this->db->join('usuarios as u', 'u.idUsuario = ac.idUsuario');
        $this->db->where('ac.eliminado', 0);
        $this->db->where('ac.fechaFinTurno', "0000-00-00 00:00:00");
        $this->db->where('ac.idUsuario', $idUsuario);
        $this->db->order_by('ac.fechaAlta', 'DESC');
        $this->db->limit(1);
        $result = $this->db->get('arqueo_cajas as ac');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion del historico de cajas para el usuario pasado por parametro y no haya sido abierto
     * @param type $idUsuario
     * @return type
     */
    public function get_arqueo_cajas_by_usuario_tunoNoAbierto($idUsuario)
    {
        $this->db->select('
            ac.idArqueoCajas,
            ac.idGenArqueoCajas,
            ac.fechaInicioTurno,
            ac.fechaFinTurno,
            ac.montoInicial,
            ac.deposito,
            ac.montoFinal,
            ac.montoEsperado,
            ac.pagosEfectivo,
            ac.pagosTarjeta,
            ac.fechaAlta,
            ac.eliminado,
            u.usuario,
            ');
        $this->db->join('usuarios as u', 'u.idUsuario = ac.idUsuario');
        $this->db->where('ac.eliminado', 0);
        $this->db->where('ac.fechaInicioTurno !=', "0000-00-00 00:00:00");
        $this->db->where('ac.fechaFinTurno', "0000-00-00 00:00:00");
        $this->db->where('ac.idUsuario', $idUsuario);
        $this->db->order_by('ac.fechaAlta', 'DESC');
        $this->db->limit(1);
        $result = $this->db->get('arqueo_cajas as ac');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de las cajas no cerradas
     * @return type
     */
    public function get_arqueo_cajas_by_tunoNoAbierto()
    {
        $this->db->select('
            ac.idArqueoCajas,
            ac.idGenArqueoCajas,
            ac.fechaInicioTurno,
            ac.fechaFinTurno,
            ac.montoInicial,
            ac.deposito,
            ac.montoFinal,
            ac.montoEsperado,
            ac.pagosEfectivo,
            ac.pagosTarjeta,
            ac.fechaAlta,
            ac.eliminado,
            u.usuario,
            ');
        $this->db->join('usuarios as u', 'u.idUsuario = ac.idUsuario');
        $this->db->where('ac.eliminado', 0);
        $this->db->where('u.idNivel', 10);
        $this->db->where('ac.fechaInicioTurno !=', "0000-00-00 00:00:00");
        $this->db->where('ac.fechaFinTurno', "0000-00-00 00:00:00");
        $this->db->order_by('ac.fechaAlta', 'DESC');
        $this->db->limit(1);
        $result = $this->db->get('arqueo_cajas as ac');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_arqueo_cajas_by_tunoNoAbierto_cajaNoEmpleado()
    {
        $this->db->select('
            ac.idArqueoCajas,
            ac.idGenArqueoCajas,
            ac.fechaInicioTurno,
            ac.fechaFinTurno,
            ac.montoInicial,
            ac.deposito,
            ac.montoFinal,
            ac.montoEsperado,
            ac.pagosEfectivo,
            ac.pagosTarjeta,
            ac.fechaAlta,
            ac.eliminado,
            u.usuario,
            ');
        $this->db->join('usuarios as u', 'u.idUsuario = ac.idUsuario');
        $this->db->where('ac.eliminado', 0);
        $this->db->where('u.idNivel !=', 10);
        $this->db->where('ac.fechaInicioTurno !=', "0000-00-00 00:00:00");
        $this->db->where('ac.fechaFinTurno', "0000-00-00 00:00:00");
        $this->db->order_by('ac.fechaAlta', 'DESC');
        $this->db->limit(1);
        $result = $this->db->get('arqueo_cajas as ac');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion del historico de cajas correspondientes al idGenHistoricoCajas
     * @param type $idGenHistoricoCajas
     * @return type
     */
    public function get_arqueo_cajas_by_idGenArqueoCajas($idGenArqueoCajas)
    {
        $this->db->select('
            ac.idArqueoCajas,
            ac.idGenArqueoCajas,
            ac.fechaInicioTurno,
            ac.fechaFinTurno,
            ac.montoInicial,
            ac.deposito,
            ac.montoFinal,
            ac.montoEsperado,
            ac.pagosEfectivo,
            ac.pagosTarjeta,
            ac.fechaAlta,
            ac.eliminado,
            u.usuario,
            ');
        $this->db->join('usuarios as u', 'u.idUsuario = ac.idUsuario');
        $this->db->where('ac.eliminado', 0);
        $this->db->where('ac.idGenArqueoCajas', $idGenArqueoCajas);
        $result = $this->db->get('arqueo_cajas as ac');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion del arqueo segun el id pasado por parametro
     * @param type $idArqueoCajas
     * @return type
     */
    public function get_arqueo_cajas_by_idArqueoCajas($idArqueoCajas)
    {
        $this->db->select('
            ac.idArqueoCajas,
            ac.idGenArqueoCajas,
            ac.fechaInicioTurno,
            ac.fechaFinTurno,
            ac.montoInicial,
            ac.deposito,
            ac.montoFinal,
            ac.montoEsperado,
            ac.pagosEfectivo,
            ac.pagosTarjeta,
            ac.fechaAlta,
            ac.eliminado,
            u.usuario,
            ');
        $this->db->join('usuarios as u', 'u.idUsuario = ac.idUsuario');
        $this->db->where('ac.eliminado', 0);
        $this->db->where('ac.idArqueoCajas', $idArqueoCajas);
        $result = $this->db->get('arqueo_cajas as ac');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_arqueo_cajas_by_fechaInicio($fechaIniciTurno)
    {
        $this->db->select('
            ac.idArqueoCajas,
            ac.idGenArqueoCajas,
            ac.fechaInicioTurno,
            ac.fechaFinTurno,
            ac.montoInicial,
            ac.deposito,
            ac.montoFinal,
            ac.montoEsperado,
            ac.pagosEfectivo,
            ac.pagosTarjeta,
            ac.fechaAlta,
            ac.eliminado,
            u.usuario,
            ');
        $this->db->join('usuarios as u', 'u.idUsuario = ac.idUsuario');
        $this->db->where('ac.eliminado', 0);
        $this->db->where('ac.fechaInicioTurno', $fechaIniciTurno);
        $result = $this->db->get('arqueo_cajas as ac');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_arqueo_cajas_by_fechaInicio_hoy($fechaIniciTurno)
    {
        $this->db->select('
            ac.idArqueoCajas,
            ac.idGenArqueoCajas,
            ac.fechaInicioTurno,
            ac.fechaFinTurno,
            ac.montoInicial,
            ac.deposito,
            ac.montoFinal,
            ac.montoEsperado,
            ac.pagosEfectivo,
            ac.pagosTarjeta,
            ac.fechaAlta,
            ac.eliminado,
            u.usuario,
            ');
        $this->db->join('usuarios as u', 'u.idUsuario = ac.idUsuario');
        $this->db->where('ac.eliminado', 0);
        $this->db->where('ac.fechaInicioTurno >=', $fechaIniciTurno);
        $result = $this->db->get('arqueo_cajas as ac');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_arqueo_cajas_by_fechaInicio_rango_dia($fechaIniciTurno0, $fechaIniciTurno24)
    {
        $this->db->select('
            ac.idArqueoCajas,
            ac.idGenArqueoCajas,
            ac.fechaInicioTurno,
            ac.fechaFinTurno,
            ac.montoInicial,
            ac.deposito,
            ac.montoFinal,
            ac.montoEsperado,
            ac.pagosEfectivo,
            ac.pagosTarjeta,
            ac.fechaAlta,
            ac.eliminado,
            u.usuario,
            ');
        $this->db->join('usuarios as u', 'u.idUsuario = ac.idUsuario');
        $this->db->where('ac.eliminado', 0);
        $this->db->where('ac.fechaInicioTurno >=', $fechaIniciTurno0);
        $this->db->where('ac.fechaInicioTurno <=', $fechaIniciTurno24);
        $result = $this->db->get('arqueo_cajas as ac');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Actualizacion del historico de cajas
     * @param type $idGenHistoricoCajas
     * @param type $idUsuario
     * @param type $turnoCerrado
     * @param type $deposito
     * @param type $montoCajaRegistradora
     * @param type $margen
     * @return type
     */
    public function update_arqueo_cajas($idGenArqueoCajas, $idUsuario, $fechaInicioTurno, $fechaFinTurno, $deposito, $montoFinal, $montoEsperado, $pagosEfectivo, $pagosTarjeta)
    {
        $values = array(
            'idUsuario' => $idUsuario,
            'fechaInicioTurno' => $fechaInicioTurno,
            'fechaFinTurno' => $fechaFinTurno,
            'deposito' => $deposito,
            'montoFinal' => $montoFinal,
            'montoEsperado' => $montoEsperado,
            'pagosEfectivo' => $pagosEfectivo,
            'pagosTarjeta' => $pagosTarjeta
        );
        $this->db->where('idGenArqueoCajas', $idGenArqueoCajas);
        $this->db->where('idUsuario', $idUsuario);
        $result = $this->db->update('arqueo_cajas', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function update_pagas_arqueo_cajas($idGenArqueoCajas, $pagosEfectivo)
    {
        $values = array(
            'pagosEfectivo' => $pagosEfectivo
        );
        $this->db->where('idGenArqueoCajas', $idGenArqueoCajas);
        $result = $this->db->update('arqueo_cajas', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Actualizacion del motivo en el arqueo de las cajas
     * @param type $idGenArqueoCajas
     * @param type $motivo
     * @return type
     */
    public function update_motivo_arqueo_cajas($idGenArqueoCajas, $motivo)
    {
        $values = array(
            'motivo' => $motivo
        );
        $this->db->where('idGenArqueoCajas', $idGenArqueoCajas);
        $result = $this->db->update('arqueo_cajas', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Registro de un deposito con los datos solicitados por parametros
     * @param type $idGenArqueoCajas
     * @param type $deposito
     * @return type
     */
    public function insert_deposito($idGenArqueoCajas, $deposito)
    {
        $values = array(
            'idGenArqueoCajas' => $idGenArqueoCajas,
            'deposito' => $deposito
        );
        $result = $this->db->insert('arqueo_cajas_depositos', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Obtencion de los depositos
     * @param type $idGenArqueoCajas
     * @param type $deposito
     * @return type
     */
    public function get_deposito($idGenArqueoCajas, $fechaIncioTurno)
    {
        $this->db->select('
            deposito
            ');
        $this->db->where('idGenArqueoCajas', $idGenArqueoCajas);
        $this->db->where('fechaAlta >=', $fechaIncioTurno);
        $result = $this->db->get('arqueo_cajas_depositos');

        return (($this->db->affected_rows() > 0) ? $result->result_array() : false);
    }

    public function update_deposito($idGenArqueoCajas, $montoEsperado)
    {
        $values = array(
            'montoEsperado' => $montoEsperado
        );
        $this->db->where('idGenArqueoCajas', $idGenArqueoCajas);
        $result = $this->db->update('arqueo_cajas', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    //--- Configuracion del sistema ---//
    /**
     * Obtencion de los tipos de modenas
     * @return type
     */
    public function get_tipo_moneda()
    {
        $this->db->select('*');
        $this->db->from('tipo_moneda');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de las condiciones de facturacion
     * @return type
     */
    public function get_condicion_facturacion()
    {
        $this->db->select('*');
        $this->db->from('condicion_facturacion');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de las empresas
     * @return type
     */
    public function get_empresas()
    {
        $this->db->select('
        empresa.idEmpresa,
        empresa.nombre,
        empresa.razonSocial,
        empresa.idTipoAnteAfip,
        empresa.cuit,
        empresa.iibb,
        empresa.inicioActividad,
        empresa.puntoVta,
        empresa.direccion,
        empresa.idPais,
        empresa.idProvincia,
        empresa.idLocalidad,
        empresa.localidad as localidadTxt,
        empresa.email,
        empresa.idTipoMoneda,
        empresa.idConceptoFactura,
        empresa.cel,
        empresa.tel,
        empresa.nombreSistema,
        empresa.logo,
        empresa.stock,
        empresa.arqueo,
        empresa.facturaElectronica,
        empresa.token,
        empresa.certificado,
        empresa.idGenCaja,
        empresa.fechaModificacion,
        localidades.localidad,
        provincias.provincia
        ');
        $this->db->join('provincias', 'provincias.idProvincia = empresa.idProvincia');
        $this->db->join('localidades', 'localidades.idLocalidad = empresa.idLocalidad');
        $result = $this->db->get('empresa');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de las empresas sin localidad y provincia
     * @return type
     */
    public function get_empresas_sin_localidad_provincia()
    {
        $this->db->select('
        empresa.idEmpresa,
        empresa.nombre,
        empresa.razonSocial,
        empresa.idTipoAnteAfip,
        empresa.cuit,
        empresa.iibb,
        empresa.inicioActividad,
        empresa.puntoVta,
        empresa.direccion,
        empresa.idPais,
        empresa.idProvincia,
        empresa.idLocalidad,
        empresa.localidad as localidadTxt,
        empresa.email,
        empresa.idTipoMoneda,
        empresa.idConceptoFactura,
        empresa.cel,
        empresa.tel,
        empresa.nombreSistema,
        empresa.logo,
        empresa.stock,
        empresa.arqueo,
        empresa.facturaElectronica,
        empresa.token,
        empresa.certificado,
        empresa.idGenCaja,
        empresa.fechaModificacion
        ');
        $result = $this->db->get('empresa');

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Agregamos una configuracion inicial
     * @param type $nombre
     * @param type $nombreEmpesa
     * @param type $cuit
     * @param type $tipoMoneda
     * @param type $correo
     * @param type $direccion
     * @param type $inicioActividad
     * @param type $iibb
     * @param type $tipoAnteAfip
     * @param type $puntoVenta
     * @param type $numTel
     * @param type $numCel
     * @param type $pais
     * @param type $provincia
     * @param type $localidad
     * @param type $localidadText
     * @param type $facturaElectronica
     * @param type $razonSocial
     * @param type $condicionFacturacion
     * @param type $stock
     * @param type $arqueo
     * @param type $token
     * @param type $certificado
     * @return type
     */
    public function insert_configuracion_sistema($nombre, $nombreEmpesa, $cuit, $tipoMoneda, $correo, $direccion, $inicioActividad, $iibb, $tipoAnteAfip, $puntoVenta, $numTel, $numCel, $pais, $provincia, $localidad, $localidadText, $facturaElectronica, $razonSocial, $condicionFacturacion, $stock, $arqueo, $token, $certificado, $caja)
    {
        $values = array(
            'nombre' => $nombre,
            'nombreSistema' => $nombreEmpesa,
            'cuit' => $cuit,
            'idTipoMoneda' => $tipoMoneda,
            'email' => $correo,
            'direccion' => $direccion,
            'inicioActividad' => $inicioActividad,
            'iibb' => $iibb,
            'idTipoAnteAfip' => $tipoAnteAfip,
            'puntoVta' => $puntoVenta,
            'tel' => $numTel,
            'cel' => $numCel,
            'idPais' => $pais,
            'idProvincia' => $provincia,
            'idLocalidad' => $localidad,
            'localidad' => $localidadText,
            'facturaElectronica' => $facturaElectronica,
            'stock' => $stock,
            'idConceptoFactura' => $condicionFacturacion,
            'razonSocial' => $razonSocial,
            'arqueo' => $arqueo,
            'token' => $token,
            'certificado' => $certificado,
            'idGenCaja' => $caja
        );
        $result = $this->db->insert('empresa', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Actualizacion de las configuraciones del sistema
     * @param type $id
     * @param type $nombre
     * @param type $nombreEmpesa
     * @param type $cuit
     * @param type $tipoMoneda
     * @param type $correo
     * @param type $direccion
     * @param type $inicioActividad
     * @param type $iibb
     * @param type $tipoAnteAfip
     * @param type $puntoVenta
     * @param type $numTel
     * @param type $numCel
     * @param type $pais
     * @param type $provincia
     * @param type $localidad
     * @param type $localidadText
     * @param type $facturaElectronica
     * @param type $razonSocial
     * @param type $condicionFacturacion
     * @param type $stock
     * @param type $arqueo
     * @param type $token
     * @param type $certificado
     * @return type
     */
    public function update_configuracion_sistema($id, $nombre, $nombreEmpesa, $cuit, $tipoMoneda, $correo, $direccion, $inicioActividad, $iibb, $tipoAnteAfip, $puntoVenta, $numTel, $numCel, $pais, $provincia, $localidad, $localidadText, $facturaElectronica, $razonSocial, $condicionFacturacion, $stock, $arqueo, $token, $certificado)
    {
        $values = array(
            'nombre' => $nombre,
            'nombreSistema' => $nombreEmpesa,
            'cuit' => $cuit,
            'idTipoMoneda' => $tipoMoneda,
            'email' => $correo,
            'direccion' => $direccion,
            'inicioActividad' => $inicioActividad,
            'iibb' => $iibb,
            'idTipoAnteAfip' => $tipoAnteAfip,
            'puntoVta' => $puntoVenta,
            'tel' => $numTel,
            'cel' => $numCel,
            'idPais' => $pais,
            'idProvincia' => $provincia,
            'idLocalidad' => $localidad,
            'localidad' => $localidadText,
            'facturaElectronica' => $facturaElectronica,
            'stock' => $stock,
            'idConceptoFactura' => $condicionFacturacion,
            'razonSocial' => $razonSocial,
            'arqueo' => $arqueo,
            'token' => $token,
            'certificado' => $certificado,
        );
        $this->db->where('idEmpresa', $id);
        $result = $this->db->update('empresa', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Actualizacion del registro del logo
     * @param type $id
     * @param type $nombreImagen
     * @return type
     */
    public function update_logo_empresa($id, $nombreImagen)
    {
        $values = array(
            'logo' => $nombreImagen,
        );
        $this->db->where('idEmpresa', $id);
        $result = $this->db->update('empresa', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Actualizacion de la visualizacion del arqueo en el menu
     * @param type $idMenu
     * @param type $valor
     * @return type
     */
    public function update_arqueo_menu($idMenu, $valor)
    {
        $values = array(
            'eliminado' => $valor,
        );
        $this->db->where('idMenu', $idMenu);
        $result = $this->db->update('menu', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function get_notas_tipos()
    {
        $this->db->select('');
        $this->db->from('notas_tipos');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtenemos las notas de creditos con sus join correspondientes
     * @return type
     */
    public function get_notas_credito()
    {
        $this->db->select('
                nc.idNotaCredito, 
                nc.idGenNotaCredito, 
                nc.idGenIngreso,
                nc.idTipoNota, 
                nt.descripcion as tipoNota,
                c.idCliente as idCliente,
                c.nombEmpresa as nombEmpresa,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                nc.fechaEmision, 
                nc.fechaVencimiento, 
                nc.descuentoGral, 
                nc.descuentoTotal,
                nc.importeNetoNoGravado, 
                nc.ivaTotal, 
                nc.notaCliente, 
                nc.notaInterna, 
                nc.subTotalSinDescuento, 
                nc.subTotalConDescuento, 
                nc.total,
                nc.idEstado, 
                nc.fechaAlta
                ');
        $this->db->from('notas_credito as nc');
        $this->db->join('notas_tipos as nt', 'nc.idTipoNota = nt.idTipoNota');
        $this->db->join('ingresos as i', 'nc.idGenIngreso = i.idGenIngreso');
        $this->db->join('clientes as c', 'nc.idCliente = c.idCliente');
        $this->db->join('usuarios as u', 'u.idUsuario = nc.idVendedor');
        $this->db->where('nc.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtenemos las notas de creditos correspondientes al idGenIngreso
     * @param type $idGenIngreso
     * @return type
     */
    public function get_notas_credito_by_idGenIngreso($idGenIngreso)
    {
        $this->db->select('
                nc.idNotaCredito, 
                nc.idGenNotaCredito, 
                nc.idGenIngreso,
                nc.idTipoNota, 
                nt.descripcion as tipoNota,
                c.idCliente as idCliente,
                c.nombEmpresa as nombEmpresa,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                nc.fechaEmision, 
                nc.fechaVencimiento, 
                nc.descuentoGral, 
                nc.descuentoTotal,
                nc.importeNetoNoGravado, 
                nc.ivaTotal, 
                nc.notaCliente, 
                nc.notaInterna, 
                nc.subTotalSinDescuento, 
                nc.subTotalConDescuento, 
                nc.total,
                nc.idEstado, 
                nc.fechaAlta
                ');
        $this->db->from('notas_credito as nc');
        $this->db->join('notas_tipos as nt', 'nc.idTipoNota = nt.idTipoNota');
        $this->db->join('ingresos as i', 'nc.idGenIngreso = i.idGenIngreso');
        $this->db->join('clientes as c', 'nc.idCliente = c.idCliente');
        $this->db->join('usuarios as u', 'u.idUsuario = nc.idVendedor');
        $this->db->where('nc.eliminado', 0);
        $this->db->where('nc.idGenIngreso', $idGenIngreso);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }
    
    /**
     * Obtencion de notas de credito con iva
     * @return type
     */
    public function get_notas_credito_con_iva()
    {
        $this->db->select('
                nc.idNotaCredito, 
                nc.idGenNotaCredito, 
                nc.idGenIngreso,
                nc.idTipoNota, 
                nt.descripcion as tipoNota,
                c.idCliente as idCliente,
                c.nombEmpresa as nombEmpresa, 
                cdf.cuit as cuit,
                ic.descripcion as condicionIva,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                nc.fechaEmision, 
                nc.fechaVencimiento, 
                nc.descuentoGral, 
                nc.descuentoTotal,
                nc.importeNetoNoGravado, 
                nc.ivaTotal, 
                nc.notaCliente, 
                nc.notaInterna, 
                nc.subTotalSinDescuento, 
                nc.subTotalConDescuento, 
                nc.total,
                nc.idEstado, 
                nc.fechaAlta
                ');
        $this->db->from('notas_credito as nc');
        $this->db->join('notas_tipos as nt', 'nc.idTipoNota = nt.idTipoNota');
        $this->db->join('ingresos as i', 'nc.idGenIngreso = i.idGenIngreso');
        $this->db->join('clientes as c', 'nc.idCliente = c.idCliente');
        $this->db->join('clientes_detalle_facturacion as cdf', 'cdf.idGenCliente = c.idGenCliente');
        $this->db->join('iva_condiciones as ic', 'ic.idCondicionIva = cdf.idCondIva');
        $this->db->join('usuarios as u', 'u.idUsuario = nc.idVendedor');
        $this->db->where('nc.ivaTotal >', 0);
        $this->db->where('nc.eliminado', 0);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }
    
    /**
     * Obtencion de notas de credito con iva
     * @return type
     */
    public function get_notas_credito_con_iva_sin_join()
    {
        $this->db->select('
                nc.idNotaCredito, 
                nc.idGenNotaCredito, 
                nc.idGenIngreso,
                nc.idTipoNota, 
                nt.descripcion as tipoNota,
                c.idCliente as idCliente,
                c.nombEmpresa as nombEmpresa, 
                cdf.cuit as cuit,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                nc.fechaEmision, 
                nc.fechaVencimiento, 
                nc.descuentoGral, 
                nc.descuentoTotal,
                nc.importeNetoNoGravado, 
                nc.ivaTotal, 
                nc.notaCliente, 
                nc.notaInterna, 
                nc.subTotalSinDescuento, 
                nc.subTotalConDescuento, 
                nc.total,
                nc.idEstado, 
                nc.fechaAlta
                ');
        $this->db->from('notas_credito as nc');
        $this->db->join('notas_tipos as nt', 'nc.idTipoNota = nt.idTipoNota');
        $this->db->join('ingresos as i', 'nc.idGenIngreso = i.idGenIngreso');
        $this->db->join('clientes as c', 'nc.idCliente = c.idCliente');
        $this->db->join('clientes_detalle_facturacion as cdf', 'cdf.idGenCliente = c.idGenCliente');
        $this->db->join('usuarios as u', 'u.idUsuario = nc.idVendedor');
        $this->db->where('nc.ivaTotal >', 0);
        $this->db->where('nc.eliminado', 0);
        $this->db->where('cdf.cuit', 0);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de notas de credito con iva
     * @return type
     */
    public function get_notas_credito_con_iva_con_rango($fechaInicio, $fechaFin)
    {
        $this->db->select('
                nc.idNotaCredito, 
                nc.idGenNotaCredito, 
                nc.idGenIngreso,
                nc.idTipoNota, 
                nt.descripcion as tipoNota,
                c.idCliente as idCliente,
                c.nombEmpresa as nombEmpresa, 
                cdf.cuit as cuit,
                ic.descripcion as condicionIva,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                nc.fechaEmision, 
                nc.fechaVencimiento, 
                nc.descuentoGral, 
                nc.descuentoTotal,
                nc.importeNetoNoGravado, 
                nc.ivaTotal, 
                nc.notaCliente, 
                nc.notaInterna, 
                nc.subTotalSinDescuento, 
                nc.subTotalConDescuento, 
                nc.total,
                nc.idEstado, 
                nc.fechaAlta
                ');
        $this->db->from('notas_credito as nc');
        $this->db->join('notas_tipos as nt', 'nc.idTipoNota = nt.idTipoNota');
        $this->db->join('ingresos as i', 'nc.idGenIngreso = i.idGenIngreso');
        $this->db->join('clientes as c', 'nc.idCliente = c.idCliente');
        $this->db->join('clientes_detalle_facturacion as cdf', 'cdf.idGenCliente = c.idGenCliente');
        $this->db->join('iva_condiciones as ic', 'ic.idCondicionIva = cdf.idCondIva');
        $this->db->join('usuarios as u', 'u.idUsuario = nc.idVendedor');
        $this->db->where('nc.fechaAlta >=', $fechaInicio);
        $this->db->where('nc.fechaAlta <=', $fechaFin);
        $this->db->where('nc.ivaTotal >=', 1);
        $this->db->where('nc.eliminado', 0);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtenemos las notas de creditos con sus join correspondientes proveedor
     * @return type
     */
    public function get_notas_credito_proveedor()
    {
        $this->db->select('
                nc.idNotaCredito, 
                nc.idGenNotaCredito, 
                nc.idGenEgreso,
                nc.idTipoNota, 
                nt.descripcion as tipoNota,
                p.idProveedor as idProveedor,
                p.nombEmpresa as nombEmpresa, 
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                nc.fechaEmision, 
                nc.fechaVencimiento, 
                nc.descuentoGral, 
                nc.descuentoTotal,
                nc.importeNetoNoGravado, 
                nc.ivaTotal, 
                nc.notaCliente, 
                nc.notaInterna, 
                nc.subTotalSinDescuento, 
                nc.subTotalConDescuento, 
                nc.total,
                nc.idEstado, 
                nc.fechaAlta
                ');
        $this->db->from('notas_credito_proveedores as nc');
        $this->db->join('notas_tipos as nt', 'nc.idTipoNota = nt.idTipoNota');
        $this->db->join('egresos as e', 'nc.idGenEgreso = e.idGenEgreso');
        $this->db->join('proveedores as p', 'p.idProveedor= e.idProveedor');
        $this->db->join('usuarios as u', 'u.idUsuario = nc.idVendedor');
        $this->db->where('nc.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * obtencion de las notas de credito de los proveedores con iva
     * @return type
     */
    public function get_notas_credito_proveedor_con_iva()
    {
        $this->db->select('
                nc.idNotaCredito, 
                nc.idGenNotaCredito, 
                nc.idGenEgreso,
                nc.idTipoNota, 
                nt.descripcion as tipoNota,
                p.idProveedor as idProveedor,
                p.nombEmpresa as nombEmpresa, 
                pdf.cuit as cuit,
                ic.descripcion as condicionIva,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                nc.fechaEmision, 
                nc.fechaVencimiento, 
                nc.descuentoGral, 
                nc.descuentoTotal,
                nc.importeNetoNoGravado, 
                nc.ivaTotal, 
                nc.notaCliente, 
                nc.notaInterna, 
                nc.subTotalSinDescuento, 
                nc.subTotalConDescuento, 
                nc.total,
                nc.idEstado, 
                nc.fechaAlta
                ');
        $this->db->from('notas_credito_proveedores as nc');
        $this->db->join('notas_tipos as nt', 'nc.idTipoNota = nt.idTipoNota');
        $this->db->join('egresos as e', 'nc.idGenEgreso = e.idGenEgreso');
        $this->db->join('proveedores as p', 'p.idProveedor= e.idProveedor');
        $this->db->join('proveedores_detalle_facturacion as pdf', 'pdf.idGenProveedor = p.idGenProveedor');
        $this->db->join('iva_condiciones as ic', 'ic.idCondicionIva = pdf.idCondIva');
        $this->db->join('usuarios as u', 'u.idUsuario = nc.idVendedor');
        $this->db->where('nc.ivaTotal >=', 1);
        $this->db->where('nc.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * obtencion de las notas de credito de los proveedores con iva
     * @return type
     */
    public function get_notas_credito_proveedor_con_iva_con_rango_fecha($fechaInicio, $fechaFin)
    {
        $this->db->select('
                nc.idNotaCredito, 
                nc.idGenNotaCredito, 
                nc.idGenEgreso,
                nc.idTipoNota, 
                nt.descripcion as tipoNota,
                p.idProveedor as idProveedor,
                p.nombEmpresa as nombEmpresa, 
                pdf.cuit as cuit,
                ic.descripcion as condicionIva,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                nc.fechaEmision, 
                nc.fechaVencimiento, 
                nc.descuentoGral, 
                nc.descuentoTotal,
                nc.importeNetoNoGravado, 
                nc.ivaTotal, 
                nc.notaCliente, 
                nc.notaInterna, 
                nc.subTotalSinDescuento, 
                nc.subTotalConDescuento, 
                nc.total,
                nc.idEstado, 
                nc.fechaAlta
                ');
        $this->db->from('notas_credito_proveedores as nc');
        $this->db->join('notas_tipos as nt', 'nc.idTipoNota = nt.idTipoNota');
        $this->db->join('egresos as e', 'nc.idGenEgreso = e.idGenEgreso');
        $this->db->join('proveedores as p', 'p.idProveedor= e.idProveedor');
        $this->db->join('proveedores_detalle_facturacion as pdf', 'pdf.idGenProveedor = p.idGenProveedor');
        $this->db->join('iva_condiciones as ic', 'ic.idCondicionIva = pdf.idCondIva');
        $this->db->join('usuarios as u', 'u.idUsuario = nc.idVendedor');
        $this->db->where('nc.fechaAlta >=', $fechaInicio);
        $this->db->where('nc.fechaAlta <=', $fechaFin);
        $this->db->where('nc.ivaTotal >=', 1);
        $this->db->where('nc.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtenemos la nota de credito correspondiente al id pasado por parametro
     * @param type $idNotaCredito
     * @return type
     */
    public function get_notas_credito_by_idNotaCredito($idNotaCredito)
    {
        $this->db->select('
                nc.idNotaCredito, 
                nc.idGenNotaCredito, 
                nc.idGenIngreso,
                nc.idTipoNota, 
                nt.descripcion as tipoNota,
                c.idCliente as idCliente,
                c.nombEmpresa as nombEmpresa, 
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                nc.fechaEmision, 
                nc.fechaVencimiento, 
                nc.descuentoGral, 
                nc.descuentoTotal,
                nc.importeNetoNoGravado, 
                nc.ivaTotal, 
                nc.notaCliente, 
                nc.notaInterna, 
                nc.subTotalSinDescuento, 
                nc.subTotalConDescuento, 
                nc.total,
                nc.idEstado, 
                nc.fechaAlta
                ');
        $this->db->from('notas_credito as nc');
        $this->db->join('notas_tipos as nt', 'nc.idTipoNota = nt.idTipoNota');
        $this->db->join('ingresos as i', 'nc.idGenIngreso = i.idGenIngreso');
        $this->db->join('clientes as c', 'nc.idCliente = c.idCliente');
        $this->db->join('usuarios as u', 'u.idUsuario = nc.idVendedor');
        $this->db->where('nc.idNotaCredito', $idNotaCredito);
        $this->db->where('nc.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de las notas de credito de los proveedores
     * @param type $idNotaCredito
     * @return type
     */
    public function get_notas_credito_proveedor_by_idNotaCredito($idNotaCredito)
    {
        $this->db->select('
                nc.idNotaCredito, 
                nc.idGenNotaCredito, 
                nc.idGenEgreso,
                nc.idTipoNota, 
                nt.descripcion as tipoNota,
                p.idProveedor as idProveedor,
                p.nombEmpresa as nombEmpresa, 
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                nc.fechaEmision, 
                nc.fechaVencimiento, 
                nc.descuentoGral, 
                nc.descuentoTotal,
                nc.importeNetoNoGravado, 
                nc.ivaTotal, 
                nc.notaCliente, 
                nc.notaInterna, 
                nc.subTotalSinDescuento, 
                nc.subTotalConDescuento, 
                nc.total,
                nc.idEstado, 
                nc.fechaAlta
                ');
        $this->db->from('notas_credito_proveedores as nc');
        $this->db->join('notas_tipos as nt', 'nc.idTipoNota = nt.idTipoNota');
        $this->db->join('egresos as e', 'nc.idGenEgreso = e.idGenEgreso');
        $this->db->join('proveedores as p', 'p.idProveedor = e.idProveedor');
        $this->db->join('usuarios as u', 'u.idUsuario = nc.idVendedor');
        $this->db->where('nc.idNotaCredito', $idNotaCredito);
        $this->db->where('nc.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion del detalle de las notas de credito que corresponda al idGenNotaCredito
     * @param type $idGenNotaCredito
     * @return type
     */
    public function get_detalle_notas_credito_by_idGenNotaCredito($idGenNotaCredito)
    {
        $this->db->select('
                ncd.idGenNotaCredito,
                ncd.idProducto,
                ncd.cantidad,
                ncd.precio,
                ncd.descuento,
                ncd.subTotal,
                ncd.iva,
                ncd.ivaText,
                p.codigo,
                p.nombre
                ');
        $this->db->from('notas_credito_detalle as ncd');
        $this->db->join('productos as p', 'ncd.idProducto = p.idProducto');
        $this->db->where('ncd.idGenNotaCredito', $idGenNotaCredito);
        $this->db->where('ncd.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de los detalles de las nota de credito
     * @param type $idGenNotaCredito
     * @return type
     */
    public function get_detalle_notas_credito_proveedor_by_idGenNotaCredito($idGenNotaCredito)
    {
        $this->db->select('
                ncd.idGenNotaCredito,
                ncd.idProducto,
                ncd.cantidad,
                ncd.precio,
                ncd.descuento,
                ncd.subTotal,
                ncd.iva,
                ncd.ivaText,
                p.codigo,
                p.nombre
                ');
        $this->db->from('notas_credito_proveedores_detalle as ncd');
        $this->db->join('productos as p', 'ncd.idProducto = p.idProducto');
        $this->db->where('ncd.idGenNotaCredito', $idGenNotaCredito);
        $this->db->where('ncd.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtenemos las notas de debito con sus join correspondientes
     * @return type
     */
    public function get_notas_debito()
    {
        $this->db->select('
                nd.idNotaDebito, 
                nd.idGenNotaDebito, 
                nd.idGenIngreso,
                nd.idTipoNota, 
                nt.descripcion as tipoNota,
                c.idCliente as idCliente,
                c.nombEmpresa as nombEmpresa, 
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                nd.fechaEmision, 
                nd.fechaVencimiento, 
                nd.descuentoGral, 
                nd.descuentoTotal,
                nd.importeNetoNoGravado, 
                nd.ivaTotal, 
                nd.notaCliente, 
                nd.notaInterna, 
                nd.subTotalSinDescuento, 
                nd.subTotalConDescuento, 
                nd.total,
                nd.idEstado, 
                nd.fechaAlta
                ');
        $this->db->from('notas_debito as nd');
        $this->db->join('notas_tipos as nt', 'nd.idTipoNota = nt.idTipoNota');
        $this->db->join('ingresos as i', 'nd.idGenIngreso = i.idGenIngreso');
        $this->db->join('clientes as c', 'nd.idCliente = c.idCliente');
        $this->db->join('usuarios as u', 'u.idUsuario = nd.idVendedor');
        $this->db->where('nd.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtenemos las notas de debitos que corresponden al idGenIngreso pasado por parametro
     * @param type $idGenIngreso
     * @return void
     */
    public function get_notas_debito_by_idGenIngreso($idGenIngreso)
    {
        $this->db->select('
                nd.idNotaDebito, 
                nd.idGenNotaDebito, 
                nd.idGenIngreso,
                nd.idTipoNota, 
                nt.descripcion as tipoNota,
                c.idCliente as idCliente,
                c.nombEmpresa as nombEmpresa, 
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                nd.fechaEmision, 
                nd.fechaVencimiento, 
                nd.descuentoGral, 
                nd.descuentoTotal,
                nd.importeNetoNoGravado, 
                nd.ivaTotal, 
                nd.notaCliente, 
                nd.notaInterna, 
                nd.subTotalSinDescuento, 
                nd.subTotalConDescuento, 
                nd.total,
                nd.idEstado, 
                nd.fechaAlta
                ');
        $this->db->from('notas_debito as nd');
        $this->db->join('notas_tipos as nt', 'nd.idTipoNota = nt.idTipoNota');
        $this->db->join('ingresos as i', 'nd.idGenIngreso = i.idGenIngreso');
        $this->db->join('clientes as c', 'nd.idCliente = c.idCliente');
        $this->db->join('usuarios as u', 'u.idUsuario = nd.idVendedor');
        $this->db->where('nd.eliminado', 0);
        $this->db->where('nd.idGenIngreso', $idGenIngreso);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de las notas de debito con iva
     * @return type
     */
    public function get_notas_debito_con_iva()
    {
        $this->db->select('
                nd.idNotaDebito, 
                nd.idGenNotaDebito, 
                nd.idGenIngreso,
                nd.idTipoNota, 
                nt.descripcion as tipoNota,
                c.idCliente as idCliente,
                c.nombEmpresa as nombEmpresa, 
                cdf.cuit as cuit,
                ic.descripcion as condicionIva,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                nd.fechaEmision, 
                nd.fechaVencimiento, 
                nd.descuentoGral, 
                nd.descuentoTotal,
                nd.importeNetoNoGravado, 
                nd.ivaTotal, 
                nd.notaCliente, 
                nd.notaInterna, 
                nd.subTotalSinDescuento, 
                nd.subTotalConDescuento, 
                nd.total,
                nd.idEstado, 
                nd.fechaAlta
                ');
        $this->db->from('notas_debito as nd');
        $this->db->join('notas_tipos as nt', 'nd.idTipoNota = nt.idTipoNota');
        $this->db->join('ingresos as i', 'nd.idGenIngreso = i.idGenIngreso');
        $this->db->join('clientes as c', 'nd.idCliente = c.idCliente');
        $this->db->join('clientes_detalle_facturacion as cdf', 'cdf.idGenCliente = c.idGenCliente');
        $this->db->join('usuarios as u', 'u.idUsuario = nd.idVendedor');
        $this->db->join('iva_condiciones as ic', 'ic.idCondicionIva = cdf.idCondIva');
        $this->db->where('nd.ivaTotal >', 0);
        $this->db->where('nd.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de las notas de debito con iva
     * @return type
     */
    public function get_notas_debito_con_iva_sin_join()
    {
        $this->db->select('
                nd.idNotaDebito, 
                nd.idGenNotaDebito, 
                nd.idGenIngreso,
                nd.idTipoNota, 
                nt.descripcion as tipoNota,
                c.idCliente as idCliente,
                c.nombEmpresa as nombEmpresa, 
                cdf.cuit as cuit,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                nd.fechaEmision, 
                nd.fechaVencimiento, 
                nd.descuentoGral, 
                nd.descuentoTotal,
                nd.importeNetoNoGravado, 
                nd.ivaTotal, 
                nd.notaCliente, 
                nd.notaInterna, 
                nd.subTotalSinDescuento, 
                nd.subTotalConDescuento, 
                nd.total,
                nd.idEstado, 
                nd.fechaAlta
                ');
        $this->db->from('notas_debito as nd');
        $this->db->join('notas_tipos as nt', 'nd.idTipoNota = nt.idTipoNota');
        $this->db->join('ingresos as i', 'nd.idGenIngreso = i.idGenIngreso');
        $this->db->join('clientes as c', 'nd.idCliente = c.idCliente');
        $this->db->join('clientes_detalle_facturacion as cdf', 'cdf.idGenCliente = c.idGenCliente');
        $this->db->join('usuarios as u', 'u.idUsuario = nd.idVendedor');
        $this->db->where('nd.ivaTotal >', 0);
        $this->db->where('nd.eliminado', 0);
        $this->db->where('cdf.cuit', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de las notas de debito con iva
     * @return type
     */
    public function get_notas_debito_con_iva_con_rango($fechaIncio, $fechaFin)
    {
        $this->db->select('
                nd.idNotaDebito, 
                nd.idGenNotaDebito, 
                nd.idGenIngreso,
                nd.idTipoNota, 
                nt.descripcion as tipoNota,
                c.idCliente as idCliente,
                c.nombEmpresa as nombEmpresa, 
                cdf.cuit as cuit,
                ic.descripcion as condicionIva,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                nd.fechaEmision, 
                nd.fechaVencimiento, 
                nd.descuentoGral, 
                nd.descuentoTotal,
                nd.importeNetoNoGravado, 
                nd.ivaTotal, 
                nd.notaCliente, 
                nd.notaInterna, 
                nd.subTotalSinDescuento, 
                nd.subTotalConDescuento, 
                nd.total,
                nd.idEstado, 
                nd.fechaAlta
                ');
        $this->db->from('notas_debito as nd');
        $this->db->join('notas_tipos as nt', 'nd.idTipoNota = nt.idTipoNota');
        $this->db->join('ingresos as i', 'nd.idGenIngreso = i.idGenIngreso');
        $this->db->join('clientes as c', 'nd.idCliente = c.idCliente');
        $this->db->join('clientes_detalle_facturacion as cdf', 'cdf.idGenCliente = c.idGenCliente');
        $this->db->join('usuarios as u', 'u.idUsuario = nd.idVendedor');
        $this->db->join('iva_condiciones as ic', 'ic.idCondicionIva = cdf.idCondIva');
        $this->db->where('nd.fechaAlta >=', $fechaIncio);
        $this->db->where('nd.fechaAlta <=', $fechaFin);
        $this->db->where('nd.ivaTotal >=', 1);
        $this->db->where('nd.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtenemos las notas de debito con sus join correspondientes proveedor
     * @return type
     */
    public function get_notas_debito_proveedor()
    {
        $this->db->select('
                nd.idNotaDebito, 
                nd.idGenNotaDebito, 
                nd.idGenEgreso,
                nd.idTipoNota, 
                nt.descripcion as tipoNota,
                p.idProveedor as idProveedor,
                p.nombEmpresa as nombEmpresa, 
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                nd.fechaEmision, 
                nd.fechaVencimiento, 
                nd.descuentoGral, 
                nd.descuentoTotal,
                nd.importeNetoNoGravado, 
                nd.ivaTotal, 
                nd.notaCliente, 
                nd.notaInterna, 
                nd.subTotalSinDescuento, 
                nd.subTotalConDescuento, 
                nd.total,
                nd.idEstado, 
                nd.fechaAlta
                ');
        $this->db->from('notas_debito_proveedores as nd');
        $this->db->join('notas_tipos as nt', 'nd.idTipoNota = nt.idTipoNota');
        $this->db->join('egresos as e', 'nd.idGenEgreso = e.idGenEgreso');
        $this->db->join('proveedores as p', 'p.idProveedor= e.idProveedor');
        $this->db->join('usuarios as u', 'u.idUsuario = nd.idVendedor');
        $this->db->where('nd.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de las notas de debito de los proveedores con iva
     * @return type
     */
    public function get_notas_debito_proveedor_con_iva()
    {
        $this->db->select('
                nd.idNotaDebito, 
                nd.idGenNotaDebito, 
                nd.idGenEgreso,
                nd.idTipoNota, 
                nt.descripcion as tipoNota,
                p.idProveedor as idProveedor,
                p.nombEmpresa as nombEmpresa, 
                pdf.cuit as cuit,
                ic.descripcion as condicionIva,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                nd.fechaEmision, 
                nd.fechaVencimiento, 
                nd.descuentoGral, 
                nd.descuentoTotal,
                nd.importeNetoNoGravado, 
                nd.ivaTotal, 
                nd.notaCliente, 
                nd.notaInterna, 
                nd.subTotalSinDescuento, 
                nd.subTotalConDescuento, 
                nd.total,
                nd.idEstado, 
                nd.fechaAlta
                ');
        $this->db->from('notas_debito_proveedores as nd');
        $this->db->join('notas_tipos as nt', 'nd.idTipoNota = nt.idTipoNota');
        $this->db->join('egresos as e', 'nd.idGenEgreso = e.idGenEgreso');
        $this->db->join('proveedores as p', 'p.idProveedor = e.idProveedor');
        $this->db->join('usuarios as u', 'u.idUsuario = nd.idVendedor');
        $this->db->join('proveedores_detalle_facturacion as pdf', 'pdf.idGenProveedor = p.idGenProveedor');
        $this->db->join('iva_condiciones as ic', 'ic.idCondicionIva = pdf.idCondIva');
        $this->db->where('nd.ivaTotal >=', 1);
        $this->db->where('nd.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de las notas de debito de los proveedores con iva
     * @return type
     */
    public function get_notas_debito_proveedor_con_iva_con_rango_fecha($fechaInicio, $fechaFin)
    {
        $this->db->select('
                nd.idNotaDebito, 
                nd.idGenNotaDebito, 
                nd.idGenEgreso,
                nd.idTipoNota, 
                nt.descripcion as tipoNota,
                p.idProveedor as idProveedor,
                p.nombEmpresa as nombEmpresa, 
                pdf.cuit as cuit,
                ic.descripcion as condicionIva,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                nd.fechaEmision, 
                nd.fechaVencimiento, 
                nd.descuentoGral, 
                nd.descuentoTotal,
                nd.importeNetoNoGravado, 
                nd.ivaTotal, 
                nd.notaCliente, 
                nd.notaInterna, 
                nd.subTotalSinDescuento, 
                nd.subTotalConDescuento, 
                nd.total,
                nd.idEstado, 
                nd.fechaAlta
                ');
        $this->db->from('notas_debito_proveedores as nd');
        $this->db->join('notas_tipos as nt', 'nd.idTipoNota = nt.idTipoNota');
        $this->db->join('egresos as e', 'nd.idGenEgreso = e.idGenEgreso');
        $this->db->join('proveedores as p', 'p.idProveedor = e.idProveedor');
        $this->db->join('usuarios as u', 'u.idUsuario = nd.idVendedor');
        $this->db->join('proveedores_detalle_facturacion as pdf', 'pdf.idGenProveedor = p.idGenProveedor');
        $this->db->join('iva_condiciones as ic', 'ic.idCondicionIva = pdf.idCondIva');
        $this->db->where('nd.fechaAlta >=', $fechaInicio);
        $this->db->where('nd.fechaAlta <=', $fechaFin);
        $this->db->where('nd.ivaTotal >=', 1);
        $this->db->where('nd.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     *
     * @param type $idNotaDebito
     * @return type
     */
    public function get_notas_debito_proveedor_by_idNotaDebito($idNotaDebito)
    {
        $this->db->select('
                nd.idNotaDebito, 
                nd.idGenNotaDebito, 
                nd.idGenEgreso,
                nd.idTipoNota, 
                nt.descripcion as tipoNota,
                p.idProveedor as idProveedor,
                p.nombEmpresa as nombEmpresa, 
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                nd.fechaEmision, 
                nd.fechaVencimiento, 
                nd.descuentoGral, 
                nd.descuentoTotal,
                nd.importeNetoNoGravado, 
                nd.ivaTotal, 
                nd.notaCliente, 
                nd.notaInterna, 
                nd.subTotalSinDescuento, 
                nd.subTotalConDescuento, 
                nd.total,
                nd.idEstado, 
                nd.fechaAlta
                ');
        $this->db->from('notas_debito_proveedores as nd');
        $this->db->join('notas_tipos as nt', 'nd.idTipoNota = nt.idTipoNota');
        $this->db->join('egresos as e', 'nd.idGenEgreso = e.idGenEgreso');
        $this->db->join('proveedores as p', 'p.idProveedor = e.idProveedor');
        $this->db->join('usuarios as u', 'u.idUsuario = nd.idVendedor');
        $this->db->where('nd.idNotaDebito', $idNotaDebito);
        $this->db->where('nd.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtenemos la nota de debito correspondiente al id pasado por parametro
     * @param type $idNotaDebito
     * @return type
     */
    public function get_notas_debito_by_idNotaDebito($idNotaDebito)
    {
        $this->db->select('
                nd.idNotaDebito, 
                nd.idGenNotaDebito, 
                nd.idGenIngreso,
                nd.idTipoNota, 
                nt.descripcion as tipoNota,
                c.idCliente as idCliente,
                c.nombEmpresa as nombEmpresa, 
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend,
                nd.fechaEmision, 
                nd.fechaVencimiento, 
                nd.descuentoGral, 
                nd.descuentoTotal,
                nd.importeNetoNoGravado, 
                nd.ivaTotal, 
                nd.notaCliente, 
                nd.notaInterna, 
                nd.subTotalSinDescuento, 
                nd.subTotalConDescuento, 
                nd.total,
                nd.idEstado, 
                nd.fechaAlta
                ');
        $this->db->from('notas_debito as nd');
        $this->db->join('notas_tipos as nt', 'nd.idTipoNota = nt.idTipoNota');
        $this->db->join('ingresos as i', 'nd.idGenIngreso = i.idGenIngreso');
        $this->db->join('clientes as c', 'nd.idCliente = c.idCliente');
        $this->db->join('usuarios as u', 'u.idUsuario = nd.idVendedor');
        $this->db->where('nd.idNotaDebito', $idNotaDebito);
        $this->db->where('nd.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion del detalle de las notas de debito que corresponda al idGenNotaDebito
     * @param type $idGenNotaDebito
     * @return type
     */
    public function get_detalle_notas_debito_by_idGenNotaDebito($idGenNotaDebito)
    {
        $this->db->select('
                ndd.idGenNotaDebito,
                ndd.idProducto,
                ndd.cantidad,
                ndd.precio,
                ndd.descuento,
                ndd.subTotal,
                ndd.iva,
                ndd.ivaText,
                p.codigo,
                p.nombre
                ');
        $this->db->from('notas_debito_detalle as ndd');
        $this->db->join('productos as p', 'ndd.idProducto = p.idProducto');
        $this->db->where('ndd.idGenNotaDebito', $idGenNotaDebito);
        $this->db->where('ndd.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de las notas de debito de los proveedores
     * @param type $idGenNotaDebito
     * @return type
     */
    public function get_detalle_notas_debito_proveedor_by_idGenNotaDebito($idGenNotaDebito)
    {
        $this->db->select('
                ndd.idGenNotaDebito,
                ndd.idProducto,
                ndd.cantidad,
                ndd.precio,
                ndd.descuento,
                ndd.subTotal,
                ndd.iva,
                ndd.ivaText,
                p.codigo,
                p.nombre
                ');
        $this->db->from('notas_debito_proveedores_detalle as ndd');
        $this->db->join('productos as p', 'ndd.idProducto = p.idProducto');
        $this->db->where('ndd.idGenNotaDebito', $idGenNotaDebito);
        $this->db->where('ndd.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Agregar una nueva nota de debito
     * @param type $idGenNotaDebito
     * @param type $idVendedor
     * @param type $selectCliente
     * @param type $inputFechaEmision
     * @param type $inputFechaVencimiento
     * @param type $selectTipoNota
     * @param type $selectVenta
     * @param type $notaCliente
     * @param type $notaInterna
     * @param type $importeNoGravado
     * @param type $subTotalSinDescuento
     * @param type $subTotalConDescuento
     * @param type $totalVenta
     * @param type $descuentoEfectuado
     * @param type $idEstado
     * @return type
     */
    public function insert_nota_debito($idGenNotaDebito, $idVendedor, $selectCliente, $inputFechaEmision, $inputFechaVencimiento, $selectTipoNota, $selectVenta, $ivaTotal, $notaCliente, $notaInterna, $importeNoGravado, $subTotalSinDescuento, $subTotalConDescuento, $totalVenta, $descuentoEfectuado, $idEstado)
    {
        $values = array(
            'idGenNotaDebito' => $idGenNotaDebito,
            'idGenIngreso' => $selectVenta,
            'idTipoNota' => $selectTipoNota,
            'idCliente' => $selectCliente,
            'idVendedor' => $idVendedor,
            'fechaEmision' => $inputFechaEmision,
            'fechaVencimiento' => $inputFechaVencimiento,
            'ivaTotal' => $ivaTotal,
            'notaCliente' => $notaCliente,
            'notaInterna' => $notaInterna,
            'importeNetoNoGravado' => $importeNoGravado,
            'descuentoTotal' => $descuentoEfectuado,
            'subTotalSinDescuento' => $subTotalSinDescuento,
            'subTotalConDescuento' => $subTotalConDescuento,
            'total' => $totalVenta,
            'idEstado' => $idEstado
        );
        $result = $this->db->insert('notas_debito', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Agregar una nueva nota de debito proveedor
     * @param type $idGenNotaDebito
     * @param type $idVendedor
     * @param type $selectProveedor
     * @param type $inputFechaEmision
     * @param type $inputFechaVencimiento
     * @param type $selectTipoNota
     * @param type $selectCompra
     * @param type $notaCliente
     * @param type $notaInterna
     * @param type $importeNoGravado
     * @param type $subTotalSinDescuento
     * @param type $subTotalConDescuento
     * @param type $totalVenta
     * @param type $descuentoEfectuado
     * @param type $idEstado
     * @return type
     */
    public function insert_nota_debito_proveedor($idGenNotaDebito, $idVendedor, $selectProveedor, $inputFechaEmision, $inputFechaVencimiento, $selectTipoNota, $selectCompra, $notaCliente, $notaInterna, $importeNoGravado, $subTotalSinDescuento, $subTotalConDescuento, $totalVenta, $descuentoEfectuado, $idEstado)
    {
        $values = array(
            'idGenNotaDebito' => $idGenNotaDebito,
            'idGenEgreso' => $selectCompra,
            'idTipoNota' => $selectTipoNota,
            'idProveedor' => $selectProveedor,
            'idVendedor' => $idVendedor,
            'fechaEmision' => $inputFechaEmision,
            'fechaVencimiento' => $inputFechaVencimiento,
            'notaCliente' => $notaCliente,
            'notaInterna' => $notaInterna,
            'importeNetoNoGravado' => $importeNoGravado,
            'descuentoTotal' => $descuentoEfectuado,
            'subTotalSinDescuento' => $subTotalSinDescuento,
            'subTotalConDescuento' => $subTotalConDescuento,
            'total' => $totalVenta,
            'idEstado' => $idEstado
        );
        $result = $this->db->insert('notas_debito_proveedores', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Agregar un nuevo detalle de la nota de debito
     * @param type $idGenNotaDebito
     * @param type $idProducto
     * @param type $cantidad
     * @param type $precio
     * @param type $descuento
     * @param type $subTotal
     * @param type $iva
     * @param type $ivaText
     * @return type
     */
    public function insert_nota_debito_detalle(
        $idGenNotaDebito,
        $idProducto,
        $cantidad,
        $precio,
        $descuento,
        $subTotal,
        $iva,
        $ivaText
    ) {
        $values = array(
            'idGenNotaDebito' => $idGenNotaDebito,
            'idProducto' => $idProducto,
            'cantidad' => $cantidad,
            'precio' => $precio,
            'descuento' => $descuento,
            'subTotal' => $subTotal,
            'iva' => $iva,
            'ivaText' => $ivaText
        );
        $result = $this->db->insert('notas_debito_detalle', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Agregar un nuevo detalle de la nota de debito proveedor
     * @param type $idGenNotaDebito
     * @param type $idProducto
     * @param type $cantidad
     * @param type $precio
     * @param type $descuento
     * @param type $subTotal
     * @param type $iva
     * @param type $ivaText
     * @return type
     */
    public function insert_nota_debito_proveedor_detalle(
        $idGenNotaDebito,
        $idProducto,
        $cantidad,
        $precio,
        $descuento,
        $subTotal,
        $iva,
        $ivaText
    ) {
        $values = array(
            'idGenNotaDebito' => $idGenNotaDebito,
            'idProducto' => $idProducto,
            'cantidad' => $cantidad,
            'precio' => $precio,
            'descuento' => $descuento,
            'subTotal' => $subTotal,
            'iva' => $iva,
            'ivaText' => $ivaText
        );
        $result = $this->db->insert('notas_debito_proveedores_detalle', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Actualizamos la nota de debito
     * @param type $idGenNotaDebito
     * @param type $idVendedor
     * @param type $selectCliente
     * @param type $inputFechaEmision
     * @param type $inputFechaVencimiento
     * @param type $selectTipoNota
     * @param type $selectVenta
     * @param type $notaCliente
     * @param type $notaInterna
     * @param type $importeNoGravado
     * @param type $subTotalSinDescuento
     * @param type $subTotalConDescuento
     * @param type $totalVenta
     * @param type $descuentoEfectuado
     * @param type $idEstado
     * @return type
     */
    public function update_nota_debito($idGenNotaDebito, $idVendedor, $selectCliente, $inputFechaEmision, $inputFechaVencimiento, $selectTipoNota, $selectVenta, $totalIva, $notaCliente, $notaInterna, $importeNoGravado, $subTotalSinDescuento, $subTotalConDescuento, $totalVenta, $descuentoEfectuado, $idEstado)
    {
        $values = array(
            'idGenNotaDebito' => $idGenNotaDebito,
            'idGenIngreso' => $selectVenta,
            'idTipoNota' => $selectTipoNota,
            'idCliente' => $selectCliente,
            'idVendedor' => $idVendedor,
            'fechaEmision' => $inputFechaEmision,
            'fechaVencimiento' => $inputFechaVencimiento,
            'ivaTotal' => $totalIva,
            'notaCliente' => $notaCliente,
            'notaInterna' => $notaInterna,
            'importeNetoNoGravado' => $importeNoGravado,
            'descuentoTotal' => $descuentoEfectuado,
            'subTotalSinDescuento' => $subTotalSinDescuento,
            'subTotalConDescuento' => $subTotalConDescuento,
            'total' => $totalVenta,
            'idEstado' => $idEstado
        );

        $this->db->where('idGenNotaDebito', $idGenNotaDebito);
        $result = $this->db->update('notas_debito', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function update_nota_debito_proveedor($idGenNotaDebito, $idVendedor, $selectProveedor, $inputFechaEmision, $inputFechaVencimiento, $selectTipoNota, $selectCompra, $notaCliente, $notaInterna, $importeNoGravado, $subTotalSinDescuento, $subTotalConDescuento, $totalVenta, $descuentoEfectuado, $idEstado)
    {
        $values = array(
            'idGenNotaDebito' => $idGenNotaDebito,
            'idGenEgreso' => $selectCompra,
            'idTipoNota' => $selectTipoNota,
            'idProveedor' => $selectProveedor,
            'idVendedor' => $idVendedor,
            'fechaEmision' => $inputFechaEmision,
            'fechaVencimiento' => $inputFechaVencimiento,
            'notaCliente' => $notaCliente,
            'notaInterna' => $notaInterna,
            'importeNetoNoGravado' => $importeNoGravado,
            'descuentoTotal' => $descuentoEfectuado,
            'subTotalSinDescuento' => $subTotalSinDescuento,
            'subTotalConDescuento' => $subTotalConDescuento,
            'total' => $totalVenta,
            'idEstado' => $idEstado
        );

        $this->db->where('idGenNotaDebito', $idGenNotaDebito);
        $result = $this->db->update('notas_debito_proveedores', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Actualizamos el detalle de una nota de debito
     * @param type $idGenNotaDebito
     * @param type $idProducto
     * @param type $cantidad
     * @param type $precio
     * @param type $descuento
     * @param type $subTotal
     * @param type $iva
     * @param type $ivaText
     * @return type
     */
    public function update_nota_debito_detalle(
        $idGenNotaDebito,
        $idProducto,
        $cantidad,
        $precio,
        $descuento,
        $subTotal,
        $iva,
        $ivaText
    ) {
        $values = array(
            'idGenNotaDebito' => $idGenNotaDebito,
            'idProducto' => $idProducto,
            'cantidad' => $cantidad,
            'precio' => $precio,
            'descuento' => $descuento,
            'subTotal' => $subTotal,
            'iva' => $iva,
            'ivaText' => $ivaText
        );

        $this->db->where('idGenNotaDebito', $idGenNotaDebito);
        $result = $this->db->update('notas_debito_detalle', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function update_nota_debito_proveedor_detalle(
        $idGenNotaDebito,
        $idProducto,
        $cantidad,
        $precio,
        $descuento,
        $subTotal,
        $iva,
        $ivaText
    ) {
        $values = array(
            'idGenNotaDebito' => $idGenNotaDebito,
            'idProducto' => $idProducto,
            'cantidad' => $cantidad,
            'precio' => $precio,
            'descuento' => $descuento,
            'subTotal' => $subTotal,
            'iva' => $iva,
            'ivaText' => $ivaText
        );

        $this->db->where('idGenNotaDebito', $idGenNotaDebito);
        $result = $this->db->update('notas_debito_proveedores_detalle', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Cambiar el estado a la nota de debito a abonado
     * @param type $idNotaDebito
     * @return type
     */
    public function abonar_nota_debito($idNotaDebito)
    {
        $values = array(
            'idEstado' => 2
        );

        $this->db->where('idNotaDebito', $idNotaDebito);
        $result = $this->db->update('notas_debito', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Abonar la nota de debito de los proveedores
     * @param type $idNotaDebito
     * @return type
     */
    public function abonar_nota_debito_proveedor($idNotaDebito)
    {
        $values = array(
            'idEstado' => 2
        );

        $this->db->where('idNotaDebito', $idNotaDebito);
        $result = $this->db->update('notas_debito_proveedores', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Borramos la nota de debito
     * @param type $idGenNotaDebito
     * @return type
     */
    public function drop_nota_debito($idGenNotaDebito)
    {
        $values = array(
            'eliminado' => 1
        );

        $this->db->where('idGenNotaDebito', $idGenNotaDebito);
        $result = $this->db->update('notas_debito', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Borramos la nota de debito proveedor asociada a ese idgen
     * @param type $idGenNotaDebito
     * @return type
     */
    public function drop_nota_debito_proveedor($idGenNotaDebito)
    {
        $values = array(
            'eliminado' => 1
        );

        $this->db->where('idGenNotaDebito', $idGenNotaDebito);
        $result = $this->db->update('notas_debito_proveedores', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Borramos el detalle de una nota de debito
     * @param type $idGenNotaDebito
     * @param type $idProducto
     * @return type
     */
    public function drop_nota_debito_detalle(
        $idGenNotaDebito,
        $idProducto
    ) {
        $values = array(
            'eliminado' => 1
        );

        $this->db->where('idGenNotaDebito', $idGenNotaDebito);
        $this->db->where('idProducto', $idProducto);
        $result = $this->db->update('notas_debito_detalle', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function drop_nota_debito_proveedor_detalle(
        $idGenNotaDebito,
        $idProducto
    ) {
        $values = array(
            'eliminado' => 1
        );

        $this->db->where('idGenNotaDebito', $idGenNotaDebito);
        $this->db->where('idProducto', $idProducto);
        $result = $this->db->update('notas_debito_proveedores_detalle', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Agregar una nueva nota de credito
     * @param type $idGenNotaCredito
     * @param type $idVendedor
     * @param type $selectCliente
     * @param type $inputFechaEmision
     * @param type $inputFechaVencimiento
     * @param type $selectTipoNota
     * @param type $selectVenta
     * @param type $totalIva
     * @param type $notaCliente
     * @param type $notaInterna
     * @param type $importeNoGravado
     * @param type $subTotalSinDescuento
     * @param type $subTotalConDescuento
     * @param type $totalVenta
     * @param type $descuentoEfectuado
     * @param type $idEstado
     * @return type
     */
    public function insert_nota_credito($idGenNotaCredito, $idVendedor, $selectCliente, $inputFechaEmision, $inputFechaVencimiento, $selectTipoNota, $selectVenta, $totalIva, $notaCliente, $notaInterna, $importeNoGravado, $subTotalSinDescuento, $subTotalConDescuento, $totalVenta, $descuentoEfectuado, $idEstado)
    {
        $values = array(
            'idGenNotaCredito' => $idGenNotaCredito,
            'idGenIngreso' => $selectVenta,
            'idTipoNota' => $selectTipoNota,
            'idCliente' => $selectCliente,
            'idVendedor' => $idVendedor,
            'fechaEmision' => $inputFechaEmision,
            'fechaVencimiento' => $inputFechaVencimiento,
            'ivaTotal' => $totalIva,
            'notaCliente' => $notaCliente,
            'notaInterna' => $notaInterna,
            'importeNetoNoGravado' => $importeNoGravado,
            'descuentoTotal' => $descuentoEfectuado,
            'subTotalSinDescuento' => $subTotalSinDescuento,
            'subTotalConDescuento' => $subTotalConDescuento,
            'total' => $totalVenta,
            'idEstado' => $idEstado
        );
        $result = $this->db->insert('notas_credito', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Agregar una nueva nota de credito proveedor
     * @param type $idGenNotaCredito
     * @param type $idVendedor
     * @param type $selectProveedor
     * @param type $inputFechaEmision
     * @param type $inputFechaVencimiento
     * @param type $selectTipoNota
     * @param type $selectCompra
     * @param type $notaCliente
     * @param type $notaInterna
     * @param type $importeNoGravado
     * @param type $subTotalSinDescuento
     * @param type $subTotalConDescuento
     * @param type $totalVenta
     * @param type $descuentoEfectuado
     * @param type $idEstado
     * @return type
     */
    public function insert_nota_credito_proveedor($idGenNotaCredito, $idVendedor, $selectProveedor, $inputFechaEmision, $inputFechaVencimiento, $selectTipoNota, $selectCompra, $notaCliente, $notaInterna, $importeNoGravado, $subTotalSinDescuento, $subTotalConDescuento, $totalVenta, $descuentoEfectuado, $idEstado)
    {
        $values = array(
            'idGenNotaCredito' => $idGenNotaCredito,
            'idGenEgreso' => $selectCompra,
            'idTipoNota' => $selectTipoNota,
            'idProveedor' => $selectProveedor,
            'idVendedor' => $idVendedor,
            'fechaEmision' => $inputFechaEmision,
            'fechaVencimiento' => $inputFechaVencimiento,
            'notaCliente' => $notaCliente,
            'notaInterna' => $notaInterna,
            'importeNetoNoGravado' => $importeNoGravado,
            'descuentoTotal' => $descuentoEfectuado,
            'subTotalSinDescuento' => $subTotalSinDescuento,
            'subTotalConDescuento' => $subTotalConDescuento,
            'total' => $totalVenta,
            'idEstado' => $idEstado
        );
        $result = $this->db->insert('notas_credito_proveedores', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Agregar un nuevo detalle de la nota de credito
     * @param type $idGenNotaCredito
     * @param type $idProducto
     * @param type $cantidad
     * @param type $precio
     * @param type $descuento
     * @param type $subTotal
     * @param type $iva
     * @param type $ivaText
     * @return type
     */
    public function insert_nota_credito_detalle(
        $idGenNotaCredito,
        $idProducto,
        $cantidad,
        $precio,
        $descuento,
        $subTotal,
        $iva,
        $ivaText
    ) {
        $values = array(
            'idGenNotaCredito' => $idGenNotaCredito,
            'idProducto' => $idProducto,
            'cantidad' => $cantidad,
            'precio' => $precio,
            'descuento' => $descuento,
            'subTotal' => $subTotal,
            'iva' => $iva,
            'ivaText' => $ivaText
        );
        $result = $this->db->insert('notas_credito_detalle', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Agregar un nuevo detalle de la nota de credito proveedor
     * @param type $idGenNotaCredito
     * @param type $idProducto
     * @param type $cantidad
     * @param type $precio
     * @param type $descuento
     * @param type $subTotal
     * @param type $iva
     * @param type $ivaText
     * @return type
     */
    public function insert_nota_credito_proveedor_detalle(
        $idGenNotaCredito,
        $idProducto,
        $cantidad,
        $precio,
        $descuento,
        $subTotal,
        $iva,
        $ivaText
    ) {
        $values = array(
            'idGenNotaCredito' => $idGenNotaCredito,
            'idProducto' => $idProducto,
            'cantidad' => $cantidad,
            'precio' => $precio,
            'descuento' => $descuento,
            'subTotal' => $subTotal,
            'iva' => $iva,
            'ivaText' => $ivaText
        );
        $result = $this->db->insert('notas_credito_proveedores_detalle', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Actualizamos la nota de credito
     * @param type $idGenNotaCredito
     * @param type $idVendedor
     * @param type $selectCliente
     * @param type $inputFechaEmision
     * @param type $inputFechaVencimiento
     * @param type $selectTipoNota
     * @param type $selectVenta
     * @param type $notaCliente
     * @param type $notaInterna
     * @param type $importeNoGravado
     * @param type $subTotalSinDescuento
     * @param type $subTotalConDescuento
     * @param type $totalVenta
     * @param type $descuentoEfectuado
     * @param type $idEstado
     * @return type
     */
    public function update_nota_credito($idGenNotaCredito, $idVendedor, $selectCliente, $inputFechaEmision, $inputFechaVencimiento, $selectTipoNota, $selectVenta, $ivaTotal, $notaCliente, $notaInterna, $importeNoGravado, $subTotalSinDescuento, $subTotalConDescuento, $totalVenta, $descuentoEfectuado, $idEstado)
    {
        $values = array(
            'idGenNotaCredito' => $idGenNotaCredito,
            'idGenIngreso' => $selectVenta,
            'idTipoNota' => $selectTipoNota,
            'idCliente' => $selectCliente,
            'idVendedor' => $idVendedor,
            'fechaEmision' => $inputFechaEmision,
            'fechaVencimiento' => $inputFechaVencimiento,
            'ivaTotal' => $ivaTotal,
            'notaCliente' => $notaCliente,
            'notaInterna' => $notaInterna,
            'importeNetoNoGravado' => $importeNoGravado,
            'descuentoTotal' => $descuentoEfectuado,
            'subTotalSinDescuento' => $subTotalSinDescuento,
            'subTotalConDescuento' => $subTotalConDescuento,
            'total' => $totalVenta,
            'idEstado' => $idEstado
        );

        $this->db->where('idGenNotaCredito', $idGenNotaCredito);
        $result = $this->db->update('notas_credito', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Actualizavion de notas de creditos de proveedor
     * @param type $idGenNotaCredito
     * @param type $idVendedor
     * @param type $selectProveedor
     * @param type $inputFechaEmision
     * @param type $inputFechaVencimiento
     * @param type $selectTipoNota
     * @param type $selectCompra
     * @param type $notaCliente
     * @param type $notaInterna
     * @param type $importeNoGravado
     * @param type $subTotalSinDescuento
     * @param type $subTotalConDescuento
     * @param type $totalVenta
     * @param type $descuentoEfectuado
     * @param type $idEstado
     * @return type
     */
    public function update_nota_credito_proveedor($idGenNotaCredito, $idVendedor, $selectProveedor, $inputFechaEmision, $inputFechaVencimiento, $selectTipoNota, $selectCompra, $notaCliente, $notaInterna, $importeNoGravado, $subTotalSinDescuento, $subTotalConDescuento, $totalVenta, $descuentoEfectuado, $idEstado)
    {
        $values = array(
            'idGenNotaCredito' => $idGenNotaCredito,
            'idGenEgreso' => $selectCompra,
            'idTipoNota' => $selectTipoNota,
            'idProveedor' => $selectProveedor,
            'idVendedor' => $idVendedor,
            'fechaEmision' => $inputFechaEmision,
            'fechaVencimiento' => $inputFechaVencimiento,
            'notaCliente' => $notaCliente,
            'notaInterna' => $notaInterna,
            'importeNetoNoGravado' => $importeNoGravado,
            'descuentoTotal' => $descuentoEfectuado,
            'subTotalSinDescuento' => $subTotalSinDescuento,
            'subTotalConDescuento' => $subTotalConDescuento,
            'total' => $totalVenta,
            'idEstado' => $idEstado
        );

        $this->db->where('idGenNotaCredito', $idGenNotaCredito);
        $result = $this->db->update('notas_credito_proveedores', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Actualizamos el detalle de una nota de credito
     * @param type $idGenNotaCredito
     * @param type $idProducto
     * @param type $cantidad
     * @param type $precio
     * @param type $descuento
     * @param type $subTotal
     * @param type $iva
     * @param type $ivaText
     * @return type
     */
    public function update_nota_credito_detalle(
        $idGenNotaCredito,
        $idProducto,
        $cantidad,
        $precio,
        $descuento,
        $subTotal,
        $iva,
        $ivaText
    ) {
        $values = array(
            'idGenNotaCredito' => $idGenNotaCredito,
            'idProducto' => $idProducto,
            'cantidad' => $cantidad,
            'precio' => $precio,
            'descuento' => $descuento,
            'subTotal' => $subTotal,
            'iva' => $iva,
            'ivaText' => $ivaText
        );

        $this->db->where('idGenNotaCredito', $idGenNotaCredito);
        $result = $this->db->update('notas_credito_detalle', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Actualizacion del detalle de la nota de credito proveedor
     * @param type $idGenNotaCredito
     * @param type $idProducto
     * @param type $cantidad
     * @param type $precio
     * @param type $descuento
     * @param type $subTotal
     * @param type $iva
     * @param type $ivaText
     * @return type
     */
    public function update_nota_credito_proveedor_detalle(
        $idGenNotaCredito,
        $idProducto,
        $cantidad,
        $precio,
        $descuento,
        $subTotal,
        $iva,
        $ivaText
    ) {
        $values = array(
            'idGenNotaCredito' => $idGenNotaCredito,
            'idProducto' => $idProducto,
            'cantidad' => $cantidad,
            'precio' => $precio,
            'descuento' => $descuento,
            'subTotal' => $subTotal,
            'iva' => $iva,
            'ivaText' => $ivaText
        );

        $this->db->where('idGenNotaCredito', $idGenNotaCredito);
        $result = $this->db->update('notas_credito_proveedores_detalle', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Borramos la nota de debito
     * @param type $idGenNotaDebito
     * @return type
     */
    public function drop_nota_credito($idGenNotaCredito)
    {
        $values = array(
            'eliminado' => 1
        );

        $this->db->where('idGenNotaCredito', $idGenNotaCredito);
        $result = $this->db->update('notas_credito', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Eliminamos la nota de credito del proveedor
     * @param type $idGenNotaCredito
     * @return type
     */
    public function drop_nota_credito_proveedor($idGenNotaCredito)
    {
        $values = array(
            'eliminado' => 1
        );

        $this->db->where('idGenNotaCredito', $idGenNotaCredito);
        $result = $this->db->update('notas_credito_proveedores', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Borramos el detalle de una nota de credito
     * @param type $idGenNotaCredito
     * @param type $idProducto
     * @return type
     */
    public function drop_nota_credito_detalle(
        $idGenNotaCredito,
        $idProducto
    ) {
        $values = array(
            'eliminado' => 1
        );

        $this->db->where('idGenNotaCredito', $idGenNotaCredito);
        $this->db->where('idProducto', $idProducto);
        $result = $this->db->update('notas_credito_detalle', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Borrado del detalle de la nota de credito proveedor
     * @param type $idGenNotaCredito
     * @param type $idProducto
     * @return type
     */
    public function drop_nota_credito_proveedor_detalle(
        $idGenNotaCredito,
        $idProducto
    ) {
        $values = array(
            'eliminado' => 1
        );

        $this->db->where('idGenNotaCredito', $idGenNotaCredito);
        $this->db->where('idProducto', $idProducto);
        $result = $this->db->update('notas_credito_proveedores_detalle', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Insertamos una nueva configuracion del ecommerce
     * @param type $idGenConfiguracionEcommerce
     * @param type $titulo
     * @param type $nombreEmpresa
     * @param type $whatsapp
     * @param type $facebook
     * @param type $twitter
     * @param type $colorEnlacePrincipal
     * @param type $colorSecundario
     * @param type $colorTexto
     * @param type $prodcutoEcommerce
     * @param type $selectTarifaInternacional
     * @param type $inputTarifaInternacional
     * @param type $selectTarifaNacional
     * @param type $inputTarifaNacional
     * @param type $selectTarifaCadeteria
     * @param type $selectTarifaMercadoEnvio
     * @param type $inputTarifaMercadoEnvio
     * @param type $selectPagosEfectivo
     * @param type $selectPagosEfectivoContraEntrega
     * @param type $selectPagosMercadoPago
     * @return type
     */
    public function insert_configuracion_ecommerce(
        $idGenConfiguracionEcommerce,
        $titulo,
        $nombreEmpresa,
        $whatsapp,
        $facebook,
        $twitter,
        $colorEnlacePrincipal,
        $colorSecundario,
        $colorTexto,
        $prodcutoEcommerce,
        $selectTarifaInternacional,
        $inputTarifaInternacional,
        $selectTarifaNacional,
        $inputTarifaNacional,
        $selectTarifaCadeteria,
        $selectTarifaMercadoEnvio,
        $inputTarifaMercadoEnvio,
        $selectPagosEfectivo,
        $selectPagosEfectivoContraEntrega,
        $selectPagosMercadoPago
    ) {
        $values = array(
            'idGenConfiguracionEcommerce' => $idGenConfiguracionEcommerce,
            'titulo' => $titulo,
            'nombreEmpresa' => $nombreEmpresa,
            'whatsapp' => $whatsapp,
            'facebook' => $facebook,
            'twitter' => $twitter,
            'colorEnlacePrincipal' => $colorEnlacePrincipal,
            'colorSecundario' => $colorSecundario,
            'colorTexto' => $colorTexto,
            'ecommerce' => $prodcutoEcommerce,
            'envioInternacional' => $selectTarifaInternacional,
            'tarifaInternacional' => $inputTarifaInternacional,
            'envioNacional' => $selectTarifaNacional,
            'tarifaNacional' => $inputTarifaNacional,
            'envioCadeteria' => $selectTarifaCadeteria,
            'envioMercadoEnvio' => $selectTarifaMercadoEnvio,
            'tarifaMercadoEnvio' => $inputTarifaMercadoEnvio,
            'pagosEfectivo' => $selectPagosEfectivo,
            'pagosEfecCEntrega' => $selectPagosEfectivoContraEntrega,
            'pagosMercadoPago' => $selectPagosMercadoPago
        );

        $result = $this->db->insert('configuraciones_ecommerce', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Actualizamos los datos de la configuracion ecommerce
     * @param type $idGenConfiguracionEcommerce
     * @param type $titulo
     * @param type $nombreImgLogo
     * @param type $nombreEmpresa
     * @param type $whatsapp
     * @param type $facebook
     * @param type $twitter
     * @param type $colorEnlacePrincipal
     * @param type $colorSecundario
     * @param type $colorTexto
     * @return type
     */
    public function update_configuracion_ecommerce(
        $idGenConfiguracionEcommerce,
        $titulo,
        $nombreEmpresa,
        $whatsapp,
        $facebook,
        $twitter,
        $colorEnlacePrincipal,
        $colorSecundario,
        $colorTexto,
        $prodcutoEcommerce,
        $selectTarifaInternacional,
        $inputTarifaInternacional,
        $selectTarifaNacional,
        $inputTarifaNacional,
        $selectTarifaCadeteria,
        $selectTarifaMercadoEnvio,
        $inputTarifaMercadoEnvio,
        $selectPagosEfectivo,
        $selectPagosEfectivoContraEntrega,
        $selectPagosMercadoPago
    ) {
        $values = array(
            'titulo' => $titulo,
            'nombreEmpresa' => $nombreEmpresa,
            'whatsapp' => $whatsapp,
            'facebook' => $facebook,
            'twitter' => $twitter,
            'colorEnlacePrincipal' => $colorEnlacePrincipal,
            'colorSecundario' => $colorSecundario,
            'colorTexto' => $colorTexto,
            'ecommerce' => $prodcutoEcommerce,
            'envioInternacional' => $selectTarifaInternacional,
            'tarifaInternacional' => $inputTarifaInternacional,
            'envioNacional' => $selectTarifaNacional,
            'tarifaNacional' => $inputTarifaNacional,
            'envioCadeteria' => $selectTarifaCadeteria,
            'envioMercadoEnvio' => $selectTarifaMercadoEnvio,
            'tarifaMercadoEnvio' => $inputTarifaMercadoEnvio,
            'pagosEfectivo' => $selectPagosEfectivo,
            'pagosEfecCEntrega' => $selectPagosEfectivoContraEntrega,
            'pagosMercadoPago' => $selectPagosMercadoPago
        );

        $this->db->where('idGenConfiguracionEcommerce', $idGenConfiguracionEcommerce);
        $result = $this->db->update('configuraciones_ecommerce', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function update_configuracion_ecommerce_logo(
        $idGenConfiguracionEcommerce,
        $nombreImgLogo
    ) {
        $values = array(
            'logo' => $nombreImgLogo
        );

        $this->db->where('idGenConfiguracionEcommerce', $idGenConfiguracionEcommerce);
        $result = $this->db->update('configuraciones_ecommerce', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Obtenemos las configuraciones del ecommerce
     * @return type
     */
    public function get_configuracion_ecommerce()
    {
        $this->db->select('*');
        $this->db->from('configuraciones_ecommerce');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtenemos los costos de envios para la cadeteria
     * @return type
     */
    public function get_envios_costos()
    {
        $this->db->select('*');
        $this->db->from('envios_costos');
        $this->db->where('eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtenemos el registro del costo de envio correspondiente al id
     * @param type $id
     * @return type
     */
    public function get_envios_costos_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('envios_costos');
        $this->db->where('idEnvioCosto', $id);
        $this->db->where('eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Agregado de un costo de envio nuevo
     * @param type $id
     * @param type $tarifa
     * @param type $cuadras
     * @param type $descripcion
     * @return type
     */
    public function insert_envio_costo($id, $tarifa, $cuadras, $descripcion)
    {
        $values = array(
            'costo' => $tarifa,
            'cantidad' => $cuadras,
            'descripcion' => $descripcion
        );

        $result = $this->db->insert('envios_costos', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Actualizamos el costo del envio
     * @param type $id
     * @param type $tarifa
     * @param type $cuadras
     * @param type $descripcion
     * @return type
     */
    public function update_envio_costo($id, $tarifa, $cuadras, $descripcion)
    {
        $values = array(
            'costo' => $tarifa,
            'cantidad' => $cuadras,
            'descripcion' => $descripcion
        );

        $this->db->where('idEnvioCosto', $id);
        $result = $this->db->update('envios_costos', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function drop_envios_costos($id)
    {
        $values = array(
            'eliminado' => 1
        );

        $this->db->where('idEnvioCosto', $id);
        $result = $this->db->update('envios_costos', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Imagenes de las configuraciones del ecommerce
     * @return type
     */
    public function get_configuracion_ecommerce_imagenes()
    {
        $this->db->select('*');
        $this->db->from('configuraciones_ecommerce_imagenes');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_configuracion_ecommerce_imagenes_no_vacio()
    {
        $this->db->select('*');
        $this->db->where('nombre !=', "");
        $this->db->from('configuraciones_ecommerce_imagenes');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Guardamos las fotos para el banner
     * @param type $idGenConfiguracionEcommerce
     * @param type $nombreImgImagenBanner
     * @return type
     */
    public function insert_configuracion_ecommerce_imagen(
        $idGenConfiguracionEcommerce,
        $nombreImgImagenBanner,
        $id
    ) {
        $values = array(
            'idGenConfiguracionEcommerce' => $idGenConfiguracionEcommerce,
            'nombre' => $nombreImgImagenBanner,
            'posicion' => $id
        );
        $result = $this->db->insert('configuraciones_ecommerce_imagenes', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Actualizamos el nombre de la imagen
     * @param type $idGenConfiguracionEcommerce
     * @param type $nombreImgImagenBanner
     * @return type
     */
    public function update_configuracion_ecommerce_imagen(
        $idGenConfiguracionEcommerce,
        $nombreImgImagenBanner,
        $id
    ) {
        $values = array(
            'nombre' => $nombreImgImagenBanner
        );
        $this->db->where('posicion', $id);
        $this->db->where('idGenConfiguracionEcommerce', $idGenConfiguracionEcommerce);
        $result = $this->db->update('configuraciones_ecommerce_imagenes', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Eliminamos la imagen
     * @param type $idGenConfiguracionEcommerce
     * @param type $id
     * @return type
     */
    public function drop_configuracion_ecommerce_imagen(
        $idGenConfiguracionEcommerce,
        $id
    ) {
        $values = array(
            'nombre' => ""
        );
        $this->db->where('posicion', $id);
        $this->db->where('idGenConfiguracionEcommerce', $idGenConfiguracionEcommerce);
        $result = $this->db->update('configuraciones_ecommerce_imagenes', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Obtencion de los movimientos de inventario
     * @return type
     */
    public function get_movimientos_inventario()
    {
        $this->db->select('
                ms.idMovimientoStock,
                ms.cantidad,
                ms.aumento,
                ms.fechaAlta,
                p.nombre as nombreProducto,
                mst.descripcion as tipoMovimiento,
                u.nombreCompleto as nombreVend, 
                u.apellido as apellidoVend, 
                u.idUsuario as idUsuarioVend
            ');
        $this->db->from('movimientos_stock as ms');
        $this->db->join('productos as p', 'ms.idGenProducto = p.idGenProducto');
        $this->db->join('usuarios as u', 'u.idUsuario = ms.idUsuario');
        $this->db->join('movimientos_stock_tipo as mst', 'mst.idMovimientoStockTipo = ms.idTipoMovimiento');
        $this->db->where('ms.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de los tipos de remitos
     * @return type
     */
    public function get_tipos_remitos()
    {
        $this->db->select('*');
        $this->db->from('remitos_tipo');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de los transportistas
     * @return type
     */
    public function get_transportistas()
    {
        $this->db->select('*');
        $this->db->from('transportistas');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de los transportistas que corresponda al idTransportista
     * @return type
     */
    public function get_transportistas_by_idTransportista($idTransportista)
    {
        $this->db->select('*');
        $this->db->from('transportistas');
        $this->db->where('idTransportista', $idTransportista);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtencion de los transportistas
     * @return type
     */
    public function get_transportistas_inversa()
    {
        $this->db->select('*');
        $this->db->from('transportistas');
        $this->db->order_by('idTransportista', 'DESC');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Agregado un nuevo transportista
     * @param type $nombreTransportista
     * @return type
     */
    public function insert_transportista($nombreTransportista)
    {
        $values = array(
            'nombre' => $nombreTransportista
        );

        $result = $this->db->insert('transportistas', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Agregado un nuevo remito
     * @param type $idGenRemito
     * @param type $idGenIngreso
     * @param type $cliente
     * @param type $domicilio
     * @param type $fechaEmision
     * @param type $tipoRemito
     * @param type $transportista
     * @param type $nota_cliente
     * @param type $cantidadBultos
     * @param type $montoAsegurado
     * @return type
     */
    public function insert_remito($idGenRemito, $idGenIngreso, $cliente, $domicilio, $fechaEmision, $tipoRemito, $transportista, $nota_cliente, $cantidadBultos, $montoAsegurado)
    {
        $values = array(
            'idGenRemito' => $idGenRemito,
            'idGenIngreso' => $idGenIngreso,
            'nombreApellido' => $cliente,
            'direccionEntrega' => $domicilio,
            'fechaEmision' => $fechaEmision,
            'idTipoRemito' => $tipoRemito,
            'idTransportista' => $transportista,
            'notaCliente' => $nota_cliente,
            'cantidadBultos' => $cantidadBultos,
            'montoAsegurado' => $montoAsegurado,
        );

        $result = $this->db->insert('remitos', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Agregado un nuevo remito
     * @param type $idGenRemito
     * @param type $idProducto
     * @param type $observacion
     * @param type $cantidad
     * @return type
     */
    public function insert_detalle_remito($idGenRemito, $idProducto, $observacion, $cantidad)
    {
        $values = array(
            'idGenRemito' => $idGenRemito,
            'idProducto' => $idProducto,
            'observacion' => $observacion,
            'cantidad' => $cantidad
        );

        $result = $this->db->insert('remitos_detalle', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }
    
    /**
     * Obtencion de los remitos que perteneces al idGenIngreso
     * @return type
     */
    public function get_remitos_by_idGenIngreso($idGenIngreso)
    {
        $this->db->select('
        r.idRemito,
        r.idGenRemito,
        r.idGenIngreso,
        r.nombreApellido,
        r.fechaEmision,
        r.idTipoRemito,
        r.direccionEntrega,
        r.idTransportista,
        r.notaCliente,
        r.cantidadBultos,
        r.montoAsegurado,
        r.fechaAlta,
        t.nombre as transportista
        ');
        $this->db->from('remitos as r');
        $this->db->join('transportistas as t', 't.idTransportista = r.idTransportista');
        $this->db->where('r.idGenIngreso', $idGenIngreso);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }
    
    /**
     * Obtencion de los remitos que perteneces al idGenIngreso sin transportista 
     * @return type
     */
    public function get_remitos_by_idGenIngreso_sin_transportistas($idGenIngreso)
    {
        $this->db->select('
        r.idRemito,
        r.idGenRemito,
        r.idGenIngreso,
        r.nombreApellido,
        r.fechaEmision,
        r.idTipoRemito,
        r.direccionEntrega,
        r.idTransportista,
        r.notaCliente,
        r.cantidadBultos,
        r.montoAsegurado,
        r.fechaAlta,
        ');
        $this->db->from('remitos as r');
        $this->db->where('r.idGenIngreso', $idGenIngreso);
        $this->db->where('r.idTransportista', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }
    
    /**
     * Obtencion de los remitos que perteneces al idGenRemito
     * @return type
     */
    public function get_remito_by_idGenRemito($idGenRemito)
    {
        $this->db->select('
        r.idRemito,
        r.idGenRemito,
        r.idGenIngreso,
        r.nombreApellido,
        r.fechaEmision,
        r.idTipoRemito,
        r.direccionEntrega,
        r.idTransportista,
        r.notaCliente,
        r.cantidadBultos,
        r.montoAsegurado,
        r.fechaAlta,
        ');
        $this->db->from('remitos as r');
        $this->db->order_by('r.idRemito', 'ASC');
        $this->db->where('r.idGenRemito', $idGenRemito);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

        
    /**
     * Obtencion de los remitos que perteneces al idGenRemito
     * @return type
     */
    public function get_remitos_detalle_by_idGenRemito($idGenRemito)
    {
        $this->db->select('
        rd.idDetalleRemito,
        rd.idGenRemito,
        rd.idProducto,
        rd.observacion,
        rd.cantidad,
        rd.fechaAlta,
        p.codigo,
        p.nombre as producto
        ');
        $this->db->from('remitos_detalle as rd');
        $this->db->join('productos as p', 'p.idProducto = rd.idProducto');
        $this->db->order_by('rd.idDetalleRemito', 'ASC');
        $this->db->where('rd.idGenRemito', $idGenRemito);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Actualizamos los datos del remito perteneciente al idGenRemito
     *
     * @param [type] $idGenRemito
     * @param [type] $cliente
     * @param [type] $domicilio
     * @param [type] $fechaEmision
     * @param [type] $tipoRemito
     * @param [type] $transportista
     * @param [type] $nota_cliente
     * @param [type] $cantidadBultos
     * @param [type] $montoAsegurado
     * @return void
     */
    public function update_remito($idGenRemito, $cliente, $domicilio, $fechaEmision, $tipoRemito, $transportista, $nota_cliente, $cantidadBultos, $montoAsegurado)
    {
        $values = array(
            'nombreApellido' => $cliente,
            'direccionEntrega' => $domicilio,
            'fechaEmision' => $fechaEmision,
            'idTipoRemito' => $tipoRemito,
            'idTransportista' => $transportista,
            'notaCliente' => $nota_cliente,
            'cantidadBultos' => $cantidadBultos,
            'montoAsegurado' => $montoAsegurado,
        );
        $this->db->where('idGenRemito', $idGenRemito);
        $result = $this->db->update('remitos', $values);
        return ($this->db->affected_rows() > 0) ? true : false;
    }
    
    /**
     * Actualizamos los datos del detalle de remito
     *
     * @param [type] $idGenRemito
     * @param [type] $idProducto
     * @param [type] $observacion
     * @param [type] $cantidad
     * @return void
     */
    public function update_detalle_remito($idGenRemito, $idProducto, $observacion, $cantidad)
    {
        $values = array(
            'observacion' => $observacion,
            'cantidad' => $cantidad
        );
        $this->db->where('idGenRemito', $idGenRemito);
        $this->db->where('idProducto', $idProducto);
        $result = $this->db->update('remitos_detalle', $values);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function drop_detalle_remito($idGenRemito, $idProducto)
    {
        $this->db->delete('remitos_detalle', array('idGenRemito' => $idGenRemito, 'idProducto' => $idProducto));

        return (($this->db->affected_rows() > 0) ? true : false);
    }
}
