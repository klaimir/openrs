<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . '/core/BaseModel.php';

class Usuarios_model extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    function comprobarDeleteNotificaciones($id) {
        $notificaciones_recibidas = $this->Notificaciones_Model->getNotificacionesUsuario($id);
        $notificaciones_enviadas = $this->Notificaciones_Model->getNotificacionesEnviadasUsuario($id);
        if (count($notificaciones_recibidas) == 0 && count($notificaciones_enviadas) == 0)
            return TRUE;
        else
            return FALSE;
    }

    function comprobarDeleteLicencias($id) {
        $licencias_usuario = $this->Licencias_Model->getLicenciasUsuario($id);
        $licencias_club = $this->Licencias_Model->getLicenciasClub($id);
        if (count($licencias_usuario) == 0 && count($licencias_club) == 0)
            return TRUE;
        else
            return FALSE;
    }

    function comprobarDeleteDocumentos($id) {
        $documentos = $this->getDocumentos($id);
        if (count($documentos) == 0)
            return TRUE;
        else
            return FALSE;
    }

    function comprobarDeleteCarreras($id) {
        $pruebas = $this->getCarreras($id);
        if (count($pruebas) == 0)
            return TRUE;
        else
            return FALSE;
    }

    function comprobarDeleteEquipos($id) {
        $equipos = $this->getEquipos($id);
        if (count($equipos) == 0)
            return TRUE;
        else
            return FALSE;
    }

    function comprobarDeleteIncidencias($id) {
        $incidencias_enviadas = $this->Incidencias_Model->getIncidencias($id);
        $incidencias_recibidas = $this->Incidencias_Model->getIncidenciasToUser($id);
        if (count($incidencias_enviadas) == 0 && count($incidencias_recibidas) == 0)
            return TRUE;
        else
            return FALSE;
    }

    function comprobarDeleteDatosPersonales($id) {
        $enlazados_historico = $this->getHistoricoUsuario($id);
        if (count($enlazados_historico) == 0)
            return TRUE;
        else
            return FALSE;
    }

    function comprobarDelete($id) {
        // Comprobación Borrado de datos relacionados
        if ($id !== 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function delete($id) {
        // Notificaciones
        //$this->deleteNotificaciones($datos_personales->id);
        // Borrado de ficheros físicos de carpeta de usuario
        if (file_exists(FCPATH . "downloads/usuarios/" . $id)) {
            $this->utilities->full_rmdir(FCPATH . "downloads/usuarios/" . $id);
        }
        // Borrado del usuario final
        return 1;//$this->ion_auth_model->delete_user($id);
    }

    /**     * *********************** API ************************************* */
    function getUsuarioAPI($iduser) {
        $fieldslist = $this->utilities->getFieldsTable('v_usuarios_api');
        $this->db_users->select($fieldslist);
        $this->db_users->from('v_usuarios_api');
        $this->db_users->where('iduser', $iduser);
        $query = $this->db_users->get();
        return $query->row();
    }

    function getUsuarioAPIByToken($token) {
        $fieldslist = $this->utilities->getFieldsTable('v_usuarios_api');
        $this->db_users->select($fieldslist);
        $this->db_users->from('v_usuarios_api');
        $this->db_users->where('token', $token);
        $query = $this->db_users->get();
        return $query->row();
    }

    function getUsuarioAPIByEmail($email) {
        $fieldslist = $this->utilities->getFieldsTable('v_usuarios_api');
        $this->db_users->select($fieldslist);
        $this->db_users->from('v_usuarios_api');
        $this->db_users->where('email', $email);
        $query = $this->db_users->get();
        return $query->row();
    }

    function checkAddTokenUsuarioAPI($iduser, $token) {
        // Si existe
        $user = $this->getUsuarioAPI($iduser);
        // Datos
        $datos['iduser'] = $iduser;
        $datos['token'] = $token;
        // Creación si no existe
        if (!$user) {
            return $this->addUsuarioAPI($datos);
        } else {
            return $this->updateUsuarioAPI($iduser, $datos);
        }
    }

    function addUsuarioAPI($datos) {
        $this->db_users->insert('users_api', $datos);
        return $this->db_users->insert_id();
    }

    function updateUsuarioAPI($iduser, $datos) {
        return $this->db_users->update('users_api', $datos, array('iduser' => $iduser));
    }

    /**
     * getEsGerente
     *
     * @return bool
     * */
    public function getEsGerente($id = false) {
        $gerente_group = $this->config->item('gerente_group', 'ion_auth');
        return $this->ion_auth->in_group($gerente_group, $id);
    }

    /**
     * getEsEmpleado
     *
     * @return bool
     * */
    public function getEsEmpleado($id = false) {
        $empleado_group = $this->config->item('empleado_group', 'ion_auth');
        return $this->ion_auth->in_group($empleado_group, $id);
    }

    /**
     * getEsEmpleado
     *
     * @return bool
     * */
    public function getEsAdmin($id = false) {
        return $this->ion_auth->is_admin($id);
    }

}
