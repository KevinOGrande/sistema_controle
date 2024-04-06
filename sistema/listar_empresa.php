<?php
/* verificação de sessão */
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
    /* variavel que faz a conexão ao banco de dados com o metodo PDO */
    $conexao = new PDO("mysql:host=localhost;dbname=sis_controle","kevin","1234");
    /* Verificação de conexão com o banco de dados */
    if($conexao){
        /* Variavel que recebe  resultado de uma query SQL na forma de array que contem todos os dados da tabela empresa*/
        $lista= $conexao-> query("SELECT cnpj,nome_empresa,telefone FROM empresa");
        //verificação se a query foi realizada com sucesso
        if($lista){
            ?>
            <!DOCTYPE html>
            <html lang="pt-br">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
                    <link rel="preconnect" href="https://fonts.googleapis.com">
                    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:wght@100&display=swap" rel="stylesheet">
                    <title>lista</title>
                    <!-- Detalhes de estilização e posicionamento -->
                    <style>
                        header{
                            background-color: #1B62B7;
                        }
                        th,td{
                            width:10%;
                            height:1%
                        }
                        .form-select{
                            width: 40%;
                        }
                        .formulario{
                            margin-left:10%;
                        }
                        .container{
                            margin-top:-3%;
                            margin-left:85%;
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
                    <!-- Notificações em javascript apartir de um parametro de uma super global GET -->
                    <?php 
                    if(isset($_GET['arquivo_excluido']) && $_GET['arquivo_excluido'] == true){
                        ?>
                            <!-- Caso a condição seja verdadeira, ira ser criado uma div e após três segundo sera excluido -->
                            <script>
                                var teste = document.createElement('div');
                                teste.textContent="Arquivo excluido!";
                                teste.style.backgroundColor = "#008000";
                                teste.style.border = "2px solid"
                                teste.style.borderRadius = "7px";
                                teste.style.borderColor= "#006400";
                                teste.style.width = "200px";
                                teste.style.height = "45px";
                                teste.style.marginLeft ="80%";
                                document.body.appendChild(teste);
                                setTimeout(function(){
                                    document.body.removeChild(teste);
                                    var novaurl = window.location.href.replace("?arquivo_excluido=true","");
                                    window.location.href = novaurl;
                                },2000);
                            </script>
                        <?php
                    }
                    if(isset($_GET['upload']) && $_GET['upload'] == true){
                        ?>
                            <script>
                                var teste = document.createElement('div');
                                teste.textContent="Arquivo enviado com sucesso!";
                                teste.style.backgroundColor = "#008000";
                                teste.style.border = "2px solid"
                                teste.style.borderRadius = "7px";
                                teste.style.borderColor= "#006400";
                                teste.style.width = "200px";
                                teste.style.height = "45px";
                                teste.style.marginLeft ="80%";
                                document.body.appendChild(teste);
                                setTimeout(function(){
                                    document.body.removeChild(teste);
                                    var novaurl = window.location.href.replace("?upload=true","");
                                    window.location.href = novaurl;
                                },2000);
                                
                            </script>
                        <?php
                        }
                    ?>
                    <!-- Tabela que contem as informações da empresas, e tambem o formulario para o envio de arquivo -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th><h3>CNPJ</h3></th>
                                <th><h3>Nome/Razão social</h3></th>
                                <th><h3>Telefone</h3></th>
                                <th><h3>Ver arquivos</h3></th>
                                <th><h3>Enviar Arquivo</h3></th>
                            </tr>
                        </thead>
                    </table>
                    <?php
                    // laço repetivo que percorrera o array que contem os dados da query
                    foreach($lista->fetchALL(PDO::FETCH_ASSOC) as $linha){
                        ?>
                        <div class="resultado">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th><?php echo $linha['cnpj'];?></th>
                                        <th><?php echo $linha['nome_empresa'];?></th>
                                        <th><?php echo $linha['telefone'];?></th>
                                        <th>
                                            <!--Formulario que enviara os dados para a listagem de arquivo de uma empresa -->
                                            <form action="lista_arquivo.php" method="post" class="formulario">
                                                <input type="hidden" name="diretorio" value="<?php echo $linha['cnpj'];?>">
                                                <input type="submit" value="Ver" class="btn btn-info">
                                            </form>
                                        </th>
                                        <th>
                                            <!-- Formulario para o upload de arquivos -->
                                            <form action="upload.php" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="cnpj" value="<?php echo $linha['cnpj'];?>">
                                                <input type="file" name="pdf" id="pdf" class="form-control" required>
                                                <select name="mes" id="mes" class="form-select">
                                                    <option value="janeiro">Janeiro</option>
                                                    <option value="fevereiro">Fevereiro</option>
                                                    <option value="março">Março</option>
                                                    <option value="abril">Abril</option>
                                                    <option value="maio">Maio</option>
                                                    <option value="junho">junho</option>
                                                    <option value="julho">julho</option>
                                                    <option value="agosto">Agosto</option>
                                                    <option value="setebro">Setembro</option>
                                                    <option value="outubro">Outubro</option>
                                                    <option value="novembro">Novebro</option>
                                                    <option value="dezembro">Dezembro</option>
                                                </select>
                                                <input type="number" name="ano" id="ano" value="<?php echo date("Y")?>" class="form-control">
                                                <input type="submit" value="enviar" class="btn btn-success">
                                            </form>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php
                    }?>
                </body>
                
            <html>
            
        <?php
        }
        $conexao= null;
    }
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login_front.php");
}