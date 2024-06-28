<?php
require_once('../../controllers/DirectorsController.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear director</title>
</head>

<body>
    <?php include('../../router/nav.php'); ?>
    <div class="container">
        <?php
        $sendData = isset($_POST['createBtn']);
        $directorsCreated = false;

        if ($sendData) {
            if (isset($_POST['nameDirectors'], $_POST['surnameDirectors'], $_POST['birthdayDirectors'], $_POST['nationalityDirectors'])) {
                $directorsCreated = storeDirector($_POST['nameDirectors'], $_POST['surnameDirectors'], $_POST['birthdayDirectors'], $_POST['nationalityDirectors']);
            }
        }

        if (!$sendData) {
        ?>
            <div class="row">
                <div class="col-12">
                    <h1>Crear director</h1>
                </div>
                <div class="col-12">
                    <form name="create_directors" action="" method="POST">
                        <div class="mb-3">
                            <label for="nameDirectors" class="form-label">Nombre del director</label>
                            <input id="nameDirectors" name="nameDirectors" type="text" placeholder="Introduce el nombre del director" class="form-control" required />

                            <label for="surnameDirectors" class="form-label">Apellido del director</label>
                            <input id="surnameDirectors" name="surnameDirectors" type="text" placeholder="Introduce el apellido del director" class="form-control" required />

                            <label for="birthdayDirectors" class="form-label">Fecha de nacimiento</label>
                            <input id="birthdayDirectors" name="birthdayDirectors" type="date" placeholder="Introduce la fecha de nacimiento del director" class="form-control" required />

                            <label for="nationalityDirectors" class="form-label">Nacionalidad</label>
                            <input id="nationalityDirectors" name="nationalityDirectors" type="text" placeholder="Introduce la nacionalidad del director" class="form-control" required />
                        </div>
                        <input type="submit" value="Crear" class="btn btn-primary" name="createBtn" />
                    </form>
                </div>
            </div>
        <?php
        } else {
            if ($directorsCreated) {
                echo '<div class="row"><div class="alert alert-success" role="alert">Director creado correctamente.<br><a href="list.php">Volver al listado de directores.</a></div></div>';
            } else {
                echo '<div class="row"><div class="alert alert-danger" role="alert">El director no se ha creado correctamente.<br><a href="create.php">Volver a intentarlo.</a></div></div>';
            }
        }
        ?>
    </div>
</body>

</html>