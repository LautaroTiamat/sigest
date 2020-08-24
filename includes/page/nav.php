            <nav class="navbar top-navbar navbar-expand-md">
                <div class="navbar-header" data-logobg="skin6">
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>
                            
                    <div class="navbar-brand">
                        <a href="#">
                            <b class="logo-icon">
                                <center>
                                    <img src="<?php echo $url ?>assets/img/logo.png" alt="homepage" class="dark-logo" style="width: 50px; margin-top: 75px;" />
                                </center>
                            </b>
                        </a>
                    </div>

                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti-more"></i>
                    </a>
                </div>

                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
                        
                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link" href="javascript:void(0)">
                                <div class="customize-input">
                                    <select class="custom-select form-control bg-white custom-radius custom-shadow border-0">
                                        <option selected>ES</option>
                                        <option value="1">EN</option>
                                    </select>
                                </div>
                            </a>
                        </li>
                    </ul>

                    <ul class="navbar-nav float-right">

                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link" href="javascript:void(0)">
                                <form>
                                    <div class="customize-input">
                                        <input class="form-control custom-shadow custom-radius border-0 bg-white"
                                            type="search" placeholder="Buscar" aria-label="Buscar">
                                        <i class="form-control-icon" data-feather="search"></i>
                                    </div>
                                </form>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img src="<?php echo $url ?>assets/img/logo.png" alt="user" class="rounded-circle"
                                    width="40">
                                <span class="ml-2 d-none d-lg-inline-block">
                                    <span><?php echo $_SESSION['lastname'].' '.$_SESSION['name'] ?></span>
                                    <i data-feather="chevron-down" class="svg-icon"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <a class="dropdown-item" href="#">
                                    <i data-feather="user" class="svg-icon mr-2 ml-1"></i>
                                    Mi Perfil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i data-feather="mail" class="svg-icon mr-2 ml-1"></i>
                                    Mensajes
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo $urlPages ?>profile/profile-config.php">
                                    <i data-feather="settings" class="svg-icon mr-2 ml-1"></i>
                                    Configuraciones
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php">
                                    <i data-feather="power" class="svg-icon mr-2 ml-1"></i>
                                    Cerrar Sesión
                                </a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>