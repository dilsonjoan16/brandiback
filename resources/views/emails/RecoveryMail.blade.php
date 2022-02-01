<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recuperacion de Password</title>
</head>
<body>
    <h1>
        Correo de recuperacion del password
    </h1>
    <p>
        <i>
            Estimado(a) <strong>{{$details[1]}}</strong>, se recibio una solicitud de restablecimiento del password en el sistema digital de cursos de<strong> Brandi Technology Inc.</strong> <br><br>
            El sistema le generara una password provicional, esta misma puede ser modificada a traves del sistema si usted lo desea. <br>
            <br><strong>Password generada:</i> {{$details[0]}}</strong><br>
            <hr><br>
            <i>Para el proximo ingreso al sistema, debera hacer uso del nuevo recurso otorgado.</i>
        <br>
        <br>
        <hr><br>
        <strong>Brandi Technology Inc.</strong>
    </p>
</body>
</html>
