<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
        <title>OPENRS - Login</title>

        <!-- CSS  -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/public/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <!-- <link href="<?php echo base_url(); ?>assets/public/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/> -->

        <!--  Scripts-->
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/public/js/materialize.js"></script>
        <script src="<?php echo base_url(); ?>assets/public/js/init.js"></script>
    </head>
    <body>
        
        <nav class="light-blue lighten-1" role="navigation">
            <div class="nav-wrapper container">
                <a id="logo-container" href="#" class="brand-logo">OPENRS</a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="http://www.openrs.es/documentacion/codigo/html/">Documentación</a></li>
                    <li><a href="https://github.com/klaimir/openrs">Repositorio</a></li>
                </ul>

                <ul id="nav-mobile" class="side-nav">
                    <li><a href="http://www.openrs.es/documentacion/codigo/html/">Documentación</a></li>
                    <li><a href="https://github.com/klaimir/openrs">Repositorio</a></li>
                </ul>
                <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
            </div>
        </nav>
        <?php /*
          <div class="section no-pad-bot" id="index-banner">
          <div class="container">
          <br><br>
          <h1 class="header center orange-text">Starter Template</h1>
          <div class="row center">
          <h5 class="header col s12 light">A modern responsive front-end framework based on Material Design</h5>
          </div>
          <div class="row center">
          <a href="http://materializecss.com/getting-started.html" id="download-button" class="btn-large waves-effect waves-light orange">Get Started</a>
          </div>
          <br><br>

          </div>
          </div>
         * 
         */
        ?>

        <div class="container">

            <?php $this->load->view($_view_path, $this->data); ?>

        </div>

        <footer class="page-footer orange">
            <div class="container">
                <div class="row">
                    <div class="col s12">
                        <h5 class="white-text">Bienvenido a OPENRS¡</h5>
                        <p class="grey-text text-lighten-4">Empieza a disfrutar de las ventajas de usar este software pensado para PYMES inmobiliarias españolas y 
                            define tu web corporativa así como todos los datos necesarios para la gestión de tu negocio.</p>
                    </div>
                    <?php /*
                    <div class="col l2 s12">
                        <h5 class="white-text">Conócenos</h5>
                        <ul>
                            <li><a href="www.marca.com"><img class="responsive-img" height="40px" width="40px" src="<?php echo base_url('assets/public/img/facebook.png'); ?>"></li></a>
                            <li><a href="www.marca.com"><img class="responsive-img" height="40px" width="40px" src="<?php echo base_url('assets/public/img/twitter.png'); ?>"></li></a>
                        </ul>
                    </div>
                    <div class="col l3 s12">
                        <h5 class="white-text">Horario</h5>
                        <p class="white-text">de 9 a 14 y 17 a 20</p>
                        <a class="white-text" href="#!">Facebook</a>
                    </div>
                     * 
                     */
                    ?>
                </div>
            </div>
        </footer>  

    </body>
</html>