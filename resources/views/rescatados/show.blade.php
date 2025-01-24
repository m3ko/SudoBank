<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Select</h1>
    <ul>
        <li>{{ $rescatado->id }} </li>
        <li>{{ $rescatado->nombre }} </li>
        <li>{{ $rescatado->apellido }} </li>
        <li>{{ $rescatado->foto }} </li>
        <li>{{ $rescatado->edad }} </li>
        <li>{{ $rescatado->sexo }} </li>
        <li>{{ $rescatado->procedencia }} </li>
        <li>{{ $rescatado->valoracion_medica }} </li>
        <li>{{ $rescatado->medico_id }} </li>
        <li>{{ $rescatado->rescate_id }} </li>
 
    </ul>
</body>
</html>