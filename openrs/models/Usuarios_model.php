<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Model.php';

class Usuarios_model extends MY_Model
{

    public function __construct()
    {        
        parent::__construct();
    }

    public function test_names()
    {
        $datas = $this->form_validation->validation_data['validation_datas_test_names'];
        if ($datas['first_name'] == $datas['last_name'])
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message("test_names", "holaaaaaaaaaa");
            return FALSE;
        }
    }
    
    public function set_rules()
    {
        $rules_first_name = array(
                'required',
                array('test_names', array($this->Usuarios_model, 'test_names'))
            );
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), $rules_first_name);
        $this->form_validation->set_rules('last_name', 'Apellidos', 'required');
    }
    
    public function set_rules_datas()
    {
        /*
          $data = array(
          'first_name' => '',
          'last_name' => ''
          ); */
        $data = $this->input->post();
        $data['validation_datas_test_names'] = array('first_name' => $data['first_name'], 'last_name' => $data['last_name']);
        $this->form_validation->set_data($data);
    }
    
    public function _set_datas_html() {
        $data['first_name'] = array(
            'name' => 'first_name',
            'id' => 'first_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('first_name'),
        );

        $data['last_name'] = array(
            'name' => 'last_name',
            'id' => 'last_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('last_name'),
        );
        
        return $data;
    }  
    
    public function _get_formatted_datas() {
        $datas=$this->input->post();
        return $datas;
    }

    function comprobarDeleteNotificaciones($id)
    {
        $notificaciones_recibidas = $this->Notificaciones_Model->getNotificacionesUsuario($id);
        $notificaciones_enviadas = $this->Notificaciones_Model->getNotificacionesEnviadasUsuario($id);
        if (count($notificaciones_recibidas) == 0 && count($notificaciones_enviadas) == 0)
            return TRUE;
        else
            return FALSE;
    }

    function comprobarDeleteLicencias($id)
    {
        $licencias_usuario = $this->Licencias_Model->getLicenciasUsuario($id);
        $licencias_club = $this->Licencias_Model->getLicenciasClub($id);
        if (count($licencias_usuario) == 0 && count($licencias_club) == 0)
            return TRUE;
        else
            return FALSE;
    }

    function comprobarDeleteDocumentos($id)
    {
        $documentos = $this->getDocumentos($id);
        if (count($documentos) == 0)
            return TRUE;
        else
            return FALSE;
    }

    function comprobarDeleteCarreras($id)
    {
        $pruebas = $this->getCarreras($id);
        if (count($pruebas) == 0)
            return TRUE;
        else
            return FALSE;
    }

    function comprobarDeleteEquipos($id)
    {
        $equipos = $this->getEquipos($id);
        if (count($equipos) == 0)
            return TRUE;
        else
            return FALSE;
    }

    function comprobarDeleteIncidencias($id)
    {
        $incidencias_enviadas = $this->Incidencias_Model->getIncidencias($id);
        $incidencias_recibidas = $this->Incidencias_Model->getIncidenciasToUser($id);
        if (count($incidencias_enviadas) == 0 && count($incidencias_recibidas) == 0)
            return TRUE;
        else
            return FALSE;
    }

    function comprobarDeleteDatosPersonales($id)
    {
        $enlazados_historico = $this->getHistoricoUsuario($id);
        if (count($enlazados_historico) == 0)
            return TRUE;
        else
            return FALSE;
    }

    function check_delete($id)
    {
        // Comprobación Borrado de datos relacionados
        if ($id !== 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    function delete_all($id)
    {
        // Notificaciones
        //$this->deleteNotificaciones($datos_personales->id);
        // Borrado de ficheros físicos de carpeta de usuario
        if (file_exists(FCPATH . "downloads/usuarios/" . $id))
        {
            $this->utilities->full_rmdir(FCPATH . "downloads/usuarios/" . $id);
        }
        // Borrado del usuario final
        return 1; //$this->ion_auth_model->delete_user($id);
    }

    /**
     * getEsGerente
     *
     * @return bool
     * */
    public function getEsGerente($id = false)
    {
        $gerente_group = $this->config->item('gerente_group', 'ion_auth');
        return $this->ion_auth->in_group($gerente_group, $id);
    }

    /**
     * getEsEmpleado
     *
     * @return bool
     * */
    public function getEsEmpleado($id = false)
    {
        $empleado_group = $this->config->item('empleado_group', 'ion_auth');
        return $this->ion_auth->in_group($empleado_group, $id);
    }

    /**
     * getEsEmpleado
     *
     * @return bool
     * */
    public function getEsAdmin($id = false)
    {
        return $this->ion_auth->is_admin($id);
    }

}
