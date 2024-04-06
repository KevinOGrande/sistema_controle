<?php
/* verificação de sessão */
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
     /* variavel que recebe a informação do formulario da pagina "index.php" */
    $pesquisa = $_POST['pesquisa'];
    /* variavel que faz a conexão ao banco de dados com o metodo PDO */
    $conexao = new PDO("mysql:host=localhost;dbname=sis_controle","kevin","1234");
    /* Verificação de conexão com o banco de dados */
    if($conexao){
        /* Variavel que recebe  resultado de uma query SQL na forma de array que consulta as informações de uma empresa a onde o CNPJ contido na variavel $pesquisa seja 
        igual ao Cnpj contido na coluna cnpj na tabela empresa no banco de dados*/
        $pesquisa_cliente = $conexao->query("SELECT cnpj, nome_empresa, telefone, usuario, senha FROM empresa WHERE cnpj='$pesquisa'");
         /* verificação se a query foi execultada com sucesso */
        if($pesquisa_cliente){
            /* Variavel que recebe a primeria linha do array do resultado da query SQL*/
            $linha = $pesquisa_cliente->fetch(PDO::FETCH_ASSOC);
            /* verificação para que se a consulta for verdadeira ira carregar uma pagina html contendo as informações da empresa, um botão para excluir a empresa
            e outro botão para a atualização de informações da empresa */
            if($linha){
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
                    <title>Resultado</title>
                    <!-- Detalhes de estilização e posicionamento -->
                    <style>
                        header{
                            background-color: #1B62B7;
                        }
                        .container{
                            margin-top:-3%;
                            margin-left:85%;
                        }
                        .form-select{
                            width: 40%;
                        }
                        .form-control{
                            width:40%;
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
                        <!-- Resultado da pesquisa exibida em forma de tabela -->
                        <div class="resultado">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>CNPJ</th>
                                        <th>Nome/Razão Social</th>
                                        <th>Telefone</th>
                                        <th>Usuario Responsavel</th>
                                        <th>Enviar arquivo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th><?php echo $linha['cnpj'];?></th>
                                        <th><?php echo $linha['nome_empresa'];?></th>
                                        <th><?php echo $linha['telefone'];?></th>
                                        <th><?php echo $linha['usuario'];?></th>
                                        <th>
                                            <!-- Formulario para o envio de arquivos para o diretorio da empresa, onde os dados serão enviados para o arquivo "upload.php" -->
                                            <form action="upload.php" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="cnpj" value="<?php echo $linha['cnpj'];?>">
                                                <input type="file" name="pdf" id="pdf" class="form-control">
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
                        <!-- Formulario para excluir empresa onde os dados serão enviados para o arquivo "permissão_excluir.php" -->
                        <form action="permissao_excluir.php" method="post" >
                            <input type="hidden" name="cnpj" value="<?php echo $linha['cnpj'];?>">
                            <input type="submit" value="excluir" class="btn btn-danger">
                        </form>
                        <!-- Formulario para atualizar cadastro onde os dados serão enviados para o arquivo "atualizar_empresa.php" -->
                        <form action="atualizar_empresa.php" method="post" >
                            <input type="hidden" name="cnpj" value="<?php echo $linha['cnpj'];?>">
                            <input type="hidden" name="telefone" value="<?php echo $linha['telefone'];?>">
                            <input type="hidden" name="usuario" value="<?php echo $linha['usuario'];?>">
                            <input type="hidden" name="senha" value="<?php echo $linha['senha'];?>">
                            <input type="submit" value="atualizar" class="btn btn-info">
                        </form>
                    </body>
                </html>
                <?php
            }else{
                /* Caso a query de pesquisa não encontre nenhum CNPJ cadastrado no banco que seja igual ao CNPJ contido na variavel $pesquisa */
                header("location:index.php?erro_pesquisa=true");
            }
        }
        $conexao=null;
    }
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login_front.php");
}
?>

        