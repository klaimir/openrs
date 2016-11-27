<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
        <title>Starter Template - Materialize</title>

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
            <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Logo</a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="#">Navbar Link</a></li>
                </ul>

                <ul id="nav-mobile" class="side-nav">
                    <li><a href="#">Navbar Link</a></li>
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

            <?php if ($config_template['menu_izquierda'] === 'template') { ?>
                <!-- Page Layout here -->
                <div class="row">

                    <div class="col s12 m3 l2">
                        <!-- Grey navigation panel -->
                        <ul>
                            <li><a href="#">Grey Link1</a></li>
                            <li><a href="#">Grey Link2</a></li>
                        </ul>
                    </div>

                    <div class="col s12 m9 l10">
                        <!-- Teal page content  -->
                        <?php $this->load->view($_view_path, $this->data); ?>
                    </div>
                </div>
            <?php } else { $this->load->view($_view_path, $this->data); } ?>

        </div>

        <footer class="page-footer orange">
            <div class="container">
                <div class="row">
                    <div class="col l7 s12">
                        <h5 class="white-text">Company Bio</h5>
                        <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>
                    </div>
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
                </div>
            </div>
            <?php if ($config_template['mostrar_copyright']) { ?>
            <div class="footer-copyright">
                <div class="container">
                    Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
                </div>
            </div>
            <?php } ?>
        </footer>  

    </body>
</html>