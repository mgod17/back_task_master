<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecimiento de contraseña</title>
</head>
<body>
    <p>Estás recibiendo este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para tu cuenta.</p>
    <p>Por favor, haz clic en el siguiente enlace para restablecer tu contraseña:</p>
    <a href="{{ $resetLink }}">{{ $resetLink }}</a>
    <p>Si no solicitaste restablecer tu contraseña, no es necesario que hagas nada más.</p>
</body>
</html>