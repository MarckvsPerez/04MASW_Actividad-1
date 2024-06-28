<?php
require_once('../../controllers/DirectorsController.php');

$directorDelete = null;
$directorId = isset($_GET['directorId']) ? $_GET['directorId'] : (isset($_POST['directorId']) ? $_POST['directorId'] : null);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirmDelete'])) {
    $directorDelete = deleteDirector($directorId);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar serie</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin-top: 50px;
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
    <?php include('../../router/nav.php'); ?>
    <div class="container">
        <?php if ($directorDelete === null && !isset($_POST['confirmDelete'])) { ?>
            <form method="post" action="delete.php">
                <input type="hidden" name="directorId" value="<?php echo htmlspecialchars($directorId); ?>">
                <div class="mb-3">
                    <p>¿Estás seguro de que deseas eliminar esta serie?</p>
                    <button type="submit" name="confirmDelete" class="btn btn-danger">Confirmar Borrar</button>
                    <a href="list.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        <?php } else { ?>
            <div class="row">
                <?php if ($directorDelete) { ?>
                    <div class="alert alert-success" role="alert">
                        Director borrada correctamente. <br><a href="list.php">Volver al listado de directores</a>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-danger" role="alert">
                        El director no se ha borrado correctamente.<br><a href="list.php">Volver a intentarlo.</a>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

    <!-- Bootstrap JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-+mqSqbWhv4ZBTVhigdqu8cXvSGC0XuZxY0E2vJ+5sCak4Kcckl6Z1N7yXe0zUQ8T" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>