<?php
     require_once '../functions/helpers.php';
     require_once '../functions/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bit Blog Panel</title>
    <link rel="stylesheet" href="<?= asset('assets/css/bootstrap.min.css') ?>" media="all" type="text/css">
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>" media="all" type="text/css">
</head>
<body>
<section id="app">

     <?php require_once 'layouts/top-nav.php'; ?>

    <section class="container-fluid">
        <section class="row">
            <section class="col-md-2 p-0">

            <?php require_once 'layouts/sidebar.php'; ?>

            </section>
            <section class="col-md-10 pb-3">

                <section style="min-height: 80vh;" class="d-flex justify-content-center align-items-center">
                    <section>
                        <h1>¡Bienvenidos al emocionante mundo de nuestro blog!</h1>  
                        <br>
                        <h5>

Sumérgete en un viaje lleno de conocimiento, inspiración y entretenimiento mientras exploramos una amplia gama de temas fascinantes. Desde consejos prácticos hasta reflexiones profundas, nuestro blog está diseñado para enriquecer tu mente, inspirar tu espíritu y nutrir tu curiosidad.</h5>
                    </section>
                </section>

            </section>
        </section>
    </section>


</section>

<script src="<?= asset('assets/js/jquery.min.js') ?>"></script>
<script src="<?= asset('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>