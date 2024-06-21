<?php
    require_once('../../controllers/LanguagesController.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">   
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Listado de idiomas</title>
    </head>
    <body>
        <?php include('../../router/nav.php'); ?>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Listado de idiomas</h1>
                </div>
                <div class="col-6">
                    <a class="btn btn-primary" href="create.php">+ Crear idioma</a>
                </div>
                <div class="col-12">
                    <?php
                        $languageList = listLanguages();

                        if(count ($languageList) > 0) {
                    ?>      
                    <table class="table">
                        <thead>
                            <th>Id</th>
                            <th class="w-100">Nombre</th>
                            <th>ISO</th>
                            <th class="text-end">Acciones</th>
                        </thead>
                        <tbody>
                            <?php
                                foreach($languageList as $Language) {
                            ?>
                                <tr>
                                    <td><?php echo $Language->getId();?></td>
                                    <td><?php echo $Language->getName();?></td>
                                    <td><?php echo $Language->getIso();?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Language">
                                            <a class="btn btn-success" href="edit.php? id=<?php echo $Language->getId();?>">Editar</a>
                                            &nbsp;&nbsp;
                                            <form name="delete_Language" action="delete.php" method="POST" style="display: inline;">
                                                <input type="hidden" name="languageId" value="<?php echo $Language->getId(); ?>">
                                                <button type="submit" class="btn btn-danger">Borrar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <?php
                        } else {
                    ?>
                    <div class="alert alert warning" role="alert">
                        Aún no existen idiomas.
                    </div>
                    <?php
                        }
                    ?>
                </div>                        
            </div>
        </div>
    </body>
</html>