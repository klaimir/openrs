<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Seccion extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('cookie');
		$this->load->library('cadenas');
		$this->load->library('form_validation');
		$this->load->model('seccion_model');
		$this->load->model('bloque_model');
		$this->load->model('carrusel_model');
		$this->load->model('user_model');
		$this->load->model('general_model');
	}
	
	//Método para la portada: diferente en cada tienda, para que la portada sea original
	function index()
	{	
		$data = $this->inicializar(1, $this->lang->line('home'));
		$data['bloques']=$this->bloque_model->get_bloques(1,$data['idioma_actual']->id_idioma, $data['seccion']->id);
		foreach ($data['bloques'] as $k=>$v){
			if($v->id_tipo_bloque==1 || $v->id_tipo_bloque==4){ //bloque de texto
				$data['bloques'][$k]->texto=$this->bloque_model->get_contenido($v->id_bloque,"texto", $data['idioma_actual']->id_idioma);
			}elseif($v->id_tipo_bloque==2){ //bloque carrusel
			$carrusel=$this->bloque_model->get_contenido($v->id_bloque,"carrusel", $data['idioma_actual']->id_idioma);
				$data['bloques'][$k]->carrusel_general=$carrusel;
				$data['bloques'][$k]->carrusel=$this->bloque_model->get_carrusel($carrusel->id, $data['idioma_actual']->id_idioma);
				$data['bloques'][$k]->categorias=$this->carrusel_model->get_categorias_carrusel($data['idioma_actual']->id_idioma, $carrusel->id);
				switch ($data['bloques'][$k]->carrusel_general->columnas){
					case 2:
						$data['col_md']='col-md-6';
						break;
					case 3:
						$data['col_md']='col-md-4';
						break;
					case 4:
						$data['col_md']='col-md-3';
						break;
					case 6:
						$data['col_md']='col-md-2';
						break;
					default:
						$data['col_md']='col-md-2';
						break;
				}
			}
		}
		
		$this->template->write_view('header','templates/header',$data);
		$this->template->write_view('content_center','seccion/seccion',$data);
		$this->template->write_view('footer','templates/footer',$data);
		$this->template->render();
	}
	
	function inicializar($seccion, $titulo=NULL){
		$data['cargar_idiomas'] = $this->idioma_model->get_idiomas_subidos_activos();
		if($this->simple_sessions->es_usuario() || $this->simple_sessions->es_cliente() || $this->simple_sessions->es_admin())
			$data['idioma_actual'] = $this->user_model->get_usuario_idioma($this->simple_sessions->get_value('id_usuario'));
		else
			$data['idioma_actual'] = $this->idioma_model->get_id_idioma_by_nombre($this->uri->segment('1'));
		$data['config']=$this->general_model->get_config();
		$data['categorias_principales']=$this->producto_model->get_categorias_principales($data['idioma_actual']->id_idioma);
		$data['secciones_header']=$this->seccion_model->get_secciones_header($data['idioma_actual']->id_idioma);
		$data['subsecciones_header']=$this->seccion_model->get_subsecciones_header($data['idioma_actual']->id_idioma);
		
		$data['cols_pie']=$this->user_model->get_columnas_pie();
		if(count($data['cols_pie'])){
			$data['span']=12/count($data['cols_pie']);
		}else{
			$data['span']=2;
		}
		$cont=0;
		foreach($data['cols_pie'] as $col){
			$cont++;
			if($col->id_opc == 1)
				$data['menu_footer']=$this->seccion_model->get_secciones_footer($data['idioma_actual']->id_idioma);
			elseif($col->id_opc == 2)
				$data['articulos_footer']=$this->articulo_model->ultimos_articulos($data['idioma_actual']->id_idioma, $col->num_articulos);
			elseif($col->id_opc == 4)
				$data['codigo'.$cont]=$this->user_model->get_codigo_pie($col->id, $data['idioma_actual']->id_idioma);
		}
		$data['seccion']=$this->seccion_model->get_seccion($data['idioma_actual']->id_idioma,$seccion);
		if (count($data['seccion'])==0){
			redirect('errors/error_404');
		}
		if($titulo != NULL){
			$data['title']=$titulo;
		}else{
			$data['title']=$data['seccion']->titulo_seo;
		}
		$data['meta_description']=$data['seccion']->descripcion_seo;
		$data['meta_keywords']=$data['seccion']->keyword_seo;
		
		return $data;
	}
}
