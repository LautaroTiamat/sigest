<?php
require '../includes/inc-all.php';
sessionPanelVerify();
userRank();
$pageTitle = $pageStudentList;

$consulta = $conexion->query("SELECT * FROM students S
                              JOIN persons P ON S.person_ID = P.person_ID
                              JOIN careers C ON S.career_ID = C.career_ID
                              ORDER BY S.student_ID");
$students = $consulta->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html dir="ltr" lang="es">
<head>
    <?php include $url.'includes/page/head.php' ?>
    <link href="<?php echo $url ?>assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
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
                                    <li class="breadcrumb-item text-muted active" aria-current="page"><?php echo $pageTitle ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <a href="add-student.php" class="btn btn-info"><?php echo $pageAddStudent; ?></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Lista de alumnos registrados</h4>

                                <div class="table-responsive">
                                    <table id="multi_col_order" class="table table-striped table-bordered display no-wrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre y Apellido</th>
                                                <th>Carrera</th>
                                                <th>Editar</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($students as $student){ ?>
                                            <tr>
                                                <td><?php echo $student->student_ID ?></td>
                                                <td><?php echo $student->person_name.' '.$student->person_lastname ?></td>
                                                <td><?php echo $student->career_name ?></td>
                                                <td><a href="edit-student.php?id=<?php echo $student->student_ID ?>">Editar</a></td>
                                                <td><a href="delete-student.php?id=<?php echo $student->student_ID ?>">Eliminar</a></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include $url.'includes/page/scripts.php' ?>

    <script src="<?php echo $url ?>assets/extra-libs/datatables.net/js/jquery.dataTables.js"></script>
    <script src="<?php echo $url ?>assets/js/pages/datatable/datatable-basic.init.js"></script>
</body>
</html>

