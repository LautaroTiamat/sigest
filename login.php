<?php
require 'includes/inc-all.php';
sessionVerify();
$url = '';
$pageTitle = 'Iniciar Sesión';

if (!empty($_POST['login'])) {
	$email = $_POST['email'];
    $password = $_POST['password'];
	$passwordEnctrypt = md5($password);

	$stmt = $conexion->prepare("SELECT * FROM users U
                                JOIN persons P ON U.person_ID = P.person_ID
                                WHERE U.user_email = :email and U.user_password = :password");
    $stmt->execute(array(":email" => $email, ":password" => $passwordEnctrypt));
    $data = $stmt->fetch(PDO::FETCH_OBJ);
    
	if (empty($email)){
        $message_alert = 'Ingrese una dirección de email';
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $message_alert = 'Dirección de email no válida';
    } else if (empty($password)){
        $message_alert = 'Ingrese una contraseña';
    } else {
		if ($stmt->rowCount() == 1){
            $_SESSION['person_ID'] = $data->person_ID;
            $_SESSION['user_ID'] = $data->user_ID;
            $_SESSION['logged_in'] = time();
            $_SESSION['rank'] = $data->user_rank;
            $_SESSION['email'] = $data->user_email;
            $_SESSION['password'] = $data->user_password;
            $_SESSION['name'] = $data->person_name;
            $_SESSION['lastname'] = $data->person_lastname;
			
			header ('Location: panel/index.php');
			exit;
		} else {
			$message_alert = 'Email o contraseña inválidos';
		}
	}
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="es">
<head>
    <?php include 'includes/page/head.php' ?>
</head>
<body>
    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>

        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
            style="background:url(assets/images/big/auth-bg.jpg) no-repeat center center;">

            <div class="auth-box row">
                <div class="bg-white">
                    <div class="p-3">
                        <h2 class="mt-3 text-center">Iniciar Sesión</h2>

                        <form class="mt-4" method="POST" onsubmit="return loginValidate();">
                            <div class="row">

                                <div id="alert" class="col-lg-12"></div>

                                <?php if ($message_alert !== "") { ?>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <?php echo $message_alert ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                        
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="email">Email</label>
                                        <input class="form-control" id="email" type="email" name="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="password">Contraseña</label>
                                        <input class="form-control" id="password" type="password" name="password" placeholder="Contraseña">
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <input type="submit" class="btn btn-block btn-info" name="login" value="Ingresar">
                                    <a href="index.php" class="btn btn-block btn-dark">Volver</a>
                                </div>
                            </div>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/libs/jquery/dist/jquery.min.js "></script>
    <script src="assets/libs/popper.js/dist/umd/popper.min.js "></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js "></script>
    <script>
        $(".preloader ").fadeOut();
    </script>
    <script src="<?php echo $url ?>assets/js/validate-form.js"></script>
</body>

</html>