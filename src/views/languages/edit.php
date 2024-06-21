<?php
    require_once('../../controllers/LanguagesController.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">   
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
        crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Editar idioma</title>
    </head>
    <body>
    <?php include('../../router/nav.php'); ?>
    <div class="container">
        <?php
        $idLanguage = $_GET['id'];
        $languageObject = getLanguageData($idLanguage);

        $sendData = false;
        $languageEdited = false;
        if(isset($_POST['editBtn'])) {
            $sendData = true;
        }
        if($sendData) {
            if(isset($_POST['languageName']) && isset($_POST['languageCode'])) {
                $languageEdited = updateLanguage($_POST['languageId'], $_POST['languageName'], $_POST['languageCode']);
            }
        }

        if (!$sendData) {
            ?>
            <div class="row">
                <div class="col-12">
                    <h1>Editar idioma</h1>
                </div>
                <div class="col-12">
                    <form name="edit_language" action="" method="POST">
                        <div class="mb-3">
                            <label for="languageName" class="form-label">Nombre idioma</label>
                            <input id="languageName" name="languageName" type="text"
                            placeholder="Introduce el nombre del idioma" class="form-control"
                            required value="<?php if (isset($languageObject)) echo $languageObject->getName();?>"/>
                        </div>
                        <div class="mb-3">
                            <label for="languageCode" class="form-label">Código ISO del idioma</label>
                            <input id="languageCode" name="languageCode" type="text"
                            placeholder="Introduce el código ISO del idioma" class="form-control"
                            required value="<?php if (isset($languageObject)) echo $languageObject->getIso();?>"/>
                            <input type="hidden" name="languageId" value="<?php echo $idLanguage; ?>"/>
                        </div>
                        <input type="submit" value="Editar" class="btn btn-primary" name="editBtn"/>
                    </form>
                </div>
            </div>
            <?php
        } else {
            if ($languageEdited) {
                ?>
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-success" role="alert">
                            Idioma editado correctamente. <br><a href="list.php">Volver al listado de idiomas.</a>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            El idioma no se ha editado correctamente.<br><a href="edit.php?id=<?php echo $idLanguage; ?>">Volver a intentarlo.</a>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
    </body>
</html>
