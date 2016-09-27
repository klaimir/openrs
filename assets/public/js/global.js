$(document).ready(function(){
	/** 
	 * MENÚ MÓVIL 
	 **/
	var contador = 1;
		$('.menu_bar').click(function(){
			// $('nav').toggle(); 
	 
			if(contador == 1){
				$('nav').animate({
					left: '0'
				});
				contador = 0;
			} else {
				contador = 1;
				$('nav').animate({
					left: '-160%'
				});
			}
	 
		});
	/** 
	 * FUNCIONES REGISTRO 
	 **/
	$("#pais").change(function() {
        $("#pais option:selected").each(function() {
        	var site_url=$('#site_url').val();
    		var idioma=$('#site_idioma').val();
            var pais = $('#pais').val();
            $.post(site_url+"/"+idioma+"/login/llena_provincias", {pais: pais, idioma:idioma}, 
            function(data) {
                $("#provincia").html(data);
            });
        });
    });
	$('#datetimepicker1').datetimepicker({
		format: 'YYYY-MM-DD HH:mm:ss',
		locale: 'es',
	});
	$('.datepicker').datepicker();
	
	/**
	 * Funciones de productos
	 */
	$('#precio_venta').focusout(function(){
		var iva=parseInt($('[name="id_tipoiva"] option:selected').text());
		var pvp=$('#precio_venta').val()*((100+iva)/100);
		//alert(iva+"-"+pvp);
		$('#pvp').val(pvp.toFixed(4));
	});
	$('[name="id_tipoiva"]').change(function(){
		var iva=parseInt($('[name="id_tipoiva"] option:selected').text());
		var pvp=$('#precio_venta').val()*((100+iva)/100);
		$('#pvp').val(pvp.toFixed(4));
	});
	/**
	 *   FUNCIONES PARA GALERIAS
	 */
	//control de paginación
	$('.btn-pagina').click(function(){
		var numPagina=$(this).attr('id');
		//if($('.cat-todos').hasClass('active')){
			$('.img-galeria').each(function(){
				if($(this).hasClass(numPagina)){
					$(this).slideDown();
				}else{
					$(this).slideUp();
				}
			});
		//}else{
			
		//}
		
	});	
	//mostrar y ocultar imágenes para categorías
	$('.cat-top').click(function(){
		var idCategoria=$(this).attr('id');
		var contador=0;
		var porPagina=$('#por_pagina').val();
		var maximo=$('#maximo').val();
		var total=$('.'+idCategoria).length;
		var numPaginas=total/porPagina;
		var numPagina=1;
		$('.cat-top').each(function(){
			$(this).removeClass('active');
		});
		$('.cat-todos').removeClass('active');
		$(this).addClass('active');
		
		$('.img-galeria').each(function(){
			$(this).removeClass('pagina-1 pagina-2 pagina-3 pagina-4 pagina-5 pagina-6 pagina-7 pagina-8 pagina-9 pagina-10 '+
					'pagina-11 pagina-12 pagina-13 pagina-14 pagina-15 pagina-16 pagina-17 pagina-18 pagina-19 pagina-20 pagina-999');
			if($(this).hasClass(idCategoria)){
				if(contador<porPagina && contador < maximo){
					$(this).addClass('pagina-1');
					$(this).slideDown();
				}else{
					$(this).addClass('pagina-'+numPagina);
					$(this).slideUp();
				}
				contador++;
				if(contador % porPagina==0) numPagina++;
			}else{
				$(this).addClass('pagina-999');
				$(this).slideUp();
			}
		});
		//Controlamos la paginación
		
		var contPag=0;
		if(numPaginas>1){
			$('.pagination li').each(function(){
				if(contPag<numPaginas){
					$(this).fadeIn();
				}else{
					$(this).fadeOut();
				}
				contPag++;
			});
			
		}else{
			/*$('.pagination li').each(function(){
				$(this).fadeOut();
			}*/
			$('.pagination li').fadeOut();
		}
	});
	$('.cat-todos').click(function(){
		var contador=0;
		var porPagina=$('#por_pagina').val();
		var maximo=$('#maximo').val();
		var total=$('.img-galeria').length;
		var numPaginas=total/porPagina;
		var numPagina=1;
		$('.cat-top').each(function(){
			$(this).removeClass('active');
		});
		$(this).addClass('active');
		
		$('.img-galeria').each(function(){
			$(this).removeClass('pagina-1 pagina-2 pagina-3 pagina-4 pagina-5 pagina-6 pagina-7 pagina-8 pagina-9 pagina-10 '+
					'pagina-11 pagina-12 pagina-13 pagina-14 pagina-15 pagina-16 pagina-17 pagina-18 pagina-19 pagina-20 pagina-999');
			if(contador<porPagina && contador < maximo){
				$(this).addClass('pagina-1');
				$(this).slideDown();
			}else{
				$(this).addClass('pagina-'+numPagina);
				$(this).slideUp();
			}
			contador++;	
			if(contador % porPagina==0) numPagina++;
		});
		//Controlamos la paginación
		var contPag=0;
		if(numPaginas>1){
			$('.pagination li').each(function(){
				if(contPag<numPaginas){
					
					$(this).fadeIn();
				}else{
					$(this).fadeOut();
				}
				contPag++;
			});
			
		}else{
			/*$('.pagination li').each(function(){
				$(this).fadeOut();
			}*/
			$('.pagination li').fadeOut();
		}
	});
	
	/**
	 * FIN FUNCIONES GALERIA
	 */
	/**
	 * FUNCIONES DE PRODUCTOS
	 */
	//Actualizar valor de cantidad en input hidden
	$('.cantidad_dd').change(function(){
		$('#cantidad').val($('.cantidad_dd option:selected').val());
	});
	//Añadir un producto al carrito
	$('.form-producto').submit(function(){
		var site_url=$('#site_url').val();
		var idioma=$('#site_idioma').val();
		var id_producto = $(this).find('input[name=id_producto]').val();
		var cantidad = $(this).find('input[name=cantidad]').val();
		var precio = $(this).find('input[name=precio]').val();
		$.post(site_url+"/"+idioma+"/carrito/anadir_item", { id_producto: id_producto, cantidad: cantidad, idioma:idioma, ajax: '1' },
			function(data){	
				if(data == 'ok'){
					//$.get(site_url + "/carrito/mostrar_carrito", function(carrito){
					//	$("#cart_content").html(carrito);
					//});
					$("#num-productos").html(parseInt($("#num-productos").html())+parseInt(cantidad));
					$('#aviso-compra').html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Producto añadido al carrito</strong></div>');
				}else{
	 				if(data == 'error'){
	 					alert("El producto seleccionado no existe o está descatalogado");
	 				}
	 			}
		 });
		return false;
	});
	//Mostrar el carrito
	$(".carrito").click(function(){
		//Mostrar el carrito actual
		var site_url=$('#site_url').val();
		var idioma=$('#site_idioma').val();
		if($("#cart_content_mini").html()==""){
			$.get(site_url+"/"+idioma+"/carrito/mostrar_carrito", function(carrito){
				$("#cart_content_mini").html(carrito);
			});
		}else{
			$("#cart_content_mini").html('');
		}
		
	});
	//Vaciar carrito
	$(".empty").click(function(){
    	$.get(link + "carrito/vaciar_carrito", function(){
    		$.get(link + "carrito/mostrar_carrito", function(carrito){
  				$("#cart_content").html(carrito);
			});
		});
		
		return false;
    });
	
	$(".cant_cart").change(function(){
		var cantidad=$(this).val();
		var linea=$(this).attr('class').split(' ')[1].split('_')[1];
		var precio=$('#precio_'+linea).attr('value');
		var subtotal=cantidad*precio;
		var total_aux=$('.total_carrito').attr('id');
		var subtotal_aux=$('.subtotal_'+linea).attr('id');
		var total=Number(total_aux) - Number(subtotal_aux) + Number(subtotal);
		var total=total.toFixed(2);
		var subtotal=subtotal.toFixed(2);
		$('.subtotal_'+linea).attr('id',subtotal);
		$('.total_carrito').attr('id',total);
		$('.subtotal_'+linea).html('<strong>'+subtotal+' &euro;</strong>');
		$('.total_carrito').html('<strong>'+total+' &euro;</strong>');
	});
	
	/**
	 * FIN FUNCIONES PRODUCTOS
	 */
	//mostrar contenido oculto
	$('.btn-mostrar').click(function(){
		var ocultoDisplay=$('.oculto').css('display');
		if(ocultoDisplay=="none"){
			$('.oculto').slideDown();
			$('.btn-mostrar').text('Ocultar formulario');
		}else{
			$('.oculto').slideUp();
			$('.btn-mostrar').text('Añadir imagen');
		}
	});
	$('.btn-mostrar-2').click(function(){
		var ocultoDisplay=$('.oculto-2').css('display');
		if(ocultoDisplay=="none"){
			$('.oculto-2').slideDown();
			$('.btn-mostrar-2').text('Ocultar formulario');
		}else{
			$('.oculto-2').slideUp();
			$('.btn-mostrar-2').text('Añadir categoría');
		}
	});
	//Crear-Editar bloques
	$('.id_tipo_bloque').change(function(){
		var textoDisplay=$('.bloque-texto').css('display');
		var carruselDisplay=$('.bloque-carrusel').css('display');
		if($('.id_tipo_bloque').val()==1){
			if(textoDisplay=='none'){
				$('.bloque-carrusel').fadeOut();
				$('.bloque-texto').fadeIn();
			}
		}else if($('.id_tipo_bloque').val()==2){
			if(carruselDisplay=='none'){
				$('.bloque-carrusel').fadeIn();
				$('.bloque-texto').fadeOut();
			}
		}else{
			$('.bloque-carrusel').fadeOut();
			$('.bloque-texto').fadeOut();
		}
	});
	//Galeria de imagenes
	$('.img-galeria').click(function(e){
		$('#myModal').carousel(($(this).attr('id')-1));
	});
	//Ordenar secciones
	$('#guardar_orden').click(function(){
		var $ids = '';
		$('#sortable li').each(function(){
			$ids = $ids+''+this.id+';';
		});
		$('#input_orden').val($ids);
	});
	//Menu desplegable de servicios
	/*$('#servicios-header').hover(function(){
		$('.servicios-desplegable').slideUp();
	)};*/
	$('#servicios-header').hover(function(){
		$displayServicios = $('.servicios-desplegable').css("display");
		if($displayServicios == 'none'){
			$('.servicios-desplegable').slideDown();
		}
	});
	$('.elemento-header').hover(function(){
		$displayServicios = $('.servicios-desplegable').css("display");
		if($displayServicios != 'none'){
			$('.servicios-desplegable').slideUp();
		}
	});
	$('#content').hover(function(){
		$displayServicios = $('.servicios-desplegable').css("display");
		if($displayServicios != 'none'){
			$('.servicios-desplegable').slideUp();
		}
	});
	$('#opcion-pago').hover(function(){
		$displayServicios = $('.opciones-pago').css("display");
		if($displayServicios != 'none'){
			$('.opciones-pago').slideDown();
		}
	});
	//Cookies LOPD
	$('.aceptar-cookies').click(function(){
		$.cookie.defaults.path = '/';
		$.cookie('cookieLOPD', 'aceptado', { expires: 366});
		$('.navbar-cookies').slideUp();
	});
	
	//Show change logo
	$('.change_logo').click(function(){
		$displayOculto = $('.oculto').css("display");
		if($displayOculto == 'none'){
			$('.oculto').fadeIn();
		}
	});
	$('.no_change_logo').click(function(){
		$displayOculto = $('.oculto').css("display");
		if($displayOculto != 'none'){
			$('.oculto').fadeOut();
		}
	});
	//Recargar la página
	$("#recargar").click(function(){
		location.reload();
	});
	
	//Eliminar etiqueta
	$(".etiquetas").on("click", ".del_etiqueta", function(){
		$(this).remove();
		var id = $(this).attr('id').split('_');
		$('#ins_etiqueta_'+id[1]).focus();
	});
	//Comprobaciones al enviar un blog
	$(".enviar").click(function(){
		//Recorre el listado de etiquetas y las almacena en el input hidden
		$('.etiquetas').each(function( index ) {
			var id = $(this).attr('id').split('_');
			$( "#etiquetas_"+id[1]+" li" ).each(function( index ) {
				$("#todas_etiquetas_"+id[1]).val($("#todas_etiquetas_"+id[1]).val()+$(this).attr("id")+';');
			});
		});
	});
	//Tooltips
	$('.action-tooltip').each(function() {
		$(this).tooltip();
	});
	//Intervalo y pausa crousel
	$('.carousel').carousel({
		interval: 5000,
		pause: "hover"
	});

});


