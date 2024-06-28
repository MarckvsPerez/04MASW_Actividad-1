<?php
require_once('../../controllers/ActorsController.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listado de actores</title>
</head>

<body>
    <?php include('../../router/nav.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Listado de actores</h1>
            </div>
            <div class="col-6">
                <a class="btn btn-primary" href="create.php">+ Crear actor</a>
            </div>
            <div class="col-12">
                <?php
                require_once('../../controllers/ActorsController.php');
                $actorsList = listActors();

                if (count($actorsList) > 0) {
                ?>
                    <table class="table">
                        <thead>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                            <th>Birthdate</th>
                            <th>Nationality</th>
                            <th class="text-end">Acciones</th>
                        </thead>
                        <tbody>
                            <?php foreach ($actorsList as $actor) { ?>
                                <tr>
                                    <td><?php echo $actor->getId(); ?></td>
                                    <td><?php echo $actor->getName(); ?></td>
                                    <td><?php echo $actor->getSurname(); ?></td>
                                    <td><?php echo $actor->getBirthday(); ?></td>
                                    <td><?php echo $actor->getNationality(); ?></td>
                                    <td class="text-end">
                                        <div class="btn-group" role="group" aria-label="Actors">
                                            <a class="btn btn-success" href="edit.php?id=<?php echo $actor->getId(); ?>">Editar</a>
                                            &nbsp;&nbsp;
                                            <form name="delete_actor" action="delete.php" method="POST" style="display: inline;">
                                                <input type="hidden" name="actorId" value="<?php echo $actor->getId(); ?>" />
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
                    <div class="alert alert warning" role="alert">
                        Aún no existen actores.
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>