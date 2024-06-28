<?php
require_once('../../controllers/ActorsController.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear actor</title>
</head>

<body>
    <?php include('../../router/nav.php'); ?>
    <div class="container">
        <?php
        $sendData = false;
        $actorsCreated = false;
        if (isset($_POST['createBtn'])) {
            $sendData = true;
        }
        if ($sendData) {
            if (isset($_POST['nameActors']) && isset($_POST['surnameActor']) && isset($_POST['birthdayActor']) && isset($_POST['nationalityActor'])) {
                $actorsCreated = storeActor($_POST['nameActors'], $_POST['surnameActor'], $_POST['birthdayActor'], $_POST['nationalityActor']);
            }
        }

        if (!$sendData) {
        ?>
            <div class="row">
                <div class="col-12">
                    <h1>Crear actor</h1>
                </div>
                <div class="col-12">
                    <form name="create_actors" action="" method="POST">
                        <div class="mb-3">
                            <label for="nameActors" class="form-label">Nombre del actor</label>
                            <input id="nameActors" name="nameActors" type="text" placeholder="Introduce el nombre del actor" class="form-control" required />

                            <label for="surnameActor" class="form-label">Apellido del actor</label>
                            <input id="surnameActor" name="surnameActor" type="text" placeholder="Introduce el apellido del actor" class="form-control" required />

                            <label for="birthdayActor" class="form-label">Fecha de nacimiento</label>
                            <input id="birthdayActor" name="birthdayActor" type="date" placeholder="Introduce la fecha de nacimiento del actor" class="form-control" required />

                            <label for="nationalityActor" class="form-label">Nacinoalidad</label>
                            <input id="nationalityActor" name="nationalityActor" type="text" placeholder="Introduce la nacionalidad del actor" class="form-control" required />
                        </div>
                        <input type="submit" value="Crear" class="btn btn-primary" name="createBtn" />
                    </form>
                </div>
            </div>
            <?php
        } else {
            if ($actorsCreated) {
            ?>
                <div class="row">
                    <div class="alert alert-success" role="alert">
                        Actor creado correctamente.<br><a href="list.php">Volver al listado de actores.</a>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="row">
                    <div class="alert alert-danger" role="alert">
                        El actor no se ha creado correctamente.<br><a href="create.php">Volver a intentarlo.</a>
                    </div>
                </div>
        <?php
            }
        }
        ?>