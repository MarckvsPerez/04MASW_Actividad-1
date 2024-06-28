<?php
require_once('../../controllers/DirectorsController.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listado de directores</title>
</head>

<body>
    <?php include('../../router/nav.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Listado de directores</h1>
            </div>
            <div class="col-6 mb-3">
                <a class="btn btn-primary" href="create.php">+ Crear director</a>
            </div>
            <div class="col-12">
                <?php
                $directorsList = listDirectors();

                if (!empty($directorsList)) {
                ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                                <th>Birthdate</th>
                                <th>Nationality</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($directorsList as $director) { ?>
                                <tr>
                                    <td><?php echo $director->getId(); ?></td>
                                    <td><?php echo $director->getName(); ?></td>
                                    <td><?php echo $director->getSurname(); ?></td>
                                    <td><?php echo $director->getBirthday(); ?></td>
                                    <td><?php echo $director->getNationality(); ?></td>
                                    <td class="text-end">
                                        <div class="btn-group" role="group" aria-label="Directors">
                                            <a class="btn btn-success" href="edit.php?id=<?php echo $director->getId(); ?>">Editar</a>
                                            &nbsp;&nbsp;
                                            <form name="delete_director" action="delete.php" method="POST" style="display: inline;">
                                                <input type="hidden" name="directorId" value="<?php echo $director->getId(); ?>" />
                                                <button type="submit" class="btn btn-danger">Borrar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php
                } else {
                ?>
                    <div class="alert alert-warning" role="alert">
                        Aún no existen directores.
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>