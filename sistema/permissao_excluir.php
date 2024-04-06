<?php
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
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
        <title>Permissão</title>
        <!-- Detalhes de estilização e posicionamento -->
        <style>
            header{
                background-color: #1B62B7;
            }
            .container{
                margin-top:-3%;
                margin-left:85%;
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
                margin-left:33%;
                margin-top:5%;
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
        <p class="fs-1">Permissão para excluir empresa</p>
        <!-- Formulario para de validação para a excluir empresa -->
        <form action="excluir_empresa.php" method="post" class="formulario">
            <input type="hidden" name="cnpj" value="<?php echo $_POST['cnpj']?>">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Usuario</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="usuario">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Senha</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="senha">
            </div>
            <div class="botao">
                <input type="submit" value="Excluir" class="btn btn-danger">
            </div>
        </form>
    </body>
    </html>
<?php
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login_front.php");
}
?>
