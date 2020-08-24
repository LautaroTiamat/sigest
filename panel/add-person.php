<?php
require '../includes/inc-all.php';
sessionPanelVerify();
userRank();
$pageTitle = $pageAddPerson;

if (!empty($_POST['save'])){
    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $cuil = $_POST["cuil"];
    $birthday = $_POST["birthday"];
    $caracteres = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";

    $validar = ("SELECT COUNT(*) FROM persons WHERE person_name = :name and person_lastname = :lastname and person_cuil = :cuil");
	$sentencia1 = $conexion->prepare($validar);
	$sentencia1->execute(array(":name" => $name, ":lastname" => $lastname, ":cuil" => $cuil));

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
    } else if(!validar_cuil($cuil)){
        $message_alert = '<strong>Error:</strong> CUIL no válido';
        $class = 'danger';
    } else if($birthday == ''){
        $message_alert = '<strong>Error:</strong> Fecha no válida';
        $class = 'danger';
    } else if($birthday == date("Y-m-d") || $birthday > date("Y-m-d")){
        $message_alert = '<strong>Error:</strong> La fecha ingresada no puede ser igual o mayor a la fecha actual';
        $class = 'danger';
    } else {
        if ($sentencia1->fetchColumn() > 0){
            $message_alert = 'La persona ya se ecnuentra registrada';
            $class = 'danger';
        } else {
            $registrar = "INSERT INTO persons(person_name, person_lastname, person_cuil, person_birthday)
                          VALUES (:name,:lastname,:cuil,:birthday)";
            $save = $conexion->prepare($registrar);
            $save->execute(array(":name" => $name,
                                 ":lastname" => $lastname,
                                 ":cuil" => $cuil,
                                 ":birthday" => $birthday));

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
                                    <li class="breadcrumb-item text-muted"><?php echo $pagePersons ?></li>
                                    <li class="breadcrumb-item text-muted"><?php echo $pagePepleList ?></li>
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
                                <h4 class="card-title">Agregar persona</h4>

                                <form method="POST" onsubmit="return addPerson();">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nombres</label>
                                                    <input type="text" id="name" name="name" class="form-control" onKeypress="return validateLetters(event)">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Apellidos</label>
                                                    <input type="text" id="lastname" name="lastname" class="form-control" onKeypress="return validateLetters(event)">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>CUIL</label>
                                                    <input type="text" id="cuil" name="cuil" class="form-control" onKeypress="return validateNumbers(event);">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Fecha de nacimiento</label>
                                                    <input type="date" id="birthday" name="birthday" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="text-right">
                                            <a href="persons.php" class="btn btn-dark">Volver a la lista</a>
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

