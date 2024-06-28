<?php
    require_once('../../controllers/SeriesController.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de series</title>
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
            background-color: #343a40; /* Dark Navbar */
        }
        .navbar-brand {
            color: #ffffff; /* White text */
        }
        .nav-link {
            color: #ffffff !important; /* White text */
        }
        .nav-link:hover {
            color: #e9ecef !important; /* Lighter text on hover */
        }
        .card {
            background-color: #ffffff;
            border: 1px solid #ced4da;
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .card-title {
            color: #343a40; /* Dark gray text */
        }
        .card-text {
            color: #6c757d; /* Gray text */
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
                <h1>Listado de series</h1>
            </div>
            <div class="col-6 mb-3">
                <a class="btn btn-primary" href="create.php">+ Crear serie</a>
            </div>
            <div class="col-12">
                <?php
                    $serieList = listSeries();

                    if(count ($serieList) > 0) {
                ?>      
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php
                        foreach($serieList as $serie) {
                    ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo $serie->getTitle(); ?></h5>
                                <p class="card-text">ID: <?php echo $serie->getId(); ?></p>
                                <div class="btn-group" role="group" aria-label="Serie">
                                    <a class="btn btn-success" href="edit.php?id=<?php echo $serie->getId(); ?>">Editar</a>
                                    <form name="delete_serie" action="delete.php" method="POST" style="display: inline;">
                                        <input type="hidden" name="serieId" value="<?php echo $serie->getId(); ?>" />
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
                    Aún no existen series.
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
