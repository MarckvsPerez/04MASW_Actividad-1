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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Borrar idioma</title>
</head>
<body>
<?php include('../../router/nav.php'); ?>
<div class="container">
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $idLanguage = $_POST['languageId'];
        $languageDeleted = deleteLanguage($idLanguage);

        if($languageDeleted) {
            ?>
            <div class="row">
                <div class="alert alert-success" role="alert">
                    Idioma borrado correctamente. <br><a href="list.php">Volver al listado de idiomas</a>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="row">
                <div class="alert alert-danger" role="alert">
                    El idioma no se ha borrado correctamente.<br><a href="list.php">Volver a intentarlo.</a>
                </div>
            </div>
            <?php
        }
    } else {
        ?>
        <div class="row">
            <div class="alert alert-danger" role="alert">
                Método no permitido.<br><a href="list.php">Volver al listado de idiomas</a>
            </div>
        </div>
        <?php
    }
    ?>
</div>
</body>
</html>
