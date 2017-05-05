<?php
/**
 * A base controller for CodeIgniter with view autoloading, layout support,
 * model loading, asides/partials and per-controller 404
 *
 * @link http://github.com/jamierumbelow/codeigniter-base-controller
 * @copyright Copyright (c) 2012, Jamie Rumbelow <http://jamierumbelow.net>
 */

class MY_Controller_Front extends CI_Controller
{    

    /* --------------------------------------------------------------
     * VARIABLES
     * ------------------------------------------------------------ */

    /**
     * The current request's view. Automatically guessed 
     * from the name of the controller and action
     */
    protected $view = '';
    
    /**
     * An array of variables to be passed through to the 
     * view, layout and any asides
     */
    protected $data = array();
    
    /**
     * The name of the layout to wrap around the view.
     */
    protected $layout;
    
    /**
     * An arbitrary list of asides/partials to be loaded into
     * the layout. The key is the declared name, the value the file
     */
    protected $asides = array();
    
    /**
     * A list of models to be autoloaded
     */
    protected $models = array();
    
    /**
     * A formatting string for the model autoloading feature.
     * The percent symbol (%) will be replaced with the model name.
     */
    protected $model_string = '%_model';
    
    /* --------------------------------------------------------------
     * GENERIC METHODS
     * ------------------------------------------------------------ */
    
    /**
     * Initialise the controller, tie into the CodeIgniter superobject
     * and try to autoload the models
     */
    public function __construct()
    {
        parent::__construct();

        $this->_load_models();
		
		$this->view=FALSE;
		
    }

    /* --------------------------------------------------------------
     * VIEW RENDERING
     * ------------------------------------------------------------ */
        
    /**
     * Override CodeIgniter's despatch mechanism and route the request
     * through to the appropriate action. Support custom 404 methods and
     * autoload the view into the layout.
     */
    public function _remap($method)
    {
        if (method_exists($this, $method))
        {
            call_user_func_array(array($this, $method), array_slice($this->uri->rsegments, 2));
        }
        else
        {
            if (method_exists($this, '_404'))
            {
                call_user_func_array(array($this, '_404'), array($method));
            }
            else
            {
                show_404(strtolower(get_class($this)).'/'.$method);
            }
        }
        
        $this->_load_view();
    }
    
    /**
     * Automatically load the view, allowing the developer to override if
     * he or she wishes, otherwise being conventional.
     */
    protected function _load_view()
    {
        // If $this->view == FALSE, we don't want to load anything
        if ($this->view !== FALSE)
        {
            // If $this->view isn't empty, load it. If it isn't, try and guess based on the controller and action name
            $view = (!empty($this->view)) ? $this->view : $this->router->directory . $this->router->class . '/' . $this->router->method;
            
            // Load the view into $yield
            $data['yield'] = $this->load->view($view, $this->data, TRUE);
            
            // Do we have any asides? Load them.
            if (!empty($this->asides))
            {
                foreach ($this->asides as $name => $file)
                {
                    $data['yield_'.$name] = $this->load->view($file, $this->data, TRUE);
                }
            }
            
            // Load in our existing data with the asides and view
            $data = array_merge($this->data, $data);
            $layout = FALSE;

            // If we didn't specify the layout, try to guess it
            if (!isset($this->layout))
            {
                if (file_exists(APPPATH . 'views/layouts/' . $this->router->class . '.php'))
                {
                    $layout = 'layouts/' . $this->router->class;
                } 
                else
                {
                    $layout = 'layouts/application';
                }
            }

            // If we did, use it
            else if ($this->layout !== FALSE)
            {
                $layout = $this->layout;
            }

            // If $layout is FALSE, we're not interested in loading a layout, so output the view directly
            if ($layout == FALSE)
            {
                $this->output->set_output($data['yield']);
            }

            // Otherwise? Load away :)
            else
            {
                $this->load->view($layout, $data);
            }
        }
    }

    /* --------------------------------------------------------------
     * MODEL LOADING
     * ------------------------------------------------------------ */
    
    /**
     * Load models based on the $this->models array
     */
    private function _load_models()
    {
        foreach ($this->models as $model)
        {
            $this->load->model($this->_model_name($model), $model);
        }
    }
    
