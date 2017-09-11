--
-- Estructura de tabla para la tabla `articulo_categorias`
--

CREATE TABLE `articulo_categorias` (
  `id` int(10) NOT NULL,
  `id_articulo` int(10) NOT NULL,
  `id_categoria` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indices de la tabla `articulo_categorias`
--
ALTER TABLE `articulo_categorias`
  ADD PRIMARY KEY (`id`);
  
  -
-- AUTO_INCREMENT de la tabla `articulo_categorias`
--
ALTER TABLE `articulo_categorias`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
  
--
-- Estructura de tabla para la tabla `articulo_etiquetas`
--

CREATE TABLE `articulo_etiquetas` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_articulo` int(10) UNSIGNED NOT NULL,
  `id_etiqueta` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Indices de la tabla `articulo_etiquetas`
--
ALTER TABLE `articulo_etiquetas`
  ADD PRIMARY KEY (`id`);


--
-- AUTO_INCREMENT de la tabla `articulo_etiquetas`
--
ALTER TABLE `articulo_etiquetas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
  
--
-- Estructura de tabla para la tabla `articulos_idiomas`
--

CREATE TABLE `articulos_idiomas` (
  `id_articulo` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(200) CHARACTER SET latin1 NOT NULL,
  `descripcion` text CHARACTER SET latin1 NOT NULL,
  `contenido` text CHARACTER SET latin1 NOT NULL,
  `img_articulo` varchar(200) CHARACTER SET latin1 NOT NULL,
  `img_articulo_mini` varchar(250) CHARACTER SET latin1 NOT NULL,
  `id_articulo_idioma` int(11) NOT NULL,
  `id_idioma` int(11) NOT NULL,
  `url_seo_articulo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Indices de la tabla `articulos_idiomas`
--
ALTER TABLE `articulos_idiomas`
  ADD PRIMARY KEY (`id_articulo_idioma`);


--
-- AUTO_INCREMENT de la tabla `articulos_idiomas`
--
ALTER TABLE `articulos_idiomas`
  MODIFY `id_articulo_idioma` int(11) NOT NULL AUTO_INCREMENT;
  
--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id` int(10) UNSIGNED NOT NULL,
  `creado` datetime NOT NULL,
  `modificado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_estado` tinyint(3) UNSIGNED NOT NULL,
  `visitas` int(11) NOT NULL DEFAULT '0',
  `id_autor` int(10) UNSIGNED NOT NULL,
  `comentario` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`);


--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
  
--
-- Estructura de tabla para la tabla `bloque_inmuebles`
--

CREATE TABLE `bloque_inmuebles` (
  `idbloque_inmuebles` int(11) NOT NULL,
  `tipo` int(2) DEFAULT NULL,
  `num_inmuebles` int(2) DEFAULT NULL,
  `id_bloque` int(11) NOT NULL,
  `muestra_resumen` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Indices de la tabla `bloque_inmuebles`
--
ALTER TABLE `bloque_inmuebles`
  ADD PRIMARY KEY (`idbloque_inmuebles`);


--
-- AUTO_INCREMENT de la tabla `bloque_inmuebles`
--
ALTER TABLE `bloque_inmuebles`
  MODIFY `idbloque_inmuebles` int(11) NOT NULL AUTO_INCREMENT;
  
--
-- Estructura de tabla para la tabla `carrusel`
--

CREATE TABLE `carrusel` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_bloque` int(10) UNSIGNED NOT NULL,
  `tipo_carrusel` int(10) UNSIGNED NOT NULL,
  `por_pagina` int(10) NOT NULL DEFAULT '9',
  `maximo` int(10) NOT NULL DEFAULT '0',
  `columnas` int(10) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indices de la tabla `carrusel`
--
ALTER TABLE `carrusel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de la tabla `carrusel`
--
ALTER TABLE `carrusel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
  
--
-- Estructura de tabla para la tabla `categoria_blog_idiomas`
--

CREATE TABLE `categoria_blog_idiomas` (
  `id_categoria_idioma` int(11) NOT NULL,
  `id_categoria` int(3) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `id_idioma` int(11) NOT NULL,
  `url_seo_categoria_blog` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indices de la tabla `categoria_blog_idiomas`
--
ALTER TABLE `categoria_blog_idiomas`
  ADD PRIMARY KEY (`id_categoria_idioma`);

--
-- AUTO_INCREMENT de la tabla `categoria_blog_idiomas`
--
ALTER TABLE `categoria_blog_idiomas`
  MODIFY `id_categoria_idioma` int(11) NOT NULL AUTO_INCREMENT;
  
--
-- Estructura de tabla para la tabla `categoria_blog`
--

CREATE TABLE `categoria_blog` (
  `id` int(3) NOT NULL,
  `creada` datetime NOT NULL,
  `modificada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_creador` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indices de la tabla `categoria_blog`
--
ALTER TABLE `categoria_blog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de la tabla `categoria_blog`
--
ALTER TABLE `categoria_blog`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;
  
--
-- Estructura de tabla para la tabla `categoria_carrusel_idiomas`
--

CREATE TABLE `categoria_carrusel_idiomas` (
  `id_categoria_carrusel_idiomas` int(10) UNSIGNED NOT NULL,
  `nombre_cat` varchar(25) NOT NULL,
  `descripcion_cat` text NOT NULL,
  `id_categoria_carrusel` int(10) UNSIGNED NOT NULL,
  `id_idioma` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indices de la tabla `categoria_carrusel_idiomas`
--
ALTER TABLE `categoria_carrusel_idiomas`
  ADD PRIMARY KEY (`id_categoria_carrusel_idiomas`);

--
-- AUTO_INCREMENT de la tabla `categoria_carrusel_idiomas`
--
ALTER TABLE `categoria_carrusel_idiomas`
  MODIFY `id_categoria_carrusel_idiomas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
  
--
-- Estructura de tabla para la tabla `categoria_carrusel`
--

CREATE TABLE `categoria_carrusel` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_carrusel` int(10) UNSIGNED NOT NULL,
  `prioridad` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indices de la tabla `categoria_carrusel`
--
ALTER TABLE `categoria_carrusel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de la tabla `categoria_carrusel`
--
ALTER TABLE `categoria_carrusel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
  
--
-- Estructura de tabla para la tabla `etiquetas`
--

CREATE TABLE `etiquetas` (
  `id` int(10) UNSIGNED NOT NULL,
  `etiqueta` varchar(100) CHARACTER SET latin1 NOT NULL,
  `id_idioma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indices de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
  
--
-- Estructura de tabla para la tabla `imagen_carrusel_idiomas`
--

CREATE TABLE `imagen_carrusel_idiomas` (
  `id_imagen_carrusel_idiomas` int(10) UNSIGNED NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `imagen_mini` varchar(220) NOT NULL,
  `texto_carrusel` text,
  `titulo_carrusel` text,
  `titulo_seo` text NOT NULL,
  `id_idioma` int(11) UNSIGNED NOT NULL,
  `id_imagen_carrusel` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indices de la tabla `imagen_carrusel_idiomas`
--
ALTER TABLE `imagen_carrusel_idiomas`
  ADD PRIMARY KEY (`id_imagen_carrusel_idiomas`);


--
-- AUTO_INCREMENT de la tabla `imagen_carrusel_idiomas`
--
ALTER TABLE `imagen_carrusel_idiomas`
  MODIFY `id_imagen_carrusel_idiomas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
  
--
-- Estructura de tabla para la tabla `imagen_carrusel`
--

CREATE TABLE `imagen_carrusel` (
  `id_imagen_carrusel` int(10) UNSIGNED NOT NULL,
  `prioridad` int(2) UNSIGNED NOT NULL,
  `id_carrusel` int(10) UNSIGNED NOT NULL,
  `id_categoria` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indices de la tabla `imagen_carrusel`
--
ALTER TABLE `imagen_carrusel`
  ADD PRIMARY KEY (`id_imagen_carrusel`);

--
-- AUTO_INCREMENT de la tabla `imagen_carrusel`
--
ALTER TABLE `imagen_carrusel`
  MODIFY `id_imagen_carrusel` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
  
--
-- Estructura de tabla para la tabla `votos`
--

CREATE TABLE `votos` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip` varchar(50) CHARACTER SET latin1 NOT NULL,
  `id_articulo` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indices de la tabla `votos`
--
ALTER TABLE `votos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de la tabla `votos`
--
ALTER TABLE `votos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
  
  CREATE TABLE `comentarios_blog` (
  `id` int(10) UNSIGNED NOT NULL,
  `contenido` text CHARACTER SET latin1 NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `id_articulo` int(10) UNSIGNED NOT NULL,
  `num_mensaje_articulo` int(11) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nick` varchar(150) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios_blog`
--
ALTER TABLE `comentarios_blog`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id` (`id`) USING BTREE;

UPDATE `idiomas` SET `carpeta_idioma` = 'english' WHERE `idiomas`.`id_idioma` = 53;