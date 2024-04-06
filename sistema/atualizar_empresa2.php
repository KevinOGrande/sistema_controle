<?php
/* verificação de sessão */
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
    /* variaveis que recebem as informações do formulario da pagina "cadastro_empresa.php" */
    $telefone = $_POST['telefone'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $cnpj = $_POST['cnpj'];
    /* variavel que faz a conexão ao banco de dados com o metodo PDO */
    $conexao = new PDO("mysql:host=localhost;dbname=sis_controle","kevin","1234");
    /* Verificação de conexão com o banco de dados */
    if($conexao){
        /* Variavel que recebe  resultado de uma query SQL na forma de array que faz a atualização dos dados*/
        $resultado=$conexao->query("UPDATE empresa SET telefone='$telefone',usuario='$usuario',senha='$senha' WHERE cnpj='$cnpj'");
        //verificação se a query foi realizada com sucesso
        if($resultado){
            header("location:index.php?atualiza=true");
        }else{
            header("location:index.php?atualiza=false");
        }
        $conexao=null;
    }
}else{
    header("location:login_front.php");
}

