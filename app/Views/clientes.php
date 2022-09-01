<!doctype html>
<html lang="es">
 <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width. initial-scale=1">
  <meta name="description" content="">
  <title>Blog de noticias</title>


  <link href="http://localhost/noticias/public/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="http://localhost/noticias/public/assets/css/styles.css" rel="stylesheet">
  <link href="http://localhost/noticias/public/assets/css/dashboard.css" rel="stylesheet">
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
              Semanas
            </a>
          </li>
          <?php if($status == 1){ ?>
          <li class="nav-item">
            <a class="nav-link" href="<?=base_url("Home/proyectos");?>">
              <span data-feather="file"></span>
              Proyectos
            </a>
          </li>
          <?php } ?>
          <?php if($status == 1){ ?>
          <li class="nav-item">
            <a class="nav-link" href="">
              <span data-feather="file"></span>
              Clientes
            </a>
          </li>
          <?php } ?>
          
          
          
        </ul>

        
        
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      

      <canvas class="my-4 w-100" id="myChart" width="900" height="00"></canvas>

      <h2>Clientes</h2>
      <div class="row justify-content-between">
        <div class="col-2">
          <br>
          
          <a href="<?=base_url("Home/nuevo_cliente");?>" type="button" class="btn btn-primary">Nuevo cliente</a>
          
        </div>
      </div>   
      <div class="table-responsive">
        <table class="table table-sm table-hover">
          <thead>
            <tr>
              <th width="150">Cliente</th>
              
              
              
            </tr>
          </thead>
          <tbody>
          <?php if($clientes){
            foreach ($clientes as $semana) { ?>
            <tr>
            <td><?=$semana->cliente;?></td>
            
            <td> 
            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
            <a href="<?=base_url("Home/editar_cliente/{$semana->id}");?>" class="btn btn-primary">Editar</a>
            
            <a href="<?=base_url("Home/eliminar_cliente/{$semana->id}");?>" class="btn btn-danger" onclick="return confirm('Deseas eliminar?')">Eliminar</a>
            
            
            </div>
            
            </td>
            </tr>
            <?php } }  ?>
             
          </tbody>
        </table>
      </div>
      <div class="row">
       <div class="col-md-12 pagination">
        <?php echo($pagination); ?>
       </div>
      </div>  
        
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