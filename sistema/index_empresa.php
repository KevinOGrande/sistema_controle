<?php
/* Inicio e verificação de sessão */
session_start();
if(isset($_SESSION['login_empresa']) && $_SESSION['login_empresa'] === true){
    //variavel que recebe um super global da sessão
    $cnpj = $_SESSION['cnpj'];
    /* variavel que faz a conexão ao banco de dados com o metodo PDO */
    $conexao = new PDO("mysql:host=localhost;dbname=sis_controle","kevin","1234");
    /* Variavel que recebe  resultado de uma query SQL na forma de array que faz uma consulta a empresa que o cnpj foa igual a o cnpj contido na variavel $cnpj*/
    $requissisao = $conexao->  query("SELECT nome_empresa FROM empresa WHERE cnpj='$cnpj'");
    /* Variavel que recebe a primeria linha do array do resultado da query SQL*/
    $linha = $requissisao->fetch(PDO::FETCH_ASSOC);
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
                .botao_download{  
                    margin-left:70%;
                }
            </style>
        </head>
        <body>
            <header>
                <nav class="navbar body-tertiary">
                    <img src="image/senai_logo1.png" alt="">
                    <div class="container">
                        <a href="login_front.php" onclick = "return confirm('Desejar sair?')" class="btn btn-secondary">Sair</a>
                    </div>
                </nav>
            </header>
            <?php
            if($linha){
            ?>
                <p class="fs-1">Seja Bem-vindo <?php echo $linha['nome_empresa'];?></p>
            <?php
            }
            ?>
            <!-- tabela que contem os arquivo para fazer o download -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th><h3>Nome do arquivo</h3></th>
                        <th><h3>Download</h3></th>
                    </tr>
                </thead>
            </table>
            <?php
            $arquivo = dir("C:/xampp/htdocs/estudo/sistema_controle/diretorio_empresa/".$cnpj);
            while(($nome_arquivo = $arquivo->read()) !== false){
                if($nome_arquivo!=="." && $nome_arquivo!==".."){
                    $url = "http://localhost/estudo/sistema_controle/diretorio_empresa/".$cnpj."/".$nome_arquivo;
                ?>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th><?php echo $nome_arquivo;?></th>
                                <th class="botao_download"><a href=<?php echo $url;?> download="<?php echo $nome_arquivo;?>" class="btn btn-success">Download</a></th>
                            </tr>
                        </tbody>
                    </table>
                    
                    <br>
                <?php
                }
            }        
            ?>
        </body>
    </html>
<?php
}else{
    header("location:login_front.php");
}
?>