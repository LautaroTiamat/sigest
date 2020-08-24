<?php
require '../includes/inc-all.php';
sessionPanelVerify();
userRank();
$pageTitle = $pageDeleteStudent;

$id = $_GET["id"];

if(isset($_POST['delete'])){
    $name = $_POST['name'];
    $career = $_POST['career'];

    $sentencia = $conexion->prepare("DELETE FROM students WHERE student_ID = ?");
    $eliminar = $sentencia->execute([$id]);
} else {
    $sentencia = $conexion->prepare("SELECT * FROM students A
                                    JOIN persons P ON P.person_ID = A.person_ID
                                    JOIN careers C ON C.career_ID = A.career_ID
                                    WHERE A.student_ID = ?");
    $sentencia->execute([$id]);
    $eliminar = $sentencia->fetch(PDO::FETCH_OBJ);
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

                <?php if(isset($_POST['delete'])){ ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    ¡Alumno eliminado con éxito!
                </div>
                <?php } else { ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body collapse show">
                                <form method="POST">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    ¿Está seguro que desea eliminar al alumno "<?php echo $eliminar->person_lastname.' '.$eliminar->person_name ?>" de la carrera "<?php echo $eliminar->career_name ?>"?
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <input name="name" value="<?php echo $eliminar->person_lastname.' '.$eliminar->person_name; ?>" hidden></input>
                                    <input name="career" value="<?php echo $eliminar->career_name; ?>" hidden></input>

                                    <div class="form-actions">
                                        <div class="text-right">
                                            <input type="submit" class="btn btn-info" name="delete" value="Sí, eliminar">
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
                <?php } ?>
            </div>
        </div>
    </div>
    
    <?php include '../includes/page/scripts.php' ?>
    
</body>
</html>

