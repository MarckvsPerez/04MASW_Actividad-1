<?php
require_once('../../controllers/PlatformController.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar plataforma</title>
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

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
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
        <?php
        $idPlatform = $_GET['id'];
        $platformObject = getPlatform($idPlatform);

        $sendData = false;
        $platformEdited = false;
        if (isset($_POST['editBtn'])) {
            $sendData = true;
        }
        if ($sendData) {
            if (isset($_POST['platformName'])) {
                $platformEdited = updatePlatform($_POST['platformId'], $_POST['platformName']);
            }
        }

        if (!$sendData) {
        ?>

            <div class="row">
                <div class="col-12">
                    <h1>Editar plataforma</h1>
                </div>
                <div class="col-12">
                    <form name="edit_platform" action="" method="POST">
                        <div class="mb-3">
                            <label for="platformName" class="form-label">Nombre plataforma</label>
                            <input id="platformName" name="platformName" type="text" placeholder="Introduce el nombre de la plataforma" class="form-control" required value="<?php if (isset($platformObject)) echo $platformObject->getName(); ?>" />
                        </div>
                        <input type="hidden" name="platformId" value="<?php echo $idPlatform; ?>">
                        <input type="submit" value="Editar" class="btn btn-primary" name="editBtn" />
                    </form>
                </div>
            </div>

            <?php
        } else {
            if ($platformEdited) {
            ?>
                <div class="row">
                    <div class="alert alert-success" role="alert">
                        Plataforma editada correctamente.<br><a href="list.php">Volver al listado de plataformas.</a>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="row">
                    <div class="alert alert-danger" role="alert">
                        La plataforma no se ha editado correctamente.<br><a href="edit.php?id=<?php echo $idPlatform; ?>">Volver a intentarlo.</a>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>

    <!-- Bootstrap JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-+mqSqbWhv4ZBTVhigdqu8cXvSGC0XuZxY0E2vJ+5sCak4Kcckl6Z1N7yXe0zUQ8T" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>