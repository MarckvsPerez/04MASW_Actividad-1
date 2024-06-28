<?php
require_once('../../controllers/SeriesController.php');
require_once('../../models/Platform.php');
require_once('../../models/Directors.php');
require_once('../../models/Actors.php');
require_once('../../models/Languages.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar serie</title>
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

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
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
        $idSerie = $_GET['id'];
        $serieObject = getSerie($idSerie);

        $sendData = false;
        $serieEdited = false;
        if (isset($_POST['editBtn'])) {
            $sendData = true;
            if (isset($_POST['serieTitle'], $_POST['platform'], $_POST['director'], $_POST['actor'], $_POST['audio'], $_POST['subtitulos'])) {
                $serieEdited = updateSerie($_POST['serieId'], $_POST['serieTitle'], $_POST['platform'], $_POST['director'], $_POST['actor'], $_POST['audio'], $_POST['subtitulos']);
            }
        }

        if (!$sendData) {
        ?>
            <div class="row">
                <div class="col-12">
                    <h1>Editar serie</h1>
                </div>
                <div class="col-12">
                    <form name="edit_serie" action="" method="POST">
                        <div class="mb-3">
                            <label for="serieTitle" class="form-label">Nombre serie</label>
                            <input id="serieTitle" name="serieTitle" type="text" placeholder="Introduce el nombre de la serie" class="form-control" required value="<?php echo $serieObject->getTitle(); ?>" />
                        </div>

                        <div class="mb-3">
                            <label for="platform" class="form-label">Plataforma</label>
                            <select id="platform" name="platform" class="form-control" required>
                                <option value="">Seleccione una plataforma</option>
                                <?php
                                $platformModel = new Platform();
                                $platformList = $platformModel->getAll();
                                foreach ($platformList as $platform) {
                                    $selected = $platform->getId() == $serieObject->getPlatform() ? 'selected' : '';
                                    echo "<option value='{$platform->getId()}' {$selected}>{$platform->getName()}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="director" class="form-label">Director</label>
                            <select id="director" name="director" class="form-control" required>
                                <option value="">Seleccione un director</option>
                                <?php
                                $directorModel = new Directors();
                                $directorList = $directorModel->getAll();
                                foreach ($directorList as $director) {
                                    $selected = $director->getId() == $serieObject->getDirector() ? 'selected' : '';
                                    echo "<option value='{$director->getId()}' {$selected}>{$director->getName()} {$director->getSurname()}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="actor" class="form-label">Actor</label>
                            <select id="actor" name="actor" class="form-control" required>
                                <option value="">Seleccione un actor</option>
                                <?php
                                $actorModel = new Actors();
                                $actorList = $actorModel->getAll();
                                foreach ($actorList as $actor) {
                                    $selected = $actor->getId() == $serieObject->getActor() ? 'selected' : '';
                                    echo "<option value='{$actor->getId()}' {$selected}>{$actor->getName()} {$actor->getSurname()}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="audio" class="form-label">Audio</label>
                            <select id="audio" name="audio" class="form-control" required>
                                <option value="">Seleccione un idioma</option>
                                <?php
                                $languageModel = new Language();
                                $languageList = $languageModel->getAll();
                                foreach ($languageList as $language) {
                                    $selected = $language->getId() == $serieObject->getAudio() ? 'selected' : '';
                                    echo "<option value='{$language->getId()}' {$selected}>{$language->getName()}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="subtitulos" class="form-label">Subtítulos</label>
                            <select id="subtitulos" name="subtitulos" class="form-control" required>
                                <option value="">Seleccione un idioma</option>
                                <?php
                                foreach ($languageList as $language) {
                                    $selected = $language->getId() == $serieObject->getSubtitle() ? 'selected' : '';
                                    echo "<option value='{$language->getId()}' {$selected}>{$language->getName()}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <input type="hidden" name="serieId" value="<?php echo $idSerie; ?>">
                        <input type="submit" value="Editar" class="btn btn-primary" name="editBtn" />
                    </form>
                </div>
            </div>

            <?php
        } else {
            if ($serieEdited) {
            ?>
                <div class="row">
                    <div class="alert alert-success" role="alert">
                        Serie editada correctamente.<br><a href="list.php">Volver al listado de series.</a>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="row">
                    <div class="alert alert-danger" role="alert">
                        La serie no se ha editado correctamente.<br><a href="edit.php?id=<?php echo $idSerie; ?>">Volver a intentarlo.</a>
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