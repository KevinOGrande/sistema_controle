<?php
/* verificação de sessão */
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true ){
    /* variaveis que recebem as informações do formulario da pagina "cad_user_senai.php" */
    $nome=$_POST['nome'];
    $email=$_POST['email'];
    $senha=$_POST['senha'];
    /* variavel que faz a conexão ao banco de dados com o metodo PDO */
    $conexao = new PDO("mysql:host=localhost;dbname=sis_controle","kevin","1234");
    /* Verificação de conexão com o banco de dados */
    if($conexao){
        /* Variavel que recebe  resultado de uma query SQL na forma de array que verifica se ja tem algum email cadatrado no banco de dados igual ao email contido na variavel $email*/
        $teste_duplicidade_email = $conexao -> query("SELECT adm FROM usuario WHERE adm='$email'");
        /* verificação se a query foi execultada com sucesso */
        if($teste_duplicidade_email){
            /* Variavel que recebe a primeria linha do array do resultado da query SQL*/
            $verificacao_email= $teste_duplicidade_email->fetch(PDO::FETCH_ASSOC);
            /* verificação para que se a consulta for verdadeira o usuario sera redirecionado para a pagina de menu com um parametro de uma super global GET */
            if($verificacao_email){
                header("location:index.php?cad_senai=false");
            //verficar se a os dados foram inserido com sucesso, se a condição for verdadeira o usuario será redirecionado para a pagina de menu com um parametro de uma super global GET
            }else if($conexao -> query("INSERT INTO usuario(nome,adm,senha)VALUES('$nome','$email','$senha')")){
                header("location:index.php?cad_senai=true");
            }else{
                header("location:index.php?cad_senai=false");
            }
        }
        $conexao= null;
    }
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login_front.php");
}