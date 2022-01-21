{{--Aca vamos a poner alguna ventanita de accion no autorizada y que me rediriga al home--}}
<!DOCTYPE html>
<html lang="es">
  <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}">
        <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('css/_all-skins.css')}}">
        <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
        <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
    
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Acción no autorizada</strong></h4>
                </div>
                <div class="modal-body">
                    <p>No tiene permisos para realizar la accion requerida<br>
                        por favor comuniquese con un administrador</p>
                    </div>
                <div class="modal-footer">
                    <a href="{{asset('/home')}}">
                        <button type="submit" class="btn btn-primary" data-dismiss="modal">
                                Aceptar
                        </button>
                    </a>
                </div>
            </div>
        </div>
 

        <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-select.js') }}"></script>
        <script src="{{asset('js/app.min.js')}}"></script>

    </body>
</html>
