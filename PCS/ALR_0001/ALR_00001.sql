-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE `config` (
  `id_config` tinyint(2) NOT NULL,
  `id_idioma` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`id_config`, `id_idioma`) VALUES
(1, 'es');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idiomas`
--

CREATE TABLE `idiomas` (
  `id_idioma` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `nombre_seo` varchar(3) NOT NULL,
  `nombre_seo2` varchar(10) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  `subido` tinyint(1) NOT NULL DEFAULT '0',
  `carpeta_idioma` varchar(50) NOT NULL,
  `bandera` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `idiomas`
--

INSERT INTO `idiomas` (`id_idioma`, `nombre`, `nombre_seo`, `nombre_seo2`, `activo`, `subido`, `carpeta_idioma`, `bandera`) VALUES
(1, 'Arabic', 'ar', 'ar', 0, 0, 'arabic', ''),
(2, 'Azerbaijani', 'az', 'az', 0, 0, 'azerbaijani', ''),
(3, 'Bulgarian', 'bg', 'bg', 0, 0, 'bulgarian', ''),
(4, 'Catalan', 'ca', 'ca', 0, 0, 'catalan', ''),
(5, 'Czech', 'cs', 'cs', 0, 0, 'czech', ''),
(6, 'Dutch', 'nl', 'nl', 0, 0, 'dutch', ''),
(7, 'English', 'en', 'en', 1, 1, 'english', 'gb.png'),
(8, 'Filipino', 'tl', 'tl', 0, 0, 'filipino', ''),
(9, 'French', 'fr', 'fr', 0, 0, 'french', ''),
(10, 'German', 'de', 'de', 0, 0, 'german', ''),
(11, 'Gujarati', 'gu', 'gu', 0, 0, 'gujarati', ''),
(12, 'Hindi', 'hi', 'hi', 0, 0, 'hindi', ''),
(13, 'Hungarian', 'hu', 'hu', 0, 0, 'hungarian', ''),
(14, 'Indonesian', 'id', 'id', 0, 0, 'indonesian', ''),
(15, 'Italian', 'it', 'it', 0, 0, 'italian', ''),
(16, 'Japanese', 'ja', 'ja', 0, 0, 'japanese', ''),
(17, 'Khmer', 'km', 'km', 0, 0, 'khmer', ''),
(18, 'Korean', 'ko', 'ko', 0, 0, 'korean', ''),
(19, 'Norwegian', 'no', 'no', 0, 0, 'norwegian', ''),
(20, 'Persian', 'fa', 'fa', 0, 0, 'persian', ''),
(21, 'Polish', 'pl', 'pl', 0, 0, 'polish', ''),
(22, 'Portuguese', 'pt', 'pt-PT', 0, 0, 'portuguese', ''),
(23, 'Portuguese (Brazilian)', 'pt', 'pt-BR', 0, 0, 'portuguese-brazilian', ''),
(24, 'Romanian', 'ro', 'ro', 0, 0, 'romanian', ''),
(25, 'Russian', 'ru', 'ru', 0, 0, 'russian', ''),
(26, 'Chinese (Simplified)', 'zh', 'zh-CN', 0, 0, 'simplified-chinese', ''),
(27, 'Spanish', 'es', 'es', 1, 1, 'spanish', 'es.png'),
(28, 'Swedish', 'sv', 'sv', 0, 0, 'swedish', ''),
(29, 'Tamil', 'ta', 'ta', 0, 0, 'tamil', ''),
(30, 'Thai', 'th', 'th', 0, 0, 'thai', ''),
(31, 'Chinese (Traditional)', 'zh', 'zh-TW', 0, 0, 'traditional-chinese', ''),
(32, 'Turkish', 'tr', 'tr', 0, 0, 'turkish', ''),
(33, 'Ukrainian', 'uk', 'uk', 0, 0, 'ukrainian', ''),
(34, 'Vietnamese', 'vi', 'vi', 0, 0, 'vietnamese', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `urls_idiomas`
--

CREATE TABLE `urls_idiomas` (
  `id_url` int(11) UNSIGNED NOT NULL,
  `url_metodo` varchar(250) NOT NULL,
  `id_idioma` int(11) UNSIGNED NOT NULL,
  `url_seo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `urls_idiomas`
--

INSERT INTO `urls_idiomas` (`id_url`, `url_metodo`, `id_idioma`, `url_seo`) VALUES
(1, 'site/about', 7, 'about'),
(2, 'site/about', 27, 'nosotros'),
(3, 'site/contact', 7, 'contact'),
(4, 'site/contact', 27, 'contacto'),
(5, 'site/translate', 7, 'translate'),
(6, 'site/translate', 27, 'traducir'),
(7, 'site/information', 7, 'information'),
(8, 'site/information', 27, 'informacion'),
(9, 'site/legal', 7, 'legal'),
(10, 'site/legal', 27, 'condiciones'),
(11, 'site/home', 7, 'home'),
(12, 'site/home', 27, 'inicio'),
(13, 'site', 7, 'landing'),
(14, 'site', 27, 'landing'),
(15, 'login/login/candidato', 27, 'login/candidato'),
(16, 'login/login/candidato', 7, 'login/candidate'),
(17, 'login/login/empresa', 27, 'login/empresa'),
(18, 'login/login/empresa', 7, 'login/company');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id_config`);

--
-- Indices de la tabla `idiomas`
--
ALTER TABLE `idiomas`
  ADD PRIMARY KEY (`id_idioma`);

--
-- Indices de la tabla `urls_idiomas`
--
ALTER TABLE `urls_idiomas`
  ADD PRIMARY KEY (`id_url`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `config`
--
ALTER TABLE `config`
  MODIFY `id_config` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `idiomas`
--
ALTER TABLE `idiomas`
  MODIFY `id_idioma` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT de la tabla `urls_idiomas`
--