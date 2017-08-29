<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Seccion_model');
		$this->load->model('Usuario_model');
 		$this->load->library('form_validation');
                $this->load->library('ion_auth');
		$this->load->model('Articulo_model');
		$this->load->model('Etiqueta_model');
		$this->load->model('Voto_model');
		$this->load->model('Articulo_Etiqueta_model');
 		$this->load->model('Comentario_model');
 		$this->load->model('General_model');
                $this->load->model('Idioma_model');
                
                // Secure the access
                $this->_security();

                // Comprobación de acceso
                $this->utilities->check_security_access_perfiles_or(array("session_es_admin"));
                
                // Sección activa
                $this->data['_active_section']="noticias";
	}

// 	function index()
// 	{
// 		redirect('blog/articulos');
// 	}
	
	function inicializar_con_logeo($seccion, $titulo, $tit = NULL, $meta_descripcion = NULL){
	
		$this->data['cargar_idiomas'] = $this->Idioma_model->get_idiomas_subidos_activos();
		$this->data['idioma_actual'] = $this->Usuario_model->get_usuario_idioma($this->ion_auth->user()->row()->id);
		$this->data['config']=$this->General_model->get_config();
		$this->data['title']= $titulo.' - '.$this->data['config']->nombre;
		if($tit)
			$this->data['tit'] = $tit;
		if($meta_descripcion)
			$this->data['meta_description']=$meta_descripcion;
		$this->data['secciones'] = $this->Seccion_model->get_secciones($this->data['idioma_actual']->id_idioma);
		$this->data['sec'] = $seccion;
		return $this->data;
	}
	
	function listar_articulos($estado = NULL){
		$this->data = $this->inicializar_con_logeo(-3, $this->lang->line('blog_c_ver_articulos'), $this->lang->line('blog_c_blog'));

		//Datos recibidos
		if($estado == NULL)
			$id_estado = 1;	
		$this->data['articulos'] = $this->Articulo_model->get_articulos($this->ion_auth->user()->row()->id, $estado, $this->data['idioma_actual']->id_idioma);
		foreach ($this->data['articulos'] as $k=>$v){
			$this->data['articulos'][$k]->categorias = $this->Articulo_model->get_categorias_articulo($v->id_articulo, $this->data['idioma_actual']->id_idioma);
			$this->data['articulos'][$k]->etiquetas = $this->Etiqueta_model->get_etiquetas_articulo($v->id_articulo, $this->data['idioma_actual']->id_idioma);
			$this->data['articulos'][$k]->num_votos = count($this->Voto_model->get_many_by($v->id_articulo));
		}
		$this->render_private('blog/listar_articulos_view', $this->data);		

	}
	
	function listar_categorias(){
		$this->data = $this->inicializar_con_logeo(-3, $this->lang->line('blog_c_ver_categorias'), $this->lang->line('blog_c_blog'));
		$this->data['categorias'] = $this->Articulo_model->get_categorias($this->ion_auth->user()->row()->id, $this->data['idioma_actual']->id_idioma);
	
                $this->render_private('blog/listar_categorias_view', $this->data);
	
	}
	
	function crear_categoria(){
		$this->data = $this->inicializar_con_logeo(-3, $this->lang->line('blog_c_crear_articulo'));
		$this->data['max_prioridad_seccion'] = $this->General_model->maximo('seccion','prioridad');
		$conf = $this->General_model->get_config($this->ion_auth->user()->row()->id);
		if($this->input->post()){
			$this->form_validation->set_rules('nombre_'.$conf->idioma_defecto,$this->lang->line('blog_nombre_categoria'),'trim|xss_clean|required|max_length[50]');
			$this->form_validation->set_rules('url_seo_'.$conf->idioma_defecto,$this->lang->line('blog_url_seo'),'trim|xss_clean|required|max_length[50]|callback_url_seo_valida|alpha_dash');
			$idiomas = $this->input->post('idiomas');
			foreach($idiomas as $idioma){
				if($idioma != $conf->idioma_defecto)
					$this->form_validation->set_rules('url_seo_'.$idioma,$this->lang->line('blog_url_seo'),'trim|xss_clean|max_length[50]|callback_url_seo_valida|alpha_dash');
			}
			$this->form_validation->set_message('required',$this->lang->line('login_c_required'));
			$this->form_validation->set_message('max_length',$this->lang->line('login_c_max_length'));
			$this->form_validation->set_message('alpha_dash',$this->lang->line('login_c_alpha_dash'));
			$this->form_validation->set_message('url_seo_valida_categorias',$this->lang->line('login_c_url_seo_valida'));
			
			if ($this->form_validation->run()){	//Todo OK
				/*$categoria_data = array(
						'creada'=>date("Y-m-d H:i:s"),
						'modificada'=>date("Y-m-d H:i:s"),
						'id_creador'=> $this->simple_sessions->get_value('id_usuario')
				);
				$id_categoria = $this->Articulo_model->insert_categoria($categoria_data);
				$datos_categoria = array(
						'categoria'=>$this->input->post('nombre_'.$conf->idioma_defecto),
						'id_idioma'=>$conf->idioma_defecto,
						'id_categoria'=>$id_categoria,
						'url_seo_categoria_blog' => $this->input->post('url_seo_'.$conf->idioma_defecto)
				);
				$this->Articulo_model->insertar_idioma_categoria($datos_categoria);
				
				//Eliminar idioma por defecto puesto que ya se ha introducido.
				while ($idioma = current($idiomas)) {
					if ($idioma == $conf->idioma_defecto) {
						unset($idiomas[key($idiomas)]);
					}
					next($idiomas);
				}*/
				$cont=0;
				foreach($idiomas as $idioma){
					if(!$this->input->post('url_seo_'.$idioma)){
						$url_seo = $this->input->post('url_seo_'.$conf->idioma_defecto).'_'.$idioma;
					}else{
						$url_seo = $this->input->post('url_seo_'.$idioma);
					}
					if($cont == 0){
						$categoria_data = array(
								'creada'=>date("Y-m-d H:i:s"),
								'modificada'=>date("Y-m-d H:i:s"),
								'id_creador'=> $this->ion_auth->user()->row()->id
						);
						$id_categoria = $this->Articulo_model->insert_categoria($categoria_data);
					}
					$datos_categoria = array(
							'categoria'=>$this->input->post('nombre_'.$idioma),
							'id_idioma'=>$idioma,
							'id_categoria'=>$id_categoria,
							'url_seo_categoria_blog' => $this->input->post('url_seo_'.$idioma)
					);
					$this->Articulo_model->insertar_idioma_categoria($datos_categoria);
					$cont++;
				}
				redirect('blog/listar_categorias');
			}
		}
                $this->render_private('blog/crear_categoria_view', $this->data);
	}
	
	function editar_categoria($id_categoria = NULL){
		$this->data = $this->inicializar_con_logeo(-3, $this->lang->line('blog_c_editar_categoria'), $this->lang->line('blog_c_blog'));
	
		if($id_categoria == NULL){
			redirect('blog/listar_categorias', 'refresh');
		}else{
			$categoria = $this->Articulo_model->getc($id_categoria);
			if(count($categoria) == 0){
				redirect('error/error_404');
			}else{
				$this->data['id_categoria'] = $categoria->id;
				foreach($this->data['cargar_idiomas'] as $idioma){
					$this->data['categoria'][$idioma->id_idioma] = $this->Articulo_model->getc($id_categoria, $idioma->id_idioma);
				}
			}
		}
		if($this->input->post()){
			$conf = $this->General_model->get_config($this->ion_auth->user()->row()->id);
			$this->form_validation->set_rules('nombre_'.$conf->idioma_defecto,$this->lang->line('blog_nombre_categoria'),'trim|xss_clean|required|max_length[50]');
			$this->form_validation->set_rules('url_seo_'.$conf->idioma_defecto,$this->lang->line('blog_url_seo'),'trim|xss_clean|required|max_length[50]|callback_url_seo_valida|alpha_dash');
			$idiomas = $this->input->post('idiomas');
			foreach($idiomas as $idioma){
				if($idioma != $conf->idioma_defecto)
					$this->form_validation->set_rules('url_seo_'.$idioma,$this->lang->line('blog_url_seo'),'trim|xss_clean|max_length[50]|callback_url_seo_valida|alpha_dash');
			}
			$this->form_validation->set_message('required',$this->lang->line('login_c_required'));
			$this->form_validation->set_message('max_length',$this->lang->line('login_c_max_length'));
			$this->form_validation->set_message('alpha_dash',$this->lang->line('login_c_alpha_dash'));
			$this->form_validation->set_message('url_seo_valida_categorias',$this->lang->line('login_c_url_seo_valida'));
			if ($this->form_validation->run()){
				$primera = TRUE;
				$categoria_data = array(
						'modificada'=>date("Y-m-d H:i:s")
				);
				$this->Articulo_model->update_categoria($id_categoria, $categoria_data);
				foreach($idiomas as $idioma){
					if(!$this->input->post('url_seo_'.$idioma)){
						$url_seo = $this->input->post('url_seo_'.$conf->idioma_defecto).'_'.$idioma;
					}else{
						$url_seo = $this->input->post('url_seo_'.$idioma);
					}
					$datos_categoria = array(
							'categoria'=>$this->input->post('nombre_'.$idioma),
							'id_idioma'=>$idioma,
							'id_categoria'=>$id_categoria,
							'url_seo_categoria_blog' => $this->input->post('url_seo_'.$idioma)
					);
					$this->Articulo_model->update_categoria_idioma($id_categoria, $idioma, $datos_categoria);
				}
				redirect('blog/listar_categorias');
			}
		}
                $this->render_private('blog/crear_categoria_view', $this->data);
		
	}
	
	function url_seo_valida_categorias($url_seo){
		if($this->Articulo_model->existe_url_seo_categorias($url_seo)){
			return FALSE;
		}else{
			return TRUE;
		}
	}
	
	function eliminar_categoria($id_categoria = NULL){
		if($id_categoria == NULL){
			redirect('blog/listar_categorias');
		}else{
			$categoria = $this->Articulo_model->getc($id_categoria);
			if(count($categoria) == 0){
				redirect('blog/listar_categorias');
			}else{
				$this->Articulo_model->eliminar_categoria($id_categoria);
				redirect('blog/listar_categorias');
			}
		}
	}
	
	function url_seo_valida($url_seo){
		if($this->Articulo_model->existe_url_seo($url_seo)){
			return FALSE;
		}else{
			return TRUE;
		}
	}
	
	function crear_articulo(){
		$this->data = $this->inicializar_con_logeo(-3, $this->lang->line('blog_c_crear_articulo'));
		$this->data['max_prioridad_seccion'] = $this->General_model->maximo('seccion','prioridad');
		$conf = $this->General_model->get_config($this->ion_auth->user()->row()->id);
		$this->data['categorias'][$conf->idioma_defecto]=$this->Articulo_model->get_categorias($conf->idioma_defecto);
		if($this->input->post()){
			$this->form_validation->set_rules('titulo_'.$conf->idioma_defecto,$this->lang->line('blog_titulo'),'trim|xss_clean|required|max_length[200]');
			$this->form_validation->set_rules('contenido_'.$conf->idioma_defecto,$this->lang->line('blog_contenido'),'trim|xss_clean|required');
			$this->form_validation->set_rules('descripcion_'.$conf->idioma_defecto,$this->lang->line('blog_descripcion_corta'),'trim|xss_clean|required|max_length[500]');
			$this->form_validation->set_rules('url_seo_'.$conf->idioma_defecto,$this->lang->line('blog_url_seo'),'trim|xss_clean|required|max_length[100]|callback_url_seo_valida|alpha_dash');
			$idiomas = $this->input->post('idiomas');
			foreach($idiomas as $idioma){
				if($idioma != $conf->idioma_defecto)
					$this->form_validation->set_rules('url_seo_'.$idioma,$this->lang->line('blog_url_seo'),'trim|xss_clean|max_length[100]|callback_url_seo_valida|alpha_dash');
			}
			$this->form_validation->set_message('required',$this->lang->line('login_c_required'));
			$this->form_validation->set_message('max_length',$this->lang->line('login_c_max_length'));
			$this->form_validation->set_message('alpha_dash',$this->lang->line('login_c_alpha_dash'));
			$this->form_validation->set_message('url_seo_valida',$this->lang->line('login_c_url_seo_valida'));
			
			if ($this->form_validation->run()){	//Todo OK
				//Cargar datos de artículos comunes a borrador y publicado
				foreach($idiomas as $idioma){
					//ESTO PARA VARIOS BLOGS CON UN ÚNICO ADMINISTRADOR
					/*if(!file_exists('uploads/general/img/blog/'.$this->simple_sessions->get_value('id_usuario').'/'.$idioma))
						mkdir('uploads/general/img/blog/'.$this->simple_sessions->get_value('id_usuario').'/'.$idioma, '0755', true);
					if(!file_exists('uploads/general/img/blogmini/'.$this->simple_sessions->get_value('id_usuario').'/'.$idioma))
						mkdir('uploads/general/img/blogmini/'.$this->simple_sessions->get_value('id_usuario').'/'.$idioma, '0755', true);*/
				}
				if (isset($_FILES['userfile_'.$conf->idioma_defecto]['tmp_name'])) {
					//ESTO PARA VARIOS BLOGS CON UN ÚNICO ADMINISTRADOR
					//$config['upload_path'] = 'uploads/general/img/blog/'.$this->simple_sessions->get_value('id_usuario').'/'.$conf->idioma_defecto.'/';
					$config['upload_path'] = 'uploads/general/img/blog/1/'.$conf->idioma_defecto.'/';
					$config['allowed_types']='gif|jpg|jpeg|png';
					$config['max_size']	= '2000';
					$config['overwrite']=FALSE;
					//$config['encrypt_name'] = TRUE;
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('userfile_'.$conf->idioma_defecto)) {
						$this->data['error']='error';
						//echo $this->upload->display_errors();exit();
					}else{
						$articulo_data = array(
							'creado'=>date("Y-m-d H:i:s"),
							'modificado'=>date("Y-m-d H:i:s"),
							'id_autor'=> $this->ion_auth->user()->row()->id
						);
						$id_articulo = $this->Articulo_model->insertArticulo($articulo_data);
						$datos_articulo = array(
							'titulo'=>$this->input->post('titulo_'.$conf->idioma_defecto),
							'contenido'=>$this->input->post('contenido_'.$conf->idioma_defecto),
							'descripcion'=>$this->input->post('descripcion_'.$conf->idioma_defecto),
							'id_idioma'=>$conf->idioma_defecto,
							'id_articulo'=>$id_articulo,
							'url_seo_articulo' => $this->input->post('url_seo_'.$conf->idioma_defecto)
						);
						$file_data = $this->upload->data();
						$datos_articulo['img_articulo'] = $file_data['file_name'];
						//Ahora creamos una copia de la imagen a tamaño 30*30
						$this->load->library('image_lib');
						$config['image_library']='gd2';
						//ESTO PARA VARIOS BLOGS CON UN ÚNICO ADMINISTRADOR
						/*$config['source_image']='uploads/general/img/blog/'.$this->simple_sessions->get_value('id_usuario').'/'.$conf->idioma_defecto.'/'.$file_data['file_name'];
						$config['new_image']='uploads/general/img/blogmini/'.$this->simple_sessions->get_value('id_usuario').'/'.$conf->idioma_defecto.'/';*/
						$config['source_image']='uploads/general/img/blog/1/'.$conf->idioma_defecto.'/'.$file_data['file_name'];
						$config['new_image']='uploads/general/img/blogmini/1/'.$conf->idioma_defecto.'/';
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = TRUE;
						$config['width'] = 120;
						$config['height'] = 80;
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
			
						$datos_articulo['img_articulo_mini'] = $file_data['raw_name'].'_thumb'.$file_data['file_ext'];
						$this->image_lib->resize();
						$this->Articulo_model->insertar_idioma($datos_articulo);
						if(isset($_POST["campoCategorias"])){
							foreach($_POST["campoCategorias"] as $valorCheckbox){
								$datos_cat = array(
										'id_articulo'=>$id_articulo,
										'id_categoria'=>$valorCheckbox
								);
								$this->Articulo_model->insert_categoria_articulo($datos_cat);
							}
						}
						if($this->input->post('publicar')){		//Si se ha elegido publicar
							$articulo_data['id_estado'] = '1';
						}elseif($this->input->post('borrador')){
							$articulo_data['id_estado'] = '3';
						}
						$this->Articulo_model->updateById($id_articulo, $articulo_data);
						//Todas las etiquetas almacenadas en la base de datos
						$etiquetas_bd = $this->Etiqueta_model->get_all_etiquetas($conf->idioma_defecto);
						//Una vez insertado el artículo se añaden las etiquetas
						$etiq_array = array();
						$etiq_array = explode(';', $this->input->post('todas_etiquetas_'.$conf->idioma_defecto));
						foreach($etiq_array as $k=>$v){
							if($v != ''){ //Para eliminar el último elemento vacío
								//Ahora compruebo si existe la etiqueta en la base de datos
								//Recorro todas las etiquetas de la base de datos y si encuentro alguna igual es que existe
								$etiq_existe = FALSE;
								foreach($etiquetas_bd as $etiq_bd){
									if($v == $etiq_bd->etiqueta){
										$etiq_existe = TRUE;
										$id_etiqueta = $etiq_bd->id;
									}
								}
								//Si existe la etiqueta la id_etiqueta será la correspondiente a dicha etiqueta
								if($etiq_existe == FALSE){
									$id_etiqueta = $this->Etiqueta_model->insertEtiqueta(array('etiqueta'=>$v,'id_idioma'=>$conf->idioma_defecto));
								}
								//Inserto los datos de la relación entre el artículo y sus etiquetas
								$art_etiq_data = array(
									'id_etiqueta' => $id_etiqueta,
									'id_articulo' => $id_articulo
								);
								$this->Articulo_Etiqueta_model->insertArtEtiqueta($art_etiq_data);
							}
						}
						
						//Eliminar idioma por defecto puesto que ya se ha introducido.
						while ($idioma = current($idiomas)) {
							if ($idioma == $conf->idioma_defecto) {
								unset($idiomas[key($idiomas)]);
							}
							next($idiomas);
						}
						foreach($idiomas as $idioma){
							if(!$this->input->post('url_seo_'.$idioma)){
								$url_seo = $this->input->post('url_seo_'.$conf->idioma_defecto).'_'.$idioma;
							}else{
								$url_seo = $this->input->post('url_seo_'.$idioma);
							}
							$datos_articulo = array(
									'titulo'=>$this->input->post('titulo_'.$idioma),
									'contenido'=>$this->input->post('contenido_'.$idioma),
									'descripcion'=>$this->input->post('descripcion_'.$idioma),
									'id_idioma'=>$idioma,
									'id_articulo'=>$id_articulo,
									'url_seo_articulo'=>$url_seo
							);
							if (isset($_FILES['userfile_'.$idioma]['tmp_name'])) {
								//ESTO PARA VARIOS BLOGS CON UN ÚNICO ADMINISTRADOR
								//$config['upload_path'] = 'uploads/general/img/blog/'.$this->simple_sessions->get_value('id_usuario').'/'.$idioma.'/';
								$config['upload_path'] = 'uploads/general/img/blog/1/'.$idioma.'/';
								$config['allowed_types']='gif|jpg|jpeg|png';
								$config['max_size']	= '2000';
								$config['overwrite']=FALSE;
								//$config['encrypt_name'] = TRUE;
								$this->upload->initialize($config);
								if (!$this->upload->do_upload('userfile_'.$idioma)) {
									$this->data['error']='error';
								}else{
									$file_data = $this->upload->data();
									$datos_articulo['img_articulo'] = $file_data['file_name'];
									//Ahora creamos una copia de la imagen a tamaño 30*30
									$this->load->library('image_lib');
									$config['image_library']='gd2';
									//ESTO PARA VARIOS BLOGS CON UN ÚNICO ADMINISTRADOR
									/*$config['source_image']='uploads/general/img/blog/'.$this->simple_sessions->get_value('id_usuario').'/'.$idioma.'/'.$file_data['file_name'];
									$config['new_image']='uploads/general/img/blogmini/'.$this->simple_sessions->get_value('id_usuario').'/'.$idioma.'/';*/
									$config['source_image']='uploads/general/img/blog/1/'.$idioma.'/'.$file_data['file_name'];
									$config['new_image']='uploads/general/img/blogmini/1/'.$idioma.'/';
									$config['create_thumb'] = TRUE;
									$config['maintain_ratio'] = TRUE;
									$config['width'] = 120;
									$config['height'] = 80;
									$this->image_lib->clear();
									$this->image_lib->initialize($config);
									
									$datos_articulo['img_articulo_mini'] = $file_data['raw_name'].'_thumb'.$file_data['file_ext'];
									$this->image_lib->resize();
								}
							}
							$this->Articulo_model->insertar_idioma($datos_articulo);
							//Todas las etiquetas almacenadas en la base de datos
							$etiquetas_bd = $this->Etiqueta_model->get_all_etiquetas($idioma);
							//Una vez insertado el artículo se añaden las etiquetas
							$etiq_array = array();
							$etiq_array = explode(';', $this->input->post('todas_etiquetas_'.$idioma));
							foreach($etiq_array as $k=>$v){
								if($v != ''){ //Para eliminar el último elemento vacío
									//Ahora compruebo si existe la etiqueta en la base de datos
									//Recorro todas las etiquetas de la base de datos y si encuentro alguna igual es que existe
									$etiq_existe = FALSE;
									foreach($etiquetas_bd as $etiq_bd){
										if($v == $etiq_bd->etiqueta){
											$etiq_existe = TRUE;
											$id_etiqueta = $etiq_bd->id;
										}
									}
									//Si existe la etiqueta la id_etiqueta será la correspondiente a dicha etiqueta
									if($etiq_existe == FALSE){
										$id_etiqueta = $this->Etiqueta_model->insertEtiqueta(array('etiqueta'=>$v,'id_idioma'=>$idioma));
									}
									//Inserto los datos de la relación entre el artículo y sus etiquetas
									$art_etiq_data = array(
											'id_etiqueta' => $id_etiqueta,
											'id_articulo' => $id_articulo
									);
									$this->Articulo_Etiqueta_model->insertArtEtiqueta($art_etiq_data);
								}
							}
						}
						redirect('blog/listar_articulos');
					}
				}else{
					$this->data['error']='no_image';
				}
			}
		}
                $this->render_private('blog/crear_articulo_view', $this->data);
				
	}
	
	function url_seo_valida_editar($url_seo){
		if($this->Articulo_model->existe_url_seo($url_seo, $this->input->post('id_articulo'))){
			return FALSE;
		}else{
			return TRUE;
		}
	}
	
	function editar_articulo($id_articulo = NULL){
		$this->data = $this->inicializar_con_logeo(-3, $this->lang->line('blog_c_editar_articulo'), $this->lang->line('blog_c_blog'));
	
		if($id_articulo == NULL){
			redirect('blog/listar_articulos', 'refresh');
		}else{
			$articulo = $this->Articulo_model->getById($id_articulo);
			if(count($articulo) == 0){
				redirect('error/error_404');
			}else{	
				$this->data['id_articulo'] = $articulo->id;
				foreach($this->data['cargar_idiomas'] as $idioma){
					$this->data['articulo'][$idioma->id_idioma] = $this->Articulo_model->getById($id_articulo, $idioma->id_idioma);
					$this->data['etiquetas'][$idioma->id_idioma] = $this->Etiqueta_model->get_etiquetas_articulo($id_articulo, $idioma->id_idioma);
					$this->data['categorias'][$idioma->id_idioma]=$this->Articulo_model->get_categorias($idioma->id_idioma);
				}	
			}
		}	
		if($this->input->post()){
			$conf = $this->General_model->get_config($this->ion_auth->user()->row()->id);
			$this->form_validation->set_rules('titulo_'.$conf->idioma_defecto,$this->lang->line('blog_titulo'),'trim|xss_clean|required|max_length[200]');
			$this->form_validation->set_rules('creado_'.$conf->idioma_defecto,$this->lang->line('blog_fecha_creacion'),'trim|xss_clean|required');
			$this->form_validation->set_rules('contenido_'.$conf->idioma_defecto,$this->lang->line('blog_contenido'),'trim|xss_clean|required');
			$this->form_validation->set_rules('descripcion_'.$conf->idioma_defecto,$this->lang->line('blog_descripcion_corta'),'trim|xss_clean|required|max_length[500]');
			$this->form_validation->set_rules('url_seo_'.$conf->idioma_defecto,$this->lang->line('blog_url_seo'),'trim|xss_clean|required|max_length[100]|callback_url_seo_valida_editar|alpha_dash');
			$idiomas = $this->input->post('idiomas');
			foreach($idiomas as $idioma){
				if($idioma != $conf->idioma_defecto)
					$this->form_validation->set_rules('url_seo_'.$idioma,$this->lang->line('blog_url_seo'),'trim|xss_clean|max_length[100]|callback_url_seo_valida_editar|alpha_dash');
			}		
			$this->form_validation->set_message('required',$this->lang->line('login_c_required'));
			$this->form_validation->set_message('max_length',$this->lang->line('login_c_max_length'));
			$this->form_validation->set_message('alpha_dash',$this->lang->line('login_c_alpha_dash'));
			$this->form_validation->set_message('url_seo_valida_editar',$this->lang->line('login_c_url_seo_valida'));
									
			if ($this->form_validation->run()){
				$primera = TRUE;
				$articulo_data = array(
						'modificado'=>date("Y-m-d H:i:s")
				);
				if($this->input->post('publicar')){		//Si se ha elegido publicar
					$articulo_data['id_estado'] = '1';
				}
				else if($this->input->post('borrador')){
					$articulo_data['id_estado'] = '3';
				}
				$this->Articulo_model->updateById($id_articulo, $articulo_data);
				//Actualizamos categorias
				//1º borramos todas
				$this->Articulo_model->borrar_categorias_articulo($id_articulo);
				//2º insertamos las chequeadas
				if(isset($_POST["campoCategorias"])){
					foreach($_POST["campoCategorias"] as $valorCheckbox){
						$datos_cat = array(
								'id_articulo'=>$id_articulo,
								'id_categoria'=>$valorCheckbox
						);
						$this->Articulo_model->insert_categoria_articulo($datos_cat);
					}
				}
				foreach($idiomas as $idioma){
					//ESTO PARA VARIOS BLOGS CON UN ÚNICO ADMINISTRADOR
					/*if(!file_exists('uploads/general/img/blog/'.$this->simple_sessions->get_value('id_usuario').'/'.$idioma))
						mkdir('uploads/general/img/blog/'.$this->simple_sessions->get_value('id_usuario').'/'.$idioma, '0755', true);
					if(!file_exists('uploads/general/img/blogmini/'.$this->simple_sessions->get_value('id_usuario').'/'.$idioma))
						mkdir('uploads/general/img/blogmini/'.$this->simple_sessions->get_value('id_usuario').'/'.$idioma, '0755', true);*/
				
					if($this->input->post('change_logo_'.$idioma)){
						if (isset($_FILES['userfile_'.$idioma]['tmp_name'])) {
							if(isset($this->data['articulo'][$idioma]->img_articulo) && file_exists('uploads/general/img/blog/1/'.$idioma.'/'.$this->data['articulo'][$idioma]->img_articulo))
								unlink('uploads/general/img/blog/1/'.$idioma.'/'.$this->data['articulo'][$idioma]->img_articulo);
							if(isset($this->data['articulo'][$idioma]->img_articulo_mini) && file_exists('uploads/general/img/blogmini/1/'.$idioma.'/'.$this->data['articulo'][$idioma]->img_articulo_mini))
								unlink('uploads/general/img/blogmini/1/'.$idioma.'/'.$this->data['articulo'][$idioma]->img_articulo_mini);
							//ESTO PARA VARIOS BLOGS CON UN ÚNICO ADMINISTRADOR
							//$config['upload_path'] = 'uploads/general/img/blog/'.$this->simple_sessions->get_value('id_usuario').'/'.$idioma.'/';
							$config['upload_path'] = 'uploads/general/img/blog/1/'.$idioma.'/';
							$config['allowed_types']='gif|jpg|jpeg|png';
							$config['max_size']	= '2000';
							$config['overwrite']=FALSE;
							//$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							if (!$this->upload->do_upload('userfile_'.$idioma)) {
								$this->data['error']='error';
							}else{
								$file_data = $this->upload->data();
								$datos_articulo['img_articulo'] = $file_data['file_name'];
								//Ahora creamos una copia de la imagen a tamaño 30*30
								$this->load->library('image_lib');
								$config['image_library']='gd2';
								//ESTO PARA VARIOS BLOGS CON UN ÚNICO ADMINISTRADOR
								/*$config['source_image']='uploads/general/img/blog/'.$this->simple_sessions->get_value('id_usuario').'/'.$idioma.'/'.$file_data['file_name'];
								$config['new_image']='uploads/general/img/blogmini/'.$this->simple_sessions->get_value('id_usuario').'/'.$idioma.'/';*/
								$config['source_image']='uploads/general/img/blog/1/'.$idioma.'/'.$file_data['file_name'];
								$config['new_image']='uploads/general/img/blogmini/1/'.$idioma.'/';
								$config['create_thumb'] = TRUE;
								$config['maintain_ratio'] = TRUE;
								$config['width'] = 120;
								$config['height'] = 80;
								$this->image_lib->clear();
								$this->image_lib->initialize($config);
								$datos_articulo['img_articulo_mini'] = $file_data['raw_name'].'_thumb'.$file_data['file_ext'];
								$this->image_lib->resize();
								$this->Articulo_model->update_idioma($id_articulo, $idioma, $datos_articulo);
							}
						}else{
							$this->data['error']='no_image';
						}
					}
					if(!isset($this->data['error'])){
						if(!$this->input->post('url_seo_'.$idioma)){
							$url_seo = $this->input->post('url_seo_'.$conf->idioma_defecto).'_'.$idioma;
						}else{
							$url_seo = $this->input->post('url_seo_'.$idioma);
						}
						$datos_articulo = array(
							'titulo'=>$this->input->post('titulo_'.$idioma),
							'contenido'=>$this->input->post('contenido_'.$idioma),
							'descripcion'=>$this->input->post('descripcion_'.$idioma),
							'url_seo_articulo'=>$url_seo
						);
						$fecha_creacion=array('creado'=>$this->input->post('creado_'.$idioma));
						$this->Articulo_model->updateById($id_articulo, $fecha_creacion);
						$this->Articulo_model->update_idioma($id_articulo, $idioma, $datos_articulo);
						if($primera){
							$this->Etiqueta_model->borrar_etiquetas_articulo($id_articulo);
							$primera = FALSE;
						}		
						//Todas las etiquetas almacenadas en la base de datos
						$etiquetas_bd = $this->Etiqueta_model->get_all_etiquetas($idioma);
								
						//Una vez insertado el artículo se añaden las etiquetas
						$etiq_array = array();
						$etiq_array = explode(';', $this->input->post('todas_etiquetas_'.$idioma));
						print_r($etiq_array);
						foreach($etiq_array as $k=>$v){
							if($v != ''){ //Para eliminar el último elemento vacío
								//Ahora compruebo si existe la etiqueta en la base de datos
								//Recorro todas las etiquetas de la base de datos y si encuentro alguna igual es que existe
								$etiq_existe = FALSE;
								foreach($etiquetas_bd as $etiq_bd){
									if($v == $etiq_bd->etiqueta){
										$etiq_existe = TRUE;
										$id_etiqueta = $etiq_bd->id;
									}
								}
								//Si existe la etiqueta la id_etiqueta será la correspondiente a dicha etiqueta
								if($etiq_existe == FALSE){
									$id_etiqueta = $this->Etiqueta_model->insertEtiqueta(array('etiqueta'=>$v, 'id_idioma'=>$idioma));
								}
								//Inserto los datos de la relación entre el artículo y sus etiquetas
								$art_etiq_data = array(
									'id_etiqueta' => $id_etiqueta,
									'id_articulo' => $id_articulo
								);
								$this->Articulo_Etiqueta_model->insertArtEtiqueta($art_etiq_data);									
							}
						}
					}	
				}
				if(!isset($this->data['error']))
					redirect('blog/listar_articulos');
			}			
		}
                $this->render_private('blog/crear_articulo_view', $this->data);
		
	}

	function eliminar_articulo($id_articulo = NULL){
		if($id_articulo == NULL){
			redirect('blog/listar_articulos');
		}else{
			$articulo = $this->Articulo_model->getById($id_articulo);
			if(count($articulo) == 0){
				redirect('blog/listar_articulos');
			}else{
				$this->Articulo_model->updateById($id_articulo, array('id_estado'=>2));
				redirect('blog/listar_articulos');
			}
		}
	}
	
	function recuperar_articulo($id_articulo = NULL){
		if($id_articulo == NULL){
			redirect('blog/listar_articulos');
		}else{
			$articulo = $this->Articulo_model->getById($id_articulo);
			if(count($articulo) == 0){
				redirect('blog/listar_articulos');
			}else{
				$this->Articulo_model->updateById($id_articulo, array('id_estado'=>3));
				redirect('blog/listar_articulos');
			}
		}
	}
	
