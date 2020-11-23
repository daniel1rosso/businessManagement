<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class App_model_user extends CI_Model
{
    /**
     * User valitation
     *
     * @param [type] $username
     * @param [type] $password
     * @return void
     */
    public function compare_username_password($username, $password)
    {
        $values = array(
            'usuario' => $username,
            'password' => $password
        );
        $this->db->where($values);
        $this->db->where('eliminado', 0);
        $result = $this->db->get('usuarios');
        return ($result != '') ? $result->result_array() : false;
    }

    /**
     * New session log the user
     *
     * @param [type] $idUser
     * @param [type] $nombreUser
     * @param [type] $idNivel
     * @return void
     */
    public function set_log_usuario($idUser, $nombreUser, $idNivel)
    {
        $values = array(
            'idUsuarioLog' => $idUser,
            'usuarioLog' => $nombreUser,
            'idNivel' => $idNivel
        );

        $result = $this->db->insert('session_logs', $values);
    }

    /**
     * List users
     *
     * @return void
     */
    public function list_users()
    {
        $this->db->where('eliminado', 0);
        $result = $this->db->get('usuarios');
        return ($result != '') ? $result->result_array() : false;
    }
    
    /**
     * Obtencion del usuario con sus datos pertinentes
     *
     * @param [type] $idUsuario
     * @return void
     */
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

    /**
     * New user
     *
     * @param [type] $idProvincia
     * @param [type] $idLocalidad
     * @param [type] $name
     * @param [type] $apellido
     * @param [type] $username
     * @param [type] $password
     * @param [type] $idNivel
     * @param [type] $email
     * @param [type] $telefono
     * @param [type] $idGeneradoUsuarioMenuAdmin
     * @return void
     */
    public function add_usuario($idProvincia, $idLocalidad, $name, $apellido, $username, $password, $idNivel, $email, $telefono, $idGeneradoUsuarioMenuAdmin)
    {
        $values = array(
            'idProvincia' => $idProvincia,
            'idLocalidad' => $idLocalidad,
            'email' => $email,
            'telefono' => $telefono,
            'nombreCompleto' => $name,
            'apellido' => $apellido,
            'usuario' => $username,
            'password' => $password,
            'idNivel' => $idNivel,
            'idGeneradoUsuarioMenuAdmin' => $idGeneradoUsuarioMenuAdmin,
            'eliminado' => 0
        );
        $result = $this->db->insert('usuarios', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Update user
     *
     * @param [type] $id
     * @param [type] $idProvincia
     * @param [type] $idLocalidad
     * @param [type] $nombre
     * @param [type] $apellido
     * @param [type] $username
     * @param [type] $password
     * @param [type] $idNivel
     * @param [type] $email
     * @param [type] $telefono
     * @return void
     */
    public function update_usuario($idUsuario, $idProvincia, $idLocalidad, $nombre, $apellido, $username, $password, $idNivel, $email, $telefono)
    {
        $values = array(
            'idNivel' => $idNivel,
            'idProvincia' => $idProvincia,
            'idLocalidad' => $idLocalidad,
            'nombreCompleto' => $nombre,
            'apellido' => $apellido,
            'usuario' => $username,
            'password' => $password,
            'email' => $email,
            'telefono' => $telefono,
            'eliminado' => 0
        );
        $this->db->where('idUsuario', $idUsuario);
        $result = $this->db->update('usuarios', $values);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Delete user
     *
     * @param [type] $idUsuario
     * @return void
     */
    public function delete_user($idUsuario)
    {
        $values = array(
            'eliminado' => 1
        );

        $this->db->where('idUsuario', $idUsuario);
        $result = $this->db->update('usuarios', $values);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Tabla intermedia de los menu del usuario
     *
     * @param [type] $id
     * @param [type] $menu
     * @return void
     */
    public function add_menu_usuario($id, $menu)
    {
        $values = array(
            'idUsuario' => $id,
            'idMenu' => $menu
        );
        $result = $this->db->insert('usuario_menu_admin', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Obtenemos el usuario al que le pertene el idGeneradoUsuarioMenuAdmin
     *
     * @param [type] $idGeneradoUsuarioMenuAdmin
     * @return void
     */
    public function get_usuario_by_idGeneradoUsuarioMenuAdmin($idGeneradoUsuarioMenuAdmin)
    {
        $this->db->select('idUsuario');
        $this->db->from('usuarios');
        $this->db->where('idGeneradoUsuarioMenuAdmin', $idGeneradoUsuarioMenuAdmin);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * New treasury account
     *
     * @param [type] $idGenCuenta
     * @param [type] $idUsuario
     * @param [type] $idPtoVenta
     * @param [type] $inputNombCuenta
     * @param [type] $selectTipoCuenta
     * @return void
     */
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
     * Eliminamos los menu asignados al usuario en la tabla intermedia
     *
     * @param [type] $idUsuario
     * @return void
     */
    public function delete_usuarioMenuAdmin($idUsuario)
    {
        $this->db->delete('usuario_menu_admin', array('idUsuario' => $idUsuario));
        return (($this->db->affected_rows() > 0) ? true : false);
    }
}
