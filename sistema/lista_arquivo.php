<?php
/* verificação de sessão */
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
    /* variaveis que recebem as informações do formulario da pagina "listar_empresa.php" */
    $diretorio = $_POST['diretorio'];
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
            .container{
                margin-top:-3%;
                margin-left:85%;
            }
            th,td{
                width:10%;
                height:1%
            }
            .botao_excluir{
                margin-left:70%;
            }
        </style>
    </head>
    <body>
        <header>
            <nav class="navbar body-tertiary">
                <img src="image/senai_logo1.png" alt="">
                <div class="container">
                    <a href="listar_empresa.php" class="btn btn-secondary">Voltar</a>
                </div>
            </nav>
        </header>
        <!-- Tabela que lista os nome dos arquivos e a opção de excluir-->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><h3>Arquivos</h3></th>
                </tr>
            </thead>
            </table>
        <?php
        //variavel que recebe um objeto que contem todas as informações do diretorio que contem os arquivos
        $arquivo = dir("C:/xampp/htdocs/estudo/sistema_controle/diretorio_empresa/".$diretorio);
        //laço de repetição que percorre o objeto atribuido as informações de cada arquivo a cada repetição a variavel $nome_arquivo
        while(($nome_arquivo = $arquivo->read()) !== false){
            if($nome_arquivo!=="." && $nome_arquivo!==".."){
                ?>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th><p><?php echo $nome_arquivo;?></p></th>
                            <th>
                                <!-- Formulario para excluir o arquivo -->
                                <form action="excluir_arquivo.php" method="post" class="botao_excluir">
                                    <input type="hidden" name="diretorio" value="<?php echo $diretorio;?>">
                                    <input type="hidden" name="arquivo" value="<?php echo $nome_arquivo;?>">
                                    <input type="submit" value="excluir" class="btn btn-danger">
                                </form>
                            </th>
                        </tr>
                    </tbody>
                </table>
                <?php
            }
        }
        ?>
    </body>
    </html>
    <?php
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login_front.php");
}
?>