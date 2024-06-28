<?php
require_once('../../controllers/DirectorsController.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar director</title>
</head>

<body>
    <?php include('../../router/nav.php'); ?>
    <div class="container">
        <?php
        $idDirectors = $_GET['id'];
        $directorsObject = getDirector($idDirectors);

        $sendData = false;
        $directorsEdited = false;
        if (isset($_POST['editBtn'])) {
            $sendData = true;
        }
        if ($sendData) {
            if (isset($_POST['nameDirectors'], $_POST['surnameDirectors'], $_POST['birthdayDirectors'], $_POST['nationalityDirectors'])) {
                $directorsEdited = updateDirector($_POST['idDirectors'], $_POST['nameDirectors'], $_POST['surnameDirectors'], $_POST['birthdayDirectors'], $_POST['nationalityDirectors']);
            }
        }

        if (!$sendData) {
        ?>

            <div class="row">
                <div class="col-12">
                    <h1>Editar director</h1>
                </div>
                <div class="col-12">
                    <form name="create_directors" action="" method="POST">
                        <div class="mb-3">
                            <label for="nameDirectors" class="form-label">Nombre del director</label>
                            <input id="nameDirectors" name="nameDirectors" type="text" placeholder="Introduce el nombre del director" class="form-control" required value="<?php if (isset($directorsObject)) echo $directorsObject->getName(); ?>" />

                            <label for="surnameDirectors" class="form-label">Apellido del director</label>
                            <input id="surnameDirectors" name="surnameDirectors" type="text" placeholder="Introduce el apellido del director" class="form-control" required value="<?php if (isset($directorsObject)) echo $directorsObject->getSurname(); ?>" />

                            <label for="birthdayDirectors" class="form-label">Fecha de nacimiento del director</label>
                            <input id="birthdayDirectors" name="birthdayDirectors" type="date" placeholder="Introduce la fecha de nacimiento del director" class="form-control" required value="<?php if (isset($directorsObject)) echo $directorsObject->getBirthday(); ?>" />

                            <label for="nationalityDirectors" class="form-label">Nacinoalidad del director</label>
                            <input id="nationalityDirectors" name="nationalityDirectors" type="text" placeholder="Introduce la nacionalidad del director" class="form-control" required value="<?php if (isset($directorsObject)) echo $directorsObject->getNationality(); ?>" />
                        </div>
                        <input type="hidden" name="idDirectors" value="<?php echo $idDirectors; ?>">
                        <input type="submit" value="Editar" class="btn btn-primary" name="editBtn" />
                    </form>
                </div>
            </div>

            <?php
        } else {
            if ($directorsEdited) {
            ?>
                <div class="row">
                    <div class="alert alert-success" role="alert">
                        Director editado correctamente.<br><a href="list.php">Volver al listado de directores.</a>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="row">
                    <div class="alert alert-danger" role="alert">
                        El director no se ha editado correctamente.<br><a href="edit.php?id=<?php echo $idDirectors; ?>">Volver a intentarlo.</a>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</body>

</html>