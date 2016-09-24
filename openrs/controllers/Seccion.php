<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Controller_Front.php';

class Seccion extends MY_Controller_Front
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('cookie');
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->model('Seccion_model');
		$this->load->model('Bloque_model');
		$this->load->model('Usuarios_model');
		$this->load->model('General_model');
		$this->load->model('Idioma_model');
	}
	
	//Método para la portada: diferente en cada tienda, para que la portada sea original
	function index()
	{	
		$data = $this->inicializar(1, $this->lang->line('home'));
		$data['bloques']=$this->Bloque_model->get_bloques(1,$data['idioma_actual']->id_idioma, $data['seccion']->id);
		foreach ($data['bloques'] as $k=>$v){
			if($v->id_tipo_bloque==1 || $v->id_tipo_bloque==4){ //bloque de texto
				$data['bloques'][$k]->texto=$this->Bloque_model->get_contenido($v->id_bloque,"texto", $data['idioma_actual']->id_idioma);
			}
		}
		
		$this->template->write_view('header','public/templates/header',$data);
		$this->template->write_view('content_center','public/seccion',$data);
		$this->template->write_view('footer','public/templates/footer',$data);
		$this->template->render();
	}
	
	function inicializar($seccion, $titulo=NULL){
		$data['cargar_idiomas'] = $this->Idioma_model->get_idiomas_subidos_activos();
		if($this->ion_auth->logged_in())
			$data['idioma_actual'] = $this->Usuarios_model->get_usuario_idioma($this->ion_auth->user()->row()->id);
		else
			$data['idioma_actual'] = $this->Idioma_model->get_id_idioma_by_nombre($this->uri->segment('1'));
		$data['config']=$this->General_model->get_config();
		//$data['categorias_principales']=$this->producto_model->get_categorias_principales($data['idioma_actual']->id_idioma);
		$data['secciones_header']=$this->Seccion_model->get_secciones_header($data['idioma_actual']->id_idioma);
		$data['subsecciones_header']=$this->Seccion_model->get_subsecciones_header($data['idioma_actual']->id_idioma);
		
		$data['cols_pie']=$this->Usuarios_model->get_columnas_pie();
		if(count($data['cols_pie'])){
			$data['span']=12/count($data['cols_pie']);
		}else{
			$data['span']=2;
		}
		$cont=0;
		foreach($data['cols_pie'] as $col){
			$cont++;
			if($col->id_opc == 1)
				$data['menu_footer']=$this->Seccion_model->get_secciones_footer($data['idioma_actual']->id_idioma);
			elseif($col->id_opc == 4)
				$data['codigo'.$cont]=$this->Usuario_model->get_codigo_pie($col->id, $data['idioma_actual']->id_idioma);
		}
		$data['seccion']=$this->Seccion_model->get_seccion($data['idioma_actual']->id_idioma, $seccion);
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
