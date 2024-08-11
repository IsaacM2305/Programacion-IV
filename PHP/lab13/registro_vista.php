
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nuevo registro</title>
        <link rel="stylesheet" href="static/style._agregar.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </head>
    
    <body>
        
        <div class="container">  
            <div class="formulario">
                <form action="registro.php" method="post">
                    
                    <h1>Crear cuenta</h1>
                    <div class="imagen">
                        <img src="images/login_img.jpg" alt="">
                    </div>
                    
                    <input type="text" name="firstname" id="firstname" placeholder="First Name"> &nbsp;
                    <input type="text" name="lastname" id="lastname" placeholder="Last Name"><br><br>
                    
                    <div class="datos">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" id="username" placeholder="Username"><br><br>

                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" id="email" placeholder="Email"><br><br>
                        
                        <i class="fa-solid fa-phone"></i>
                        <input type="text" name="telefono" id="telefono" placeholder="Telefono"><br><br>
                        
                        <i class="fa-solid fa-unlock-keyhole"></i>
                        <input type="password" name="password" id="password" placeholder="password" required><br><br>
                
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" required>
                    </div>
                    <br>

                    <button type="submit">OK</button><br><br>
                    <button onclick="window.location.href='index.php'">Volver</button>

                </form>
            </div>
        </div>
    </body>
</html>