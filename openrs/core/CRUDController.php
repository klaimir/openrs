<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CRUDController extends CI_Controller {

	var $s_model = "";
    var $s_controller = "";
    var $m_model;
	
    public function __construct()
    {
        parent::__construct();

		$this->s_controller = strtolower(get_class($this));
        $this->load->model($this->s_model);
        $this->m_model = $this->{$this->s_model};
		
        $this->data['s_controller'] = $this->s_controller;		

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
			redirect('auth/register', 'refresh');
	}
	
	public function index()
	{
		$this->data['elements'] = $this->m_model->get_data();		
		$this->load->view('admin/header', $this->data);
		$this->load->view('admin/index', $this->data);
		$this->load->view('admin/footer', $this->data);
	}

	public function create()
	{
		$this->data['v_fields'] = $this->m_model->get_all_fields();
		if(array_key_exists("has_one", $this->data['v_fields']))
		{
			foreach ($this->data['v_fields']['has_one'] as $field_name => $field_details)
			{
				$local_model = $field_details['model'];
				$this->load->model($local_model);
				$local_list = $this->{$local_model}->get_list();
				$this->data['v_fields']['has_one'][$field_name]['values'] = array();
				foreach($local_list as $k => $v)
					$this->data['v_fields']['has_one'][$field_name]['values'][$k] = $v;
			}
		}
		if (array_key_exists("has_many", $this->data['v_fields']))
		{
			foreach ($this->data['v_fields']['has_many'] as $field_name => $field_details)
			{
				$related_model = $field_details['model'];
				$this->load->model($related_model);
				$relation_model = $field_details['relation_model'];
				$this->load->model($relation_model);
				$local_list = $this->{$related_model}->get_list();
				$this->data['v_fields']['has_many'][$field_name]['values'] = array();
				foreach($local_list as $k => $v)
					$this->data['v_fields']['has_one'][$field_name]['values'][$k] = $v;
			}
		}
		if($this->is_post())
		{
			$perform_result = self::perform('create');
			$error = $perform_result["error"];
			if (!$error)
			{
				//$this->session->set_flashdata('message', 'Inserci�n correcta');
				redirect('admin/'.$this->s_controller, 'refresh');
			}
			else
				$this->data['s_message'] = $perform_result['msg'];
		}
		$this->data['s_action'] = 'create';
		$this->load->view('admin/header', $this->data);
		$this->load->view('admin/form', $this->data);
		$this->load->view('admin/footer', $this->data);
	}

	public function edit($id, $record = FALSE)
	{
		$record = $record ? $record : $this->m_model->get_by_id($id);
		if($record == FALSE)
		{
			//$this->session->set_flashdata('message', "Elemento incorrecto (ID = $id)");
			redirect("admin/" . $this->s_controller, 'refresh');
        }
		$this->data['v_fields'] = $this->m_model->get_all_fields();
		$this->data['v_values'] = get_object_vars($record);
		if (array_key_exists("has_one", $this->data['v_fields']))
		{
			foreach ($this->data['v_fields']['has_one'] as $field_name => $field_details)
			{
				$local_model = $field_details['model'];
				$this->load->model($local_model);
				$local_list = $this->{$local_model}->get_list();
				$this->data['v_fields']['has_one'][$field_name]['values'] = array();
				foreach($local_list as $k => $v)
					$this->data['v_fields']['has_one'][$field_name]['values'][$k] = $v;
			}
		}
		if (array_key_exists("has_many", $this->data['v_fields']))
		{
			foreach ($this->data['v_fields']['has_many'] as $field_name => $field_details)
			{
				$related_model = $field_details['model'];
				$this->load->model($related_model);
				$relation_model = $field_details['relation_model'];
				$this->load->model($relation_model);
				$relations = $this->{$field_details['relation_model']}->get_by($field_details['my_id'], $id);
				foreach($relations as $rel)
					$this->data['v_values'][$field_name][] = $rel->{$field_details['other_id']};
				$local_list = $this->{$related_model}->get_list();
				$this->data['v_fields']['has_many'][$field_name]['values'] = array();
				foreach($local_list as $k => $v)
					$this->data['v_fields']['has_one'][$field_name]['values'][$k] = $v;
			}
		}
		if($this->is_post())
		{
			$record = $this->m_model->get_by_id($id);
			if ($record == FALSE)
			{
				//$this->session->set_flashdata('message', "Elemento incorrecto (ID = $id)");
				redirect("admin/" . $this->s_controller, 'refresh');
			}
			$perform_result = self::perform('edit', $id);
			$error = $perform_result["error"];
			if (!$error)
			{
				//$this->session->set_flashdata('message', 'Inserci�n correcta');
				redirect('admin/'.$this->s_controller, 'refresh');
			}
			else
				$this->data['s_message'] = $perform_result['msg'];
		}
		$this->data['s_action'] = 'edit';
		$this->load->view('admin/header', $this->data);
		$this->load->view('admin/form', $this->data);
		$this->load->view('admin/footer', $this->data);
	}
	
	public function delete($id)
	{
		$result = $this->m_model->delete($id);
		//$this->session->set_flashdata('message', $result['msg']);
		redirect("admin/" . $this->s_controller, 'refresh');
    }
	
	private function perform($action = "create", $id = 0)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_error_delimiters('', '');
		$all_fields = $this->m_model->get_all_fields();
		$all_fields_unclassified = $this->m_model->get_all_fields('', FALSE);
		$required_fields = $this->m_model->get_required_fields();
		try
		{
			$total_rules = 0;
			foreach ($all_fields_unclassified as $field_name => $field_details)
			{
				if (array_search($field_details['type'], array("boolean", "image", "has_one", "has_many")) !== FALSE)
					continue;
				$form_field_rules = "trim";
				if ($field_details['required'])
					$form_field_rules = "required|trim";
				$this->form_validation->set_rules($field_name, $field_details['label'], $form_field_rules);
				$total_rules ++;
			}
			if ($total_rules != 0 && $this->form_validation->run() != true)
				throw new Exception(validation_errors());
			foreach($required_fields as $field_name => $field_details)
				if($field_details['type'] == 'image' && $_FILES[$field_name]['error'] != '0' && $field_details['required'] && $action == "create")
					throw new Exception("El campo de imagen '" . $field_details['label'] . "' es obligatorio.");
			$this->data_object = $this->input->post();
			if (array_key_exists("boolean", $all_fields))
				foreach ($all_fields['boolean'] as $field_name => $field_details)
					if (!array_key_exists($field_name, $this->data_object))
						$this->data_object[$field_name] = "0";
			if (array_key_exists("richtext", $all_fields))
				foreach ($all_fields["richtext"] as $field_name => $field_details)
					if (array_key_exists($field_name, $this->data_object))
						$this->data_object[$field_name] = preg_replace("(\\n|\\r)", "", $this->data_object[$field_name]);
			$result = $action == "create" ? $this->m_model->insert($this->data_object) : $this->m_model->update($id, $this->data_object);
			if (is_array($result) && array_key_exists("error", $result))
				throw new Exception($result["msg"]);
		}
		catch (Exception $e)
		{
			return array("error" => true, "msg" => nl2br($e->getMessage()));
		}
		return array("error" => false);
	}
	
	public function row_reorder()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}
		$d_dir  = $this->input->get("direction");
		$d_from = (int) $this->input->get("fromPosition");
		$d_to   = (int) $this->input->get("toPosition");
		$d_id   = trim($this->input->get("id"), "row_");
		$this->m_model->reorder($d_id, $d_from, $d_to, $d_dir);
		echo "OK";
	}

}