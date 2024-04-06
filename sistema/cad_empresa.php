<?php
/* verificação de sessão */
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
    /* variaveis que recebem as informações do formulario da pagina "cadastro_empresa.php" */
    $nome=$_POST['nome'];
    $cnpj=$_POST['cnpj'];
    $usuario=$_POST['usuario'];
    $senha=$_POST['senha'];
    $phone=$_POST['telefone'];
    /* variavel que faz a conexão ao banco de dados com o metodo PDO */
    $conexao = new PDO("mysql:host=localhost;dbname=sis_controle","kevin","1234");
    /* Verificação de conexão com o banco de dados */
    if($conexao){
        /* Variavel que recebe  resultado de uma query SQL na forma de array que verifica se ja tem algum CNPJ cadatrado no banco de dados igual ao CNPJ contido na variavel $cnpj*/
        $teste_duplicidade_cnpj = $conexao -> query("SELECT cnpj FROM empresa WHERE cnpj='$cnpj'");
        /* verificação se a query foi execultada com sucesso */
        if($teste_duplicidade_cnpj){
            /* Variavel que recebe a primeria linha do array do resultado da query SQL*/
            $linha= $teste_duplicidade_cnpj-> fetch(PDO::FETCH_ASSOC);
            /* verificação para que se a consulta for verdadeira o usuario sera redirecionado para a pagina de menu com um parametro de uma super global GET */
            if($linha){
                header("location:index.php?cad=existente");
            }else{
                /* Caso a consulta acima não retornar nenhum resultado, sera feito a inserção do cadastro no banco de dados e a criação de um diretorio para a empresa no servidor com o nome do diretorio sendo o CNPJ.
                Logo após o usuario sera redirecionado para a pagina de menu com uma parametro de uma super global GET */
                $conexao -> query("INSERT INTO empresa(nome_empresa,cnpj,telefone,usuario,senha)VALUES('$nome','$cnpj','$phone','$usuario','$senha')");
                $caminho= "C:/xampp/htdocs/estudo/sistema_controle/diretorio_empresa/".$cnpj;
                mkdir($caminho,0777);
                header("location:index.php?cad=cadastrado");
            }
        }
        $conexao= null;
    }
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login_front.php");
}