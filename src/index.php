<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Biblioteca</title>
  <style>
    body {
      background-color: #f8f9fa;
    }

    .nav-link {
      font-size: 1.2em;
    }

    .card {
      margin: 20px;
    }
  </style>
</head>

<body>
  <?php include('./router/nav.php'); ?>
  <div class="container">
    <div class="row my-4">
      <div class="col-12 text-center">
        <h1>Biblioteca de plataformas</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body text-center">
            <h5 class="card-title">Plataformas</h5>
            <p class="card-text">
              Listado y gestión de las plataformas creadas en BBDD.
            </p>
            <a class="btn btn-primary" href="views/platforms/list.php">Listado de plataformas</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body text-center">
            <h5 class="card-title">Idiomas</h5>
            <p class="card-text">
              Listado y gestión de los idiomas creados en BBDD.
            </p>
            <a class="btn btn-primary" href="views/languages/list.php">Listado de idiomas</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body text-center">
            <h5 class="card-title">Directores/as</h5>
            <p class="card-text">
              Listado y gestión de los directores/as creados en BBDD.
            </p>
            <a class="btn btn-primary" href="views/directors/list.php">Listado de directores/as</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-body text-center">
            <h5 class="card-title">Actores/as</h5>
            <p class="card-text">
              Listado y gestión de los actores/as creados en BBDD.
            </p>
            <a class="btn btn-primary" href="views/actors/list.php">Listado de actores/as</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-body text-center">
            <h5 class="card-title">Series</h5>
            <p class="card-text">
              Listado y gestión de las series creadas en BBDD.
            </p>
            <a class="btn btn-primary" href="views/series/list.php">Listado de series</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</body>

</html>