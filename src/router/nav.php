<?php $base_url = "/proyectos/src"; ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo $base_url; ?>/">Biblioteca</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $base_url; ?>/views/platforms/list.php">Plataformas</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $base_url; ?>/views/series/list.php">Series</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $base_url; ?>/views/languages/list.php">Idiomas</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $base_url; ?>/views/directors/list.php">Directores/as</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $base_url; ?>/views/actors/list.php">Actores</a>
                </li>
            </ul>
        </div>
    </div>
</nav>