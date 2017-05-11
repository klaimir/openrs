<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Controller.php';

class Page extends MY_Controller
{
	/*function __construct()
	{
		parent::__construct();
		//$this->load->model('carrusel_model');
		$this->load->model('Seccion_model');
		$this->load->model('Usuario_model');
		$this->load->model('Idioma_model');
 		$this->load->model('General_model');
 		$this->load->library('ion_auth');
 		
 		// Comprobación de acceso
 		//$this->utilities->check_security_access_perfiles_or(array("session_es_admin"));
	}*/
	function __construct()
	{
		$this->s_model = "Admin_model";
		$this->m_model = "admin_model";
		$this->_controller = "admin";
		$this->_view = "admin";
	
		parent::__construct();
	
		// Secure the access
		$this->_security();
	
		// Comprobación de acceso
		//$this->utilities->check_security_access_perfiles_or(array("session_es_admin"));
	}
	
	//Desde este controlador cargaremos las secciones seleccionadas. Las secciones deben tener el campo url único
// 	function index()
// 	{
		
// 	}
	
	function listar_secciones($id_super_seccion=null){
		$config=array(
				'title'=>$this->lang->line('cms_c_listar_grupo_secciones'),
				'view'=>'listado/listado',
				'model'=>array('model_name'=>'Seccion_model',
							   'model_method'=>'listar_secciones',
							   'model_param'=>$id_super_seccion,
							   'idioma'=>$this->Usuario_model->get_usuario_idioma($this->ion_auth->user()->row()->id)->id_idioma),
				'columnas'=>array($this->lang->line('cms_c_listado_prioridad')=>'prioridad',
								  $this->lang->line('cms_c_listado_titulo')=> 'titulo',
								  $this->lang->line('cms_c_listado_menu')=> 'menu',
								  $this->lang->line('cms_c_listado_estado')=>'id_estado'),
				'opciones'=> array('Editar'=>array('href'=>site_url('page/crear_seccion'),
												   'icon'=>'glyphicon glyphicon-edit',
												   'keys'=>array('url_seo'),
											       'title'=>$this->lang->line('cms_c_listado_editar_seccion')),
								   'Bloque'=>array('href'=>site_url('page/crear_bloque'),
												   'icon'=>'glyphicon glyphicon-plus-sign',
												   'keys'=>array('url_seo'),
											       'title'=>$this->lang->line('cms_c_listado_nuevo_bloque')),
								   'ListBloque'=>array('href'=>site_url('page/listar_bloques'),
												   'icon'=>'glyphicon glyphicon-list',
												   'keys'=>array('url_seo'),
											       'title'=>$this->lang->line('cms_c_listado_listar_bloques')),
								   'Borrar'=>array('href'=>site_url('page/borrar_seccion'),
												   'icon'=>'glyphicon glyphicon-trash borrar',
												   'keys'=>array('url_seo'),
											       'title'=>$this->lang->line('cms_c_listado_borrar_seccion'))),
				'botones'=>array('1'=>array('href'=>site_url('page/crear_seccion'),
											'class'=>'btn btn-default pull-right',
											'contenido'=>'<span class="glyphicon glyphicon-plus"></span> '.$this->lang->line('cms_c_listado_boton_nueva')),
								 '2'=>array('href'=>site_url('page/ordenar_secciones'),
											'class'=>'btn btn-default pull-right',
											'contenido'=>'<span class="glyphicon glyphicon-random"></span> '.$this->lang->line('cms_c_listado_boton_ordenar')))
		);
		$this->listado($config);
	}
	
	function listar_bloques($url_seccion=null){
		if(isset($url_seccion)){
			$seccion=$this->Seccion_model->get_seccion_nombre($this->Usuario_model->get_usuario_idioma($this->ion_auth->user()->row()->id)->id_idioma, $url_seccion);
			if (count($seccion)==0){
				redirect('errors/error_404');
			}
		}else{
			redirect('errors/error_404');
		}
		$config=array(
				'title'=>$this->lang->line('cms_c_listar_bloques'),
				'view'=>'listado/listado',
				'model'=>array('model_name'=>'Seccion_model',
							   'model_method'=>'listar_bloques',
							   'model_param'=>$url_seccion,
							   'idioma' => $this->Usuario_model->get_usuario_idioma($this->ion_auth->user()->row()->id)->id_idioma),
				'columnas'=>array($this->lang->line('cms_c_listado_prioridad')=>'prioridad',
								  $this->lang->line('cms_c_listado_titulo')=>'titulo',
								  $this->lang->line('cms_c_listado_estado')=>'estado'),
				'opciones'=>  array('Editar'=>array('href'=>site_url('page/crear_bloque'),
												    'icon'=>'glyphicon glyphicon-edit',
													'keys'=>array('url_seo','id_bloque'),
													'title'=>$this->lang->line('cms_c_editar_bloques')),
									'Contenido'=>array('href'=>site_url('page/editar_bloque'),
												    'icon'=>'glyphicon glyphicon-screenshot',
													'keys'=>array('id_bloque'),
													'title'=>$this->lang->line('cms_c_editar_contenido')),
									'Borrar'=>array('href'=>site_url('page/borrar_bloque'),
												    'icon'=>'glyphicon glyphicon-trash borrar',
													'keys'=>array('id_bloque'),
													'title'=>$this->lang->line('cms_c_borrar_bloque'))),
				'botones'=>array('1'=>array('href'=>site_url('page/crear_bloque/'.$url_seccion),
											'class'=>'btn btn-default pull-right',
											'contenido'=>'<span class="glyphicon glyphicon-plus"></span> '.$this->lang->line('cms_c_listado_boton_nuevo')),
								 '2'=>array('href'=>site_url('page/ordenar_bloques/'.$url_seccion),
											'class'=>'btn btn-default pull-right',
											'contenido'=>'<span class="glyphicon glyphicon-random"></span> '.$this->lang->line('cms_c_listado_boton_ordenar')))
		);
		$this->listado($config);
	}
	
	function editar_bloque($id_bloque){
		if(isset($id_bloque)){
			$idioma = $this->Usuario_model->get_usuario_idioma($this->ion_auth->user()->row()->id)->id_idioma;
			$bloque=$this->Seccion_model->get_bloque($idioma,$id_bloque);
			if (count($bloque)==0){
				redirect('errors/error_404');
			}
		}else{
			redirect('errors/error_404');
		}
		//redirect('asd/'.$bloque->id_tipo_bloque);
		switch($bloque->id_tipo_bloque){
			case '1':
				echo $idioma.' '.$bloque->id_bloque.'<b>';
				$texto=$this->Seccion_model->get_bloque_txt($idioma, $bloque->id_bloque);
				/*if($texto){
					print_r($texto);
					echo $texto->id;exit();
				}else{
					echo 'nada';exit();
				}*/
				//redirect('asd/'.$texto->id);
				redirect('page/crear_bloque_texto/'.$texto->id);
				break;
			case '2':
				$carrusel=$this->Seccion_model->get_bloque_carrusel($bloque->id_bloque);
				//redirect('asd2/'.$carrusel->id);
				redirect('cms-crear-bloque-carrusel/'.$carrusel->id);
				break;
			case '4':
				$iframe=$this->Seccion_model->get_bloque_txt($idioma, $bloque->id_bloque);
				//redirect('asd/'.$texto->id);
				redirect('page/crear_bloque_texto/'.$iframe->id);
				break;
		}
	}

	function inicializar($seccion, $titulo){
	
		$this->data['cargar_idiomas'] = $this->Idioma_model->get_idiomas_subidos_activos();
		$this->data['idioma_actual'] = $this->Usuario_model->get_usuario_idioma($this->ion_auth->user()->row()->id);
		$this->data['config']=$this->General_model->get_config();
		$this->data['title']= $titulo.' - '.$this->data['config']->nombre;
		$this->data['secciones'] = $this->Seccion_model->get_secciones($this->data['idioma_actual']->id_idioma);
		$this->data['max_prioridad_seccion'] = $this->General_model->maximo('seccion','prioridad');
	
		return $this->data;
	}
	
