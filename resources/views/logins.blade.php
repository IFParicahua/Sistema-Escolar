<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
    <link rel="stylesheet" href="{{ asset('boostrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('boostrap/js/bootstrap.min.js') }}" />
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <title >Document</title>
</head>
<body>
    <div class="contenedo">
        <form action="">
            <div class="titulo"><label>Bienvenido</label></div>
            <div class="texto">
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Usuario">
            </div>
            <div class="texto">
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
            </div>
            <button type="submit" class="btn btn-primary btn-lg">Ingresar</button>
        </form>
    </div>
</body>
</html>