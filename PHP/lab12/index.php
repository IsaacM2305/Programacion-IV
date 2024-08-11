
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Quiz</title>
        <link rel="stylesheet" href="static/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </head>
    
    <body>
        <h1>REGISTRATION FORM</h1>
        <div class="container">  
            <div class="imagen">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTtuphMb4mq-EcVWhMVT8FCkv5dqZGgvn_QiA&s" alt="">
            </div>

            <div class="formulario">
                <form action="agregar.php" method="post">
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

                    <button type="submit">OK</button>
                    <button onclick="window.location.href='datos.php'">Mostrar datos</button>

                </form>
            </div>
        </div>
    </body>
</html>