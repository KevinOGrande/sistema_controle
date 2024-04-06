<?php
//destruição de sessão
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:wght@100&display=swap" rel="stylesheet">
    <title>Document</title>
    <!-- Detalhes de estilização e posicionamento -->
    <style>
        header{
            background-color: #1B62B7;
        }
        .mb-3{
            width:20%;
        }
        .formulario{
            margin-top:7%;
            margin-left:43%;
        }
        .botao{
            margin-left:6%;
        }
        .fs-1{
            margin-left:45%;
            margin-top:5%;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar body-tertiary">
            <img src="image/senai_logo1.png" alt="">
        </nav>
    </header>
    <p class="fs-1">Login</p>
    <!-- Formulario para login -->
    <form action="login.php" method="post" class="formulario">
        <div class="mb-3">
            <label class="form-label">Usuario:</label>
            <input type="text" name="usuario" id="usuario" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label class="form-label">Senha:</label>
            <input type="password" name="senha" id="senha" required class="form-control" id="exampleInputPassword1">
        </div>
        <div class="botao">
            <input type="submit" value="Entrar" class="btn btn-primary">
        </div>
        
    </form>
    <!-- Notificações em javascript apartir de um parametro de uma super global GET -->
    <?php
    if(isset($_GET['login']) && $_GET['login'] == 'erro'){
        ?>
        <!-- Caso a condição seja verdadeira, ira ser criado uma div e após três segundo sera excluido -->
        <script>
            var teste = document.createElement('div');
            teste.textContent="Usuario";
            teste.style.backgroundColor = "#FF0000";
            teste.style.width = "200px";
            teste.style.height = "50px"
            document.body.appendChild(teste);
            setTimeout(function(){
                document.body.removeChild(teste);
                var novaurl = window.location.href.replace("?login=erro","");
                window.location.href = novaurl;
            },2000);
        </script>
        <?php
    }
    ?>
</body>
</html>