<?php
require_once('../../controllers/PlatformController.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listado de plataformas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #343a40;
            /* Dark Navbar */
        }

        .navbar-brand {
            color: #ffffff;
            /* White text */
        }

        .nav-link {
            color: #ffffff !important;
            /* White text */
        }

        .nav-link:hover {
            color: #e9ecef !important;
            /* Lighter text on hover */
        }

        .card {
            background-color: #ffffff;
            border: 1px solid #ced4da;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            color: #343a40;
            /* Dark gray text */
        }

        .card-text {
            color: #6c757d;
            /* Gray text */
        }

        .alert-warning {
            background-color: #ffeeba;
            color: #856404;
            border-color: #ffeeba;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php include('../../router/nav.php'); ?>

    <!-- Main content -->
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h1>Listado de plataformas</h1>
            </div>
            <div class="col-6 mb-3">
                <a class="btn btn-primary" href="create.php">+ Crear plataforma</a>
            </div>
            <div class="col-12">
                <?php
                $platformList = listPlatforms();

                if (count($platformList) > 0) {
                ?>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <?php
                        foreach ($platformList as $platform) {
                        ?>
                            <div class="col">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><?php echo $platform->getName(); ?></h5>
                                        <p class="card-text">ID: <?php echo $platform->getId(); ?></p>
                                        <div class="btn" role="group" aria-label="Platform">
                                            <a class="btn btn-success mx-2" href="edit.php?id=<?php echo $platform->getId(); ?>">Editar</a>
                                            <form name="delete_platform" action="delete.php" method="POST" style="display: inline;">
                                                <input type="hidden" name="platformId" value="<?php echo $platform->getId(); ?>" />
                                                <button type="submit" class="btn btn-danger">Borrar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                <?php
                } else {
                ?>
                    <div class="alert alert-warning" role="alert">
                        Aún no existen plataformas.
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-+mqSqbWhv4ZBTVhigdqu8cXvSGC0XuZxY0E2vJ+5sCak4Kcckl6Z1N7yXe0zUQ8T" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>