// 	/*****************************************************************************************/
// 	/*									COMENTARIOS 										 */
// 	/*****************************************************************************************/
	
	function listar_comentarios($id_articulo = NULL, $message = NULL){
		$this->data = $this->inicializar_con_logeo(-3, $this->lang->line('blog_c_listar_comentarios'));
		$this->data['message'] = $message;
		if($id_articulo == NULL){
			redirect('blog/listar_articulos');
		}else{
			$this->data['articulo'] = $this->Articulo_model->getById($id_articulo);
			if(count($this->data['articulo']) == 0){
				redirect('blog/listar_articulos');
			}
		}
		//Quitamos la alerta de comentarios sin leer
		$this->Articulo_model->updateById($id_articulo, array('comentario'=>0));
		$this->data['comentarios'] = $this->Comentario_model->comentarios_articulo($id_articulo);
		
                $this->render_private('blog/listar_comentarios', $this->data);
		
	}
	
	function eliminar_comentario($id_comentario = NULL){
		if($id_comentario == NULL){
			redirect('blog/listar_articulos');
		} else {
			$comentario = $this->Comentario_model->get_comentario($id_comentario);
			if(count($comentario) == 0){
				redirect('blog/listar_articulos');
			} else {
				$this->Comentario_model->update_comentario($id_comentario, array('visible'=>0));
				redirect('blog/listar_comentarios/'.$comentario->id_articulo.'/exito');
			}
		}
	}
	
	function recuperar_comentario($id_comentario = NULL){
		if($id_comentario == NULL){
			redirect('blog/listar_articulos');
		} else {
			$comentario = $this->Comentario_model->get_comentario($id_comentario);
			if(count($comentario) == 0){
				redirect('blog/listar_articulos');
			} else {
				$this->Comentario_model->update_comentario($id_comentario, array('visible'=>1));
				redirect('blog/listar_comentarios/'.$comentario->id_articulo.'/exito');
			}
		}
	}
	
// 	function visualizar_feed(){
// 		$this->load->model('Articulo_model');
// 		$this->load->library('cadenas');
// 		$this->db->limit(15);
// 		$this->data['articulos'] = $this->Articulo_model->articulos_publicados();
// 		//url para link
// 		foreach($this->data['articulos'] as $k=>$v){
// 			//Una vez saneada se divide para eliminar sus espacios
// 			$url_titulo = $this->cadenas->_sanear_string($v->titulo);
// 			$url_array = array();
// 			$url_array = explode(' ', $url_titulo);
// 			$url = '';
// 			foreach($url_array as $url_a){
// 				$url = $url.''.$url_a.'-';
// 			}
// 			$url = substr($url, 0, -1);
// 			$this->data['articulos'][$k]->link = $url;
// 		}
		
// 		$this->load->view('blog/pymeticarss.php', $this->data);
// 	}
	
}

