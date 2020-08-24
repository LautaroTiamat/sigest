<?php
require '../includes/inc-all.php';
sessionPanelVerify();
userRank();
$pageTitle = $pageEditUser;

$id = $_GET["id"];

if (!empty($_POST['save'])){
    $email = $_POST["email"];

    if(empty($email)){
        $message_alert = '<strong>Error:</strong> El email no puede estar vacío';
        $class = 'warning';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $message_alert = '<strong>Error:</strong> Dirección de email no válida';
        $class = 'warning';
    } else {
        $sql = $conexion->prepare("UPDATE users SET user_email = ? WHERE user_ID = ?");
        $save = $sql->execute([$email, $id]);
        
        if($save === TRUE){
            $message_alert = 'Cambios guardados correctamente';
            $class = 'success';
        } else {
            $message_alert = '<strong>Error:</strong> Algo salió mal. Por favor verifica que la tabla exista, así como el ID del usuario';
            $class = 'danger';
        }
    }
}

if (!empty($_POST['save2'])){
    $password = $_POST["password"];
    $repassword = $_POST["repassword"];

    if(empty($password)){
        $message_alert2 = '<strong>Error:</strong> La contraseña no puede estar vacía';
        $class = 'warning';
    } else if($password !== $repassword){
        $message_alert2 = '<strong>Error:</strong> Las contraseñas no coinciden';
        $class = 'warning';
    } else {
        $passwordEnctrypt = md5($password);
        $sql = $conexion->prepare("UPDATE users SET user_password = ? WHERE user_ID = ?");
        $save = $sql->execute([$passwordEnctrypt, $id]);
        
        if($save === TRUE){
            $message_alert2 = 'Cambios guardados correctamente';
            $class = 'success';
        } else {
            $message_alert2 = '<strong>Error:</strong> Algo salió mal. Por favor verifica que la tabla exista, así como el ID del usuario';
            $class = 'danger';
        }
    }
}

$consulta = $conexion->prepare("SELECT * FROM users U
                                JOIN persons P ON U.person_ID = P.person_ID
                                WHERE U.user_ID = ?");
$consulta->execute([$id]);
$user = $consulta->fetch(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html dir="ltr" lang="es">
<head>
    <?php include $url.'includes/page/head.php' ?>
</head>
<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin6">
            <?php include $url.'includes/page/nav.php' ?>
        </header>
    
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <?php include $url.'includes/page/menu.php' ?>
        </aside>

        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1"><?php echo $pageTitle ?></h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item text-muted"><?php echo $pageUsers ?></li>
                                    <li class="breadcrumb-item text-muted"><?php echo $pageUserList ?></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page"><?php echo $pageTitle ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">

                <?php if ($message_alert !== "") { ?>
                    <div class="alert alert-<?php echo $class ?> alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <?php echo $message_alert ?>
                    </div>
                <?php } ?>

                <div class="row">
                    <div class="col-12">
                    <h4>Editar datos de usuario para: <?php echo $user->person_lastname.' '.$user->person_name; ?></h4>
                        <div id="alert1"></div>
                        <div class="card">
                            <div class="card-body collapse show">
                                <form method="POST" onsubmit="return editUser1();">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" id="email" name="email" class="form-control" value="<?php echo $user->user_email ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="text-right">
                                            <input type="submit" class="btn btn-info" name="save" value="Guardar email">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <?php if ($message_alert2 !== "") { ?>
                            <div class="alert alert-<?php echo $class ?> alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <?php echo $message_alert2 ?>
                            </div>
                        <?php } ?>

                        <div id="alert2"></div>

                        <div class="card">
                            <div class="card-body collapse show">
                                <form method="POST" onsubmit="return editUser2();">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nueva contraseña</label>
                                                    <input type="text" id="password" name="password" class="form-control" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Repetir nueva contraseña</label>
                                                    <input type="text" id="repassword" name="repassword" class="form-control" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="text-right">
                                            <input type="submit" class="btn btn-info" name="save2" value="Guardar contraseña">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="text-right">
                            <a href="users.php" class="btn btn-dark">Volver a la lista</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include '../includes/page/scripts.php' ?>
    <script src="<?php echo $url ?>assets/js/validate-form.js"></script>
</body>
</html>

