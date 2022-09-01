<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta
            name="author"
            content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.80.0">
        <title>Signin Template · Bootstrap v5.0</title>
        <!-- Bootstrap core CSS -->
        <link href="<?=base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">

        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }
        </style>

        <!-- Custom styles for this template -->
        <link href="<?=base_url('assets/css/signin.css');?>" rel="stylesheet">
    </head>
    <body class="text-center">
<a href=""></a>
        <main class="form-signin">
        <form action="<?=base_url('Auth/login');?>" method="post">
            <img class="mb-4" src="<?=base_url('assets/images/tecmi.png');?>" alt="imagen" width="500" height="200">
            <h1 class="h3 mb-3 fw-normal">INICIAR SESION</h1>
            <label for="inputEmail" class="visually-hidden">YUSERNEIM</label>
            <?=form_input($email);?>
            <label for="inputPassword" class="visually-hidden">CONTRA</label>
            <?=form_input($password);?>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me">
                    RECUERDAME
                </label>
            </div>
            <?=form_submit('boton_submit', 'Sign in');?>
            <p class="mt-5 mb-3 text-muted">&copy; Copyright Industrias Jose A. 2021</p>
            </form>
        </main>
    </body>
</html>