<?php
require '../../includes/inc-all.php';
$url = '../../';
$urlPages = '../';
sessionPanelVerify();
$pageTitle = $profileSettings;

if (!empty($_POST['save-dp'])){
    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $cuil = $_POST["cuil"];
    $birthday = $_POST["birthday"];
    $caracteres = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";

    if(empty($name)){
        $message_alert = '<strong>Error:</strong> El nombre no puede estar vacío';
        $class = 'warning';
    } else if(!preg_match($caracteres, $name)){
        $message_alert = '<strong>Error:</strong> Nombre no válido';
        $class = 'warning';
    } else if(empty($lastname)){
        $message_alert = '<strong>Error:</strong> El apellido no puede estar vacío';
        $class = 'warning';
    } else if(!preg_match($caracteres, $lastname)){
        $message_alert = '<strong>Error:</strong> Apellido no válido';
        $class = 'warning';
    } else if(empty($cuil)){
        $message_alert = '<strong>Error:</strong> El CUIL no puede estar vacío';
        $class = 'warning';
    } else if(!validar_cuil($cuil) || $cuil == '00000000000'){
        $message_alert = '<strong>Error:</strong> CUIL no válido';
        $class = 'warning';
    } else if($birthday == ''){
        $message_alert = '<strong>Error:</strong> Fecha no válida';
        $class = 'danger';
    } else if($birthday == date("Y-m-d") || $birthday > date("Y-m-d")){
        $message_alert = '<strong>Error:</strong> La fecha ingresada no puede ser mayor o igual a la fecha actual';
        $class = 'danger';
    } else {
        $sql = $conexion->prepare("UPDATE persons SET person_name = ?, person_lastname = ?, person_cuil = ?, person_birthday = ? WHERE person_ID = ?");
        $save = $sql->execute([$name, $lastname, $cuil, $birthday, $_SESSION['person_ID']]);
        
        if($save === TRUE){
            $_SESSION['name'] = $name;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['cuil'] = $cuil;
            $_SESSION['birthday'] = $birthday;

            $message_alert = 'Cambios guardados correctamente';
            $class = 'success';
        } else {
            $message_alert = '<strong>Error:</strong> Algo salió mal. Por favor verifica que la tabla exista, así como el ID del usuario';
            $class = 'danger';
        }
    }
}

if (!empty($_POST['save-da'])){
    $email = $_POST["email"];

    if(empty($email)){
        $message_alert1 = '<strong>Error:</strong> El email no puede estar vacío';
        $class = 'warning';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $message_alert1 = '<strong>Error:</strong> Dirección de email no válida';
        $class = 'warning';
    } else {
        $sql = $conexion->prepare("UPDATE users SET user_email = ? WHERE user_ID = ?");
        $save = $sql->execute([$email, $_SESSION['person_ID']]);
        
        if($save === TRUE){
            $_SESSION['email'] = $email;

            $message_alert1 = 'Cambios guardados correctamente';
            $class = 'success';
        } else {
            $message_alert1 = '<strong>Error:</strong> Algo salió mal. Por favor verifica que la tabla exista, así como el ID del usuario';
            $class = 'danger';
        }
    }
}

if (!empty($_POST['save-pw'])){
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
        $save = $sql->execute([$passwordEnctrypt, $_SESSION['person_ID']]);
        
        if($save === TRUE){
            $_SESSION['password'] = $passwordEnctrypt;
            
            $message_alert2 = 'Cambios guardados correctamente';
            $class = 'success';
        } else {
            $message_alert2 = '<strong>Error:</strong> Algo salió mal. Por favor verifica que la tabla exista, así como el ID del usuario';
            $class = 'danger';
        }
    }
}

$consulta1 = $conexion->prepare("SELECT * FROM persons WHERE person_ID = ?");
$consulta1->execute([$_SESSION['person_ID']]);
$person = $consulta1->fetch(PDO::FETCH_OBJ);

$consulta2 = $conexion->prepare("SELECT * FROM users U
                                JOIN persons P ON U.person_ID = P.person_ID
                                WHERE U.person_ID = ?");
$consulta2->execute([$_SESSION['person_ID']]);
$user = $consulta2->fetch(PDO::FETCH_OBJ);
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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">
                            <?php echo $pageTitle ?>
                        </h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item">
                                        <?php echo $_SESSION['lastname'].' '.$_SESSION['name'] ?>
                                    </li>
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

                <div id="alert"></div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body collapse show">
                                <h4 class="card-title">Datos personales</h4>

                                <form method="POST" onsubmit="return editPerson();">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nombres</label>
                                                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $person->person_name ?>" onKeypress="return validateLetters(event)">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Apellidos</label>
                                                    <input type="text" id="lastname" name="lastname" class="form-control" value="<?php echo $person->person_lastname ?>" onKeypress="return validateLetters(event)">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>CUIL</label>
                                                    <input type="text" id="cuil" name="cuil" class="form-control" value="<?php echo $person->person_cuil ?>" onKeypress="return validateNumbers(event);">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Fecha de nacimiento</label>
                                                    <input type="date" id="birthday" name="birthday" class="form-control" value="<?php echo $person->person_birthday ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="text-right">
                                            <input type="submit" class="btn btn-info" name="save-dp" value="Guardar">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <?php if ($message_alert1 !== "") { ?>
                            <div class="alert alert-<?php echo $class ?> alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <?php echo $message_alert1 ?>
                            </div>
                        <?php } ?>

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
                                            <input type="submit" class="btn btn-info" name="save-da" value="Guardar email">
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
                                <h4 class="card-title">Cambiar contraseña</h4>
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

                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php include $url.'includes/page/scripts.php' ?>
    <script src="<?php echo $url ?>assets/js/validate-form.js"></script>
</body>
</html>

