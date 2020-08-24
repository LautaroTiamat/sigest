<?php
require '../includes/inc-all.php';
sessionPanelVerify();
userRank();
$pageTitle = $pageAddUser;

if (!empty($_POST['save'])){
    $person = $_POST["person"];
    $email = $_POST["email"];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $passwordEnctrypt = md5($password);
    
    $validar = ("SELECT COUNT(*) FROM users WHERE user_email = :email");
	$sentencia1 = $conexion->prepare($validar);
	$sentencia1->execute(array(":email" => $email));

    if(empty($person)){
        $message_alert = '<strong>Error:</strong> El nombre no puede estar vacío';
        $class = 'warning';
    } else if(empty($email)){
        $message_alert = '<strong>Error:</strong> Ingrese un email';
        $class = 'warning';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $message_alert = '<strong>Error:</strong> Dirección de email no válida';
        $class = 'warning';
    } else if(empty($password)){
        $message_alert = '<strong>Error:</strong> Ingrese una contraseña';
        $class = 'warning';
    } else if($password !== $repassword){
        $message_alert = '<strong>Error:</strong> Las contraseñas no coinciden';
        $class = 'warning';
    } else {
        if ($sentencia1->fetchColumn() > 0){
            $message_alert = 'El email ya se encuentra registrado';
            $class = 'danger';
        } else {
            $registrar = "INSERT INTO users(person_ID, user_email, user_password)
                        VALUES (:person,:email,:password)";
            $save = $conexion->prepare($registrar);
            $save->execute(array(":person" => $person,
                                ":email" => $email,
                                ":password" => $passwordEnctrypt));

            if ($save->rowCount() == 1){
                    $message_alert = 'Datos agregados correctamente.';
                    $class = 'success';
            } else {
                    $message_alert = '<strong>Error:</strong> Algo salió mal.';
                    $class = 'danger';
            }
        }
    }
}

$sql = $conexion->query("SELECT * FROM persons P WHERE P.person_ID NOT IN (SELECT U.person_ID FROM users U)");
$persons = $sql->fetchAll(PDO::FETCH_OBJ);
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

                <div id="alert"></div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body collapse show">
                                <h4 class="card-title">Agregar usuario</h4>

                                <form method="POST" onsubmit="return addUser();">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Seleccionar persona</label>
                                                    <select class="custom-select mr-sm-2" id="person" name="person">
                                                        <?php foreach($persons as $person){ ?>
                                                            <option value="<?php echo $person->person_ID ?>"><?php echo $person->person_name ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" id="email" name="email" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Contraseña</label>
                                                    <input type="password" id="password" name="password" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Repetir contraseña</label>
                                                    <input type="password" id="repassword" name="repassword" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="text-right">
                                            <a href="users.php" class="btn btn-dark">Volver a la lista</a>
                                            <input type="submit" class="btn btn-info" name="save" value="Agregar usuario">
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
    
    <?php include '../includes/page/scripts.php' ?>
    <script src="<?php echo $url ?>assets/js/validate-form.js"></script>
    
</body>
</html>

