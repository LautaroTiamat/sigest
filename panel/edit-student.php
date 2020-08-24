<?php
require '../includes/inc-all.php';
sessionPanelVerify();
userRank();
$pageTitle = $pageEditStudent;

$id = $_GET["id"];

if (!empty($_POST['save'])){
    $career = $_POST["career"];

    if(empty($career)){
        $message_alert = '<strong>Error:</strong> Selecciona una carrera';
        $class = 'warning';
    } else {
        $sql = $conexion->prepare("UPDATE students SET career_ID = ? WHERE student_ID = ?");
        $save = $sql->execute([$career, $id]);
        
        if($save === TRUE){
            $message_alert = 'Cambios guardados correctamente';
            $class = 'success';
        } else {
            $message_alert = '<strong>Error:</strong> Algo salió mal. Por favor verifica que la tabla exista, así como el ID del usuario';
            $class = 'danger';
        }
    }
}

$consulta = $conexion->prepare("SELECT * FROM students S
                                JOIN persons P ON S.person_ID = P.person_ID
                                JOIN careers C ON S.career_ID = C.career_ID
                                WHERE S.student_ID = ?");
$consulta->execute([$id]);
$student = $consulta->fetch(PDO::FETCH_OBJ);

$sql = $conexion->query("SELECT * FROM careers");
$careers = $sql->fetchAll(PDO::FETCH_OBJ);
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
                    <h4>Editar alumno: <?php echo $student->person_lastname.' '.$student->person_name; ?></h4>
                        <div class="card">
                            <div class="card-body collapse show">
                                <form method="POST">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Seleccionar carrera</label>
                                                    <select class="custom-select mr-sm-2" id="career" name="career">
                                                        <?php foreach($careers as $career){ ?>
                                                            <option value="<?php echo $career->career_ID ?>" <?php if($career->career_ID == $student->career_ID){ echo 'selected'; } ?>><?php echo $career->career_name ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="text-right">
                                            <input type="submit" class="btn btn-info" name="save" value="Guardar cambios">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="text-right">
                            <a href="students.php" class="btn btn-dark">Volver a la lista</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include '../includes/page/scripts.php' ?>
    
</body>
</html>

