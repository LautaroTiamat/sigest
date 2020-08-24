<?php
require 'includes/inc-all.php';
$url = '';
$pageTitle = 'Inicio';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $url ?>assets/img/logo.png" />
    <title><?php echo $pageName; ?> - <?php echo $pageTitle; ?></title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="<?php echo $url ?>assets/css/materialize.min.css"  media="screen,projection"/>
</head>
<body>
	<div class="parallax-container">
        <nav class="navopacity" role="navigation">
            <div class="nav-wrapper container">
                <img src="<?php echo $url ?>assets/img/logo.png" class="imglogo" alt="Logo">
                <!-- Vista del menú en versión escritorio  -->
                <ul class="right hide-on-med-and-down">
                    <li><a href="<?php echo $url ?>index.php">Inicio</a></li>
                    <li><a href="#">Ayuda</a></li>
					<?php if(isset($_SESSION["logged_in"])){ ?>
						<li><a href="<?php echo $url ?>panel/index.php">Panel</a></li>
						<li><a href="<?php echo $url ?>logout.php">Salir</a></li>
					<?php } else { ?>
						<li><a href="<?php echo $url ?>login.php">Iniciar Sesión</a></li>
					<?php } ?>
                </ul>
                <!-- Vista del menú en versión móvil  -->
                <ul id="nav-mobile" class="sidenav">
                        <li><a class="subheader">Menú</a></li>
                        <li><a class="waves-effect" href="<?php echo $url ?>index.php"><i class="material-icons">home</i>Inicio</a></li>
                        <li><a class="waves-effect" href="#"><i class="material-icons">help</i>Ayuda</a></li>
						<?php if(!isset($_SESSION["logged_in"])){ ?>
							<li><a href="<?php echo $url ?>panel/index.php"><i class="material-icons">school</i>Panel</a></li>
							<li><a href="<?php echo $url ?>logout.php"><i class="material-icons">call_missed_outgoing</i>Salir</a></li>
						<?php } else { ?>
							<li><a href="<?php echo $url ?>login.php"><i class="material-icons">person</i>Iniciar Sesión</a></li>
						<?php } ?>
                </ul>
                <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            </div>
        </nav>
		<h1 class="center orange-text"><b>Instituto Politécnico Formosa</b></h1>
        <div class="parallax"><img class="oscurecerimg" src="assets/img/index1.jpg"></div>
    </div>
	
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <h1 class="center orange-text">Instituciones</h1>
            <div class="row">
                <div class="col s12 l6">
                    <div class="card hoverable">
                        <div class="card-image">
                            <img class="oscurecerimg" src="assets/img/index2.jpg">
                            <span class="card-title"><h6>P.C.T. & I.</h6></span>
                            <a class="btn-floating halfway-fab waves-effect waves-light red modal-trigger pulse" href="#modal1"><i class="material-icons">play_arrow</i></a>
                        </div>

                        <!-- Modal -->
                        <div id="modal1" class="modal">
                            <div class="modal-content">
                                <div class="video-container">
                                    <iframe width="auto" height="auto" src="https://www.youtube.com/embed/3w9KHft7Nyk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
                            </div>
                        </div>
                        <!-- FIN: Modal -->

                        <div class="card-content">
                            <p>Polo Científico Tecnológico y de Innovación</p>
                        </div>
                    </div>
                </div>

                <div class="col s12 l6">
                    <div class="card hoverable">
                        <div class="card-image">
                            <img class="oscurecerimg" src="assets/img/index3.jpg">
                            <span class="card-title"><h6>E.P.E.T. N°1</h6></span>
                            <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">play_arrow</i></a>
                        </div>
                        <div class="card-content">
                            <p>Escuela Pública de Educación Técnica N°1</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h1 class="center orange-text">Carreras</h1>
        <div class="row">
            <div class="col s12 l6">
                <div class="card small hoverable">
                    <div class="card-image waves-effect waves-block waves-light img-zoom">
                        <img class="activator" src="assets/img/index5.jpg">
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4"><h6>Mecatrónica</h6><i class="material-icons right">more_vert</i></span>
                        <p><a href="#">Más información</a></p>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4"><h6 class="orange-text"><b>Tecnicatura Superior en Mecatrónica</b></h6><i class="material-icons right">close</i></span>
                        <p>La carrera tiene una duracion de tres años, con el reconocimiento provincial del Ministerio de Cultura y Educación de la Provincia de Formosa.</p>
                    </div>
                </div>
            </div>

            <div class="col s12 l6">
                <div class="card small hoverable">
                    <div class="card-image waves-effect waves-block waves-light img-zoom">
                        <img class="activator" src="assets/img/index6.png">
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4"><h6>Programación</h6><i class="material-icons right">more_vert</i></span>
                        <p><a href="#">Más información</a></p>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4"><h6 class="orange-text"><b>Especialista en Desarrollo de Software</b></h6><i class="material-icons right">close</i></span>
                        <p>La carrera tiene una duracion de un año, con el reconocimiento provincial del Ministerio de Cultura y Educación de la Provincia de Formosa.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="parallax-container">
        <div class="parallax"><img class="oscurecerimg" src="assets/img/index4.jpg"></div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col s12 l6"><br></br>
                <div class="slider">
                    <ul class="slides">
                        <li>
                            <img class="oscurecerimg" src="assets/img/index1.jpg">
                            <div class="caption center-align">
                                <h3>¡Texto 1!</h3>
                                <h5 class="light grey-text text-lighten-3">Descripción 1.</h5>
                            </div>
                        </li>
                        <li>
                            <img class="oscurecerimg" src="assets/img/index2.jpg">
                            <div class="caption center-align">
                                <h3>¡Texto 2!</h3>
                                <h5 class="light grey-text text-lighten-3">Descripción 2.</h5>
                            </div>
                        </li>
                        <li>
                            <img class="oscurecerimg" src="assets/img/index3.jpg">
                            <div class="caption center-align">
                                <h3>¡Texto 3!</h3>
                                <h5 class="light grey-text text-lighten-3">Descripción 3.</h5>
                            </div>
                        </li>
                        <li>
                            <img class="oscurecerimg" src="assets/img/index4.jpg">
                            <div class="caption center-align">
                                <h3>¡Texto 4!</h3>
                                <h5 class="light grey-text text-lighten-3">Descripción 4.</h5>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col s12 l6">
                <h1 class="center orange-text">Autoridades</h1>
                <ul class="collection card hoverable">
                    <li class="collection-item avatar">
                        <img src="https://materializecss.com/images/yuna.jpg" alt="" class="circle">
                        <span class="title orange-text"><b>Director</b></span>
                        <p>Ing. Rubén Oscar Fernández</p>
                        <i class="material-icons secondary-content">grade</i>
                    </li>
                    <li class="collection-item avatar">
                        <img src="https://materializecss.com/images/yuna.jpg" alt="" class="circle">
                        <span class="title orange-text"><b>Directora de Carreras</b></span>
                        <p>Dra. Alicia Noemí Alcaraz</p>
                        <i class="material-icons secondary-content">grade</i>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <footer class="page-footer green darken-4">
		<div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Instituto Politécnico Formosa</h5>
                    <p class="grey-text text-lighten-4">Organismo Descentralizado de la Administración Pública, relacionado con el poder ejecutivo a través del Ministerio de Cultura y Educación de la Provincia de Formosa establecido en el Decreto Nº 18 del 2018.</p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Contacto</h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3" href="mailto:info@ipf.edu.ar">info@ipf.edu.ar</a></li>
                        <li>Formosa Capital</li>
                        <li>J.M. Uriburu 820 - 1° Piso - Oficina B</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">© IPF 2018 - 2020
            <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="<?php echo $url ?>assets/js/materialize.min.js"></script>
    <script src="<?php echo $url ?>assets/js/init.js"></script>

</body>
</html>
