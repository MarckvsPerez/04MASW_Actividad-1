<?php
require_once('../../controllers/LanguagesController.php');

$languageDeleted = null;
$languageId = isset($_GET['languageId']) ? $_GET['languageId'] : (isset($_POST['languageId']) ? $_POST['languageId'] : null);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirmDelete'])) {
    $languageDeleted = deleteLanguage($languageId);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Borrar plataforma</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 20px;
        }

        .alert {
            margin-top: 20px;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
    </style>
</head>

<body>
    <?php include('../../router/nav.php'); ?>
    <div class="container">
        <?php if ($languageDeleted === null && !isset($_POST['confirmDelete'])) { ?>
            <form method="post" action="delete.php">
                <input type="hidden" name="languageId" value="<?php echo htmlspecialchars($languageId); ?>">
                <p>¿Estás seguro de que deseas eliminar esta idioma?</p>
                <button type="submit" name="confirmDelete" class="btn btn-danger">Confirmar Borrar</button>
                <a href="list.php" class="btn btn-secondary">Cancelar</a>
            </form>
        <?php } else { ?>
            <div class="row">
                <?php if ($languageDeleted === true) { ?>
                    <div class="alert alert-success" role="alert">
                        Idioma borrado correctamente. <br><a href="list.php">Volver al listado de idiomas</a>
                    </div>
                <?php } elseif ($languageDeleted === 'has_series') { ?>
                    <div class="alert alert-danger" role="alert">
                        No se puede borrar el idioma porque tiene una serie asociada. <br><a href="list.php">Volver al listado de idiomas</a>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-danger" role="alert">
                        El idioma no se ha borrado correctamente.<br><a href="list.php">Volver a intentarlo.</a>
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