	function crear_bloque($url_seccion,$id_bloque=null){		
		if(isset($url_seccion)){
			$seccion=$this->Seccion_model->get_seccion_nombre($this->Usuario_model->get_usuario_idioma($this->ion_auth->user()->row()->id)->id_idioma, $url_seccion);
			if (count($seccion)==0){
				redirect('errors/error_404');
			}else{
				$bloque=$this->Seccion_model->get_bloque($this->Usuario_model->get_usuario_idioma($this->ion_auth->user()->row()->id)->id_idioma, $id_bloque);
				if (count($bloque)==0){
					$nuevo=true;
				}else{
					$nuevo=false;
				}
			}
		}else{
			redirect('errors/error_404');
		}
		$this->data = $this->inicializar('6', $this->lang->line('cms_c_crear_bloque'));
		$this->data['seccion'] = $seccion;
		//$tipo_bloque_dd=$this->formularios->dropdown('tipo_bloque','id','nombre');
		//$estado_dd=$this->formularios->dropdown('estados','id','estado');
		$tipo_bloque_dd['1'] = $this->lang->line('cms_texto');
		$tipo_bloque_dd['4'] = $this->lang->line('cms_iframe');
		$estado_dd['0'] = $this->lang->line('drop_seleccione');
		$estado_dd['1'] = $this->lang->line('cms_publicado');
		$estado_dd['2'] = $this->lang->line('cms_eliminado');
		$estado_dd['3'] = $this->lang->line('cms_borrador');
		$ancho_dd['0'] = $this->lang->line('drop_seleccione');
		$ancho_dd['1'] = $this->lang->line('cms_ancho_completo');
		$ancho_dd['2'] = $this->lang->line('cms_ancho_margen');
		//array para formularios
		$inputs=array(
				//Caso 1: input normal
				'1'=>array(
						'form_group'=>array(
								'name'=>'titulo_bloque', //name = nombre del campo en la base de datos
								'id'=>'titulo_bloque',
								'value'=> set_value('titulo_bloque',isset($bloque->titulo_bloque) ? $bloque->titulo_bloque : ''),
								'class'=>'form-control',
								'placeholder'=>$this->lang->line('cms_c_bloques_titulo_placeholder'),
						),
						'val_req' => '1',
						'fijo' => '0',
						'label'=>$this->lang->line('cms_c_bloques_titulo'),
						'help'=>form_error('titulo'),
						'label_class'=>'control-label pull-right', //Clases de la label del intput
						'class'=>'col-md-10', //Clases
						'type'=>'input',
						'form_validation'=>'trim|xss_clean|max_length[50]',
				),
				//Caso 3: select dropdown
				'2'=>array(
						'form_group'=>array(
								'name'=>'id_tipo_bloque', //name = nombre del campo en la base de datos
								'id'=>'id_tipo_bloque',
								'value'=> set_value('id_tipo_bloque',isset($bloque->id_tipo_bloque) ? $bloque->id_tipo_bloque : 0),
								'class'=>'form-control id_tipo_bloque',
								'disabled'=>isset($bloque->id_tipo_bloque) ?'disabled':'',
						),
						'val_req' => '0',
						'fijo' => '1',
						'dropdown'=>$tipo_bloque_dd,
						'label'=>$this->lang->line('cms_c_bloques_tipo_bloque'),
						'help'=>form_error('id_tipo_bloque'),
						'label_class'=>'control-label pull-right', //Clases de la label del intput
						'class'=>'col-md-4', //Clases
						'type'=>'select',
						'form_validation'=>'trim|xss_clean|integer|is_natural_no_zero',
				),
				'3'=>array(
						'form_group'=>array(
								'name'=>'id_estado', //name = nombre del campo en la base de datos
								'id'=>'id_estado',
								'value'=> set_value('id_estado',isset($bloque->id_estado) ? $bloque->id_estado : 1),
								'class'=>'form-control id_estado',
						),
						'val_req' => '1',
						'fijo' => '1',
						'dropdown'=>$estado_dd,
						'label'=>$this->lang->line('cms_c_bloques_estado'),
						'help'=>form_error('id_estado'),
						'label_class'=>'control-label pull-right', //Clases de la label del intput
						'class'=>'col-md-4', //Clases
						'type'=>'select',
						'form_validation'=>'trim|xss_clean|integer|is_natural_no_zero',
				),
				'4'=>array(
						'form_group'=>array(
								'name'=>'background', //name = nombre del campo en la base de datos
								'id'=>'background',
								'value'=> set_value('background',isset($bloque->background) ? $bloque->background : ''),
								'class'=>'form-control input_color',
								'type'=>'color',
						),
						'val_req' => '1',
						'fijo' => '1',
						'label'=>$this->lang->line('cms_c_bloques_background'),
						'help'=>form_error('background'),
						'label_class'=>'control-label pull-right', //Clases de la label del intput
						'class'=>'col-md-1', //Clases
						'type'=>'color',
						'form_validation'=>'trim|xss_clean',
				),
				'5'=>array(
						'form_group'=>array(
								'name'=>'c_titulo', //name = nombre del campo en la base de datos
								'id'=>'c_titulo',
								'value'=> set_value('c_titulo',isset($bloque->c_titulo) ? $bloque->c_titulo : ''),
								'class'=>'form-control input_color',
								'type'=>'color',
						),
						'val_req' => '1',
						'fijo' => '1',
						'label'=>$this->lang->line('cms_c_bloques_color_titulo'),
						'help'=>form_error('c_titulo'),
						'label_class'=>'control-label pull-right', //Clases de la label del intput
						'class'=>'col-md-1', //Clases
						'type'=>'color',
						'form_validation'=>'trim|xss_clean',
				),
				'6'=>array(
						'form_group'=>array(
								'name'=>'ancho', //name = nombre del campo en la base de datos
								'id'=>'ancho',
								'value'=> set_value('ancho',isset($bloque->ancho) ? $bloque->ancho : 1),
								'class'=>'form-control ancho',
						),
						'val_req' => '1',
						'fijo' => '1',
						'dropdown'=>$ancho_dd,
						'label'=>$this->lang->line('cms_c_bloques_ancho'),
						'help'=>form_error('ancho'),
						'label_class'=>'control-label pull-right', //Clases de la label del intput
						'class'=>'col-md-4', //Clases
						'type'=>'select',
						'form_validation'=>'trim|xss_clean|integer|is_natural_no_zero',
				),
				'15'=>array(
						'form_group'=>array(
								'name'=>'prioridad', //name = nombre del campo en la base de datos
								'id'=>'prioridad',
								'value'=> ($nuevo==true)? set_value('prioridad',$this->General_model->maximo('bloque','prioridad',array('id_seccion'=>$seccion->id))->prioridad+1):set_value('prioridad',$bloque->prioridad),
								'class'=>'form-control',
						),
						'val_req' => '1',
						'fijo' => '1',
						'label'=>$this->lang->line('cms_c_listado_prioridad'),
						'type'=>'hidden',
						'form_validation'=>'trim|xss_clean|integer',
				),
				'16'=>array(
						'form_group'=>array(
								'name'=>'id_seccion', //name = nombre del campo en la base de datos
								'id'=>'id_seccion',
								'value'=> $seccion->id,
								'class'=>'form-control',
						),
						'val_req' => '1',
						'fijo' => '1',
						'label'=>'id',
						'type'=>'hidden',
						'form_validation'=>'trim|xss_clean|integer',
				),
				'17'=>array(
						'form_group'=>array(
								'name'=>'id_seccion', //name = nombre del campo en la base de datos
								'id'=>'id_seccion',
								'value'=> $seccion->id,
								'class'=>'form-control',
						),
						'val_req' => '1',
						'fijo' => '1',
						'label'=>'id',
						'type'=>'hidden',
						'form_validation'=>'trim|xss_clean|integer',
				),
		);
		
		$datos=array(
				'nombre'=>'bloque',
				'editando'=>isset($bloque->titulo_bloque) ? $bloque->titulo_bloque : '' ,
				'nuevo'=>$nuevo,
				'view'=>'seccion/crear_bloque',
				'redirect'=>'page/listar_bloques/'.$url_seccion
		);
		$this->data = array_merge($this->data, $datos);
		$this->data['inputs']=$inputs;
		$this->data['id_bloque']=isset($bloque->id_bloque)?$bloque->id_bloque:'';
		if(isset($bloque->id_bloque)){
			foreach($this->Idioma_model->get_idiomas_subidos_activos() as $idioma){
				$this->data['elementos'][$idioma->id_idioma] = $this->Seccion_model->get_bloque($idioma->id_idioma, $bloque->id_bloque);
			}
		}
		//$this->crear($inputs,$datos);
		if($this->input->post()){
			$conf = $this->General_model->get_config($this->ion_auth->user()->row()->id);
			$this->form_validation->set_message('is_natural_no_zero', $this->lang->line('login_c_is_natural_no_zero'));
			$this->form_validation->set_message('required',$this->lang->line('login_c_required'));
			$this->form_validation->set_message('max_length',$this->lang->line('login_c_max_length'));
			foreach($this->data['cargar_idiomas'] as $idioma){
				if($idioma->id_idioma == $conf->idioma_defecto){
					foreach($this->data['inputs'] as $it){
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
					foreach($this->data['inputs'] as $it){
						if(!$it['fijo'])
							$this->form_validation->set_rules($it['form_group']['name'].'_'.$idioma->id_idioma,$it['label'],$it['form_validation']);
					}
				}
			}
			if($this->form_validation->run()){
				foreach($this->data['inputs'] as $it){
					if($it['fijo'])
						$datos_insert[$it['form_group']['name']]=$this->input->post($it['form_group']['name']);
				}
				
				if ($nuevo==true){
					$id_bloque=$this->Seccion_model->crear_bloque('bloque',$datos_insert, $this->input->post('id_tipo_bloque'), $this->data['cargar_idiomas']);
				}else{
					$datos_insert['id_tipo_bloque']=$bloque->id_tipo_bloque;
					$this->General_model->update('bloque',$datos_insert,array('id_bloque'=>$id_bloque));
					//Falta borrar los datos si se cambia el tipo de bloque
				} 
				foreach($this->data['cargar_idiomas'] as $idioma){
					foreach($this->data['inputs'] as $it){
						if(!$it['fijo']){
							if($this->input->post($it['form_group']['name'].'_'.$idioma->id_idioma)){
								$datos_insert_idiomas[$it['form_group']['name']]=$this->input->post($it['form_group']['name'].'_'.$idioma->id_idioma);
							}else{
								$datos_insert_idiomas[$it['form_group']['name']]=$this->input->post($it['form_group']['name'].'_'.$conf->idioma_defecto).'_'.$idioma->id_idioma;
							}
						}
					}
					if($nuevo==true){
						$datos_insert_idiomas['id_idioma'] = $idioma->id_idioma;
						$datos_insert_idiomas['id_bloque'] = $id_bloque;
						$this->General_model->insert('bloque_idiomas', $datos_insert_idiomas);
					}else{
						if($this->General_model->existe('bloque_idiomas', array('id_bloque'=>$id_bloque, 'id_idioma'=>$idioma->id_idioma))){
							$this->General_model->update('bloque_idiomas',$datos_insert_idiomas,array('id_bloque'=>$id_bloque, 'id_idioma'=>$idioma->id_idioma));
						}else{
							$datos_insert_idiomas['id_idioma'] = $idioma->id_idioma;
							$datos_insert_idiomas['id_bloque'] = $id_bloque;
							$this->General_model->insert('bloque_idiomas', $datos_insert_idiomas);
						}	
					}
				}
				redirect('page/editar_bloque/'.$id_bloque);			
			}
		}
		$this->render_private($datos['view'], $this->data);
	}
	
	
	function crear_seccion($url_seccion=null){
		//datos dropdown
		// 			$estados_dd=$this->formularios->dropdown('estados','id','estado');
		$estados_dd['0'] = $this->lang->line('drop_seleccione');
		$estados_dd['1'] = $this->lang->line('cms_publicado');
		$estados_dd['2'] = $this->lang->line('cms_eliminado');
		$estados_dd['3'] = $this->lang->line('cms_borrador');
		//$ssecion_dd=$this->formularios->dropdown_idioma('super_seccion','id','nombre', $this->Usuario_model->get_usuario_idioma($this->ion_auth->user()->row()->id)->id_idioma);

		$prioridad_max=$this->General_model->maximo('seccion','prioridad');
		//Comprobamos si se está editando
		if(isset($url_seccion) && $url_seccion){
			$nuevo=false;
			$seccion = $this->Seccion_model->get_seccion_nombre($this->Usuario_model->get_usuario_idioma($this->ion_auth->user()->row()->id)->id_idioma, $url_seccion);
			if(count($seccion) == 0)
				redirect('errors/error_404');
			foreach($this->Idioma_model->get_idiomas_subidos_activos() as $idioma){
				$secciones[$idioma->id_idioma] = $this->Seccion_model->get_seccion($idioma->id_idioma, $seccion->id);
			}

			$title = array('title'=>$this->lang->line('cms_editar_seccion'));
		}else{
			$nuevo=true;
			$title = array('title'=>$this->lang->line('cms_crear_seccion'));
		}
		//array para formularios
				
		$config=array(
			'nombre'=>$this->lang->line('cms_c_sección'),
			'editando'=>isset($seccion->titulo) ? $seccion->titulo : '' ,
			'nuevo'=>$nuevo,
			'view'=>'formulario/crear',
			'model_update'=>array(
					'model'=>'General_model',
					'method'=>'update',
					'table'=>'seccion',
					'where'=>array(
							'id'=>isset($seccion->id) ? $seccion->id : '',
					),
			),
			'model_insert'=>array(
					'model'=>'General_model',
					'method'=>'insert',
					'table'=>'seccion'
			),
			'model_update_idiomas'=>array(
					'model'=>'General_model',
					'method'=>'update',
					'table'=>'seccion_idiomas',
					'where'=>array(
						'id_seccion'=>isset($seccion->id) ? $seccion->id : '',
					),
			),
			'model_insert_idiomas'=>array(
					'model'=>'General_model',
					'method'=>'insert',
					'table'=>'seccion_idiomas',
					'enlace'=>'id_seccion'
			),
			'redirect'=>'page/listar_secciones',
		);
		$config = array_merge($config, $title);
		//array para formularios
		$inputs=array(
				//Caso 1: input normal
				'1'=>array(
						'form_group'=>array(
								'name'=>'titulo', //name = nombre del campo en la base de datos
								'id'=>'titulo',
								'value'=> set_value('titulo',isset($seccion->titulo) ? $seccion->titulo : ''),
								'class'=>'form-control',
								'placeholder'=>$this->lang->line('cms_titulo_placeholder'),
						),
						'val_req' => '1',
						'fijo' => '0',
						'label'=>$this->lang->line('cms_titulo'),
						'help'=>form_error('titulo'),
						'label_class'=>'control-label pull-right', //Clases de la label del intput
						'class'=>'col-md-10', //Clases
						'type'=>'input',
						'form_validation'=>'trim|xss_clean|max_length[70]',
				),
				'2'=>array(
						'form_group'=>array(
								'name'=>'url_seo', //name = nombre del campo en la base de datos
								'id'=>'url_seo',
								'value'=> set_value('url_seo',isset($seccion->url_seo) ? $seccion->url_seo : ''),
								'class'=>'form-control',
								'placeholder'=>$this->lang->line('cms_url_seo_placeholder'),
						),
						'val_req' => '1',
						'fijo' => '0',
						'label'=>$this->lang->line('cms_url_seo'),
						'help'=>form_error('url_seo'),
						'label_class'=>'control-label pull-right', //Clases de la label del intput
						'class'=>'col-md-6', //Clases
						'type'=>'input',
						'form_validation'=>($nuevo==true)? 'trim|xss_clean|max_length[70]|is_unique[seccion_idiomas.url_seo]':'trim|xss_clean|required|max_length[70]',
				),
				//Caso 2: input textarea
				'3'=>array(
					'form_group'=>array(
						'name'=>'descripcion_seo', //name = nombre del campo en la base de datos
						'id'=>'descripcion_seo',
						'value'=> set_value('descripcion_seo',isset($seccion->descripcion_seo) ? $seccion->descripcion_seo : ''),
						'class'=>'form-control',
						'placeholder'=>$this->lang->line('cms_descripcion_seo_placeholder'),
						'rows'=>2,
					),
					'val_req' => '0',
					'fijo' => '0',
					'label'=>$this->lang->line('cms_descripcion_seo'),
					'help'=>form_error('descripcion_seo'),
					'label_class'=>'control-label pull-right', //Clases de la label del intput
					'class'=>'col-md-8', //Clases
					'type'=>'textarea',
					'form_validation'=>'trim|xss_clean|max_length[170]',
				),
					
				'4'=>array(
					'form_group'=>array(
						'name'=>'keyword_seo', //name = nombre del campo en la base de datos
						'id'=>'keyword_seo',
						'value'=> set_value('keyword_seo',isset($seccion->keyword_seo) ? $seccion->keyword_seo : ''),
						'class'=>'form-control',
						'placeholder'=>$this->lang->line('cms_palabras_clave_placeholder'),
					),
					'val_req' => '0',
					'fijo' => '0',
					'label'=>$this->lang->line('cms_palabras_clave'),
					'help'=>form_error('keyword_seo'),
					'label_class'=>'control-label pull-right', //Clases de la label del intput
					'class'=>'col-md-10', //Clases
					'type'=>'input',
					'form_validation'=>'trim|xss_clean|max_length[150]',
				),
				
				'5'=>array(
					'form_group'=>array(
						'name'=>'titulo_seo', //name = nombre del campo en la base de datos
						'id'=>'titulo_seo',
						'value'=> set_value('titulo_seo',isset($seccion->titulo_seo) ? $seccion->titulo_seo : ''),
						'class'=>'form-control',
						'placeholder'=>$this->lang->line('cms_titulo_seo_placeholder'),
					),
					'val_req' => '1',
					'fijo' => '0',
					'label'=>$this->lang->line('cms_titulo_seo'),
					'help'=>form_error('titulo_seo'),
					'label_class'=>'control-label pull-right', //Clases de la label del intput
					'class'=>'col-md-10', //Clases
					'type'=>'input',
					'form_validation'=>'trim|xss_clean|max_length[70]',
				),
					
				//Caso 3: select dropdown
				'6'=>array(
					'form_group'=>array(
						'name'=>'id_estado', //name = nombre del campo en la base de datos
						'id'=>'id_estado',
						'value'=> set_value('id_estado',isset($seccion->id_estado) ? $seccion->id_estado : 0),
						'class'=>'form-control',
					),
					'val_req' => '1',
					'fijo' => '1',
					'dropdown'=>$estados_dd,
					'label'=>$this->lang->line('cms_estado'),
					'help'=>form_error('id_estado'),
					'label_class'=>'control-label pull-right', //Clases de la label del intput
					'class'=>'col-md-4', //Clases
					'type'=>'select',
					'form_validation'=>'trim|xss_clean|integer|is_natural_no_zero',
				),
				
				/*'7'=>array(
					'form_group'=>array(
						'name'=>'id_super_seccion', //name = nombre del campo en la base de datos
						'id'=>'id_super_seccion',
						'value'=> set_value('id_super_seccion',isset($seccion->id_super_seccion) ? $seccion->id_super_seccion : 0),
						'class'=>'form-control',
					),
					'val_req' => '0',
					'fijo' => '1',
					'dropdown'=>$ssecion_dd,
					'label'=>$this->lang->line('cms_super_seccion'),
					'help'=>form_error('id_super_seccion'),
					'label_class'=>'control-label pull-right', //Clases de la label del intput
					'class'=>'col-md-4', //Clases
					'type'=>'select',
					'form_validation'=>'trim|xss_clean|integer',
				),*/
				//Tipo radio
				'8'=>array(
					'form_group'=>array(
						'name'=>'tipo_seccion', //name = nombre del campo en la base de datos
						'id'=>'tipo_seccion',
						'class'=>'form-control',
					),
					'fijo' => '1',
					'label'=>$this->lang->line('cms_tipo_seccion'),
					'help'=>form_error('tipo_seccion'),
					'label_class'=>'control-label pull-right', //Clases de la label del intput
					'class'=>'col-md-10', //Clases
					'type'=>'radio',
					'val_req' => '1',
					'form_validation'=>'trim|xss_clean|integer',
					'radio_buttons'=>array(
						'1'=> array(
							'value' => '1',
							'label' => $this->lang->line('cms_tipo_auto'),
							'checked' => ((isset($seccion->tipo_seccion) && $seccion->tipo_seccion == 1) ? 'si' : 'no'),
						),
					
						'2'=> array(
							'value' => '2',
							'label' => $this->lang->line('cms_tipo_manual'),
							'checked' => ((isset($seccion->tipo_seccion) && $seccion->tipo_seccion == 2) ? 'si' : 'no'),
						),
						'3'=> array(
							'value' => '3',
							'label' => $this->lang->line('cms_tipo_blog'),
							'checked' => ((isset($seccion->tipo_seccion) && $seccion->tipo_seccion == 3) ? 'si' : 'no'),
						),
						'4'=> array(
							'value' => '4',
							'label' => $this->lang->line('cms_tipo_contacto'),
							'checked' => ((isset($seccion->tipo_seccion) && $seccion->tipo_seccion == 4) ? 'si' : 'no'),
						),
						'5'=> array(
							'value' => '5',
							'label' => $this->lang->line('cms_tipo_desplegable'),
							'checked' => ((isset($seccion->tipo_seccion) && $seccion->tipo_seccion == 5) ? 'si' : 'no'),
						),
						'6'=> array(
							'value' => '6',
							'label' => $this->lang->line('cms_tipo_tienda'),
							'checked' => ((isset($seccion->tipo_seccion) && $seccion->tipo_seccion == 6) ? 'si' : 'no'),
						),
					),
				),
				//Tipo checkbox
				'9'=>array(
					'form_group'=>array(
						'name'=>'menu', //name = nombre del campo en la base de datos
						'id'=>'menu',
						'class'=>'form-control',
						'value' => '1',
						'checked'=> ((isset($seccion->menu) && $seccion->menu == 1) ? 'si' : 'no'),
					),
					'val_req' => '0',
					'fijo' => '1',
					'label'=>$this->lang->line('cms_visible_menu'),
					'help'=>form_error('menu'),
					'label_class'=>'control-label pull-right', //Clases de la label del intput
					'class'=>'col-md-10', //Clases
					'type'=>'checkbox',
					'form_validation'=>'trim|xss_clean|integer',
				),
				
				'10'=>array(
						'form_group'=>array(
								'name'=>'footer', //name = nombre del campo en la base de datos
								'id'=>'footer',
								'class'=>'form-control',
								'value' => '1',
								'checked'=> ((isset($seccion->footer) && $seccion->footer == 1) ? 'si' : 'no'),
						),
						'val_req' => '0',
						'fijo' => '1',
						'label'=>$this->lang->line('cms_visible_footer'),
						'help'=>form_error('footer'),
						'label_class'=>'control-label pull-right', //Clases de la label del intput
						'class'=>'col-md-10', //Clases
						'type'=>'checkbox',
						'form_validation'=>'trim|xss_clean|integer',
				),
				
				'11'=>array(
					'form_group'=>array(
						'name'=>'desplegable', //name = nombre del campo en la base de datos
						'id'=>'desplegable',
						'class'=>'form-control',
						'value' => '1',
						'checked'=> ((isset($seccion->desplegable) && $seccion->desplegable == 1) ? 'si' : 'no'),
					),
					'val_req' => '0',
					'fijo' => '1',
					'label'=>$this->lang->line('cms_desplegable'),
					'help'=>form_error('desplegable'),
					'label_class'=>'control-label pull-right', //Clases de la label del intput
					'class'=>'col-md-10', //Clases
					'type'=>'checkbox',
					'form_validation'=>'trim|xss_clean|integer',
				)
		);
		if(!$url_seccion){
			//Caso 4: oculto
			$array = array(array(
					'form_group'=>array(
							'name'=>'prioridad', //name = nombre del campo en la base de datos
							'id'=>'prioridad',
							'value'=> ($prioridad_max->prioridad + 1),
							'class'=>'form-control',
					),
					'val_req' => '0',
					'fijo' => '1',
					'label'=>$this->lang->line('cms_prioridad'),
					'type'=>'hidden',
					'form_validation'=>'trim|xss_clean|integer',
				));
			$inputs = array_merge($inputs, $array);
			$this->crear($inputs,$config);
		}else{
			$this->crear($inputs,$config, $secciones);
		}
		
	}
		
	function ordenar_secciones(){
		$config=array(
				'title'=>$this->lang->line('admin_ordenar_secciones'),
				'view'=>'formulario/ordenar',
				'model_get'=>array('model_name'=>'Seccion_model',
								   'model_method'=>'get_secciones',
								   'model_param'=> '',
								   'idioma' =>$this->Usuario_model->get_usuario_idioma($this->ion_auth->user()->row()->id)->id_idioma),
				'model_update'=>array('model_name'=>'General_model',
								   	  'model_method'=>'update',
								   	  'tabla'=>'seccion',
									  'id_tabla'=>'id'),
				'redirect'=>'page/listar_secciones',
		);
		$this->ordenar($config);
		/*$this->data = $this->inicializar('6', 'ordenar sección');
		$idioma = $this->Usuario_model->get_usuario_idioma($this->ion_auth->user()->row()->id)->id_idioma;
		$this->data['ordenar']=$this->Seccion_model->get_secciones($idioma);
		if($this->input->post()){
			$ids_ordenadas = explode(";", $this->input->post('input_orden'));
			for($i=0; $i<count($ids_ordenadas); $i++){
				$this->General_model->update('seccion',array('prioridad' => ($i+1)),array('id'=>$ids_ordenadas[$i]));
			}
			redirect('page/listar_secciones');
		}
		
		$this->render_private('formulario/ordenar', $this->data);*/
	}
	
	function ordenar_bloques($url_seccion=null){
		if($url_seccion==null){
			redirect('errors/error_404');
		}else{
			//$data['bloques']=$this->Seccion_model->listar_bloques($url_seccion);
		}
		
		$config=array(
				'title'=>$this->lang->line('cms_c_ordenar_bloques_de')." ".$url_seccion,
				'view'=>'formulario/ordenar_bloques',
				'model_get'=>array('model_name'=>'Seccion_model',
								   'model_method'=>'listar_bloques',
								   'model_param'=>$url_seccion,
								   'idioma'=>$this->Usuario_model->get_usuario_idioma($this->ion_auth->user()->row()->id)->id_idioma),
				'model_update'=>array('model_name'=>'General_model',
									  'model_method'=>'update',
									  'tabla'=>'bloque',
									  'id_tabla'=>'id_bloque'),
				'redirect'=>'page/listar_bloques/'.$url_seccion,
		);
		$this->ordenar($config);
	}
	
	function crear_bloque_texto($id_texto=null){
		$this->data = $this->inicializar('6', $this->lang->line('cms_c_crear_bloque_texto'));
		$idioma = $this->Usuario_model->get_usuario_idioma($this->ion_auth->user()->row()->id)->id_idioma;
		//Comprobamos si se está editando
		if(isset($id_texto)){
			$nuevo=false;
			$this->data['texto']=$this->Seccion_model->get_bloque_texto($idioma, $id_texto);
			if (count($this->data['texto'])==0){
				redirect('errors/error_404');
			}
		}else{
			redirect('errors/error_404');
		}
		//array para formularios
		$inputs=array(
				'1'=>array(
						'form_group'=>array(
								'name'=>'contenido', //name = nombre del campo en la base de datos
								'id'=>'contenido',
								'value'=> set_value('contenido',isset($data['texto']->contenido) ? $data['texto']->contenido : ''),
								'class'=>'form-control',
								'rows'=>20,
						),
						'val_req' => '1',
						'fijo' => '0',
						'label'=>$this->lang->line('cms_bloques_contenido'),
						'help'=>form_error('contenido'),
						'label_class'=>'control-label pull-right', //Clases de la label del intput
						'class'=>'col-md-8', //Clases
						'type'=>'textarea',
						'form_validation'=>'trim|required',
				),
	
		);
	
		$this->data['nuevo']=$nuevo;
		$this->data['seccion']=$this->Seccion_model->get_seccion_bloque($idioma, $this->data['texto']->id_bloque);
		$this->data['inputs']=$inputs;
		if(isset($this->data['texto']->contenido)){
			foreach($this->Idioma_model->get_idiomas_subidos_activos() as $idioma){
				$this->data['elementos'][$idioma->id_idioma] = $this->Seccion_model->get_bloque_texto($idioma->id_idioma, $id_texto);
			}
		}
		if($this->input->post()){
			$conf = $this->General_model->get_config($this->ion_auth->user()->row()->id);
			$this->form_validation->set_message('is_natural_no_zero', $this->lang->line('login_c_is_natural_no_zero'));
			$this->form_validation->set_message('required',$this->lang->line('login_c_required'));
			$this->form_validation->set_message('max_length',$this->lang->line('login_c_max_length'));
			$this->form_validation->set_message('is_unique',$this->lang->line('login_c_is_unique'));
			foreach($this->data['cargar_idiomas'] as $idioma){
				if($idioma->id_idioma == $conf->idioma_defecto){
					foreach($this->data['inputs'] as $it){
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
					foreach($this->data['inputs'] as $it){
						if(!$it['fijo'])
							$this->form_validation->set_rules($it['form_group']['name'].'_'.$idioma->id_idioma,$it['label'],$it['form_validation']);
					}
				}
			}
			if($this->form_validation->run()){
				foreach($this->data['cargar_idiomas'] as $idioma){
					foreach($this->data['inputs'] as $it){
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
						$datos_insert_idiomas['id_texto'] = $id_texto;
						$this->General_model->insert('texto_idiomas', $datos_insert_idiomas);
					}else{
						if($this->General_model->existe('texto_idiomas', array('id_texto'=>$id_texto, 'id_idioma'=>$idioma->id_idioma))){
							$this->General_model->update('texto_idiomas',$datos_insert_idiomas,array('id_texto'=>$id_texto, 'id_idioma'=>$idioma->id_idioma));
						}else{
							$datos_insert_idiomas['id_idioma'] = $idioma->id_idioma;
							$datos_insert_idiomas['id_texto'] = $id_texto;
							$this->General_model->insert('texto_idiomas', $datos_insert_idiomas);
						}
					}
				}
				redirect('page/listar_bloques/'.$this->data['seccion']->url_seo);
			}
		}
		$this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1','basePath' => base_url()."assets/admin/ckeditor/", 'outPut' => true));
		$this->render_private('seccion/crear_texto', $this->data);
	}
	
	/*function crear_carrusel($id_carrusel=null){
		$data = $this->inicializar('6', $this->lang->line('cms_crear_galeria'));
		if($id_carrusel==null){
			redirect('errors/error_404');
		}else{
			$data['carrusel']=$this->carrusel_model->get_imagenes_carrusel($data['idioma_actual']->id_idioma, $id_carrusel);
			if(count($data['carrusel'])==0){
				$data['imagenes']=false;
			}else{
				$data['imagenes']=true;
			}
			$data['categoria_carrusel']=$this->carrusel_model->get_categorias_carrusel($data['idioma_actual']->id_idioma, $id_carrusel);
			if(count($data['categoria_carrusel'])==0){
				$data['categorias']=false;
			}else{
				$data['categorias']=true;
			}
		}
		$data['id_carrusel']=$id_carrusel;
		
		$data['carrusel_bloque']=$this->carrusel_model->get_carrusel($id_carrusel);
		//$data['dd_tipo_galeria']=$this->formularios->dropdown('tipo_carrusel','id_tipo_carrusel','nombre');
		$data['dd_tipo_galeria'] = array(
				'1' => $this->lang->line('cms_tipo_galeria1'),
				'2' => $this->lang->line('cms_tipo_galeria2'),
				'3' => $this->lang->line('cms_tipo_galeria3'),
				'4' => $this->lang->line('cms_tipo_galeria4')
		);
		$data['dd_categoria']=$this->formularios->dropdown_idioma('categoria_carrusel','id','nombre_cat',$data['idioma_actual']->id_idioma, array('categoria_carrusel.id_carrusel'=>$id_carrusel));
		$data['dd_columnas']=array(
				'2'=>'2',
				'3'=>'3',
				'4'=>'4',
				'6'=>'6',
		);
		$data['seccion']=$this->Seccion_model->get_seccion_bloque($data['idioma_actual']->id_idioma, $data['carrusel_bloque']->id_bloque);
		
		if($this->input->post('submit_imagen')){
			$conf = $this->General_model->get_config($this->ion_auth->user()->row()->id);
			$this->form_validation->set_rules('id_categoria',$this->lang->line('cms_galeria_categoria'),'trim|xss_clean|integer');
			
			foreach($data['cargar_idiomas'] as $idioma){
				if($idioma->id_idioma == $conf->idioma_defecto){
					$this->form_validation->set_rules('titulo_seo_'.$idioma->id_idioma,$this->lang->line('cms_galeria_titulo_seo_imagen'),'trim|required|xss_clean|max_length[200]');
				}else{
					$this->form_validation->set_rules('titulo_carrusel_'.$idioma->id_idioma,$this->lang->line('cms_galeria_titulo_imagen'),'trim|xss_clean|max_length[200]');
					$this->form_validation->set_rules('titulo_seo_'.$idioma->id_idioma,$this->lang->line('cms_galeria_titulo_seo_imagen'),'trim|xss_clean|max_length[200]');
					$this->form_validation->set_rules('texto_carrusel_'.$idioma->id_idioma,$this->lang->line('cms_galeria_texto_imagen'),'trim|xss_clean');
				}
			}
			if($this->form_validation->run()){
				$this->load->library('upload');
				$this->load->library('image_lib');
				foreach($data['cargar_idiomas'] as $idioma){
					if(!file_exists('img/carrusel/'.$idioma->id_idioma))
						mkdir('img/carrusel/'.$idioma->id_idioma, '0755', true);
					if(!file_exists('img/carruselmini/'.$idioma->id_idioma))
						mkdir('img/carruselmini/'.$idioma->id_idioma, '0755', true);
				}
				$prioridad=$this->General_model->maximo('imagen_carrusel', 'prioridad', array('id_carrusel' => $id_carrusel));
				$imagen_carrusel_data = array(
						'id_categoria'=>$this->input->post('id_categoria'),
						'id_carrusel'=>$id_carrusel,
						'prioridad'=>$prioridad->prioridad+1,
				);
				$id_imagen_carrusel = $this->General_model->insert('imagen_carrusel',$imagen_carrusel_data);
				foreach($data['cargar_idiomas'] as $idioma){
					if($idioma->id_idioma == $conf->idioma_defecto){
						if (isset($_FILES['userfile_'.$idioma->id_idioma]['tmp_name']) && $_FILES['userfile_'.$idioma->id_idioma]['tmp_name']) {						
							$config['upload_path'] = 'img/carrusel/'.$idioma->id_idioma.'/';
							$config['allowed_types']='gif|jpg|jpeg|png';
							$config['max_size']	= '1024';
							$config['overwrite']=FALSE;
							$this->upload->initialize($config);
							//$config['encrypt_name'] = TRUE;					
							if (!$this->upload->do_upload('userfile_'.$idioma->id_idioma)) {
								$data['error']='error';
							}else{
								$file_data = $this->upload->data();
								$imagen_carrusel_data_idiomas['imagen'] = $file_data['file_name'];
								//Ahora creamos una copia de la imagen a tamaño 30*30
								$config['image_library']='gd2';
								$config['source_image']='img/carrusel/'.$idioma->id_idioma.'/'.$file_data['file_name'];
								$config['new_image']='img/carruselmini/'.$idioma->id_idioma.'/';
								$config['create_thumb'] = TRUE;
								$config['maintain_ratio'] = TRUE;
								$config['width'] = 562;
								$config['height'] = 374;
								
								$this->image_lib->clear();
								$this->image_lib->initialize($config);
								
								$imagen_carrusel_data_idiomas['imagen_mini'] = $file_data['raw_name'].'_thumb'.$file_data['file_ext'];
								$this->image_lib->resize();
							}
						}else{
							$data['error']='no_image';
						}
					}else{
						if(isset($_FILES['userfile_'.$idioma->id_idioma]['tmp_name']) && $_FILES['userfile_'.$idioma->id_idioma]['tmp_name']){
							$config['upload_path'] = 'img/carrusel/'.$idioma->id_idioma.'/';
							$config['allowed_types']='gif|jpg|jpeg|png';
							$config['max_size']	= '1024';
							$config['overwrite']=FALSE;
							$this->upload->initialize($config);
							//$config['encrypt_name'] = TRUE;					
							if (!$this->upload->do_upload('userfile_'.$idioma->id_idioma)) {
								$data['error']='error';
							}else{
								$file_data = $this->upload->data();
								$imagen_carrusel_data_idiomas['imagen'] = $file_data['file_name'];
								//Ahora creamos una copia de la imagen a tamaño 30*30
								$config['image_library']='gd2';
								$config['source_image']='img/carrusel/'.$idioma->id_idioma.'/'.$file_data['file_name'];
								$config['new_image']='img/carruselmini/'.$idioma->id_idioma.'/';
								$config['create_thumb'] = TRUE;
								$config['maintain_ratio'] = TRUE;
								$config['width'] = 562;
								$config['height'] = 374;
								$this->image_lib->clear();
								$this->image_lib->initialize($config);
								
								$imagen_carrusel_data_idiomas['imagen_mini'] = $file_data['raw_name'].'_thumb'.$file_data['file_ext'];
								$this->image_lib->resize();
							}
						}else{
							$imagen_carrusel = $this->carrusel_model->get_imagen_carrusel($conf->idioma_defecto, $id_imagen_carrusel);
							copy('./img/carrusel/'.$conf->idioma_defecto.'/'.$imagen_carrusel->imagen, './img/carrusel/'.$idioma->id_idioma.'/'.$imagen_carrusel->imagen);
							copy('./img/carruselmini/'.$conf->idioma_defecto.'/'.$imagen_carrusel->imagen_mini, './img/carruselmini/'.$idioma->id_idioma.'/'.$imagen_carrusel->imagen_mini);
							$imagen_carrusel_data_idiomas['imagen'] = $imagen_carrusel->imagen;
							$imagen_carrusel_data_idiomas['imagen_mini'] = $imagen_carrusel->imagen_mini;
						}
					}
					if(!isset($data['error'])){
						$imagen_carrusel_data_idiomas2 = array(
								'titulo_carrusel'=>$this->input->post('titulo_carrusel_'.$idioma->id_idioma),
								'titulo_seo'=>$this->input->post('titulo_seo_'.$idioma->id_idioma),
								'texto_carrusel'=>$this->input->post('texto_carrusel_'.$idioma->id_idioma),
								'id_idioma'=>$idioma->id_idioma,
								'id_imagen_carrusel' => $id_imagen_carrusel
						);
						$imagen_carrusel_data_idiomas = array_merge($imagen_carrusel_data_idiomas, $imagen_carrusel_data_idiomas2);
						$this->General_model->insert('imagen_carrusel_idiomas',$imagen_carrusel_data_idiomas);					
					}
				}
				redirect('cms-crear-bloque-carrusel/'.$id_carrusel);
			}
		}
		if($this->input->post('submit_carrusel')){
			//echo 'tipo carrusel: '.$this->input->post('tipo_carrusel');
			$this->form_validation->set_rules('tipo_carrusel',$this->lang->line('cms_galeria_tipo_galeria'),'trim|xss_clean|integer');
			$this->form_validation->set_rules('por_pagina',$this->lang->line('cms_galeria_imagenes_pagina'),'trim|xss_clean|integer');
			$this->form_validation->set_rules('maximo',$this->lang->line('cms_galeria_numero_imagenes'),'trim|xss_clean|integer');
			$this->form_validation->set_rules('columnas',$this->lang->line('cms_galeria_numero_columnas'),'trim|xss_clean|integer');
			if($this->form_validation->run()){
				$carrusel_data=array(
						'tipo_carrusel'=>$this->input->post('tipo_carrusel'),
						'por_pagina'=>$this->input->post('por_pagina'),
						'maximo'=>$this->input->post('maximo'),
						'columnas'=>$this->input->post('columnas'),
				);
				$this->General_model->update('carrusel',$carrusel_data,array('id'=>$id_carrusel));
				redirect('cms-crear-bloque-carrusel/'.$id_carrusel);
			}
		}
		if($this->input->post('submit_cat')){
			foreach($data['cargar_idiomas'] as $idioma){
				$this->form_validation->set_rules('nombre_cat_'.$idioma->id_idioma,$this->lang->line('cms_galeria_nombre_categoria'),'trim|required|xss_clean');
				$this->form_validation->set_rules('descripcion_cat_'.$idioma->id_idioma,$this->lang->line('cms_galeria_texto_categoria'),'trim|xss_clean');
			}

			if($this->form_validation->run()){
				$categoria_data=array(
						'id_carrusel'=>$id_carrusel,
						'prioridad'=>(($this->General_model->maximo('categoria_carrusel','prioridad',array('id_carrusel'=>$id_carrusel))->prioridad)+1)
				);
				$id_categoria = $this->General_model->insert('categoria_carrusel',$categoria_data);
				foreach($data['cargar_idiomas'] as $idioma){
					$categoria_data_idiomas=array(
							'nombre_cat'=>$this->input->post('nombre_cat_'.$idioma->id_idioma),
							'descripcion_cat'=>$this->input->post('descripcion_cat_'.$idioma->id_idioma),
							'id_categoria_carrusel' => $id_categoria,
							'id_idioma' => $idioma->id_idioma
					);
					$this->General_model->insert('categoria_carrusel_idiomas',$categoria_data_idiomas);
				}
				redirect('cms-crear-bloque-carrusel/'.$id_carrusel);
			}
		}
		
		$this->template->set_template('header_and_content');
		$this->template->write_view('content','formulario/crear_galeria',$data);
		$this->template->write_view('header','templates/header_admin',$data);
		$this->template->render();
	}

	function ordenar_carrusel($carrusel){
		$config=array(
				'title'=>$this->lang->line('cms_galeria_ordenar_imagenes'),
				'view'=>'formulario/ordenar_carrusel',
				'model_get'=>array('model_name'=>'carrusel_model',
						'model_method'=>'get_imagenes',
						'model_param'=>$carrusel,
						'idioma'=> $this->Usuario_model->get_usuario_idioma($this->ion_auth->user()->row()->id)->id_idioma),
				'model_update'=>array('model_name'=>'General_model',
						'model_method'=>'update',
						'tabla'=>'imagen_carrusel',
						'id_tabla'=>'id_imagen_carrusel'),
				'redirect'=>'cms-crear-bloque-carrusel/'.$carrusel,
		);
		$this->ordenar($config);
	}
	
// 	//Editar la imagen del carrusel
	function editar_carrusel($id_imagen_carrusel=null){
		$data = $this->inicializar('6', $this->lang->line('cms_c_editar_imagen_galeria'));
		if($id_imagen_carrusel==null){
			redirect('errors/error_404');
		}else{
			$data['imagen_carrusel2']=$this->carrusel_model->get_imagen_carrusel($data['idioma_actual']->id_idioma, $id_imagen_carrusel);
			if(count($data['imagen_carrusel2'])!=1){
				redirect('errors/error_404');
			}
			foreach($data['cargar_idiomas'] as $idioma){
				$data['imagen_carrusel'][$idioma->id_idioma] = $this->carrusel_model->get_imagen_carrusel($idioma->id_idioma, $id_imagen_carrusel);
			}
		}
		$id_carrusel=$data['imagen_carrusel2']->id_carrusel;
		$data['id_carrusel']=$id_carrusel;		
		$data['carrusel']=$this->carrusel_model->get_carrusel($id_carrusel);
		//echo '<br /><br /><br />'.$data['carrusel']->id;
		$data['dd_tipo_galeria'] = array(
				'1' => $this->lang->line('cms_tipo_galeria1'),
				'2' => $this->lang->line('cms_tipo_galeria2'),
				'3' => $this->lang->line('cms_tipo_galeria3')
		);
		$data['dd_categoria']=$this->formularios->dropdown_idioma('categoria_carrusel','id','nombre_cat',$data['idioma_actual']->id_idioma, array('categoria_carrusel.id_carrusel'=>$id_carrusel));
		
		if($this->input->post('submit')){
			$conf = $this->General_model->get_config($this->ion_auth->user()->row()->id);
			$this->form_validation->set_rules('id_categoria',$this->lang->line('cms_galeria_categoria'),'trim|xss_clean|integer');
			
			foreach($data['cargar_idiomas'] as $idioma){
				if($idioma->id_idioma == $conf->idioma_defecto){
					$this->form_validation->set_rules('titulo_seo_'.$idioma->id_idioma,$this->lang->line('cms_galeria_titulo_seo_imagen'),'trim|required|xss_clean|max_length[200]');
				}else{
					$this->form_validation->set_rules('titulo_carrusel_'.$idioma->id_idioma,$this->lang->line('cms_galeria_titulo_imagen'),'trim|xss_clean|max_length[200]');
					$this->form_validation->set_rules('titulo_seo_'.$idioma->id_idioma,$this->lang->line('cms_galeria_titulo_seo_imagen'),'trim|xss_clean|max_length[200]');
					$this->form_validation->set_rules('texto_carrusel_'.$idioma->id_idioma,$this->lang->line('cms_galeria_texto_imagen'),'trim');
				}
			}
			if($this->form_validation->run()){
				$this->load->library('upload');
				$this->load->library('image_lib');
				foreach($data['cargar_idiomas'] as $idioma){
					if(!file_exists('img/carrusel/'.$idioma->id_idioma))
						mkdir('img/carrusel/'.$idioma->id_idioma, '0755', true);
					if(!file_exists('img/carruselmini/'.$idioma->id_idioma))
						mkdir('img/carruselmini/'.$idioma->id_idioma, '0755', true);
				}
				$imagen_carrusel_data = array(
						'id_categoria'=>$this->input->post('id_categoria')
				);
				$this->General_model->update('imagen_carrusel',$imagen_carrusel_data, array('id_carrusel' => $id_carrusel));
				foreach($data['cargar_idiomas'] as $idioma){
					$modificado = FALSE;
					if (isset($_FILES['userfile_'.$idioma->id_idioma]['tmp_name']) && $_FILES['userfile_'.$idioma->id_idioma]['tmp_name']) {
						$config['upload_path'] = 'img/carrusel/'.$idioma->id_idioma.'/';
						$config['allowed_types']='gif|jpg|jpeg|png';
						$config['max_size']	= '1024';
						$config['overwrite']=FALSE;
						$this->upload->initialize($config);
						//$config['encrypt_name'] = TRUE;
						if (!$this->upload->do_upload('userfile_'.$idioma->id_idioma)) {
							$data['error']='error';
						}else{
							$file_data = $this->upload->data();
							$imagen_carrusel_data_idiomas['imagen'] = $file_data['file_name'];
							//Ahora creamos una copia de la imagen a tamaño 30*30
							$config['image_library']='gd2';
							$config['source_image']='img/carrusel/'.$idioma->id_idioma.'/'.$file_data['file_name'];
							$config['new_image']='img/carruselmini/'.$idioma->id_idioma.'/';
							$config['create_thumb'] = TRUE;
							$config['maintain_ratio'] = TRUE;
							$config['width'] = 562;
							$config['height'] = 374;
				
							$this->image_lib->clear();
							$this->image_lib->initialize($config);
				
							$imagen_carrusel_data_idiomas['imagen_mini'] = $file_data['raw_name'].'_thumb'.$file_data['file_ext'];
							$this->image_lib->resize();
							$modificado = TRUE;
						}
					}
					if(!isset($data['error'])){
						if($modificado){
							if(isset($data['imagen_carrusel'][$idioma->id_idioma]->imagen) && file_exists('img/carrusel/'.$idioma->id_idioma.'/'.$data['imagen_carrusel'][$idioma->id_idioma]->imagen))
								unlink('img/carrusel/'.$idioma->id_idioma.'/'.$data['imagen_carrusel'][$idioma->id_idioma]->imagen);
							if(isset($data['imagen_carrusel'][$idioma->id_idioma]->imagen_mini) && file_exists('img/carruselmini/'.$idioma->id_idioma.'/'.$data['imagen_carrusel'][$idioma->id_idioma]->imagen_mini))
								unlink('img/carruselmini/'.$idioma->id_idioma.'/'.$data['imagen_carrusel'][$idioma->id_idioma]->imagen_mini);
						}
						$imagen_carrusel_data_idiomas2 = array(
								'titulo_carrusel'=>$this->input->post('titulo_carrusel_'.$idioma->id_idioma),
								'titulo_seo'=>$this->input->post('titulo_seo_'.$idioma->id_idioma),
								'texto_carrusel'=>$this->input->post('texto_carrusel_'.$idioma->id_idioma),	
						);
						if($modificado)
							$imagen_carrusel_data_idiomas2 = array_merge($imagen_carrusel_data_idiomas2, $imagen_carrusel_data_idiomas);

						$this->General_model->update('imagen_carrusel_idiomas',$imagen_carrusel_data_idiomas2, array('id_imagen_carrusel' => $id_imagen_carrusel, 'id_idioma' => $idioma->id_idioma));
					}
				}
				redirect('cms-crear-bloque-carrusel/'.$id_carrusel);	
			}			
		}
		
		$this->template->set_template('header_and_content');
		$this->template->write_view('content','formulario/editar_galeria',$data);
		$this->template->write_view('header','templates/header_admin',$data);
		$this->template->render();
	}
	
	function eliminar_imagen_carrusel($id_imagen_carrusel=null){
		if($id_imagen_carrusel==null){
			redirect('errors/error_404');
		}else{
			foreach($this->Idioma_model->get_idiomas_subidos_activos() as $idioma){
				$data['imagen_carrusel'][$idioma->id_idioma]=$this->carrusel_model->get_imagen_carrusel($idioma->id_idioma, $id_imagen_carrusel);
				if(!isset($id_carrusel))
					$id_carrusel = $data['imagen_carrusel'][$idioma->id_idioma]->id_carrusel;
				if(count($data['imagen_carrusel'][$idioma->id_idioma])==1){
					if(isset($data['imagen_carrusel'][$idioma->id_idioma]->imagen) && file_exists('img/carrusel/'.$idioma->id_idioma.'/'.$data['imagen_carrusel'][$idioma->id_idioma]->imagen))
						unlink('img/carrusel/'.$idioma->id_idioma.'/'.$data['imagen_carrusel'][$idioma->id_idioma]->imagen);
					if(isset($data['imagen_carrusel'][$idioma->id_idioma]->imagen_mini) && file_exists('img/carruselmini/'.$idioma->id_idioma.'/'.$data['imagen_carrusel'][$idioma->id_idioma]->imagen_mini))
						unlink('img/carruselmini/'.$idioma->id_idioma.'/'.$data['imagen_carrusel'][$idioma->id_idioma]->imagen_mini);
					$this->General_model->delete('imagen_carrusel_idiomas',array('id_imagen_carrusel'=>$id_imagen_carrusel, 'id_idioma'=>$idioma->id_idioma));
				}
			}
			$this->General_model->delete('imagen_carrusel',array('id_imagen_carrusel'=>$id_imagen_carrusel));
			redirect('cms-crear-bloque-carrusel/'.$id_carrusel);
		}
	}
	
	function ordenar_carrusel_categorias($carrusel){
		$this->load->model('carrusel_model');
		$config=array(
				'title'=>$this->lang->line('cms_c_ordenar_categorias_carrusel'),
				'view'=>'formulario/ordenar_categorias',
				'model_get'=> array('model_name'=>'carrusel_model',
						'model_method'=>'get_categorias_carrusel',
						'model_param'=>$carrusel,
						'idioma'=> $this->Usuario_model->get_usuario_idioma($this->ion_auth->user()->row()->id)->id_idioma),
				'model_update'=>array('model_name'=>'General_model',
						'model_method'=>'update',
						'tabla'=>'categoria_carrusel',
						'id_tabla'=>'id'),
				'redirect'=>'cms-crear-bloque-carrusel/'.$carrusel,
		);
		$this->ordenar($config);
	}
	
	//EDITAR CATEGORIA
	function editar_carrusel_categoria($id_categoria_carrusel=null){
		$data = $this->inicializar('6', $this->lang->line('cms_c_galeria_editar_categoria'));
		if($id_categoria_carrusel==null){
			redirect('errors/error_404');
		}else{
			foreach($data['cargar_idiomas'] as $idioma){
				$data['elementos'][$idioma->id_idioma] =$this->carrusel_model->get_categoria_carrusel($idioma->id_idioma, $id_categoria_carrusel);
			}
		}
		$id_carrusel = $data['elementos'][$data['idioma_actual']->id_idioma]->id_carrusel;
		$data['id_carrusel']=$id_carrusel;
		$data['nuevo']=false;
		$data['nombre']=$data['elementos'][$data['idioma_actual']->id_idioma]->nombre_cat;
		$data['editando']='categoria';
		
		$data['inputs']=array(
				//Caso 1: input normal
				'1'=>array(
						'form_group'=>array(
								'name'=>'nombre_cat', //name = nombre del campo en la base de datos
								'id'=>'nombre_cat',
								'value'=> '',
								'class'=>'form-control',
								'placeholder'=> $this->lang->line('cms_galeria_nombre_categoria'),
								'required'=>'required'
						),
						'fijo' => '0',
						'val_req' => '1',
						'label'=> $this->lang->line('cms_galeria_categoria_nombre'),
						'help'=>form_error('nombre_cat'),
						'label_class'=>'control-label pull-right', //Clases de la label del intput
						'class'=>'col-md-10', //Clases
						'type'=>'input',
						'form_validation'=>'trim|xss_clean|max_length[25]',
				),
				//Caso 2: input textarea
				'3'=>array(
						'form_group'=>array(
								'name'=>'descripcion_cat', //name = nombre del campo en la base de datos
								'id'=>'descripcion_cat',
								'value'=> '',
								'class'=>'form-control',
								'placeholder'=>$this->lang->line('cms_galeria_texto_categoria'),
								'rows'=>2,
						),
						'fijo' => '0',
						'val_req' => '0',
						'label'=>$this->lang->line('cms_galeria_categoria_texto'),
						'help'=>form_error('descripcion_cat'),
						'label_class'=>'control-label pull-right', //Clases de la label del intput
						'class'=>'col-md-8', //Clases
						'type'=>'textarea',
						'form_validation'=>'trim|xss_clean',
				),
		);
		
		$data['carrusel']=$this->carrusel_model->get_carrusel($id_carrusel);
	
		if($this->input->post()){
			$this->form_validation->set_message('is_natural_no_zero', 'Debe seleccionar algún elemento del campo %s');
			foreach($data['inputs'] as $it){
				$this->form_validation->set_rules($it['form_group']['name'],$it['label'],$it['form_validation']);
			}
			if($this->form_validation->run()){
				$conf = $this->General_model->get_config($this->ion_auth->user()->row()->id);
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
					foreach($data['cargar_idiomas'] as $idioma){
						foreach($data['inputs'] as $it){
							if($this->input->post($it['form_group']['name'].'_'.$idioma->id_idioma)){
								$datos_insert_idiomas[$it['form_group']['name']]=$this->input->post($it['form_group']['name'].'_'.$idioma->id_idioma);
							}
						}
						if($this->General_model->existe('categoria_carrusel_idiomas', array('id_categoria_carrusel'=>$id_categoria_carrusel, 'id_idioma' => $idioma->id_idioma))){
							$this->General_model->update('categoria_carrusel_idiomas',$datos_insert_idiomas,array('id_categoria_carrusel'=>$id_categoria_carrusel, 'id_idioma' => $idioma->id_idioma));
						}else{
							$datos_insert_idiomas['id_idioma'] = $idioma->id_idioma;
							$datos_insert_idiomas['id_categoria_carrusel'] = $id_categoria_carrusel;
							$this->General_model->insert('categoria_carrusel_idiomas', $datos_insert_idiomas);
						}	
						$this->General_model->update('categoria_carrusel_idiomas',$datos_insert_idiomas,array('id_categoria_carrusel'=>$id_categoria_carrusel, 'id_idioma' => $idioma->id_idioma));
					}						
					redirect('cms-crear-bloque-carrusel/'.$id_carrusel);
				}
			}
		}
		
		$this->template->set_template('header_and_content');
		$this->template->write_view('content','formulario/crear',$data);
		$this->template->write_view('header','templates/header_admin',$data);
		$this->template->render();
	}

	function eliminar_categoria_carrusel($id_categoria_carrusel=null){
		if($id_categoria_carrusel==null){
			redirect('errors/error_404');
		}else{
			foreach($this->Idioma_model->get_idiomas_subidos_activos() as $idioma){
				$data['categoria_carrusel'][$idioma->id_idioma]=$this->carrusel_model->get_categoria_carrusel($idioma->id_idioma, $id_categoria_carrusel);
				if(!isset($id_carrusel))
					$id_carrusel = $data['categoria_carrusel'][$idioma->id_idioma]->id_carrusel;
				if(count($data['categoria_carrusel'][$idioma->id_idioma])==1){
					$this->General_model->delete('categoria_carrusel_idiomas',array('id_categoria_carrusel'=>$id_categoria_carrusel, 'id_idioma'=>$idioma->id_idioma));
				}
			}
			$this->General_model->delete('categoria_carrusel',array('id'=>$id_categoria_carrusel));
			redirect('cms-crear-bloque-carrusel/'.$id_carrusel);
		}
	}*/

	function borrar_bloque($id_bloque,$borrar_bloque=null){
		//Primero comprobar el tipo y borrar su contenido
		if($borrar_bloque==null){
			$borrar_bloque=true;
		}else{
			$borrar_bloque=false;
		}
		$idiomas_activos = $this->Idioma_model->get_idiomas_subidos_activos();
		$bloque=$this->Seccion_model->get_bloque(0, $id_bloque);
		if($bloque->id_tipo_bloque==1){ //Si es texto
			$texto=$this->Seccion_model->get_bloque_txt(0, $id_bloque);
			foreach($idiomas_activos as $idioma){
				$this->General_model->delete('texto_idiomas',array('id_texto'=>$texto->id, 'id_idioma'=>$idioma->id_idioma));
			}
			$this->General_model->delete('texto',array('id'=>$texto->id));
		}else if ($bloque->id_tipo_bloque==2){ //Si es carrusel
			$carrusel=$this->Seccion_model->get_bloque_carrusel($id_bloque);
			$imagenes=$this->carrusel_model->get_imagenes(0, $carrusel->id);
			$categorias=$this->carrusel_model->get_categorias_carrusel(0, $carrusel->id);
			//borrar imágenes
			if(count($imagenes)!=0){
				foreach($imagenes as $it){
					foreach($idiomas_activos as $idioma){
						if(isset($this->carrusel_model->get_imagen_carrusel($idioma->id_idioma, $it->id_imagen_carrusel)->imagen) && file_exists('img/carrusel/'.$idioma->id_idioma.'/'.$this->carrusel_model->get_imagen_carrusel($idioma->id_idioma, $it->id_imagen_carrusel)->imagen))
							unlink('img/carrusel/'.$idioma->id_idioma.'/'.$this->carrusel_model->get_imagen_carrusel($idioma->id_idioma, $it->id_imagen_carrusel)->imagen);
						if(isset($this->carrusel_model->get_imagen_carrusel($idioma->id_idioma, $it->id_imagen_carrusel)->imagen_mini) && file_exists('img/carruselmini/'.$idioma->id_idioma.'/'.$this->carrusel_model->get_imagen_carrusel($idioma->id_idioma, $it->id_imagen_carrusel)->imagen_mini))
							unlink('img/carruselmini/'.$idioma->id_idioma.'/'.$this->carrusel_model->get_imagen_carrusel($idioma->id_idioma, $it->id_imagen_carrusel)->imagen_mini);
						$this->General_model->delete('imagen_carrusel_idiomas',array('id_imagen_carrusel'=>$it->id_imagen_carrusel, 'id_idioma'=>$idioma->id_idioma));
					}
					$this->General_model->delete('imagen_carrusel',array('id_imagen_carrusel'=>$it->id_imagen_carrusel));
				}				
			}
			//borrar categorias
			if(count($categorias)!=0){
				foreach($categorias as $cat){
					foreach($idiomas_activos as $idioma){
						$this->General_model->delete('categoria_carrusel_idiomas',array('id_categoria_carrusel'=>$cat->id, 'id_idioma'=>$idioma->id_idioma));
					}
					$this->General_model->delete('categoria_carrusel',array('id'=>$cat->id));
				}
			}
			//borrar carrusel
			$this->General_model->delete('carrusel',array('id'=>$carrusel->id));
		}
		//una vez borrado el contenido: borrar el bloque
		foreach($idiomas_activos as $idioma){
			$this->General_model->delete('bloque_idiomas',array('id_bloque'=>$id_bloque, 'id_idioma'=>$idioma->id_idioma));
		}
		$this->General_model->delete('bloque',array('id_bloque'=>$id_bloque));
		$seccion=$this->Seccion_model->get_seccion($this->Usuario_model->get_usuario_idioma($this->ion_auth->user()->row()->id)->id_idioma, $bloque->id_seccion);
		if($borrar_bloque==true){
			redirect('page/listar_bloques/'.$seccion->url_seo);
		}
	}
	
	function borrar_seccion($url_seo, $seccion = 'seccion'){
		//borramos los bloques de la sección
		$bloques=$this->Seccion_model->listar_bloques($this->Usuario_model->get_usuario_idioma($this->ion_auth->user()->row()->id)->id_idioma, $url_seo, 0);
		if(count($bloques)!=0){
			foreach($bloques as $bl){
				$this->borrar_bloque($bl->id_bloque, $seccion);
			}
		}
		$seccion = $this->Seccion_model->get_seccion_nombre($this->Usuario_model->get_usuario_idioma($this->ion_auth->user()->row()->id)->id_idioma, $url_seo);
		//Eliminamos la sección
		foreach($this->Idioma_model->get_idiomas_subidos_activos() as $idioma){
			$this->General_model->delete('seccion_idiomas',array('id_seccion'=>$seccion->id, 'id_idioma'=>$idioma->id_idioma));
		}
		$this->General_model->delete('seccion',array('id'=>$seccion->id));
		if($seccion == 'seccion')
			redirect('page/listar_secciones');
	}
	
// 	/*********************************** Grupos de secciones ***************************************/
	function listar_super_secciones(){
		$config=array(
				'title'=>$this->lang->line('cms_c_listar_super_seccion'),
				'view'=>'listado/listado',
				'model'=>array('model_name'=>'Seccion_model',
						'model_method'=>'get_lista_super_secciones',
						'idioma'=>$this->Usuario_model->get_usuario_idioma($this->ion_auth->user()->row()->id)->id_idioma),
				'columnas'=>array($this->lang->line('cms_c_listado_prioridad')=>'prioridad',
								$this->lang->line('cms_c_listado_nombre')=> 'nombre',
								$this->lang->line('cms_c_listado_footer')=> 'footer',),
				'opciones'=> array( 'Editar'=>array('href'=>site_url('cms-crear-super-seccion'),
													'icon'=>'glyphicon glyphicon-edit',
													'keys'=>array('id'),
													'title'=>$this->lang->line('cms_c_editar_grupo_secciones')),
									'ListSeccion'=>array('href'=>site_url('cms-listar-secciones'),
													'icon'=>'glyphicon glyphicon-list',
													'keys'=>array('id'),
													'title'=>$this->lang->line('cms_c_listar_grupo_secciones')),
									'Borrar'=>array('href'=>site_url('cms-borrar-super-seccion'),
													'icon'=>'glyphicon glyphicon-trash borrar',
													'keys'=>array('id'),
													'title'=>$this->lang->line('cms_c_borrar_grupo_secciones'))),
				'botones'=>array('1'=>array('href'=>site_url('cms-crear-super-seccion'),
											'class'=>'btn btn-default pull-right',
											'contenido'=>'<span class="glyphicon glyphicon-plus"></span> '.$this->lang->line('cms_c_listado_boton_nueva')),
								 '2'=>array('href'=>site_url('cms-ordenar-super-secciones'),
											'class'=>'btn btn-default pull-right',
											'contenido'=>'<span class="glyphicon glyphicon-random"></span> '.$this->lang->line('cms_c_listado_boton_ordenar')))
		);
		$this->listado($config);
	}
	
	function ordenar_super_secciones(){
		$config=array(
				'title'=>$this->lang->line('cms_c_ordenar_grupo_secciones'),
				'view'=>'formulario/ordenar_super_secciones',
				'model_get'=>array('model_name'=>'Seccion_model',
									'model_method'=>'get_super_secciones',
									'model_param'=>'',
									'idioma'=>$this->Usuario_model->get_usuario_idioma($this->ion_auth->user()->row()->id)->id_idioma),
				'model_update'=>array('model_name'=>'General_model',
									'model_method'=>'update',
									'tabla'=>'super_seccion',
									'id_tabla'=>'id'),
				'redirect'=>'cms-listar-super-secciones',
		);
		$this->ordenar($config);
	}
	
	function crear_super_seccion($id_super_seccion=null){
		$prioridad_max=$this->General_model->maximo('super_seccion','prioridad');
		if(isset($id_super_seccion)){
			$super_seccion=$this->Seccion_model->get_super_seccion($this->Usuario_model->get_usuario_idioma($this->ion_auth->user()->row()->id)->id_idioma, $id_super_seccion);
			if (count($super_seccion)==0){
				redirect('errors/error_404');
			}else{
				foreach($this->Idioma_model->get_idiomas_subidos_activos() as $idioma){
					$super_secciones[$idioma->id_idioma] = $this->Seccion_model->get_super_seccion($idioma->id_idioma, $super_seccion->id);
				}
				$nuevo=false;
				$title = array('title'=>$this->lang->line('cms_c_crear_grupo_secciones'));
			}
		}else{
			$nuevo=true;
			$title = array('title'=>$this->lang->line('cms_c_editar_grupo_secciones'));
		}
			
		$config=array(
				'nombre'=>$this->lang->line('cms_c_crear_grupo_secciones_nombre'),
				'editando'=>isset($super_seccion->nombre) ? $super_seccion->nombre : '',
				'nuevo'=>$nuevo,
				'view'=>'formulario/crear',
				'model_update'=>array(
						'model'=>'General_model',
						'method'=>'update',
						'table'=>'super_seccion',
						'where'=>array(
								'id'=>isset($super_seccion->id) ? $super_seccion->id : '',
						),
				),
				'model_insert'=>array(
						'model'=>'General_model',
						'method'=>'insert',
						'table'=>'super_seccion',
						'extra'=>''
				),
				'model_update_idiomas'=>array(
						'model'=>'General_model',
						'method'=>'update',
						'table'=>'super_seccion_idiomas',
						'where'=>array(
								'id_super_seccion'=>isset($super_seccion->id) ? $super_seccion->id : '',
						),
				),
				'model_insert_idiomas'=>array(
						'model'=>'General_model',
						'method'=>'insert',
						'table'=>'super_seccion_idiomas',
						'enlace'=>'id_super_seccion'
				),
				'redirect'=>'cms-listar-super-secciones',
		);
		$config = array_merge($config, $title);
		//array para formularios
		$inputs=array(
				//Caso 1: input normal
				'1'=>array(
						'form_group'=>array(
								'name'=>'nombre', //name = nombre del campo en la base de datos
								'id'=>'nombre',
								'value'=> set_value('nombre',isset($super_seccion->nombre) ? $super_seccion->nombre : ''),
								'class'=>'form-control',
								'placeholder'=>$this->lang->line('cms_nombre_grupo_secciones_placeholder'),
						),
						'val_req' => '1',
						'fijo' => '0',
						'label'=>$this->lang->line('cms_nombre_grupo_secciones'),
						'help'=>form_error('nombre'),
						'label_class'=>'control-label pull-right', //Clases de la label del intput
						'class'=>'col-md-10', //Clases
						'type'=>'input',
						'form_validation'=>'trim|xss_clean|max_length[20]',
				),
				//Tipo checkbox
				'9'=>array(
						'form_group'=>array(
								'name'=>'footer', //name = nombre del campo en la base de datos
								'id'=>'footer',
								'class'=>'form-control',
								'value' => '1',
								'checked'=> ((isset($super_seccion->footer) && $super_seccion->footer == 1) ? 'si' : 'no'),
						),
						'val_req' => '0',
						'fijo' => '1',
						'label'=>$this->lang->line('cms_visible_footer'),
						'help'=>form_error('footer'),
						'label_class'=>'control-label pull-right', //Clases de la label del intput
						'class'=>'col-md-10', //Clases
						'type'=>'checkbox',
						'form_validation'=>'trim|xss_clean|integer',
				)
		);
	
		if(!$id_super_seccion){
			//Caso 4: oculto
			$array = array(array(
					'form_group'=>array(
							'name'=>'prioridad', //name = nombre del campo en la base de datos
							'id'=>'prioridad',
							'value'=> ($prioridad_max->prioridad + 1),
							'class'=>'form-control',
					),
					'val_req' => '0',
					'fijo' => '1',
					'label'=>$this->lang->line('cms_prioridad'),
					'type'=>'hidden',
					'form_validation'=>'trim|xss_clean|integer',
			));
			$inputs = array_merge($inputs, $array);
			$this->crear($inputs,$config);
		}else{
			$this->crear($inputs,$config, $super_secciones);
		}
	}
	
	function borrar_super_seccion($id_super_seccion){
		//borramos los secciones
		$secciones=$this->Seccion_model->listar_secciones($this->Usuario_model->get_usuario_idioma($this->ion_auth->user()->row()->id)->id_idioma, $id_super_seccion);
		if(count($secciones)!=0){
			foreach($secciones as $sec){
				$this->borrar_seccion($sec->url_seo, 'superseccion');
			}
		}
		//Eliminamos la sección
		foreach($this->Idioma_model->get_idiomas_subidos_activos() as $idioma){
			$this->General_model->delete('super_seccion_idiomas',array('id_super_seccion'=>$id_super_seccion, 'id_idioma'=>$idioma->id_idioma));
		}
				
		//Eliminamos la sección
		$this->General_model->delete('super_seccion',array('id'=>$id_super_seccion));
		redirect('cms-listar-super-secciones');
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/seccion.php */
