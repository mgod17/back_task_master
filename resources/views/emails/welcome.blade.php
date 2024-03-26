<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a nuestra aplicación</title>
</head>
<body>
    <h1>Bienvenido a nuestra aplicación</h1>
    <p>Estimado {{ $user->name }},</p>
    <p>Gracias por registrarte en nuestra aplicación. A continuación, encontrarás tus datos de inicio de sesión:</p>
    <ul>
        <li><strong>Correo electrónico:</strong> {{ $user->email }}</li>
        <li><strong>Contraseña temporal:</strong> {{ $password }}</li>
    </ul>
    <p>Por favor, inicia sesión con esta contraseña temporal y cambia tu contraseña lo antes posible.</p>
    <p>¡Esperamos que disfrutes usando nuestra aplicación!</p>
</body>
</html>