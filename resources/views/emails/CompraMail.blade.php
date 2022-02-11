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
        Correo - Registro de compra de alguno de nuestros Cursos || Brandi Technology Inc.
    </h1>
    <p>
        <i>
            Estimado(a) <strong>{{$details[4]}}</strong>, se recibio una solicitud de confirmacion de compra de alguno de nuestros Cursos en el sistema Digital de Cursos de<strong> Brandi Technology Inc.</strong> <br><br>
            El sistema le generara un reporte de compra via Email, en el que se podra visualizar con detalle su accion realizada en el sistema. Por ahora solo queda esperar con paciencia la confirmacion del pago de parte de<strong> Brandi Technology Inc.</strong> para continuar con el proceso. Nuestros especialistas tardan aproximadamente <strong>24 Horas</strong> en verificar este tipo de solicitudes <br>
            <br><strong>Compra Realizada:</i></strong><br>
            <strong>Nombre del Curso: </strong>{{$details[0]}}<br>
            <strong>Descripcion del Curso: </strong>{{$details[1]}}<br>
            <strong>Precio del Curso: </strong>{{$details[2]}} $<br>
            <strong>Duracion del Curso: </strong>{{$details[3]}} Hrs <br>
            @php
                $fecha1 = explode(" ", $details[5]);
                $fecha = $fecha1[0];
            @endphp
            <strong>Fecha de Adquisicion del Curso: </strong>{{$fecha}}
            <hr><br>
            <i>Se le agradece por la Confianza y Fidelidad con nuestra Marca y nuestros Cursos!</i> Siempre seguiremos trabajando a favor de la preparacion y culturizacion de nuestra Region!
        <br>
        <br>
        <hr><br>
        <strong>Brandi Technology Inc.</strong>
    </p>
</body>
</html>