    /**
     * Returns the loadable model name based on
     * the model formatting string
     */
    protected function _model_name($model)
    {
        return str_replace('%', $model, $this->model_string);
    }
}
class MY_Functions extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('formularios');
	}

	function inicializar($seccion, $titulo){
		if($this->simple_sessions->get_value('rol') == '1')
			$this->simple_sessions->check_admin();
		elseif($this->simple_sessions->get_value('rol') == '2')
		$this->simple_sessions->check_cliente();
		else
			redirect('logout');

		$data['cargar_idiomas'] = $this->idioma_model->get_idiomas_subidos_activos();
		$data['idioma_actual'] = $this->user_model->get_usuario_idioma($this->simple_sessions->get_value('id_usuario'));
		$data['title'] = $titulo;
		$data['secciones'] = $this->seccion_model->get_secciones($data['idioma_actual']->id_idioma);
		$data['max_prioridad_seccion'] = $this->general_model->maximo('seccion','prioridad');
		$data['sec'] = $seccion;

		return $data;
	}

	public function crear($inputs,$config,$elementos = NULL){
		$data = $this->inicializar(6, $config['title']);
		$data['inputs']=$inputs;
		$data['nuevo']=$config['nuevo'];
		$data['nombre']=$config['nombre'];
		$data['editando']=$config['editando'];
		if($elementos)
			$data['elementos']=$elementos;
		$conf = $this->general_model->get_config($this->simple_sessions->get_value('id_usuario'));
		if($this->input->post()){
			$this->form_validation->set_message('is_natural_no_zero', $this->lang->line('login_c_is_natural_no_zero'));
			$this->form_validation->set_message('required',$this->lang->line('login_c_required'));
			$this->form_validation->set_message('max_length',$this->lang->line('login_c_max_length'));
			foreach($data['cargar_idiomas'] as $idioma){
				if($idioma->id_idioma == $conf->idioma_defecto){
					foreach($data['inputs'] as $it){
						if($it['fijo']){
							if($it['val_req']){
								$this->form_validation->set_rules($it['form_group']['name'],$it['label'],'required|'.$it['form_validation']);
							}else{
								$this->form_validation->set_rules($it['form_group']['name'],$it['label'],$it['form_validation']);
							}
						}else{
							if($it['val_req']){
								$this->form_validation->set_rules($it['form_group']['name'].'_'.$idioma->id_idioma,$it['label'],'required|'.$it['form_validation']);
							}else{
								$this->form_validation->set_rules($it['form_group']['name'].'_'.$idioma->id_idioma,$it['label'],$it['form_validation']);
							}
						}
					}
				}else{
					foreach($data['inputs'] as $it){
						if(!$it['fijo'])
							$this->form_validation->set_rules($it['form_group']['name'].'_'.$idioma->id_idioma,$it['label'],$it['form_validation']);
					}
				}
			}
			if($this->form_validation->run()){
				foreach($data['inputs'] as $it){
					if($it['fijo']){
						$datos_insert[$it['form_group']['name']]=$this->input->post($it['form_group']['name']);
					}
				}
				if($config['nuevo']==true){
					$id = $this->$config['model_insert']['model']->$config['model_insert']['method']($config['model_insert']['table'],$datos_insert,isset($config['model_insert']['extra'])?$config['model_insert']['extra']:'');
				}else{
					$id = $this->$config['model_update']['model']->$config['model_update']['method']($config['model_update']['table'],$datos_insert,$config['model_update']['where']);
				}
				foreach($data['cargar_idiomas'] as $idioma){
					foreach($data['inputs'] as $it){
						if(!$it['fijo']){
							if($this->input->post($it['form_group']['name'].'_'.$idioma->id_idioma)){
								$datos_insert_idiomas[$it['form_group']['name']]=$this->input->post($it['form_group']['name'].'_'.$idioma->id_idioma);
							}else{
								$datos_insert_idiomas[$it['form_group']['name']]=$this->input->post($it['form_group']['name'].'_'.$conf->idioma_defecto).'_'.$idioma->id_idioma;
							}
						}
					}
					if($config['nuevo']==true){
						$datos_insert_idiomas['id_idioma'] = $idioma->id_idioma;
						$datos_insert_idiomas[$config['model_insert_idiomas']['enlace']] = $id;
						$this->$config['model_insert_idiomas']['model']->$config['model_insert_idiomas']['method']($config['model_insert_idiomas']['table'],$datos_insert_idiomas,isset($config['model_insert_idiomas']['extra'])?$config['model_insert_idiomas']['extra']:'');
					}else{
						$config['model_update_idiomas']['where']['id_idioma'] = $idioma->id_idioma;
						if($this->general_model->existe($config['model_insert_idiomas']['table'], $config['model_update_idiomas']['where'])){
							$this->$config['model_update_idiomas']['model']->$config['model_update_idiomas']['method']($config['model_update_idiomas']['table'],$datos_insert_idiomas,$config['model_update_idiomas']['where']);
						}else{
							$datos_insert_idiomas['id_idioma'] = $idioma->id_idioma;
							$datos_insert_idiomas[$config['model_insert_idiomas']['enlace']] = $id;
							$this->$config['model_insert_idiomas']['model']->$config['model_insert_idiomas']['method']($config['model_insert_idiomas']['table'],$datos_insert_idiomas,isset($config['model_insert_idiomas']['extra'])?$config['model_insert_idiomas']['extra']:'');
						}
					}
				}
				redirect($config['redirect']);
			}
		}

		$this->template->set_template('header_and_content');
		$this->template->write_view('content',$config['view'],$data);
		$this->template->write_view('header','templates/header_admin',$data);
		$this->template->render();
	}

	public function listado ($config){
		$data = $this->inicializar(6, $config['title']);
		//Datos del listado
		$data['listado']=$this->$config['model']['model_name']->$config['model']['model_method'](isset($config['model']['idioma']) ? $config['model']['idioma']:'', isset($config['model']['model_param']) ? $config['model']['model_param']:'');
		//Botones generales
		$data['botones']=$config['botones'];
		//Colimnas del listado
		$data['columnas']=$config['columnas'];
		$data['opciones']=$config['opciones'];

		$this->template->set_template('header_and_content');
		$this->template->write_view('content',$config['view'],$data);
		$this->template->write_view('header','templates/header_admin',$data);
		$this->template->render();
	}

	public function ordenar ($config){
		$data = $this->inicializar(6, $config['title']);

		$data['ordenar']=$this->$config['model_get']['model_name']->$config['model_get']['model_method'](isset($config['model_get']['idioma']) ? $config['model_get']['idioma']:'', isset($config['model_get']['model_param']) ? $config['model_get']['model_param']:'');
		if($this->input->post()){
			$ids_ordenadas = explode(";", $this->input->post('input_orden'));
			for($i=0; $i<count($ids_ordenadas); $i++){
				$this->$config['model_update']['model_name']->$config['model_update']['model_method']($config['model_update']['tabla'],array('prioridad' => ($i+1)),array($config['model_update']['id_tabla']=>$ids_ordenadas[$i]));
			}
			redirect($config['redirect']);
		}

		$this->template->set_template('header_and_content');
		$this->template->write_view('content',$config['view'],$data);
		$this->template->write_view('header','templates/header_admin',$data);
		$this->template->render();
	}
}
