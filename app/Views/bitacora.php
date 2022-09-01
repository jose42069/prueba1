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

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      

      <canvas class="my-4 w-100" id="myChart" width="900" height="00"></canvas>

      <h2>Bitacora</h2>
      <div class="row justify-content-between">
        <div class="col-2">
          <br>
          <?php if($nueva){
            foreach($nueva as $nuevo) { ?> 
          <a href="<?=base_url("Home/nueva_actividad/{$nuevo->año}/{$nuevo->semana}");?>" type="button" class="btn btn-primary">Nueva Actividad</a>
          <?php } }  ?>
          
        </div>
      </div>   
      <div class="table-responsive">
        <table class="table table-hover table-sm table-bordered">
          <thead>
            <tr class="table-dark">
              
              <th>Actividad</th>
              <th width="150">Cliente</th>
              <th width="150">Proyecto</th>
              <th width="150">Tipo</th>
              <th width="150">Unidad</th>
              <th width="150">Lunes</th>
              <th width="150">Martes</th>
              <th width="150">Miercoles</th>
              <th width="150">Jueves</th>
              <th width="150">Viernes</th>
              <th width="150">Sabado</th>
              <th width="150">Domingo</th>
              <th width="150">Total</th>
              <th width="150">Opciones</th>
              
            </tr>
          </thead>
          <tbody>
          <?php if($bitacora){
            foreach ($bitacora as $semana) { ?>
            <tr>
            
            <td class="table-info"><?=$semana->actividad;?></td>
            <td class="table-info"><?=$semana->cliente;?></td>
            <td class="table-info"><?=$semana->proyecto;?></td>
            <td class="table-info"><?=$semana->tipo;?></td>
            <td class="table-info"><?=$semana->unidad;?></td>
            <td><?=$semana->lun;?></span></td>
            <td><?=$semana->mar;?></span></td>
            <td><?=$semana->mie;?></span></td>
            <td><?=$semana->jue;?></span></td>
            <td><?=$semana->vie;?></span></td>
            <td><?=$semana->sab;?></span></td>
            <td><?=$semana->dom;?></span></td>
            <td><?=($semana->lun+$semana->mar+$semana->mie+$semana->jue+$semana->vie+$semana->sab+$semana->dom);?></td>
            <td> 
            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
            <a href="<?=base_url("Home/horas/{$semana->id}");?>" class="btn btn-primary">Registrar</a>
            
            
            </div>
            
            </td>
            </tr>
            <?php } }  ?>
             
          </tbody>
          <br>
          
        </table>
        <table class="table table-hover table-sm table-bordered" >
        <thead>
            <tr class="table-success">
            <th>Comentarios</th>
            </tr>
          </thead>
          <tbody>
          <?php if($bitacora){
            foreach ($bitacora as $semana) { ?>
            <tr>
            
            <td class="table-warning"><?=$semana->comentarios;?></td>
            </tr>
            <?php } }  ?>
             
          </tbody>
          <br>
          
        </table>
      </div>
      <div class="row">
       <div class="col-md-12 pagination">
        
       </div>
      </div>  
    </main>
  </div>
</div>
<script> function alertas(){ return confirm("Deseas eliminar?"); } </script>




    <script src="http://localhost/noticias/public/assets/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html> 
