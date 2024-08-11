<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inicio de Sesión</title>
        <link rel="stylesheet" href="static/style_login.css">
    </head>
    <body>
        <form action="login.php" method="post">
            <h1>Inicio de sesión</h1>
            <label for="username">Nombre de usuario: </label>
            <input type="text" id="username" name="username" required><br>

            <label for="pass">Contraseña: </label>
            <input type="password" id="pass" name="pass" required><br><br>
            
            <button type="submit">Iniciar sesión</button>
            <a href="registro_vista.php">
                <button type="button">Agregar</button>
            </a>

            <a href="bd_info.php">
                <button type="button">DB info</button>
            </a>

        </form>
    </body>
</html>
