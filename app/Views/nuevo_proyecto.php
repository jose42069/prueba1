<!doctype html>
<html lang="es">
 <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width. initial-scale=1">
  <meta name="description" content="">
  <title>Bitacoras</title>


  <link href="http://localhost/bitacoras/public/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="http://localhost/bitacoras/public/assets/css/styles.css" rel="stylesheet">
  <link href="http://localhost/bitacoras/public/assets/css/dashboard.css" rel="stylesheet">
  <style>
  .pagination li a {
    position: relative;
    display: block;
    color: #0d6efd;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #dee2e6;
    transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}

.pagination li.active a {
    z-index: 3;
    color: #fff;
    background-color: #0d6efd;
    border-color: #0d6efd;
}

.pagination li:not(:first-child) a {
    margin-left: -1px;
}

.pagination li:first-child a {
    border-top-left-radius: .25rem;
    border-bottom-left-radius: .25rem;
}

.pagination li:last-child a {
    border-top-right-radius: .25rem;
    border-bottom-right-radius: .25rem;
}


.pagination li a {
    padding: .375rem .75rem;
}
</style>
 </head>
 <body>

 <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Tu bitacora</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="<?=base_url("Auth/logout");?>" id="logout" onclick="return confirm('Deseas cerrar sesion?')">
      <?=view_cell('\App\Controllers\Home::User');?>
      Cerrar sesion
      </a>
    </li>
  </ul>
</header>
<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?=base_url("Home/index");?>">
              <span data-feather="home"></span>
              Volver
            </a>
          </li>
          
          
          
        </ul>

        
        
      </div>
    </nav>

    <h4>Nuevo Proyecto</h4>


<hr>
<form method="post" action="">



<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="row justify-content-between">
        <div class="col-2">
          <br>
          <a href="<?=base_url("Home/proyectos");?>" type="button" class="btn btn-danger">Cancelar</a>
        </div>
      </div>
      

      <canvas class="my-4 w-100" id="myChart" width="900" height="00"></canvas>
<div class="row">
  <div class="col-md-7">
    <div class="mb-3">
      <label for="proyecto" class="form-label">Proyecto</label>
      <input type="text" class="form-control" id="proyecto" name="proyecto" value="<?=$proyecto['proyecto'];?>">
      <?php if($validation->getError('proyecto')) {?>
        <div class="alert alert-danger mt-2">
        <?= $validation->getError('proyecto'); ?>
        </div>
      <?php }?>  
    </div>
    

  </div>
  <div class="mb-3">
         <div class="d-grid gap-2">
           <input type="hidden" value="true" name="guardar" />
           <button class="btn btn-primary" type="submit">Guardar</button>
         </div>
        </div>    
  </div>
</div>
</form>
</main>
<script src="http://localhost/noticias/public/assets/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.ckeditor.com/4.16.1/basic/ckeditor.js"></script>
<script>

</script>


<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
</body>
</html> 