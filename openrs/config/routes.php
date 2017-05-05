<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = "/idioma";
$route['seo/sitemap_blog\.xml'] = "seo/sitemap_blog";
$route['seo/sitemap_etiq\.xml'] = "seo/sitemap_etiq";


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

class dynamic_route{

	public $pdo_db = FALSE;

	public function __construct(){

	}
	private function query_routes_idiomas($data){
		try{
			$return_data = $data;
			$routes_query = $this->pdo_db->query('SELECT nombre_seo FROM idiomas');

			if($routes_query){
				foreach($routes_query as $row) {
					$return_data[] = $row;
				}
				return $return_data;
			}
		}catch(PDOException $e) {
			echo 'Please contact Admin: '.$e->getMessage();
		}
	}
	private function query_routes_seccion_no_nativa($data){
		try{
			$return_data = $data;
			$routes_query = $this->pdo_db->query('SELECT url_seo, id_seccion as id_seccion_no_nativa FROM seccion where id_seccion > 2 ORDER BY `prioridad` ASC');

			if($routes_query){
				foreach($routes_query as $row) {
					$return_data[] = $row;
				}
				return $return_data;
			}

		}catch(PDOException $e) {
			echo 'Please contact Admin: '.$e->getMessage();
		}
	}

	private function query_routes_seccion_nativa($data){
		try{
			$return_data = $data;
			$routes_query = $this->pdo_db->query('SELECT url_seo, id_seccion as id_seccion_nativa FROM seccion where id_seccion <= 0 ORDER BY `prioridad` ASC');

			if($routes_query){
				foreach($routes_query as $row) {
					$return_data[] = $row;
				}
				return $return_data;
			}

		}catch(PDOException $e) {
			echo 'Please contact Admin: '.$e->getMessage();
		}
	}


