<?php
session_start();
require_once '../functions/helpers.php';
require_once '../functions/pdo_connection.php';

$error = '';

if (isset($_POST['email']) && $_POST['email'] !== '' && isset($_POST['password']) && $_POST['password'] !== '') {
    $query = "SELECT * FROM users WHERE email = ?;";
    $statement = $pdo->prepare($query);
    $statement->execute([$_POST['email']]);
    $user = $statement->fetch();

    if ($user !== false) {
        if (password_verify($_POST['password'], $user->password)) {
            $_SESSION['user'] =  $user->email;
            redirect('panel');
        } else {
            $error = 'La contraseña es incorrecta';
        }
    } else {
        $error = 'El correo electrónico no está registrado';
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
        font-family: Arial, sans-serif;
        background-image: url('https://cdn.pixabay.com/photo/2018/04/13/11/17/paper-3316268_640.jpg'); /* URL de la imagen de fondo */
        background-size: cover;
        background-position: center;
        }

        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8); /* Fondo semi-transparente */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-container h1 {
            color: #495057;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-control {
            margin-bottom: 15px;
            border-radius: 3px;
        }

        .btn-login {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-login:hover {
            background-color: #0056b3;
        }

        .register-link {
            text-align: center;
            margin-top: 15px;
        }

        .register-link a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .register-link a:hover {
            color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1>Login</h1>
        <form action="<?= url('auth/login.php') ?>" method="post">
            <?php if ($error !== '') : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $error ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Correo electrónico">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
            </div>
            <button type="submit" class="btn btn-login btn-block">Iniciar sesión</button>
        </form>
        <div class="register-link">
            <a href="<?= url('auth/register.php') ?>">Registrarse</a>
        </div>
    </div>

    <script src="<?= asset('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= asset('assets/js/bootstrap.min.js') ?>"></script>
</body>

</html>
