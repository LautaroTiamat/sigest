<?php
require '../includes/inc-all.php';
sessionPanelVerify();
userRank();
$pageTitle = $pageAddStudent;

if (!empty($_POST['save'])){
    $person = $_POST["person"];
    $career = $_POST["career"];

    if(empty($person)){
        $message_alert = '<strong>Error:</strong> Selecciona una persona';
        $class = 'warning';
    } else if(empty($career)){
        $message_alert = '<strong>Error:</strong> Selecciona una carrera';
        $class = 'warning';
    } else {
        $registrar = "INSERT INTO students(person_ID, career_ID) VALUES (:person,:career)";
        $save = $conexion->prepare($registrar);
        $save->execute(array(":person" => $person,
                             ":career" => $career));

        if ($save->rowCount() == 1){
            $message_alert = 'Datos agregados correctamente.';
            $class = 'success';
        } else {
            $message_alert = '<strong>Error:</strong> Algo salió mal.';
            $class = 'danger';
        }
    }
}

$sql = $conexion->query("SELECT * FROM persons P WHERE P.person_ID NOT IN (SELECT S.person_ID FROM students S)");
$students = $sql->fetchAll(PDO::FETCH_OBJ);

$sql2 = $conexion->query("SELECT * FROM careers");
$careers = $sql2->fetchAll(PDO::FETCH_OBJ);
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
                                    <li class="breadcrumb-item text-muted"><?php echo $pageStudents ?></li>
                                    <li class="breadcrumb-item text-muted"><?php echo $pageStudentList ?></li>
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
                        <div class="card">
                            <div class="card-body collapse show">
                                <h4 class="card-title">Agregar alumno</h4>

                                <form method="POST">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Seleccionar persona</label>
                                                    <select class="custom-select mr-sm-2" id="person" name="person">
                                                        <?php foreach($students as $student){ ?>
                                                            <option value="<?php echo $student->person_ID ?>"><?php echo $student->person_name ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Seleccionar carrera</label>
                                                    <select class="custom-select mr-sm-2" id="career" name="career">
                                                        <?php foreach($careers as $career){ ?>
                                                            <option value="<?php echo $career->career_ID ?>"><?php echo $career->career_name ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="text-right">
                                            <a href="students.php" class="btn btn-dark">Volver a la lista</a>
                                            <input type="submit" class="btn btn-info" name="save" value="Agregar alumno">
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
    
</body>
</html>

