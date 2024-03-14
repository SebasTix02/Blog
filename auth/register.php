<?php
require_once '../functions/helpers.php';
require_once '../functions/pdo_connection.php';

$error = '';

if (
    isset($_POST['email']) && $_POST['email'] !== '' &&
    isset($_POST['first_name']) && $_POST['first_name'] !== '' &&
    isset($_POST['last_name']) && $_POST['last_name'] !== '' &&
    isset($_POST['password']) && $_POST['password'] !== '' &&
    isset($_POST['confirm']) && $_POST['confirm'] !== ''
) {

    if ($_POST['password'] === $_POST['confirm']) {
        if (strlen($_POST['password']) > 5) {
            $query = "SELECT * FROM users WHERE email = ?;";
            $statement = $pdo->prepare($query);
            $statement->execute([$_POST['email']]);
            $user = $statement->fetch();
            if ($user === false) {
                $query = "INSERT INTO users SET email = ?, first_name = ?, last_name = ?, password = ?, created_at = NOW() ;";
                $statement = $pdo->prepare($query);
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $statement->execute([$_POST['email'], $_POST['first_name'], $_POST['last_name'], $password]);
                redirect('auth/login.php');
            } else {
                $error = 'Este correo electrónico ya existe';
            }
        } else {
            $error = 'La contraseña debe tener más de 5 caracteres';
        }
    } else {
        $error = 'La contraseña no coincide con el certificado';
    }
} else {
    if (!empty($_POST)) {
        $error = 'Todos los campos son obligatorios';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog</title>
    <link rel="stylesheet" href="<?= asset('assets/css/bootstrap.min.css') ?>" media="all" type="text/css">
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>" media="all" type="text/css">
    <style>
        body {
            background-image: url('https://cdn.pixabay.com/photo/2018/04/13/11/17/paper-3316268_640.jpg'); /* URL de la imagen de fondo */
        background-size: cover;
        background-position: center;
            font-family: Arial, sans-serif;
        }

        .register-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .register-container h1 {
            color: #495057;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-control {
            margin-bottom: 15px;
            border-radius: 3px;
        }

        .btn-register {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-register:hover {
            background-color: #0056b3;
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
        }

        .login-link a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .login-link a:hover {
            color: #0056b3;
        }

        .error-message {
            color: red;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <h1>Registro</h1>
        <section class="error-message"><?= $error ?></section>
        <form action="<?= url('auth/register.php') ?>" method="post">
            <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Correo electrónico">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Nombre">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Apellido">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="confirm" id="confirm" placeholder="Confirmar contraseña">
            </div>
            <button type="submit" class="btn btn-register btn-block">Registrarse</button>
        </form>
        <div class="login-link">
            <a href="<?= url('auth/login.php') ?>">Iniciar sesión</a>
        </div>
    </div>

    <script src="<?= asset('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= asset('assets/js/bootstrap.min.js') ?>"></script>
</body>

</html>
