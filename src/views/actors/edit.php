<?php
require_once('../../controllers/ActorsController.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar actor</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin-top: 50px;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php include('../../router/nav.php'); ?>
    <div class="container">
        <?php
        $idActor = $_GET['id'];
        $actorObject = getActor($idActor);

        $sendData = isset($_POST['editBtn']);
        $actorEdited = false;
        if ($sendData) {
            if (isset($_POST['nameActors'], $_POST['surnameActor'], $_POST['birthdayActor'], $_POST['nationalityActor'])) {
                $actorEdited = updateActor($_POST['actorId'], $_POST['nameActors'], $_POST['surnameActor'], $_POST['birthdayActor'], $_POST['nationalityActor']);
            }
        }

        if (!$sendData) {
        ?>
            <div class="row">
                <div class="col-12">
                    <h1>Editar actor</h1>
                </div>
                <div class="col-12">
                    <form name="edit_actors" action="" method="POST">
                        <div class="mb-3">
                            <label for="nameActors" class="form-label">Nombre del actor</label>
                            <input id="nameActors" name="nameActors" type="text" placeholder="Introduce el nombre del actor" class="form-control" required value="<?php echo $actorObject->getName(); ?>" />

                            <label for="surnameActor" class="form-label">Apellido del actor</label>
                            <input id="surnameActor" name="surnameActor" type="text" placeholder="Introduce el apellido del actor" class="form-control" required value="<?php echo $actorObject->getSurname(); ?>" />

                            <label for="birthdayActor" class="form-label">Fecha de nacimiento</label>
                            <input id="birthdayActor" name="birthdayActor" type="date" placeholder="Introduce la fecha de nacimiento del actor" class="form-control" required value="<?php echo $actorObject->getBirthday(); ?>" />

                            <label for="nationalityActor" class="form-label">Nacionalidad</label>
                            <input id="nationalityActor" name="nationalityActor" type="text" placeholder="Introduce la nacionalidad del actor" class="form-control" required value="<?php echo $actorObject->getNationality(); ?>" />
                        </div>
                        <input type="hidden" name="actorId" value="<?php echo $idActor; ?>">
                        <input type="submit" value="Editar" class="btn btn-primary" name="editBtn" />
                    </form>
                </div>
            </div>
            <?php
        } else {
            if ($actorEdited) {
            ?>
                <div class="row">
                    <div class="alert alert-success" role="alert">
                        Actor editado correctamente.<br><a href="list.php">Volver al listado de actores.</a>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="row">
                    <div class="alert alert-danger" role="alert">
                        El actor no se ha editado correctamente.<br><a href="edit.php?id=<?php echo $idActor; ?>">Volver a intentarlo.</a>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</body>

</html>