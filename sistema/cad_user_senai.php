<?php
/* verificação de sessão */
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true ){
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
        <title>Cadastro de usuário senai</title>
        <style>
            /* Detalhes de estilização e posicionamento */
            header{
                background-color: #1B62B7;
            }
            .container{
                margin-top:-3%;
                margin-left:85%;
            }
            .mb-3{
                width:30%;
            }
            .formulario{
                margin-top:7%;
                margin-left:40%;
            }
            .botao{
                margin-left:11%;
            }
            .fs-1{
                margin-left:40%;
                margin-top:2%;
            }
        </style>
    </head>
    <body>
        <header>
            <nav class="navbar body-tertiary">
                <img src="image/senai_logo1.png" alt="">
                <div class="container">
                    <a href="index.php" class="btn btn-secondary">Voltar</a>
                </div>
            </nav>
        </header>
        <p class="fs-1">Cadastrar usuário</p>
        <div class="formulario">
            <!-- Formulario para o envio de informações de cadastro de usuario do senai para o arquivo "cad_user_senai2.php" -->
            <form action="cad_user_senai2.php" method="post" class="form">
                <div class="mb-3">
                    <label class="texto1">Nome</label>
                    <input type="text" placeholder="..." name="nome" id="nome" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label >E-mail</label>
                    <input type="text" name="email" id="email" placeholder="..." required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                <div class="mb-3">
                    <label >Senha</label>
                    <input type="password" name="senha" id="senha" placeholder="..." required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="botao">
                    <input type="submit" value="Enviar" class="btn btn-success">
                </div>
            </form>
        </div>
    </body>
    </html>
<?php
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login_front.php");
}
?>