/* Default class modification */
$.extend( $.fn.dataTableExt.oStdClasses, {
	"sWrapper": "dataTables_wrapper form-inline"
} );

/* API method to get paging information */
$.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings )
{
	return {
		"iStart":         oSettings._iDisplayStart,
		"iEnd":           oSettings.fnDisplayEnd(),
		"iLength":        oSettings._iDisplayLength,
		"iTotal":         oSettings.fnRecordsTotal(),
		"iFilteredTotal": oSettings.fnRecordsDisplay(),
		"iPage":          Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
		"iTotalPages":    Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
	};
}

/* Bootstrap style pagination control */
$.extend( $.fn.dataTableExt.oPagination, {
	"bootstrap": {
		"fnInit": function( oSettings, nPaging, fnDraw ) {
			var oLang = oSettings.oLanguage.oPaginate;
			var fnClickHandler = function ( e ) {
				e.preventDefault();
				if ( oSettings.oApi._fnPageChange(oSettings, e.data.action) ) {
					fnDraw( oSettings );
				}
			};

			$(nPaging).append(
				'<ul class="pagination">'+
					'<li class="prev disabled"><a href="#">&larr; '+oLang.sPrevious+'</a></li>'+
					'<li class="next disabled"><a href="#">'+oLang.sNext+' &rarr; </a></li>'+
				'</ul>'
			);
			var els = $('a', nPaging);
			$(els[0]).bind( 'click.DT', { action: "previous" }, fnClickHandler );
			$(els[1]).bind( 'click.DT', { action: "next" }, fnClickHandler );
		},

		"fnUpdate": function ( oSettings, fnDraw ) {
			var iListLength = 5;
			var oPaging = oSettings.oInstance.fnPagingInfo();
			var an = oSettings.aanFeatures.p;
			var i, j, sClass, iStart, iEnd, iHalf=Math.floor(iListLength/2);

			if ( oPaging.iTotalPages < iListLength) {
				iStart = 1;
				iEnd = oPaging.iTotalPages;
			}
			else if ( oPaging.iPage <= iHalf ) {
				iStart = 1;
				iEnd = iListLength;
			} else if ( oPaging.iPage >= (oPaging.iTotalPages-iHalf) ) {
				iStart = oPaging.iTotalPages - iListLength + 1;
				iEnd = oPaging.iTotalPages;
			} else {
				iStart = oPaging.iPage - iHalf + 1;
				iEnd = iStart + iListLength - 1;
			}

			for ( i=0, iLen=an.length ; i<iLen ; i++ ) {
				// Remove the middle elements
				$('li:gt(0)', an[i]).filter(':not(:last)').remove();

				// Add the new list items and their event handlers
				for ( j=iStart ; j<=iEnd ; j++ ) {
					sClass = (j==oPaging.iPage+1) ? 'class="active"' : '';
					$('<li '+sClass+'><a href="#">'+j+'</a></li>')
						.insertBefore( $('li:last', an[i])[0] )
						.bind('click', function (e) {
							e.preventDefault();
							oSettings._iDisplayStart = (parseInt($('a', this).text(),10)-1) * oPaging.iLength;
							fnDraw( oSettings );
						} );
				}

				// Add / remove disabled classes from the static elements
				if ( oPaging.iPage === 0 ) {
					$('li:first', an[i]).addClass('disabled');
				} else {
					$('li:first', an[i]).removeClass('disabled');
				}

				if ( oPaging.iPage === oPaging.iTotalPages-1 || oPaging.iTotalPages === 0 ) {
					$('li:last', an[i]).addClass('disabled');
				} else {
					$('li:last', an[i]).removeClass('disabled');
				}
			}
		}
	}

});
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');