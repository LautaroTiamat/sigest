<?php
require '../includes/inc-all.php';
sessionPanelVerify();
userRank();
$pageTitle = $pagePepleList;

$consulta = $conexion->query("SELECT * FROM persons");
$persons = $consulta->fetchAll(PDO::FETCH_OBJ);
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
                                    <li class="breadcrumb-item text-muted"><?php echo $pagePersons ?></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page"><?php echo $pageTitle ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <a href="add-person.php" class="btn btn-info"><?php echo $pageAddPerson; ?></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Lista de personas registradas</h4>

                                <div class="table-responsive">
                                    <table id="multi_col_order" class="table table-striped table-bordered display no-wrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombres</th>
                                                <th>Apellidos</th>
                                                <th>Edad</th>
                                                <th>CUIL</th>
                                                <th>Editar</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($persons as $person){
                                                $birthday = new DateTime($person->person_birthday);
                                                $today = new DateTime();
                                                $years = $today->diff($birthday);
                                            ?>
                                            <tr>
                                                <td><?php echo $person->person_ID ?></td>
                                                <td><?php echo $person->person_name ?></td>
                                                <td><?php echo $person->person_lastname ?></td>
                                                <td><?php echo $years->y; ?></td>
                                                <td><?php echo $person->person_cuil ?></td>
                                                <td><a href="edit-person.php?id=<?php echo $person->person_ID ?>">Editar</a></td>
                                                <td><a href="delete-person.php?id=<?php echo $person->person_ID ?>">Eliminar</a></td>
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