	private function filter_route_data($data){
		$r_data = array();
                if($data)
                {
                    foreach($data as $row){
                            $return_data = new stdClass;

                            if(isset($row['id_seccion_no_nativa'])){
                                    $return_data->url = 'seccion/seccion/'.$row['url_seo'];
                                    $return_data->route = $row['url_seo'];
                                    $r_data[] = $return_data;
                            }elseif(isset($row['nombre_seo'])){
                                    $query2 = $this->pdo_db->query('SELECT url_seo FROM seccion_idiomas JOIN idiomas ON seccion_idiomas.id_idioma = idiomas.id_idioma WHERE idiomas.nombre_seo2 ="'.$row['nombre_seo'].'"');
                                    if($query2){
                                            foreach($query2 as $fila){

                                                    $return_data = new stdClass;
                                                    $return_data->url = 'seccion/seccion/'.$fila['url_seo'];
                                                    $return_data->route = '^'.$row['nombre_seo'].'/'.$fila['url_seo'];
                                                    $r_data[] = $return_data;
                                            }
                                    }
                                    $query = $this->pdo_db->query('SELECT url_seo_articulo, id_articulo FROM articulos_idiomas JOIN idiomas ON articulos_idiomas.id_idioma = idiomas.id_idioma WHERE idiomas.nombre_seo2 ="'.$row['nombre_seo'].'"');
                                    if($query){
                                            foreach($query as $fila){
                                                    $return_data = new stdClass;
                                                    $return_data->url = 'seccion/ver_articulo/'.$fila['id_articulo'];
                                                    $return_data->route = '^'.$row['nombre_seo'].'/blog/'.$fila['url_seo_articulo'];
                                                    $r_data[] = $return_data;
                                            }
                                    }
                                    $return_data = new stdClass;
                                    $return_data->url = 'login/mostrar_login/3';
                                    $return_data->route = '^'.$row['nombre_seo'].'/login';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'login/mostrar_login/2';
                                    $return_data->route = '^'.$row['nombre_seo'].'/login-cliente';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'login/mostrar_login/1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/login-admin';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'login/cerrar_sesion/3';
                                    $return_data->route = '^'.$row['nombre_seo'].'/logout';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'login/cerrar_sesion/2';
                                    $return_data->route = '^'.$row['nombre_seo'].'/logout-cliente';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'login/cerrar_sesion/1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/logout-admin';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'login/registro/2';
                                    $return_data->route = '^'.$row['nombre_seo'].'/registro-cliente';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'login/registro/3';
                                    $return_data->route = '^'.$row['nombre_seo'].'/registro';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'login/olvide_pass';
                                    $return_data->route = '^'.$row['nombre_seo'].'/olvide-pass';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'login/validar_form/2';
                                    $return_data->route = '^'.$row['nombre_seo'].'/validar-cliente';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'login/validar_form/3';
                                    $return_data->route = '^'.$row['nombre_seo'].'/validar';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'login/validar_form/1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/validar-admin';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'login/crear_usuario';
                                    $return_data->route = '^'.$row['nombre_seo'].'/crear-usuario';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'login/crear_cliente';
                                    $return_data->route = '^'.$row['nombre_seo'].'/crear-cliente';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'login/validar_cambiar_pass';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cambio-pass';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'login/validar_cambio_pass';
                                    $return_data->route = '^'.$row['nombre_seo'].'/validar-cambio-pass';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'login/cambiar_pass/$1/$2';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cambiar-pass/(:num)/(:any)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'login/legal';
                                    $return_data->route = '^'.$row['nombre_seo'].'/legal';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuario/mi_cuenta/3';
                                    $return_data->route = '^'.$row['nombre_seo'].'/mis-compras';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuarios/listar_usuarios';
                                    $return_data->route = '^'.$row['nombre_seo'].'/listar-usuarios';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuarios/listar_usuarios/error';
                                    $return_data->route = '^'.$row['nombre_seo'].'/listar-usuarios-error';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuarios/listar_usuarios/exito';
                                    $return_data->route = '^'.$row['nombre_seo'].'/listar-usuarios-exito';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuarios/listar_direcciones/$1/exito';
                                    $return_data->route = '^'.$row['nombre_seo'].'/listar-direcciones-exito/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuarios/crear';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-crear-usuarios';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuarios/exportar_newsletter';
                                    $return_data->route = '^'.$row['nombre_seo'].'/exportar-newsletter';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuarios/crear/1/error';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-crear-cliente-error';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuarios/editar_usuario/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-editar-usuario/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuarios/listar_direcciones/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-listar-direcciones/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuarios/crear_direccion/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-crear-direccion/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuarios/editar_direccion/$1/$2';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-editar-direccion/(:num)/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuarios/eliminar_direccion/$1/$2';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-eliminar-direccion/(:num)/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuarios/crear_cliente';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-crear-cliente';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuarios/crear/2/error';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-crear-usuario-error';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuarios/crear_usuario';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-crear-usuario';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuarios/crear/3/error';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-crear-admin-error';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuarios/crear_admin';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-crear-admin';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuarios/eliminar/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-eliminar-usuario/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuarios/recuperar/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-recuperar-usuario/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'admin/mi_cuenta';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-mi-cuenta';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'admin/mi_cuenta/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-mi-cuenta/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'admin/mi_cuenta/$1/$2';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-mi-cuenta/(:num)/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'admin/validar_modificar_config';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-modificar-config';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'admin/validar_modificar_pass';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-modificar-pass';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'admin/validar_modificar_email';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-modificar-email';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'admin/validar_modificar_datos';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-modificar-datos';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'admin/admin_configurar_pie';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-configurar-pie';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'admin/limpiar_red/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-limpiar-red/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuarios/activar_usuario/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/activar-usuario/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuarios/desactivar_usuario/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/desactivar-usuario/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuarios/banear_usuario/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/banear-usuario/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuarios/validar_banear_usuario/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/validar-banear-usuario/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuarios/desbanear_usuario/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/desbanear-usuario/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'cliente/mi_cuenta';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cliente-mi-cuenta';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'cliente/mi_cuenta/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cliente-mi-cuenta/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'cliente/mi_cuenta/$1/$2';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cliente-mi-cuenta/(:num)/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'cliente/validar_modificar_config';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cliente-modificar-config';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'cliente/validar_modificar_pass';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cliente-modificar-pass';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'cliente/validar_modificar_email';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cliente-modificar-email';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'cliente/validar_modificar_datos';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cliente-modificar-datos';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuario/mi_cuenta';
                                    $return_data->route = '^'.$row['nombre_seo'].'/usuario-mi-cuenta';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuario/mi_cuenta/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/usuario-mi-cuenta/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuario/mi_cuenta/$1/$2';
                                    $return_data->route = '^'.$row['nombre_seo'].'/usuario-mi-cuenta/(:num)/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuario/validar_modificar_config';
                                    $return_data->route = '^'.$row['nombre_seo'].'/usuario-modificar-config';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuario/validar_modificar_pass';
                                    $return_data->route = '^'.$row['nombre_seo'].'/usuario-modificar-pass';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuario/validar_modificar_email';
                                    $return_data->route = '^'.$row['nombre_seo'].'/usuario-modificar-email';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuario/validar_modificar_datos';
                                    $return_data->route = '^'.$row['nombre_seo'].'/usuario-modificar-datos';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuario/modificar_perfil';
                                    $return_data->route = '^'.$row['nombre_seo'].'/usuario-modificar-perfil';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuario/crear_direccion';
                                    $return_data->route = '^'.$row['nombre_seo'].'/usuario-crear-direccion';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuario/editar_direccion/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/usuario-editar-direccion/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuario/eliminar_direccion/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/usuario-eliminar-direccion/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuarios/remove_to_user';
                                    $return_data->route = '^'.$row['nombre_seo'].'/eliminar-usuario';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'usuarios/recuperar_remove_to_user';
                                    $return_data->route = '^'.$row['nombre_seo'].'/recuperar-usuario';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'admin/gestionar_idiomas';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-gestionar-idiomas';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'admin/gestionar_idiomas/3';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-gestionar-idiomas-exito';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'admin/subir_idiomas';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-subir-idiomas';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'admin/subir_idiomas/2';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-subir-idiomas-exito';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'admin/modificar_idioma';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-modificar-idioma';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'admin/subir_idioma';
                                    $return_data->route = '^'.$row['nombre_seo'].'/admin-subir-idioma';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'admin/eliminar_idioma/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/eliminar-idioma/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'blog/listar_articulos';
                                    $return_data->route = '^'.$row['nombre_seo'].'/blog-listar-articulos';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'blog/listar_articulos/1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/blog-listar-articulos-publicados';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'blog/listar_articulos/3';
                                    $return_data->route = '^'.$row['nombre_seo'].'/blog-listar-articulos-borradores';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'blog/listar_articulos/21';
                                    $return_data->route = '^'.$row['nombre_seo'].'/blog-listar-articulos-eliminados';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'blog/crear_articulo';
                                    $return_data->route = '^'.$row['nombre_seo'].'/blog-crear-articulo';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'blog/editar_articulo/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/blog-editar-articulo/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'blog/editar_articulo';
                                    $return_data->route = '^'.$row['nombre_seo'].'/blog-editar-articulo';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'blog/eliminar_articulo/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/blog-eliminar-articulo/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'blog/eliminar_articulo';
                                    $return_data->route = '^'.$row['nombre_seo'].'/blog-eliminar-articulo';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'blog/recuperar_articulo/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/blog-recuperar-articulo/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'blog/recuperar_articulo';
                                    $return_data->route = '^'.$row['nombre_seo'].'/blog-recuperar-articulo';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'blog/listar_comentarios/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/blog-listar-comentarios/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'blog/listar_comentarios/$1/$2';
                                    $return_data->route = '^'.$row['nombre_seo'].'/blog-listar-comentarios/(:num)/(:any)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'blog/listar_comentarios';
                                    $return_data->route = '^'.$row['nombre_seo'].'/blog-listar-comentarios';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'blog/recuperar_comentario/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/blog-recuperar-comentario/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'blog/eliminar_comentario/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/blog-eliminar-comentario/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'site/votar/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/blog-votar/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'site/votar';
                                    $return_data->route = '^'.$row['nombre_seo'].'/blog-votar';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'site/ver_articulo';
                                    $return_data->route = '^'.$row['nombre_seo'].'/blog-ver-articulo';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'site/articulos/$1/$2';
                                    $return_data->route = '^'.$row['nombre_seo'].'/blog-articulos/(:num)/(:any)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'site/articulos';
                                    $return_data->route = '^'.$row['nombre_seo'].'/blog-articulos';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'pedido/cancelacion';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cancelacion';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'blog/listar_categorias';
                                    $return_data->route = '^'.$row['nombre_seo'].'/blog-listar-categorias';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'blog/crear_categoria';
                                    $return_data->route = '^'.$row['nombre_seo'].'/blog-crear-categoria';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'blog/editar_categoria/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/blog-editar-categoria/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'blog/eliminar_categoria/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/blog-eliminar-categoria/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'site/articulos_categoria/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/blog-categoria/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'site/ver_productos';
                                    $return_data->route = '^'.$row['nombre_seo'].'/tienda';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'site/ver_productos/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/tienda/(:any)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'site/ver_productos_filtrados/$1/$2/$3';
                                    $return_data->route = '^'.$row['nombre_seo'].'/productos/(:any)/(:num)/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'site/ver_producto/$1/$2';
                                    $return_data->route = '^'.$row['nombre_seo'].'/producto/(:any)/(:any)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'ventas/actualizar_estado/$1/$2';
                                    $return_data->route = '^'.$row['nombre_seo'].'/estado/(:num)/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'ventas/crear_estado';
                                    $return_data->route = '^'.$row['nombre_seo'].'/venta-crear-estado';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'ventas/editar_estado/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/venta-editar-estado/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'ventas/eliminar_estado/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/venta-eliminar-estado/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'page/ordenar_secciones';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cms-ordenar-secciones';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'page/crear_seccion';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cms-crear-seccion';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'page/crear_seccion/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cms-crear-seccion/(:any)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'page/ordenar_super_secciones';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cms-ordenar-super-secciones';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'page/crear_super_seccion';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cms-crear-super-seccion';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'page/crear_super_seccion/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cms-crear-super-seccion/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'page/ordenar_bloques/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cms-ordenar-bloques/(:any)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'page/crear_bloque/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cms-crear-bloque/(:any)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'page/crear_bloque/$1/$2';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cms-crear-bloque/(:any)/(:any)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'page/editar_bloque/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cms-editar-bloque/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'page/crear_bloque_texto/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cms-crear-bloque-texto/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'page/crear_bloque_texto';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cms-crear-bloque-texto';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'page/crear_carrusel/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cms-crear-bloque-carrusel/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'page/ordenar_carrusel/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cms-ordenar-carrusel/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'page/editar_carrusel/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cms-editar-carrusel/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'page/eliminar_imagen_carrusel/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cms-eliminar-imagen-carrusel/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'page/ordenar_carrusel_categorias/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cms-ordenar-carrusel-categorias/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'page/listar_secciones';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cms-listar-secciones';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'page/listar_secciones/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cms-listar-secciones/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'page/listar_super_secciones';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cms-listar-super-secciones';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'page/listar_bloques/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cms-listar-bloques/(:any)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'page/editar_carrusel_categoria/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cms-editar-carrusel-categoria/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'page/eliminar_categoria_carrusel/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cms-eliminar-carrusel-categoria/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'page/borrar_bloque/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cms-borrar-bloque/(:num)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'page/borrar_seccion/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cms-borrar-seccion/(:any)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'page/borrar_super_seccion/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cms-borrar-super-seccion/(:any)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'inmobiliaria/crear_proyecto/$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/cms-crear-proyecto/(:any)';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'errors/error_404';
                                    $return_data->route = '^'.$row['nombre_seo'].'/errors/error_404';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'site/seccion/contacto';
                                    $return_data->route = '^'.$row['nombre_seo'].'/contacto';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = '$1';
                                    $return_data->route = '^'.$row['nombre_seo'].'/(.+)$';
                                    $r_data[] = $return_data;
                                    $return_data = new stdClass;
                                    $return_data->url = 'default_controller';
                                    $return_data->route = '^'.$row['nombre_seo'].'$';
                                    $r_data[] = $return_data;
                            }
                    }
                }
		return $r_data;
	}

	public function get_routes(){
		$route_data = array();
		$route_data = $this->query_routes_seccion_nativa($route_data);
		$route_data = $this->query_routes_seccion_no_nativa($route_data);
		$route_data = $this->query_routes_idiomas($route_data);
		$return_data = $this->filter_route_data($route_data);
		return $return_data;
	}

}

require('connect.php');

$dynamic_route = new dynamic_route;
// Give dynamic route database connection
$dynamic_route->pdo_db = pdo_connect();
// Get the route data
$route_data = $dynamic_route->get_routes();
//Iterate over the routes
foreach($route_data as $row){
	$route[$row->route] = $row->url;
}

