<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro de Compra</title>
</head>
<body>
    <h1>
        Correo para Administradores - Registro de compra de alguno de nuestros Cursos || Brandi Technology Inc.
    </h1>
    <p>
        <i>
            Estimado(a) <strong>Administrador(a)</strong>, se recibio una solicitud de confirmacion de compra de alguno de nuestros Cursos en el sistema Digital de Cursos de<strong> Brandi Technology Inc.</strong> <br><br>
            El sistema le generara un reporte de compra via Email, en el que se podra visualizar con detalle la accion realizada en el sistema por el cliente.
            Se le solicita su accion a la mayor brevedad posible, en la verificacion del pago y si es efectivo dar pie al proceso de logistica del producto al destino y aviso a nuestro cliente! <br>
            <br><strong>Registro de Compra Realizada por el Cliente:</i></strong><br>
            <strong>Nombre del Comprador / Cliente: </strong>{{$details2[4]}} <br>
            <strong>Nombre del Curso: </strong>{{$details2[0]}}<br>
            <strong>Descripcion del Curso: </strong>{{$details2[1]}}<br>
            <strong>Precio del Curso: </strong>{{$details2[2]}} $<br>
            <strong>Duracion del Curso: </strong>{{$details2[3]}} Hrs <br>
            @php
                $fecha1 = explode(" ", $details2[5]);
                $fecha = $fecha1[0];
            @endphp
            <strong>Fecha de Adquisicion del Curso: </strong>{{$fecha}}
            <hr><br>
            <i>Se le agradece por la Accion tomada a tiempo y por su Responsabilidad, sigamos haciendo de<strong> Brandi Technology Inc.</strong> Un pleno referente en el Mercado Regional!
        <br>
        <br>
        <hr><br>
        <strong>Brandi Technology Inc.</strong>
    </p>
</body>
</html>
